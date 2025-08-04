<?php

// namespace App\Http\Controllers;


use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\ProductFrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use Illuminate\Support\Facades\Route;


// Frontend Routes
Route::get('/', function () {
    return view('frontend.pages.index');
})->name('home');

Route::get('/products', [ProductFrontendController::class, 'index'])->name('products');
Route::get('/products/{slug}', [ProductFrontendController::class, 'show'])->name('frontend.products.show');
// Route::resource('products', ProductController::class);


// Backend Routes
Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('categories', CategoryController::class);

    Route::resource('products', ProductController::class);

    Route::delete('/product-images/{image}', [ProductImageController::class, 'destroy'])->name('product-images.destroy');

    Route::resource('brands', BrandController::class);

});


// Cart Routes
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update-quantity/{productId}', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');

// Checkout Routes
Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout.page');
Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');