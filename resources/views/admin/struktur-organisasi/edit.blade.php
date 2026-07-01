@extends('layouts.admin')

@section('title', 'Edit Pengurus')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
        <h2 class="text-lg font-bold text-gray-800 mb-6">Edit Anggota Organisasi</h2>

        <form action="{{ route('admin.struktur-organisasi.update', $struktur->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Kategori Pengurus</label>
                    <select name="kategori_pengurus" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" required>
                        <option value="Pengurus Harian" {{ $struktur->kategori_pengurus == 'Pengurus Harian' ? 'selected' : '' }}>Pengurus Harian</option>
                        <option value="Dewan Penasihat" {{ $struktur->kategori_pengurus == 'Dewan Penasihat' ? 'selected' : '' }}>Dewan Penasihat</option>
                        <option value="Dewan Kode Etik" {{ $struktur->kategori_pengurus == 'Dewan Kode Etik' ? 'selected' : '' }}>Dewan Kode Etik</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ $struktur->nama }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" required>
                </div>
            </div>

            <div id="form-detail-pengurus">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 mt-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Jabatan (Bahasa Indonesia)</label>
                        <input type="text" name="jabatan_id" value="{{ $struktur->jabatan_id == '-' ? '' : $struktur->jabatan_id }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Jabatan (English)</label>
                        <input type="text" name="jabatan_en" value="{{ $struktur->jabatan_en == '-' ? '' : $struktur->jabatan_en }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Divisi/Bidang (Bahasa Indonesia) - Opsional</label>
                        <input type="text" name="divisi_id" value="{{ $struktur->divisi_id }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Divisi/Bidang (English) - Opsional</label>
                        <input type="text" name="divisi_en" value="{{ $struktur->divisi_en }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500">
                    </div>
                </div>
            </div>
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.struktur-organisasi.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-2.5 px-6 rounded-xl transition">Batal</a>
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2.5 px-6 rounded-xl transition">Update Data</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const kategoriSelect = document.querySelector('select[name="kategori_pengurus"]');
        const detailForm = document.getElementById('form-detail-pengurus');
        const jabatanIdInput = document.querySelector('input[name="jabatan_id"]');
        const jabatanEnInput = document.querySelector('input[name="jabatan_en"]');

        function toggleForm() {
            if (kategoriSelect.value === 'Pengurus Harian') {
                detailForm.style.display = 'block';
                jabatanIdInput.required = true;
                jabatanEnInput.required = true;
            } else {
                detailForm.style.display = 'none';
                jabatanIdInput.required = false;
                jabatanEnInput.required = false;
            }
        }

        kategoriSelect.addEventListener('change', toggleForm);
        toggleForm(); // Eksekusi saat halaman pertama dimuat
    });
</script>
@endsection