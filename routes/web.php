<?php

use App\Http\Controllers\BudgetController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard.dashboard');
});

//Budget Process
Route::get('/budgetmaster', [BudgetController::class, 'master'])->name('budget.master');
Route::post('/submit-budget', [BudgetController::class, 'store'])->name('budget.store');
Route::get('/budget', [BudgetController::class, 'index'])->name('budget.index');
Route::get('/budgetprocess', [BudgetController::class, 'sub'])->name('budget.sub');


Route::get('/compage', function () {
    return view('dashboard.budgetview');
});
