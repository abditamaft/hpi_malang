<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        // Mengambil baris data pertama dari tabel kontak[cite: 5]
        $kontak = Kontak::first();
        return view('admin.kontak.index', compact('kontak'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'telepon'   => 'required|string|max:50',
            'email'     => 'required|email|max:100',
            'alamat_id' => 'required|string',
            'alamat_en' => 'required|string',
        ]);

        $kontak = Kontak::first();

        // Update data jika sudah ada, atau buat baru jika database masih kosong
        if ($kontak) {
            $kontak->update([
                'telepon'   => $request->telepon,
                'email'     => $request->email,
                'alamat_id' => $request->alamat_id,
                'alamat_en' => $request->alamat_en,
            ]);
        } else {
            Kontak::create([
                'telepon'   => $request->telepon,
                'email'     => $request->email,
                'alamat_id' => $request->alamat_id,
                'alamat_en' => $request->alamat_en,
                'instagram' => '-', // Diisi default karena kolom ini NOT NULL di database tapi sudah dikelola di web_settings[cite: 5]
            ]);
        }

        return redirect()->route('admin.kontak.index')->with('success', 'Data informasi kontak berhasil diperbarui!');
    }
}