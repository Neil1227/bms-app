<?php

// app/Models/Subscription.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'name',
        'amount',
        'billing_cycle',
        'billing_date',
        'is_active',
    ];
}
