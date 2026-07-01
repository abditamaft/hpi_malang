@extends('layouts.main') 
@section('title', session('locale') == 'en' ? 'About Us - HPI Malang Regency' : 'Tentang Kami - HPI Kabupaten Malang')

@section('content')
<style>
    .animate-fade-in-up {
        animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        opacity: 0;
        transform: translateY(30px);
    }
    .delay-100 { animation-delay: 100ms; }
    .delay-200 { animation-delay: 200ms; }
    .delay-300 { animation-delay: 300ms; }
    
    @keyframes fadeInUp {
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<section class="pt-36 pb-16 md:pt-48 md:pb-24 px-6 max-w-5xl mx-auto text-center animate-fade-in-up">
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
</section>

<section class="py-16 bg-gray-50/50 px-6">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-16 animate-fade-in-up delay-100">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-3">
                {{ session('locale') == 'en' ? 'Organizational Vision & Mission' : 'Visi & Misi Organisasi' }}
            </h2>
            <p class="text-gray-500 text-sm md:text-base">
                {{ session('locale') == 'en' ? 'Our direction and commitment in advancing the tourism sector in Malang Regency through excellent guiding services.' : 'Arah langkah dan komitmen kami dalam memajukan sektor pariwisata di Kabupaten Malang melalui pelayanan kepramuwisataan yang prima.' }}
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
            
            <div class="lg:col-span-4 animate-fade-in-up delay-200">
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

            <div class="lg:col-span-8 animate-fade-in-up delay-300">
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

<section class="py-20 px-6">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-16 animate-fade-in-up">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-3">
                {{ session('locale') == 'en' ? 'Organizational Structure' : 'Struktur Organisasi' }}
            </h2>
            <p class="text-gray-500 text-sm md:text-base">
                {{ session('locale') == 'en' ? 'The supporting pillars that ensure the organization runs professionally, transparently, and accountably.' : 'Pilar penyangga yang memastikan jalannya roda organisasi secara profesional, transparan, dan akuntabel.' }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 animate-fade-in-up delay-100">
            
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

        <div class="bg-gray-100 rounded-[2.5rem] p-8 md:p-12 text-center animate-fade-in-up delay-200">
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
@endsection