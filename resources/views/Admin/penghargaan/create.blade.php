@extends('Admin.layouts.app')

@section('title', 'Tambah Penghargaan')
@section('breadcrumb', 'Konten / Penghargaan')
@section('page-title', 'Tambah Penghargaan')

@section('content')
<div class="max-w-lg">
    <div class="rounded-2xl border border-black/5 bg-white p-6">
        <form method="POST" action="{{ route('penghargaan.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label for="judul" class="block text-sm font-medium text-ink/70 mb-1.5">Judul</label>
                <input id="judul" name="judul" type="text" value="{{ old('judul') }}" required autofocus
                       placeholder="Judul penghargaan"
                       class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm placeholder:text-ink/30
                              focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                @error('judul') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label for="tanggal_terbit" class="block text-sm font-medium text-ink/70 mb-1.5">Tanggal Terbit</label>
                    <input id="tanggal_terbit" name="tanggal_terbit" type="date" value="{{ old('tanggal_terbit') }}" required
                           class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                    @error('tanggal_terbit') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="tahun" class="block text-sm font-medium text-ink/70 mb-1.5">Tahun</label>
                    <input id="tahun" name="tahun" type="number" value="{{ old('tahun') }}" required
                           placeholder="{{ date('Y') }}" min="2000" max="{{ date('Y') + 1 }}"
                           class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm placeholder:text-ink/30
                                  focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                    @error('tahun') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="dokumen" class="block text-sm font-medium text-ink/70 mb-1.5">Dokumen</label>
                <input id="dokumen" name="dokumen" type="file" accept="image/png,image/jpeg,image/webp,application/pdf" required
                       class="w-full text-sm text-ink/60
                              file:mr-4 file:rounded-lg file:border-0 file:bg-emerald-700/10 file:px-4 file:py-2
                              file:text-sm file:font-medium file:text-emerald-800 hover:file:bg-emerald-700/20">
                @error('dokumen') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                <p class="mt-1.5 text-xs text-ink/40">Gambar (JPG, PNG, WEBP) atau PDF. Maksimal 10MB.</p>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="rounded-xl bg-emerald-800 hover:bg-emerald-900 transition text-white text-sm font-medium px-5 py-2.5">
                    Simpan
                </button>
                <a href="{{ route('penghargaan.index') }}" class="text-sm text-ink/50 hover:text-ink">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection