<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - HPI Malang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Alpine.js untuk interaksi dropdown jika diperlukan nanti -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 flex font-sans text-gray-800 antialiased">

    <!-- Sidebar -->
    <aside class="w-72 bg-slate-900 min-h-screen text-slate-300 flex flex-col fixed left-0 top-0 overflow-y-auto">
        <div class="p-6 bg-slate-950/50">
            <h2 class="text-2xl font-bold text-white">HPI<span class="text-emerald-500">CMS</span></h2>
            <p class="text-xs text-slate-500 mt-1">Kabupaten Malang</p>
        </div>

        <nav class="flex-1 p-4 space-y-6">
            
            <!-- 1. Dashboard Utama -->
            <div>
                <a href="/admin/dashboard" class="flex items-center gap-3 py-2.5 px-4 rounded-lg bg-emerald-600/10 text-emerald-400 font-semibold transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard Utama
                </a>
            </div>

            <!-- 2. Pengaturan Website -->
            <div>
                <h3 class="px-4 text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Pengaturan Global</h3>
                <div class="space-y-1">
                    <a href="/admin/settings" class="block py-2 px-4 rounded-lg hover:bg-slate-800 hover:text-white transition">Web Settings & Hero</a>
                    <a href="/admin/kontak" class="block py-2 px-4 rounded-lg hover:bg-slate-800 hover:text-white transition">Kontak & Sosial Media</a>
                </div>
            </div>

            <!-- 3. Manajemen Konten -->
            <div>
                <h3 class="px-4 text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Manajemen Konten</h3>
                <div class="space-y-1">
                    <a href="/admin/pramuwisata" class="block py-2 px-4 rounded-lg {{ request()->is('admin/pramuwisata*') ? 'bg-emerald-600/20 text-emerald-400 font-semibold' : 'hover:bg-slate-800 hover:text-white' }} transition">Direktori Pramuwisata</a>
                    <a href="{{ route('admin.destinasi.index') }}" class="block py-2 px-4 rounded-lg {{ request()->routeIs('admin.destinasi*') ? 'bg-emerald-600/20 text-emerald-400 font-semibold' : 'hover:bg-slate-800 hover:text-white' }} transition">Destinasi Wisata</a>
                    <a href="{{ route('admin.kategori-destinasi.index') }}" class="block py-2 px-4 rounded-lg {{ request()->routeIs('admin.kategori-destinasi*') ? 'bg-emerald-600/20 text-emerald-400 font-semibold' : 'hover:bg-slate-800 hover:text-white' }} transition">Kategori Destinasi</a>
                    <a href="/admin/layanan" class="block py-2 px-4 rounded-lg {{ request()->is('admin/layanan*') ? 'bg-emerald-600/20 text-emerald-400 font-semibold' : 'hover:bg-slate-800 hover:text-white' }} transition">Layanan Pemanduan</a>
                    <a href="/admin/berita" class="block py-2 px-4 rounded-lg {{ request()->is('admin/berita*') ? 'bg-emerald-600/20 text-emerald-400 font-semibold' : 'hover:bg-slate-800 hover:text-white' }} transition">Berita &amp; Kegiatan</a>
                </div>
            </div>

            <!-- 4. Interaksi Pengunjung -->
            <div>
                <h3 class="px-4 text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Interaksi Pengunjung</h3>
                <div class="space-y-1">
                    <a href="/admin/ulasan" class="block py-2 px-4 rounded-lg hover:bg-slate-800 hover:text-white transition flex justify-between items-center">
                        Ulasan Masuk
                        <span class="bg-red-500 text-white text-[10px] px-2 py-0.5 rounded-full">{{\App\Models\Ulasan::where('status', 'Pending')->count()}}</span>
                    </a>
                    <a href="/admin/faq" class="block py-2 px-4 rounded-lg hover:bg-slate-800 hover:text-white transition">FAQ (Pertanyaan Umum)</a>
                </div>
            </div>

            <!-- 5. Konten Statis -->
            <div>
                <h3 class="px-4 text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Konten Statis</h3>
                <div class="space-y-1">
                    <a href="/admin/visi-misi" class="block py-2 px-4 rounded-lg hover:bg-slate-800 hover:text-white transition">Visi & Misi</a>
                    <a href="/admin/keunggulan" class="block py-2 px-4 rounded-lg hover:bg-slate-800 hover:text-white transition">Mengapa Memilih HPI</a>
                    <a href="/admin/alur-reservasi" class="block py-2 px-4 rounded-lg hover:bg-slate-800 hover:text-white transition">Alur Reservasi</a>
                    <a href="/admin/struktur-organisasi" class="block py-2 px-4 rounded-lg hover:bg-slate-800 hover:text-white transition">Struktur Organisasi</a>
                </div>
            </div>
        </nav>
    </aside>

    <!-- Main Content Area -->
    <div class="ml-72 flex-1 flex flex-col min-h-screen">
        <!-- Top Navbar -->
        <header class="bg-white h-16 flex items-center justify-between px-8 shadow-sm border-b border-gray-100 sticky top-0 z-10">
            <h1 class="text-lg font-bold text-gray-800">@yield('title', 'Dashboard')</h1>
            
            <div class="flex items-center gap-4">
                <span class="text-sm font-semibold text-gray-600">{{ auth()->user()->name ?? 'Administrator' }}</span>
                <!-- Form Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-red-500 hover:text-red-700 font-bold transition">Logout</button>
                </form>
            </div>
        </header>

        <!-- Dynamic Content -->
        <main class="flex-1 p-8">
            @yield('content')
        </main>
    </div>

</body>
</html>