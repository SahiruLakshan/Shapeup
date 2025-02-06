<?php

use App\Http\Controllers\BudgetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\AssetsController;
use App\Http\Controllers\AssetsallocationController;
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


Route::get('/compage', function () {
    return view('dashboard.budgetview');
});

//category

Route::get('/categoryview', [CategoryController::class, 'index'])->name('categories.index');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::delete('/deletecategories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');

//sub category

Route::get('/sub_category', [SubCategoryController::class, 'index'])->name('subcategories.index');
Route::get('/subcategoryview', [SubCategoryController::class, 'show'])->name('subcategories.show');
Route::get('/subcategories/{id}/edit', [SubCategoryController::class, 'edit'])->name('subcategories.edit');
Route::put('/subcategories/{id}', [SubCategoryController::class, 'update'])->name('subcategories.update');
Route::post('/create_sub_category', [SubCategoryController::class, 'store'])->name('subcategories.store');
Route::delete('/deletesubcategories/{id}', [SubCategoryController::class, 'destroy'])->name('subcategories.destroy');

//Add new asset

Route::get('/viewassets', [AssetsController::class, 'index'])->name('assets.index');
Route::get('/assets_create', [AssetsController::class, 'create'])->name('assets.create');
Route::post('/assets/store', [AssetsController::class, 'store'])->name('assets.store');
Route::get('/assets/edit/{id}', [AssetsController::class, 'edit'])->name('assets.edit');
Route::put('/assets/update/{id}', [AssetsController::class, 'update'])->name('assets.update');
Route::delete('/assets/destroy/{id}', [AssetsController::class, 'destroy'])->name('assets.destroy');
Route::get('/get-subcategories', [AssetsController::class, 'getSubcategories'])->name('get.subcategories');
Route::get('/getcategories', [AssetsController::class, 'getCategories']);

//allocate_asserts

Route::get('/asset-allocations', [AssetsallocationController::class, 'index'])->name('asset-allocations.index');
Route::get('/asset-allocations/create', [AssetsallocationController::class, 'create'])->name('asset-allocations.create');
Route::post('/assetallocationstore', [AssetsallocationController::class, 'store'])->name('asset-allocations.store');
Route::get('/asset-allocations/{assetAllocation}/edit', [AssetsallocationController::class, 'edit'])->name('asset-allocations.edit');
Route::put('/asset-allocations/{assetAllocation}', [AssetsallocationController::class, 'update'])->name('asset-allocations.update');
Route::delete('/asset-allocations/{id}', [AssetsallocationController::class, 'destroy'])->name('asset-allocations.destroy');

// AJAX Routes
Route::get('/get-subcategories/{category}', [AssetsallocationController::class, 'getSubCategories']);
Route::get('/get-assets/{category}/{subcategory}', [AssetsallocationController::class, 'getAssets']);
Route::get('/get-asset-value/{asset}', [AssetsallocationController::class, 'getAssetValue']);

// Route to fetch categories
Route::get('/get-categories', [AssetsallocationController::class, 'getCategories']);
Route::get('/get-employees', [AssetsallocationController::class, 'getEmployees']);