<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - HPI Malang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        /* Mencegah kilatan (flicker) elemen Alpine.js saat halaman dimuat */
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-100 flex font-sans text-gray-800 antialiased" x-data="{ sidebarOpen: false }">

    <div x-show="sidebarOpen" x-cloak 
         class="fixed inset-0 z-30 bg-slate-900/50 backdrop-blur-sm md:hidden" 
         @click="sidebarOpen = false"
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
    </div>

    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
           class="w-72 bg-slate-900 h-screen text-slate-300 flex flex-col fixed left-0 top-0 overflow-y-auto pb-20 z-40 transition-transform duration-300 ease-in-out md:translate-x-0 shadow-xl md:shadow-none">
        
        <div class="p-6 bg-slate-950/50 flex justify-between items-center sticky top-0 z-10">
            <div>
                <h2 class="text-2xl font-bold text-white">HPI<span class="text-emerald-500">CMS</span></h2>
                <p class="text-xs text-slate-500 mt-1">Kabupaten Malang</p>
            </div>
            <button @click="sidebarOpen = false" class="md:hidden text-slate-400 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <nav class="flex-1 p-4 space-y-6">
            
            <div>
                <a href="/admin/dashboard" class="flex items-center gap-3 py-2.5 px-4 rounded-lg bg-emerald-600/10 text-emerald-400 font-semibold transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard Utama
                </a>
            </div>

            <div>
                <h3 class="px-4 text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Pengaturan Global</h3>
                <div class="space-y-1">
                    <a href="{{ route('admin.settings.index') }}" class="block py-2 px-4 rounded-lg {{ request()->routeIs('admin.settings*') ? 'bg-emerald-600/20 text-emerald-400 font-semibold' : 'hover:bg-slate-800 hover:text-white' }} transition">Web Settings & Hero</a>
                    <a href="/admin/kontak" class="block py-2 px-4 rounded-lg hover:bg-slate-800 hover:text-white transition">Kontak & Sosial Media</a>
                </div>
            </div>

            <div>
                <h3 class="px-4 text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Manajemen Konten</h3>
                <div class="space-y-1">
                    <a href="/admin/pramuwisata" class="block py-2 px-4 rounded-lg {{ request()->is('admin/pramuwisata*') ? 'bg-emerald-600/20 text-emerald-400 font-semibold' : 'hover:bg-slate-800 hover:text-white' }} transition">Direktori Pramuwisata</a>
                    <a href="{{ route('admin.destinasi.index') }}" class="block py-2 px-4 rounded-lg {{ request()->routeIs('admin.destinasi*') ? 'bg-emerald-600/20 text-emerald-400 font-semibold' : 'hover:bg-slate-800 hover:text-white' }} transition">Destinasi Wisata</a>
                    <a href="{{ route('admin.kategori-destinasi.index') }}" class="block py-2 px-4 rounded-lg {{ request()->routeIs('admin.kategori-destinasi*') ? 'bg-emerald-600/20 text-emerald-400 font-semibold' : 'hover:bg-slate-800 hover:text-white' }} transition">Kategori Destinasi</a>
                    <a href="/admin/layanan" class="block py-2 px-4 rounded-lg {{ request()->is('admin/layanan*') ? 'bg-emerald-600/20 text-emerald-400 font-semibold' : 'hover:bg-slate-800 hover:text-white' }} transition">Layanan Pemanduan</a>
                    <a href="{{ route('admin.berita.index') }}" class="block py-2 px-4 rounded-lg {{ request()->routeIs('admin.berita*') ? 'bg-emerald-600/20 text-emerald-400 font-semibold' : 'hover:bg-slate-800 hover:text-white' }} transition">Berita &amp; Acara</a>
                </div>
            </div>

            <div>
                <h3 class="px-4 text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Interaksi Pengunjung</h3>
                <div class="space-y-1">
                    <a href="{{ route('admin.ulasan.index') }}" class="block py-2 px-4 rounded-lg {{ request()->routeIs('admin.ulasan*') ? 'bg-emerald-600/20 text-emerald-400 font-semibold' : 'hover:bg-slate-800 hover:text-white' }} transition flex justify-between items-center">
                        Ulasan Masuk
                        <span class="bg-red-500 text-white text-[10px] px-2 py-0.5 rounded-full">{{\App\Models\Ulasan::where('status', 'Pending')->count()}}</span>
                    </a>
                    <a href="{{ route('admin.faq.index') }}" class="block py-2 px-4 rounded-lg {{ request()->routeIs('admin.faq*') ? 'bg-emerald-600/20 text-emerald-400 font-semibold' : 'hover:bg-slate-800 hover:text-white' }} transition">FAQ (Pertanyaan Umum)</a>
                </div>
            </div>

            <div>
                <h3 class="px-4 text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Konten Statis</h3>
                <div class="space-y-1">
                    <a href="{{ route('admin.visi-misi.index') }}" class="block py-2 px-4 rounded-lg {{ request()->routeIs('admin.visi-misi*') ? 'bg-emerald-600/20 text-emerald-400 font-semibold' : 'hover:bg-slate-800 hover:text-white' }} transition">Visi & Misi</a>
                    <a href="{{ route('admin.keunggulan.index') }}" class="block py-2 px-4 rounded-lg {{ request()->routeIs('admin.keunggulan*') ? 'bg-emerald-600/20 text-emerald-400 font-semibold' : 'hover:bg-slate-800 hover:text-white' }} transition">Mengapa Memilih HPI</a>
                    <a href="{{ route('admin.alur-reservasi.index') }}" class="block py-2 px-4 rounded-lg {{ request()->routeIs('admin.alur-reservasi*') ? 'bg-emerald-600/20 text-emerald-400 font-semibold' : 'hover:bg-slate-800 hover:text-white' }} transition">Alur Reservasi</a>
                    <a href="{{ route('admin.struktur-organisasi.index') }}" class="block py-2 px-4 rounded-lg {{ request()->routeIs('admin.struktur-organisasi*') ? 'bg-emerald-600/20 text-emerald-400 font-semibold' : 'hover:bg-slate-800 hover:text-white' }} transition">Struktur Organisasi</a>
                </div>
            </div>
        </nav>
    </aside>

    <div class="flex-1 flex flex-col min-h-screen transition-all duration-300 md:ml-72 w-full">
        
        <header class="bg-white h-16 flex items-center justify-between px-4 md:px-8 shadow-sm border-b border-gray-100 sticky top-0 z-20">
            
            <div class="flex items-center gap-3 md:gap-0">
                <button @click="sidebarOpen = true" class="md:hidden text-gray-500 hover:text-emerald-600 focus:outline-none p-1 rounded-md bg-gray-50">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                
                <h1 class="text-lg font-bold text-gray-800 truncate">@yield('title', 'Dashboard')</h1>
            </div>
            
            <div class="flex items-center gap-4">
                <span class="text-sm font-semibold text-gray-600 hidden sm:block">{{ auth()->user()->name ?? 'Administrator' }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-red-500 hover:text-red-700 font-bold transition flex items-center gap-1">
                        <span class="hidden sm:inline">Logout</span>
                        <svg class="w-5 h-5 sm:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </button>
                </form>
            </div>
        </header>

        <main class="flex-1 p-4 md:p-8 w-full overflow-x-hidden">
            @yield('content')
        </main>
    </div>

</body>
</html>