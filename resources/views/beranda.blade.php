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
<section class="relative min-h-[100dvh] flex flex-col justify-between pt-24 pb-10 md:pb-16 text-white overflow-hidden">
    
    <!-- Background Gambar dari Database (Jika kosong, pakai gambar default Bromo) -->
    <div class="absolute inset-0 bg-cover bg-center z-0" 
         style="background-image: url('{{ $settings && $settings->hero_gambar ? asset('storage/'.$settings->hero_gambar) : 'https://source.unsplash.com/1600x900/?mountain,bromo' }}');">
        <div class="absolute inset-0 bg-black/40"></div>
    </div>
    
    <!-- Teks Judul Utama (Di Tengah) -->
    <div class="relative z-10 flex-1 flex flex-col items-center justify-center text-center px-6 mt-10 md:mt-0 reveal-on-scroll">
        @if($settings && ($locale == 'id' ? $settings->hero_judul_id : $settings->hero_judul_en))
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-4 leading-tight tracking-wide drop-shadow-lg">
                {!! $locale == 'id' ? $settings->hero_judul_id : $settings->hero_judul_en !!}
            </h1>
        @else
            <!-- Fallback Default persis seperti desain -->
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-4 leading-tight tracking-wide drop-shadow-lg">
                Pramuwisata Profesional,<br>
                <span class="text-hpi-green">Berdaya Saing,</span><br>
                dan Sejahtera
            </h1>
        @endif
    </div>

    <!-- Badge & Buttons (Di Pojok Kiri Bawah sesuai desain image_1819fc.png) -->
    <div class="relative z-10 w-full max-w-7xl mx-auto px-6 reveal-on-scroll delay-200">
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
</section>

<!-- 2. WELCOME SECTION (Teks Sambutan Dinamis dari web_settings) -->
<section class="py-16 md:py-24 bg-white overflow-hidden">
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-12 gap-8 md:gap-12 items-center">
        <!-- Foto Ketua -->
        <div class="md:col-span-4 flex justify-center reveal-on-scroll">
            <div class="w-48 h-48 md:w-64 md:h-64 rounded-full overflow-hidden border-4 border-gray-100 shadow-lg">
                <!-- Foto ketua masih hardcode karena struktur_organisasi tidak memiliki kolom foto -->
                <img src="https://source.unsplash.com/400x400/?portrait,man" alt="Ketua HPI" class="w-full h-full object-cover">
            </div>
        </div>
        
        <!-- Teks Sambutan & Nama -->
        <div class="md:col-span-8 reveal-on-scroll delay-100 text-center md:text-left">
            <span class="text-5xl md:text-6xl text-yellow-400 font-serif leading-none block mb-2 md:mb-0 md:inline-block">"</span>
            
            <h2 class="text-2xl md:text-3xl font-bold mb-4 md:mb-6 mt-2 text-gray-900 leading-tight">
                "{{ $settings && ($locale == 'id' ? $settings->teks_sambutan_id : $settings->teks_sambutan_en) 
                    ? ($locale == 'id' ? $settings->teks_sambutan_id : $settings->teks_sambutan_en) 
                    : ($locale == 'id' ? 'Selamat datang di gerbang pariwisata profesional Kabupaten Malang.' : 'Welcome to the gate of professional tourism in Malang Regency.') }}"
            </h2>
            
            <p class="text-sm md:text-base text-gray-600 mb-6 md:mb-8 leading-relaxed">
                {{ $locale == 'id' ? 'Kami hadir tidak hanya sebagai penunjuk jalan, tetapi sebagai pencerita yang membawa setiap tamu menyelami kedalaman budaya dan keindahan alam Malang. Komitmen kami adalah memberikan standar pelayanan prima yang berintegritas, memastikan setiap perjalanan menjadi pengalaman yang bermakna dan tak terlupakan.' : 'We are here not just as guides, but as storytellers bringing guests into the depth of Malang\'s culture and beauty...' }}
            </p>
            
            <h4 class="font-bold text-base md:text-lg text-gray-900">{{ $ketua ? $ketua->nama : 'Aris Rahma Cita Wimanda' }}</h4>
            <p class="text-xs md:text-sm text-gray-500 font-medium uppercase tracking-wide">{{ $ketua ? ($locale == 'id' ? $ketua->jabatan_id : $ketua->jabatan_en) : 'Ketua HPI Kabupaten Malang' }}</p>
        </div>
    </div>
</section>

