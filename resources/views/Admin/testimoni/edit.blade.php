@extends('Admin.layouts.app')

@section('title', 'Edit Testimoni')
@section('breadcrumb', 'Konten / Testimoni')
@section('page-title', 'Edit Testimoni')

@section('content')
<div class="max-w-xl">
    <div class="rounded-2xl border border-black/5 bg-white p-6">
        <form method="POST" action="{{ route('testimoni.update', $testimoni) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="nama" class="block text-sm font-medium text-ink/70 mb-1.5">Nama</label>
                <input id="nama" name="nama" type="text" value="{{ old('nama', $testimoni->nama) }}" required autofocus
                       class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                              focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                @error('nama') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="jabatan" class="block text-sm font-medium text-ink/70 mb-1.5">Jabatan / Keterangan</label>
                <input id="jabatan" name="jabatan" type="text" value="{{ old('jabatan', $testimoni->jabatan) }}" required
                       class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                              focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                @error('jabatan') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="isi_testimoni" class="block text-sm font-medium text-ink/70 mb-1.5">Isi Testimoni</label>
                <textarea id="isi_testimoni" name="isi_testimoni" rows="5" required
                          class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                                 focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">{{ old('isi_testimoni', $testimoni->isi_testimoni) }}</textarea>
                @error('isi_testimoni') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-ink/70 mb-1.5">Foto Profil Saat Ini</label>
                <img src="{{ asset('storage/' . $testimoni->foto_profil) }}" alt="{{ $testimoni->nama }}"
                     class="h-16 w-16 rounded-full object-cover border border-black/10 mb-3">

                <label for="foto_profil" class="block text-sm font-medium text-ink/70 mb-1.5">Ganti Foto (opsional)</label>
                <input id="foto_profil" name="foto_profil" type="file" accept="image/png,image/jpeg,image/webp"
                       class="w-full text-sm text-ink/60
                              file:mr-4 file:rounded-lg file:border-0 file:bg-emerald-700/10 file:px-4 file:py-2
                              file:text-sm file:font-medium file:text-emerald-800 hover:file:bg-emerald-700/20">
                @error('foto_profil') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                <p class="mt-1.5 text-xs text-ink/40">Kosongkan jika tidak ingin mengganti foto. JPG, PNG, atau WEBP, maksimal 2MB.</p>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="rounded-xl bg-emerald-800 hover:bg-emerald-900 transition text-white text-sm font-medium px-5 py-2.5">
                    Simpan Perubahan
                </button>
                <a href="{{ route('testimoni.index') }}" class="text-sm text-ink/50 hover:text-ink">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection