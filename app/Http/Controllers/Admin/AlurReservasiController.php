<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlurReservasi;
use Illuminate\Http\Request;

class AlurReservasiController extends Controller
{
    public function index()
    {
        // Mengambil data dan diurutkan dari langkah terkecil ke terbesar (1, 2, 3...)
        $alur = AlurReservasi::orderBy('langkah_ke', 'asc')->get();
        return view('admin.alur-reservasi.index', compact('alur'));
    }

    public function create()
    {
        return view('admin.alur-reservasi.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'langkah_ke'   => 'required|integer',
            'judul_id'     => 'required|string|max:255',
            'judul_en'     => 'required|string|max:255',
            'deskripsi_id' => 'required|string',
            'deskripsi_en' => 'required|string',
        ]);

        AlurReservasi::create($validatedData);

        return redirect()->route('admin.alur-reservasi.index')->with('success', 'Langkah Alur Reservasi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $alur = AlurReservasi::findOrFail($id);
        return view('admin.alur-reservasi.edit', compact('alur'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'langkah_ke'   => 'required|integer',
            'judul_id'     => 'required|string|max:255',
            'judul_en'     => 'required|string|max:255',
            'deskripsi_id' => 'required|string',
            'deskripsi_en' => 'required|string',
        ]);

        $alur = AlurReservasi::findOrFail($id);
        $alur->update($validatedData);

        return redirect()->route('admin.alur-reservasi.index')->with('success', 'Langkah Alur Reservasi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $alur = AlurReservasi::findOrFail($id);
        $alur->delete();

        return redirect()->route('admin.alur-reservasi.index')->with('success', 'Langkah Alur Reservasi berhasil dihapus!');
    }
}