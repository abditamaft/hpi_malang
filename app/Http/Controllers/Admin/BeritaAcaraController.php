<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KegiatanBerita;

class BeritaAcaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kegiatanMendatang = KegiatanBerita::published()
            ->kegiatan()
            ->mendatang()
            ->orderBy('tanggal_kegiatan')
            ->get();

        $beritaTerbaru = KegiatanBerita::published()
            ->berita()
            ->latest('tanggal_kegiatan')
            ->paginate(9);

        return view('berita-acara.index', [
            'kegiatanMendatang' => $kegiatanMendatang,
            'beritaTerbaru' => $beritaTerbaru,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $item = KegiatanBerita::published()->where('slug', $slug)->firstOrFail();
        return view('showBerita.show', ['item' => $item]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
