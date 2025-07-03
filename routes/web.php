<?php

// namespace App\Http\Controllers;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('admin.pages.dashboard');
})->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); 


Route::get('/addcategories', function () {
    return view('admin.pages.categories.addcategories');
});

