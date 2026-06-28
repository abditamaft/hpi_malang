<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ulasan; // WAJIB DITAMBAHKAN agar bisa menyimpan data ke tabel ulasan

class FrontEndController extends Controller
{
    /**
     * Menampilkan Halaman Utama (Beranda)
     */
    public function index()
    {
        return view('beranda');
    }

    /**
     * Menampilkan Halaman Tentang Kami
     */
    public function tentang()
    {
        return view('tentang');
    }

    /**
     * Menampilkan Halaman Destinasi
     */
    public function destinasi()
    {
        return view('destinasi');
    }

    /**
     * Menyimpan data dari Form "Kirim Ulasan" di Beranda
     */
    public function store(Request $request)
    {
        // 1. Validasi inputan dari form
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'asal_daerah'  => 'required|string|max:255',
            'komentar_id'  => 'required|string',
        ]);

        // 2. Simpan data ke database
        Ulasan::create([
            'nama_lengkap' => $request->nama_lengkap,
            'asal_daerah'  => $request->asal_daerah,
            'komentar_id'  => $request->komentar_id,
            'komentar_en'  => null, // Dikosongkan agar admin bisa menerjemahkan nanti
            'rating'       => 5, // Default 5 bintang sesuai desain
            'status'       => 'Pending' // Wajib 'Pending' agar tidak langsung tampil sebelum disetujui admin
        ]);

        // 3. Kembalikan pengunjung ke halaman beranda beserta pesan sukses
        return redirect()->back()->with('success', 'Terima kasih! Ulasan Anda berhasil dikirim dan sedang menunggu persetujuan admin.');
    }

    // Biarkan fungsi bawaan resource ini kosong untuk sekarang
    public function create() {}
    public function show(string $id) {}
    public function edit(string $id) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id) {}
}