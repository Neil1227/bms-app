<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_name',
        'total_amount',
        'remaining_amount',
        'monthly_payment',
        'due_date',
        'next_payment_date',
    ];

    protected $casts = [
        'due_date' => 'date',
        'next_payment_date' => 'date',
    ];
}
