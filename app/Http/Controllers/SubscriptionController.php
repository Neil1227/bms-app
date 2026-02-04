<?php

// app/Http/Controllers/SubscriptionController.php
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
        ]);

        // Save subscription
        $subscription = Subscription::create([
            ...$validated,
            'is_active' => $request->has('is_active'),
        ]);

        // Determine cutoff based on billing date
        $billingDate = Carbon::parse($validated['billing_date']);
        $cutoff = $billingDate->day <= 15 ? '1-15' : '16-30';

        // Normalize yearly to monthly
        $budgetAmount = $validated['billing_cycle'] === 'yearly'
            ? $validated['amount'] / 12
            : $validated['amount'];

        // Auto-add to budgets
        Budget::create([
            'name'      => $validated['name'],
            'amount'    => round($budgetAmount, 2),
            'frequency' => $subscription->billing_cycle, // 'monthly' or 'yearly'
            'date'      => $validated['billing_date'],
            'cutoff'    => $cutoff,
            'icon'      => 'bi-play-btn',
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
        $subscription->delete();

        // Optional: also delete related budget by name
        Budget::where('name', $subscription->name)->delete();

        return back()->with('success', 'Subscription removed.');
    }
}
