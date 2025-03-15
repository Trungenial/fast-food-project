<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home','App\Http\Controllers\HomeControllers@home');
Route::get('/contact','App\Http\Controllers\ContactControllers@contact');
Route::get('/store','App\Http\Controllers\StoreControllers@store');