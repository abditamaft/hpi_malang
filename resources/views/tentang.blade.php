@extends('layouts.main') 
@section('title', session('locale') == 'en' ? 'About Us - HPI Malang Regency' : 'Tentang Kami - HPI Kabupaten Malang')

@section('content')

@php
    // Memanggil data Kontak langsung dari database untuk section Hubungi Kami
    $kontak = \App\Models\Kontak::first();

    // Memisahkan Ketua Umum, Wakil Ketua, dan Sisa Pengurus dari data Pengurus Harian
    $ketuaUmum = $pengurusHarian->filter(function($p) {
        return preg_match('/ketua/i', $p->jabatan_id) && !preg_match('/wakil/i', $p->jabatan_id);
    });
    $wakilKetua = $pengurusHarian->filter(function($p) {
        return preg_match('/wakil ketua/i', $p->jabatan_id);
    });
    $sisaPengurus = $pengurusHarian->reject(function($p) {
        return preg_match('/ketua/i', $p->jabatan_id);
    });
@endphp

<style>
    /* Styling for pinning wrapper to prevent scroll jumps */
    .about-pin-section {
        position: relative;
        overflow: hidden;
    }

    /* Scroll indicator styles */
    .scroll-indicator-container {
        position: fixed;
        right: 2rem;
        top: 50%;
        transform: translateY(-50%);
        z-index: 50;
        display: flex;
        align-items: center;
        gap: 1rem;
        pointer-events: none;
    }
    @media (max-width: 768px) {
        .scroll-indicator-container {
            display: none !important;
        }
    }
    .scroll-indicator-track-wrapper {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        height: 180px;
        width: 24px;
        pointer-events: auto;
    }
    .scroll-indicator-track {
        position: absolute;
        top: 10px;
        bottom: 10px;
        width: 2px;
        background-color: #e5e7eb; /* gray-200 */
        border-radius: 9999px;
    }
    .scroll-indicator-progress {
        position: absolute;
        top: 10px;
        width: 2px;
        background-color: #005344; /* hpi green */
        border-radius: 9999px;
        height: 0%;
        transition: height 0.1s ease;
    }
    .scroll-indicator-dot {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 2px solid #d1d5db; /* gray-300 */
        background-color: #ffffff;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }
    .scroll-indicator-dot::after {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background-color: transparent;
        transition: all 0.3s ease;
    }
    /* Active dot styling */
    .scroll-indicator-dot.active {
        border-color: #005344;
    }
    .scroll-indicator-dot.active::after {
        background-color: #005344;
        transform: scale(1.2);
    }
    /* Completed dot styling */
    .scroll-indicator-dot.completed {
        border-color: #10b981; /* green-500 */
        background-color: #10b981;
    }
    .scroll-indicator-dot.completed::after {
        content: '✓';
        color: white;
        font-size: 10px;
        font-weight: bold;
        background-color: transparent;
        border-radius: 0;
        width: auto;
        height: auto;
        transform: scale(1);
    }
</style>

<!-- Scroll Indicator -->
<div class="scroll-indicator-container hidden md:flex">
    <div class="scroll-indicator-track-wrapper">
        <div class="scroll-indicator-track"></div>
        <div id="scroll-indicator-progress" class="scroll-indicator-progress"></div>
        <div data-section="1" class="scroll-indicator-dot active" style="top: 0;" title="Intro"></div>
        <div data-section="2" class="scroll-indicator-dot" style="top: calc(50% - 10px);" title="Visi & Misi"></div>
        <div data-section="3" class="scroll-indicator-dot" style="bottom: 0;" title="Structure"></div>
    </div>
</div>

<!-- SECTION 1: INTRO -->
<section id="about-section-1" class="relative min-h-screen flex flex-col justify-center items-center px-6 text-center bg-white overflow-hidden">
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
                {{ session('locale') == 'en' ? 'Direction & Goals' : 'Arah & Tujuan' }}
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
                                : ($visi->deskripsi_id ?? 'Mewujudkan Himpunan Pramuwisata Indonesia sebagai organisasi yang profesional, berdaya saing, dan sejahtera.') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-8">
                <div class="mb-6">
                    <h3 class="text-xl md:text-2xl font-bold text-gray-800 border-l-4 border-amber-500 pl-4">
                        {{ session('locale') == 'en' ? 'Strategic Steps (Mission)' : 'Langkah Strategis (Misi)' }}
                    </h3>
                </div>
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
<section id="about-section-3" class="relative min-h-screen flex flex-col justify-center py-24 px-6 bg-gradient-to-b from-white via-gray-50/50 to-white overflow-hidden">

    <!-- Decorative background accents -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-[#005344]/[0.03] rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-[#937538]/[0.05] rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-5xl mx-auto w-full relative z-10">

        <div class="text-center mb-20">
            <span class="inline-block w-12 h-1 bg-gradient-to-r from-[#005344] to-[#937538] rounded-full mb-5"></span>
            <h2 class="text-2xl md:text-4xl font-extrabold text-gray-900 mb-3 uppercase tracking-widest">
                {{ session('locale') == 'en' ? 'Board of Directors' : 'Jajaran Pengurus' }}
            </h2>
            <p class="text-gray-500 text-base md:text-lg font-medium">
                {{ session('locale') == 'en' ? 'Leadership Team 2026–2030' : 'Tim Kepemimpinan 2026–2030' }}
            </p>
        </div>

        <!-- BARIS ATAS: KETUA UMUM & WAKIL KETUA UMUM -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 mb-10">

            <div class="group relative bg-white border border-gray-100 rounded-3xl p-10 text-center shadow-sm hover:shadow-2xl hover:-translate-y-1 transition-all duration-500 overflow-hidden">
                <!-- top accent bar -->
                <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-[#005344] to-[#007a63]"></div>
                <!-- subtle corner glow -->
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-[#005344]/[0.06] rounded-full blur-2xl"></div>

                <div class="relative z-10">
                    <span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-[#005344]/10 mb-5">
                        <svg class="w-5 h-5 text-[#005344]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </span>

                    <h4 class="text-xs font-bold text-[#005344] uppercase tracking-[0.2em] mb-4">
                        {{ session('locale') == 'en' ? 'General Chairman' : 'Ketua Umum' }}
                    </h4>

                    @foreach($ketuaUmum as $pengurus)
                        @if($pengurus->foto)
                            <img src="{{ asset('storage/' . $pengurus->foto) }}"
                                 class="w-28 h-28 rounded-full object-cover mx-auto mb-5 border-4 border-white ring-2 ring-[#005344]/20 shadow-lg group-hover:ring-[#005344]/40 transition-all duration-500">
                        @else
                            <div class="w-28 h-28 rounded-full bg-[#005344]/5 flex items-center justify-center mx-auto mb-5 border-4 border-white ring-2 ring-[#005344]/20 shadow-lg">
                                <svg class="w-12 h-12 text-[#005344]/60" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            </div>
                        @endif
                        <p class="text-xl font-bold text-gray-900 tracking-tight">{{ $pengurus->nama }}</p>
                    @endforeach
                </div>
            </div>

            <div class="group relative bg-white border border-gray-100 rounded-3xl p-10 text-center shadow-sm hover:shadow-2xl hover:-translate-y-1 transition-all duration-500 overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-[#937538] to-[#b4924a]"></div>
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-[#937538]/[0.08] rounded-full blur-2xl"></div>

                <div class="relative z-10">
                    <span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-[#937538]/10 mb-5">
                        <svg class="w-5 h-5 text-[#937538]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </span>

                    <h4 class="text-xs font-bold text-[#937538] uppercase tracking-[0.2em] mb-4">
                        {{ session('locale') == 'en' ? 'Vice General Chairman' : 'Wakil Ketua Umum' }}
                    </h4>

                    @foreach($wakilKetua as $pengurus)
                        @if($pengurus->foto)
                            <img src="{{ asset('storage/' . $pengurus->foto) }}"
                                 class="w-28 h-28 rounded-full object-cover mx-auto mb-5 border-4 border-white ring-2 ring-[#937538]/20 shadow-lg group-hover:ring-[#937538]/40 transition-all duration-500">
                        @else
                            <div class="w-28 h-28 rounded-full bg-[#937538]/5 flex items-center justify-center mx-auto mb-5 border-4 border-white ring-2 ring-[#937538]/20 shadow-lg">
                                <svg class="w-12 h-12 text-[#937538]/60" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            </div>
                        @endif
                        <p class="text-xl font-bold text-gray-900 tracking-tight">{{ $pengurus->nama }}</p>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- BARIS BAWAH: SISA JAJARAN PENGURUS -->
        <div class="relative bg-gradient-to-br from-gray-50 to-gray-100/70 rounded-[2.5rem] p-8 md:p-14 text-center border border-gray-100">

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5">
                @foreach($sisaPengurus as $pengurus)
                <div class="group bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl flex flex-col items-center justify-center min-h-[150px] border border-gray-100 hover:border-[#005344]/30 hover:-translate-y-0.5 transition-all duration-300">

                    @if($pengurus->foto)
                        <img src="{{ asset('storage/' . $pengurus->foto) }}"
                             class="w-16 h-16 rounded-full object-cover mb-3 border-2 border-white ring-2 ring-[#005344]/10 shadow-sm group-hover:ring-[#005344]/30 transition-all duration-300">
                    @else
                        <div class="w-16 h-16 rounded-full bg-[#005344]/5 flex items-center justify-center mb-3 border-2 border-white ring-2 ring-[#005344]/10 shadow-sm">
                            <svg class="w-7 h-7 text-[#005344]/50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                    @endif

                    <h4 class="text-[10px] font-bold text-[#005344] uppercase tracking-widest mb-1 bg-[#005344]/5 px-2.5 py-1 rounded-full">
                        {{ session('locale') == 'en' ? $pengurus->jabatan_en : $pengurus->jabatan_id }}
                    </h4>

                    @if($pengurus->divisi_id || $pengurus->divisi_en)
                        <p class="text-xs text-gray-400 mb-2 mt-1">
                            {{ session('locale') == 'en' ? $pengurus->divisi_en : $pengurus->divisi_id }}
                        </p>
                    @endif

                    <p class="text-base font-bold text-gray-900 tracking-tight">{{ $pengurus->nama }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- SECTION 4: HUBUNGI KAMI -->
<section id="about-section-4" class="py-20 bg-[#F4F4F4] overflow-hidden">
    <div class="max-w-5xl mx-auto px-6 text-center">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 uppercase tracking-widest">
            {{ session('locale') == 'en' ? 'Contact Us' : 'Hubungi Kami' }}
        </h2>
        <p class="text-gray-500 text-sm md:text-base max-w-2xl mx-auto mb-12">
            {{ session('locale') == 'en' ? 'Ready to serve domestic and international tourists throughout the Greater Malang area, East Java, and all of Indonesia.' : 'Siap melayani wisatawan domestik dan mancanegara di seluruh wilayah Malang Raya, Jawa Timur, dan seluruh Indonesia.' }}
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Telepon -->
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 flex flex-col items-center">
                <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                </div>
                <h4 class="font-bold text-gray-800 mb-2">{{ session('locale') == 'en' ? 'Phone' : 'Telepon' }}</h4>
                <p class="text-gray-600 font-medium">{{ $kontak->telepon ?? '+62 8133 1882 889' }}</p>
            </div>

            <!-- Email -->
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 flex flex-col items-center">
                <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <h4 class="font-bold text-gray-800 mb-2">Email</h4>
                <p class="text-gray-600 font-medium">{{ $kontak->email ?? 'hpimalang21@gmail.com' }}</p>
            </div>

            <!-- Alamat -->
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 flex flex-col items-center">
                <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <h4 class="font-bold text-gray-800 mb-2">{{ session('locale') == 'en' ? 'Address' : 'Alamat' }}</h4>
                <p class="text-gray-600 text-sm leading-relaxed">{{ session('locale') == 'en' ? ($kontak->alamat_en ?? 'Malang Tourism Gateway, Jl. Agus Salim No.11') : ($kontak->alamat_id ?? 'Malang Tourism Gateway, Jl. Agus Salim No.11 Gedung O, Kiduldalem, Klojen, Kota Malang') }}</p>
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

        // Animasi split text langsung muncul tanpa scroll trigger
        const tl1 = gsap.timeline();
        if (charsH1.length > 0) {
            tl1.to(charsH1, { opacity: 1, y: 0, stagger: 0.015, duration: 0.6, ease: "power2.out" }, 0.1);
        }
        if (charsP1.length > 0) {
            tl1.to(charsP1, { opacity: 1, y: 0, stagger: 0.003, duration: 0.6, ease: "power2.out" }, 0.3);
        }



        // ================= SECTION 2 ANIMATION =================
        const h2Section2 = document.querySelector("#about-section-2 h2");
        const pSection2 = document.querySelector("#about-section-2 p");
        const gridSection2 = document.querySelector("#about-section-2 .grid");

        const charsH2 = splitTextByChars(h2Section2);
        const charsP2 = splitTextByChars(pSection2);

        if (gridSection2) gsap.set(gridSection2, { opacity: 0, y: 40 });

        const tl2 = gsap.timeline({
            scrollTrigger: {
                trigger: "#about-section-2",
                start: "top top",
                end: "+=250%",
                pin: true,
                scrub: 1.2,
            }
        });

        if (charsH2.length > 0) tl2.to(charsH2, { opacity: 1, y: 0, stagger: 0.015, duration: 0.6, ease: "power2.out" }, 0);
        if (charsP2.length > 0) tl2.to(charsP2, { opacity: 1, y: 0, stagger: 0.003, duration: 0.6, ease: "power2.out" }, 0.2);
        if (gridSection2) tl2.to(gridSection2, { opacity: 1, y: 0, duration: 0.8, ease: "power2.out" }, 0.3);

        tl2.to("#svg-overlay-2", { attr: { r: 75 }, duration: 1.0, ease: "power1.inOut" }, 2.2);

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

        if (charsH3.length > 0) tl3.to(charsH3, { opacity: 1, y: 0, stagger: 0.015, duration: 0.6, ease: "power2.out" }, 0);
        if (charsP3.length > 0) tl3.to(charsP3, { opacity: 1, y: 0, stagger: 0.003, duration: 0.6, ease: "power2.out" }, 0.2);
        if (gridSection3) tl3.to(gridSection3, { opacity: 1, y: 0, duration: 0.8, ease: "power2.out" }, 0.3);
        if (cardSection3) tl3.to(cardSection3, { opacity: 1, y: 0, duration: 0.8, ease: "power2.out" }, 0.5);

        // ================= SCROLL INDICATOR LOGIC =================
        const progressLine = document.querySelector("#scroll-indicator-progress");
        const dots = document.querySelectorAll(".scroll-indicator-dot");

        function setActiveIndicator(index, progress) {
            dots.forEach((dot, idx) => {
                dot.classList.remove("active", "completed");
                if (idx < index) {
                    dot.classList.add("completed");
                } else if (idx === index) {
                    dot.classList.add("active");
                }
            });

            let overallProgress = 0;
            if (index === 0) {
                overallProgress = progress * 50;
            } else if (index === 1) {
                overallProgress = 50 + (progress * 50);
            } else if (index >= 2) {
                overallProgress = 100;
            }
            progressLine.style.height = `${overallProgress}%`;
        }

        // Track Section 1
        ScrollTrigger.create({
            trigger: "#about-section-1",
            start: "top top",
            end: "bottom top",
            onUpdate: (self) => {
                if (self.isActive) {
                    setActiveIndicator(0, self.progress);
                }
            },
            onLeaveBack: () => {
                setActiveIndicator(0, 0);
            }
        });

        // Track Section 2
        ScrollTrigger.create({
            trigger: "#about-section-2",
            start: "top top",
            end: "+=250%",
            onUpdate: (self) => {
                if (self.isActive) {
                    setActiveIndicator(1, self.progress);
                }
            }
        });

        // Track Section 3
        ScrollTrigger.create({
            trigger: "#about-section-3",
            start: "top top",
            end: "+=120%",
            onUpdate: (self) => {
                if (self.isActive) {
                    setActiveIndicator(2, self.progress);
                }
            }
        });

        // Dot click handler for smooth scrolling
        dots.forEach((dot, idx) => {
            dot.addEventListener("click", () => {
                const targetIds = ["about-section-1", "about-section-2", "about-section-3"];
                const targetId = targetIds[idx];
                const st = ScrollTrigger.getAll().find(st => st.trigger && st.trigger.id === targetId);
                
                if (st) {
                    window.scrollTo({
                        top: st.start + 5,
                        behavior: "smooth"
                    });
                }
            });
        });
    });
</script>
@endsection