@extends('layouts.admin')
@section('title', 'Tambah Berita & Kegiatan')
@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-xl font-bold text-gray-800 mb-6">Tambah Konten Baru</h2>

    <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.berita.form')
    </form>
</div>
@endsection
