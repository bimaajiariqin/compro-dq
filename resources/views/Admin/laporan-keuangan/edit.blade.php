@extends('Admin.layouts.app')

@section('title', 'Edit Laporan Keuangan')
@section('breadcrumb', 'Konten / Laporan Keuangan')
@section('page-title', 'Edit Laporan Keuangan')

@section('content')
<div class="max-w-lg">
    <div class="rounded-2xl border border-black/5 bg-white p-6">
        <form method="POST" action="{{ route('admin.laporan-keuangan.update', $laporan) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="tahun" class="block text-sm font-medium text-ink/70 mb-1.5">Tahun</label>
                <input id="tahun" name="tahun" type="number" value="{{ old('tahun', $laporan->tahun) }}" required autofocus
                       min="2000" max="{{ date('Y') + 1 }}"
                       class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                              focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                @error('tahun') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-ink/70 mb-1.5">Dokumen Saat Ini</label>
                <a href="{{ asset('storage/' . $laporan->link_dokumen) }}" target="_blank" rel="noopener"
                   class="inline-flex items-center gap-1.5 text-sm text-emerald-700 hover:underline mb-3">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 3v5h5"/><path d="M6 3h8l5 5v13a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Z"/><path d="M9 13h6M9 17h6"/>
                    </svg>
                    Lihat dokumen saat ini
                </a>

                <label for="dokumen" class="block text-sm font-medium text-ink/70 mb-1.5">Ganti Dokumen (opsional)</label>
                <input id="dokumen" name="dokumen" type="file" accept="application/pdf"
                       class="w-full text-sm text-ink/60
                              file:mr-4 file:rounded-lg file:border-0 file:bg-emerald-700/10 file:px-4 file:py-2
                              file:text-sm file:font-medium file:text-emerald-800 hover:file:bg-emerald-700/20">
                @error('dokumen') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                <p class="mt-1.5 text-xs text-ink/40">Kosongkan jika tidak ingin mengganti dokumen. Hanya PDF, maksimal 10MB.</p>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="rounded-xl bg-emerald-800 hover:bg-emerald-900 transition text-white text-sm font-medium px-5 py-2.5">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.laporan-keuangan.index') }}" class="text-sm text-ink/50 hover:text-ink">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection