@extends('Admin.layouts.app')

@section('title', 'Edit Rekening')
@section('breadcrumb', 'Konten / Rekening Donasi')
@section('page-title', 'Edit Rekening')

@section('content')
<div class="max-w-lg">
    <div class="rounded-2xl border border-black/5 bg-white p-6">
        <form method="POST" action="{{ route('admin.rekening-donasi.update', $rekening) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="kategori" class="block text-sm font-medium text-ink/70 mb-1.5">Kategori</label>
                <select id="kategori" name="kategori" required
                        class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                               focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                    @foreach ($kategoriOptions as $option)
                        <option value="{{ $option }}" {{ old('kategori', $rekening->kategori) === $option ? 'selected' : '' }}>Rekening {{ $option }}</option>
                    @endforeach
                </select>
                @error('kategori') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="nama_bank" class="block text-sm font-medium text-ink/70 mb-1.5">Nama Bank</label>
                <input id="nama_bank" name="nama_bank" type="text" value="{{ old('nama_bank', $rekening->nama_bank) }}" required autofocus
                       class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                              focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                @error('nama_bank') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="no_rekening" class="block text-sm font-medium text-ink/70 mb-1.5">Nomor Rekening</label>
                <input id="no_rekening" name="no_rekening" type="text" value="{{ old('no_rekening', $rekening->no_rekening) }}" required
                       class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm font-mono
                              focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                @error('no_rekening') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="atas_nama" class="block text-sm font-medium text-ink/70 mb-1.5">Atas Nama</label>
                <input id="atas_nama" name="atas_nama" type="text" value="{{ old('atas_nama', $rekening->atas_nama) }}" required
                       class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                              focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                @error('atas_nama') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                @if ($rekening->logo)
                    <label class="block text-sm font-medium text-ink/70 mb-1.5">Logo Saat Ini</label>
                    <img src="{{ asset('storage/' . $rekening->logo) }}" alt="{{ $rekening->nama_bank }}"
                         class="h-12 w-20 object-contain rounded border border-black/10 bg-white mb-3 p-1">
                @endif

                <label for="logo" class="block text-sm font-medium text-ink/70 mb-1.5">
                    {{ $rekening->logo ? 'Ganti Logo (opsional)' : 'Logo Bank' }}
                </label>
                <input id="logo" name="logo" type="file" accept="image/png,image/jpeg,image/webp,image/svg+xml"
                       class="w-full text-sm text-ink/60
                              file:mr-4 file:rounded-lg file:border-0 file:bg-emerald-700/10 file:px-4 file:py-2
                              file:text-sm file:font-medium file:text-emerald-800 hover:file:bg-emerald-700/20">
                @error('logo') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                <p class="mt-1.5 text-xs text-ink/40">Kosongkan jika tidak ingin mengganti logo. Maksimal 1MB.</p>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="rounded-xl bg-emerald-800 hover:bg-emerald-900 transition text-white text-sm font-medium px-5 py-2.5">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.rekening-donasi.index') }}" class="text-sm text-ink/50 hover:text-ink">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection