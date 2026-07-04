@extends('layouts.admin')
@section('title', 'Edit Berita & Kegiatan')
@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-xl font-bold text-gray-800 mb-6">Edit Konten</h2>

    <form action="{{ route('admin.berita.update', $item) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.berita.form')
    </form>
</div>
@endsection
