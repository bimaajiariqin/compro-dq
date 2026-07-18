@extends('Admin.layouts.app')

@section('title', 'Laporan Keuangan')
@section('breadcrumb', 'Konten')
@section('page-title', 'Laporan Keuangan')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between flex-wrap gap-3">
        <div>
            <h2 class="font-display text-2xl text-ink">Laporan Keuangan</h2>
            <p class="text-sm text-ink/50 mt-1">Kelola dokumen laporan keuangan tahunan yang bisa diunduh publik.</p>
        </div>
        <a href="{{ route('laporan-keuangan.create') }}"
           class="inline-flex items-center gap-2 rounded-xl bg-emerald-800 hover:bg-emerald-900 transition text-white text-sm font-medium px-4 py-2.5">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Tambah Laporan
        </a>
    </div>

    @if (session('success'))
        <div class="rounded-xl border border-emerald-700/20 bg-emerald-700/5 px-4 py-3 text-sm text-emerald-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="rounded-2xl border border-black/5 bg-white overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[420px] text-sm">
                <thead>
                    <tr class="border-b border-black/5 text-left text-xs uppercase tracking-wide text-ink/40">
                        <th class="px-6 py-3 font-medium">Tahun</th>
                        <th class="px-6 py-3 font-medium">Dokumen</th>
                        <th class="px-6 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($laporan as $item)
                        <tr class="border-b border-black/5 last:border-0">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <span class="h-10 w-10 rounded-lg bg-emerald-700/10 text-emerald-700 flex items-center justify-center shrink-0">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M14 3v5h5"/><path d="M6 3h8l5 5v13a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Z"/><path d="M9 13h6M9 17h6"/>
                                        </svg>
                                    </span>
                                    <p class="font-display text-lg text-ink">{{ $item->tahun }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ asset('storage/' . $item->link_dokumen) }}" target="_blank" rel="noopener"
                                   class="inline-flex items-center gap-1.5 text-emerald-700 hover:underline whitespace-nowrap">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 3v12"/><path d="m7 10 5 5 5-5"/><path d="M5 21h14"/>
                                    </svg>
                                    Lihat / Unduh PDF
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('laporan-keuangan.edit', $item) }}" class="text-xs text-ink/50 hover:text-emerald-700">Edit</a>
                                    <form method="POST" action="{{ route('laporan-keuangan.destroy', $item) }}"
                                          onsubmit="return confirm('Hapus laporan keuangan tahun {{ $item->tahun }}? Tindakan ini tidak bisa dibatalkan.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs text-red-500 hover:text-red-700">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-10 text-center text-sm text-ink/40">
                                Belum ada laporan keuangan.
                                <a href="{{ route('laporan-keuangan.create') }}" class="text-emerald-700 hover:underline">Tambah laporan pertama →</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($laporan->hasPages())
        <div>{{ $laporan->links() }}</div>
    @endif

</div>
@endsection