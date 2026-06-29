<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login CMS - HPI Malang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full bg-white rounded-3xl shadow-xl overflow-hidden">
        <div class="bg-emerald-800 p-8 text-center">
            <h1 class="text-3xl font-bold text-white mb-2">HPI Malang</h1>
            <p class="text-emerald-200 text-sm">Content Management System</p>
        </div>
        
        <div class="p-8">
            <!-- Menampilkan Error Jika Login Gagal -->
            @if ($errors->any())
                <div class="bg-red-50 text-red-500 p-4 rounded-lg mb-6 text-sm">
                    Kredensial yang Anda masukkan salah.
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Username Admin</label>
                    <input type="text" name="username" value="admin" required autofocus class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition">
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Password</label>
                    <input type="password" name="password" value="123" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition">
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 text-emerald-600 rounded border-gray-300 focus:ring-emerald-600">
                        <span class="text-sm text-gray-600">Ingat Saya</span>
                    </label>
                </div>

                <button type="submit" class="w-full bg-emerald-700 hover:bg-emerald-900 text-white font-bold py-3 rounded-xl transition">
                    Masuk ke Dashboard
                </button>
            </form>
        </div>
    </div>

</body>
</html>