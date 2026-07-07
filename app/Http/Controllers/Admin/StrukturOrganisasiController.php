<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Pastikan ini ada untuk fitur hapus gambar

class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        // Urutkan berdasarkan Kategori, lalu nama
        $struktur = StrukturOrganisasi::orderByRaw("FIELD(kategori_pengurus, 'Dewan Penasihat', 'Dewan Kode Etik', 'Pengurus Harian')")
                                      ->orderBy('nama', 'asc')
                                      ->get();
        return view('admin.struktur-organisasi.index', compact('struktur'));
    }

    public function create()
    {
        return view('admin.struktur-organisasi.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kategori_pengurus' => 'required|in:Dewan Penasihat,Dewan Kode Etik,Pengurus Harian',
            'nama'              => 'required|string|max:255',
            'foto'              => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Validasi foto
            'jabatan_id'        => 'nullable|string|max:255',
            'jabatan_en'        => 'nullable|string|max:255',
            'divisi_id'         => 'nullable|string|max:255',
            'divisi_en'         => 'nullable|string|max:255',
        ]);

        // LOGIKA OTOMATIS: Jika bukan Pengurus Harian, isi jabatan dengan "-"
        if ($validatedData['kategori_pengurus'] != 'Pengurus Harian') {
            $validatedData['jabatan_id'] = '-';
            $validatedData['jabatan_en'] = '-';
            $validatedData['divisi_id'] = null;
            $validatedData['divisi_en'] = null;
        }

        // --- TAMBAHAN: LOGIKA UPLOAD FOTO ---
        if ($request->hasFile('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('pengurus', 'public');
        }

        StrukturOrganisasi::create($validatedData);
        return redirect()->route('admin.struktur-organisasi.index')->with('success', 'Data Pengurus berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $struktur = StrukturOrganisasi::findOrFail($id);
        return view('admin.struktur-organisasi.edit', compact('struktur'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'kategori_pengurus' => 'required|in:Dewan Penasihat,Dewan Kode Etik,Pengurus Harian',
            'nama'              => 'required|string|max:255',
            'foto'              => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Tambahan validasi foto
            'jabatan_id'        => 'nullable|string|max:255',
            'jabatan_en'        => 'nullable|string|max:255',
            'divisi_id'         => 'nullable|string|max:255',
            'divisi_en'         => 'nullable|string|max:255',
        ]);

        // LOGIKA OTOMATIS: Jika bukan Pengurus Harian, isi jabatan dengan "-"
        if ($validatedData['kategori_pengurus'] != 'Pengurus Harian') {
            $validatedData['jabatan_id'] = '-';
            $validatedData['jabatan_en'] = '-';
            $validatedData['divisi_id'] = null;
            $validatedData['divisi_en'] = null;
        }

        $struktur = StrukturOrganisasi::findOrFail($id);

        // --- TAMBAHAN: LOGIKA UPDATE FOTO ---
        if ($request->hasFile('foto')) {
            // Hapus foto lama dari storage jika sebelumnya ada
            if ($struktur->foto && Storage::disk('public')->exists($struktur->foto)) {
                Storage::disk('public')->delete($struktur->foto);
            }
            // Simpan foto yang baru diupload
            $validatedData['foto'] = $request->file('foto')->store('pengurus', 'public');
        }

        $struktur->update($validatedData);

        return redirect()->route('admin.struktur-organisasi.index')->with('success', 'Data Pengurus berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $struktur = StrukturOrganisasi::findOrFail($id);
        
        // --- TAMBAHAN: HAPUS FOTO SAAT DATA DIHAPUS ---
        if ($struktur->foto && Storage::disk('public')->exists($struktur->foto)) {
            Storage::disk('public')->delete($struktur->foto);
        }

        $struktur->delete();

        return redirect()->route('admin.struktur-organisasi.index')->with('success', 'Data Pengurus berhasil dihapus!');
    }
}