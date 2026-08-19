@extends('Admin.layouts.app')

@section('title', 'Edit Riwayat')
@section('breadcrumb', 'Konten / Awal Perjalanan Kami')
@section('page-title', 'Edit Riwayat')

@section('content')
<div class="max-w-lg">
    <div class="rounded-2xl border border-black/5 bg-white p-6">
        <form method="POST" action="{{ route('admin.riwayat.update', $riwayat) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="tanggal" class="block text-sm font-medium text-ink/70 mb-1.5">Tanggal</label>
                <input id="tanggal" name="tanggal" type="text" value="{{ old('tanggal', $riwayat->tanggal) }}" autofocus
                       class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                              focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                @error('tanggal') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="judul" class="block text-sm font-medium text-ink/70 mb-1.5">Judul</label>
                <input id="judul" name="judul" type="text" value="{{ old('judul', $riwayat->judul) }}"
                       class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                              focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                @error('judul') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-medium text-ink/70 mb-1.5">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="4"
                          class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                                 focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">{{ old('deskripsi', $riwayat->deskripsi) }}</textarea>
                @error('deskripsi') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label for="urutan" class="block text-sm font-medium text-ink/70 mb-1.5">Urutan</label>
                    <input id="urutan" name="urutan" type="number" value="{{ old('urutan', $riwayat->urutan) }}" min="0"
                           class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                    @error('urutan') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                @if ($riwayat->logo)
                    <label class="block text-sm font-medium text-ink/70 mb-1.5">Logo Saat Ini</label>
                    <img src="{{ asset('storage/' . $riwayat->logo) }}" alt="{{ $riwayat->judul }}"
                         class="h-16 w-auto object-contain rounded-lg border border-black/10 p-2 mb-3">
                @endif

                <label for="logo" class="block text-sm font-medium text-ink/70 mb-1.5">
                    {{ $riwayat->logo ? 'Ganti Logo (opsional)' : 'Logo (opsional)' }}
                </label>
                <input id="logo" name="logo" type="file" accept="image/png,image/jpeg,image/webp"
                       class="w-full text-sm text-ink/60
                              file:mr-4 file:rounded-lg file:border-0 file:bg-emerald-700/10 file:px-4 file:py-2
                              file:text-sm file:font-medium file:text-emerald-800 hover:file:bg-emerald-700/20">
                @error('logo') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                <p class="mt-1.5 text-xs text-ink/40">Kosongkan jika tidak ingin mengganti logo. Maksimal 2MB.</p>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="rounded-xl bg-emerald-800 hover:bg-emerald-900 transition text-white text-sm font-medium px-5 py-2.5">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.riwayat.index') }}" class="text-sm text-ink/50 hover:text-ink">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection