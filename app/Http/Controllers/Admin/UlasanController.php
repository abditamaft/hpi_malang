<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ulasan;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    // Menampilkan daftar ulasan
    public function index()
    {
        // Tampilkan ulasan, urutkan yang "Pending" di atas, lalu berdasarkan ID terbaru
        $ulasan = Ulasan::orderByRaw("FIELD(status, 'Pending', 'Approved', 'Rejected')")
                        ->orderBy('id', 'desc')
                        ->get();
                        
        return view('admin.ulasan.index', compact('ulasan'));
    }

    // Menampilkan form kurasi/edit ulasan
    public function edit($id)
    {
        $ulasan = Ulasan::findOrFail($id);
        return view('admin.ulasan.edit', compact('ulasan'));
    }

    // Menyimpan perubahan status & terjemahan
    public function update(Request $request, $id)
    {
        $request->validate([
            'komentar_en' => 'nullable|string',
            'status'      => 'required|in:Pending,Approved,Rejected',
        ]);

        $ulasan = Ulasan::findOrFail($id);
        $ulasan->komentar_en = $request->komentar_en;
        $ulasan->status      = $request->status;
        $ulasan->save();

        return redirect()->route('admin.ulasan.index')->with('success', 'Ulasan berhasil dikurasi!');
    }

    // Menghapus ulasan (jika spam)
    public function destroy($id)
    {
        $ulasan = Ulasan::findOrFail($id);
        $ulasan->delete();

        return redirect()->route('admin.ulasan.index')->with('success', 'Ulasan berhasil dihapus!');
    }
}