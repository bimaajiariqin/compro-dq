@extends('Admin.layouts.app')

@section('title', 'Edit Iklan')
@section('breadcrumb', 'Konten / Iklan')
@section('page-title', 'Edit Iklan')

@section('content')
<div class="max-w-lg">
    <div class="rounded-2xl border border-black/5 bg-white p-6">
        <form method="POST" action="{{ route('admin.iklan.update', $iklan) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                @if ($iklan->thumbnail)
                    <label class="block text-sm font-medium text-ink/70 mb-1.5">Thumbnail Saat Ini</label>
                    <img src="{{ asset('storage/' . $iklan->thumbnail) }}" alt="Iklan #{{ $iklan->id }}"
                         class="h-20 w-32 object-cover rounded-lg border border-black/10 mb-3">
                @endif

                <label for="thumbnail" class="block text-sm font-medium text-ink/70 mb-1.5">
                    {{ $iklan->thumbnail ? 'Ganti Thumbnail (opsional)' : 'Thumbnail' }}
                </label>
                <input id="thumbnail" name="thumbnail" type="file" accept="image/png,image/jpeg,image/webp"
                       class="w-full text-sm text-ink/60
                              file:mr-4 file:rounded-lg file:border-0 file:bg-emerald-700/10 file:px-4 file:py-2
                              file:text-sm file:font-medium file:text-emerald-800 hover:file:bg-emerald-700/20">
                @error('thumbnail') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                <p class="mt-1.5 text-xs text-ink/40">Kosongkan jika tidak ingin mengganti thumbnail. Maksimal 2MB.</p>
            </div>

            <div>
                <label for="link" class="block text-sm font-medium text-ink/70 mb-1.5">Link Tujuan</label>
                <input id="link" name="link" type="url" value="{{ old('link', $iklan->link) }}" required
                       class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                              focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                @error('link') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="rounded-xl bg-emerald-800 hover:bg-emerald-900 transition text-white text-sm font-medium px-5 py-2.5">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.iklan.index') }}" class="text-sm text-ink/50 hover:text-ink">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection