@extends('Admin.layouts.app')

@section('title', 'Tambah Statistik Hero')
@section('breadcrumb', 'Konten / Hero Landing')
@section('page-title', 'Tambah Statistik Hero')

@section('content')
<div class="max-w-lg">
    <div class="rounded-2xl border border-black/5 bg-white p-6">
        <form method="POST" action="{{ route('admin.hero-stat.store') }}" class="space-y-5">
            @csrf

            <div>
                <label for="label" class="block text-sm font-medium text-ink/70 mb-1.5">Label</label>
                <input id="label" name="label" type="text" value="{{ old('label') }}" autofocus
                       placeholder="Contoh: Donatur"
                       class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm placeholder:text-ink/30
                              focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                @error('label') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label for="value" class="block text-sm font-medium text-ink/70 mb-1.5">Nilai</label>
                    <input id="value" name="value" type="number" value="{{ old('value', 0) }}" min="0"
                           class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                    @error('value') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="suffix" class="block text-sm font-medium text-ink/70 mb-1.5">Suffix (opsional)</label>
                    <input id="suffix" name="suffix" type="text" value="{{ old('suffix') }}"
                           placeholder="Contoh: +, JT+"
                           class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm placeholder:text-ink/30
                                  focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                    @error('suffix') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="urutan" class="block text-sm font-medium text-ink/70 mb-1.5">Urutan</label>
                <input id="urutan" name="urutan" type="number" value="{{ old('urutan', 0) }}" min="0"
                       class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                              focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                @error('urutan') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="rounded-xl bg-emerald-800 hover:bg-emerald-900 transition text-white text-sm font-medium px-5 py-2.5">
                    Simpan
                </button>
                <a href="{{ route('admin.hero-stat.index') }}" class="text-sm text-ink/50 hover:text-ink">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection