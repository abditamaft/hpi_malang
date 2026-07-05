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
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-6 text-center">
        <p class="text-emerald-600 font-bold text-xs tracking-widest uppercase mb-3">
            {{ $locale == 'id' ? 'Kegiatan & Berita' : 'Events & News' }}
        </p>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-emerald-900 mb-4">
            {{ $locale == 'id' ? 'Informasi Terkini & Agenda Pariwisata Kabupaten Malang' : 'Latest Information & Tourism Agenda of Malang Regency' }}
        </h1>
        <p class="text-gray-500 max-w-xl mx-auto leading-relaxed">
            {{ $locale == 'id'
                ? 'Dapatkan kabar terbaru dan ikuti acara menarik yang kami selenggarakan.'
                : 'Stay informed with the latest news and join our exciting events.' }}
        </p>
    </section>

    {{-- ================= KEGIATAN MENDATANG ================= --}}
    <section class="bg-gray-50 py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h2 class="text-2xl font-extrabold text-slate-900 mb-2">
                        {{ $locale == 'id' ? 'Kegiatan Mendatang' : 'Upcoming Events' }}
                    </h2>
                    <p class="text-slate-500 text-sm max-w-md">
                        {{ $locale == 'id' ? 'Jelajahi agenda pelatihan, sertifikasi, dan event pariwisata yang akan segera hadir.' : 'Explore upcoming training, certification, and tourism events.' }}
                    </p>
                </div>

                <div class="hidden sm:flex items-center gap-2" x-data="{}">
                    <button onclick="document.getElementById('kegiatan-scroll').scrollBy({left:-320, behavior:'smooth'})"
                            class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center hover:bg-white transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                    <button onclick="document.getElementById('kegiatan-scroll').scrollBy({left:320, behavior:'smooth'})"
                            class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center hover:bg-white transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>
            </div>

            @if($kegiatanMendatang->isEmpty())
                <p class="text-sm text-slate-400">
                    {{ $locale == 'id' ? 'Belum ada kegiatan mendatang.' : 'No upcoming events yet.' }}
                </p>
            @else
                <div id="kegiatan-scroll" class="flex gap-6 overflow-x-auto pb-2 scroll-smooth [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                    @foreach($kegiatanMendatang as $item)
                        <a href="{{ route('berita.show', $item->slug) }}"
                            class="block bg-white rounded-2xl shadow-sm border border-gray-100 p-6 min-w-[300px] max-w-[320px] flex-shrink-0 hover:shadow-md hover:border-emerald-200 transition">
                            <div class="flex items-start gap-4 mb-4">
                                <div class="bg-amber-50 text-amber-700 rounded-xl w-14 h-14 flex flex-col items-center justify-center flex-shrink-0">
                                    <span class="text-lg font-extrabold leading-none">{{ $item->tanggal_kegiatan->format('d') }}</span>
                                    <span class="text-[10px] font-bold uppercase">{{ $item->tanggal_kegiatan->translatedFormat('F') }}</span>
                                    <span class="text-[10px] font-bold uppercase">{{ $item->tanggal_kegiatan->translatedFormat('Y') }}</span>
                                </div>
                                <h3 class="font-bold text-slate-900 leading-snug">{{ $locale == 'id' ? $item->judul_id : $item->judul_en }}</h3>
                            </div>

                            <p class="text-sm text-slate-500 leading-relaxed mb-4">
                                {{$locale == 'id' ? Str::limit($item->deskripsi_singkat_id, 100) : Str::limit($item->deskripsi_singkat_en, 100)}}
                            </p>

                            @if($item->lokasi_kegiatan)
                                <div class="flex items-start gap-1.5 text-xs font-semibold text-slate-600">
                                    <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span>{{ $item->lokasi_kegiatan }}</span>
                                </div>
                            @endif
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- ================= BERITA TERBARU ================= --}}
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-extrabold text-slate-900 mb-8">
                {{ $locale == 'id' ? 'Berita Terbaru' : 'Latest News' }}
            </h2>

            @if($beritaTerbaru->isEmpty())
                <p class="text-sm text-slate-400">
                    {{ $locale == 'id' ? 'Belum ada berita.' : 'No news yet.' }}
                </p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($beritaTerbaru as $item)
                        <article>
                            <a href="{{ route('berita.show', $item->slug) }}" class="block relative rounded-xl overflow-hidden aspect-[4/3] mb-4 bg-gray-100">
                                @if($item->url_gambar)
                                    <img src="{{ asset('storage/' . $item->url_gambar) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover">
                                @endif
                                @if($item->kategori)
                                    <span class="absolute top-3 left-3 bg-amber-100 text-amber-800 text-[11px] font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                                        {{ $locale == 'id' ? $item->kategori_id : $item->kategori_en }}
                                    </span>
                                @endif
                            </a>

                            <p class="text-xs text-slate-400 font-medium mb-1.5">
                                {{ $item->tanggal_kegiatan?->translatedFormat('d F Y') }}
                            </p>
                            <h3 class="font-bold text-slate-900 text-lg leading-snug mb-2">
                                <a href="{{ route('berita.show', $item->slug) }}" class="hover:text-emerald-600 transition">
                                    {{ $locale == 'id' ? $item->judul_id : $item->judul_en }}
                                </a>
                            </h3>
                            <p class="text-sm text-slate-500 leading-relaxed mb-3">
                                {{ $locale == 'id' ? Str::limit($item->deskripsi_singkat_id, 110) : Str::limit($item->deskripsi_singkat_en, 110) }}
                            </p>
                            <a href="{{ route('berita.show', $item->slug) }}" class="text-emerald-600 text-sm font-bold inline-flex items-center gap-1 hover:gap-2 transition-all">
                                {{ $locale == 'id' ? 'Baca Selengkapnya' : 'Read More' }} <span aria-hidden="true">&rarr;</span>
                            </a>
                        </article>
                    @endforeach
                </div>
                <div class="mt-12">
                    {{ $beritaTerbaru->links() }}
                </div>
            @endif
        </div>
    </section>
</div>
@endsection