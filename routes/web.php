<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\FrontEndController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. RUTE FRONTEND (UNTUK PENGUNJUNG UMUM)
// ==========================================
Route::get('lang/{lang}', [LanguageController::class, 'switchLang'])->name('lang.switch');

// Ini yang memanggil Beranda HPI (Bukan halaman Laravel default)
Route::get('/', [FrontEndController::class, 'index']); 

Route::post('/kirim-ulasan', [FrontEndController::class, 'store'])->name('ulasan.store');
Route::get('/tentang', [FrontEndController::class, 'tentang']);
Route::get('/destinasi', [FrontEndController::class, 'destinasi']);

Route::get('/direktori', function () {
    return view('direktori'); 
});

Route::get('/hubungi-kami', function () {
    return view('kontak'); 
});


// ==========================================
// 2. RUTE ADMIN CMS (KHUSUS ADMIN LOGIN)
// ==========================================
Route::middleware(['auth'])->prefix('admin')->group(function () {
    
    // Halaman Dashboard Admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Nanti rute CRUD lainnya (seperti pramuwisata, berita, dll) ditambahkan di dalam sini...
});


// ==========================================
// 3. RUTE AUTENTIKASI BREEZE (LOGIN/LOGOUT)
// ==========================================
require __DIR__.'/auth.php';