<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
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

// Route::get('/', [ProductController::class, 'index'])->name('products.index');

// Route::post('/products', [ProductController::class, 'store'])->name('products.store');


// Route::get('/delete/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

// Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');

// Route::put('/update/{id}', [ProductController::class, 'update'])->name('products.update');


// Route::get('/categories' , [CategoryController::class, 'index'])->name('categories.index');

// Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

// Route::get('deletecategory/{id}', [CategoryController::class, 'destroy'])->name('categories.delete');

// Route::get('editcategory/{id}', [CategoryController::class, 'edit'])->name('categories.edit');

// Route::put('updatecategory/{id}', [CategoryController::class, 'update'])->name('categories.update');

// Product Routes
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::post('/', [ProductController::class, 'store'])->name('products.store');
    Route::get('delete/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('update/{id}', [ProductController::class, 'update'])->name('products.update');
});

// Category Routes
Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('delete/{id}', [CategoryController::class, 'destroy'])->name('categories.delete');
    Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('update/{id}', [CategoryController::class, 'update'])->name('categories.update');
});