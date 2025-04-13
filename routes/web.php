<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FooterController;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;


Route::get('/', 'App\Http\Controllers\HomeControllers@home')->name('home');

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

Route::get('/home','App\Http\Controllers\HomeControllers@home');

Route::get('/contact','App\Http\Controllers\ContactControllers@contact');
Route::post('/contact','App\Http\Controllers\ContactControllers@message');

Route::get('/store','App\Http\Controllers\StoreControllers@store');

Route::prefix('admin')->group(function () {
    // Guest routes
    Route::middleware('guest')->group(function () {
        Route::get('/', function () {
            return redirect()->route('admin.login');
        });
        Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
        Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    });

    // Protected routes
    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
    });
});

Route::get('/menu','App\Http\Controllers\MenuControllers@menu');

Route::get('/menu','App\Http\Controllers\MenuControllers@index');
Route::get('/menu/category/{id}','App\Http\Controllers\MenuControllers@category');

Route::get('/thong-tin/{slug}', [FooterController::class, 'show'])->name('footer.show');

require __DIR__.'/auth.php';

Route::get('/policy','App\Http\Controllers\HomeControllers@policy');
