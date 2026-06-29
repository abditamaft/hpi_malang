@extends('layouts.admin')
@section('title', 'Dashboard Utama')

@section('content')
<div class="mb-8">
    <h2 class="text-2xl font-bold text-gray-800">Ringkasan Sistem</h2>
    <p class="text-gray-500 text-sm mt-1">Pantau aktivitas dan metrik utama website HPI Malang hari ini.</p>
</div>

<!-- Card Statistik -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    
    <!-- Total Anggota -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
        <div>
            <p class="text-sm font-bold text-gray-400 uppercase tracking-wide">Pramuwisata</p>
            <h3 class="text-3xl font-extrabold text-gray-800 mt-1">{{\App\Models\Pramuwisata::count()}}</h3>
        </div>
        <div class="w-12 h-12 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl">
            👤
        </div>
    </div>

    <!-- Ulasan Pending -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
        <div>
            <p class="text-sm font-bold text-gray-400 uppercase tracking-wide">Ulasan Baru</p>
            <h3 class="text-3xl font-extrabold text-gray-800 mt-1">{{\App\Models\Ulasan::where('status', 'Pending')->count()}}</h3>
        </div>
        <div class="w-12 h-12 rounded-full bg-orange-50 text-orange-500 flex items-center justify-center text-2xl">
            ⭐
        </div>
    </div>

    <!-- Total Berita -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
        <div>
            <p class="text-sm font-bold text-gray-400 uppercase tracking-wide">Artikel Berita</p>
            <h3 class="text-3xl font-extrabold text-gray-800 mt-1">{{\App\Models\KegiatanBerita::where('tipe', 'Berita')->count()}}</h3>
        </div>
        <div class="w-12 h-12 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center text-2xl">
            📰
        </div>
    </div>

    <!-- Total Agenda -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
        <div>
            <p class="text-sm font-bold text-gray-400 uppercase tracking-wide">Agenda Kegiatan</p>
            <h3 class="text-3xl font-extrabold text-gray-800 mt-1">{{\App\Models\KegiatanBerita::where('tipe', 'Kegiatan')->count()}}</h3>
        </div>
        <div class="w-12 h-12 rounded-full bg-purple-50 text-purple-600 flex items-center justify-center text-2xl">
            📅
        </div>
    </div>
</div>

<!-- Informasi Tambahan (Bisa diisi tabel ulasan terbaru nantinya) -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    <h3 class="text-lg font-bold text-gray-800 mb-4">Pemberitahuan Sistem</h3>
    <div class="bg-emerald-50 border border-emerald-100 text-emerald-800 px-4 py-3 rounded-xl text-sm">
        Selamat datang di CMS HPI Malang. Gunakan menu di sidebar sebelah kiri untuk mulai mengelola konten website.
    </div>
</div>
@endsection
