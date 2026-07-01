@extends('layouts.admin')

@section('title', 'Manajemen Visi & Misi')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-xl font-bold text-gray-800">Visi & Misi Organisasi</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola Visi utama dan daftar Misi HPI Kabupaten Malang.</p>
        </div>
        <a href="{{ route('admin.visi-misi.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2.5 px-5 rounded-xl transition flex items-center gap-2 text-sm w-full md:w-auto justify-center">
            + Tambah Data
        </a>
    </div>

    @if(session('success'))
    <div class="mb-6 bg-emerald-50 text-emerald-700 px-4 py-3 rounded-xl border border-emerald-200 text-sm font-medium">
        {{ session('success') }}
    </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-sm border-b border-gray-200">
                    <th class="py-3 px-4 font-semibold w-24 text-center">Tipe</th>
                    <th class="py-3 px-4 font-semibold w-20 text-center">Urutan</th>
                    <th class="py-3 px-4 font-semibold">Judul & Deskripsi (ID)</th>
                    <th class="py-3 px-4 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @foreach($visimisi as $item)
                <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                    <td class="py-3 px-4 text-center">
                        @if($item->tipe == 'Visi')
                            <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">Visi</span>
                        @else
                            <span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">Misi</span>
                        @endif
                    </td>
                    <td class="py-3 px-4 text-center font-bold text-gray-500">
                        {{ $item->tipe == 'Misi' ? $item->urutan : '-' }}
                    </td>
                    <td class="py-3 px-4">
                        @if($item->judul_id)
                            <p class="font-bold text-gray-800 mb-1">{{ $item->judul_id }}</p>
                        @endif
                        <p class="text-gray-600 line-clamp-2">{{ $item->deskripsi_id }}</p>
                    </td>
                    <td class="py-3 px-4 flex justify-end gap-2">
                        <a href="{{ route('admin.visi-misi.edit', $item->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-lg transition text-xs font-bold">Edit</a>
                        <form action="{{ route('admin.visi-misi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg transition text-xs font-bold">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        @if($visimisi->isEmpty())
        <div class="text-center py-10 bg-gray-50 rounded-xl border-b border-dashed border-gray-200">
            <p class="text-gray-500 text-sm">Belum ada data Visi / Misi.</p>
        </div>
        @endif
    </div>
</div>
@endsection