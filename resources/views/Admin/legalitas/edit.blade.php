@extends('Admin.layouts.app')

@section('title', 'Edit Legalitas')
@section('breadcrumb', 'Konten / Legalitas Lembaga')
@section('page-title', 'Edit Legalitas')

@section('content')
<div class="max-w-lg">
    <div class="rounded-2xl border border-black/5 bg-white p-6">
        <form method="POST" action="{{ route('admin.legalitas.update', $legalitas) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="nama" class="block text-sm font-medium text-ink/70 mb-1.5">Nama</label>
                <input id="nama" name="nama" type="text" value="{{ old('nama', $legalitas->nama) }}" autofocus
                       class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                              focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                @error('nama') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="label" class="block text-sm font-medium text-ink/70 mb-1.5">Label</label>
                <input id="label" name="label" type="text" value="{{ old('label', $legalitas->label) }}"
                       class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                              focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                @error('label') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="link" class="block text-sm font-medium text-ink/70 mb-1.5">Link (opsional)</label>
                <input id="link" name="link" type="url" value="{{ old('link', $legalitas->link) }}"
                       class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                              focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                @error('link') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label for="urutan" class="block text-sm font-medium text-ink/70 mb-1.5">Urutan</label>
                    <input id="urutan" name="urutan" type="number" value="{{ old('urutan', $legalitas->urutan) }}" min="0"
                           class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                    @error('urutan') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                @if ($legalitas->icon)
                    <label class="block text-sm font-medium text-ink/70 mb-1.5">Logo Saat Ini</label>
                    <img src="{{ asset('storage/' . $legalitas->icon) }}" alt="{{ $legalitas->nama }}"
                         class="h-16 w-auto object-contain rounded-lg border border-black/10 p-2 mb-3">
                @endif

                <label for="icon" class="block text-sm font-medium text-ink/70 mb-1.5">
                    {{ $legalitas->icon ? 'Ganti Logo (opsional)' : 'Logo/Icon' }}
                </label>
                <input id="icon" name="icon" type="file" accept="image/png,image/jpeg,image/webp,image/svg+xml"
                       class="w-full text-sm text-ink/60
                              file:mr-4 file:rounded-lg file:border-0 file:bg-emerald-700/10 file:px-4 file:py-2
                              file:text-sm file:font-medium file:text-emerald-800 hover:file:bg-emerald-700/20">
                @error('icon') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                <p class="mt-1.5 text-xs text-ink/40">Kosongkan jika tidak ingin mengganti logo. Maksimal 2MB.</p>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="rounded-xl bg-emerald-800 hover:bg-emerald-900 transition text-white text-sm font-medium px-5 py-2.5">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.legalitas.index') }}" class="text-sm text-ink/50 hover:text-ink">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection