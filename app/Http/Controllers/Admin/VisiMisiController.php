<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    public function index()
    {
        // Mengurutkan Visi di atas, lalu Misi di bawahnya berdasarkan urutan angka
        $visimisi = VisiMisi::orderBy('tipe', 'desc')->orderBy('urutan', 'asc')->get();
        return view('admin.visi-misi.index', compact('visimisi'));
    }

    public function create()
    {
        return view('admin.visi-misi.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tipe'         => 'required|in:Visi,Misi',
            'urutan'       => 'nullable|integer',
            'judul_id'     => 'nullable|string|max:255',
            'judul_en'     => 'nullable|string|max:255',
            'deskripsi_id' => 'required|string',
            'deskripsi_en' => 'required|string',
        ]);

        // Jika urutan kosong, set default 0
        $validatedData['urutan'] = $validatedData['urutan'] ?? 0;

        VisiMisi::create($validatedData);

        return redirect()->route('admin.visi-misi.index')->with('success', 'Data Visi/Misi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $visimisi = VisiMisi::findOrFail($id);
        return view('admin.visi-misi.edit', compact('visimisi'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tipe'         => 'required|in:Visi,Misi',
            'urutan'       => 'nullable|integer',
            'judul_id'     => 'nullable|string|max:255',
            'judul_en'     => 'nullable|string|max:255',
            'deskripsi_id' => 'required|string',
            'deskripsi_en' => 'required|string',
        ]);

        $validatedData['urutan'] = $validatedData['urutan'] ?? 0;

        $visimisi = VisiMisi::findOrFail($id);
        $visimisi->update($validatedData);

        return redirect()->route('admin.visi-misi.index')->with('success', 'Data Visi/Misi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $visimisi = VisiMisi::findOrFail($id);
        $visimisi->delete();

        return redirect()->route('admin.visi-misi.index')->with('success', 'Data Visi/Misi berhasil dihapus!');
    }
}