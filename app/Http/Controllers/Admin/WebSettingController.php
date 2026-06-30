<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebSettingController extends Controller
{
    // Menampilkan halaman form pengaturan
    public function edit()
    {
        $settings = WebSetting::first();
        if (!$settings) {
            $settings = new WebSetting();
            $settings->nama_website = 'HPI Malang';
            $settings->save();
        }

        // Ini memanggil file resources/views/admin/settings/index.blade.php
        return view('admin.settings.index', compact('settings'));
    }

    // Memproses form saat tombol simpan diklik
    public function update(Request $request)
    {
        $request->validate([
            'hero_gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'hero_judul_id' => 'nullable|string',
            'hero_judul_en' => 'nullable|string',
            'teks_sambutan_id' => 'nullable|string',
            'teks_sambutan_en' => 'nullable|string',
            'judul_tentang_kami_id' => 'nullable|string',
            'judul_tentang_kami_en' => 'nullable|string',
            'deskripsi_tentang_kami_id' => 'nullable|string',
            'deskripsi_tentang_kami_en' => 'nullable|string',
        ]);

        $settings = WebSetting::first();

        if ($request->hasFile('hero_gambar')) {
            if ($settings->hero_gambar && Storage::disk('public')->exists($settings->hero_gambar)) {
                Storage::disk('public')->delete($settings->hero_gambar);
            }
            $path = $request->file('hero_gambar')->store('hero', 'public');
            $settings->hero_gambar = $path;
        }

        $settings->hero_judul_id = $request->hero_judul_id;
        $settings->hero_judul_en = $request->hero_judul_en;
        $settings->teks_sambutan_id = $request->teks_sambutan_id;
        $settings->teks_sambutan_en = $request->teks_sambutan_en;
        $settings->judul_tentang_kami_id = $request->judul_tentang_kami_id;
        $settings->judul_tentang_kami_en = $request->judul_tentang_kami_en;
        $settings->deskripsi_tentang_kami_id = $request->deskripsi_tentang_kami_id;
        $settings->deskripsi_tentang_kami_en = $request->deskripsi_tentang_kami_en;

        $settings->save();

        return redirect()->back()->with('success', 'Pengaturan Beranda berhasil diperbarui!');
    }
}