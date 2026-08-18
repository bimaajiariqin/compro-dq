@extends('Admin.layouts.app')

@section('title', 'Tambah Mitra Kebaikan')
@section('breadcrumb', 'Konten / Mitra Kebaikan')
@section('page-title', 'Tambah Mitra Kebaikan')

@section('content')
<div class="max-w-lg">
    <div class="rounded-2xl border border-black/5 bg-white p-6">
        <form method="POST" action="{{ route('admin.mitra.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label for="nama_mitra" class="block text-sm font-medium text-ink/70 mb-1.5">Nama Mitra (opsional)</label>
                <input id="nama_mitra" name="nama_mitra" type="text" value="{{ old('nama_mitra') }}" autofocus
                       placeholder="Nama mitra"
                       class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm placeholder:text-ink/30
                              focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                @error('nama_mitra') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="link" class="block text-sm font-medium text-ink/70 mb-1.5">Link (opsional)</label>
                <input id="link" name="link" type="url" value="{{ old('link') }}"
                       placeholder="https://..."
                       class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm placeholder:text-ink/30
                              focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                @error('link') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                <p class="mt-1.5 text-xs text-ink/40">Kosongkan jika mitra ini tidak memiliki link tujuan.</p>
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label for="urutan" class="block text-sm font-medium text-ink/70 mb-1.5">Urutan</label>
                    <input id="urutan" name="urutan" type="number" value="{{ old('urutan', 0) }}" min="0"
                           class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                    @error('urutan') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="logo" class="block text-sm font-medium text-ink/70 mb-1.5">Logo Mitra</label>
                <input id="logo" name="logo" type="file" accept="image/png,image/jpeg,image/webp" required
                       class="w-full text-sm text-ink/60
                              file:mr-4 file:rounded-lg file:border-0 file:bg-emerald-700/10 file:px-4 file:py-2
                              file:text-sm file:font-medium file:text-emerald-800 hover:file:bg-emerald-700/20">
                @error('logo') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                <p class="mt-1.5 text-xs text-ink/40">Gambar (JPG, PNG, WEBP). Maksimal 2MB.</p>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="rounded-xl bg-emerald-800 hover:bg-emerald-900 transition text-white text-sm font-medium px-5 py-2.5">
                    Simpan
                </button>
                <a href="{{ route('admin.mitra.index') }}" class="text-sm text-ink/50 hover:text-ink">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection