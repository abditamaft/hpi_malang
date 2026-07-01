@extends('layouts.admin')

@section('title', 'Mengapa Memilih HPI')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h2 class="text-xl font-bold text-gray-800">Daftar Keunggulan (Alasan Memilih HPI)</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola 4 kotak alasan yang tampil di Beranda utama.</p>
        </div>
        <a href="{{ route('admin.keunggulan.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2.5 px-5 rounded-xl transition flex items-center gap-2 text-sm w-full md:w-auto justify-center">
            + Tambah Keunggulan
        </a>
    </div>

    @if(session('success'))
    <div class="mb-6 bg-emerald-50 text-emerald-700 px-4 py-3 rounded-xl border border-emerald-200 text-sm font-medium">
        {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($keunggulan as $item)
        <div class="border border-gray-200 rounded-2xl p-6 hover:shadow-md transition bg-white flex flex-col h-full">
            <div class="text-3xl mb-4 text-emerald-500">{!! $item->ikon !!}</div>
            <h3 class="font-bold text-gray-800 text-lg mb-2">{{ $item->judul_id }}</h3>
            <p class="text-xs text-gray-500 mb-4 flex-1 line-clamp-3">{{ $item->deskripsi_id }}</p>
            
            <div class="flex items-center gap-2 pt-4 border-t border-gray-100 mt-auto">
                <a href="{{ route('admin.keunggulan.edit', $item->id) }}" class="flex-1 bg-blue-50 hover:bg-blue-100 text-blue-600 text-center py-2 rounded-lg text-xs font-bold transition">Edit</a>
                <form action="{{ route('admin.keunggulan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-red-50 hover:bg-red-100 text-red-600 text-center py-2 rounded-lg text-xs font-bold transition">Hapus</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    
    @if($keunggulan->isEmpty())
    <div class="text-center py-10 bg-gray-50 rounded-xl border border-dashed border-gray-200">
        <p class="text-gray-500 text-sm">Belum ada data keunggulan.</p>
    </div>
    @endif
</div>
@endsection