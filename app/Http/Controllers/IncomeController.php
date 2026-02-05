<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;
use App\Models\Budget;
use Carbon\Carbon;
use App\Models\Subscription;
use App\Models\PaydaySetting;

class IncomeController extends Controller
{

    public function index()
    {
        $incomes = Income::latest()->get();
        $totalIncome = $incomes->sum('amount');

        $budgets = Budget::all();
        $totalBudgetAllocated = $budgets->sum('amount');

        $availableBalance = $totalIncome - $totalBudgetAllocated;

        $cutoffs = [
            [
                'label' => '1st Cut-off',
                'key'   => '1-15',
                'items' => $budgets->where('cutoff', '1-15'),
                'total' => $budgets->where('cutoff', '1-15')->sum('amount'),
            ],
            [
                'label' => '2nd Cut-off',
                'key'   => '16-30',
                'items' => $budgets->where('cutoff', '16-30'),
                'total' => $budgets->where('cutoff', '16-30')->sum('amount'),
            ],
        ];
        $today = Carbon::today();

        // ================================
        // NEXT CUTOFF — SALARY ONLY
        // ================================

        $payday = PaydaySetting::first(); // single user for now
        $today = Carbon::today();

        $nextPayday = null;
        $daysBeforePayday = null;

        if ($payday) {

            if ($payday->frequency === 'monthly') {

                $nextPayday = Carbon::create(
                    $today->year,
                    $today->month,
                    $payday->payday_1
                );

                if ($nextPayday->lt($today)) {
                    $nextPayday->addMonth();
                }
            }

            if ($payday->frequency === 'semi_monthly') {

                $first = Carbon::create(
                    $today->year,
                    $today->month,
                    $payday->payday_1
                );

                $second = Carbon::create(
                    $today->year,
                    $today->month,
                    $payday->payday_2
                );

                if ($today->lte($first)) {
                    $nextPayday = $first;
                } elseif ($today->lte($second)) {
                    $nextPayday = $second;
                } else {
                    $nextPayday = Carbon::create(
                        $today->year,
                        $today->month + 1,
                        $payday->payday_1
                    );
                }
            }

            if ($payday->frequency === 'bi_weekly') {

                $nextPayday = Carbon::parse($payday->start_date);

                while ($nextPayday->lt($today)) {
                    $nextPayday->addWeeks(2);
                }
            }

            $daysBeforePayday = $today->diffInDays($nextPayday, false);
        }


        // Get ALL subscriptions (active + inactive)
        $subscriptions = Subscription::all();

        // Only ACTIVE subscriptions affect totals
        $totalSubscriptions = $subscriptions
            ->where('is_active', true)
            ->sum(function ($s) {
                return $s->billing_cycle === 'yearly'
                    ? $s->amount / 12
                    : $s->amount;
            });


        return view('dashboard', compact(
            'incomes',
            'totalIncome',
            'totalBudgetAllocated',
            'availableBalance',
            'subscriptions',
            'totalSubscriptions',
            'cutoffs',
            'nextPayday',
            'daysBeforePayday'
        ));
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'income_source' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'category' => 'required|string',
            'date' => 'required|date',
        ]);

        Income::create([
            'income_source' => $validated['income_source'],
            'amount' => $validated['amount'],
            'category' => $validated['category'],
            'date' => $validated['date'],
            'is_recurring' => $request->has('is_recurring'),
        ]);

        return redirect()->back()->with('success', 'Income added successfully!');
    }

    public function destroy(Income $income)
    {
        $income->delete();

        return redirect()->back()->with('success', 'Income deleted successfully!');
    }
}
