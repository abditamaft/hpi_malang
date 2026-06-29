<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriDestinasiController extends Controller
{
    /**
     * Tampilkan semua kategori unik dari tabel destinasi
     */
    public function index()
    {
        $kategori = DB::table('destinasi')
            ->select('kategori_id', 'kategori_en')
            ->distinct()
            ->where('nama_destinasi_id', '!=', '__kategori_placeholder__')
            ->orderBy('kategori_id')
            ->get()
            ->merge(
                DB::table('destinasi')
                    ->select('kategori_id', 'kategori_en')
                    ->distinct()
                    ->where('nama_destinasi_id', '__kategori_placeholder__')
                    ->orderBy('kategori_id')
                    ->get()
            )
            ->unique('kategori_id')
            ->values();

        return view('admin.kategori-destinasi.index', compact('kategori'));
    }

    /**
     * Tambah kategori baru — simpan sebagai placeholder agar terdaftar di dropdown
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|string|max:100',
            'kategori_en' => 'required|string|max:100',
        ]);

        $nama_id = trim($request->kategori_id);
        $nama_en = trim($request->kategori_en);

        // Cek duplikat (case-insensitive)
        $exists = DB::table('destinasi')
            ->whereRaw('LOWER(kategori_id) = ?', [strtolower($nama_id)])
            ->exists();

        if ($exists) {
            return response()->json(['error' => 'Kategori sudah ada.'], 422);
        }

        // Simpan sebagai placeholder agar kategori bisa dipilih di form destinasi
        DB::table('destinasi')->insert([
            'kategori_id'       => $nama_id,
            'kategori_en'       => $nama_en,
            'nama_destinasi_id' => '__kategori_placeholder__',
            'nama_destinasi_en' => '__category_placeholder__',
            'deskripsi_id'      => '',
            'deskripsi_en'      => '',
            'url_gambar'        => '',
            'is_unggulan'       => 0,
            'dibuat_pada'       => now(),
            'diperbarui_pada'   => now(),
        ]);

        return response()->json(['success' => true, 'kategori_id' => $nama_id, 'kategori_en' => $nama_en]);
    }

    /**
     * Rename kategori — update semua baris destinasi yang memakai nama lama
     */
    public function update(Request $request, $kategori_id)
    {
        $request->validate([
            'kategori_id' => 'required|string|max:100',
            'kategori_en' => 'required|string|max:100',
        ]);

        $lama_id = urldecode($kategori_id);
        $baru_id = trim($request->kategori_id);
        $baru_en = trim($request->kategori_en);

        DB::table('destinasi')
            ->where('kategori_id', $lama_id)
            ->update([
                'kategori_id'     => $baru_id,
                'kategori_en'     => $baru_en,
                'diperbarui_pada' => now(),
            ]);

        return response()->json(['success' => true]);
    }

    /**
     * Hapus kategori — hanya hapus placeholder, destinasi asli tidak terganggu
     */
    public function destroy($kategori_id)
    {
        $nama = urldecode($kategori_id);

        DB::table('destinasi')
            ->where('kategori_id', $nama)
            ->where('nama_destinasi_id', '__kategori_placeholder__')
            ->delete();

        $sisa = DB::table('destinasi')
            ->where('kategori_id', $nama)
            ->where('nama_destinasi_id', '!=', '__kategori_placeholder__')
            ->count();

        return response()->json([
            'success' => true,
            'warning' => $sisa > 0
                ? "Kategori dihapus dari daftar. Namun {$sisa} destinasi masih memakai kategori ini."
                : null,
        ]);
    }
}
