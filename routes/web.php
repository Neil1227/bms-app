<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncomeController;

Route::get('/', [IncomeController::class, 'index'])->name('dashboard');

Route::post('/income/store', [IncomeController::class, 'store'])
    ->name('income.store');

Route::post('/income/store', [IncomeController::class, 'store'])
    ->name('income.store');

Route::delete('/income/{income}', [IncomeController::class, 'destroy'])
    ->name('income.destroy');
