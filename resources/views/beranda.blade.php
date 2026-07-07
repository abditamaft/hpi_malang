@extends('layouts.main')

@section('content')
@php 
    $locale = session('locale', 'id'); 
    // Tarik data web_settings & ketua dari database
    $settings = \App\Models\WebSetting::first();
    $ketua = \App\Models\StrukturOrganisasi::where('jabatan_id', 'like', '%Ketua%')->first();
@endphp

<!-- 1. HERO SECTION (100% Dinamis & Responsif) -->
<!-- Menggunakan bg-cover bg-center agar aman di HP (terpotong rapi tanpa gepeng) -->
<section id="hero-section" class="relative min-h-[100dvh] flex flex-col justify-between pt-24 pb-10 md:pb-16 text-white overflow-hidden bg-neutral-900">
    
    <!-- Background Gambar dari Database (Jika kosong, pakai gambar default Bromo) -->
    <div class="absolute inset-0 bg-cover bg-center z-0 animate-hero-bg" 
         style="background-image: url('{{ $settings && $settings->hero_gambar ? asset('storage/'.$settings->hero_gambar) : 'https://source.unsplash.com/1600x900/?mountain,bromo' }}');">
        <div class="absolute inset-0 bg-black/40"></div>
    </div>

    <!-- SVG Curve Transition Overlay -->
    <div class="absolute inset-0 pointer-events-none z-20">
        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path id="curve-path" d="M 0 100 Q 50 100 100 100 L 100 100 L 0 100 Z" fill="#ffffff" />
        </svg>
    </div>
    
    <div id="hero-content" class="relative z-10 flex-1 flex flex-col justify-between w-full">
        <!-- Teks Judul Utama (Di Tengah) -->
        <div class="flex-1 flex flex-col items-center justify-center text-center px-6 mt-10 md:mt-0 reveal-on-scroll">
            @if($settings && ($locale == 'id' ? $settings->hero_judul_id : $settings->hero_judul_en))
                <h1 id="hero-title" class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-4 leading-tight tracking-wide drop-shadow-lg">
                    {!! $locale == 'id' ? $settings->hero_judul_id : $settings->hero_judul_en !!}
                </h1>
            @else
                <!-- Fallback Default persis seperti desain -->
                <h1 id="hero-title" class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-4 leading-tight tracking-wide drop-shadow-lg">
                    Pramuwisata Profesional,<br>
                    <span class="text-hpi-green">Berdaya Saing,</span><br>
                    dan Sejahtera
                </h1>
            @endif
        </div>

        <!-- Badge & Buttons (Di Pojok Kiri Bawah sesuai desain image_1819fc.png) -->
        <div class="w-full max-w-7xl mx-auto px-6 reveal-on-scroll delay-200">
            <div class="max-w-md text-left">
                
                <!-- Badge Sertifikasi (Glassmorphism Halus) -->
                <div class="bg-white/10 backdrop-blur-md border border-white/20 p-4 md:p-5 rounded-xl mb-5 shadow-lg">
                    <div class="flex items-center gap-2 mb-2">
                        <h3 class="font-bold text-base md:text-lg">{{ $locale == 'id' ? 'Sertifikasi Resmi' : 'Official Certification' }}</h3>
                        <!-- Ikon Centang Hijau -->
                        <svg class="w-5 h-5 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    </div>
                    <p class="text-xs md:text-sm text-gray-200 leading-relaxed">
                        {{ $locale == 'id' ? 'Pemandu kami memiliki lisensi resmi standar kompetensi nasional.' : 'Our guides hold official national competency standard licenses.' }}
                    </p>
                </div>
                
                <!-- Buttons (Flex wrap agar turun ke bawah otomatis di HP kecil) -->
                <div class="flex flex-wrap gap-3 md:gap-4">
                    <a href="/direktori" class="bg-hpi-green hover:bg-emerald-900 text-white px-5 md:px-6 py-2.5 md:py-3 rounded-lg font-semibold transition text-sm md:text-base text-center flex-grow md:flex-grow-0">
                        {{ $locale == 'id' ? 'Cari Pemandu' : 'Find a Guide' }}
                    </a>
                    <a href="/tentang" class="bg-black/20 backdrop-blur-sm border border-white hover:bg-white/20 text-white px-5 md:px-6 py-2.5 md:py-3 rounded-lg font-semibold transition text-sm md:text-base text-center flex-grow md:flex-grow-0">
                        {{ $locale == 'id' ? 'Pelajari Lebih Lanjut' : 'Learn More' }}
                    </a>
                </div>
                
            </div>
        </div>
    </div>
</section>

<!-- 2. WELCOME SECTION (Teks Sambutan Dinamis dari web_settings) -->
<section id="welcome-section" class="pt-24 md:pt-28 pb-16 bg-white overflow-hidden min-h-[80vh] md:min-h-screen flex items-center">
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-12 gap-8 md:gap-12 items-center w-full">
        <!-- Foto Ketua -->
        <div class="md:col-span-4 flex justify-center">
            <div class="relative overflow-hidden rounded-2xl w-48 h-48 md:w-64 md:h-64 shadow-lg border-4 border-gray-100 bg-white">
                <!-- Foto ketua masih hardcode karena struktur_organisasi tidak memiliki kolom foto -->
                <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=400&h=400&q=80" alt="Ketua HPI" class="w-full h-full object-cover welcome-image">
                <!-- SVG Curtain overlay -->
                <svg class="absolute inset-0 w-full h-full z-10 pointer-events-none" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <path class="welcome-curtain" d="M 0 0 H 100 V 100 H 0 Z" fill="white" />
                </svg>
            </div>
        </div>
        
        <!-- Teks Sambutan & Nama -->
        <div class="md:col-span-8 text-center md:text-left welcome-text-container">
            <span class="text-5xl md:text-6xl text-yellow-400 font-serif leading-none block mb-2 md:mb-0 md:inline-block">"</span>
            
            <h2 class="text-2xl md:text-3xl font-bold mb-4 md:mb-6 mt-2 text-gray-900 leading-tight welcome-title">
                "{{ $settings && ($locale == 'id' ? $settings->teks_sambutan_id : $settings->teks_sambutan_en) 
                    ? ($locale == 'id' ? $settings->teks_sambutan_id : $settings->teks_sambutan_en) 
                    : ($locale == 'id' ? 'Selamat datang di gerbang pariwisata profesional Kabupaten Malang.' : 'Welcome to the gate of professional tourism in Malang Regency.') }}"
            </h2>
            
            <p class="text-sm md:text-base text-gray-600 mb-6 md:mb-8 leading-relaxed welcome-desc">
                {{ $locale == 'id' ? 'Kami hadir tidak hanya sebagai penunjuk jalan, tetapi sebagai pencerita yang membawa setiap tamu menyelami kedalaman budaya dan keindahan alam Malang. Komitmen kami adalah memberikan standar pelayanan prima yang berintegritas, memastikan setiap perjalanan menjadi pengalaman yang bermakna dan tak terlupakan.' : 'We are here not just as guides, but as storytellers bringing guests into the depth of Malang\'s culture and beauty...' }}
            </p>
            
            <h4 class="font-bold text-base md:text-lg text-gray-900 welcome-author">{{ $ketua ? $ketua->nama : 'Aris Rahma Cita Wimanda' }}</h4>
            <p class="text-xs md:text-sm text-gray-500 font-medium uppercase tracking-wide welcome-role">{{ $ketua ? ($locale == 'id' ? $ketua->jabatan_id : $ketua->jabatan_en) : 'Ketua HPI Kabupaten Malang' }}</p>
        </div>
    </div>
