<?php

use App\Http\Controllers\BudgetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\AssetsController;
use App\Http\Controllers\DashboardController;
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



Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//Budget Process
Route::post('/submit-budget', [BudgetController::class, 'store'])->name('budget.store');
Route::post('/budgetplansubmit', [BudgetController::class, 'budgetplansubmit'])->name('budgetplan.store');
Route::get('/budgetview', [BudgetController::class, 'budgets'])->name('budgetplan.view');


