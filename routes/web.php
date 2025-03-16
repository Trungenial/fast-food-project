<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;



Route::get('/', function () {
    return view('welcome');
});
Route::get('/home','App\Http\Controllers\HomeControllers@home');

Route::get('/contact','App\Http\Controllers\ContactControllers@contact');
Route::post('/contact','App\Http\Controllers\ContactControllers@message');

Route::get('/store','App\Http\Controllers\StoreControllers@store');

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
