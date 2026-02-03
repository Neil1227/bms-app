<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{

    public function index()
    {
        $incomes = Income::latest()->get();
        $totalIncome = Income::sum('amount');

        return view('dashboard', compact('incomes', 'totalIncome'));
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
