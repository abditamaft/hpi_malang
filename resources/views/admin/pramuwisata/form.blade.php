@php $item = $item ?? null; @endphp

@if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
        <ul class="list-disc list-inside text-sm">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <div class="md:col-span-2">
        <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
        <input type="text" name="nama_lengkap" required value="{{ old('nama_lengkap', $item?->nama_lengkap) }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
    </div>

    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">No. Lisensi</label>
        <input type="text" name="no_lisensi" value="{{ old('no_lisensi', $item?->no_lisensi) }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
    </div>

    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Exp. Lisensi</label>
        <input type="month" name="masa_berlaku_lisensi" value="{{ old('masa_berlaku_lisensi', $item?->masa_berlaku_lisensi?->format('Y-m')) }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
    </div>

    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">No. KTAN</label>
        <input type="text" name="no_ktan" value="{{ old('no_ktan', $item?->no_ktan) }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
    </div>

    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Exp. KTAN</label>
        <input type="month" name="masa_berlaku_ktan" value="{{ old('masa_berlaku_ktan', $item?->masa_berlaku_ktan?->format('Y-m')) }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
    </div>

    {{-- field sertif tambahan, bahasa,jenis wisata, spesialisasi, tipe wisatawan,keahlian lain, asal wisatawan --}}

    @include('admin.pramuwisata.field', [
        'field' => 'sertifikasi_tambahan',
        'label' => 'Sertifikasi Tambahan',
        'placeholderId' => 'mis. Tour Leader (ID)',
        'placeholderEn' => 'mis. Tour Leader (EN)',
        'nilaiAwal' => old('sertifikasi_tambahan', $item?->sertifikasi_tambahan ?: [['id' => '', 'en' => '']]),
        'datalistId' => 'daftar-sertifikasi_tambahan-id',
        'datalistEn' => 'daftar-sertifikasi_tambahan-en',
    ])

    @include('admin.pramuwisata.field', [
        'field' => 'bahasa',
        'label' => 'Bahasa',
        'placeholderId' => 'mis. Indonesia (ID)',
        'placeholderEn' => 'mis. Indonesian (EN)',
        'nilaiAwal' => old('bahasa', $item?->bahasa ?: [['id' => '', 'en' => '']]),
        'datalistId' => 'daftar-bahasa-id',
        'datalistEn' => 'daftar-bahasa-en',
    ])

    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Bhs. Utama (Indonesia)</label>
        <input type="text" name="bahasa_utama_id" placeholder="mis. Indonesia" list="daftar-bahasa-id"
                value="{{ old('bahasa_utama_id', $item?->bahasa_utama_id) }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
    </div>

    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Bhs. Utama (English)</label>
        <input type="text" name="bahasa_utama_en" placeholder="mis. Indonesian" list="daftar-bahasa-en"
                value="{{ old('bahasa_utama_en', $item?->bahasa_utama_en) }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
    </div>

    @include('admin.pramuwisata.field', [
        'field' => 'jenis_wisata',
        'label' => 'Jenis Wisata',
        'placeholderId' => 'mis. Alam (ID)',
        'placeholderEn' => 'mis. Nature (EN)',
        'nilaiAwal' => old('jenis_wisata', $item?->jenis_wisata ?: [['id' => '', 'en' => '']]),
        'datalistId' => 'daftar-jenis_wisata-id',
        'datalistEn' => 'daftar-jenis_wisata-en',
    ])

    @include('admin.pramuwisata.field', [
        'field' => 'spesialisasi',
        'label' => 'Spesialisasi',
        'placeholderId' => 'mis. MICE (ID)',
        'placeholderEn' => 'mis. MICE (EN)',
        'nilaiAwal' => old('spesialisasi', $item?->spesialisasi ?: [['id' => '', 'en' => '']]),
        'datalistId' => 'daftar-spesialisasi-id',
        'datalistEn' => 'daftar-spesialisasi-en',
    ])

    @include('admin.pramuwisata.field', [
        'field' => 'tipe_wisatawan',
        'label' => 'Tipe Wisatawan',
        'placeholderId' => 'mis. Domestik (ID)',
        'placeholderEn' => 'mis. Domestic (EN)',
        'nilaiAwal' => old('tipe_wisatawan', $item?->tipe_wisatawan ?: [['id' => '', 'en' => '']]),
        'datalistId' => 'daftar-tipe_wisatawan-id',
        'datalistEn' => 'daftar-tipe_wisatawan-en',
    ])

    @include('admin.pramuwisata.field', [
        'field' => 'keahlian_lain',
        'label' => 'Keahlian Lain',
        'placeholderId' => 'mis. Outbound Trainer (ID)',
        'placeholderEn' => 'mis. Outbound Trainer (EN)',
        'nilaiAwal' => old('keahlian_lain', $item?->keahlian_lain ?: [['id' => '', 'en' => '']]),
        'datalistId' => 'daftar-keahlian_lain-id',
        'datalistEn' => 'daftar-keahlian_lain-en',
    ])

    @include('admin.pramuwisata.field', [
        'field' => 'asal_wisatawan',
        'label' => 'Asal Wisatawan',
        'placeholderId' => 'mis. Eropa (ID)',
        'placeholderEn' => 'mis. Europe (EN)',
        'nilaiAwal' => old('asal_wisatawan', $item?->asal_wisatawan ?: [['id' => '', 'en' => '']]),
        'datalistId' => 'daftar-asal_wisatawan-id',
        'datalistEn' => 'daftar-asal_wisatawan-en',
    ])

    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Aktif Sejak (Tahun)</label>
        <input type="number" name="aktif_sejak" min="1900" max="{{ date('Y') + 1 }}" placeholder="mis. 2005"
                value="{{ old('aktif_sejak', $item?->aktif_sejak) }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm font-semibold text-gray-700 mb-1">Bio (Indonesia)</label>
        <textarea name="bio_id" rows="5" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">{{ old('bio_id', $item?->bio_id) }}</textarea>
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm font-semibold text-gray-700 mb-1">Bio (English)</label>
        <textarea name="bio_en" rows="5" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">{{ old('bio_en', $item?->bio_en) }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Foto Profil</label>
        <input type="file" name="foto_profil" accept="image/*" class="w-full text-sm">
        @if($item?->foto_profil)
            <img src="{{ asset('storage/' . $item->foto_profil) }}" class="h-20 w-20 object-cover rounded-full mt-2 shadow">
        @endif
    </div>

    <div class="flex flex-col justify-center gap-3">
        <label class="flex items-center gap-2">
            <input type="checkbox" name="is_tersertifikasi" value="1" {{ old('is_tersertifikasi', $item?->is_tersertifikasi) ? 'checked' : '' }}
                    class="rounded border-gray-300 text-amber-600 focus:ring-amber-500">
            <span class="text-sm font-semibold text-gray-700">Tersertifikasi</span>
        </label>

        <label class="flex items-center gap-2">
            <input type="checkbox" name="status" value="1" {{ old('status', $item?->status ?? true) ? 'checked' : '' }}
                    class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
            <span class="text-sm font-semibold text-gray-700">Aktif (tampil di direktori publik)</span>
        </label>
    </div>
</div>

<div class="mt-10 pt-8 border-t border-gray-200">
    <h3 class="text-lg font-bold text-gray-800 mb-1">Portofolio</h3>
    <p class="text-sm text-gray-500 mb-5">Kumpulan foto kegiatan/hasil kerja pemandu, ditampilkan di halaman detail profil publik.</p>

    @if($item && $item->portofolio->isNotEmpty())
        <div class="mb-6">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-3">Portofolio Tersimpan</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4" x-data="{ hapus: [] }">
                @foreach($item->portofolio as $p)
                    <div class="border border-gray-200 rounded-lg overflow-hidden" x-show="!hapus.includes({{ $p->id }})">
                        <img src="{{ asset('storage/' . $p->url_gambar) }}" class="w-full aspect-video object-cover">
                        <div class="p-3 space-y-2">
                            <input type="text" name="portofolio_lama[{{ $p->id }}][keterangan_id]" value="{{ old('portofolio_lama.' . $p->id . '.keterangan_id', $p->keterangan_id) }}"
                                    placeholder="Keterangan (Indonesia)"
                                    class="w-full text-sm border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
                            <input type="text" name="portofolio_lama[{{ $p->id }}][keterangan_en]" value="{{ old('portofolio_lama.' . $p->id . '.keterangan_en', $p->keterangan_en) }}"
                                    placeholder="Keterangan (English)"
                                    class="w-full text-sm border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">

                            <label class="flex items-center gap-2 text-xs text-red-500 font-semibold cursor-pointer pt-1">
                                <input type="checkbox" name="hapus_portofolio[]" value="{{ $p->id }}"
                                        @change="$event.target.checked ? hapus.push({{ $p->id }}) : hapus = hapus.filter(x => x !== {{ $p->id }})"
                                        class="rounded border-gray-300 text-red-500 focus:ring-red-500">
                                Hapus foto ini
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div x-data="{ rows: [{ id: Date.now() }] }">
        <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-3">Tambah Portofolio Baru</p>

        <template x-for="(row, index) in rows" :key="row.id">
            <div class="flex flex-col sm:flex-row gap-2 mb-3 border border-gray-200 rounded-lg p-3">
                <input type="file" :name="'portofolio_baru[' + index + '][gambar]'" accept="image/*"
                        class="w-full sm:w-56 text-xs flex-shrink-0 self-center">
                <textarea :name="'portofolio_baru[' + index + '][keterangan_id]'" 
                        placeholder="Keterangan (Indonesia)"
                        class="w-full text-sm h-24 border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500"></textarea>
                <textarea :name="'portofolio_baru[' + index + '][keterangan_en]'" 
                        placeholder="Keterangan (English)"
                        class="w-full text-sm h-24 border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500"></textarea>
                <button type="button" @click="rows.length > 1 ? rows.splice(index, 1) : null"
                        class="flex-shrink-0 text-red-500 hover:text-red-700 px-2 self-center" title="Hapus baris">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            </div>
        </template>

        <button type="button" @click="rows.push({ id: Date.now() })"
                class="text-emerald-700 hover:text-emerald-800 text-sm font-semibold inline-flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Foto Portofolio
        </button>
    </div>
</div>

<div class="mt-8 flex gap-3">
    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-6 rounded">
        Simpan
    </button>
    <a href="{{ route('admin.direktori.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-2 px-6 rounded">
        Batal
    </a>
</div>

@foreach(['sertifikasi_tambahan', 'bahasa', 'jenis_wisata', 'spesialisasi', 'tipe_wisatawan', 'keahlian_lain', 'asal_wisatawan'] as $kolom)
    <datalist id="daftar-{{ $kolom }}-id">
        @foreach((${$kolom . 'Id'}) ?? [] as $nilai)
            <option value="{{ $nilai }}">
        @endforeach
    </datalist>
    <datalist id="daftar-{{ $kolom }}-en">
        @foreach((${$kolom . 'En'}) ?? [] as $nilai)
            <option value="{{ $nilai }}">
        @endforeach
    </datalist>
@endforeach
<datalist id="daftar-wilayah-operasi">
    @foreach($wilayahOperasi ?? [] as $nilai)
        <option value="{{ $nilai }}">
    @endforeach
</datalist>
