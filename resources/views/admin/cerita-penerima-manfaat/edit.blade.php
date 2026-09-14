@extends('admin.layouts.app')

@section('title', 'Edit Cerita Penerima Manfaat')
@section('breadcrumb', 'Admin')
@section('page-title', 'Edit Cerita Penerima Manfaat')

@section('content')
<div class="space-y-6">
    <div>
        <h2 class="font-display text-2xl text-ink">Edit Cerita Penerima Manfaat</h2>
        <p class="text-sm text-ink/50 mt-1">{{ $item->nama }}</p>
    </div>

    <form action="{{ route('admin.cerita-penerima-manfaat.update', $item) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.cerita-penerima-manfaat._form', ['kategoriOptions' => $kategoriOptions, 'item' => $item])
    </form>
</div>
@endsection