<!-- 3. TENTANG KAMI SECTION -->
<section class="py-16 md:py-24 bg-gray-50 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-10 md:gap-16 items-center">
        <!-- Gambar (Sembunyikan salah satu di HP agar tidak terlalu memakan tempat) -->
        <div class="flex gap-4 items-center justify-center reveal-on-scroll">
            <img src="https://source.unsplash.com/400x500/?guide,tour" class="w-1/2 rounded-2xl shadow-md object-cover h-64 md:h-80">
            <img src="https://source.unsplash.com/400x600/?tea,plantation" class="hidden md:block w-1/2 rounded-2xl shadow-lg object-cover h-96 -mt-10">
        </div>
        <div class="reveal-on-scroll delay-100 text-center md:text-left">
            <p class="text-xs md:text-sm font-bold text-gray-500 tracking-widest uppercase mb-2">{{ $locale == 'id' ? 'TENTANG KAMI' : 'ABOUT US' }}</p>
            <h2 class="text-3xl md:text-4xl font-bold text-hpi-green mb-4 md:mb-6 leading-tight">
                {{ $settings ? ($locale == 'id' ? $settings->judul_tentang_kami_id : $settings->judul_tentang_kami_en) : 'Melayani dengan Hati, Membangun Pariwisata Malang' }}
            </h2>
            <p class="text-sm md:text-base text-gray-600 mb-8 md:mb-10 leading-relaxed">
                {{ $settings ? ($locale == 'id' ? $settings->deskripsi_tentang_kami_id : $settings->deskripsi_tentang_kami_en) : 'Himpunan Pramuwisata Indonesia (HPI) Kabupaten Malang adalah wadah resmi bagi para pemandu wisata profesional...' }}
            </p>
            <!-- Stats -->
            <div class="grid grid-cols-3 gap-2 md:gap-4">
                <div class="bg-white p-4 md:p-6 rounded-xl md:rounded-2xl shadow-sm text-center border border-gray-100">
                    <h3 class="text-2xl md:text-3xl font-bold text-hpi-green mb-1">{{\App\Models\Pramuwisata::count()}}+</h3>
                    <p class="text-[10px] md:text-xs font-semibold text-gray-500 uppercase">{{ $locale == 'id' ? 'Anggota' : 'Members' }}</p>
                </div>
                <div class="bg-white p-4 md:p-6 rounded-xl md:rounded-2xl shadow-sm text-center border border-gray-100">
                    <h3 class="text-2xl md:text-3xl font-bold text-hpi-green mb-1">20+</h3>
                    <p class="text-[10px] md:text-xs font-semibold text-gray-500 uppercase">{{ $locale == 'id' ? 'Bahasa' : 'Languages' }}</p>
                </div>
                <div class="bg-white p-4 md:p-6 rounded-xl md:rounded-2xl shadow-sm text-center border border-gray-100">
                    <h3 class="text-2xl md:text-3xl font-bold text-hpi-green mb-1">500+</h3>
                    <p class="text-[10px] md:text-xs font-semibold text-gray-500 uppercase">{{ $locale == 'id' ? 'Tur/Tahun' : 'Tours/Year' }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4. MENGAPA MEMILIH HPI? -->
<section class="py-16 md:py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-2xl md:text-3xl font-bold text-center mb-10 md:mb-14 text-hpi-green">{{ $locale == 'id' ? 'Mengapa Memilih HPI?' : 'Why Choose HPI?' }}</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach(\App\Models\Keunggulan::all() as $item)
            <div class="bg-white p-6 md:p-8 rounded-2xl border border-gray-200 hover:shadow-lg transition-shadow reveal-on-scroll">
                <div class="text-hpi-green mb-4 md:mb-5 w-10 h-10 [&>svg]:w-full [&>svg]:h-full">{!! $item->ikon !!}</div>
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
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 md:gap-8 mb-8 md:mb-10">
            @foreach(\App\Models\Destinasi::limit(3)->get() as $destinasi)
            <div class="relative group rounded-2xl md:rounded-3xl overflow-hidden h-72 md:h-96 reveal-on-scroll shadow-md">
                <img src="{{ $destinasi->url_gambar }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                <div class="absolute bottom-6 left-6">
                    <h3 class="text-lg md:text-xl font-bold text-white">{{ $locale == 'id' ? $destinasi->nama_destinasi_id : $destinasi->nama_destinasi_en }}</h3>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center md:text-right">
            <a href="/destinasi" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-hpi-green transition reveal-on-scroll">
                {{ $locale == 'id' ? 'Lihat Semua' : 'View All' }} &rarr;
            </a>
        </div>
    </div>
</section>

<!-- 6. LAYANAN PEMANDUAN -->
<section class="py-16 md:py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-2xl md:text-3xl font-bold text-center mb-10 md:mb-14 text-hpi-green">{{ $locale == 'id' ? 'Layanan Pemanduan' : 'Guiding Services' }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 mb-8 md:mb-10">
            @foreach(\App\Models\Layanan::limit(3)->get() as $layanan)
            <div class="p-6 md:p-8 rounded-2xl border border-gray-200 hover:border-hpi-green hover:shadow-md transition reveal-on-scroll">
                <div class="text-hpi-green text-3xl mb-4 md:mb-5">{!! $layanan->ikon !!}</div>
                <h4 class="font-bold text-base md:text-lg mb-2 md:mb-3">{{ $locale == 'id' ? $layanan->nama_layanan_id : $layanan->nama_layanan_en }}</h4>
                <p class="text-xs md:text-sm text-gray-600 leading-relaxed">{{ $locale == 'id' ? $layanan->deskripsi_id : $layanan->deskripsi_en }}</p>
            </div>
            @endforeach
        </div>
        <div class="text-center md:text-right">
            <a href="/layanan" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-hpi-green transition reveal-on-scroll">
                {{ $locale == 'id' ? 'Lihat Semua' : 'View All' }} &rarr;
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
            @foreach(\App\Models\KegiatanBerita::where('tipe', 'Kegiatan')->orderBy('tanggal_kegiatan', 'asc')->limit(3)->get() as $kegiatan)
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

<!-- SCRIPT ANIMASI (Intersection Observer) -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Mencegah animasi macet di HP karena scroll yang terlalu cepat
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target); 
                }
            });
        }, { 
            threshold: 0.05, // Dikurangi sedikit agar lebih cepat muncul di HP
            rootMargin: "0px 0px -20px 0px" // Margin lebih kecil untuk layar sempit
        });

        document.querySelectorAll('.reveal-on-scroll').forEach((el) => {
            // Animasi halus fade in up
            el.classList.add('opacity-0', 'translate-y-8', 'md:translate-y-12', 'transition-all', 'duration-[800ms]', 'md:duration-[1000ms]', 'ease-out');
            observer.observe(el);
        });
    });
</script>
<style>
    /* Trigger class untuk memunculkan elemen */
    .is-visible { opacity: 1 !important; transform: translateY(0) !important; }
    /* Memastikan x-cloak alpine tidak terlihat saat render pertama kali */
    [x-cloak] { display: none !important; }
</style>
@endsection