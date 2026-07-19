@extends('Admin.layouts.app')

@section('title', 'Rekening Donasi')
@section('breadcrumb', 'Konten')
@section('page-title', 'Rekening Donasi')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between flex-wrap gap-3">
        <div>
            <h2 class="font-display text-2xl text-ink">Rekening Donasi</h2>
            <p class="text-sm text-ink/50 mt-1">Kelola daftar rekening Infaq, Zakat, dan Wakaf yang tampil di halaman publik.</p>
        </div>
        <a href="{{ route('admin.rekening-donasi.create') }}"
           class="inline-flex items-center gap-2 rounded-xl bg-emerald-800 hover:bg-emerald-900 transition text-white text-sm font-medium px-4 py-2.5">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Tambah Rekening
        </a>
    </div>

    @if (session('success'))
        <div class="rounded-xl border border-emerald-700/20 bg-emerald-700/5 px-4 py-3 text-sm text-emerald-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="rounded-2xl border border-black/5 bg-white overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[640px] text-sm">
                <thead>
                    <tr class="border-b border-black/5 text-left text-xs uppercase tracking-wide text-ink/40">
                        <th class="px-6 py-3 font-medium">Bank</th>
                        <th class="px-6 py-3 font-medium">No. Rekening</th>
                        <th class="hidden sm:table-cell px-6 py-3 font-medium">Atas Nama</th>
                        <th class="px-6 py-3 font-medium">Kategori</th>
                        <th class="px-6 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rekening as $item)
                        <tr class="border-b border-black/5 last:border-0">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if ($item->logo)
                                        <img src="{{ asset('storage/' . $item->logo) }}" alt="{{ $item->nama_bank }}"
                                             class="h-9 w-14 object-contain rounded border border-black/5 bg-white shrink-0">
                                    @else
                                        <span class="h-9 w-14 rounded border border-black/5 bg-ink/5 shrink-0"></span>
                                    @endif
                                    <p class="font-medium text-ink">{{ $item->nama_bank }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-ink/70 font-mono">{{ $item->no_rekening }}</td>
                            <td class="hidden sm:table-cell px-6 py-4 text-ink/50">{{ $item->atas_nama }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-700/10 text-emerald-700">
                                    {{ $item->kategori }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('admin.rekening-donasi.edit', $item) }}" class="text-xs text-ink/50 hover:text-emerald-700">Edit</a>
                                    <form method="POST" action="{{ route('admin.rekening-donasi.destroy', $item) }}"
                                          onsubmit="return confirm('Hapus rekening {{ $item->nama_bank }}? Tindakan ini tidak bisa dibatalkan.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs text-red-500 hover:text-red-700">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-sm text-ink/40">
                                Belum ada rekening donasi.
                                <a href="{{ route('admin.rekening-donasi.create') }}" class="text-emerald-700 hover:underline">Tambah rekening pertama →</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection