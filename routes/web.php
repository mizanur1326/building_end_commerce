<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('admin.pages.dashboard');
});

Route::get('/addcategories', function () {
    return view('admin.pages.categories.addcategories');
});