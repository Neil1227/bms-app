<?php

// app/Models/Budget.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable = [
        'name',
        'icon',
        'color',
        'frequency',
        'date',
        'amount',
        'cutoff',
    ];
    // App\Models\Budget.php
    protected $casts = [
        'date' => 'date',
    ];

    // Default mapping from icon -> color key
    protected static $iconColorMap = [
        'bi-basket' => 'rose',
        'bi-car-front' => 'blue',
        'bi-house-door' => 'indigo',
        'bi-lightning-charge' => 'amber',
        'bi-wifi' => 'teal',
        'bi-phone' => 'gray',
        'bi-house-heart' => 'pink',
        'bi-people' => 'emerald',
        'bi-cup-hot' => 'amber',
        'bi-film' => 'violet',
        'bi-wallet2' => 'emerald',
        'bi-piggy-bank' => 'rose',
        'bi-three-dots' => 'gray',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->color)) {
                $model->color = static::$iconColorMap[$model->icon] ?? 'gray';
            }
        });
    }

    /**
     * Return Tailwind color utility classes for the budget color.
     */
    public function getColorClassesAttribute()
    {
        $map = [
            'rose'    => 'bg-rose-100 text-rose-600',
            'emerald' => 'bg-emerald-100 text-emerald-600',
            'gray'    => 'bg-gray-100 text-gray-600',
            'blue'    => 'bg-blue-100 text-blue-600',
            'indigo'  => 'bg-indigo-100 text-indigo-600',
            'amber'   => 'bg-amber-100 text-amber-600',
            'teal'    => 'bg-teal-100 text-teal-600',
            'violet'  => 'bg-violet-100 text-violet-600',
            'pink'    => 'bg-pink-100 text-pink-600',
        ];

        return $map[$this->color] ?? $map['gray'];
    }
}
