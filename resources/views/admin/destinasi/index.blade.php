@extends('layouts.admin')

@section('title', 'Manajemen Destinasi')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-gray-800">Daftar Destinasi</h2>
        <a href="{{ route('admin.destinasi.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + Tambah Destinasi
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-4 border-b">Gambar</th>
                    <th class="py-3 px-4 border-b">Nama Destinasi</th>
                    <th class="py-3 px-4 border-b">Kategori</th>
                    <th class="py-3 px-4 border-b text-center">Tipe Card</th>
                    <th class="py-3 px-4 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @forelse($destinasi as $item)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="py-3 px-4">
                        @if($item->url_gambar)
                            <img src="{{ asset('storage/' . $item->url_gambar) }}" class="h-16 w-24 object-cover rounded shadow">
                        @else
                            <span class="text-gray-400 text-xs">Tidak ada gambar</span>
                        @endif
                    </td>
                    <td class="py-3 px-4">
                        <div class="font-bold text-gray-800">{{ $item->nama_destinasi_id }}</div>
                        <div class="text-xs text-gray-500">{{ $item->nama_destinasi_en }}</div>
                    </td>
                    <td class="py-3 px-4">
                        <span class="bg-gray-200 text-gray-700 py-1 px-3 rounded-full text-xs">{{ $item->kategori_id }}</span>
                    </td>
                    <td class="py-3 px-4 text-center">
                        @if($item->is_unggulan)
                            <span class="inline-flex items-center gap-1 bg-amber-100 text-amber-700 text-xs font-bold px-3 py-1 rounded-full">
                                ⭐ Unggulan (2/3)
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-500 text-xs font-medium px-3 py-1 rounded-full">
                                Biasa (1/3)
                            </span>
                        @endif
                    </td>
                    <td class="py-3 px-4 text-center">
                        <div class="flex items-center justify-center gap-3">
                            <a href="{{ route('admin.destinasi.edit', $item->id) }}" class="text-blue-500 hover:text-blue-700 font-medium">Edit</a>
                            <form action="{{ route('admin.destinasi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus destinasi ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 font-medium">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-6 px-4 text-center text-gray-500">Belum ada data destinasi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg text-sm text-blue-700">
        <strong>ℹ️ Keterangan Tipe Card:</strong><br>
        • <strong>Unggulan (2/3)</strong>: Card besar dengan layout gambar kiri + teks kanan, ditampilkan di baris pertama.<br>
        • <strong>Biasa (1/3)</strong>: Card normal dengan gambar di atas dan teks di bawah.
    </div>
</div>
@endsection
