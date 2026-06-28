@php
    $locale = session('locale', 'id');
@endphp

<header x-data="{ scrolled: false, mobileMenu: false }" 
        @scroll.window="scrolled = (window.pageYOffset > 20) ? true : false"
        class="fixed top-0 left-0 w-full z-50 flex justify-center transition-all duration-700 ease-in-out"
        :class="scrolled ? 'pt-0' : 'pt-6'">

    <div :class="scrolled ? 'w-full rounded-none bg-white/95 backdrop-blur-md shadow-md py-4 px-6 md:px-12 border-b border-gray-200' : 'w-[95%] max-w-6xl rounded-full bg-white/90 backdrop-blur-md shadow-lg py-3 px-6 md:px-8 border border-white/40'"
         class="transition-all duration-700 ease-in-out flex items-center justify-between mx-auto">
        
        <a href="/" class="flex items-center gap-2 shrink-0">
            @if(isset($settings) && $settings->logo_header)
                <img src="{{ asset('storage/'.$settings->logo_header) }}" alt="Logo HPI" 
                     class="transition-all duration-700 ease-in-out"
                     :class="scrolled ? 'h-10' : 'h-8'">
            @else
                <span class="font-bold text-hpi-green tracking-tight transition-all duration-700"
                      :class="scrolled ? 'text-2xl' : 'text-xl'">HPI Kab. Malang</span>
            @endif
        </a>

        <nav class="hidden lg:flex items-center gap-1 font-medium text-sm transition-all duration-500">
            <a href="/" class="px-4 py-2 rounded-full transition-colors {{ request()->is('/') ? 'bg-gray-800 text-white' : 'text-gray-600 hover:text-hpi-green hover:bg-gray-100' }}">
                {{ $locale == 'id' ? 'Beranda' : 'Home' }}
            </a>
            <a href="/tentang" class="px-4 py-2 rounded-full transition-colors {{ request()->is('tentang') ? 'bg-gray-800 text-white' : 'text-gray-600 hover:text-hpi-green hover:bg-gray-100' }}">
                {{ $locale == 'id' ? 'Tentang' : 'About' }}
            </a>
            <a href="/destinasi" class="px-4 py-2 rounded-full transition-colors {{ request()->is('destinasi') ? 'bg-gray-800 text-white' : 'text-gray-600 hover:text-hpi-green hover:bg-gray-100' }}">
                {{ $locale == 'id' ? 'Destinasi' : 'Destinations' }}
            </a>
            <a href="/layanan" class="px-4 py-2 rounded-full transition-colors {{ request()->is('layanan') ? 'bg-gray-800 text-white' : 'text-gray-600 hover:text-hpi-green hover:bg-gray-100' }}">
                {{ $locale == 'id' ? 'Layanan' : 'Services' }}
            </a>
            <a href="/direktori" class="px-4 py-2 rounded-full transition-colors {{ request()->is('direktori') ? 'bg-gray-800 text-white' : 'text-gray-600 hover:text-hpi-green hover:bg-gray-100' }}">
                {{ $locale == 'id' ? 'Direktori' : 'Directory' }}
            </a>
            <a href="/berita" class="px-4 py-2 rounded-full transition-colors {{ request()->is('berita') ? 'bg-gray-800 text-white' : 'text-gray-600 hover:text-hpi-green hover:bg-gray-100' }}">
                {{ $locale == 'id' ? 'Berita & Acara' : 'News & Events' }}
            </a>
        </nav>

        <div class="flex items-center gap-3 shrink-0">
            <div class="flex bg-gray-100/80 rounded-full p-1 border border-gray-200">
                <a href="{{ route('lang.switch', 'id') }}" class="px-3 py-1.5 rounded-full text-[11px] font-bold tracking-wider transition-all {{ $locale == 'id' ? 'bg-white shadow text-gray-800' : 'text-gray-500 hover:text-gray-700' }}">ID</a>
                <a href="{{ route('lang.switch', 'en') }}" class="px-3 py-1.5 rounded-full text-[11px] font-bold tracking-wider transition-all {{ $locale == 'en' ? 'bg-white shadow text-gray-800' : 'text-gray-500 hover:text-gray-700' }}">EN</a>
            </div>

            <a href="/hubungi-kami" class="hidden md:block bg-hpi-green text-white px-6 py-2.5 rounded-full text-sm font-semibold hover:bg-emerald-900 transition-colors shadow-sm">
                {{ $locale == 'id' ? 'Hubungi Kami' : 'Contact Us' }}
            </a>

            <button @click="mobileMenu = !mobileMenu" class="lg:hidden p-2 text-gray-600 hover:text-hpi-green focus:outline-none">
                <svg x-show="!mobileMenu" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                <svg x-show="mobileMenu" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    </div>

    <div x-show="mobileMenu" 
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         @click.away="mobileMenu = false"
         x-cloak
         class="absolute top-full left-0 w-full bg-white shadow-xl lg:hidden mt-2 border-t border-gray-100 flex flex-col p-4 gap-2">
         
         <a href="/" class="p-3 rounded-lg hover:bg-gray-50 font-medium {{ request()->is('/') ? 'text-hpi-green bg-gray-50' : 'text-gray-700' }}">{{ $locale == 'id' ? 'Beranda' : 'Home' }}</a>
         <a href="/tentang" class="p-3 rounded-lg hover:bg-gray-50 font-medium {{ request()->is('tentang') ? 'text-hpi-green bg-gray-50' : 'text-gray-700' }}">{{ $locale == 'id' ? 'Tentang' : 'About' }}</a>
         <a href="/destinasi" class="p-3 rounded-lg hover:bg-gray-50 font-medium {{ request()->is('destinasi') ? 'text-hpi-green bg-gray-50' : 'text-gray-700' }}">{{ $locale == 'id' ? 'Destinasi' : 'Destinations' }}</a>
         <a href="/layanan" class="p-3 rounded-lg hover:bg-gray-50 font-medium {{ request()->is('layanan') ? 'text-hpi-green bg-gray-50' : 'text-gray-700' }}">{{ $locale == 'id' ? 'Layanan' : 'Services' }}</a>
         <a href="/direktori" class="p-3 rounded-lg hover:bg-gray-50 font-medium {{ request()->is('direktori') ? 'text-hpi-green bg-gray-50' : 'text-gray-700' }}">{{ $locale == 'id' ? 'Direktori' : 'Directory' }}</a>
         <a href="/berita" class="p-3 rounded-lg hover:bg-gray-50 font-medium {{ request()->is('berita') ? 'text-hpi-green bg-gray-50' : 'text-gray-700' }}">{{ $locale == 'id' ? 'Berita & Acara' : 'News & Events' }}</a>
         <a href="/hubungi-kami" class="mt-4 p-3 rounded-lg bg-hpi-green text-white font-medium text-center">{{ $locale == 'id' ? 'Hubungi Kami' : 'Contact Us' }}</a>
    </div>
</header>