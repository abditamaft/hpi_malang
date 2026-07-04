<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KegiatanBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KegiatanBeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = KegiatanBerita::query()->latest('dibuat_pada');
        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }
        $items = $query->paginate(10)->withQueryString();
        return view('admin.berita.index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.berita.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validateData($request);
        if ($request->hasFile('url_gambar')) {
            $data['url_gambar'] = $request->file('url_gambar')->store('kegiatan-berita', 'public');
        }
        KegiatanBerita::create($data);
        return redirect()->route('admin.berita.index')->with('success', 'Konten berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KegiatanBerita $berita)
    {
        return view('admin.berita.edit', ['item' => $berita]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KegiatanBerita $berita)
    {
        $data = $this->validateData($request, $berita->id);
        if ($request->hasFile('url_gambar')) {
            if ($berita->url_gambar) {
                Storage::disk('public')->delete($berita->url_gambar);
            }
            $data['url_gambar'] = $request->file('url_gambar')->store('kegiatan-berita', 'public');
        }
        $berita->update($data);

        return redirect()->route('admin.berita.index')->with('success', 'Konten berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KegiatanBerita $berita)
    {
        if ($berita->url_gambar) {
            Storage::disk('public')->delete($berita->url_gambar);
        }
        $berita->delete();

        return back()->with('success', 'Konten berhasil dihapus.');
    }

    private function validateData(Request $request, ?int $ignoreId = null): array
    {
        $validated = $request->validate([
            'tipe' => 'required|in:kegiatan,berita',
            'tanggal_kegiatan' => 'nullable|date',
            'lokasi_kegiatan' => 'nullable|string|max:255',
            'url_gambar' => 'nullable|image|max:5120',
            'url_sumber' => 'nullable|url|max:255',
            'judul_id' => 'required|string|max:255',
            'judul_en' => 'required|string|max:255',
            'kategori_id' => 'nullable|string|max:100',
            'kategori_en' => 'nullable|string|max:100',
            'deskripsi_singkat_id' => 'nullable|string|max:500',
            'deskripsi_singkat_en' => 'nullable|string|max:500',
            'isi_id' => 'nullable|string',
            'isi_en' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);
        $validated['status'] = $request->boolean('status');
        if ($validated['tipe'] === 'berita') {
            $validated['lokasi_kegiatan'] = null;
        }

        return $validated;
    }
}

