<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LayananController extends Controller
{
    public function index()
    {
        $layanans = Layanan::orderBy('id', 'desc')->get();
        return view('admin.layanan.index', compact('layanans'));
    }

    public function create()
    {
        return view('admin.layanan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan_id' => 'required|string|max:255',
            'nama_layanan_en' => 'required|string|max:255',
            'deskripsi_id'    => 'required|string',
            'deskripsi_en'    => 'required|string',
            'ikon'            => 'nullable|string|max:100',
            'url_gambar'      => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->only(['nama_layanan_id', 'nama_layanan_en', 'deskripsi_id', 'deskripsi_en', 'ikon']);

        if ($request->hasFile('url_gambar')) {
            $path = $request->file('url_gambar')->store('layanan', 'public');
            $data['url_gambar'] = $path;
        }

        Layanan::create($data);

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $layanan = Layanan::findOrFail($id);
        return view('admin.layanan.edit', compact('layanan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_layanan_id' => 'required|string|max:255',
            'nama_layanan_en' => 'required|string|max:255',
            'deskripsi_id'    => 'required|string',
            'deskripsi_en'    => 'required|string',
            'ikon'            => 'nullable|string|max:100',
            'url_gambar'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $layanan = Layanan::findOrFail($id);
        $data = $request->only(['nama_layanan_id', 'nama_layanan_en', 'deskripsi_id', 'deskripsi_en', 'ikon']);

        if ($request->hasFile('url_gambar')) {
            // Hapus gambar lama
            if ($layanan->url_gambar) {
                Storage::disk('public')->delete($layanan->url_gambar);
            }
            $path = $request->file('url_gambar')->store('layanan', 'public');
            $data['url_gambar'] = $path;
        }

        $layanan->update($data);

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);

        if ($layanan->url_gambar) {
            Storage::disk('public')->delete($layanan->url_gambar);
        }

        $layanan->delete();

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil dihapus!');
    }
}
