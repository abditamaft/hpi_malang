<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Keunggulan;
use Illuminate\Http\Request;

class KeunggulanController extends Controller
{
    public function index()
    {
        $keunggulan = Keunggulan::orderBy('id', 'desc')->get();
        return view('admin.keunggulan.index', compact('keunggulan'));
    }

    public function create()
    {
        return view('admin.keunggulan.create');
    }

    public function store(Request $request)
    {
        // PERHATIKAN BARIS INI: Ada tambahan $validatedData = 
        $validatedData = $request->validate([
            'ikon'         => 'nullable|string',
            'judul_id'     => 'required|string|max:255',
            'judul_en'     => 'required|string|max:255',
            'deskripsi_id' => 'required|string',
            'deskripsi_en' => 'required|string',
        ]);

        Keunggulan::create($validatedData);

        return redirect()->route('admin.keunggulan.index')->with('success', 'Data Keunggulan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $keunggulan = Keunggulan::findOrFail($id);
        return view('admin.keunggulan.edit', compact('keunggulan'));
    }

    public function update(Request $request, $id)
    {
        // PERHATIKAN BARIS INI: Ada tambahan $validatedData = 
        $validatedData = $request->validate([
            'ikon'         => 'nullable|string',
            'judul_id'     => 'required|string|max:255',
            'judul_en'     => 'required|string|max:255',
            'deskripsi_id' => 'required|string',
            'deskripsi_en' => 'required|string',
        ]);

        $keunggulan = Keunggulan::findOrFail($id);
        $keunggulan->update($validatedData);

        return redirect()->route('admin.keunggulan.index')->with('success', 'Data Keunggulan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $keunggulan = Keunggulan::findOrFail($id);
        $keunggulan->delete();

        return redirect()->route('admin.keunggulan.index')->with('success', 'Data Keunggulan berhasil dihapus!');
    }
}