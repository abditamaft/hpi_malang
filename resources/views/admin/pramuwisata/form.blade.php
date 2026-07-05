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
        <label class="block text-sm font-semibold text-gray-700 mb-1">Masa Berlaku Lisensi</label>
        <input type="date" name="masa_berlaku_lisensi" value="{{ old('masa_berlaku_lisensi', $item?->masa_berlaku_lisensi?->format('Y-m-d')) }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
    </div>

    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">No. KTAN</label>
        <input type="text" name="no_ktan" value="{{ old('no_ktan', $item?->no_ktan) }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
    </div>

    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Masa Berlaku KTAN</label>
        <input type="date" name="masa_berlaku_ktan" value="{{ old('masa_berlaku_ktan', $item?->masa_berlaku_ktan?->format('Y-m-d')) }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
    </div>

    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Aktif Sejak</label>
        <input type="date" name="aktif_sejak" value="{{ old('aktif_sejak', $item?->aktif_sejak?->format('Y-m-d')) }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
    </div>

    <div class="md:col-span-2" x-data="{
            rows: {{ old('bahasa') ? json_encode(old('bahasa')) : json_encode($item?->bahasa ?: [['id' => '', 'en' => '']]) }}
            }">
        <label class="block text-sm font-semibold text-gray-700 mb-2">Kemampuan Bahasa</label>

        <template x-for="(row, index) in rows" :key="index">
            <div class="flex gap-2 mb-2">
                <input type="text" :name="'bahasa[' + index + '][id]'" x-model="row.id" placeholder="Bahasa (Indonesia), mis. Indonesia" required
                        list="daftar-bahasa-id"
                        class="w-full border-gray-300 rounded-lg shadow-sm text-sm focus:ring-emerald-500 focus:border-emerald-500">
                <input type="text" :name="'bahasa[' + index + '][en]'" x-model="row.en" placeholder="Bahasa (English), mis. Indonesian" required
                        list="daftar-bahasa-en"
                        class="w-full border-gray-300 rounded-lg shadow-sm text-sm focus:ring-emerald-500 focus:border-emerald-500">
                <button type="button" @click="rows.length > 1 ? rows.splice(index, 1) : null"
                        class="flex-shrink-0 text-red-500 hover:text-red-700 px-2" title="Hapus baris">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            </div>
        </template>

        <button type="button" @click="rows.push({ id: '', en: '' })"
                class="text-emerald-700 hover:text-emerald-800 text-sm font-semibold inline-flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Bahasa
        </button>
    </div>

    <div class="md:col-span-2" x-data="{
            rows: {{ old('spesialisasi') ? json_encode(old('spesialisasi')) : json_encode($item?->spesialisasi ?: [['id' => '', 'en' => '']]) }}
            }">
        <label class="block text-sm font-semibold text-gray-700 mb-2">Spesialisasi</label>

        <template x-for="(row, index) in rows" :key="index">
            <div class="flex gap-2 mb-2">
                <input type="text" :name="'spesialisasi[' + index + '][id]'" x-model="row.id" placeholder="Spesialisasi (Indonesia), mis. Alam" required
                        list="daftar-spesialisasi-id"
                        class="w-full border-gray-300 rounded-lg shadow-sm text-sm focus:ring-emerald-500 focus:border-emerald-500">
                <input type="text" :name="'spesialisasi[' + index + '][en]'" x-model="row.en" placeholder="Spesialisasi (English), mis. Nature" required
                        list="daftar-spesialisasi-en"
                        class="w-full border-gray-300 rounded-lg shadow-sm text-sm focus:ring-emerald-500 focus:border-emerald-500">
                <button type="button" @click="rows.length > 1 ? rows.splice(index, 1) : null"
                        class="flex-shrink-0 text-red-500 hover:text-red-700 px-2" title="Hapus baris">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            </div>
        </template>

        <button type="button" @click="rows.push({ id: '', en: '' })"
                class="text-emerald-700 hover:text-emerald-800 text-sm font-semibold inline-flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Spesialisasi
        </button>
    </div>

    <div class="md:col-span-2" x-data="{
            rows: {{ old('wilayah_operasi') ? json_encode(old('wilayah_operasi')) : json_encode($item?->wilayah_operasi ?: ['']) }}
            }">
        <label class="block text-sm font-semibold text-gray-700 mb-2">Wilayah Operasi</label>

        <template x-for="(val, index) in rows" :key="index">
            <div class="flex gap-2 mb-2">
                <input type="text" :name="'wilayah_operasi[' + index + ']'" x-model="rows[index]" placeholder="mis. Malang Raya" required
                        list="daftar-wilayah-operasi"
                        class="w-full border-gray-300 rounded-lg shadow-sm text-sm focus:ring-emerald-500 focus:border-emerald-500">
                <button type="button" @click="rows.length > 1 ? rows.splice(index, 1) : null"
                        class="flex-shrink-0 text-red-500 hover:text-red-700 px-2" title="Hapus baris">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            </div>
        </template>

        <button type="button" @click="rows.push('')"
                class="text-emerald-700 hover:text-emerald-800 text-sm font-semibold inline-flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Wilayah
        </button>
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

<div class="mt-8 flex gap-3">
    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-6 rounded">
        Simpan
    </button>
    <a href="{{ route('admin.direktori.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-2 px-6 rounded">
        Batal
    </a>
</div>

<datalist id="daftar-bahasa-id">
    @foreach($daftarBahasaId ?? [] as $nilai)
        <option value="{{ $nilai }}">
    @endforeach
</datalist>
<datalist id="daftar-bahasa-en">
    @foreach($daftarBahasaEn ?? [] as $nilai)
        <option value="{{ $nilai }}">
    @endforeach
</datalist>
<datalist id="daftar-spesialisasi-id">
    @foreach($daftarSpesialisasiId ?? [] as $nilai)
        <option value="{{ $nilai }}">
    @endforeach
</datalist>
<datalist id="daftar-spesialisasi-en">
    @foreach($daftarSpesialisasiEn ?? [] as $nilai)
        <option value="{{ $nilai }}">
    @endforeach
</datalist>
<datalist id="daftar-wilayah-operasi">
    @foreach($daftarWilayahOperasi ?? [] as $nilai)
        <option value="{{ $nilai }}">
    @endforeach
</datalist>
