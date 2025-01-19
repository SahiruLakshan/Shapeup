<?php
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;


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


Route::get('/category', function () {
    return view('dashboard.asset_manage.add_catogery');
});


Route::get('/categoryview', [CategoryController::class, 'index'])->name('categories.index');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

Route::get('/subcategory', function () {
    return view('dashboard.asset_manage.add_sub_catogery');
});


Route::get('/sub_category', [SubCategoryController::class, 'index']);
Route::get('/subcategoryview', [SubCategoryController::class, 'show'])->name('categories.show');
Route::get('/categories/{id}/edit', [SubCategoryController::class, 'edit'])->name('subcategories.edit');
Route::put('/categories/{subcategory}', [SubCategoryController::class, 'update'])->name('subcategories.update');

Route::post('/create_sub_category', [SubCategoryController::class, 'store'])->name('subcategories.store');
Route::delete('/categories/{id}', [SubCategoryController::class, 'destroy'])->name('subcategories.destroy');


//allocate_asserts
Route::get('/allocate_asserts', function () {
    return view('dashboard.asset_manage.allocate_asserts');
});

//Add new asset
Route::get('/add_asserts', function () {
    return view('dashboard.asset_manage.add_new_assert');
});