@extends('layouts.admin')

@section('title', 'Edit Pramuwisata')
@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-xl font-bold text-gray-800 mb-6">Edit Data Pramuwisata</h2>

    <form action="{{ route('admin.direktori.update', $item) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.pramuwisata.form')
    </form>
</div>
@endsection
