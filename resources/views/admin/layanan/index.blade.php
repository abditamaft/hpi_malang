@extends('layouts.admin')

@section('title', 'Manajemen Layanan')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-gray-800">Daftar Layanan</h2>
        <a href="{{ route('admin.layanan.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded-xl transition flex items-center gap-2">
            + Tambah Layanan
        </a>
    </div>

    @if(session('success'))
    <div class="mb-4 bg-emerald-50 text-emerald-700 px-4 py-3 rounded-lg border border-emerald-200">
        {{ session('success') }}
    </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-sm border-b border-gray-200">
                    <th class="py-3 px-4 font-semibold w-24">Gambar</th>
                    <th class="py-3 px-4 font-semibold w-12">Ikon</th>
                    <th class="py-3 px-4 font-semibold w-1/4">Nama Layanan (ID / EN)</th>
                    <th class="py-3 px-4 font-semibold">Deskripsi (ID / EN)</th>
                    <th class="py-3 px-4 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($layanans as $item)
                <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                    <td class="py-3 px-4">
                        @if($item->url_gambar)
                            <img src="{{ asset('storage/' . $item->url_gambar) }}" alt="{{ $item->nama_layanan_id }}" class="w-16 h-16 object-cover rounded-lg border border-gray-100 bg-gray-50">
                        @else
                            <span class="text-gray-400 italic">No image</span>
                        @endif
                    </td>
                    <td class="py-3 px-4 font-mono text-gray-500">
                        {{ $item->ikon ?: '-' }}
                    </td>
                    <td class="py-3 px-4">
                        <p class="font-bold text-gray-800">{{ $item->nama_layanan_id }}</p>
                        <p class="text-xs text-gray-500 italic">{{ $item->nama_layanan_en }}</p>
                    </td>
                    <td class="py-3 px-4 text-gray-600 max-w-xs">
                        <p class="truncate">{{ $item->deskripsi_id }}</p>
                        <p class="text-xs text-gray-400 italic truncate">{{ $item->deskripsi_en }}</p>
                    </td>
                    <td class="py-3 px-4 flex justify-end gap-2 mt-4">
                        <a href="{{ route('admin.layanan.edit', $item->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-lg transition text-xs font-bold">Edit</a>
                        <form action="{{ route('admin.layanan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus layanan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg transition text-xs font-bold">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-6 px-4 text-center text-gray-400 italic">
                        Belum ada data layanan. Silakan tambah layanan baru.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
