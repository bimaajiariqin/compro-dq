@extends('Admin.layouts.app')

@section('title', 'Program Pokok')
@section('breadcrumb', 'Konten')
@section('page-title', 'Program Pokok')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between flex-wrap gap-3">
        <div>
            <h2 class="font-display text-2xl text-ink">Program Pokok</h2>
            <p class="text-sm text-ink/50 mt-1">Kelola daftar "Program Pokok Kami" yang tampil di 4 halaman Program (Pendidikan, Ekonomi, Dakwah, Kemanusiaan).</p>
        </div>
        <a href="{{ route('admin.program-pokok.create') }}"
           class="inline-flex items-center gap-2 rounded-xl bg-emerald-800 hover:bg-emerald-900 transition text-white text-sm font-medium px-4 py-2.5">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Tambah Program Pokok
        </a>
    </div>

    @if (session('success'))
        <div class="rounded-xl border border-emerald-700/20 bg-emerald-700/5 px-4 py-3 text-sm text-emerald-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="rounded-2xl border border-black/5 bg-white overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[680px] text-sm">
                <thead>
                    <tr class="border-b border-black/5 text-left text-xs uppercase tracking-wide text-ink/40">
                        <th class="px-6 py-3 font-medium">Icon</th>
                        <th class="px-6 py-3 font-medium">Judul</th>
                        <th class="px-6 py-3 font-medium">Kategori</th>
                        <th class="px-6 py-3 font-medium">Link</th>
                        <th class="px-6 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($programPokok as $item)
                        <tr class="border-b border-black/5 last:border-0">
                            <td class="px-6 py-4">
                                <span class="h-9 w-9 rounded-lg bg-emerald-700/10 overflow-hidden flex items-center justify-center">
                                    @if ($item->icon)
                                        <img src="{{ asset('storage/' . $item->icon) }}" alt="{{ $item->judul }}" class="h-full w-full object-cover">
                                    @endif
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-medium text-ink">{{ $item->judul }}</p>
                                <p class="text-xs text-ink/40 truncate max-w-xs">{{ \Illuminate\Support\Str::limit($item->deskripsi, 60) }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-700/10 text-emerald-700">
                                    {{ $item->kategori_program }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if ($item->link)
                                    <a href="{{ $item->link }}" target="_blank" rel="noopener" class="text-emerald-700 hover:underline truncate max-w-[160px] inline-block align-bottom">
                                        {{ $item->link }}
                                    </a>
                                @else
                                    <span class="text-ink/30">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('admin.program-pokok.edit', $item) }}" class="text-xs text-ink/50 hover:text-emerald-700">Edit</a>
                                    <form method="POST" action="{{ route('admin.program-pokok.destroy', $item) }}"
                                          onsubmit="return confirm('Hapus program pokok &quot;{{ $item->judul }}&quot;? Tindakan ini tidak bisa dibatalkan.');">
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
                                Belum ada program pokok.
                                <a href="{{ route('admin.program-pokok.create') }}" class="text-emerald-700 hover:underline">Tambah program pokok pertama →</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection