@extends('layouts.main')
@section('content')
@php
    $locale = session('locale', 'id');
    if (session('locale', 'id') == 'id') {
        App::setLocale('id');
    } else {
        App::setLocale('en');
    }
@endphp
<div class="pt-24 pb-0 bg-hpi-light">
    <section class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-16">
        {{-- tombol kembali --}}
        <a href="{{ route('berita') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-slate-500 hover:text-emerald-600 transition mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            {{ $locale == 'id' ? 'Kembali ke Berita & Acara' : 'Back to News & Events' }}
        </a>

        {{-- tipe & kategori --}}
        <div class="flex items-center gap-2 mb-4">
            <span class="bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                {{ $locale == 'id' ? 'Kegiatan' : 'Event' }}
            </span>

            @php $kategori = $locale == 'id' ? $item->kategori_id : $item->kategori_en; @endphp
            @if($kategori)
                <span class="bg-amber-100 text-amber-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                    {{ $kategori }}
                </span>
            @endif
        </div>

        <div class="flex items-start gap-5 mb-8">
            @if($item->tanggal_kegiatan)
                <div class="bg-amber-50 text-amber-700 rounded-2xl w-20 h-20 flex flex-col items-center justify-center flex-shrink-0">
                    <span class="text-3xl font-extrabold leading-none">{{ $item->tanggal_kegiatan->format('d') }}</span>
                    <span class="text-xs font-bold uppercase mt-1">
                        {{ $item->tanggal_kegiatan->translatedFormat($locale == 'id' ? 'F' : 'F') }}
                    </span>
                    <span class="text-xs font-bold uppercase mt-1">
                        {{ $item->tanggal_kegiatan->translatedFormat($locale == 'id' ? 'Y' : 'Y') }}
                    </span>
                </div>
            @endif

            <div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 leading-tight mb-2">
                    {{ $locale == 'id' ? $item->judul_id : $item->judul_en }}
                </h1>
                <p class="text-sm text-slate-500 font-medium">
                    {{ $item->tanggal_kegiatan?->translatedFormat($locale == 'id' ? 'l, d F Y' : 'l, F d, Y') }}
                </p>
            </div>
        </div>

        {{-- Gambar utama (opsional) --}}
        @if($item->url_gambar)
            <img src="{{ asset('storage/' . $item->url_gambar) }}"
                alt="{{ $locale == 'id' ? $item->judul_id : $item->judul_en }}"
                class="w-full rounded-2xl mb-8 aspect-video object-cover">
        @endif

        {{-- Kartu info lokasi --}}
        @if($item->lokasi_kegiatan)
            <div class="bg-gray-50 border border-gray-100 rounded-xl p-5 flex items-start gap-3 mb-8">
                <div class="bg-white rounded-lg p-2 shadow-sm flex-shrink-0">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wide mb-0.5">
                        {{ $locale == 'id' ? 'Lokasi' : 'Location' }}
                    </p>
                    <p class="text-sm font-semibold text-slate-800">{{ $item->lokasi_kegiatan }}</p>
                </div>
            </div>
        @endif

        {{-- Deskripsi singkat --}}
        @php $deskripsi = $locale == 'id' ? $item->deskripsi_singkat_id : $item->deskripsi_singkat_en; @endphp
        @if($deskripsi)
            <p class="text-lg text-slate-600 leading-relaxed font-medium mb-8">
                {{ $deskripsi }}
            </p>
        @endif

        {{-- Isi lengkap --}}
        @php $isi = $locale == 'id' ? $item->isi_id : $item->isi_en; @endphp
        @if($isi)
            <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed mb-10">
                {!! $isi !!}
            </div>
        @endif

        @if($item->url_sumber)
            <a href="{{ $item->url_sumber }}" target="_blank" rel="noopener noreferrer"
                class="inline-flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm px-6 py-3 rounded-full transition">
                {{ $locale == 'id' ? 'Daftar Sekarang' : 'Register Now' }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        @endif
    </section>
</div>
@endsection
