@extends('layouts.admin')

@section('title', 'Kurasi Ulasan')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
        <h2 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
            Kurasi & Terjemahkan Ulasan
        </h2>

        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 mb-6">
            <div class="grid grid-cols-2 gap-4 mb-3 text-sm">
                <div>
                    <span class="block text-gray-500 text-xs font-bold uppercase">Nama Pengirim</span>
                    <span class="font-bold text-gray-800">{{ $ulasan->nama_lengkap }}</span>
                </div>
                <div>
                    <span class="block text-gray-500 text-xs font-bold uppercase">Asal Daerah</span>
                    <span class="font-bold text-gray-800">{{ $ulasan->asal_daerah }}</span>
                </div>
            </div>
            <div>
                <span class="block text-gray-500 text-xs font-bold uppercase mb-1">Komentar Asli (Indonesia)</span>
                <p class="text-gray-700 text-sm italic">"{{ $ulasan->komentar_id }}"</p>
            </div>
        </div>

        <form action="{{ route('admin.ulasan.update', $ulasan->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Terjemahan (English)</label>
                <textarea rows="4" name="komentar_en" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" placeholder="Masukkan terjemahan komentar di sini...">{{ $ulasan->komentar_en }}</textarea>
                <p class="text-xs text-gray-500 mt-1">Wajib diisi agar ulasan tampil maksimal saat pengunjung mengubah bahasa website.</p>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Status Publikasi</label>
                <select name="status" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500">
                    <option value="Pending" {{ $ulasan->status == 'Pending' ? 'selected' : '' }}>Pending (Disembunyikan)</option>
                    <option value="Approved" {{ $ulasan->status == 'Approved' ? 'selected' : '' }}>Approved (Tampilkan di Beranda)</option>
                    <option value="Rejected" {{ $ulasan->status == 'Rejected' ? 'selected' : '' }}>Rejected (Ditolak/Spam)</option>
                </select>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.ulasan.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-2.5 px-6 rounded-xl transition">Batal</a>
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2.5 px-6 rounded-xl transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection