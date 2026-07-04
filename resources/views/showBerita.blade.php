@extends('layouts.main')
@php
    $locale = session('locale', 'id');
    if (session('locale', 'id') == 'id') {
        App::setLocale('id');
    } else {
        App::setLocale('en');
    }
@endphp
@section('title', $locale == 'id' ? $item->judul_id : $item->judul_en)

@section('content')
<div class="pt-24 pb-0 bg-hpi-light">
    <section class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-16">

        {{-- tombol kembali --}}
        <a href="{{ route('berita') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-slate-500 hover:text-emerald-600 transition mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            {{ $locale == 'id' ? 'Kembali ke Berita & Acara' : 'Back to News & Events' }}
        </a>

        {{-- kategori & tipe --}}
        <div class="flex items-center gap-2 mb-4">
            @if($item->tipe === 'kegiatan')
                <span class="bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                    {{ $locale == 'id' ? 'Kegiatan' : 'Event' }}
                </span>
            @else
                <span class="bg-purple-100 text-purple-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                    {{ $locale == 'id' ? 'Berita' : 'News' }}
                </span>
            @endif

            @php 
                $kategori = $locale == 'id' ? $item->kategori_id : $item->kategori_en; 
            @endphp
            @if($kategori)
                <span class="bg-amber-100 text-amber-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                    {{ $kategori }}
                </span>
            @endif
        </div>

        {{-- Judul --}}
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 leading-tight mb-4">
            {{ $locale == 'id' ? $item->judul_id : $item->judul_en }}
        </h1>

        {{-- tanggal & lokasi --}}
        <div class="flex flex-wrap items-center gap-4 text-sm text-slate-500 font-medium mb-8 pb-6 border-b border-gray-100">
            @if($item->tanggal_kegiatan)
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span>{{ $item->tanggal_kegiatan->translatedFormat($locale == 'id' ? 'd F Y' : 'F d, Y') }}</span>
                </div>
            @endif

            @if($item->tipe === 'kegiatan' && $item->lokasi_kegiatan)
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span>{{ $item->lokasi_kegiatan }}</span>
                </div>
            @endif
        </div>

        {{-- Gambar utama --}}
        @if($item->url_gambar)
            <img src="{{ asset('storage/' . $item->url_gambar) }}"
                alt="{{ $locale == 'id' ? $item->judul_id : $item->judul_en }}"
                class="w-full rounded-2xl mb-10 aspect-video object-cover">
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
            <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed">
                {!! $isi !!}
            </div>
        @endif

        {{-- Sumber eksternal (opsional) --}}
        @if($item->url_sumber)
            <div class="mt-10 pt-6 border-t border-gray-100">
                <a href="{{ $item->url_sumber }}" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center gap-1.5 text-emerald-600 font-semibold text-sm hover:text-emerald-700 transition">
                    {{ $locale == 'id' ? 'Lihat Sumber / Daftar' : 'View Source / Register' }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
        @endif
    </section>
</div>
@endsection
