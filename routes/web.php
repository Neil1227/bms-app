<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\PaydayController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\LoanController;

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


/*
|--------------------------------------------------------------------------
| Subscription Routes
|--------------------------------------------------------------------------
*/

Route::post('/subscriptions', [SubscriptionController::class, 'store'])
    ->name('subscriptions.store');

Route::delete('/subscriptions/{subscription}', [SubscriptionController::class, 'destroy'])
    ->name('subscriptions.destroy');
Route::patch('/subscriptions/{subscription}/toggle', [SubscriptionController::class, 'toggle'])
    ->name('subscriptions.toggle');


Route::post('/payday', [PaydayController::class, 'store'])->name('payday.store');

/*
|--------------------------------------------------------------------------
| Loan Routes
|--------------------------------------------------------------------------
*/

Route::post('/loans', [LoanController::class, 'store'])->name('loans.store');
Route::delete('/loans/{loan}', [LoanController::class, 'destroy'])->name('loans.destroy');
// routes/web.php
Route::post('/loans/{loan}/pay', [LoanController::class, 'pay'])
    ->name('loans.pay');
