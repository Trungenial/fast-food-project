<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home','App\Http\Controllers\HomeControllers@home');

Route::get('/contact','App\Http\Controllers\ContactControllers@contact');
Route::post('/contact','App\Http\Controllers\ContactControllers@message');

Route::get('/store','App\Http\Controllers\StoreControllers@store');
require __DIR__.'/auth.php';

Route::get('/policy','App\Http\Controllers\HomeControllers@policy');

