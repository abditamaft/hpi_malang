<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class DestinasiController extends Controller
{
    public function index()
    {
        $destinasi = Destinasi::where('nama_destinasi_id', '!=', '__kategori_placeholder__')
            ->orderByDesc('is_unggulan')
            ->orderBy('dibuat_pada', 'desc')
            ->get();
        return view('admin.destinasi.index', compact('destinasi'));
    }

    public function create()
    {
        $kategori = DB::table('destinasi')
            ->select('kategori_id', 'kategori_en')
            ->distinct()
            ->orderBy('kategori_id')
            ->get()
            ->unique('kategori_id')
            ->values();
        return view('admin.destinasi.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id'      => 'required|string',
            'kategori_en'      => 'nullable|string',
            'nama_destinasi_id'=> 'required|string',
            'nama_destinasi_en'=> 'nullable|string',
            'deskripsi_id'     => 'required|string',
            'deskripsi_en'     => 'nullable|string',
            'url_gambar'       => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_unggulan'      => 'nullable|boolean',
        ]);

        $data = $request->except('url_gambar');
        $data['is_unggulan'] = $request->has('is_unggulan') ? 1 : 0;

        if ($request->hasFile('url_gambar')) {
            $path = $request->file('url_gambar')->store('destinasi', 'public');
            $data['url_gambar'] = $path;
        }

        Destinasi::create($data);

        return redirect()->route('admin.destinasi.index')->with('success', 'Destinasi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $destinasi = Destinasi::findOrFail($id);
        $kategori  = DB::table('destinasi')
            ->select('kategori_id', 'kategori_en')
            ->distinct()
            ->orderBy('kategori_id')
            ->get()
            ->unique('kategori_id')
            ->values();
        return view('admin.destinasi.edit', compact('destinasi', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $destinasi = Destinasi::findOrFail($id);

        $request->validate([
            'kategori_id'      => 'required|string',
            'kategori_en'      => 'nullable|string',
            'nama_destinasi_id'=> 'required|string',
            'nama_destinasi_en'=> 'nullable|string',
            'deskripsi_id'     => 'required|string',
            'deskripsi_en'     => 'nullable|string',
            'url_gambar'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_unggulan'      => 'nullable|boolean',
        ]);

        $data = $request->except('url_gambar');
        $data['is_unggulan'] = $request->has('is_unggulan') ? 1 : 0;

        if ($request->hasFile('url_gambar')) {
            if ($destinasi->url_gambar && Storage::disk('public')->exists($destinasi->url_gambar)) {
                Storage::disk('public')->delete($destinasi->url_gambar);
            }
            $path = $request->file('url_gambar')->store('destinasi', 'public');
            $data['url_gambar'] = $path;
        }

        $destinasi->update($data);

        return redirect()->route('admin.destinasi.index')->with('success', 'Destinasi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $destinasi = Destinasi::findOrFail($id);

        if ($destinasi->url_gambar && Storage::disk('public')->exists($destinasi->url_gambar)) {
            Storage::disk('public')->delete($destinasi->url_gambar);
        }

        $destinasi->delete();

        return redirect()->route('admin.destinasi.index')->with('success', 'Destinasi berhasil dihapus!');
    }
}
