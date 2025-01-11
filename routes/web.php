<?php

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

Route::get('/budgetmaster', function () {
    return view('dashboard.budgetmaster');
});

Route::get('/subpage', function () {
    return view('dashboard.budgetsub');
});

Route::get('/compage', function () {
    return view('dashboard.budgetview');
});
