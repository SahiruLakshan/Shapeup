<?php

use App\Http\Controllers\BudgetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\AssetsController;
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
Route::post('/budgetplansubmit', [BudgetController::class, 'budgetplansubmit'])->name('budgetplan.store');
Route::get('/budgetcomparison', [BudgetController::class, 'budgetcomparison'])->name('budgetplan.comparison');

Route::get('/category', function () {
    return view('dashboard.asset_manage.add_catogery');
});


// Route::get('/categoryview', [CategoryController::class, 'index'])->name('categories.index');
// Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
// Route::get('/categoriesedit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
// Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
// Route::delete('/deletecategories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

Route::get('/subcategory', function () {
    return view('dashboard.asset_manage.add_sub_catogery');
});

// Route::get('/sub_category', [SubCategoryController::class, 'index']);
// Route::get('/subcategoryview', [SubCategoryController::class, 'show'])->name('subcategories.show');
// Route::get('/editsubcategories/{id}', [SubCategoryController::class, 'edit'])->name('subcategories.edit');
// Route::put('/subcategories/{id}', [SubCategoryController::class, 'update'])->name('subcategories.update');
// Route::post('/create_sub_category', [SubCategoryController::class, 'store'])->name('subcategories.store');
// Route::delete('/deletesubcategories/{id}', [SubCategoryController::class, 'destroy'])->name('subcategories.destroy');

//Add new asset
Route::get('/add_asserts', function () {
    return view('dashboard.asset_manage.add_new_assert');
});

// Route::get('/assets', [AssetsController::class, 'index'])->name('assets.index');
// Route::get('/assets/create', [AssetsController::class, 'create'])->name('assets.create');
// Route::post('/assets/store', [AssetsController::class, 'store'])->name('assets.store');
// Route::get('/assets/edit/{id}', [AssetsController::class, 'edit'])->name('assets.edit');
// Route::put('/assets/update/{id}', [AssetsController::class, 'update'])->name('assets.update');
// Route::delete('/assets/destroy/{id}', [AssetsController::class, 'destroy'])->name('assets.destroy');
// Route::get('/get-subcategories', [AssetsController::class, 'getSubcategories'])->name('get.subcategories');

//allocate_asserts
Route::get('/allocate_asserts', function () {
    return view('dashboard.asset_manage.allocate_asserts');
});