</section>

<!-- 3. TENTANG KAMI SECTION -->
<section id="about-section" class="pt-24 md:pt-28 pb-16 bg-gray-50 overflow-hidden min-h-[80vh] md:min-h-screen flex items-center">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-10 md:gap-16 items-center w-full pt-16 md:pt-24">
        <!-- Gambar (Sembunyikan salah satu di HP agar tidak terlalu memakan tempat) -->
        <div class="flex gap-4 items-center justify-center">
            <!-- Image 1 -->
            <div class="relative overflow-hidden rounded-2xl w-1/2 aspect-[4/5] shadow-md bg-white">
                <img src="https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?auto=format&fit=crop&w=400&h=500&q=80" class="w-full h-full object-cover about-image-1">
                <!-- SVG Curtain overlay 1 -->
                <svg class="absolute inset-0 w-full h-full z-10 pointer-events-none" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <path class="about-curtain-1" d="M 0 0 H 100 V 100 H 0 Z" fill="#f9fafb" />
                </svg>
            </div>
            <!-- Image 2 -->
            <div class="hidden md:block relative overflow-hidden rounded-2xl w-1/2 aspect-[4/6] shadow-lg bg-white -mt-10">
                <img src="https://images.unsplash.com/photo-1530789253388-582c481c54b0?auto=format&fit=crop&w=400&h=600&q=80" class="w-full h-full object-cover about-image-2">
                <!-- SVG Curtain overlay 2 -->
                <svg class="absolute inset-0 w-full h-full z-10 pointer-events-none" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <path class="about-curtain-2" d="M 0 0 H 100 V 100 H 0 Z" fill="#f9fafb" />
                </svg>
            </div>
        </div>

        <div class="about-text-container text-center md:text-left">
            <p class="text-xs md:text-sm font-bold text-gray-500 tracking-widest uppercase mb-2">{{ $locale == 'id' ? 'TENTANG KAMI' : 'ABOUT US' }}</p>
            <h2 class="text-3xl md:text-4xl font-bold text-hpi-green mb-4 md:mb-6 leading-tight about-title">
                {{ $settings ? ($locale == 'id' ? $settings->judul_tentang_kami_id : $settings->judul_tentang_kami_en) : 'Melayani dengan Hati, Membangun Pariwisata Malang' }}
            </h2>
            <p class="text-sm md:text-base text-gray-600 mb-8 md:mb-10 leading-relaxed text-justify about-desc">
                {{ $settings ? ($locale == 'id' ? $settings->deskripsi_tentang_kami_id : $settings->deskripsi_tentang_kami_en) : 'Himpunan Pramuwisata Indonesia (HPI) Kabupaten Malang adalah wadah resmi bagi para pemandu wisata profesional...' }}
            </p>
            <p class="hidden about-subtitle">{{ $settings ? ($locale == 'id' ? $settings->deskripsi_tentang_kami_id : $settings->deskripsi_tentang_kami_en) : 'Himpunan Pramuwisata Indonesia (HPI) Kabupaten Malang adalah wadah resmi bagi para pemandu wisata profesional...' }}</p>
        </div>
    </div>
</section>

