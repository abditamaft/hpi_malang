@extends('layouts.main')

@section('content')
@php
    $locale = session('locale', 'id');
@endphp

<style>
    /* Custom Animation Effects */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    .animate-fade-in {
        animation: fadeIn 0.6s ease-out forwards;
    }

    .delay-100 { animation-delay: 100ms; }
    .delay-200 { animation-delay: 200ms; }
    .delay-300 { animation-delay: 300ms; }
</style>

<div class="max-w-6xl mx-auto px-4 pb-20" style="padding-top: 140px;" 
     x-data="{
        search: '',
        languages: [],
        specializations: [],
        allGuides: {{ json_encode($pramuwisata) }},
        currentPage: 1,
        itemsPerPage: 3,

        resetFilters() {
            this.search = '';
            this.languages = [];
            this.specializations = [];
            this.currentPage = 1;
        },

        toggleSpecialization(spec) {
            if (this.specializations.includes(spec)) {
                this.specializations = this.specializations.filter(s => s !== spec);
            } else {
                this.specializations.push(spec);
            }
            this.currentPage = 1;
        },

        get filteredGuides() {
            return this.allGuides.filter(guide => {
                // Name Search
                const matchesSearch = this.search === '' || guide.nama.toLowerCase().includes(this.search.toLowerCase());
                
                // Language Filter
                const matchesLanguage = this.languages.length === 0 || this.languages.every(lang => guide.bahasa.includes(lang));
                
                // Specialization Filter
                const matchesSpec = this.specializations.length === 0 || this.specializations.some(spec => guide.spesialisasi.includes(spec));
                
                return matchesSearch && matchesLanguage && matchesSpec;
            });
        },

        get paginatedGuides() {
            const start = (this.currentPage - 1) * this.itemsPerPage;
            return this.filteredGuides.slice(start, start + this.itemsPerPage);
        },

        get totalPages() {
            return Math.ceil(this.filteredGuides.length / this.itemsPerPage) || 1;
        }
     }">

    <!-- Header Section (Animate Entrance) -->
    <div class="text-center max-w-3xl mx-auto mb-16 animate-fade-in-up">
        <h1 class="text-3xl md:text-4xl font-bold text-hpi-green mt-4 mb-4">
            {{ $locale == 'id' ? 'Direktori Pramuwisata' : 'Tour Guide Directory' }}
        </h1>
        <p class="text-gray-500 leading-relaxed text-sm md:text-base">
            {{ $locale == 'id' 
                ? 'Temukan pemandu wisata profesional bersertifikat untuk memandu perjalanan Anda menjelajahi kekayaan alam dan budaya Kabupaten Malang.'
                : 'Find certified professional tour guides to lead your journey exploring the natural and cultural wealth of Malang Regency.' }}
        </p>
    </div>

    <!-- Main Content Area -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        
        <!-- Filter Panel (Left Sidebar) -->
        <div class="lg:col-span-1 animate-fade-in-up delay-100">
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 sticky top-28">
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-100">
                    <h2 class="text-lg font-bold text-gray-800">Filter</h2>
                    <button @click="resetFilters()" class="text-xs font-semibold text-gray-400 hover:text-hpi-green flex items-center gap-1 transition-colors">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.21 7.89H18m0 0V3"></path></svg>
                        {{ $locale == 'id' ? 'Reset' : 'Reset' }}
                    </button>
                </div>

                <!-- Name Search -->
                <div class="mb-6">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                        {{ $locale == 'id' ? 'Pencarian Nama' : 'Search Name' }}
                    </label>
                    <div class="relative">
                        <input type="text" x-model="search" placeholder="{{ $locale == 'id' ? 'Cari pemandu...' : 'Search guide...' }}" 
                               class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 pl-10 pr-4 text-sm focus:outline-none focus:ring-1 focus:ring-hpi-green focus:border-hpi-green transition-all placeholder-gray-400">
                        <span class="absolute left-3.5 top-3.5 text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </span>
                    </div>
                </div>

                <!-- Language Filter -->
                <div class="mb-6">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">
                        {{ $locale == 'id' ? 'Kemampuan Bahasa' : 'Language Skills' }}
                    </label>
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" value="ID" x-model="languages" class="rounded text-hpi-green focus:ring-hpi-green border-gray-300 w-4.5 h-4.5">
                            <span class="text-sm font-medium text-gray-600 group-hover:text-gray-900 transition-colors">Indonesia</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" value="EN" x-model="languages" class="rounded text-hpi-green focus:ring-hpi-green border-gray-300 w-4.5 h-4.5">
                            <span class="text-sm font-medium text-gray-600 group-hover:text-gray-900 transition-colors">English</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" value="AR" x-model="languages" class="rounded text-hpi-green focus:ring-hpi-green border-gray-300 w-4.5 h-4.5">
                            <span class="text-sm font-medium text-gray-600 group-hover:text-gray-900 transition-colors">Arab</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" value="NL" x-model="languages" class="rounded text-hpi-green focus:ring-hpi-green border-gray-300 w-4.5 h-4.5">
                            <span class="text-sm font-medium text-gray-600 group-hover:text-gray-900 transition-colors">Dutch</span>
                        </label>
                    </div>
                </div>

                <!-- Specialization Badge Filters -->
                <div class="mb-8">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">
                        {{ $locale == 'id' ? 'Spesialisasi' : 'Specialization' }}
                    </label>
                    <div class="flex flex-wrap gap-2">
                        <template x-for="spec in ['Nature', 'Culture', 'MICE', 'Culinary', 'Adventure']" :key="spec">
                            <button @click="toggleSpecialization(spec)"
                                    :class="specializations.includes(spec) 
                                        ? 'bg-amber-100 text-amber-800 border-amber-200' 
                                        : 'bg-white text-gray-600 border-gray-200 hover:border-gray-300'"
                                    class="text-xs px-3.5 py-2 rounded-full border transition-all font-medium"
                                    x-text="spec">
                            </button>
                        </template>
                    </div>
                </div>

                <!-- Terapkan Filter Button -->
                <button @click="currentPage = 1" class="w-full bg-hpi-green text-white font-semibold py-3 px-4 rounded-xl hover:bg-emerald-900 transition-colors text-sm shadow-sm flex items-center justify-center gap-2">
                    {{ $locale == 'id' ? 'Terapkan Filter' : 'Apply Filter' }}
                </button>
            </div>
        </div>

        <!-- Cards Display Area -->
        <div class="lg:col-span-3">
            <!-- Grid container with delay for entry transition -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 animate-fade-in-up delay-200">
                <template x-for="guide in paginatedGuides" :key="guide.id">
                    <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-md border border-gray-100 transition-all duration-300 flex flex-col group">
                        
                        <!-- Image Container with Certification Badge -->
                        <div class="relative h-64 w-full overflow-hidden bg-gray-100">
                            <img :src="guide.foto" :alt="guide.nama" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            
                            <!-- Tersertifikasi Badge -->
                            <template x-if="guide.tersertifikasi">
                                <div class="absolute top-4 right-4 bg-amber-400 text-gray-900 px-3 py-1 rounded-full text-[10px] font-bold tracking-wide flex items-center gap-1 shadow-sm border border-amber-300">
                                    <svg class="w-3 h-3 text-gray-900 fill-current" viewBox="0 0 20 20"><path d="M6.267 3.455a.75.75 0 00-.708-.523H4.5a1.5 1.5 0 00-1.5 1.5v.98c0 .35.244.662.59.722l.53.092a14.07 14.07 0 005.18 0l.53-.092a.75.75 0 00.59-.722v-.98A1.5 1.5 0 008.5 2.932H7.442a.75.75 0 00-.707.523L6.267 3.455z"/><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
                                    {{ $locale == 'id' ? 'Tersertifikasi' : 'Certified' }}
                                </div>
                            </template>
                        </div>

                        <!-- Card Body -->
                        <div class="p-5 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-gray-800 mb-1 group-hover:text-hpi-green transition-colors" x-text="guide.nama"></h3>
                                
                                <!-- Location -->
                                <div class="flex items-center gap-1 text-gray-400 text-xs mb-4">
                                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span x-text="guide.lokasi"></span>
                                </div>

                                <!-- Languages Badges -->
                                <div class="flex flex-wrap gap-1.5 mb-4">
                                    <template x-for="lang in guide.bahasa" :key="lang">
                                        <span class="bg-gray-100 text-gray-500 font-bold px-2 py-0.5 rounded text-[10px] uppercase" x-text="lang"></span>
                                    </template>
                                </div>
                            </div>

                            <!-- Specialization list and action arrow -->
                            <div class="border-t border-gray-100 pt-4 flex items-center justify-between">
                                <span class="text-xs font-semibold text-hpi-green" x-text="guide.spesialisasi.join(', ')"></span>
                                <a href="/hubungi-kami" class="w-8 h-8 rounded-full bg-gray-50 hover:bg-hpi-green text-gray-400 hover:text-white flex items-center justify-center transition-colors group/arrow">
                                    <svg class="w-4 h-4 transform group-hover/arrow:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </div>
                        </div>

                    </div>
                </template>
            </div>

            <!-- Empty State -->
            <div x-show="filteredGuides.length === 0" class="text-center py-16 animate-fade-in" x-cloak>
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h4 class="text-base font-bold text-gray-700 mb-1">Pemandu Tidak Ditemukan</h4>
                <p class="text-gray-400 text-sm">Coba sesuaikan kata kunci pencarian atau filter Anda.</p>
            </div>

            <!-- Pagination (Animate Entrance) -->
            <div class="flex items-center justify-center gap-2 mt-12 animate-fade-in-up delay-300" x-show="totalPages > 1" x-cloak>
                <!-- Prev Button -->
                <button @click="if(currentPage > 1) currentPage--" 
                        :disabled="currentPage === 1"
                        class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-500 hover:border-hpi-green hover:text-hpi-green disabled:opacity-40 disabled:hover:border-gray-200 disabled:hover:text-gray-500 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>

                <!-- Page numbers -->
                <template x-for="p in totalPages" :key="p">
                    <button @click="currentPage = p"
                            :class="currentPage === p ? 'bg-hpi-green text-white border-hpi-green' : 'border-gray-200 text-gray-600 hover:border-hpi-green hover:text-hpi-green'"
                            class="w-10 h-10 rounded-full border flex items-center justify-center font-semibold text-sm transition-colors"
                            x-text="p">
                    </button>
                </template>

                <!-- Next Button -->
                <button @click="if(currentPage < totalPages) currentPage++" 
                        :disabled="currentPage === totalPages"
                        class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-500 hover:border-hpi-green hover:text-hpi-green disabled:opacity-40 disabled:hover:border-gray-200 disabled:hover:text-gray-500 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>

        </div>

    </div>

</div>

@endsection
