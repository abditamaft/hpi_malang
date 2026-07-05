@extends('layouts.main') 
@section('title', session('locale') == 'en' ? 'About Us - HPI Malang Regency' : 'Tentang Kami - HPI Kabupaten Malang')

@section('content')
<style>
    /* Styling for pinning wrapper to prevent scroll jumps */
    .about-pin-section {
        position: relative;
        overflow: hidden;
    }
</style>

<!-- SECTION 1: INTRO -->
<section id="about-section-1" class="relative min-h-screen flex flex-col justify-center items-center px-6 text-center bg-white overflow-hidden">
    <!-- SVG Transition Overlay Section 1 (Left to Right curve) -->
    <div class="absolute inset-0 pointer-events-none z-40">
        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path id="svg-overlay-1" d="M 0 0 L 0 0 Q 0 50 0 100 L 0 100 Z" fill="#ffffff" />
        </svg>
    </div>
    
    <div class="relative z-10 max-w-4xl mx-auto py-20">
        <h1 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-6 leading-tight">
            {{ session('locale') == 'en' 
                ? ($settings->judul_tentang_kami_en ?? 'Building Malang Tourism Professionalism') 
                : ($settings->judul_tentang_kami_id ?? 'Membangun Profesionalisme Pariwisata Malang') }}
        </h1>
        <p class="text-gray-600 md:text-lg max-w-3xl mx-auto leading-relaxed">
            {{ session('locale') == 'en' 
                ? 'The Indonesian Tourist Guide Association (HPI) of Malang Regency is the official forum for professional tour guides. We are dedicated to maintaining service standards, preserving local culture, and being the vanguard in welcoming the world to Bumi Arema.' 
                : 'Himpunan Pramuwisata Indonesia (HPI) Kabupaten Malang adalah wadah resmi bagi para pemandu wisata profesional. Kami berdedikasi untuk menjaga standar pelayanan, melestarikan budaya lokal, dan menjadi garda terdepan dalam menyambut dunia di Bumi Arema.' }}
        </p>
    </div>
</section>

<!-- SECTION 2: VISION & MISSION -->
<section id="about-section-2" class="relative min-h-screen flex flex-col justify-center py-20 bg-gray-50 px-6 overflow-hidden">
    <!-- SVG Transition Overlay Section 2 (Center Circle Expansion) -->
    <div class="absolute inset-0 pointer-events-none z-40">
        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <circle id="svg-overlay-2" cx="50" cy="50" r="0" fill="#ffffff" />
        </svg>
    </div>

    <div class="max-w-6xl mx-auto w-full relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-3">
                {{ session('locale') == 'en' ? 'Organizational Vision & Mission' : 'Visi & Misi Organisasi' }}
            </h2>
            <p class="text-gray-500 text-sm md:text-base">
                {{ session('locale') == 'en' ? 'Our direction and commitment in advancing the tourism sector in Malang Regency through excellent guiding services.' : 'Arah langkah dan komitmen kami dalam memajukan sektor pariwisata di Kabupaten Malang melalui pelayanan kepramuwisataan yang prima.' }}
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 w-full">
            
            <div class="lg:col-span-4">
                <div class="bg-[#005344] text-white p-8 md:p-10 rounded-3xl h-full shadow-lg relative overflow-hidden flex flex-col justify-center">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-white opacity-5 rounded-full blur-2xl"></div>
                    <div class="relative z-10">
                        <h3 class="text-2xl font-bold mb-6 text-emerald-300">
                            {{ session('locale') == 'en' ? 'Vision' : 'Visi' }}
                        </h3>
                        <p class="text-lg md:text-xl font-medium leading-relaxed">
                            {{ session('locale') == 'en' 
                                ? ($visi->deskripsi_en ?? 'To make HPI Malang Regency a resilient, professional, and globally competitive professional organization.') 
                                : ($visi->deskripsi_id ?? 'Menjadikan HPI Kabupaten Malang sebagai organisasi profesi yang tangguh, profesional, dan berdaya saing global.') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($misi as $item)
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300 group">
                        <div class="w-10 h-10 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center font-bold text-lg mb-4 group-hover:scale-110 transition-transform">
                            {{ $item->urutan ?? $loop->iteration }}
                        </div>
                        <h4 class="font-bold text-gray-800 mb-2">
                            {{ session('locale') == 'en' ? $item->judul_en : $item->judul_id }}
                        </h4>
                        <p class="text-gray-500 text-sm leading-relaxed">
                            {{ session('locale') == 'en' ? $item->deskripsi_en : $item->deskripsi_id }}
                        </p>
                    </div>
                    @endforeach
                    
                    @if($misi->isEmpty())
                        <p class="text-gray-400 italic">
                            {{ session('locale') == 'en' ? 'Mission data has not been added yet.' : 'Data misi belum ditambahkan.' }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- SECTION 3: STRUCTURE -->
<section id="about-section-3" class="relative min-h-screen flex flex-col justify-center py-20 px-6 bg-white overflow-hidden">
    <div class="max-w-5xl mx-auto w-full relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-3">
                {{ session('locale') == 'en' ? 'Organizational Structure' : 'Struktur Organisasi' }}
            </h2>
            <p class="text-gray-500 text-sm md:text-base">
                {{ session('locale') == 'en' ? 'The supporting pillars that ensure the organization runs professionally, transparently, and accountably.' : 'Pilar penyangga yang memastikan jalannya roda organisasi secara profesional, transparan, dan akuntabel.' }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white border border-gray-200 border-t-8 border-t-[#005344] rounded-3xl p-8 text-center hover:shadow-lg transition-shadow duration-300">
                <svg class="w-8 h-8 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                <h4 class="text-xs font-bold text-[#005344] uppercase tracking-widest mb-2">
                    {{ session('locale') == 'en' ? 'Advisory Board' : 'Dewan Penasihat' }}
                </h4>
                @foreach($dewanPenasihat as $pengurus)
                    <p class="text-lg font-semibold text-gray-800">{{ $pengurus->nama }}</p>
                @endforeach
            </div>

            <div class="bg-white border border-gray-200 border-t-8 border-t-[#937538] rounded-3xl p-8 text-center hover:shadow-lg transition-shadow duration-300">
                <svg class="w-8 h-8 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/></svg>
                <h4 class="text-xs font-bold text-[#937538] uppercase tracking-widest mb-2">
                    {{ session('locale') == 'en' ? 'Board of Ethics' : 'Dewan Kode Etik' }}
                </h4>
                @foreach($dewanKodeEtik as $pengurus)
                    <p class="text-lg font-semibold text-gray-800">{{ $pengurus->nama }}</p>
                @endforeach
            </div>
        </div>

        <div class="bg-gray-100 rounded-[2.5rem] p-8 md:p-12 text-center">
            <svg class="w-10 h-10 text-emerald-700 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            <h3 class="text-xl font-bold text-gray-900 mb-1">
                {{ session('locale') == 'en' ? 'Executive Board' : 'Pengurus Harian' }}
            </h3>
            <p class="text-gray-500 text-sm mb-10">
                {{ session('locale') == 'en' ? 'Current Period' : 'Periode Berjalan' }}
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($pengurusHarian as $pengurus)
                <div class="bg-white rounded-2xl p-6 shadow-sm flex flex-col justify-center min-h-[120px]">
                    <h4 class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest mb-1">
                        {{ session('locale') == 'en' ? $pengurus->jabatan_en : $pengurus->jabatan_id }}
                    </h4>
                    @if($pengurus->divisi_id || $pengurus->divisi_en)
                        <p class="text-xs text-gray-400 mb-3">
                            {{ session('locale') == 'en' ? $pengurus->divisi_en : $pengurus->divisi_id }}
                        </p>
                    @endif
                    <p class="text-base font-bold text-gray-800">{{ $pengurus->nama }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Load GSAP & ScrollTrigger CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        gsap.registerPlugin(ScrollTrigger);

        // Custom character-by-character splitter helper
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

        // ================= SECTION 1 ANIMATION =================
        const h1Section1 = document.querySelector("#about-section-1 h1");
        const pSection1 = document.querySelector("#about-section-1 p");
        
        const charsH1 = splitTextByChars(h1Section1);
        const charsP1 = splitTextByChars(pSection1);

        const tl1 = gsap.timeline({
            scrollTrigger: {
                trigger: "#about-section-1",
                start: "top top",
                end: "+=220%",
                pin: true,
                scrub: 1.2,
            }
        });

        // 1. Stagger chars in
        if (charsH1.length > 0) {
            tl1.to(charsH1, {
                opacity: 1,
                y: 0,
                stagger: 0.015,
                duration: 0.6,
                ease: "power2.out"
            }, 0);
        }
        if (charsP1.length > 0) {
            tl1.to(charsP1, {
                opacity: 1,
                y: 0,
                stagger: 0.003,
                duration: 0.6,
                ease: "power2.out"
            }, 0.2);
        }

        // 2. Wipe SVG overlay (Left to Right) - delay to 2.0 to give time to read
        tl1.to("#svg-overlay-1", {
            attr: { d: "M 0 0 L 50 0 Q 70 50 50 100 L 0 100 Z" },
            duration: 0.6,
            ease: "none"
        }, 2.0)
        .to("#svg-overlay-1", {
            attr: { d: "M 0 0 L 100 0 L 100 100 L 0 100 Z" },
            duration: 0.6,
            ease: "none"
        }, 2.6);


        // ================= SECTION 2 ANIMATION =================
        const h2Section2 = document.querySelector("#about-section-2 h2");
        const pSection2 = document.querySelector("#about-section-2 p");
        const gridSection2 = document.querySelector("#about-section-2 .grid");

        const charsH2 = splitTextByChars(h2Section2);
        const charsP2 = splitTextByChars(pSection2);

        if (gridSection2) {
            gsap.set(gridSection2, { opacity: 0, y: 40 });
        }

        const tl2 = gsap.timeline({
            scrollTrigger: {
                trigger: "#about-section-2",
                start: "top top",
                end: "+=250%",
                pin: true,
                scrub: 1.2,
            }
        });

        // 1. Stagger chars & cards in
        if (charsH2.length > 0) {
            tl2.to(charsH2, {
                opacity: 1,
                y: 0,
                stagger: 0.015,
                duration: 0.6,
                ease: "power2.out"
            }, 0);
        }
        if (charsP2.length > 0) {
            tl2.to(charsP2, {
                opacity: 1,
                y: 0,
                stagger: 0.003,
                duration: 0.6,
                ease: "power2.out"
            }, 0.2);
        }
        if (gridSection2) {
            tl2.to(gridSection2, {
                opacity: 1,
                y: 0,
                duration: 0.8,
                ease: "power2.out"
            }, 0.3);
        }

        // 2. Expanding Circle Transition - delay to 2.2 to give time to read
        tl2.to("#svg-overlay-2", {
            attr: { r: 75 },
            duration: 1.0,
            ease: "power1.inOut"
        }, 2.2);


        // ================= SECTION 3 ANIMATION =================
        const h2Section3 = document.querySelector("#about-section-3 h2");
        const pSection3 = document.querySelector("#about-section-3 p");
        const gridSection3 = document.querySelector("#about-section-3 .grid");
        const cardSection3 = document.querySelector("#about-section-3 .bg-gray-100");

        const charsH3 = splitTextByChars(h2Section3);
        const charsP3 = splitTextByChars(pSection3);

        if (gridSection3) gsap.set(gridSection3, { opacity: 0, y: 40 });
        if (cardSection3) gsap.set(cardSection3, { opacity: 0, y: 40 });

        const tl3 = gsap.timeline({
            scrollTrigger: {
                trigger: "#about-section-3",
                start: "top top",
                end: "+=120%",
                pin: true,
                scrub: 1.2,
            }
        });

        // Stagger chars & structures in
        if (charsH3.length > 0) {
            tl3.to(charsH3, {
                opacity: 1,
                y: 0,
                stagger: 0.015,
                duration: 0.6,
                ease: "power2.out"
            }, 0);
        }
        if (charsP3.length > 0) {
            tl3.to(charsP3, {
                opacity: 1,
                y: 0,
                stagger: 0.003,
                duration: 0.6,
                ease: "power2.out"
            }, 0.2);
        }
        if (gridSection3) {
            tl3.to(gridSection3, {
                opacity: 1,
                y: 0,
                duration: 0.8,
                ease: "power2.out"
            }, 0.3);
        }
        if (cardSection3) {
            tl3.to(cardSection3, {
                opacity: 1,
                y: 0,
                duration: 0.8,
                ease: "power2.out"
            }, 0.5);
        }
    });
</script>
@endsection