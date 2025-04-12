<?php

use Illuminate\Support\Facades\Route;

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
