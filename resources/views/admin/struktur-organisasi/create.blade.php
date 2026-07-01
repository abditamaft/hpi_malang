@extends('layouts.admin')

@section('title', 'Tambah Pengurus')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
        <h2 class="text-lg font-bold text-gray-800 mb-6">Tambah Anggota Organisasi</h2>

        @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
            <ul class="list-disc ml-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.struktur-organisasi.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Kategori Pengurus</label>
                    <select name="kategori_pengurus" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" required>
                        <option value="Pengurus Harian">Pengurus Harian</option>
                        <option value="Dewan Penasihat">Dewan Penasihat</option>
                        <option value="Dewan Kode Etik">Dewan Kode Etik</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" placeholder="Contoh: Budi Santoso, S.Par" required>
                </div>
            </div>

            <div id="form-detail-pengurus">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 mt-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Jabatan (Bahasa Indonesia)</label>
                        <input type="text" name="jabatan_id" value="{{ old('jabatan_id') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" placeholder="Contoh: Ketua / Sekretaris">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Jabatan (English)</label>
                        <input type="text" name="jabatan_en" value="{{ old('jabatan_en') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" placeholder="Contoh: Chairman / Secretary">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Divisi/Bidang (Bahasa Indonesia) - Opsional</label>
                        <input type="text" name="divisi_id" value="{{ old('divisi_id') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" placeholder="Contoh: Bidang Administrasi">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Divisi/Bidang (English) - Opsional</label>
                        <input type="text" name="divisi_en" value="{{ old('divisi_en') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" placeholder="Contoh: Administration Division">
                    </div>
                </div>
            </div>
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.struktur-organisasi.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-2.5 px-6 rounded-xl transition">Batal</a>
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2.5 px-6 rounded-xl transition">Simpan Data</button>
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
                // Wajib diisi saat muncul
                jabatanIdInput.required = true;
                jabatanEnInput.required = true;
            } else {
                detailForm.style.display = 'none';
                // Matikan required saat tersembunyi agar form bisa dikirim
                jabatanIdInput.required = false;
                jabatanEnInput.required = false;
            }
        }

        kategoriSelect.addEventListener('change', toggleForm);
        toggleForm(); // Eksekusi saat halaman pertama dimuat
    });
</script>
@endsection