@extends('Admin.layouts.app')

@section('title', 'Tambah Berita')
@section('breadcrumb', 'Konten / Berita')
@section('page-title', 'Tambah Berita')

@section('content')
<div class="max-w-2xl">
    <div class="rounded-2xl border border-black/5 bg-white p-6">
        <form method="POST" action="{{ route('berita.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label for="judul" class="block text-sm font-medium text-ink/70 mb-1.5">Judul</label>
                <input id="judul" name="judul" type="text" value="{{ old('judul') }}" required autofocus
                       placeholder="Judul berita"
                       class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm placeholder:text-ink/30
                              focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                @error('judul') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="thumbnail" class="block text-sm font-medium text-ink/70 mb-1.5">Thumbnail</label>
                <input id="thumbnail" name="thumbnail" type="file" accept="image/png,image/jpeg,image/webp" required
                       class="w-full text-sm text-ink/60
                              file:mr-4 file:rounded-lg file:border-0 file:bg-emerald-700/10 file:px-4 file:py-2
                              file:text-sm file:font-medium file:text-emerald-800 hover:file:bg-emerald-700/20">
                @error('thumbnail') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                <p class="mt-1.5 text-xs text-ink/40">JPG, PNG, atau WEBP. Maksimal 2MB.</p>
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label for="nama_penerbit" class="block text-sm font-medium text-ink/70 mb-1.5">Nama Penerbit</label>
                    <input id="nama_penerbit" name="nama_penerbit" type="text" value="{{ old('nama_penerbit') }}" required
                           placeholder="Mis. Tim Media DQ"
                           class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm placeholder:text-ink/30
                                  focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                    @error('nama_penerbit') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="tanggal_terbit" class="block text-sm font-medium text-ink/70 mb-1.5">Tanggal Terbit</label>
                    <input id="tanggal_terbit" name="tanggal_terbit" type="date" value="{{ old('tanggal_terbit') }}" required
                           class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                    @error('tanggal_terbit') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label for="kategori" class="block text-sm font-medium text-ink/70 mb-1.5">Kategori</label>
                    <select id="kategori" name="kategori" required
                            class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                                   focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                        <option value="" disabled {{ old('kategori') ? '' : 'selected' }}>Pilih kategori</option>
                        @foreach ($kategoriOptions as $option)
                            <option value="{{ $option }}" {{ old('kategori') === $option ? 'selected' : '' }}>{{ $option }}</option>
                        @endforeach
                    </select>
                    @error('kategori') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="filter_program" class="block text-sm font-medium text-ink/70 mb-1.5">Filter Program</label>
                    <select id="filter_program" name="filter_program" required
                            class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                                   focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                        <option value="" disabled {{ old('filter_program') ? '' : 'selected' }}>Pilih program</option>
                        @foreach ($filterProgramOptions as $option)
                            <option value="{{ $option }}" {{ old('filter_program') === $option ? 'selected' : '' }}>{{ $option }}</option>
                        @endforeach
                    </select>
                    @error('filter_program') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-medium text-ink/70 mb-1.5">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="8" required
                          placeholder="Tulis isi berita di sini..."
                          class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm placeholder:text-ink/30
                                 focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">{{ old('deskripsi') }}</textarea>
                @error('deskripsi') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="rounded-xl bg-emerald-800 hover:bg-emerald-900 transition text-white text-sm font-medium px-5 py-2.5">
                    Simpan
                </button>
                <a href="{{ route('berita.index') }}" class="text-sm text-ink/50 hover:text-ink">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection