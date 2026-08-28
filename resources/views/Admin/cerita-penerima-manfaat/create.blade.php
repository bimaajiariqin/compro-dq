@extends('Admin.layouts.app')

@section('title', 'Tambah Cerita Penerima Manfaat')
@section('breadcrumb', 'Admin')
@section('page-title', 'Tambah Cerita Penerima Manfaat')

@section('content')
<div class="space-y-6">
    <div>
        <h2 class="font-display text-2xl text-ink">Tambah Cerita Penerima Manfaat</h2>
        <p class="text-sm text-ink/50 mt-1">Isi detail kisah penerima manfaat program.</p>
    </div>

    <form action="{{ route('admin.cerita-penerima-manfaat.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.cerita-penerima-manfaat._form', ['kategoriOptions' => $kategoriOptions])
    </form>
</div>
@endsection