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
Route::get('/tentang', [FrontEndController::class, 'tentang'])->name('tentang');
Route::get('/destinasi', [FrontEndController::class, 'destinasi']);
Route::get('/layanan', [FrontEndController::class, 'layanan'])->name('layanan');
Route::get('/berita', [FrontEndController::class, 'berita'])->name('berita');
Route::get('/berita/{slug}', [FrontEndController::class, 'showBerita'])->name('berita.show');
Route::get('/direktori', [FrontEndController::class, 'direktoriPramuwisata'])->name('direktori');
Route::get('/direktori/{slug}', [FrontEndController::class, 'showPramuwisata'])->name('direktori.show');

Route::get('/hubungi-kami', function () {
    return view('kontak'); 
});

// ==========================================
// 2. RUTE ADMIN (WAJIB LOGIN)
// ==========================================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Root redirect ke dashboard
    Route::get('/', fn() => redirect()->route('admin.dashboard'));

    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Destinasi Wisata
    Route::resource('destinasi', \App\Http\Controllers\Admin\DestinasiController::class);

    // Kategori Destinasi
    Route::resource('kategori-destinasi', \App\Http\Controllers\Admin\KategoriDestinasiController::class)
         ->parameters(['kategori-destinasi' => 'kategori_id']);
    
    // --- KODINGAN MAS (TAMBAHKAN INI DI BAWAHNYA) ---
    // --- KODINGAN MAS ---
    Route::get('/settings', [\App\Http\Controllers\Admin\WebSettingController::class, 'edit'])->name('settings.index');
    Route::put('/settings', [\App\Http\Controllers\Admin\WebSettingController::class, 'update'])->name('settings.update');
    Route::resource('ulasan', \App\Http\Controllers\Admin\UlasanController::class)->except(['create', 'store', 'show']);
    // --- RUTE BARU: FAQ ---
    Route::resource('faq', \App\Http\Controllers\Admin\FaqController::class);
    Route::resource('layanan', \App\Http\Controllers\Admin\LayananController::class);
    Route::resource('keunggulan', \App\Http\Controllers\Admin\KeunggulanController::class);
    Route::resource('alur-reservasi', \App\Http\Controllers\Admin\AlurReservasiController::class);
    Route::resource('visi-misi', \App\Http\Controllers\Admin\VisiMisiController::class);
    Route::resource('struktur-organisasi', \App\Http\Controllers\Admin\StrukturOrganisasiController::class);

    // Rute untuk Berita & Kegiatan
    Route::resource('berita', \App\Http\Controllers\Admin\KegiatanBeritaController::class)->parameters(['berita' => 'berita']);
    Route::resource('direktori', \App\Http\Controllers\Admin\PramuwisataController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});