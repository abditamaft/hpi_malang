@extends('layouts.admin')

@section('title', 'Tambah Layanan')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
        <h2 class="text-lg font-bold text-gray-800 mb-6">Tambah Layanan Baru</h2>

        @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
            <ul class="list-disc ml-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.layanan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nama Layanan (Bahasa Indonesia)</label>
                    <input type="text" name="nama_layanan_id" value="{{ old('nama_layanan_id') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" placeholder="Contoh: Pemandu Wisata Gunung" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nama Layanan (English)</label>
                    <input type="text" name="nama_layanan_en" value="{{ old('nama_layanan_en') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" placeholder="Contoh: Mountain Tour Guide" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi (Bahasa Indonesia)</label>
                    <textarea name="deskripsi_id" rows="4" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" placeholder="Tulis deskripsi layanan..." required>{{ old('deskripsi_id') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi (English)</label>
                    <textarea name="deskripsi_en" rows="4" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" placeholder="Write service description in English..." required>{{ old('deskripsi_en') }}</textarea>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Gambar Layanan</label>
                    <input type="file" name="url_gambar" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-emerald-500" accept="image/*" required>
                    <p class="text-xs text-gray-400 mt-1">Format: jpeg, png, jpg, webp. Maksimal 2MB.</p>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Ikon (Opsional)</label>
                    <input type="text" name="ikon" value="{{ old('ikon') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" placeholder="Contoh: ⛰️ atau fa-mountain">
                    <p class="text-xs text-gray-400 mt-1">Untuk ikon kecil di beranda.</p>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.layanan.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-2.5 px-6 rounded-xl transition">Batal</a>
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2.5 px-6 rounded-xl transition">Simpan Layanan</button>
            </div>
        </form>
    </div>
</div>
@endsection
