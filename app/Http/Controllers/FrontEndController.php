<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ulasan; // WAJIB DITAMBAHKAN agar bisa menyimpan data ke tabel ulasan
use App\Models\WebSetting;
use App\Models\VisiMisi;
use App\Models\StrukturOrganisasi;
use App\Models\KegiatanBerita;


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
        // 1. Ambil pengaturan web untuk judul
        $settings = WebSetting::first();

        // 2. Ambil Visi (Hanya 1 baris pertama)
        $visi = VisiMisi::where('tipe', 'Visi')->first();

        // 3. Ambil Misi (Bisa banyak, diurutkan berdasarkan kolom 'urutan')
        $misi = VisiMisi::where('tipe', 'Misi')->orderBy('urutan', 'asc')->get();

        // 4. Ambil Struktur Organisasi berdasarkan kategorinya
        $dewanPenasihat = StrukturOrganisasi::where('kategori_pengurus', 'Dewan Penasihat')->get();
        $dewanKodeEtik = StrukturOrganisasi::where('kategori_pengurus', 'Dewan Kode Etik')->get();
        $pengurusHarian = StrukturOrganisasi::where('kategori_pengurus', 'Pengurus Harian')->get();

        return view('tentang', compact('settings', 'visi', 'misi', 'dewanPenasihat', 'dewanKodeEtik', 'pengurusHarian'));
    }

    /**
     * Menampilkan Halaman Destinasi
     */
    public function destinasi(\Illuminate\Http\Request $request)
    {
        $aktifKategori = $request->query('kategori', '');

        // Ambil semua kategori unik (kecuali placeholder) untuk tombol filter
        $kategori = \Illuminate\Support\Facades\DB::table('destinasi')
            ->select('kategori_id', 'kategori_en')
            ->distinct()
            ->where('nama_destinasi_id', '!=', '__kategori_placeholder__')
            ->orderBy('kategori_id')
            ->get()
            ->unique('kategori_id')
            ->values();

        // Query destinasi (kecualikan placeholder) + filter kategori jika ada
        $query = \App\Models\Destinasi::where('nama_destinasi_id', '!=', '__kategori_placeholder__');
        if ($aktifKategori) {
            $query->where('kategori_id', $aktifKategori);
        }

        $unggulan  = (clone $query)->where('is_unggulan', true)->orderBy('dibuat_pada', 'desc')->get();
        $biasa     = (clone $query)->where('is_unggulan', false)->orderBy('dibuat_pada', 'desc')->get();
        $destinasi = $unggulan->merge($biasa);

        return view('destinasi', compact('destinasi', 'unggulan', 'biasa', 'kategori', 'aktifKategori'));
    }

   public function layanan()
    {
        $layanan = \App\Models\Layanan::orderBy('id', 'desc')->get(); 
        return view('layanan', compact('layanan'));
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



    public function berita()
    {
        $kegiatanMendatang = KegiatanBerita::published()
            ->kegiatan()
            ->where('tanggal_kegiatan', '>=', now())
            ->orderBy('tanggal_kegiatan')
            ->get();

        $beritaTerbaru = KegiatanBerita::published()
            ->berita()
            ->latest('tanggal_kegiatan')
            ->paginate(9);

        return view('berita_acara', [
            'kegiatanMendatang' => $kegiatanMendatang,
            'beritaTerbaru' => $beritaTerbaru,
        ]);
    }
    public function showBerita(string $slug)
    {
        $item = KegiatanBerita::published()->where('slug', $slug)->firstOrFail();
        if ($item->tipe === 'kegiatan') {
            return view('showKegiatan', ['item' => $item]);
        }
        return view('showBerita', ['item' => $item]);
    }
    
}