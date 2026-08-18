@extends('Admin.layouts.app')

@section('title', 'Mitra Kebaikan')
@section('breadcrumb', 'Konten')
@section('page-title', 'Mitra Kebaikan')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between flex-wrap gap-3">
        <div>
            <h2 class="font-display text-2xl text-ink">Mitra Kebaikan</h2>
            <p class="text-sm text-ink/50 mt-1">Kelola logo mitra yang tampil di halaman utama.</p>
        </div>
        <a href="{{ route('admin.mitra.create') }}"
           class="inline-flex items-center gap-2 rounded-xl bg-emerald-800 hover:bg-emerald-900 transition text-white text-sm font-medium px-4 py-2.5">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Tambah Mitra
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
                        <th class="px-6 py-3 font-medium">Mitra</th>
                        <th class="px-6 py-3 font-medium">Link</th>
                        <th class="hidden sm:table-cell px-6 py-3 font-medium">Urutan</th>
                        <th class="px-6 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mitras as $mitra)
                        <tr class="border-b border-black/5 last:border-0">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3 max-w-xs">
                                    @if ($mitra->logo)
                                        <img src="{{ asset('storage/' . $mitra->logo) }}" alt="{{ $mitra->nama_mitra ?? 'Logo mitra' }}"
                                             class="h-11 w-11 rounded-lg object-contain shrink-0 border border-black/5 p-1">
                                    @else
                                        <span class="h-11 w-11 rounded-lg bg-gold-500/10 text-gold-600 flex items-center justify-center shrink-0">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M11 21H5a2 2 0 0 1-2-2v-4a2 2 0 0 1 2-2h1"/>
                                                <path d="M13 3h6a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-1"/>
                                                <path d="M8 13a3 3 0 0 0 3 3h1.5a1.5 1.5 0 0 0 0-3H12"/>
                                                <path d="M16 11a3 3 0 0 0-3-3h-1.5a1.5 1.5 0 0 0 0 3H12"/>
                                            </svg>
                                        </span>
                                    @endif
                                    <div class="min-w-0">
                                        <p class="font-medium text-ink truncate">{{ $mitra->nama_mitra ?? '-' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if ($mitra->link)
                                    <a href="{{ $mitra->link }}" target="_blank" rel="noopener"
                                       class="inline-flex items-center gap-1.5 text-emerald-700 hover:underline whitespace-nowrap">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M10 14 21 3"/><path d="M21 3h-6"/><path d="M21 3v6"/>
                                            <path d="M19 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h6"/>
                                        </svg>
                                        {{ Str::limit($mitra->link, 30) }}
                                    </a>
                                @else
                                    <span class="text-ink/30">—</span>
                                @endif
                            </td>
                            <td class="hidden sm:table-cell px-6 py-4 text-ink/50">{{ $mitra->urutan }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('admin.mitra.edit', $mitra) }}" class="text-xs text-ink/50 hover:text-emerald-700">Edit</a>
                                    <form method="POST" action="{{ route('admin.mitra.destroy', $mitra) }}"
                                          onsubmit="return confirm('Hapus mitra &quot;{{ $mitra->nama_mitra ?? 'ini' }}&quot;? Tindakan ini tidak bisa dibatalkan.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs text-red-500 hover:text-red-700">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-sm text-ink/40">
                                Belum ada mitra kebaikan.
                                <a href="{{ route('admin.mitra.create') }}" class="text-emerald-700 hover:underline">Tambah mitra pertama →</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if (method_exists($mitras, 'hasPages') && $mitras->hasPages())
        <div>{{ $mitras->links() }}</div>
    @endif

</div>
@endsection