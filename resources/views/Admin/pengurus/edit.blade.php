@extends('Admin.layouts.app')

@section('title', 'Edit Pengurus')
@section('breadcrumb', 'Konten / Profil Kepengurusan')
@section('page-title', 'Edit Pengurus')

@section('content')
<div class="max-w-lg">
    <div class="rounded-2xl border border-black/5 bg-white p-6">
        <form method="POST" action="{{ route('admin.pengurus.update', $pengurus) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="kelompok" class="block text-sm font-medium text-ink/70 mb-1.5">Kelompok</label>
                <select id="kelompok" name="kelompok"
                        class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                               focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                    @foreach ($kelompokOptions as $opsi)
                        <option value="{{ $opsi }}" {{ old('kelompok', $pengurus->kelompok) === $opsi ? 'selected' : '' }}>{{ $opsi }}</option>
                    @endforeach
                </select>
                @error('kelompok') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="nama" class="block text-sm font-medium text-ink/70 mb-1.5">Nama (opsional)</label>
                <input id="nama" name="nama" type="text" value="{{ old('nama', $pengurus->nama) }}"
                       class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                              focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                @error('nama') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="jabatan" class="block text-sm font-medium text-ink/70 mb-1.5">Jabatan (opsional)</label>
                <input id="jabatan" name="jabatan" type="text" value="{{ old('jabatan', $pengurus->jabatan) }}"
                       class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                              focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                @error('jabatan') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-2">
                <input id="is_ketua" name="is_ketua" type="checkbox" value="1" {{ old('is_ketua', $pengurus->is_ketua) ? 'checked' : '' }}
                       class="rounded border-black/20 text-emerald-700 focus:ring-emerald-700/30">
                <label for="is_ketua" class="text-sm text-ink/70">Tandai sebagai ketua/pimpinan kelompok ini</label>
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label for="urutan_grup" class="block text-sm font-medium text-ink/70 mb-1.5">Urutan Kelompok</label>
                    <input id="urutan_grup" name="urutan_grup" type="number" value="{{ old('urutan_grup', $pengurus->urutan_grup) }}" min="0"
                           class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                    @error('urutan_grup') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="urutan" class="block text-sm font-medium text-ink/70 mb-1.5">Urutan dalam Kelompok</label>
                    <input id="urutan" name="urutan" type="number" value="{{ old('urutan', $pengurus->urutan) }}" min="0"
                           class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                    @error('urutan') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                @if ($pengurus->foto)
                    <label class="block text-sm font-medium text-ink/70 mb-1.5">Foto Saat Ini</label>
                    <img src="{{ asset('storage/' . $pengurus->foto) }}" alt="{{ $pengurus->nama ?? 'Foto pengurus' }}"
                         class="h-20 w-20 object-cover rounded-full border border-black/10 mb-3">
                @endif

                <label for="foto" class="block text-sm font-medium text-ink/70 mb-1.5">
                    {{ $pengurus->foto ? 'Ganti Foto (opsional)' : 'Foto (opsional)' }}
                </label>
                <input id="foto" name="foto" type="file" accept="image/png,image/jpeg,image/webp"
                       class="w-full text-sm text-ink/60
                              file:mr-4 file:rounded-lg file:border-0 file:bg-emerald-700/10 file:px-4 file:py-2
                              file:text-sm file:font-medium file:text-emerald-800 hover:file:bg-emerald-700/20">
                @error('foto') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                <p class="mt-1.5 text-xs text-ink/40">Kosongkan jika tidak ingin mengganti foto. Maksimal 2MB.</p>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="rounded-xl bg-emerald-800 hover:bg-emerald-900 transition text-white text-sm font-medium px-5 py-2.5">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.pengurus.index') }}" class="text-sm text-ink/50 hover:text-ink">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection