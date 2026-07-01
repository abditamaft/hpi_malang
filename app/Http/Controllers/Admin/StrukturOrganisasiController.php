<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;

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
            // Jabatan dibuat nullable saat validasi karena akan disembunyikan JS
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
        $struktur->update($validatedData);

        return redirect()->route('admin.struktur-organisasi.index')->with('success', 'Data Pengurus berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $struktur = StrukturOrganisasi::findOrFail($id);
        $struktur->delete();

        return redirect()->route('admin.struktur-organisasi.index')->with('success', 'Data Pengurus berhasil dihapus!');
    }
}