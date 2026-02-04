<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaydaySetting extends Model
{
    protected $fillable = [
        'frequency',
        'payday_1',
        'payday_2',
        'start_date',
    ];
}
