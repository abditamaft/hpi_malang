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
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col justify-between border border-gray-100">
                        <div class="relative h-64 md:h-72 w-full bg-gray-200">
                            @if($item->url_gambar)
                                <img src="{{ asset('storage/' . $item->url_gambar) }}" alt="{{ $locale == 'id' ? $item->nama_layanan_id : $item->nama_layanan_en }}" class="w-full h-full object-cover">
                            @endif
                            <div class="absolute top-4 right-4 bg-white/80 backdrop-blur-sm p-2 rounded-lg text-hpi-green text-xs">
                                <span>{{ $item->ikon ?: '💼' }}</span>
                            </div>
                        </div>
                        <div class="p-6 md:p-8 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="text-xl font-bold text-hpi-green mb-3">
                                    {{ $locale == 'id' ? $item->nama_layanan_id : $item->nama_layanan_en }}
                                </h3>
                                <p class="text-gray-600 text-sm leading-relaxed mb-6">
                                    {{ $locale == 'id' ? $item->deskripsi_id : $item->deskripsi_en }}
                                </p>
                            </div>
                            <div>
                                <a href="/hubungi-kami" class="inline-flex items-center text-sm font-semibold text-hpi-green hover:underline group">
                                    {{ $locale == 'id' ? 'Pelajari Lebih Lanjut' : 'Learn More' }}
                                    <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
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

    </div>

@endsection