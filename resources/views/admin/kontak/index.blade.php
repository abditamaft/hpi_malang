@extends('layouts.admin')

@section('title', 'Manajemen Kontak')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-800">Manajemen Informasi Kontak</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola nomor telepon, email, dan alamat kantor yang akan tampil di halaman Beranda dan Tentang Kami.</p>
        </div>

        @if(session('success'))
        <div class="mb-6 bg-emerald-50 text-emerald-700 px-4 py-3 rounded-xl border border-emerald-200 text-sm font-medium">
            {{ session('success') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
            <ul class="list-disc ml-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.kontak.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nomor Telepon / WhatsApp</label>
                    <input type="text" name="telepon" value="{{ old('telepon', $kontak->telepon ?? '') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" placeholder="Contoh: +62 8133 1882 889" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email', $kontak->email ?? '') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" placeholder="Contoh: hpimalang21@gmail.com" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Kantor (Bahasa Indonesia)</label>
                    <textarea name="alamat_id" rows="4" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" placeholder="Masukkan alamat lengkap dalam bahasa Indonesia..." required>{{ old('alamat_id', $kontak->alamat_id ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Kantor (English)</label>
                    <textarea name="alamat_en" rows="4" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" placeholder="Enter full address in English..." required>{{ old('alamat_en', $kontak->alamat_en ?? '') }}</textarea>
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-gray-100">
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2.5 px-8 rounded-xl transition shadow-sm hover:shadow-md">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection