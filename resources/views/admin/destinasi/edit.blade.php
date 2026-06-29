@extends('layouts.admin')

@section('content')
<div class="bg-white shadow rounded-lg p-6 max-w-4xl mx-auto">
    <div class="mb-6 border-b pb-4 flex items-center justify-between">
        <h2 class="text-xl font-bold text-gray-800">Edit Destinasi</h2>
        <a href="{{ route('admin.destinasi.index') }}" class="text-gray-500 hover:text-gray-700 font-medium text-sm">&larr; Kembali</a>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.destinasi.update', $destinasi->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Tipe Card --}}
        <div class="bg-amber-50 border border-amber-200 rounded-lg p-4">
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="checkbox" name="is_unggulan" value="1"
                    {{ old('is_unggulan', $destinasi->is_unggulan) ? 'checked' : '' }}
                    class="w-5 h-5 rounded border-gray-300 text-amber-500 focus:ring-amber-400 cursor-pointer">
                <div>
                    <span class="font-semibold text-gray-800 text-sm">⭐ Jadikan Destinasi Unggulan</span>
                    <p class="text-xs text-gray-500 mt-0.5">Card unggulan tampil lebih besar (2/3 lebar halaman) dengan layout gambar kiri + teks kanan. Card biasa tampil 1/3 lebar.</p>
                </div>
            </label>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Kolom ID -->
            <div class="space-y-4">
                <h3 class="font-semibold text-gray-700 bg-gray-50 p-2 rounded">Bahasa Indonesia</h3>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Destinasi (ID)</label>
                    <input type="text" name="nama_destinasi_id" value="{{ old('nama_destinasi_id', $destinasi->nama_destinasi_id) }}"
                        class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori (ID)</label>
                    <select name="kategori_id" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Pilih Kategori...</option>
                        @foreach($kategori as $kat)
                            <option value="{{ $kat->kategori_id }}"
                                {{ old('kategori_id', $destinasi->kategori_id) == $kat->kategori_id ? 'selected' : '' }}>
                                {{ $kat->kategori_id }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat (ID)</label>
                    <textarea name="deskripsi_id" rows="4"
                        class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-blue-500 focus:border-blue-500" required>{{ old('deskripsi_id', $destinasi->deskripsi_id) }}</textarea>
                </div>
            </div>

            <!-- Kolom EN -->
            <div class="space-y-4">
                <h3 class="font-semibold text-gray-700 bg-gray-50 p-2 rounded">English</h3>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Destination Name (EN)</label>
                    <input type="text" name="nama_destinasi_en" value="{{ old('nama_destinasi_en', $destinasi->nama_destinasi_en) }}"
                        class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category (EN)</label>
                    <select name="kategori_en" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select Category...</option>
                        @foreach($kategori as $kat)
                            <option value="{{ $kat->kategori_en }}"
                                {{ old('kategori_en', $destinasi->kategori_en) == $kat->kategori_en ? 'selected' : '' }}>
                                {{ $kat->kategori_en }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Short Description (EN)</label>
                    <textarea name="deskripsi_en" rows="4"
                        class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-blue-500 focus:border-blue-500">{{ old('deskripsi_en', $destinasi->deskripsi_en) }}</textarea>
                </div>
            </div>
        </div>

        <div class="border-t pt-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Destinasi</label>
            @if($destinasi->url_gambar)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $destinasi->url_gambar) }}" class="h-32 w-48 object-cover rounded shadow">
                    <p class="text-xs text-gray-500 mt-1">Gambar saat ini</p>
                </div>
            @endif
            <input type="file" name="url_gambar" accept="image/*"
                class="w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500">
            <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah gambar. Format: JPG, PNG, WEBP. Maks: 2MB.</p>
        </div>

        <div class="flex justify-end pt-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow">
                Perbarui Destinasi
            </button>
        </div>
    </form>
</div>
@endsection