<!-- ================= MULAI PENAMBAHAN KODE BARU ================= -->
<!-- 3.5 KEKUATAN ORGANISASI & SEJARAH -->
<section class="py-16 md:py-24 bg-white overflow-hidden border-t border-gray-100 relative">

    <!-- Decorative background glow (green + gold) -->
    <div class="absolute top-20 left-0 w-72 h-72 bg-[#005344]/[0.04] rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-20 right-0 w-72 h-72 bg-[#937538]/[0.06] rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">

        <!-- Kekuatan Organisasi -->
        <div class="mb-20">
            <div class="text-center mb-10 md:mb-14 reveal-on-scroll">
                <span class="inline-block w-14 h-1 bg-gradient-to-r from-[#005344] to-[#937538] rounded-full mb-4"></span>
                <h2 class="text-2xl md:text-3xl font-bold text-hpi-green mb-3">{{ $locale == 'id' ? 'Dalam Rangka Kekuatan Organisasi' : 'Organizational Strength' }}</h2>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-8">
                <!-- 85 Anggota -->
                <div class="group bg-white p-6 rounded-2xl md:rounded-3xl shadow-sm border border-gray-100 border-t-4 border-t-[#005344] text-center reveal-on-scroll hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <h3 class="text-4xl md:text-5xl font-extrabold text-[#005344] mb-2 group-hover:scale-105 transition-transform duration-300">85</h3>
                    <p class="text-[10px] md:text-xs font-semibold text-gray-500 uppercase tracking-wide">{{ $locale == 'id' ? 'Anggota berlisensi aktif' : 'Active Licensed Members' }}</p>
                </div>
                <!-- 1998 Berdiri -->
                <div class="group bg-white p-6 rounded-2xl md:rounded-3xl shadow-sm border border-gray-100 border-t-4 border-t-[#937538] text-center reveal-on-scroll delay-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <h3 class="text-4xl md:text-5xl font-extrabold text-[#937538] mb-2 group-hover:scale-105 transition-transform duration-300">1998</h3>
                    <p class="text-[10px] md:text-xs font-semibold text-gray-500 uppercase tracking-wide">{{ $locale == 'id' ? 'HPI Nasional berdiri' : 'National HPI Founded' }}</p>
                </div>
                <!-- 6 Bahasa -->
                <div class="group bg-white p-6 rounded-2xl md:rounded-3xl shadow-sm border border-gray-100 border-t-4 border-t-[#005344] text-center reveal-on-scroll delay-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <h3 class="text-4xl md:text-5xl font-extrabold text-[#005344] mb-2 group-hover:scale-105 transition-transform duration-300">6</h3>
                    <p class="text-[10px] md:text-xs font-semibold text-gray-500 uppercase tracking-wide">{{ $locale == 'id' ? 'Spesifikasi bahasa tersedia' : 'Available Languages' }}</p>
                </div>
                <!-- JATIM Wilayah -->
                <div class="group bg-white p-6 rounded-2xl md:rounded-3xl shadow-sm border border-gray-100 border-t-4 border-t-[#937538] text-center reveal-on-scroll delay-300 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <h3 class="text-4xl md:text-5xl font-extrabold text-[#937538] mb-2 group-hover:scale-105 transition-transform duration-300">JATIM</h3>
                    <p class="text-[10px] md:text-xs font-semibold text-gray-500 uppercase tracking-wide">{{ $locale == 'id' ? 'Wilayah Kerja Operasional' : 'Operational Area' }}</p>
                </div>
            </div>

            <!-- List Bahasa Tersedia -->
            <div class="max-w-4xl mx-auto bg-gradient-to-br from-gray-50 to-gray-100/60 p-6 md:p-8 rounded-2xl border border-gray-100 reveal-on-scroll">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-y-5 gap-x-2">
                    @php
                        $bahasa = [
                            ['id' => 'Bahasa Inggris', 'en' => 'English'],
                            ['id' => 'Bahasa Belanda', 'en' => 'Dutch'],
                            ['id' => 'Bahasa Indonesia', 'en' => 'Indonesian'],
                            ['id' => 'Bahasa Prancis', 'en' => 'French'],
                            ['id' => 'Bahasa Jepang', 'en' => 'Japanese'],
                            ['id' => 'Bahasa Arab', 'en' => 'Arabic']
                        ];
                    @endphp
                    @foreach($bahasa as $index => $lang)
                    <div class="flex items-center gap-3 group">
                        <div class="w-6 h-6 {{ $index % 2 == 0 ? 'bg-[#005344]' : 'bg-[#937538]' }} rounded-full flex items-center justify-center text-white shrink-0 shadow-sm group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span class="text-sm font-bold text-gray-700">{{ $locale == 'id' ? $lang['id'] : $lang['en'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Sejarah / Perjalanan Organisasi -->
        <div class="mt-24">
            <div class="text-center mb-16 reveal-on-scroll">
                <p class="text-xs md:text-sm font-bold text-gray-500 tracking-widest uppercase mb-2">{{ $locale == 'id' ? 'SEJARAH' : 'HISTORY' }}</p>
                <h2 class="text-2xl md:text-3xl font-bold text-hpi-green">{{ $locale == 'id' ? 'Perjalanan Organisasi' : 'Organizational Journey' }}</h2>
                <span class="inline-block w-14 h-1 bg-gradient-to-r from-[#005344] to-[#937538] rounded-full mt-4"></span>
            </div>

            <div class="relative max-w-5xl mx-auto px-4 md:px-0">
                <!-- Garis Vertikal Timeline Tengah (gradient hijau ke gold) -->
                <div class="absolute left-8 md:left-1/2 top-0 bottom-0 w-1 bg-gradient-to-b from-[#005344] via-gray-200 to-[#937538] transform md:-translate-x-1/2 rounded-full"></div>

                <div class="space-y-12">
                    <!-- 1988 -->
                    <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between w-full reveal-on-scroll">
                        <div class="order-2 md:order-1 w-full md:w-5/12 pl-16 md:pl-0 md:text-right md:pr-12">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $locale == 'id' ? 'Pendirian HPI Nasional' : 'National HPI Founded' }}</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">{{ $locale == 'id' ? 'Himpunan Pramuwisata Indonesia berdiri melalui temu wicara nasional di Pandan, Jawa Timur (29-30 Maret), dan resmi disahkan pada 5 Oktober di Palembang dalam MUNAS Pertama.' : 'The Indonesian Tourist Guide Association was established through a national dialogue in Pandan, East Java (March 29-30), and officially legalized on October 5 in Palembang during the First National Conference.' }}</p>
                        </div>
                        <div class="order-1 md:order-2 absolute left-8 md:left-1/2 transform -translate-x-1/2 flex items-center justify-center w-8 h-8 rounded-full bg-[#005344] border-4 border-white shadow-lg ring-4 ring-[#005344]/10"></div>
                        <div class="order-3 w-full md:w-5/12 pl-16 md:pl-12 mt-2 md:mt-0">
                            <span class="text-3xl md:text-4xl font-extrabold text-[#005344] tracking-wider">1988</span>
                        </div>
                    </div>

                    <!-- 1990 -->
                    <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between w-full reveal-on-scroll">
                        <div class="order-2 md:order-3 w-full md:w-5/12 pl-16 md:pl-12">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $locale == 'id' ? 'Regulasi Pramuwisata' : 'Tour Guide Regulation' }}</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">{{ $locale == 'id' ? 'Keputusan Dirjen Pariwisata Nomor Kep.07/K/111/90 mengatur Lencana Pramuwisata dan Pengatur Wisata, memperkuat posisi HPI sebagai organisasi profesi resmi.' : 'Decree of the Director General of Tourism No. Kep.07/K/111/90 regulates the Guide and Tour Manager Badge, strengthening HPI\'s position as an official professional organization.' }}</p>
                        </div>
                        <div class="order-1 md:order-2 absolute left-8 md:left-1/2 transform -translate-x-1/2 flex items-center justify-center w-8 h-8 rounded-full bg-[#937538] border-4 border-white shadow-lg ring-4 ring-[#937538]/10"></div>
                        <div class="order-3 md:order-1 w-full md:w-5/12 pl-16 md:pl-0 md:text-right md:pr-12 mt-2 md:mt-0">
                            <span class="text-3xl md:text-4xl font-extrabold text-[#937538] tracking-wider">1990</span>
                        </div>
                    </div>

                    <!-- 2008 -->
                    <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between w-full reveal-on-scroll">
                        <div class="order-2 md:order-1 w-full md:w-5/12 pl-16 md:pl-0 md:text-right md:pr-12">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $locale == 'id' ? 'Berdirinya DPC HPI Malang' : 'Establishment of DPC HPI Malang' }}</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">{{ $locale == 'id' ? 'Musyawarah Cabang pertama digelar pada 1 Juni 2008 di Ruang Sidang Mojopahit Balai Kota Malang. Siswantoro ditetapkan sebagai Ketua pertama DPC HPI Kota Malang.' : 'The first Branch Conference was held on June 1, 2008, in the Mojopahit Meeting Room of Malang City Hall. Siswantoro was appointed as the first Chairman of DPC HPI Malang City.' }}</p>
                        </div>
                        <div class="order-1 md:order-2 absolute left-8 md:left-1/2 transform -translate-x-1/2 flex items-center justify-center w-8 h-8 rounded-full bg-[#005344] border-4 border-white shadow-lg ring-4 ring-[#005344]/10"></div>
                        <div class="order-3 w-full md:w-5/12 pl-16 md:pl-12 mt-2 md:mt-0">
                            <span class="text-3xl md:text-4xl font-extrabold text-[#005344] tracking-wider">2008</span>
                        </div>
                    </div>

                    <!-- 2026 -->
                    <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between w-full reveal-on-scroll">
                        <div class="order-2 md:order-3 w-full md:w-5/12 pl-16 md:pl-12">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $locale == 'id' ? 'Periode Kepengurusan 2026-2030' : '2026-2030 Management Period' }}</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">{{ $locale == 'id' ? 'Aris Rahma Cita Wimanda, S.Pd., M.Pd. terpilih sebagai Ketua Umum DPC HPI Malang, membawa semangat baru menuju organisasi yang profesional, berdaya saing, dan sejahtera.' : 'Aris Rahma Cita Wimanda, S.Pd., M.Pd. was elected as the General Chairman of DPC HPI Malang, bringing a new spirit towards a professional, competitive, and prosperous organization.' }}</p>
                        </div>
                        <div class="order-1 md:order-2 absolute left-8 md:left-1/2 transform -translate-x-1/2 flex items-center justify-center w-8 h-8 rounded-full bg-[#937538] border-4 border-white shadow-lg ring-4 ring-[#937538]/10"></div>
                        <div class="order-3 md:order-1 w-full md:w-5/12 pl-16 md:pl-0 md:text-right md:pr-12 mt-2 md:mt-0">
                            <span class="text-3xl md:text-4xl font-extrabold text-[#937538] tracking-wider">2026</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- ================= AKHIR PENAMBAHAN KODE BARU ================= -->

