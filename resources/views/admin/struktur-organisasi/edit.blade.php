@extends('layouts.admin')

@section('title', 'Edit Pengurus')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
        <h2 class="text-lg font-bold text-gray-800 mb-6">Edit Anggota Organisasi</h2>

        <form action="{{ route('admin.struktur-organisasi.update', $struktur->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Kategori Pengurus</label>
                    <select name="kategori_pengurus" id="kategori_pengurus" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" required>
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

            <!-- Upload Foto -->
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Foto Pengurus (Opsional)</label>
                @if($struktur->foto)
                    <div class="mb-3 flex items-center gap-4">
                        <img src="{{ asset('storage/' . $struktur->foto) }}" alt="Foto" class="w-20 h-20 rounded-xl object-cover border border-gray-200 shadow-sm">
                        <span class="text-xs text-emerald-600 font-bold bg-emerald-50 px-3 py-1 rounded-full">Foto Saat Ini</span>
                    </div>
                @endif
                <input type="file" name="foto" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500">
                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, WEBP. Maks 2MB. <b>Biarkan kosong jika tidak mengubah foto.</b></p>
            </div>

            <div id="form-detail-pengurus">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Jabatan (Bahasa Indonesia)</label>
                        <select name="jabatan_id" id="jabatan_id" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500">
                            <option value="">-- Pilih Jabatan --</option>
                            @php
                                $jabatanList = ['Ketua Umum', 'Wakil Ketua Umum', 'Sekretaris', 'Wakil Sekretaris', 'Bendahara', 'Wakil Bendahara', 'Seksi Organisasi', 'Seksi Litbang', 'Seksi Kesejahteraan', 'Seksi Humas'];
                            @endphp
                            @foreach($jabatanList as $jab)
                                <option value="{{ $jab }}" {{ $struktur->jabatan_id == $jab ? 'selected' : '' }}>{{ $jab }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Jabatan (English)</label>
                        <select name="jabatan_en" id="jabatan_en" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500 pointer-events-none bg-gray-100" readonly>
                            <option value="">-- Otomatis Terisi --</option>
                            @php
                                $jabatanEnList = ['General Chairman', 'Vice General Chairman', 'Secretary', 'Vice Secretary', 'Treasurer', 'Vice Treasurer', 'Organization Section', 'R&D Section', 'Welfare Section', 'Public Relations Section'];
                            @endphp
                            @foreach($jabatanEnList as $jabEn)
                                <option value="{{ $jabEn }}" {{ $struktur->jabatan_en == $jabEn ? 'selected' : '' }}>{{ $jabEn }}</option>
                            @endforeach
                        </select>
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
        const kategoriSelect = document.getElementById('kategori_pengurus');
        const detailForm = document.getElementById('form-detail-pengurus');
        const jabatanId = document.getElementById('jabatan_id');
        const jabatanEn = document.getElementById('jabatan_en');

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

        jabatanId.addEventListener('change', function() {
            if(this.value && translationMap[this.value]) {
                jabatanEn.value = translationMap[this.value];
            } else {
                jabatanEn.value = "";
            }
        });

        function toggleForm() {
            if (kategoriSelect.value === 'Pengurus Harian') {
                detailForm.style.display = 'block';
                jabatanId.required = true;
            } else {
                detailForm.style.display = 'none';
                jabatanId.required = false;
            }
        }

        kategoriSelect.addEventListener('change', toggleForm);
        toggleForm(); 
    });
</script>
@endsection