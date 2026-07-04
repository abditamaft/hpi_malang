@extends('layouts.admin')
@section('title', 'Manajemen Berita & Kegiatan')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 mb-6">
        <h2 class="text-xl font-bold text-gray-800">Daftar Berita & Kegiatan</h2>
        <a href="{{ route('admin.berita.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded text-center">
            + Tambah Konten
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Filter tipe --}}
    <div class="flex gap-2 mb-6">
        <a href="{{ route('admin.berita.index') }}"
           class="text-sm font-semibold px-4 py-1.5 rounded-full {{ request('tipe') ? 'bg-gray-100 text-gray-600' : 'bg-emerald-600 text-white' }}">
            Semua
        </a>
        <a href="{{ route('admin.berita.index', ['tipe' => 'kegiatan']) }}"
           class="text-sm font-semibold px-4 py-1.5 rounded-full {{ request('tipe') === 'kegiatan' ? 'bg-emerald-600 text-white' : 'bg-gray-100 text-gray-600' }}">
            Kegiatan
        </a>
        <a href="{{ route('admin.berita.index', ['tipe' => 'berita']) }}"
           class="text-sm font-semibold px-4 py-1.5 rounded-full {{ request('tipe') === 'berita' ? 'bg-emerald-600 text-white' : 'bg-gray-100 text-gray-600' }}">
            Berita
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-4 border-b">Gambar</th>
                    <th class="py-3 px-4 border-b">Judul</th>
                    <th class="py-3 px-4 border-b text-center">Tipe</th>
                    <th class="py-3 px-4 border-b">Kategori</th>
                    <th class="py-3 px-4 border-b">Tanggal</th>
                    <th class="py-3 px-4 border-b text-center">Status</th>
                    <th class="py-3 px-4 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @forelse($items as $item)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="py-3 px-4">
                        @if($item->url_gambar)
                            <img src="{{ asset('storage/' . $item->url_gambar) }}" class="h-16 w-24 object-cover rounded shadow">
                        @else
                            <span class="text-gray-400 text-xs">Tidak ada gambar</span>
                        @endif
                    </td>
                    <td class="py-3 px-4">
                        <div class="font-bold text-gray-800">{{ $item->judul_id }}</div>
                        <div class="text-xs text-gray-500">{{ $item->judul_en }}</div>
                    </td>
                    <td class="py-3 px-4 text-center">
                        @if($item->tipe === 'kegiatan')
                            <span class="bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-full">Kegiatan</span>
                        @else
                            <span class="bg-purple-100 text-purple-700 text-xs font-bold px-3 py-1 rounded-full">Berita</span>
                        @endif
                    </td>
                    <td class="py-3 px-4">
                        <span class="bg-gray-200 text-gray-700 py-1 px-3 rounded-full text-xs">{{ $item->kategori_id ?? '-' }}</span>
                    </td>
                    <td class="py-3 px-4 text-xs">
                        {{ $item->tanggal_kegiatan?->format('d M Y') ?? '-' }}
                    </td>
                    <td class="py-3 px-4 text-center">
                        @if($item->status)
                            <span class="inline-flex items-center gap-1 bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1 rounded-full">Terbit</span>
                        @else
                            <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-500 text-xs font-medium px-3 py-1 rounded-full">Draft</span>
                        @endif
                    </td>
                    <td class="py-3 px-4 text-center">
                        <div class="flex items-center justify-center gap-3">
                            <a href="{{ route('admin.berita.edit', $item->id) }}" class="text-blue-500 hover:text-blue-700 font-medium">Edit</a>
                            <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus konten ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 font-medium">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="py-6 px-4 text-center text-gray-500">Belum ada data.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $items->links() }}
    </div>
</div>
@endsection
