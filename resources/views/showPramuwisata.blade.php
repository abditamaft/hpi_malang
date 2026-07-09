@extends('layouts.main')
@php
    $locale = session('locale', 'id');
    if (session('locale', 'id') == 'id') {
        App::setLocale('id');
    } else {
        App::setLocale('en');
    }
@endphp
@section('title', $item->nama_lengkap . ' - HPI Kabupaten Malang')

@section('content')
<div class="pt-24 pb-20 bg-hpi-light">

    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- tombol kembali --}}
        <a href="{{ route('direktori') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-gray-500 hover:text-emerald-700 transition mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            {{ $locale == 'id' ? 'Kembali ke Direktori' : 'Back to Directory' }}
        </a>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-3">

                {{-- ============== FOTO PROFIL ============== --}}
                <div class="relative aspect-square md:aspect-auto bg-gray-100">
                    @if($item->foto_profil)
                        <img src="{{ asset('storage/' . $item->foto_profil) }}" alt="{{ $item->nama_lengkap }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-300">
                            <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                    @endif

                    @if($item->is_tersertifikasi)
                        <span class="absolute top-4 left-4 bg-amber-100 text-amber-800 text-xs font-bold px-3 py-1.5 rounded-full inline-flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                            {{ $locale == 'id' ? 'Tersertifikasi' : 'Certified' }}
                        </span>
                    @endif
                </div>

                {{-- ============== INFO UTAMA ============== --}}
                <div class="md:col-span-2 p-6 sm:p-8">
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 mb-2">{{ $item->nama_lengkap }}</h1>

                    @if($item->wilayah_operasi_label)
                        <p class="text-sm text-gray-500 font-medium mb-1 flex items-center gap-1.5">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ $item->wilayah_operasi_label }}
                        </p>
                    @endif

                    @if($item->aktif_sejak)
                        <p class="text-xs text-gray-400 font-medium mb-6">
                            {{ $locale == 'id' ? 'Aktif memandu sejak' : 'Guiding since' }} {{ $item->aktif_sejak }}
                        </p>
                    @endif

                    {{-- Bahasa Utama --}}
                    @if($item->bahasa_utama_label)
                        <div class="mb-5">
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-2">
                                {{ $locale == 'id' ? 'Bahasa Utama' : 'Primary Language' }}
                            </p>
                            <span class="bg-emerald-50 text-emerald-800 border border-emerald-100 text-xs font-bold px-3 py-1.5 rounded-full inline-block">
                                {{ $item->bahasa_utama_label }}
                            </span>
                        </div>
                    @endif

                    {{-- Semua Bahasa Dikuasai --}}
                    @if(!empty($item->bahasa_label))
                        <div class="mb-5">
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-2">
                                {{ $locale == 'id' ? 'Kemampuan Bahasa' : 'Language Proficiency' }}
                            </p>
                            <div class="flex flex-wrap gap-2">
                                @foreach($item->bahasa_label as $label)
                                    <span class="bg-gray-100 text-gray-700 text-xs font-bold px-3 py-1.5 rounded-full">
                                        {{ $label }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Spesialisasi --}}
                    @if(!empty($item->spesialisasi_label))
                        <div class="mb-5">
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-2">
                                {{ $locale == 'id' ? 'Spesialisasi' : 'Specialization' }}
                            </p>
                            <div class="flex flex-wrap gap-2">
                                @foreach($item->spesialisasi_label as $label)
                                    <span class="bg-amber-50 text-amber-800 border border-amber-100 text-xs font-semibold px-3 py-1.5 rounded-full">
                                        {{ $label }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Jenis Wisata --}}
                    @if(!empty($item->jenis_wisata_label))
                        <div class="mb-5">
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-2">
                                {{ $locale == 'id' ? 'Jenis Wisata' : 'Tour Types' }}
                            </p>
                            <div class="flex flex-wrap gap-2">
                                @foreach($item->jenis_wisata_label as $label)
                                    <span class="bg-blue-50 text-blue-800 border border-blue-100 text-xs font-semibold px-3 py-1.5 rounded-full">
                                        {{ $label }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Sertifikasi Tambahan --}}
                    @if(!empty($item->sertifikasi_tambahan_label))
                        <div class="mb-5">
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-2">
                                {{ $locale == 'id' ? 'Sertifikasi Tambahan' : 'Additional Certifications' }}
                            </p>
                            <div class="flex flex-wrap gap-2">
                                @foreach($item->sertifikasi_tambahan_label as $label)
                                    <span class="bg-purple-50 text-purple-800 border border-purple-100 text-xs font-semibold px-3 py-1.5 rounded-full">
                                        {{ $label }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Keahlian Lain --}}
                    @if(!empty($item->keahlian_lain_label))
                        <div class="mb-5">
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-2">
                                {{ $locale == 'id' ? 'Keahlian Lain' : 'Other Skills' }}
                            </p>
                            <div class="flex flex-wrap gap-2">
                                @foreach($item->keahlian_lain_label as $label)
                                    <span class="bg-gray-100 text-gray-700 text-xs font-semibold px-3 py-1.5 rounded-full">
                                        {{ $label }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Tipe Wisatawan yang Dilayani --}}
                    @if(!empty($item->tipe_wisatawan_label))
                        <div class="mb-5">
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-2">
                                {{ $locale == 'id' ? 'Tipe Wisatawan yang Dilayani' : 'Traveler Types Served' }}
                            </p>
                            <div class="flex flex-wrap gap-2">
                                @foreach($item->tipe_wisatawan_label as $label)
                                    <span class="bg-gray-100 text-gray-700 text-xs font-semibold px-3 py-1.5 rounded-full">
                                        {{ $label }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Asal Wisatawan yang Pernah Ditangani --}}
                    @if(!empty($item->asal_wisatawan_label))
                        <div class="mb-6">
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-2">
                                {{ $locale == 'id' ? 'Pengalaman Menangani Wisatawan dari' : 'Experience Guiding Travelers From' }}
                            </p>
                            <div class="flex flex-wrap gap-2">
                                @foreach($item->asal_wisatawan_label as $label)
                                    <span class="bg-gray-100 text-gray-700 text-xs font-semibold px-3 py-1.5 rounded-full">
                                        {{ $label }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Bio --}}
                    @if($item->bio)
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-2">
                                {{ $locale == 'id' ? 'Tentang' : 'About' }}
                            </p>
                            <p class="text-sm text-gray-600 leading-relaxed whitespace-pre-line">
                                {{ $item->bio }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- ============== INFO VERIFIKASI ============== --}}
            @if($item->is_tersertifikasi && ($item->no_lisensi || $item->no_ktan))
                <div class="border-t border-gray-100 bg-gray-50 px-6 sm:px-8 py-6">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-3">
                        {{ $locale == 'id' ? 'Informasi Verifikasi' : 'Verification Info' }}
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                        @if($item->no_lisensi)
                            <div>
                                <p class="text-gray-400 text-xs mb-0.5">{{ $locale == 'id' ? 'No. Lisensi' : 'License No.' }}</p>
                                <p class="font-semibold text-gray-700">
                                    {{ $item->no_lisensi }}
                                    @if($item->masa_berlaku_lisensi)
                                        <span class="text-gray-400 font-normal">
                                            &middot; {{ $locale == 'id' ? 'berlaku s.d.' : 'valid until' }}
                                            {{ $item->masa_berlaku_lisensi->translatedFormat('M Y') }}
                                        </span>
                                    @endif
                                </p>
                            </div>
                        @endif
                        @if($item->no_ktan)
                            <div>
                                <p class="text-gray-400 text-xs mb-0.5">{{ $locale == 'id' ? 'No. KTAN' : 'KTAN No.' }}</p>
                                <p class="font-semibold text-gray-700">
                                    {{ $item->no_ktan }}
                                    @if($item->masa_berlaku_ktan)
                                        <span class="text-gray-400 font-normal">
                                            &middot; {{ $locale == 'id' ? 'berlaku s.d.' : 'valid until' }}
                                            {{ $item->masa_berlaku_ktan->translatedFormat('M Y') }}
                                        </span>
                                    @endif
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            {{-- ============== PORTOFOLIO ============== --}}
            @if($item->portofolio->isNotEmpty())
                <div class="border-t border-gray-100 px-6 sm:px-8 py-6">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-4">
                        {{ $locale == 'id' ? 'Portofolio' : 'Portfolio' }}
                    </p>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3" x-data="{ aktif: null }">
                        @foreach($item->portofolio as $p)
                            <button type="button" @click="aktif = {{ $p->id }}" class="block text-left group">
                                <div class="aspect-square rounded-lg overflow-hidden bg-gray-100">
                                    <img src="{{ asset('storage/' . $p->url_gambar) }}" alt="{{ $p->keterangan ?? $item->nama_lengkap }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                                @if($p->keterangan)
                                    <p class="text-xs text-gray-500 mt-1.5 line-clamp-2">{{ $p->keterangan }}</p>
                                @endif
                            </button>
                        @endforeach

                        {{-- Lightbox sederhana --}}
                        @foreach($item->portofolio as $p)
                            <div x-show="aktif === {{ $p->id }}" x-cloak
                                class="fixed inset-0 z-50 bg-black/80 flex items-center justify-center p-4"
                                @click="aktif = null">
                                <div class="max-w-3xl w-full" @click.stop>
                                    <img src="{{ asset('storage/' . $p->url_gambar) }}" class="w-full rounded-lg">
                                    @if($p->keterangan)
                                        <p class="text-white text-sm text-center mt-3">{{ $p->keterangan }}</p>
                                    @endif
                                </div>
                                <button type="button" @click="aktif = null" class="absolute top-6 right-6 text-white">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
</div>
@endsection
