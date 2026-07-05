@extends('layouts.admin')

@section('title', 'Manajemen Direktori Pramuwisata')
@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 mb-6">
        <h2 class="text-xl font-bold text-gray-800">Direktori Pramuwisata</h2>
        <a href="{{ route('admin.direktori.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded text-center">
            + Tambah Pramuwisata
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" class="mb-6">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama pemandu..."
                class="w-full sm:w-80 border-gray-300 rounded-lg shadow-sm text-sm focus:ring-emerald-500 focus:border-emerald-500">
    </form>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-4 border-b">Foto</th>
                    <th class="py-3 px-4 border-b">Nama & Wilayah</th>
                    <th class="py-3 px-4 border-b">Bahasa</th>
                    <th class="py-3 px-4 border-b">Spesialisasi</th>
                    <th class="py-3 px-4 border-b text-center">Sertifikasi</th>
                    <th class="py-3 px-4 border-b text-center">Status</th>
                    <th class="py-3 px-4 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @forelse($items as $item)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="py-3 px-4">
                        @if($item->foto_profil)
                            <img src="{{ asset('storage/' . $item->foto_profil) }}" class="h-14 w-14 object-cover rounded-full shadow">
                        @else
                            <div class="h-14 w-14 rounded-full bg-gray-100 flex items-center justify-center text-gray-400 text-xs">N/A</div>
                        @endif
                    </td>
                    <td class="py-3 px-4">
                        <div class="font-bold text-gray-800">{{ $item->nama_lengkap }}</div>
                        <div class="text-xs text-gray-500">{{ $item->wilayah_operasi_label ?: '-' }}</div>
                    </td>
                    <td class="py-3 px-4">
                        <div class="flex flex-wrap gap-1">
                            @foreach($item->bahasa_label as $label)
                                <span class="bg-gray-100 text-gray-600 text-[10px] font-bold px-2 py-0.5 rounded">{{ $label }}</span>
                            @endforeach
                        </div>
                    </td>
                    <td class="py-3 px-4 text-xs">
                        {{ implode(', ', $item->spesialisasi_label) ?: '-' }}
                    </td>
                    <td class="py-3 px-4 text-center">
                        @if($item->is_tersertifikasi)
                            <span class="bg-amber-100 text-amber-700 text-xs font-bold px-3 py-1 rounded-full">Ya</span>
                        @else
                            <span class="bg-gray-100 text-gray-500 text-xs font-medium px-3 py-1 rounded-full">Belum</span>
                        @endif
                    </td>
                    <td class="py-3 px-4 text-center">
                        @if($item->status)
                            <span class="bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1 rounded-full">Aktif</span>
                        @else
                            <span class="bg-gray-100 text-gray-500 text-xs font-medium px-3 py-1 rounded-full">Nonaktif</span>
                        @endif
                    </td>
                    <td class="py-3 px-4 text-center">
                        <div class="flex items-center justify-center gap-3">
                            <a href="{{ route('admin.direktori.edit', $item->id) }}" class="text-blue-500 hover:text-blue-700 font-medium">Edit</a>
                            <form action="{{ route('admin.direktori.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data pramuwisata ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 font-medium">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="py-6 px-4 text-center text-gray-500">Belum ada data pramuwisata.</td>
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
