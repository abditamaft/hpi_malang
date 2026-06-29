<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') - HPI Malang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 antialiased font-sans">
    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar -->
        <div class="w-64 bg-gray-900 text-white flex flex-col">
            <div class="p-6">
                <h2 class="text-2xl font-bold">Admin Panel</h2>
            </div>
            <nav class="flex-1 px-4 space-y-2 overflow-y-auto">
                <a href="{{ route('admin.destinasi.index') }}"
                   class="block px-4 py-2 mt-2 text-sm font-semibold {{ request()->routeIs('admin.destinasi*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} rounded-lg">
                    🗺️ Destinasi
                </a>
                <a href="{{ route('admin.kategori-destinasi.index') }}"
                   class="block px-4 py-2 mt-2 text-sm font-semibold {{ request()->routeIs('admin.kategori-destinasi*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} rounded-lg">
                    🏷️ Kategori Destinasi
                </a>
                <a href="/" class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg">
                    🌐 Ke Halaman Web
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-y-auto">
            
            <!-- Top Header -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="flex items-center justify-between px-6 py-4">
                    <h1 class="text-xl font-semibold text-gray-800">@yield('title', 'Admin Panel')</h1>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6 bg-gray-100">
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                
                @yield('content')
            </main>

        </div>
    </div>
</body>
</html>
