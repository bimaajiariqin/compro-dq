@extends('admin.layouts.app')

@section('title', 'Tambah FAQ')
@section('breadcrumb', 'Konten / FAQ Program')
@section('page-title', 'Tambah FAQ')

@section('content')
<div class="max-w-2xl">
    <div class="rounded-2xl border border-black/5 bg-white p-6">
        <form method="POST" action="{{ route('admin.faq.store') }}" class="space-y-5">
            @csrf
            @include('admin.faq._form')

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="rounded-xl bg-emerald-800 hover:bg-emerald-900 transition text-white text-sm font-medium px-5 py-2.5">
                    Simpan FAQ
                </button>
                <a href="{{ route('admin.faq.index') }}" class="text-sm text-ink/50 hover:text-ink">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection