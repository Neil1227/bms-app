<?php

// app/Http/Controllers/BudgetController.php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function index()
    {
        $budgets = Budget::latest()->get();

        return view('dashboard', [
            'firstCutoff'  => $budgets->where('cutoff', '1-15'),
            'secondCutoff' => $budgets->where('cutoff', '16-30'),
        ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'icon'      => 'nullable|string',
            'color'     => 'nullable|string',
            'frequency' => 'required|string',
            'date'      => 'nullable|date',
            'amount'    => 'required|numeric|min:0',
            'cutoff'    => 'required|in:1-15,16-30',
        ]);

        Budget::create($validated);

        return back()->with('success', 'Budget added successfully.');
    }

    public function destroy(Budget $budget)
    {
        $budget->delete();

        return back()->with('success', 'Budget removed.');
    }
}
