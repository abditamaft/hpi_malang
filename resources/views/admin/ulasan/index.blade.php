@extends('layouts.admin')

@section('title', 'Manajemen Ulasan')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-gray-800">Daftar Ulasan Masuk</h2>
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
                    <th class="py-3 px-4 font-semibold">Nama & Asal</th>
                    <th class="py-3 px-4 font-semibold">Komentar (ID)</th>
                    <th class="py-3 px-4 font-semibold">Status</th>
                    <th class="py-3 px-4 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @foreach($ulasan as $item)
                <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                    <td class="py-3 px-4">
                        <p class="font-bold text-gray-800">{{ $item->nama_lengkap }}</p>
                        <p class="text-xs text-gray-500">{{ $item->asal_daerah }}</p>
                    </td>
                    <td class="py-3 px-4">
                        <p class="text-gray-600 line-clamp-2">{{ $item->komentar_id }}</p>
                        @if(!$item->komentar_en)
                            <span class="text-[10px] text-red-500 font-semibold bg-red-50 px-2 py-0.5 rounded">Belum diterjemahkan</span>
                        @endif
                    </td>
                    <td class="py-3 px-4">
                        @if($item->status == 'Pending')
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">Pending</span>
                        @elseif($item->status == 'Approved')
                            <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-bold">Approved</span>
                        @else
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">Rejected</span>
                        @endif
                    </td>
                    <td class="py-3 px-4 flex justify-end gap-2">
                        <a href="{{ route('admin.ulasan.edit', $item->id) }}" class="bg-emerald-500 hover:bg-emerald-600 text-white px-3 py-1.5 rounded-lg transition text-xs font-bold">Kurasi</a>
                        <form action="{{ route('admin.ulasan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus ulasan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg transition text-xs font-bold">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                
                @if($ulasan->isEmpty())
                <tr>
                    <td colspan="4" class="py-8 text-center text-gray-500">Belum ada ulasan masuk.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection