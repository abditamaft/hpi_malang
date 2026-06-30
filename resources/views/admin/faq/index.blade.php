@extends('layouts.admin')

@section('title', 'Manajemen FAQ')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-gray-800">Daftar Pertanyaan Umum (FAQ)</h2>
        <a href="{{ route('admin.faq.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded-xl transition flex items-center gap-2">
            + Tambah FAQ
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
                    <th class="py-3 px-4 font-semibold w-1/3">Pertanyaan (ID/EN)</th>
                    <th class="py-3 px-4 font-semibold w-1/2">Jawaban (ID)</th>
                    <th class="py-3 px-4 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @foreach($faqs as $item)
                <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                    <td class="py-3 px-4">
                        <p class="font-bold text-gray-800 mb-1">{{ $item->pertanyaan_id }}</p>
                        <p class="text-xs text-gray-500 italic">{{ $item->pertanyaan_en }}</p>
                    </td>
                    <td class="py-3 px-4 text-gray-600 line-clamp-2">
                        {{ $item->jawaban_id }}
                    </td>
                    <td class="py-3 px-4 flex justify-end gap-2">
                        <a href="{{ route('admin.faq.edit', $item->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-lg transition text-xs font-bold">Edit</a>
                        <form action="{{ route('admin.faq.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus FAQ ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg transition text-xs font-bold">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection