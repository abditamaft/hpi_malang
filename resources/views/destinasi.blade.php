@extends('layouts.main')

@section('content')
@php
    $locale  = session('locale', 'id');

    /**
     * Helper: tentukan icon berdasarkan nama kategori
     */
    $getIcon = function(string $kat): string {
        $k = strtolower($kat);
        if (str_contains($k, 'gunung') || str_contains($k, 'mountain')) return '⛰️';
        if (str_contains($k, 'pantai') || str_contains($k, 'beach'))    return '🏖️';
        if (str_contains($k, 'budaya') || str_contains($k, 'culture') || str_contains($k, 'candi')) return '🏛️';
        return '💧';
    };
@endphp

<!-- Wrapper utama -->
<div class="pt-24 pb-0 bg-hpi-light">

    <!-- Judul & Subjudul -->
    <div class="max-w-7xl mx-auto px-6 text-center mb-8 mt-8">
        <h1 class="text-3xl md:text-4xl font-bold text-hpi-green mb-4">
            {{ $locale == 'id' ? 'Jelajahi Destinasi Wisata Malang Raya' : 'Explore Malang Raya Tourist Destinations' }}
        </h1>
        <p class="text-gray-600 max-w-2xl mx-auto text-sm md:text-base leading-relaxed">
            {{ $locale == 'id'
                ? 'Temukan keindahan alam dan kekayaan budaya Kabupaten Malang bersama pemandu profesional kami.'
                : 'Discover the natural beauty and cultural wealth of Malang Regency with our professional guides.' }}
        </p>
    </div>

    <!-- Filter Kategori -->
    <div class="flex justify-center gap-3 mb-10 flex-wrap px-6">
        {{-- Tombol Semua --}}
        <a href="/destinasi"
           class="{{ !$aktifKategori ? 'bg-hpi-green text-white shadow-sm' : 'bg-white border border-gray-300 text-gray-600 hover:bg-gray-50' }}
                  px-6 py-2 rounded-full text-sm font-semibold transition-colors shadow-sm">
            {{ $locale == 'id' ? 'Semua' : 'All' }}
        </a>
        {{-- Tombol per Kategori (dinamis dari DB) --}}
        @foreach($kategori as $kat)
        <a href="/destinasi?kategori={{ urlencode($kat->kategori_id) }}"
           class="{{ $aktifKategori == $kat->kategori_id ? 'bg-hpi-green text-white shadow-sm' : 'bg-white border border-gray-300 text-gray-600 hover:bg-gray-50' }}
                  px-6 py-2 rounded-full text-sm font-medium transition-colors shadow-sm">
            {{ $locale == 'id' ? $kat->kategori_id : ($kat->kategori_en ?: $kat->kategori_id) }}
        </a>
        @endforeach
    </div>


    <!-- ============================================================ -->
    <!--  Area Cards                                                   -->
    <!-- ============================================================ -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 space-y-6 pb-16">

        @if($unggulan->isEmpty() && $biasa->isEmpty())
            <!-- State kosong -->
            <div class="text-center py-20 bg-white rounded-2xl shadow-sm border border-gray-100">
                <p class="text-gray-400 text-sm">
                    {{ $locale == 'id' ? 'Belum ada data destinasi wisata.' : 'No destination data available yet.' }}
                </p>
            </div>
        @else

            {{-- ===================================================== --}}
            {{-- CARD UNGGULAN: setiap card unggulan tampil full-width   --}}
            {{-- dengan layout gambar kiri (50%) + teks kanan (50%)      --}}
            {{-- ===================================================== --}}
            @foreach($unggulan as $item)
                @php $icon = $getIcon($item->kategori_id ?? ''); @endphp

                <div class="destination-card w-full bg-white overflow-hidden shadow-sm hover:shadow-md border border-gray-100
                            flex flex-col sm:flex-row group transition-all duration-300 cursor-pointer"
                     style="min-height: 280px;"
                     data-id="{{ $item->id ?? $loop->iteration }}"
                     data-featured="true"
                     data-category="{{ $locale=='id' ? $item->kategori_id : ($item->kategori_en ?: $item->kategori_id) }}"
                     data-title="{{ $locale=='id' ? $item->nama_destinasi_id : ($item->nama_destinasi_en ?: $item->nama_destinasi_id) }}"
                     data-description="{{ $locale=='id' ? $item->deskripsi_id : ($item->deskripsi_en ?: $item->deskripsi_id) }}"
                     data-img="{{ $item->url_gambar ? asset('storage/' . $item->url_gambar) : '' }}">

                    {{-- Gambar (kiri, 50% lebar) --}}
                    <div class="sm:w-1/2 shrink-0 overflow-hidden bg-gray-200" style="min-height: 240px;">
                        @if($item->url_gambar)
                            <img src="{{ asset('storage/' . $item->url_gambar) }}"
                                 alt="{{ $locale=='id' ? $item->nama_destinasi_id : ($item->nama_destinasi_en ?: $item->nama_destinasi_id) }}"
                                 class="card-img w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                 style="min-height: 240px;">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-300 text-sm" style="min-height:240px;">
                                Tidak ada gambar
                            </div>
                        @endif
                    </div>

                    {{-- Konten (kanan, 50% lebar) --}}
                    <div class="sm:w-1/2 flex flex-col justify-center" style="padding: 2.5rem 2.5rem;">
                        <!-- Badge unggulan -->
                        <div class="mb-3">
                            <span class="inline-block bg-[#F2C94C] text-[#5A4300] text-[10px] font-bold px-3 py-1 rounded-full shadow-sm">
                                {{ $locale=='id' ? '⭐ Destinasi Unggulan' : '⭐ Featured Destination' }}
                            </span>
                        </div>
                        <!-- Kategori -->
                        <div class="flex items-center gap-1.5 text-xs text-gray-400 font-medium mb-2">
                            <span>{{ $locale=='id' ? $item->kategori_id : ($item->kategori_en ?: $item->kategori_id) }}</span>
                        </div>
                        <!-- Judul -->
                        <h3 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-3 leading-snug group-hover:text-hpi-green transition-colors">
                            {{ $locale=='id' ? $item->nama_destinasi_id : ($item->nama_destinasi_en ?: $item->nama_destinasi_id) }}
                        </h3>
                        <!-- Deskripsi -->
                        <p class="text-gray-500 text-sm leading-relaxed line-clamp-3 mb-6">
                            {{ $locale=='id' ? $item->deskripsi_id : ($item->deskripsi_en ?: $item->deskripsi_id) }}
                        </p>
                    </div>
                </div>
            @endforeach

            {{-- ===================================================== --}}
            {{-- CARD BIASA: grid 3 kolom, tiap card 1/3 lebar          --}}
            {{-- ===================================================== --}}
            @if($biasa->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach($biasa as $item)
                        @php $icon = $getIcon($item->kategori_id ?? ''); @endphp
                        <div class="destination-card bg-white overflow-hidden shadow-sm hover:shadow-md border border-gray-100
                                    flex flex-col group transition-all duration-300 cursor-pointer"
                             data-id="{{ $item->id ?? $loop->iteration }}"
                             data-featured="false"
                             data-category="{{ $locale=='id' ? $item->kategori_id : ($item->kategori_en ?: $item->kategori_id) }}"
                             data-title="{{ $locale=='id' ? $item->nama_destinasi_id : ($item->nama_destinasi_en ?: $item->nama_destinasi_id) }}"
                             data-description="{{ $locale=='id' ? $item->deskripsi_id : ($item->deskripsi_en ?: $item->deskripsi_id) }}"
                             data-img="{{ $item->url_gambar ? asset('storage/' . $item->url_gambar) : '' }}">
                            <!-- Gambar atas -->
                            <div class="w-full overflow-hidden bg-gray-200 shrink-0" style="height: 190px;">
                                @if($item->url_gambar)
                                    <img src="{{ asset('storage/' . $item->url_gambar) }}"
                                         alt="{{ $locale=='id' ? $item->nama_destinasi_id : ($item->nama_destinasi_en ?: $item->nama_destinasi_id) }}"
                                         class="card-img w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300 text-xs">
                                        Tidak ada gambar
                                    </div>
                                @endif
                            </div>
                            <!-- Konten bawah -->
                            <div class="flex-1 px-6 pt-6 pb-8 flex flex-col">
                                <div class="flex items-center gap-1.5 text-xs text-gray-400 font-medium mb-2">
                                    <span>{{ $locale=='id' ? $item->kategori_id : ($item->kategori_en ?: $item->kategori_id) }}</span>
                                </div>
                                <h3 class="text-base font-bold text-gray-900 mb-2 group-hover:text-hpi-green transition-colors">
                                    {{ $locale=='id' ? $item->nama_destinasi_id : ($item->nama_destinasi_en ?: $item->nama_destinasi_id) }}
                                </h3>
                                <p class="text-gray-500 text-xs leading-relaxed line-clamp-3 flex-1 mb-4">
                                    {{ $locale=='id' ? $item->deskripsi_id : ($item->deskripsi_en ?: $item->deskripsi_id) }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endif
    </div>{{-- /area cards --}}

    <!-- CTA Section -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 pb-20" style="margin-top: 4rem;">
        <div class="bg-hpi-green text-white text-center relative overflow-hidden shadow-xl"
             style="border-radius: 2rem; padding: 5rem 3rem;">
            <!-- Dekorasi -->
            <div class="absolute -top-20 -right-20 w-56 h-56 bg-white/5 rounded-full blur-2xl pointer-events-none"></div>
            <div class="absolute -bottom-20 -left-20 w-56 h-56 bg-white/5 rounded-full blur-2xl pointer-events-none"></div>

            <div class="relative z-10 max-w-2xl mx-auto">
                <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-4 tracking-tight">
                    {{ $locale == 'id' ? 'Butuh Pemandu Profesional?' : 'Need a Professional Guide?' }}
                </h2>
                <p class="text-emerald-100/90 mb-8 text-sm md:text-base leading-relaxed">
                    {{ $locale == 'id'
                        ? 'Maksimalkan pengalaman wisata Anda dengan pengetahuan mendalam dari anggota HPI Kabupaten Malang bersertifikat.'
                        : 'Maximize your travel experience with in-depth knowledge from certified HPI Malang Regency members.' }}
                </p>
                <a href="/direktori"
                   class="inline-flex items-center gap-2 bg-white text-hpi-green font-bold
                          hover:bg-gray-50 transition-colors shadow-lg hover:shadow-xl
                          hover:-translate-y-0.5 transform duration-200"
                   style="border-radius: 9999px; padding: 1rem 2.5rem;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745
                                 M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01
                                 M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    {{ $locale == 'id' ? 'Cari Pemandu Sekarang' : 'Find a Guide Now' }}
                </a>
            </div>
        </div>
    </div>

</div>

<!-- Modal Detail Destinasi (Hidden by default) -->
<div id="destination-modal" class="fixed inset-0 z-50 invisible flex items-center justify-center p-4">
    <!-- Backdrop overlay -->
    <div id="modal-backdrop" class="absolute inset-0 bg-black/60 opacity-0 transition-opacity duration-300"></div>

    <!-- Modal Content Card -->
    <div id="modal-card" class="relative bg-white w-full max-w-4xl rounded-3xl overflow-hidden shadow-2xl z-10 flex flex-col md:flex-row transform scale-95 opacity-0 transition-all duration-300 max-h-[90vh]">
        <!-- Close Button -->
        <button id="modal-close" class="absolute top-4 right-4 z-20 bg-black/40 hover:bg-black/60 text-white rounded-full p-2 backdrop-blur-sm transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <!-- Image Container (FLIP target) -->
        <div class="md:w-1/2 bg-gray-100 relative min-h-[300px] md:min-h-full overflow-hidden">
            <img id="modal-img" src="" alt="" class="absolute inset-0 w-full h-full object-cover">
        </div>

        <!-- Content Area -->
        <div class="md:w-1/2 p-8 md:p-12 overflow-y-auto flex flex-col justify-center max-h-[45vh] md:max-h-full">
            <div id="modal-featured-badge" class="mb-4 hidden">
                <span class="inline-block bg-[#F2C94C] text-[#5A4300] text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                    {{ $locale=='id' ? '⭐ Destinasi Unggulan' : '⭐ Featured Destination' }}
                </span>
            </div>
            
            <span id="modal-category" class="text-sm font-semibold uppercase tracking-wider text-hpi-green mb-2">Kategori</span>
            
            <h2 id="modal-title" class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-4 leading-tight">Nama Destinasi</h2>
            
            <div class="w-12 h-1 bg-gradient-to-r from-hpi-green to-emerald-400 rounded-full mb-6"></div>
            
            <p id="modal-description" class="text-gray-600 text-sm md:text-base leading-relaxed mb-6"></p>
        </div>
    </div>
</div>

<!-- Load GSAP & Flip Plugin CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/Flip.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        gsap.registerPlugin(Flip);

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
        const p = document.querySelector("div.text-center.mb-8 p");
        const cards = document.querySelectorAll(".destination-card");

        const charsH1 = splitTextByChars(h1);
        const charsP = splitTextByChars(p);

        const entranceTimeline = gsap.timeline();
        
        if (charsH1.length > 0) {
            entranceTimeline.to(charsH1, { opacity: 1, y: 0, stagger: 0.012, duration: 0.5, ease: "power2.out" }, 0.1);
        }
        if (charsP.length > 0) {
            entranceTimeline.to(charsP, { opacity: 1, y: 0, stagger: 0.002, duration: 0.5, ease: "power2.out" }, 0.3);
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

        const modal = document.querySelector("#destination-modal");
        const modalBackdrop = document.querySelector("#modal-backdrop");
        const modalCard = document.querySelector("#modal-card");
        const modalImg = document.querySelector("#modal-img");
        const modalTitle = document.querySelector("#modal-title");
        const modalDesc = document.querySelector("#modal-description");
        const modalCat = document.querySelector("#modal-category");
        const modalFeatured = document.querySelector("#modal-featured-badge");
        const closeBtn = document.querySelector("#modal-close");

        let activeCardImg = null;

        cards.forEach(card => {
            card.addEventListener("click", () => {
                const id = card.getAttribute("data-id");
                const isFeatured = card.getAttribute("data-featured") === "true";
                const category = card.getAttribute("data-category");
                const title = card.getAttribute("data-title");
                const desc = card.getAttribute("data-description");
                const imgSrc = card.getAttribute("data-img");
                const cardImg = card.querySelector(".card-img");

                activeCardImg = cardImg;

                // Populate modal content
                modalImg.src = imgSrc;
                modalTitle.textContent = title;
                modalDesc.textContent = desc;
                modalCat.textContent = category;

                if (isFeatured) {
                    modalFeatured.classList.remove("hidden");
                } else {
                    modalFeatured.classList.add("hidden");
                }

                // Match flip IDs
                const flipId = `img-${id}`;
                cardImg.setAttribute("data-flip-id", flipId);
                modalImg.setAttribute("data-flip-id", flipId);

                // Make modal visible
                modal.classList.remove("invisible");
                
                // Get State from card image
                const state = Flip.getState(cardImg);

                // Show modal card and backdrop
                gsap.to(modalBackdrop, { opacity: 1, duration: 0.3 });
                gsap.to(modalCard, { opacity: 1, scale: 1, duration: 0.3 });

                // Animate image with Flip
                Flip.from(state, {
                    duration: 0.6,
                    ease: "power2.out",
                    scale: true,
                    absolute: true
                });
            });
        });

        function closeModal() {
            if (!activeCardImg) return;

            // Get state from modal image
            const state = Flip.getState(modalImg);

            // Hide modal card and backdrop
            gsap.to(modalBackdrop, { opacity: 0, duration: 0.3 });
            gsap.to(modalCard, { 
                opacity: 0, 
                scale: 0.95, 
                duration: 0.3,
                onComplete: () => {
                    modal.classList.add("invisible");
                }
            });

            // Flip back to card image
            Flip.from(state, {
                duration: 0.6,
                ease: "power2.out",
                scale: true,
                absolute: true,
                onComplete: () => {
                    activeCardImg.removeAttribute("data-flip-id");
                    modalImg.removeAttribute("data-flip-id");
                    activeCardImg = null;
                }
            });
        }

        closeBtn.addEventListener("click", closeModal);
        modalBackdrop.addEventListener("click", closeModal);
    });
</script>
@endsection
