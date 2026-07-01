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
            
            // --- VALIDASI TAMBAHAN BARU ---
            'logo_header' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'logo_footer' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'teks_footer_id' => 'nullable|string',
            'teks_footer_en' => 'nullable|string',
            'link_facebook' => 'nullable|string',
            'link_instagram' => 'nullable|string',
            'link_youtube' => 'nullable|string',
            'link_twitter' => 'nullable|string',
        ]);

        $settings = WebSetting::first();

        // Proses Upload Hero Gambar
        if ($request->hasFile('hero_gambar')) {
            if ($settings->hero_gambar && Storage::disk('public')->exists($settings->hero_gambar)) {
                Storage::disk('public')->delete($settings->hero_gambar);
            }
            $settings->hero_gambar = $request->file('hero_gambar')->store('hero', 'public');
        }

        // --- PROSES UPLOAD LOGO HEADER ---
        if ($request->hasFile('logo_header')) {
            if ($settings->logo_header && Storage::disk('public')->exists($settings->logo_header)) {
                Storage::disk('public')->delete($settings->logo_header);
            }
            $settings->logo_header = $request->file('logo_header')->store('logo', 'public');
        }

        // --- PROSES UPLOAD LOGO FOOTER ---
        if ($request->hasFile('logo_footer')) {
            if ($settings->logo_footer && Storage::disk('public')->exists($settings->logo_footer)) {
                Storage::disk('public')->delete($settings->logo_footer);
            }
            $settings->logo_footer = $request->file('logo_footer')->store('logo', 'public');
        }

        // Simpan Text & Teks
        $settings->hero_judul_id = $request->hero_judul_id;
        $settings->hero_judul_en = $request->hero_judul_en;
        $settings->teks_sambutan_id = $request->teks_sambutan_id;
        $settings->teks_sambutan_en = $request->teks_sambutan_en;
        $settings->judul_tentang_kami_id = $request->judul_tentang_kami_id;
        $settings->judul_tentang_kami_en = $request->judul_tentang_kami_en;
        $settings->deskripsi_tentang_kami_id = $request->deskripsi_tentang_kami_id;
        $settings->deskripsi_tentang_kami_en = $request->deskripsi_tentang_kami_en;

        // --- SIMPAN TEKS FOOTER & SOSIAL MEDIA ---
        $settings->teks_footer_id = $request->teks_footer_id;
        $settings->teks_footer_en = $request->teks_footer_en;
        $settings->link_facebook = $request->link_facebook;
        $settings->link_instagram = $request->link_instagram;
        $settings->link_youtube = $request->link_youtube;
        $settings->link_twitter = $request->link_twitter;

        $settings->save();

        return redirect()->back()->with('success', 'Semua Pengaturan Web berhasil diperbarui!');
    }
}