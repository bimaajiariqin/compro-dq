@extends('Admin.layouts.app')

@section('title', 'Penghargaan')
@section('breadcrumb', 'Konten')
@section('page-title', 'Penghargaan')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between flex-wrap gap-3">
        <div>
            <h2 class="font-display text-2xl text-ink">Penghargaan</h2>
            <p class="text-sm text-ink/50 mt-1">Kelola penghargaan dan sertifikat yang tampil di halaman company profile.</p>
        </div>
        <a href="{{ route('admin.penghargaan.create') }}"
           class="inline-flex items-center gap-2 rounded-xl bg-emerald-800 hover:bg-emerald-900 transition text-white text-sm font-medium px-4 py-2.5">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Tambah Penghargaan
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
                        <th class="px-6 py-3 font-medium">Penghargaan</th>
                        <th class="px-6 py-3 font-medium">Tahun</th>
                        <th class="hidden sm:table-cell px-6 py-3 font-medium">Tanggal Terbit</th>
                        <th class="px-6 py-3 font-medium">Dokumen</th>
                        <th class="px-6 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($penghargaan as $item)
                        @php
                            $isPdf = \Illuminate\Support\Str::endsWith(strtolower($item->dokumen ?? ''), '.pdf');
                        @endphp
                        <tr class="border-b border-black/5 last:border-0">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3 max-w-xs">
                                    @if ($item->dokumen && ! $isPdf)
                                        <img src="{{ asset('storage/' . $item->dokumen) }}" alt="{{ $item->judul }}"
                                             class="h-11 w-11 rounded-lg object-cover shrink-0 border border-black/5">
                                    @else
                                        <span class="h-11 w-11 rounded-lg bg-gold-500/10 text-gold-600 flex items-center justify-center shrink-0">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="8" r="5"/><path d="M8.5 12.5 7 21l5-3 5 3-1.5-8.5"/>
                                            </svg>
                                        </span>
                                    @endif
                                    <div class="min-w-0">
                                        <p class="font-medium text-ink truncate">{{ $item->judul }}</p>
                                        <p class="sm:hidden text-xs text-ink/40 mt-0.5">
                                            {{ $item->tanggal_terbit->translatedFormat('d M Y') }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-ink/60">{{ $item->tahun }}</td>
                            <td class="hidden sm:table-cell px-6 py-4 text-ink/50 whitespace-nowrap">
                                {{ $item->tanggal_terbit->translatedFormat('d M Y') }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($item->dokumen)
                                    <a href="{{ asset('storage/' . $item->dokumen) }}" target="_blank" rel="noopener"
                                       class="inline-flex items-center gap-1.5 text-emerald-700 hover:underline whitespace-nowrap">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 3v12"/><path d="m7 10 5 5 5-5"/><path d="M5 21h14"/>
                                        </svg>
                                        Lihat {{ $isPdf ? 'PDF' : 'Gambar' }}
                                    </a>
                                @else
                                    <span class="text-ink/30">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('admin.penghargaan.edit', $item) }}" class="text-xs text-ink/50 hover:text-emerald-700">Edit</a>
                                    <form method="POST" action="{{ route('admin.penghargaan.destroy', $item) }}"
                                          onsubmit="return confirm('Hapus penghargaan &quot;{{ $item->judul }}&quot;? Tindakan ini tidak bisa dibatalkan.');">
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
                                Belum ada penghargaan.
                                <a href="{{ route('admin.penghargaan.create') }}" class="text-emerald-700 hover:underline">Tambah penghargaan pertama →</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($penghargaan->hasPages())
        <div>{{ $penghargaan->links() }}</div>
    @endif

</div>
@endsection