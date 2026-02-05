<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Budget;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'amount'        => 'required|numeric|min:0',
            'billing_cycle' => 'required|in:monthly,yearly',
            'billing_date'  => 'required|date',
            'category'      => 'required|string|max:255',
            'icon'          => 'required|string',
        ]);


        // Create subscription
        $subscription = Subscription::create([
            'name'          => $validated['name'],
            'amount'        => $validated['amount'],
            'billing_cycle' => $validated['billing_cycle'],
            'billing_date'  => $validated['billing_date'],
            'category'      => $validated['category'],
            'icon'          => $validated['icon'],
            'is_active'     => $request->has('is_active'),
        ]);

        // Determine cutoff
        $billingDate = Carbon::parse($validated['billing_date']);
        $cutoff = $billingDate->day <= 15 ? '1-15' : '16-30';

        // Normalize yearly → monthly
        $budgetAmount = $validated['billing_cycle'] === 'yearly'
            ? $validated['amount'] / 12
            : $validated['amount'];

        // Auto-create budget entry
        Budget::create([
            'name'      => $validated['name'],
            'amount'    => round($budgetAmount, 2),
            'frequency' => $validated['billing_cycle'],
            'date'      => $validated['billing_date'],
            'cutoff'    => $cutoff,
            'icon'      => $validated['icon'], // ✅ SAME ICON
            'color'     => 'gray',
        ]);


        return back()->with('success', 'Subscription added and allocated to budget.');
    }

    public function toggle(Subscription $subscription)
    {
        $subscription->update([
            'is_active' => ! $subscription->is_active,
        ]);

        return back();
    }

    public function destroy(Subscription $subscription)
    {
        // Delete related budget first (optional but cleaner)
        Budget::where('name', $subscription->name)->delete();

        // Permanently delete subscription
        $subscription->delete();

        return back()->with('success', 'Subscription removed.');
    }
}