<!-- 4. MENGAPA MEMILIH HPI? -->
<section class="py-16 md:py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-2xl md:text-3xl font-bold text-center mb-10 md:mb-14 text-hpi-green">{{ $locale == 'id' ? 'Mengapa Memilih HPI?' : 'Why Choose HPI?' }}</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach(\App\Models\Keunggulan::all() as $item)
            <div class="bg-white p-6 md:p-8 rounded-2xl border border-gray-200 hover:shadow-lg transition-shadow reveal-on-scroll">
                <div class="text-hpi-green mb-4 md:mb-5 w-10 h-10 [&>svg]:w-full [&>svg]:h-full flex items-center justify-start text-3xl">
                    @if(str_starts_with(trim($item->ikon), '<'))
                        {!! $item->ikon !!}
                    @else
                        @php
                            $iconClass = trim($item->ikon);
                            if ($iconClass) {
                                if (!str_starts_with($iconClass, 'fa')) {
                                    $iconClass = 'fa-solid fa-' . $iconClass;
                                } elseif (!str_contains($iconClass, ' ')) {
                                    $iconClass = 'fa-solid ' . $iconClass;
                                }
                            }
                        @endphp
                        @if($iconClass)
                            <i class="{{ $iconClass }}"></i>
                        @endif
                    @endif
                </div>
                <h4 class="font-bold text-base md:text-lg text-gray-900 mb-2 md:mb-3">{{ $locale == 'id' ? $item->judul_id : $item->judul_en }}</h4>
                <p class="text-xs md:text-sm text-gray-600 leading-relaxed">{{ $locale == 'id' ? $item->deskripsi_id : $item->deskripsi_en }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- 5. DESTINASI WISATA -->
<section class="py-16 md:py-24 bg-[#F4F4F4] overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-2xl md:text-3xl font-bold text-center mb-10 md:mb-14 text-hpi-green">{{ $locale == 'id' ? 'Destinasi Wisata' : 'Tourist Destinations' }}</h2>
        <style>
            #destinasi-card-container {
                position: relative;
                height: 380px;
                width: 100%;
                max-width: 896px;
                margin: 4rem auto;
                overflow: visible;
            }
            @media (min-width: 768px) {
                #destinasi-card-container {
                    height: 520px;
                }
            }
            .destinasi-card {
                position: absolute;
                left: 50%;
                top: 50%;
                width: 12rem; /* 192px */
                height: 16rem; /* 256px */
                border-radius: 1rem;
                overflow: hidden;
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4);
                transform-origin: bottom center;
                border: 1px solid rgba(255, 255, 255, 0.1);
                background-color: #e5e7eb;
            }
            @media (min-width: 768px) {
                .destinasi-card {
                    width: 15rem; /* 240px */
                    height: 20rem; /* 320px */
                    border-radius: 1.5rem;
                }
            }
        </style>
        <div id="destinasi-card-container">
            @foreach(\App\Models\Destinasi::where('nama_destinasi_id', '!=', '__kategori_placeholder__')->orderBy('is_unggulan', 'desc')->orderBy('dibuat_pada', 'desc')->limit(5)->get() as $index => $destinasi)
            <div class="destinasi-card" style="z-index: {{ 10 + $index }}">
                @if($destinasi->url_gambar)
                    <img src="{{ asset('storage/' . $destinasi->url_gambar) }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400 text-xs">No Image</div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/35 to-transparent z-10"></div>
                <div class="absolute bottom-4 left-4 right-4 z-20">
                    <h3 class="text-xs md:text-sm font-bold text-white mb-2 leading-tight">{{ $locale == 'id' ? $destinasi->nama_destinasi_id : $destinasi->nama_destinasi_en }}</h3>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-12 relative z-30">
            <a href="/destinasi" class="inline-flex items-center gap-2 bg-hpi-green hover:bg-emerald-950 text-white font-bold py-3 px-8 rounded-full transition shadow-md hover:shadow-lg">
                {{ $locale == 'id' ? 'Lihat Semua Destinasi' : 'View All Destinations' }} &rarr;
            </a>
        </div>
    </div>
</section>

<!-- 6. LAYANAN PEMANDUAN -->
@php
    $layananList = \App\Models\Layanan::limit(5)->get();
    $totalLayanan = count($layananList);
@endphp
<section class="py-16 md:py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-2xl md:text-3xl font-bold text-center mb-16 text-hpi-green">{{ $locale == 'id' ? 'Layanan Pemanduan' : 'Guiding Services' }}</h2>
        
        <div class="relative w-full max-w-2xl mx-auto h-[320px] md:h-[420px] flex items-center justify-center" 
             x-data="{ active: 0, total: {{ $totalLayanan }} }" 
             x-init="setInterval(() => { active = (active + 1) % total }, 5000)">
            
            <!-- Cards Container -->
            <div class="relative w-full h-full">
                @foreach($layananList as $index => $layanan)
                <div class="absolute inset-0 w-full h-full rounded-2xl overflow-hidden shadow-xl transition-all duration-500 ease-out flex flex-col justify-end p-6 md:p-8"
                     :style="`
                        transform: scale(${ 1 - ((( {{ $index }} - active + total ) % total) * 0.05) }) translateY(-${ (( {{ $index }} - active + total ) % total) * 20 }px);
                        z-index: ${ total - (( {{ $index }} - active + total ) % total) };
                        opacity: ${ (( {{ $index }} - active + total ) % total) < 4 ? 1 : 0 };
                        pointer-events: ${ (( {{ $index }} - active + total ) % total) === 0 ? 'auto' : 'none' };
                     `">
                    
                    <!-- Background Image -->
                    @if($layanan->url_gambar)
                        <img src="{{ asset('storage/' . $layanan->url_gambar) }}" alt="{{ $locale == 'id' ? $layanan->nama_layanan_id : $layanan->nama_layanan_en }}" class="absolute inset-0 w-full h-full object-cover">
                    @else
                        <div class="absolute inset-0 w-full h-full bg-neutral-800 flex items-center justify-center text-gray-500">No Image</div>
                    @endif
                    
                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent z-10"></div>
                    
                    <!-- Text Content -->
                    <div class="relative z-20 text-white">
                        <h4 class="font-bold text-lg md:text-2xl mb-2 text-white">{{ $locale == 'id' ? $layanan->nama_layanan_id : $layanan->nama_layanan_en }}</h4>
                        <p class="text-xs md:text-sm text-gray-200 leading-relaxed line-clamp-3 md:line-clamp-none">{{ $locale == 'id' ? $layanan->deskripsi_id : $layanan->deskripsi_en }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Navigation Buttons -->
            <!-- Left Button -->
            <button @click="active = (active - 1 + total) % total" 
                    class="absolute -left-4 md:-left-12 z-50 bg-slate-900/60 hover:bg-slate-900/80 text-white w-10 h-10 md:w-14 md:h-14 rounded-full flex items-center justify-center transition backdrop-blur-sm shadow-lg focus:outline-none">
                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </button>
            
            <!-- Right Button -->
            <button @click="active = (active + 1) % total" 
                    class="absolute -right-4 md:-right-12 z-50 bg-slate-900/60 hover:bg-slate-900/80 text-white w-10 h-10 md:w-14 md:h-14 rounded-full flex items-center justify-center transition backdrop-blur-sm shadow-lg focus:outline-none">
                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </button>
        </div>

        <div class="text-center mt-16">
            <a href="/layanan" class="inline-flex items-center gap-2 bg-hpi-green hover:bg-emerald-950 text-white font-bold py-3 px-8 rounded-full transition shadow-md hover:shadow-lg">
                {{ $locale == 'id' ? 'Lihat Pemanduan' : 'View Guiding' }} &rarr;
            </a>
        </div>
    </div>
</section>

<!-- 7. ALUR RESERVASI -->
<section class="py-16 md:py-24 bg-white border-t border-gray-100 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-2xl md:text-3xl font-bold text-center mb-10 md:mb-14 text-hpi-green">{{ $locale == 'id' ? 'Alur Reservasi' : 'Reservation Flow' }}</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach(\App\Models\AlurReservasi::orderBy('langkah_ke', 'asc')->get() as $alur)
            <div class="bg-white p-6 md:p-8 rounded-2xl border border-gray-200 text-left reveal-on-scroll" style="transition-delay: {{ $alur->langkah_ke * 100 }}ms">
                <div class="w-10 h-10 md:w-12 md:h-12 bg-hpi-green text-white rounded-full flex items-center justify-center text-lg md:text-xl font-bold mb-4 md:mb-6">{{ $alur->langkah_ke }}</div>
                <h4 class="font-bold text-base md:text-lg mb-2 md:mb-3">{{ $locale == 'id' ? $alur->judul_id : $alur->judul_en }}</h4>
                <p class="text-xs md:text-sm text-gray-600 leading-relaxed">{{ $locale == 'id' ? $alur->deskripsi_id : $alur->deskripsi_en }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- 8. KEGIATAN MENDATANG -->
<section class="py-16 md:py-24 bg-[#F4F4F4] overflow-hidden">
    <div class="max-w-4xl mx-auto px-6">
        <h2 class="text-2xl md:text-3xl font-bold text-center mb-10 md:mb-14 text-hpi-green">{{ $locale == 'id' ? 'Kegiatan Mendatang' : 'Upcoming Events' }}</h2>
        <div class="space-y-6 mb-8 md:mb-10">
            @foreach(\App\Models\KegiatanBerita::published()->kegiatan()->where('tanggal_kegiatan', '>=', now())->orderBy('tanggal_kegiatan', 'asc')->limit(3)->get() as $kegiatan)
            <div class="flex flex-row items-center gap-4 md:gap-6 p-2 reveal-on-scroll">
                <!-- Box Tanggal Mobile Friendly -->
                <div class="text-center shrink-0 border-r border-gray-300 pr-4 md:pr-8">
                    <span class="block text-2xl md:text-4xl font-light text-gray-800">{{ date('d', strtotime($kegiatan->tanggal_kegiatan)) }}</span>
                    <span class="text-[10px] md:text-xs font-bold uppercase tracking-widest text-gray-500">{{ date('M', strtotime($kegiatan->tanggal_kegiatan)) }}</span>
                </div>
                <div>
                    <h4 class="font-bold text-sm md:text-lg mb-1">{{ $locale == 'id' ? $kegiatan->judul_id : $kegiatan->judul_en }}</h4>
                    <p class="text-xs md:text-sm text-gray-600 line-clamp-2 md:line-clamp-none">{{ $locale == 'id' ? $kegiatan->deskripsi_singkat_id : $kegiatan->deskripsi_singkat_en }}</p>
                </div>
            </div>
            <hr class="border-gray-200">
            @endforeach
        </div>
        <div class="text-center md:text-right">
            <a href="/berita" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-hpi-green transition reveal-on-scroll">
                {{ $locale == 'id' ? 'Lihat Semua' : 'View All' }} &rarr;
            </a>
        </div>
    </div>
</section>

<!-- 9. APA KATA MEREKA? (Testimoni) -->
<section class="py-16 md:py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-2xl md:text-3xl font-bold text-center mb-10 md:mb-14 text-hpi-green">{{ $locale == 'id' ? 'Apa Kata Mereka?' : 'What They Say?' }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach(\App\Models\Ulasan::where('status', 'Approved')->limit(3)->get() as $ulasan)
            <div class="bg-white p-6 md:p-8 rounded-2xl border border-gray-200 reveal-on-scroll">
                <span class="text-4xl md:text-5xl text-gray-200 font-serif leading-none block mb-2">"</span>
                <p class="text-xs md:text-sm text-gray-600 italic mb-4 md:mb-6">"{{ $locale == 'id' ? $ulasan->komentar_id : ($ulasan->komentar_en ?? $ulasan->komentar_id) }}"</p>
                <h4 class="font-bold text-sm text-gray-900">{{ $ulasan->nama_lengkap }}</h4>
                <p class="text-[10px] md:text-xs text-gray-400">Wisatawan - {{ $ulasan->asal_daerah }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- 10. KIRIM ULASAN ANDA -->
<section class="py-16 md:py-24 bg-[#F4F4F4] overflow-hidden">
    <div class="max-w-3xl mx-auto px-4 md:px-6">
        <div class="text-center mb-10 md:mb-12 reveal-on-scroll">
            <h2 class="text-2xl md:text-3xl font-bold text-hpi-green mb-3 md:mb-4">{{ $locale == 'id' ? 'Kirim Ulasan Anda' : 'Send Your Review' }}</h2>
            <p class="text-sm md:text-base text-gray-600">{{ $locale == 'id' ? 'Bagikan pengalaman Anda bersama pemandu HPI Kabupaten Malang.' : 'Share your experience with HPI Malang guides.' }}</p>
        </div>
        
        <form action="{{ route('ulasan.store') }}" method="POST" class="bg-white p-6 md:p-10 rounded-2xl md:rounded-3xl shadow-sm reveal-on-scroll">
            @csrf
            <div class="mb-5 md:mb-6">
                <label class="block text-xs md:text-sm font-bold text-gray-700 mb-2">Rating</label>
                <div class="flex gap-1 text-xl md:text-2xl text-yellow-400 cursor-pointer">★ ★ ★ ★ ☆</div>
            </div>
            <div class="mb-5 md:mb-6">
                <label class="block text-xs md:text-sm font-bold text-gray-700 mb-2">{{ $locale == 'id' ? 'Nama Lengkap' : 'Full Name' }}</label>
                <input type="text" name="nama_lengkap" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-hpi-green transition">
            </div>
            <div class="mb-5 md:mb-6">
                <label class="block text-xs md:text-sm font-bold text-gray-700 mb-2">{{ $locale == 'id' ? 'Asal (Negara/Daerah)' : 'Origin' }}</label>
                <input type="text" name="asal_daerah" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-hpi-green transition">
            </div>
            <div class="mb-6 md:mb-8">
                <label class="block text-xs md:text-sm font-bold text-gray-700 mb-2">{{ $locale == 'id' ? 'Komentar' : 'Comment' }}</label>
                <textarea rows="4" name="komentar_id" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-hpi-green transition"></textarea>
            </div>
            <button type="submit" class="w-full bg-hpi-green hover:bg-emerald-900 text-white font-bold py-3 md:py-4 rounded-xl transition text-sm md:text-base">
                {{ $locale == 'id' ? 'Kirim Ulasan' : 'Submit Review' }}
            </button>
        </form>
    </div>
</section>

<!-- 11. PERTANYAAN UMUM (FAQ) -->
<section class="py-16 md:py-24 bg-white overflow-hidden">
    <div class="max-w-3xl mx-auto px-6 reveal-on-scroll">
        <h2 class="text-2xl md:text-3xl font-bold text-center mb-10 md:mb-12 text-hpi-green">{{ $locale == 'id' ? 'Pertanyaan Umum (FAQ)' : 'Frequently Asked Questions' }}</h2>
        <div class="space-y-3 md:space-y-4" x-data="{ selected: null }">
            @foreach(\App\Models\Faq::all() as $faq)
            <div class="border border-gray-200 rounded-xl md:rounded-2xl overflow-hidden bg-white transition-all duration-300" :class="selected == {{ $faq->id }} ? 'shadow-md border-hpi-green/30' : ''">
                <button @click="selected = (selected == {{ $faq->id }} ? null : {{ $faq->id }})" class="w-full flex items-center justify-between p-4 md:p-5 text-left font-bold text-sm md:text-base text-gray-800 hover:text-hpi-green transition-colors focus:outline-none">
                    <span class="pr-4">{{ $locale == 'id' ? $faq->pertanyaan_id : $faq->pertanyaan_en }}</span>
                    <svg class="w-4 h-4 md:w-5 md:h-5 transform transition-transform duration-300 text-gray-400 shrink-0" :class="selected == {{ $faq->id }} ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="selected == {{ $faq->id }}" x-collapse x-cloak>
                    <div class="p-4 md:p-5 pt-0 text-xs md:text-sm text-gray-600 leading-relaxed border-t border-gray-50 mt-2">
                        {{ $locale == 'id' ? $faq->jawaban_id : $faq->jawaban_en }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Load GSAP & ScrollTrigger CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

<!-- SCRIPT ANIMASI (GSAP & Intersection Observer) -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Function to split text nodes into words and chars wrapping in spans
        function splitText(element) {
            const nodes = Array.from(element.childNodes);
            element.innerHTML = '';
            nodes.forEach(node => {
                if (node.nodeType === Node.TEXT_NODE) {
                    const words = node.textContent.split(/(\s+)/);
                    words.forEach(word => {
                        if (word.trim().length === 0) {
                            element.appendChild(document.createTextNode(word));
                        } else {
                            const span = document.createElement('span');
                            span.className = 'split-word';
                            
                            const chars = word.split('');
                            chars.forEach(char => {
                                const charSpan = document.createElement('span');
                                charSpan.className = 'split-char';
                                charSpan.innerText = char;
                                span.appendChild(charSpan);
                            });
                            
                            element.appendChild(span);
                        }
                    });
                } else if (node.nodeType === Node.ELEMENT_NODE) {
                    const clonedElement = node.cloneNode(false);
                    splitText(node);
                    while(node.firstChild) {
                        clonedElement.appendChild(node.firstChild);
                    }
                    element.appendChild(clonedElement);
                }
            });
        }

        // Split hero title
        const heroTitle = document.getElementById("hero-title");
        if (heroTitle) {
            splitText(heroTitle);
        }

        // Split all section titles
        const sectionTitles = document.querySelectorAll("section h2.text-hpi-green");
        sectionTitles.forEach(title => splitText(title));

        // Register GSAP ScrollTrigger
        gsap.registerPlugin(ScrollTrigger);

        // Entrance animation: Split text entry for hero title (plays immediately on load)
        if (heroTitle) {
            gsap.from("#hero-title .split-char", {
                y: 80,
                opacity: 0,
                rotateX: 45,
                duration: 1.2,
                stagger: 0.03,
                ease: "power4.out"
            });
        }

        // Timeline for the hero transition to the welcome section
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: "#hero-section",
                start: "top top",
                end: "+=100%",
                pin: true,
                scrub: 1.2,
                snap: {
                    snapTo: 1,
                    duration: { min: 0.6, max: 1.0 },
                    ease: "power2.inOut"
                }
            }
        });

        // Curved transition path animation (morphing up with inverted/flipped curve)
        tl.to("#curve-path", {
            attr: { d: "M 0 15 Q 50 65 100 15 L 100 100 L 0 100 Z" },
            ease: "none"
        }, 0)
        .to("#curve-path", {
            attr: { d: "M 0 0 Q 50 0 100 0 L 100 100 L 0 100 Z" },
            ease: "none"
        }, 0.5);

        // Fade out and move up the hero content as a whole on scroll
        tl.to("#hero-content", {
            opacity: 0,
            y: -100,
            scale: 0.95,
            ease: "power1.out"
        }, 0);

        // Helper function to split text into lines dynamically
        function splitTextIntoLines(element) {
            if (!element) return;
            const text = element.innerText;
            const words = text.split(' ');
            element.innerHTML = words.map(word => `<span class="temp-word" style="display: inline-block;">${word}</span>`).join(' ');
            
            const wordSpans = element.querySelectorAll('.temp-word');
            const lines = {};
            wordSpans.forEach(span => {
                const top = span.offsetTop;
                if (!lines[top]) {
                    lines[top] = [];
                }
                lines[top].push(span.innerText);
            });
            
            let newHTML = '';
            Object.keys(lines).sort((a, b) => a - b).forEach(top => {
                const lineText = lines[top].join(' ');
                newHTML += `<div class="line-mask" style="overflow:hidden; display:block;"><span class="line-content" style="display:inline-block; transform:translateY(100%); transition: none;">${lineText}</span></div>`;
            });
            element.innerHTML = newHTML;
        }

        // Welcome & About Scroll Animations
        let mmWelcome = gsap.matchMedia();
        
        // Desktop Welcome & About (Pin, Curtain, Split Lines)
        mmWelcome.add("(min-width: 768px)", () => {
            // Apply line splitting for Welcome Section
            const sec2Title = document.querySelector(".welcome-title");
            const sec2Desc = document.querySelector(".welcome-desc");
            const sec2Author = document.querySelector(".welcome-author");
            const sec2Role = document.querySelector(".welcome-role");
            splitTextIntoLines(sec2Title);
            splitTextIntoLines(sec2Desc);
            splitTextIntoLines(sec2Author);
            splitTextIntoLines(sec2Role);

            // Apply line splitting for About Section
            const sec3Title = document.querySelector(".about-title");
            const sec3Desc = document.querySelector(".about-desc");
            const sec3Subtitle = document.querySelector(".about-subtitle");
            splitTextIntoLines(sec3Title);
            splitTextIntoLines(sec3Desc);
            splitTextIntoLines(sec3Subtitle);

            // Welcome Section Timeline (Desktop)
            let tlSec2 = gsap.timeline({
                scrollTrigger: {
                    trigger: "#welcome-section",
                    start: "top top",
                    end: "+=150%",
                    pin: true,
                    scrub: 1,
                    anticipatePin: 1
                }
            });
            tlSec2
                // 1. Reveal Image (SVG curtain morphs to right side / zero width)
                .to(".welcome-curtain", { attr: { d: "M 100 0 H 100 V 100 H 100 Z" }, duration: 1.5, ease: "power2.inOut" })
                // 2. Reveal Text by lines
                .to("#welcome-section .line-content", { y: "0%", stagger: 0.1, duration: 1.2, ease: "power3.out" }, "-=1")
                // 3. Hide Text (starts 1.5s after text reveal finishes to hold the POV)
                .to("#welcome-section .line-content", { y: "100%", stagger: 0.05, duration: 0.8, ease: "power3.in" }, "+=1.5")
                // 4. Close Image Curtain (covers the image again)
                .to(".welcome-curtain", { attr: { d: "M 0 0 H 100 V 100 H 0 Z" }, duration: 1, ease: "power2.inOut" }, "-=0.5");

            // About Section Timeline (Desktop)
            let tlSec3 = gsap.timeline({
                scrollTrigger: {
                    trigger: "#about-section",
                    start: "top top",
                    end: "+=150%",
                    pin: true,
                    scrub: 1,
                    anticipatePin: 1
                }
            });
            tlSec3
                // 1. Reveal both image curtains
                .to([".about-curtain-1", ".about-curtain-2"], { attr: { d: "M 100 0 H 100 V 100 H 100 Z" }, duration: 1.5, ease: "power2.inOut" })
                // 2. Reveal Text by lines
                .to("#about-section .line-content", { y: "0%", stagger: 0.08, duration: 1.2, ease: "power3.out" }, "-=1")
                // 3. Reveal Stats cards
                .from(".about-stats > div", { opacity: 0, scale: 0.9, y: 20, stagger: 0.1, duration: 0.8, ease: "power2.out" }, "-=0.8")
                // 4. Hide Stats (starts 1.5s after stats reveal finishes to hold the POV)
                .to(".about-stats > div", { opacity: 0, scale: 0.9, y: 20, stagger: 0.05, duration: 0.6, ease: "power2.in" }, "+=1.5")
                // 5. Hide Text
                .to("#about-section .line-content", { y: "100%", stagger: 0.05, duration: 0.8, ease: "power3.in" }, "-=0.4")
                // 6. Close curtains
                .to([".about-curtain-1", ".about-curtain-2"], { attr: { d: "M 0 0 H 100 V 100 H 0 Z" }, duration: 1, ease: "power2.inOut" }, "-=0.5");
        });

        // Mobile Welcome & About (Simple scroll-triggered reveals, no layout distortion)
        mmWelcome.add("(max-width: 767px)", () => {
            // Welcome Section (Mobile)
            let tlSec2Mob = gsap.timeline({
                scrollTrigger: {
                    trigger: "#welcome-section",
                    start: "top 75%",
                    toggleActions: "play none none none"
                }
            });
            tlSec2Mob
                .to(".welcome-curtain", { attr: { d: "M 100 0 H 100 V 100 H 100 Z" }, duration: 1.2, ease: "power2.inOut" })
                .from(".welcome-text-container", { opacity: 0, y: 30, duration: 1.0, ease: "power3.out" }, "-=0.8");

            // About Section (Mobile)
            let tlSec3Mob = gsap.timeline({
                scrollTrigger: {
                    trigger: "#about-section",
                    start: "top 75%",
                    toggleActions: "play none none none"
                }
            });
            tlSec3Mob
                .to([".about-curtain-1", ".about-curtain-2"], { attr: { d: "M 100 0 H 100 V 100 H 100 Z" }, duration: 1.2, ease: "power2.inOut" })
                .from(".about-text-container", { opacity: 0, y: 30, duration: 1.0, ease: "power3.out" }, "-=0.8")
                .from(".about-stats > div", { opacity: 0, scale: 0.9, y: 15, stagger: 0.08, duration: 0.6, ease: "power2.out" }, "-=0.6");
        });

        // Bridge Card Fanning Animation
        let mm = gsap.matchMedia();

        // Desktop Layout
        mm.add("(min-width: 768px)", () => {
            gsap.timeline({
                scrollTrigger: {
                    trigger: "#destinasi-card-container",
                    start: "top 95%",
                    end: "bottom 15%",
                    scrub: 1.2,
                }
            })
            .fromTo(".destinasi-card", 
                { xPercent: -50, yPercent: -50, x: 0, y: 0, rotation: 0 },
                {
                    xPercent: -50,
                    yPercent: -50,
                    x: (i) => (i - 2) * 160,
                    y: (i) => Math.abs(i - 2) * 20,
                    rotation: (i) => (i - 2) * 10,
                    ease: "power2.out"
                }
            );
        });

        // Mobile Layout
        mm.add("(max-width: 767px)", () => {
            gsap.timeline({
                scrollTrigger: {
                    trigger: "#destinasi-card-container",
                    start: "top 95%",
                    end: "bottom 10%",
                    scrub: 1.2,
                }
            })
            .fromTo(".destinasi-card", 
                { xPercent: -50, yPercent: -50, x: 0, y: 0, rotation: 0 },
                {
                    xPercent: -50,
                    yPercent: -50,
                    x: (i) => (i - 2) * 45,
                    y: (i) => Math.abs(i - 2) * 8,
                    rotation: (i) => (i - 2) * 6,
                    ease: "power2.out"
                }
            );
        });

        // Mencegah animasi macet di HP karena scroll yang terlalu cepat
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target); 
                }
            });
        }, { 
            threshold: 0.05, 
            rootMargin: "0px 0px -20px 0px" 
        });

        document.querySelectorAll('.reveal-on-scroll').forEach((el) => {
            // Animasi halus fade in up
            el.classList.add('opacity-0', 'translate-y-8', 'md:translate-y-12', 'transition-all', 'duration-[800ms]', 'md:duration-[1000ms]', 'ease-out');
            observer.observe(el);
        });

        // Heading Titles scroll triggered entrance animation (initialized after pinning setup)
        sectionTitles.forEach(title => {
            const chars = title.querySelectorAll(".split-char");
            if (chars.length > 0) {
                gsap.from(chars, {
                    scrollTrigger: {
                        trigger: title,
                        start: "top 85%",
                        toggleActions: "play reverse play reverse"
                    },
                    y: 40,
                    opacity: 0,
                    rotateX: 30,
                    duration: 0.8,
                    stagger: 0.015,
                    ease: "power3.out"
                });
            }
        });

        // Refresh ScrollTrigger to recalculate all trigger positions correctly
        ScrollTrigger.refresh();
    });
</script>
<style>
    /* Trigger class untuk memunculkan elemen */
    .is-visible { opacity: 1 !important; transform: translateY(0) !important; }
    /* Memastikan x-cloak alpine tidak terlihat saat render pertama kali */
    [x-cloak] { display: none !important; }

    /* GSAP Split Text styles */
    .split-word {
        display: inline-block;
        white-space: nowrap;
    }
    .split-char {
        display: inline-block;
        will-change: transform, opacity;
        transform-origin: center bottom;
    }

    /* Line animation styles */
    .line-mask {
        overflow: hidden !important;
        display: block !important;
    }
    .line-content {
        display: inline-block !important;
        transform: translateY(100%);
        will-change: transform;
    }
</style>
@endsection