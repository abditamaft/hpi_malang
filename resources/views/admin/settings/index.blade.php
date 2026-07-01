@extends('layouts.admin')

@section('title', 'Web Settings & Hero')

@section('content')
<div class="max-w-5xl mx-auto pb-10">

    @if(session('success'))
    <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl flex items-center gap-3">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        <span class="font-medium">{{ session('success') }}</span>
    </div>
    @endif

    @if ($errors->any())
    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-4 rounded-xl">
        <strong class="font-bold flex items-center gap-2 mb-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Gagal Menyimpan Data!
        </strong>
        <ul class="list-disc ml-6 text-sm space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
            <h2 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                1. Pengaturan Hero Banner
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="col-span-1">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Gambar Latar Hero</label>
                    @if($settings->hero_gambar)
                        <img src="{{ asset('storage/' . $settings->hero_gambar) }}" class="w-full h-32 object-cover rounded-xl mb-3 border border-gray-200 shadow-sm">
                    @else
                        <div class="w-full h-32 bg-gray-100 rounded-xl mb-3 border border-gray-200 border-dashed flex items-center justify-center text-gray-400 text-sm">
                            Belum ada gambar
                        </div>
                    @endif
                    <input type="file" name="hero_gambar" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                    <p class="text-xs text-gray-400 mt-2">Format: JPG, PNG, WEBP. Maks 2MB.</p>
                </div>

                <div class="col-span-1 md:col-span-2 space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Judul Hero (Bahasa Indonesia)</label>
                        <textarea rows="3" name="hero_judul_id" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">{{ $settings->hero_judul_id }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Judul Hero (English)</label>
                        <textarea rows="3" name="hero_judul_en" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">{{ $settings->hero_judul_en }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Tip: Gunakan tag &lt;br&gt; untuk enter, dan &lt;span class="text-hpi-green"&gt;Teks&lt;/span&gt; untuk warna hijau.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
            <h2 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                2. Teks Sambutan Ketua
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Sambutan (Bahasa Indonesia)</label>
                    <textarea rows="4" name="teks_sambutan_id" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500">{{ $settings->teks_sambutan_id }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Sambutan (English)</label>
                    <textarea rows="4" name="teks_sambutan_en" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500">{{ $settings->teks_sambutan_en }}</textarea>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
            <h2 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                3. Tentang Kami (Ringkasan di Beranda)
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Judul (Bahasa Indonesia)</label>
                    <input type="text" name="judul_tentang_kami_id" value="{{ $settings->judul_tentang_kami_id }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Judul (English)</label>
                    <input type="text" name="judul_tentang_kami_en" value="{{ $settings->judul_tentang_kami_en }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi (Bahasa Indonesia)</label>
                    <textarea rows="5" name="deskripsi_tentang_kami_id" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500">{{ $settings->deskripsi_tentang_kami_id }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi (English)</label>
                    <textarea rows="5" name="deskripsi_tentang_kami_en" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500">{{ $settings->deskripsi_tentang_kami_en }}</textarea>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
            <h2 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                4. Logo Website
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Logo Utama (Header & Navbar)</label>
                    <div class="flex items-center gap-4 mb-3">
                        @if($settings->logo_header)
                            <div class="bg-gray-100 p-2 rounded-lg border border-gray-200 w-24 h-24 flex items-center justify-center">
                                <img src="{{ asset('storage/' . $settings->logo_header) }}" class="max-w-full max-h-full object-contain">
                            </div>
                        @else
                            <div class="bg-gray-100 p-2 rounded-lg border border-gray-200 border-dashed w-24 h-24 flex items-center justify-center text-xs text-center text-gray-400">Belum ada logo</div>
                        @endif
                        <div class="flex-1">
                            <input type="file" name="logo_header" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                            <p class="text-xs text-gray-400 mt-2">Gunakan format PNG transparan atau SVG.</p>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Logo Footer (Bawah Website)</label>
                    <div class="flex items-center gap-4 mb-3">
                        @if($settings->logo_footer)
                            <div class="bg-gray-800 p-2 rounded-lg border border-gray-600 w-24 h-24 flex items-center justify-center">
                                <img src="{{ asset('storage/' . $settings->logo_footer) }}" class="max-w-full max-h-full object-contain">
                            </div>
                        @else
                            <div class="bg-gray-100 p-2 rounded-lg border border-gray-200 border-dashed w-24 h-24 flex items-center justify-center text-xs text-center text-gray-400">Belum ada logo</div>
                        @endif
                        <div class="flex-1">
                            <input type="file" name="logo_footer" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                            <p class="text-xs text-gray-400 mt-2">Saran: Gunakan logo versi putih/monokrom jika background footer gelap.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
            <h2 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                5. Teks Footer & Sosial Media
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Teks Deskripsi Footer (Bahasa Indonesia)</label>
                    <textarea rows="3" name="teks_footer_id" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500">{{ $settings->teks_footer_id }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Teks Deskripsi Footer (English)</label>
                    <textarea rows="3" name="teks_footer_en" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500">{{ $settings->teks_footer_en }}</textarea>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6 border-t border-gray-100">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">Instagram URL</label>
                    <input type="url" name="link_instagram" value="{{ $settings->link_instagram }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" placeholder="https://instagram.com/hpimalang">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">Facebook URL</label>
                    <input type="url" name="link_facebook" value="{{ $settings->link_facebook }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" placeholder="https://facebook.com/hpimalang">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">YouTube URL</label>
                    <input type="url" name="link_youtube" value="{{ $settings->link_youtube }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" placeholder="https://youtube.com/@hpimalang">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">Twitter / X URL</label>
                    <input type="url" name="link_twitter" value="{{ $settings->link_twitter }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500" placeholder="https://twitter.com/hpimalang">
                </div>
            </div>
        </div>

        <div class="flex justify-end sticky bottom-6 z-10">
            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-8 rounded-xl shadow-xl shadow-emerald-200 transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                Simpan Semua Pengaturan
            </button>
        </div>
    </form>

</div>
@endsection