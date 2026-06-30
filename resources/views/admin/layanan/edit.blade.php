@extends('layouts.admin')

@section('title', 'Edit Layanan')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
        <h2 class="text-lg font-bold text-gray-800 mb-6">Edit Layanan</h2>

        @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
            <ul class="list-disc ml-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.layanan.update', $layanan->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nama Layanan (Bahasa Indonesia)</label>
                    <input type="text" name="nama_layanan_id" value="{{ old('nama_layanan_id', $layanan->nama_layanan_id) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nama Layanan (English)</label>
                    <input type="text" name="nama_layanan_en" value="{{ old('nama_layanan_en', $layanan->nama_layanan_en) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi (Bahasa Indonesia)</label>
                    <textarea name="deskripsi_id" rows="4" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" required>{{ old('deskripsi_id', $layanan->deskripsi_id) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi (English)</label>
                    <textarea name="deskripsi_en" rows="4" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" required>{{ old('deskripsi_en', $layanan->deskripsi_en) }}</textarea>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Gambar Layanan</label>
                    <input type="file" name="url_gambar" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-emerald-500" accept="image/*">
                    <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengubah gambar.</p>
                    
                    @if($layanan->url_gambar)
                        <div class="mt-3">
                            <span class="text-xs text-gray-500 block mb-1">Gambar saat ini:</span>
                            <img src="{{ asset('storage/' . $layanan->url_gambar) }}" alt="{{ $layanan->nama_layanan_id }}" class="w-24 h-24 object-cover rounded-lg border border-gray-200">
                        </div>
                    @endif
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Ikon (Opsional)</label>
                    <input type="text" name="ikon" value="{{ old('ikon', $layanan->ikon) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500">
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.layanan.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-2.5 px-6 rounded-xl transition">Batal</a>
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2.5 px-6 rounded-xl transition">Perbarui Layanan</button>
            </div>
        </form>
    </div>
</div>
@endsection
