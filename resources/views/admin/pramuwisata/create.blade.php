@extends('layouts.admin')

@section('title', 'Tambah Pramuwisata')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-xl font-bold text-gray-800 mb-6">Tambah Pramuwisata Baru</h2>

    <form action="{{ route('admin.direktori.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.pramuwisata.form')
    </form>
</div>
@endsection
