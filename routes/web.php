<?php

// namespace App\Http\Controllers;


use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Frontend\ProductFrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('admin.pages.dashboard');
// })->name('dashboard');


// Route::get('/', [DashboardController::class, 'index'])->name('dashboard'); 
// Route::resource('categories', CategoryController::class);
// Route::resource('products', ProductController::class);
// Route::delete('/product-images/{image}', [ProductImageController::class, 'destroy'])->name('product-images.destroy');
// Route::resource('brands', BrandController::class);

// Frontend Routes
Route::get('/', function () {
    return view('frontend.pages.index');
})->name('home');

Route::get('/products', [ProductFrontendController::class, 'index'])->name('frontend.products.index');

// Backend Routes
Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('categories', CategoryController::class);

    Route::resource('products', ProductController::class);

    Route::delete('/product-images/{image}', [ProductImageController::class, 'destroy'])->name('product-images.destroy');

    Route::resource('brands', BrandController::class);
});

