@extends('layouts.admin')

@section('title', 'Edit Keunggulan')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
        <h2 class="text-lg font-bold text-gray-800 mb-6">Edit Keunggulan HPI</h2>

        <form action="{{ route('admin.keunggulan.update', $keunggulan->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Ikon (Teks / Emoji / HTML)</label>
                <div class="flex gap-4 items-center">
                    <div class="w-12 h-12 bg-emerald-50 text-emerald-600 flex items-center justify-center rounded-xl text-2xl border border-emerald-100">
                        {!! $keunggulan->ikon !!}
                    </div>
                    <input type="text" name="ikon" value="{{ $keunggulan->ikon }}" class="flex-1 bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500">
                </div>
                <p class="text-xs text-gray-500 mt-2">Masukkan emoji menggunakan keyboard HP/Windows (Win + .), atau masukkan class HTML ikon.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Judul (Bahasa Indonesia)</label>
                    <input type="text" name="judul_id" value="{{ $keunggulan->judul_id }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Judul (English)</label>
                    <input type="text" name="judul_en" value="{{ $keunggulan->judul_en }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi (Bahasa Indonesia)</label>
                    <textarea name="deskripsi_id" rows="4" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" required>{{ $keunggulan->deskripsi_id }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi (English)</label>
                    <textarea name="deskripsi_en" rows="4" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" required>{{ $keunggulan->deskripsi_en }}</textarea>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.keunggulan.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-2.5 px-6 rounded-xl transition">Batal</a>
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2.5 px-6 rounded-xl transition">Update Data</button>
            </div>
        </form>
    </div>
</div>
@endsection