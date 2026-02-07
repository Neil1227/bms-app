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
        'salary_cutoff_1',
        'salary_cutoff_2',
        'active_cutoff',
    ];

    public function getActiveSalaryAttribute()
    {
        return $this->active_cutoff === '1-15'
            ? $this->salary_cutoff_1
            : $this->salary_cutoff_2;
    }
}
