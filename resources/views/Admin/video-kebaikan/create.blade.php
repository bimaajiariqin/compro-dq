@extends('Admin.layouts.app')

@section('title', 'Tambah Video Kebaikan')
@section('breadcrumb', 'Konten / Video Kebaikan')
@section('page-title', 'Tambah Video Kebaikan')

@section('content')
<div class="max-w-lg">
    <div class="rounded-2xl border border-black/5 bg-white p-6">
        <form method="POST" action="{{ route('admin.videokebaikan.store') }}" class="space-y-5">
            @csrf

            <div>
                <label for="link" class="block text-sm font-medium text-ink/70 mb-1.5">Link YouTube</label>
                <input id="link" name="link" type="url" value="{{ old('link') }}" required
                       placeholder="https://www.youtube.com/watch?v=..."
                       class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm placeholder:text-ink/30
                              focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                @error('link') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                <p class="mt-1.5 text-xs text-ink/40">Judul, nama channel, dan thumbnail akan diambil otomatis dari link ini.</p>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="rounded-xl bg-emerald-800 hover:bg-emerald-900 transition text-white text-sm font-medium px-5 py-2.5">
                    Simpan
                </button>
                <a href="{{ route('admin.videokebaikan.index') }}" class="text-sm text-ink/50 hover:text-ink">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection