@extends('layouts.main')
@php
    $locale = session('locale', 'id');
@endphp
@section('title', $locale == 'id' ? 'Direktori Pramuwisata - HPI Kabupaten Malang' : 'Tour Guide Directory - HPI Kabupaten Malang')

@section('content')
<div class="pt-24 pb-0 bg-hpi-light">
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-6 text-center">
        <h1 class="text-3xl sm:text-4xl font-extrabold text-emerald-900 mb-4">
            {{ $locale == 'id' ? 'Direktori Pramuwisata' : 'Tour Guide Directory' }}
        </h1>
        <p class="text-gray-500 max-w-xl mx-auto leading-relaxed">
            {{ $locale == 'id'
                ? 'Temukan pemandu wisata profesional bersertifikat untuk memandu perjalanan Anda menjelajahi kekayaan alam dan budaya Kabupaten Malang.'
                : 'Find certified professional tour guides to accompany your journey exploring the natural and cultural riches of Malang Regency.' }}
        </p>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            {{-- ============== FILTER SIDEBAR ============== --}}
            <aside class="lg:col-span-1">
                <form action="{{ route('direktori') }}" method="GET" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

                    <div class="flex justify-between items-center mb-6">
                        <h2 class="font-bold text-gray-800">{{ $locale == 'id' ? 'Filter' : 'Filter' }}</h2>
                        <a href="{{ route('direktori') }}" class="text-xs font-semibold text-gray-400 hover:text-emerald-700 inline-flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            {{ $locale == 'id' ? 'Reset' : 'Reset' }}
                        </a>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            {{ $locale == 'id' ? 'Pencarian Nama' : 'Search by Name' }}
                        </label>
                        <div class="relative">
                            <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            <input type="text" name="nama" value="{{ request('nama') }}"
                                    placeholder="{{ $locale == 'id' ? 'Cari pemandu...' : 'Search guide...' }}"
                                    class="w-full text-sm border-gray-200 rounded-lg pl-9 pr-3 py-2 focus:ring-emerald-500 focus:border-emerald-500">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            {{ $locale == 'id' ? 'Kemampuan Bahasa' : 'Language Proficiency' }}
                        </label>
                        <div class="space-y-2">
                            @foreach($daftarBahasa as $b)
                                <label class="flex items-center gap-2 text-sm text-gray-600">
                                    <input type="checkbox" name="bahasa[]" value="{{ $b['id'] }}"
                                            {{ in_array($b['id'], (array) request('bahasa', [])) ? 'checked' : '' }}
                                            class="rounded border-gray-300 text-emerald-700 focus:ring-emerald-500">
                                    {{ $locale == 'id' ? $b['id'] : ($b['en'] ?? $b['id']) }}
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            {{ $locale == 'id' ? 'Spesialisasi' : 'Specialization' }}
                        </label>
                        <div class="flex flex-wrap gap-2">
                            @foreach($daftarSpesialisasi as $s)
                                @php $checked = in_array($s['id'], (array) request('spesialisasi', [])); @endphp
                                <label class="cursor-pointer">
                                    <input type="checkbox" name="spesialisasi[]" value="{{ $s['id'] }}" {{ $checked ? 'checked' : '' }} class="hidden peer">
                                    <span class="peer-checked:bg-amber-100 peer-checked:text-amber-800 peer-checked:border-amber-200 bg-white text-gray-600 border border-gray-200 text-xs font-semibold px-3 py-1.5 rounded-full inline-block transition">
                                        {{ $locale == 'id' ? $s['id'] : ($s['en'] ?? $s['id']) }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-sm py-2.5 rounded-lg transition">
                        {{ $locale == 'id' ? 'Terapkan Filter' : 'Apply Filter' }}
                    </button>
                </form>
            </aside>

            {{-- ============== GRID KARTU PRAMUWISATA ============== --}}
            <div class="lg:col-span-3">

                @if($pramuwisata->isEmpty())
                    <div class="bg-white rounded-2xl border border-gray-100 p-12 text-center text-gray-400 text-sm">
                        {{ $locale == 'id' ? 'Tidak ada pramuwisata yang cocok dengan filter Anda.' : 'No tour guides match your filter.' }}
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($pramuwisata as $item)
                            <a href="{{ route('direktori.show', $item->slug) }}"
                                class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md hover:border-emerald-200 transition group">

                                <div class="relative aspect-[4/3] bg-gray-100">
                                    @if($item->foto_profil)
                                        <img src="{{ asset('storage/' . $item->foto_profil) }}" alt="{{ $item->nama_lengkap }}" class="w-full h-full object-cover">
                                    @endif

                                    @if($item->is_tersertifikasi)
                                        <span class="absolute top-3 right-3 bg-amber-100 text-amber-800 text-[11px] font-bold px-3 py-1 rounded-full inline-flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                            {{ $locale == 'id' ? 'Tersertifikasi' : 'Certified' }}
                                        </span>
                                    @endif
                                </div>

                                <div class="p-5">
                                    <h3 class="font-bold text-gray-900 mb-1">{{ $item->nama_lengkap }}</h3>

                                    @if($item->wilayah_operasi_label)
                                        <p class="text-xs text-gray-500 font-medium mb-3 flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            {{ $item->wilayah_operasi_label }}
                                        </p>
                                    @endif

                                    @if(!empty($item->bahasa_label))
                                        <div class="flex flex-wrap gap-1.5 mb-3">
                                            @foreach($item->bahasa_label as $label)
                                                <span class="bg-gray-100 text-gray-600 text-[11px] font-bold px-2 py-1 rounded">
                                                    {{ $label }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="flex justify-between items-center">
                                        <p class="text-emerald-700 text-xs font-semibold">
                                            {{ implode(', ', $item->spesialisasi_label) }}
                                        </p>
                                        <svg class="w-4 h-4 text-emerald-700 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="mt-10">
                        {{ $pramuwisata->links() }}
                    </div>
                @endif

            </div>
        </div>
    </section>
</div>
<!-- Load GSAP CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Character splitter helper
        function splitTextByChars(element) {
            if (!element) return [];
            const text = element.textContent.trim();
            element.innerHTML = '';
            
            return [...text].map(char => {
                const span = document.createElement('span');
                if (char === ' ') {
                    span.innerHTML = '&nbsp;';
                } else {
                    span.textContent = char;
                }
                span.style.display = 'inline-block';
                span.style.opacity = '0';
                span.style.transform = 'translateY(15px)';
                element.appendChild(span);
                return span;
            });
        }

        // ================= ENTRANCE ANIMATIONS =================
        const h1 = document.querySelector("h1");
        const p = document.querySelector("section.pt-16 p");
        const sidebar = document.querySelector("aside");
        const cards = document.querySelectorAll(".lg\\:col-span-3 .grid > a");

        const charsH1 = splitTextByChars(h1);
        const charsP = splitTextByChars(p);

        const entranceTimeline = gsap.timeline();
        
        if (charsH1.length > 0) {
            entranceTimeline.to(charsH1, { opacity: 1, y: 0, stagger: 0.012, duration: 0.5, ease: "power2.out" }, 0.1);
        }
        if (charsP.length > 0) {
            entranceTimeline.to(charsP, { opacity: 1, y: 0, stagger: 0.002, duration: 0.5, ease: "power2.out" }, 0.3);
        }
        if (sidebar) {
            gsap.set(sidebar, { opacity: 0, x: -30 });
            entranceTimeline.to(sidebar, { opacity: 1, x: 0, duration: 0.6, ease: "power2.out" }, 0.4);
        }
        if (cards.length > 0) {
            gsap.set(cards, { opacity: 0, y: 30 });
            entranceTimeline.to(cards, {
                opacity: 1,
                y: 0,
                stagger: 0.1,
                duration: 0.8,
                ease: "power2.out"
            }, 0.5);
        }
    });
</script>
@endsection
