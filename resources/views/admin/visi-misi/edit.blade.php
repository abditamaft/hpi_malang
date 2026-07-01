@extends('layouts.admin')

@section('title', 'Edit Visi & Misi')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
        <h2 class="text-lg font-bold text-gray-800 mb-6">Edit Visi / Misi</h2>

        <form action="{{ route('admin.visi-misi.update', $visimisi->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Tipe Data</label>
                    <select name="tipe" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" required>
                        <option value="Misi" {{ $visimisi->tipe == 'Misi' ? 'selected' : '' }}>Misi</option>
                        <option value="Visi" {{ $visimisi->tipe == 'Visi' ? 'selected' : '' }}>Visi</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Urutan (Khusus Misi)</label>
                    <input type="number" name="urutan" value="{{ $visimisi->urutan }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Judul (Bahasa Indonesia)</label>
                    <input type="text" name="judul_id" value="{{ $visimisi->judul_id }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Judul (English)</label>
                    <input type="text" name="judul_en" value="{{ $visimisi->judul_en }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi (Bahasa Indonesia)</label>
                    <textarea name="deskripsi_id" rows="4" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" required>{{ $visimisi->deskripsi_id }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi (English)</label>
                    <textarea name="deskripsi_en" rows="4" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" required>{{ $visimisi->deskripsi_en }}</textarea>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.visi-misi.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-2.5 px-6 rounded-xl transition">Batal</a>
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2.5 px-6 rounded-xl transition">Update Data</button>
            </div>
        </form>
    </div>
</div>
@endsection