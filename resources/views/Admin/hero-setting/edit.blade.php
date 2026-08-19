@extends('Admin.layouts.app')

@section('title', 'Edit Hero Landing')
@section('breadcrumb', 'Konten / Hero Landing')
@section('page-title', 'Edit Hero Landing')

@section('content')
<div class="max-w-2xl">

    @if (session('success'))
        <div class="rounded-xl border border-emerald-700/20 bg-emerald-700/5 px-4 py-3 text-sm text-emerald-800 mb-5">
            {{ session('success') }}
        </div>
    @endif

    <div class="rounded-2xl border border-black/5 bg-white p-6">
        <form method="POST" action="{{ route('admin.hero-setting.update', $hero) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                @if ($hero->foto)
                    <label class="block text-sm font-medium text-ink/70 mb-1.5">Foto Saat Ini</label>
                    <img src="{{ asset('storage/' . $hero->foto) }}" alt="Foto hero"
                         class="h-32 w-auto object-contain rounded-lg border border-black/10 p-2 mb-3">
                @endif

                <label for="foto" class="block text-sm font-medium text-ink/70 mb-1.5">
                    {{ $hero->foto ? 'Ganti Foto (opsional)' : 'Foto Hero' }}
                </label>
                <input id="foto" name="foto" type="file" accept="image/png,image/jpeg,image/webp"
                       class="w-full text-sm text-ink/60
                              file:mr-4 file:rounded-lg file:border-0 file:bg-emerald-700/10 file:px-4 file:py-2
                              file:text-sm file:font-medium file:text-emerald-800 hover:file:bg-emerald-700/20">
                @error('foto') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                <p class="mt-1.5 text-xs text-ink/40">Kosongkan jika tidak ingin mengganti foto. Maksimal 2MB.</p>
            </div>

            <hr class="border-black/5">

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label for="eyebrow_id" class="block text-sm font-medium text-ink/70 mb-1.5">Eyebrow (ID)</label>
                    <input id="eyebrow_id" name="eyebrow_id" type="text" value="{{ old('eyebrow_id', $hero->eyebrow_id) }}"
                           class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                    @error('eyebrow_id') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="eyebrow_en" class="block text-sm font-medium text-ink/70 mb-1.5">Eyebrow (EN)</label>
                    <input id="eyebrow_en" name="eyebrow_en" type="text" value="{{ old('eyebrow_en', $hero->eyebrow_en) }}"
                           class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                    @error('eyebrow_en') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label for="judul_id" class="block text-sm font-medium text-ink/70 mb-1.5">Judul (ID)</label>
                    <input id="judul_id" name="judul_id" type="text" value="{{ old('judul_id', $hero->judul_id) }}"
                           class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                    @error('judul_id') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="judul_en" class="block text-sm font-medium text-ink/70 mb-1.5">Judul (EN)</label>
                    <input id="judul_en" name="judul_en" type="text" value="{{ old('judul_en', $hero->judul_en) }}"
                           class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                    @error('judul_en') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label for="subjudul_id" class="block text-sm font-medium text-ink/70 mb-1.5">Subjudul (ID)</label>
                    <textarea id="subjudul_id" name="subjudul_id" rows="3"
                              class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                                     focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">{{ old('subjudul_id', $hero->subjudul_id) }}</textarea>
                    @error('subjudul_id') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="subjudul_en" class="block text-sm font-medium text-ink/70 mb-1.5">Subjudul (EN)</label>
                    <textarea id="subjudul_en" name="subjudul_en" rows="3"
                              class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                                     focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">{{ old('subjudul_en', $hero->subjudul_en) }}</textarea>
                    @error('subjudul_en') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="rounded-xl bg-emerald-800 hover:bg-emerald-900 transition text-white text-sm font-medium px-5 py-2.5">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.hero-stat.index') }}" class="text-sm text-ink/50 hover:text-ink">Kelola Statistik →</a>
            </div>
        </form>
    </div>
</div>
@endsection