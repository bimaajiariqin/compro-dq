@extends('Admin.layouts.app')

@section('title', 'Awal Perjalanan Kami')
@section('breadcrumb', 'Konten')
@section('page-title', 'Awal Perjalanan Kami')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between flex-wrap gap-3">
        <div>
            <h2 class="font-display text-2xl text-ink">Awal Perjalanan Kami</h2>
            <p class="text-sm text-ink/50 mt-1">Kelola linimasa perjalanan lembaga yang tampil di halaman Tentang Kami.</p>
        </div>
        <a href="{{ route('admin.riwayat.create') }}"
           class="inline-flex items-center gap-2 rounded-xl bg-emerald-800 hover:bg-emerald-900 transition text-white text-sm font-medium px-4 py-2.5">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Tambah Riwayat
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
                        <th class="px-6 py-3 font-medium">Tanggal</th>
                        <th class="px-6 py-3 font-medium">Judul</th>
                        <th class="hidden sm:table-cell px-6 py-3 font-medium">Logo</th>
                        <th class="hidden sm:table-cell px-6 py-3 font-medium">Urutan</th>
                        <th class="px-6 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($riwayatList as $item)
                        <tr class="border-b border-black/5 last:border-0">
                            <td class="px-6 py-4 text-ink/70 whitespace-nowrap">{{ $item->tanggal }}</td>
                            <td class="px-6 py-4">
                                <p class="font-medium text-ink">{{ $item->judul }}</p>
                                <p class="text-xs text-ink/40 mt-0.5">{{ Str::limit($item->deskripsi, 60) }}</p>
                            </td>
                            <td class="hidden sm:table-cell px-6 py-4">
                                @if ($item->logo)
                                    <img src="{{ asset('storage/' . $item->logo) }}" alt="{{ $item->judul }}"
                                         class="h-9 w-9 rounded-lg object-contain border border-black/5 p-1">
                                @else
                                    <span class="text-ink/30">—</span>
                                @endif
                            </td>
                            <td class="hidden sm:table-cell px-6 py-4 text-ink/50">{{ $item->urutan }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('admin.riwayat.edit', $item) }}" class="text-xs text-ink/50 hover:text-emerald-700">Edit</a>
                                    <form method="POST" action="{{ route('admin.riwayat.destroy', $item) }}"
                                          onsubmit="return confirm('Hapus riwayat &quot;{{ $item->judul }}&quot;?');">
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
                                Belum ada data riwayat.
                                <a href="{{ route('admin.riwayat.create') }}" class="text-emerald-700 hover:underline">Tambah pertama →</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection