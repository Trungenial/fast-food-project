<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'App\Http\Controllers\HomeControllers@home')->name('home');

// Other routes to be added later
Route::get('/thuc-don', function () {
    return view('pages.thuc-don');
})->name('thuc-don');

Route::get('/khuyen-mai', function () {
    return view('pages.khuyen-mai');
})->name('khuyen-mai');

Route::get('/dich-vu-tiec', function () {
    return view('pages.dich-vu-tiec');
})->name('dich-vu-tiec');

Route::get('/nha-hang', function () {
    return view('pages.nha-hang');
})->name('nha-hang');

Route::get('/lien-he', function () {
    return view('pages.lien-he');
})->name('lien-he');

Route::get('/tuyen-dung', function () {
    return view('pages.tuyen-dung');
})->name('tuyen-dung');

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


// Route::get('/order','App\Http\Controllers\CartControllers@order')->name('order');

// Route::post('/cart/add','App\Http\Controllers\BookController@cartadd')->name('cartadd');

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});