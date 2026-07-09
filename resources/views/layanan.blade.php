@extends('layouts.main')

@section('content')
@php
    $locale = session('locale', 'id');
@endphp

    <div class="max-w-6xl mx-auto px-4 pb-16" style="padding-top: 160px;">

        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs font-semibold tracking-widest text-amber-500 uppercase bg-amber-100 px-3 py-1 rounded-full">
                {{ $locale == 'id' ? 'Layanan Kami' : 'Our Services' }}
            </span>
            <h1 class="text-3xl md:text-4xl font-bold text-hpi-green mt-4 mb-6">
                {{ $locale == 'id' ? 'Layanan Pramuwisata Profesional' : 'Professional Tour Guide Services' }}
            </h1>
            <p class="text-gray-600 leading-relaxed text-sm md:text-base">
                {{ $locale == 'id'
                    ? 'Himpunan Pramuwisata Indonesia (HPI) Kabupaten Malang menghadirkan pemandu wisata bersertifikat dengan keahlian spesifik. Dari ekspedisi pegunungan hingga wisata sejarah mendalam, kami siap memandu perjalanan Anda dengan standar profesionalisme dan keramahan tertinggi.'
                    : 'The Indonesian Tourist Guide Association (HPI) of Malang Regency provides certified tour guides with specific expertise. From mountain expeditions to deep historical tours, we are ready to guide your journey with the highest standards of professionalism and hospitality.' }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-20">

            @if(isset($layanan) && count($layanan) > 0)
                {{-- Loop Data dari Admin/Database --}}
                @foreach($layanan as $item)
                    <div class="card-container bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col justify-between border border-gray-100" data-card-id="{{ $item->id }}">
                        <div class="relative h-64 md:h-72 w-full bg-gray-200">
                            @if($item->url_gambar)
                                <img src="{{ asset('storage/' . $item->url_gambar) }}" alt="{{ $locale == 'id' ? $item->nama_layanan_id : $item->nama_layanan_en }}" class="w-full h-full object-cover">
                            @endif
                        </div>
                        <div class="p-6 md:p-8 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="text-xl font-bold text-hpi-green mb-3">
                                    {{ $locale == 'id' ? $item->nama_layanan_id : $item->nama_layanan_en }}
                                </h3>
                                <p class="text-gray-600 text-sm leading-relaxed mb-6 line-clamp-2">
                                    {{ $locale == 'id' ? $item->deskripsi_id : $item->deskripsi_en }}
                                </p>
                            </div>
                            <div>
                                <button type="button" class="btn-learn-more inline-flex items-center text-sm font-semibold text-hpi-green hover:underline group cursor-pointer"
                                    data-id="{{ $item->id }}"
                                    data-title="{{ $locale == 'id' ? $item->nama_layanan_id : $item->nama_layanan_en }}"
                                    data-description="{{ $locale == 'id' ? $item->deskripsi_id : $item->deskripsi_en }}"
                                    data-image="{{ $item->url_gambar ? asset('storage/' . $item->url_gambar) : '' }}">
                                    {{ $locale == 'id' ? 'Pelajari Lebih Lanjut' : 'Learn More' }}
                                    <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>

        <div class="text-center max-w-xl mx-auto border-t border-gray-200 pt-12">
            <h4 class="text-sm font-bold text-hpi-green mb-2">
                {{ $locale == 'id' ? 'Butuh Pemandu Spesialis?' : 'Need a Specialist Guide?' }}
            </h4>
            <p class="text-gray-500 text-xs md:text-sm mb-6 leading-relaxed">
                {{ $locale == 'id'
                    ? 'Temukan pemandu yang tepat untuk kebutuhan perjalanan Anda di direktori anggota kami, atau hubungi HPI Kabupaten Malang untuk rekomendasi.'
                    : 'Find the right guide for your travel needs in our member directory, or contact HPI Malang Regency for recommendations.' }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="/direktori" class="w-full sm:w-auto bg-hpi-green text-white text-xs font-semibold px-6 py-3 rounded-lg hover:bg-teal-900 transition-colors shadow-sm text-center">
                    {{ $locale == 'id' ? 'Cari di Direktori' : 'Search Directory' }}
                </a>
                <a href="/hubungi-kami" class="w-full sm:w-auto border border-gray-300 text-hpi-green text-xs font-semibold px-6 py-3 rounded-lg hover:bg-gray-50 transition-colors text-center">
                    {{ $locale == 'id' ? 'Hubungi Kami' : 'Contact Us' }}
                </a>
            </div>
        </div>

    <!-- Modal Popup for Service Detail -->
    <div id="layanan-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm opacity-0 pointer-events-none" style="display: none;">
        <!-- Modal Card (The target for FLIP) -->
        <div id="modal-card" class="bg-white rounded-3xl overflow-hidden shadow-2xl max-w-2xl w-full relative flex flex-col max-h-[90vh]">
            <!-- Close Button -->
            <button id="modal-close" class="absolute top-4 right-4 z-10 bg-white/80 hover:bg-white text-gray-800 p-2 rounded-full shadow-md transition-all cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            
            <!-- Modal Image -->
            <div class="relative h-64 sm:h-80 bg-gray-200">
                <img id="modal-image" src="" alt="" class="w-full h-full object-cover">
                <div class="absolute bottom-4 left-6 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-xl text-hpi-green text-sm font-bold shadow-sm">
                    <span>{{ $locale == 'id' ? 'Detail Layanan' : 'Service Details' }}</span>
                </div>
            </div>
            
            <!-- Modal Body -->
            <div class="p-6 sm:p-8 overflow-y-auto flex-1">
                <h3 id="modal-title" class="text-2xl font-bold text-hpi-green mb-4"></h3>
                <p id="modal-description" class="text-gray-600 text-sm sm:text-base leading-relaxed whitespace-pre-line"></p>
            </div>
        </div>
    </div>

    </div>

<!-- Load GSAP & Flip Plugin CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/Flip.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Register Flip plugin
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
        const p = document.querySelector("div.text-center.mb-16 p");
        const cards = document.querySelectorAll(".grid > div");

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
                stagger: 0.15,
                duration: 0.8,
                ease: "power2.out"
            }, 0.5);
        }

        // ================= GSAP FLIP MODAL LOGIC =================
        const modal = document.querySelector("#layanan-modal");
        const modalClosed = document.querySelector("#modal-close");
        const modalImage = document.querySelector("#modal-image");
        const modalTitle = document.querySelector("#modal-title");
        const modalDescription = document.querySelector("#modal-description");
        const modalItemCard = document.querySelector("#modal-card");

        let activeCard = null;

        document.querySelectorAll(".btn-learn-more").forEach(btn => {
            btn.addEventListener("click", () => {
                const card = btn.closest(".card-container");
                activeCard = card;

                // Populate modal content
                modalTitle.textContent = btn.getAttribute("data-title");
                modalDescription.textContent = btn.getAttribute("data-description");
                
                const imgUrl = btn.getAttribute("data-image");
                if (imgUrl) {
                    modalImage.src = imgUrl;
                    modalImage.style.display = "block";
                } else {
                    modalImage.style.display = "none";
                }

                // Get state of the source card
                const state = Flip.getState(card);

                // Show modal overlay backdrop
                modal.style.display = "flex";
                modal.style.pointerEvents = "auto";
                gsap.to(modal, { opacity: 1, duration: 0.3 });

                // Flip the modal card container from the original card's geometry
                Flip.from(state, {
                    targets: modalItemCard,
                    duration: 0.6,
                    ease: "back.out(1.2)",
                    absolute: true,
                });
            });
        });

        // Close modal function
        function closeModal() {
            if (!activeCard) return;

            // Get state of the modal card
            const state = Flip.getState(modalItemCard);

            // Fade out overlay backdrop
            gsap.to(modal, {
                opacity: 0,
                duration: 0.3,
                onComplete: () => {
                    modal.style.display = "none";
                    modal.style.pointerEvents = "none";
                }
            });

            // Flip back from modal card geometry to the card container
            Flip.from(state, {
                targets: activeCard,
                duration: 0.5,
                ease: "power2.inOut",
                absolute: true,
            });
        }

        modalClosed.addEventListener("click", closeModal);
        modal.addEventListener("click", (e) => {
            if (e.target === modal) {
                closeModal();
            }
        });
    });
</script>
@endsection