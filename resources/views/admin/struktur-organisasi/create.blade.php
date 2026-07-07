@extends('layouts.admin')

@section('title', 'Tambah Pengurus')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
        <h2 class="text-lg font-bold text-gray-800 mb-6">Tambah Anggota Organisasi</h2>

        <form action="{{ route('admin.struktur-organisasi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Kategori Pengurus</label>
                    <select name="kategori_pengurus" id="kategori_pengurus" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" required>
                        <option value="Pengurus Harian">Pengurus Harian</option>
                        <option value="Dewan Penasihat">Dewan Penasihat</option>
                        <option value="Dewan Kode Etik">Dewan Kode Etik</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" required>
                </div>
            </div>

            <!-- Upload Foto -->
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Foto Pengurus (Opsional)</label>
                <input type="file" name="foto" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500">
                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, WEBP. Maks 2MB. Saran: Gunakan foto rasio 1:1 (persegi).</p>
            </div>

            <div id="form-detail-pengurus">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Jabatan (Bahasa Indonesia)</label>
                        <select name="jabatan_id" id="jabatan_id" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500">
                            <option value="">-- Pilih Jabatan --</option>
                            <option value="Ketua Umum">Ketua Umum</option>
                            <option value="Wakil Ketua Umum">Wakil Ketua Umum</option>
                            <option value="Sekretaris">Sekretaris</option>
                            <option value="Wakil Sekretaris">Wakil Sekretaris</option>
                            <option value="Bendahara">Bendahara</option>
                            <option value="Wakil Bendahara">Wakil Bendahara</option>
                            <option value="Seksi Organisasi">Seksi Organisasi</option>
                            <option value="Seksi Litbang">Seksi Litbang</option>
                            <option value="Seksi Kesejahteraan">Seksi Kesejahteraan</option>
                            <option value="Seksi Humas">Seksi Humas</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Jabatan (English)</label>
                        <select name="jabatan_en" id="jabatan_en" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500 pointer-events-none bg-gray-100" readonly>
                            <option value="">-- Otomatis Terisi --</option>
                            <option value="General Chairman">General Chairman</option>
                            <option value="Vice General Chairman">Vice General Chairman</option>
                            <option value="Secretary">Secretary</option>
                            <option value="Vice Secretary">Vice Secretary</option>
                            <option value="Treasurer">Treasurer</option>
                            <option value="Vice Treasurer">Vice Treasurer</option>
                            <option value="Organization Section">Organization Section</option>
                            <option value="R&D Section">R&D Section</option>
                            <option value="Welfare Section">Welfare Section</option>
                            <option value="Public Relations Section">Public Relations Section</option>
                        </select>
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
        const kategoriSelect = document.getElementById('kategori_pengurus');
        const detailForm = document.getElementById('form-detail-pengurus');
        const jabatanId = document.getElementById('jabatan_id');
        const jabatanEn = document.getElementById('jabatan_en');

        // Mapping terjemahan jabatan
        const translationMap = {
            "Ketua Umum": "General Chairman",
            "Wakil Ketua Umum": "Vice General Chairman",
            "Sekretaris": "Secretary",
            "Wakil Sekretaris": "Vice Secretary",
            "Bendahara": "Treasurer",
            "Wakil Bendahara": "Vice Treasurer",
            "Seksi Organisasi": "Organization Section",
            "Seksi Litbang": "R&D Section",
            "Seksi Kesejahteraan": "Welfare Section",
            "Seksi Humas": "Public Relations Section"
        };

        // Auto translate dropdown
        jabatanId.addEventListener('change', function() {
            if(this.value && translationMap[this.value]) {
                jabatanEn.value = translationMap[this.value];
            } else {
                jabatanEn.value = "";
            }
        });

        // Toggle form detail
        function toggleForm() {
            if (kategoriSelect.value === 'Pengurus Harian') {
                detailForm.style.display = 'block';
                jabatanId.required = true;
            } else {
                detailForm.style.display = 'none';
                jabatanId.required = false;
                jabatanId.value = "";
                jabatanEn.value = "";
            }
        }

        kategoriSelect.addEventListener('change', toggleForm);
        toggleForm(); 
    });
</script>
@endsection