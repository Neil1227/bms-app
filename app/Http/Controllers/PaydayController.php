<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaydaySetting;

class PaydayController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'frequency' => 'required|in:monthly,semi_monthly,bi_weekly',
            'payday_1' => 'nullable|integer|min:1|max:31',
            'payday_2' => 'nullable|integer|min:1|max:31',
            'start_date' => 'nullable|date',
        ]);

        PaydaySetting::updateOrCreate(
            ['id' => 1],
            [
                'frequency' => $request->frequency,
                'payday_1'  => in_array($request->frequency, ['monthly', 'semi_monthly'])
                    ? $request->payday_1
                    : null,
                'payday_2'  => $request->frequency === 'semi_monthly'
                    ? $request->payday_2
                    : null,
                'start_date' => $request->frequency === 'bi_weekly'
                    ? $request->start_date
                    : null,
            ]
        );


        return redirect()->back()->with('success', 'Payday settings saved!');
    }
}
