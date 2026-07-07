@extends('layouts.admin')

@section('title', 'Struktur Organisasi')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-xl font-bold text-gray-800">Manajemen Struktur Organisasi</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola Dewan Penasihat, Kode Etik, dan Pengurus Harian.</p>
        </div>
        <a href="{{ route('admin.struktur-organisasi.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2.5 px-5 rounded-xl transition flex items-center gap-2 text-sm w-full md:w-auto justify-center">
            + Tambah Pengurus
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
                    <th class="py-3 px-4 font-semibold w-16">Foto</th>
                    <th class="py-3 px-4 font-semibold w-40">Kategori</th>
                    <th class="py-3 px-4 font-semibold">Nama Pengurus</th>
                    <th class="py-3 px-4 font-semibold">Jabatan</th>
                    <th class="py-3 px-4 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @foreach($struktur as $item)
                <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                    <!-- Thumbnail Foto -->
                    <td class="py-3 px-4">
                        @if($item->foto)
                            <img src="{{ asset('storage/' . $item->foto) }}" class="w-10 h-10 rounded-full object-cover border border-gray-200 shadow-sm">
                        @else
                            <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                        @endif
                    </td>
                    <!-- Kategori -->
                    <td class="py-3 px-4">
                        @if($item->kategori_pengurus == 'Pengurus Harian')
                            <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">{{ $item->kategori_pengurus }}</span>
                        @elseif($item->kategori_pengurus == 'Dewan Penasihat')
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">{{ $item->kategori_pengurus }}</span>
                        @else
                            <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">{{ $item->kategori_pengurus }}</span>
                        @endif
                    </td>
                    <td class="py-3 px-4 font-bold text-gray-800">
                        {{ $item->nama }}
                    </td>
                    <td class="py-3 px-4">
                        @if($item->jabatan_id != '-')
                            <p class="font-bold text-emerald-600">{{ $item->jabatan_id }}</p>
                        @else
                            <p class="text-gray-400 italic">-</p>
                        @endif
                    </td>
                    <td class="py-3 px-4 flex justify-end gap-2 items-center">
                        <a href="{{ route('admin.struktur-organisasi.edit', $item->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-lg transition text-xs font-bold">Edit</a>
                        <form action="{{ route('admin.struktur-organisasi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg transition text-xs font-bold">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        @if($struktur->isEmpty())
        <div class="text-center py-10 bg-gray-50 rounded-xl border-b border-dashed border-gray-200">
            <p class="text-gray-500 text-sm">Belum ada data Struktur Organisasi.</p>
        </div>
        @endif
    </div>
</div>
@endsection