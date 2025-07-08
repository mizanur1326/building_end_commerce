<?php

// namespace App\Http\Controllers;

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('admin.pages.dashboard');
// })->name('dashboard');

Route::get('/', [DashboardController::class, 'index'])->name('dashboard'); 

Route::resource('categories', CategoryController::class);

Route::resource('products', ProductController::class);

Route::delete('/product-images/{image}', [ProductImageController::class, 'destroy'])->name('product-images.destroy');


Route::resource('brands', BrandController::class);




// Route::get('/showCategories', [CategoryController::class, 'index'])->name('showCategories'); 
// Route::get('/addCategories', [CategoryController::class, 'add'])->name('addCategories'); 
// Route::get('/addCategories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
// Route::put('/addCategories/{id}', [CategoryController::class, 'update'])->name('categories.update');
// Route::delete('/addCategories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
// Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');

// Route::get('/addcategories', function () {
//     return view('admin.pages.categories.addcategories');
// });

