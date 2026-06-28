<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\FrontEndController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Route untuk fitur Ganti Bahasa (Dwi-Bahasa)
Route::get('lang/{lang}', [LanguageController::class, 'switchLang'])->name('lang.switch');

// 2. Route Halaman Utama (Beranda) mengarah ke fungsi index()
Route::get('/', [FrontEndController::class, 'index']);

// 3. Route memproses Form Ulasan mengarah ke fungsi store()
Route::post('/kirim-ulasan', [FrontEndController::class, 'store'])->name('ulasan.store');

// 4. Route Halaman Lainnya (diarahkan ke controller)
Route::get('/tentang', [FrontEndController::class, 'tentang']);
Route::get('/destinasi', [FrontEndController::class, 'destinasi']);

Route::get('/direktori', function () {
    return view('direktori'); 
});

Route::get('/hubungi-kami', function () {
    return view('kontak'); 
});