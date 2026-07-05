<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pramuwisata;
use Illuminate\Support\Facades\Storage;

class PramuwisataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $items = Pramuwisata::query()
            ->when($request->filled('q'), fn ($q) => $q->where('nama_lengkap', 'like', '%' . $request->q . '%'))
            ->latest('dibuat_pada')
            ->paginate(10)
            ->withQueryString();

        return view('admin.pramuwisata.index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pramuwisata.create', $this->daftarAutocomplete());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validateData($request);
        if ($request->hasFile('foto_profil')) {
            $data['foto_profil'] = $request->file('foto_profil')->store('pramuwisata', 'public');
        }
        Pramuwisata::create($data);

        return redirect()->route('admin.direktori.index')->with('success', 'Pramuwisata berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pramuwisata $direktori)
    {
        return view('admin.pramuwisata.edit', ['item' => $direktori] + $this->daftarAutocomplete());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pramuwisata $direktori)
    {
        $data = $this->validateData($request, $direktori->id);
        if ($request->hasFile('foto_profil')) {
            if ($direktori->foto_profil) {
                Storage::disk('public')->delete($direktori->foto_profil);
            }
            $data['foto_profil'] = $request->file('foto_profil')->store('pramuwisata', 'public');
        }
        $direktori->update($data);

        return redirect()->route('admin.direktori.index')->with('success', 'Data pramuwisata berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pramuwisata $direktori)
    {
        if ($direktori->foto_profil) {
            Storage::disk('public')->delete($direktori->foto_profil);
        }
        $direktori->delete();
        return back()->with('success', 'Data pramuwisata berhasil dihapus.');
    }

    private function daftarAutocomplete(): array
    {
        return [
            'daftarBahasaId' => Pramuwisata::nilaiUnikDariJson('bahasa', 'id'),
            'daftarBahasaEn' => Pramuwisata::nilaiUnikDariJson('bahasa', 'en'),
            'daftarSpesialisasiId' => Pramuwisata::nilaiUnikDariJson('spesialisasi', 'id'),
            'daftarSpesialisasiEn' => Pramuwisata::nilaiUnikDariJson('spesialisasi', 'en'),
            'daftarWilayahOperasi' => Pramuwisata::nilaiUnikDariJson('wilayah_operasi'),
        ];
    }

    private function validateData(Request $request, ?int $ignoreId = null): array
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'no_lisensi' => 'nullable|string|max:100',
            'masa_berlaku_lisensi' => 'nullable|date',
            'no_ktan' => 'nullable|string|max:100',
            'masa_berlaku_ktan' => 'nullable|date',
            'aktif_sejak' => 'nullable|date',
            'foto_profil' => 'nullable|image|max:5120',
            'jenis_wisata_id' => 'nullable|string|max:255',
            'jenis_wisata_en' => 'nullable|string|max:255',
            'is_tersertifikasi' => 'nullable|boolean',
            'bio_id' => 'nullable|string',
            'bio_en' => 'nullable|string',
            'status' => 'nullable|boolean',

            'bahasa' => 'nullable|array',
            'bahasa.*.id' => 'nullable|string|max:100',
            'bahasa.*.en' => 'nullable|string|max:100',

            'spesialisasi' => 'nullable|array',
            'spesialisasi.*.id' => 'nullable|string|max:100',
            'spesialisasi.*.en' => 'nullable|string|max:100',

            'wilayah_operasi' => 'nullable|array',
            'wilayah_operasi.*' => 'nullable|string|max:255',
        ]);

        $validated['is_tersertifikasi'] = $request->boolean('is_tersertifikasi');
        $validated['status'] = $request->boolean('status');

        $validated['bahasa'] = collect($validated['bahasa'] ?? [])
            ->filter(fn ($row) => filled($row['id'] ?? null) || filled($row['en'] ?? null))
            ->values()
            ->all();

        $validated['spesialisasi'] = collect($validated['spesialisasi'] ?? [])
            ->filter(fn ($row) => filled($row['id'] ?? null) || filled($row['en'] ?? null))
            ->values()
            ->all();

        $validated['wilayah_operasi'] = collect($validated['wilayah_operasi'] ?? [])
            ->filter(fn ($v) => filled($v))
            ->values()
            ->all();

        return $validated;
    }
}
