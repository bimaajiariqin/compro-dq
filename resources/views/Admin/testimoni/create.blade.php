@extends('Admin.layouts.app')

@section('title', 'Tambah Testimoni')
@section('breadcrumb', 'Konten / Testimoni')
@section('page-title', 'Tambah Testimoni')

@section('content')
<div class="max-w-xl">
    <div class="rounded-2xl border border-black/5 bg-white p-6">
        <form method="POST" action="{{ route('testimoni.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label for="nama" class="block text-sm font-medium text-ink/70 mb-1.5">Nama</label>
                <input id="nama" name="nama" type="text" value="{{ old('nama') }}" required autofocus
                       placeholder="Nama lengkap"
                       class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm placeholder:text-ink/30
                              focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                @error('nama') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="jabatan" class="block text-sm font-medium text-ink/70 mb-1.5">Jabatan / Keterangan</label>
                <input id="jabatan" name="jabatan" type="text" value="{{ old('jabatan') }}" required
                       placeholder="Mis. Donatur, Mitra Program, dsb."
                       class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm placeholder:text-ink/30
                              focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                @error('jabatan') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="isi_testimoni" class="block text-sm font-medium text-ink/70 mb-1.5">Isi Testimoni</label>
                <textarea id="isi_testimoni" name="isi_testimoni" rows="5" required
                          placeholder="Tuliskan testimoni di sini..."
                          class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm placeholder:text-ink/30
                                 focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">{{ old('isi_testimoni') }}</textarea>
                @error('isi_testimoni') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="foto_profil" class="block text-sm font-medium text-ink/70 mb-1.5">Foto Profil</label>
                <input id="foto_profil" name="foto_profil" type="file" accept="image/png,image/jpeg,image/webp" required
                       class="w-full text-sm text-ink/60
                              file:mr-4 file:rounded-lg file:border-0 file:bg-emerald-700/10 file:px-4 file:py-2
                              file:text-sm file:font-medium file:text-emerald-800 hover:file:bg-emerald-700/20">
                @error('foto_profil') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                <p class="mt-1.5 text-xs text-ink/40">JPG, PNG, atau WEBP. Maksimal 2MB.</p>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="rounded-xl bg-emerald-800 hover:bg-emerald-900 transition text-white text-sm font-medium px-5 py-2.5">
                    Simpan
                </button>
                <a href="{{ route('testimoni.index') }}" class="text-sm text-ink/50 hover:text-ink">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection