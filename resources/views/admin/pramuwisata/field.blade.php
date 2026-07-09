<div class="md:col-span-2" x-data="{ rows: {{ json_encode($nilaiAwal) }} }">
    <label class="block text-sm font-semibold text-gray-700 mb-2">{{ $label }}</label>

    <template x-for="(row, index) in rows" :key="index">
        <div class="flex gap-2 mb-2">
            <input type="text" :name="'{{ $field }}[' + index + '][id]'" x-model="row.id"
                placeholder="{{ $placeholderId ?? ($label . ' (Indonesia)') }}"
                @if(!empty($datalistId)) list="{{ $datalistId }}" @endif
                class="w-full border-gray-300 rounded-lg shadow-sm text-sm focus:ring-emerald-500 focus:border-emerald-500">
            <input type="text" :name="'{{ $field }}[' + index + '][en]'" x-model="row.en"
                placeholder="{{ $placeholderEn ?? ($label . ' (English)') }}"
                @if(!empty($datalistEn)) list="{{ $datalistEn }}" @endif
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
        Tambah {{ $label }}
    </button>
</div>
