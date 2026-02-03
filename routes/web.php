<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\BudgetController;

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/', [IncomeController::class, 'index'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Income Routes
|--------------------------------------------------------------------------
*/
Route::prefix('income')->name('income.')->group(function () {
    Route::post('/', [IncomeController::class, 'store'])->name('store');
    Route::delete('{income}', [IncomeController::class, 'destroy'])->name('destroy');
});

/*
|--------------------------------------------------------------------------
| Budget Routes
|--------------------------------------------------------------------------
*/
Route::prefix('budgets')->name('budgets.')->group(function () {
    Route::post('/', [BudgetController::class, 'store'])->name('store');
    Route::delete('{budget}', [BudgetController::class, 'destroy'])->name('destroy');
});
