<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::latest()->get();

        $totalDebt = $loans->sum('remaining_amount');

        return view('dashboard', compact('loans', 'totalDebt'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'loan_name'          => 'required|string|max:255',
            'total_amount'       => 'required|numeric|min:0',
            'remaining_amount'   => 'required|numeric|min:0',
            'monthly_payment'    => 'required|numeric|min:0',
            'due_date'           => 'required|date',
            'next_payment_date'  => 'required|date|before_or_equal:due_date',
        ]);

        Loan::create($validated);

        return redirect()->back()->with('success', 'Loan added successfully!');
    }
    public function destroy(Loan $loan)
    {
        $loan->delete();

        return redirect()
            ->back()
            ->with('success', 'Loan deleted successfully.');
    }
    // app/Http/Controllers/LoanController.php

    public function pay(Request $request, Loan $loan)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $payment = $validated['amount'];

        $loan->remaining_amount = max(
            0,
            $loan->remaining_amount - $payment
        );

        $loan->save();

        return back()->with('success', 'Payment applied successfully.');
    }
}
