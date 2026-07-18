@extends('Admin.layouts.app')

@section('title', 'Berita')
@section('breadcrumb', 'Konten')
@section('page-title', 'Berita')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between flex-wrap gap-3">
        <div>
            <h2 class="font-display text-2xl text-ink">Berita</h2>
            <p class="text-sm text-ink/50 mt-1">Kelola artikel berita yang tampil di halaman company profile.</p>
        </div>
        <a href="{{ route('berita.create') }}"
           class="inline-flex items-center gap-2 rounded-xl bg-emerald-800 hover:bg-emerald-900 transition text-white text-sm font-medium px-4 py-2.5">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Tambah Berita
        </a>
    </div>

    @if (session('success'))
        <div class="rounded-xl border border-emerald-700/20 bg-emerald-700/5 px-4 py-3 text-sm text-emerald-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="rounded-2xl border border-black/5 bg-white overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[720px] text-sm">
                <thead>
                    <tr class="border-b border-black/5 text-left text-xs uppercase tracking-wide text-ink/40">
                        <th class="px-6 py-3 font-medium">Berita</th>
                        <th class="px-6 py-3 font-medium">Kategori</th>
                        <th class="hidden md:table-cell px-6 py-3 font-medium">Program</th>
                        <th class="hidden sm:table-cell px-6 py-3 font-medium">Tanggal Terbit</th>
                        <th class="px-6 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($berita as $item)
                        <tr class="border-b border-black/5 last:border-0">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3 max-w-xs">
                                    @if ($item->thumbnail)
                                        <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->judul }}"
                                             class="h-11 w-11 rounded-lg object-cover shrink-0 border border-black/5">
                                    @else
                                        <span class="h-11 w-11 rounded-lg bg-ink/5 text-ink/30 flex items-center justify-center shrink-0">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-5-5L5 21"/>
                                            </svg>
                                        </span>
                                    @endif
                                    <div class="min-w-0">
                                        <p class="font-medium text-ink truncate">{{ $item->judul }}</p>
                                        <p class="text-xs text-ink/40 truncate">{{ $item->nama_penerbit }}</p>
                                        <p class="sm:hidden text-xs text-ink/40 mt-0.5">
                                            {{ $item->tanggal_terbit->translatedFormat('d M Y') }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $kategoriColor = match ($item->kategori) {
                                        'Inspirasi' => 'bg-gold-500/10 text-gold-600',
                                        'Kegiatan'  => 'bg-emerald-700/10 text-emerald-700',
                                        default     => 'bg-ink/5 text-ink/60',
                                    };
                                @endphp
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium {{ $kategoriColor }}">
                                    {{ $item->kategori }}
                                </span>
                            </td>
                            <td class="hidden md:table-cell px-6 py-4 text-ink/60">{{ $item->filter_program }}</td>
                            <td class="hidden sm:table-cell px-6 py-4 text-ink/50 whitespace-nowrap">
                                {{ $item->tanggal_terbit->translatedFormat('d M Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('berita.edit', $item) }}" class="text-xs text-ink/50 hover:text-emerald-700">Edit</a>
                                    <form method="POST" action="{{ route('berita.destroy', $item) }}"
                                          onsubmit="return confirm('Hapus berita &quot;{{ $item->judul }}&quot;? Tindakan ini tidak bisa dibatalkan.');">
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
                                Belum ada berita.
                                <a href="{{ route('berita.create') }}" class="text-emerald-700 hover:underline">Tambah berita pertama →</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($berita->hasPages())
        <div>{{ $berita->links() }}</div>
    @endif

</div>
@endsection