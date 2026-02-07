<?php

namespace App\Http\Controllers;

use App\Models\{
    Income,
    Budget,
    Subscription,
    PaydaySetting,
    Loan
};
use Illuminate\Http\Request;
use Carbon\Carbon;

class IncomeController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $activeCutoff = $this->getActiveCutoff($today);

        // Income
        $incomes = Income::latest()->get();
        $totalIncome = $incomes->sum('amount');

        // Payday & Salary
        $payday = PaydaySetting::first();
        [$nextPayday, $daysBeforePayday] = $this->getNextPayday($payday, $today);
        $salaryPerCutoff = $this->calculateSalaryPerCutoff($payday, $totalIncome);

        // Budgets
        $budgets = Budget::all();
        $cutoffs = $this->groupBudgetsByCutoff($budgets);
        $budgetForActiveCutoff = $budgets
            ->where('cutoff', $activeCutoff)
            ->sum('amount');

        $availableBalance = $totalIncome - $budgetForActiveCutoff;


        // Loans
        $loans = Loan::latest()->get();
        $loanCount = $loans->count();
        $totalLoanDebt = $loans->sum('remaining_amount');

        // Subscriptions
        $subscriptions = Subscription::all();
        $totalSubscriptions = $this->calculateMonthlySubscriptions($subscriptions);

        return view('dashboard', compact(
            'incomes',
            'totalIncome',
            'salaryPerCutoff',
            'budgetForActiveCutoff',
            'availableBalance',
            'activeCutoff',
            'cutoffs',
            'subscriptions',
            'totalSubscriptions',
            'nextPayday',
            'daysBeforePayday',
            'loans',
            'loanCount',
            'totalLoanDebt'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | HELPERS
    |--------------------------------------------------------------------------
    */

    private function getActiveCutoff(Carbon $today): string
    {
        return request('cutoff')
            ?? ($today->day <= 15 ? '1-15' : '16-30');
    }

    private function calculateSalaryPerCutoff(?PaydaySetting $payday, float $totalIncome): float
    {
        if (!$payday) return 0;

        return match ($payday->frequency) {
            'monthly', 'semi_monthly', 'bi_weekly' => $totalIncome / 2,
            default => 0,
        };
    }

    private function groupBudgetsByCutoff($budgets): array
    {
        return [
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
    }

    private function calculateMonthlySubscriptions($subscriptions): float
    {
        return $subscriptions
            ->where('is_active', true)
            ->sum(fn ($s) =>
                $s->billing_cycle === 'yearly'
                    ? $s->amount / 12
                    : $s->amount
            );
    }

    private function getNextPayday(?PaydaySetting $payday, Carbon $today): array
    {
        if (!$payday) return [null, null];

        $nextPayday = match ($payday->frequency) {
            'monthly' => $this->monthlyPayday($payday, $today),
            'semi_monthly' => $this->semiMonthlyPayday($payday, $today),
            'bi_weekly' => $this->biWeeklyPayday($payday, $today),
            default => null,
        };

        return [
            $nextPayday,
            $nextPayday ? $today->diffInDays($nextPayday, false) : null
        ];
    }

    private function monthlyPayday(PaydaySetting $payday, Carbon $today): Carbon
    {
        $date = Carbon::create($today->year, $today->month, $payday->payday_1);
        return $date->lt($today) ? $date->addMonth() : $date;
    }

    private function semiMonthlyPayday(PaydaySetting $payday, Carbon $today): Carbon
    {
        $first = Carbon::create($today->year, $today->month, $payday->payday_1);
        $second = Carbon::create($today->year, $today->month, $payday->payday_2);

        return $today->lte($first)
            ? $first
            : ($today->lte($second) ? $second : $first->addMonth());
    }

    private function biWeeklyPayday(PaydaySetting $payday, Carbon $today): Carbon
    {
        $date = Carbon::parse($payday->start_date);
        while ($date->lt($today)) {
            $date->addWeeks(2);
        }
        return $date;
    }

    /*
    |--------------------------------------------------------------------------
    | CRUD
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'income_source' => 'required|string|max:255',
            'amount'        => 'required|numeric|min:0',
            'category'      => 'required|string',
            'date'          => 'required|date',
        ]);

        Income::create([
            ...$validated,
            'is_recurring' => $request->boolean('is_recurring'),
        ]);

        return back()->with('success', 'Income added successfully!');
    }

    public function destroy(Income $income)
    {
        $income->delete();
        return back()->with('success', 'Income deleted successfully!');
    }
}
