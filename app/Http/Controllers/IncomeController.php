<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;
use App\Models\Budget;

class IncomeController extends Controller
{

    public function index()
    {
        $incomes = Income::latest()->get();
        $totalIncome = $incomes->sum('amount');

        $budgets = Budget::all();

        $firstCutoff  = $budgets->where('cutoff', '1-15');
        $secondCutoff = $budgets->where('cutoff', '16-30');
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

        return view('dashboard', compact(
            'incomes',
            'totalIncome',
            'cutoffs'
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
