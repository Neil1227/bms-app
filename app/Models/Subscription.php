<?php

// app/Models/Subscription.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    // App\Models\Subscription.php
    protected $fillable = [
        'name',
        'amount',
        'billing_cycle',
        'billing_date',
        'category',
        'icon',
        'is_active',
    ];
}
