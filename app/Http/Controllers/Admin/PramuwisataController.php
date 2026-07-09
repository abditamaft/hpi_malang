<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pramuwisata;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\Portofolio;


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
        $direktori = Pramuwisata::create($data);
        $this->simpanPortofolioBaru($request, $direktori);

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
        $direktori->load('portofolio');
        return view('admin.pramuwisata.edit', ['item' => $direktori] + $this->daftarAutocomplete());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pramuwisata $direktori)
    {
        $this->validatePortofolio($request);
        $data = $this->validateData($request, $direktori->id);
        if ($request->hasFile('foto_profil')) {
            if ($direktori->foto_profil) {
                Storage::disk('public')->delete($direktori->foto_profil);
            }
            $data['foto_profil'] = $request->file('foto_profil')->store('pramuwisata', 'public');
        }
        $direktori->update($data);

        $this->perbaruiPortofolioLama($request, $direktori);
        $this->simpanPortofolioBaru($request, $direktori);

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
        foreach ($direktori->portofolio as $portofolio) {
            Storage::disk('public')->delete($portofolio->url_gambar);
        }
        $direktori->delete();
        return back()->with('success', 'Data pramuwisata berhasil dihapus.');
    }

    private function daftarAutocomplete(): array
    {
        $hasil = [];
        foreach (Pramuwisata::FIELD_MULTI_DWIBAHASA as $kolom) {
            $hasil[$kolom . 'Id'] = Pramuwisata::nilaiUnikDariJson($kolom, 'id');
            $hasil[$kolom . 'En'] = Pramuwisata::nilaiUnikDariJson($kolom, 'en');
        }
        $hasil['wilayahOperasi'] = Pramuwisata::nilaiUnikDariJson('wilayah_operasi');

        return $hasil;
    }

    private function validateData(Request $request, ?int $ignoreId = null): array
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'no_lisensi' => 'nullable|string|max:100',
            'masa_berlaku_lisensi' => 'nullable|date_format:Y-m',
            'no_ktan' => 'nullable|string|max:100',
            'masa_berlaku_ktan' => 'nullable|date_format:Y-m',
            'aktif_sejak' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'foto_profil' => 'nullable|image|max:5120',
            'is_tersertifikasi' => 'nullable|boolean',
            'bio_id' => 'nullable|string',
            'bio_en' => 'nullable|string',
            'status' => 'nullable|boolean',
            'bahasa_utama_id' => 'nullable|string|max:100',
            'bahasa_utama_en' => 'nullable|string|max:100',

            'wilayah_operasi' => 'nullable|array',
            'wilayah_operasi.*' => 'nullable|string|max:255',

        ],[
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nama_lengkap.max' => 'Nama lengkap tidak boleh lebih dari 255 karakter.',
            'no_lisensi.max' => 'Nomor lisensi tidak boleh lebih dari 100 karakter.',
            'masa_berlaku_lisensi.date_format' => 'Format masa berlaku lisensi harus berupa bulan dan tahun (YYYY-MM).',
            'no_ktan.max' => 'Nomor KTAN tidak boleh lebih dari 100 karakter.',
            'masa_berlaku_ktan.date_format' => 'Format masa berlaku KTAN harus berupa bulan dan tahun (YYYY-MM).',
            'aktif_sejak.integer' => 'Aktif sejak harus berupa angka tahun.',
            'aktif_sejak.min' => 'Aktif sejak tidak boleh kurang dari tahun 1900.',
            'aktif_sejak.max' => 'Aktif sejak tidak boleh lebih dari tahun '. (date('Y') + 1) . '.',
            'foto_profil.image' => 'File yang diunggah harus berupa gambar.',
            'foto_profil.max' => 'Ukuran file gambar tidak boleh lebih dari 5 MB.',
            'bio_id.string' => 'Bio (Indonesia) harus berupa teks.',
            'bio_en.string' => 'Bio (English) harus berupa teks.',
            'bahasa_utama_id.max' => 'Bahasa utama (Indonesia) tidak boleh lebih dari 100 karakter.',
            'bahasa_utama_en.max' => 'Bahasa utama (English) tidak boleh lebih dari 100 karakter.',
        ]);
        foreach (Pramuwisata::FIELD_MULTI_DWIBAHASA as $kolom) {
            $rows = $request->input($kolom, []);

            $request->validate([
                $kolom => 'nullable|array',
                $kolom . '.*.id' => 'nullable|string|max:150',
                $kolom . '.*.en' => 'nullable|string|max:150',
            ]);

            $validated[$kolom] = collect($rows)
                ->filter(fn ($row) => filled($row['id'] ?? null) || filled($row['en'] ?? null))
                ->values()
                ->all();
        }


        $validated['is_tersertifikasi'] = $request->boolean('is_tersertifikasi');
        $validated['status'] = $request->boolean('status');

        $validated['wilayah_operasi'] = collect($validated['wilayah_operasi'] ?? [])
            ->filter(fn ($v) => filled($v))
            ->values()
            ->all();
        
        $validated['masa_berlaku_lisensi'] = $this->bulanKeTanggal($validated['masa_berlaku_lisensi'] ?? null);
        $validated['masa_berlaku_ktan'] = $this->bulanKeTanggal($validated['masa_berlaku_ktan'] ?? null);

        return $validated;
    }
    private function bulanKeTanggal(?string $ym): ?string
    {
        return $ym ? Carbon::createFromFormat('Y-m', $ym)->startOfMonth()->format('Y-m-d') : null;
    }


    private function validatePortofolio(Request $request): void
    {
        $request->validate([
            'portofolio_baru' => 'nullable|array',
            'portofolio_baru.*.gambar' => 'nullable|image|max:5120',
            'portofolio_baru.*.keterangan_id' => 'nullable|string|max:255',
            'portofolio_baru.*.keterangan_en' => 'nullable|string|max:255',

            'portofolio_lama' => 'nullable|array',
            'portofolio_lama.*.keterangan_id' => 'nullable|string|max:255',
            'portofolio_lama.*.keterangan_en' => 'nullable|string|max:255',

            'hapus_portofolio' => 'nullable|array',
            'hapus_portofolio.*' => 'integer',
        ], [
            'portofolio_baru.*.gambar.image' => 'File yang diunggah harus berupa gambar.',
            'portofolio_baru.*.gambar.max' => 'Ukuran file gambar tidak boleh lebih dari 5 MB.',
            'portofolio_baru.*.keterangan_id.max' => 'Keterangan (Indonesia) tidak boleh lebih dari 255 karakter.',
            'portofolio_baru.*.keterangan_en.max' => 'Keterangan (English) tidak boleh lebih dari 255 karakter.',
            'portofolio_lama.*.keterangan_id.max' => 'Keterangan (Indonesia) tidak boleh lebih dari 255 karakter.',
            'portofolio_lama.*.keterangan_en.max' => 'Keterangan (English) tidak boleh lebih dari 255 karakter.',
        ]);
    }

    private function simpanPortofolioBaru(Request $request, Pramuwisata $direktori): void
    {
        foreach ($request->input('portofolio_baru', []) as $index => $row) {
            $file = $request->file("portofolio_baru.$index.gambar");

            if (!$file) {
                continue;
            }

            Portofolio::create([
                'pramuwisata_id' => $direktori->id,
                'url_gambar' => $file->store('portofolio', 'public'),
                'keterangan_id' => $row['keterangan_id'] ?? null,
                'keterangan_en' => $row['keterangan_en'] ?? null,
            ]);
        }
    }

    private function perbaruiPortofolioLama(Request $request, Pramuwisata $direktori): void
    {
        $idHapus = array_map('intval', $request->input('hapus_portofolio', []));

        foreach ($request->input('portofolio_lama', []) as $id => $row) {
            $portofolio = $direktori->portofolio->firstWhere('id', (int) $id);

            if (!$portofolio) {
                continue;
            }

            if (in_array((int) $id, $idHapus, true)) {
                Storage::disk('public')->delete($portofolio->url_gambar);
                $portofolio->delete();
                continue;
            }

            $portofolio->update([
                'keterangan_id' => $row['keterangan_id'] ?? null,
                'keterangan_en' => $row['keterangan_en'] ?? null,
            ]);
        }
    }

}
