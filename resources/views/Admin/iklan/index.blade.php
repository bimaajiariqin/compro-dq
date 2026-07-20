@extends('Admin.layouts.app')

@section('title', 'Iklan')
@section('breadcrumb', 'Konten')
@section('page-title', 'Iklan')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between flex-wrap gap-3">
        <div>
            <h2 class="font-display text-2xl text-ink">Iklan</h2>
            <p class="text-sm text-ink/50 mt-1">Kelola thumbnail dan link tujuan iklan yang tampil di halaman publik.</p>
        </div>
        <a href="{{ route('admin.iklan.create') }}"
           class="inline-flex items-center gap-2 rounded-xl bg-emerald-800 hover:bg-emerald-900 transition text-white text-sm font-medium px-4 py-2.5">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Tambah Iklan
        </a>
    </div>

    @if (session('success'))
        <div class="rounded-xl border border-emerald-700/20 bg-emerald-700/5 px-4 py-3 text-sm text-emerald-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="rounded-2xl border border-black/5 bg-white overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[560px] text-sm">
                <thead>
                    <tr class="border-b border-black/5 text-left text-xs uppercase tracking-wide text-ink/40">
                        <th class="px-6 py-3 font-medium">Thumbnail</th>
                        <th class="px-6 py-3 font-medium">Link</th>
                        <th class="px-6 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($iklan as $item)
                        <tr class="border-b border-black/5 last:border-0">
                            <td class="px-6 py-4">
                                @if ($item->thumbnail)
                                    <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="Iklan #{{ $item->id }}"
                                         class="h-14 w-24 object-cover rounded-lg border border-black/5">
                                @else
                                    <span class="h-14 w-24 rounded-lg bg-ink/5 flex items-center justify-center text-ink/30 text-xs">Tanpa gambar</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ $item->link }}" target="_blank" rel="noopener"
                                   class="inline-flex items-center gap-1.5 text-emerald-700 hover:underline max-w-xs truncate">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
                                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><path d="M15 3h6v6"/><path d="M10 14 21 3"/>
                                    </svg>
                                    <span class="truncate">{{ $item->link }}</span>
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('admin.iklan.edit', $item) }}" class="text-xs text-ink/50 hover:text-emerald-700">Edit</a>
                                    <form method="POST" action="{{ route('admin.iklan.destroy', $item) }}"
                                          onsubmit="return confirm('Hapus iklan ini? Tindakan ini tidak bisa dibatalkan.');">
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
                                Belum ada iklan.
                                <a href="{{ route('admin.iklan.create') }}" class="text-emerald-700 hover:underline">Tambah iklan pertama →</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection