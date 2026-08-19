@extends('Admin.layouts.app')

@section('title', 'Statistik Hero')
@section('breadcrumb', 'Konten / Hero Landing')
@section('page-title', 'Statistik Hero')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between flex-wrap gap-3">
        <div>
            <h2 class="font-display text-2xl text-ink">Statistik Hero</h2>
            <p class="text-sm text-ink/50 mt-1">Kelola angka-angka yang tampil di bawah foto hero landing.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.hero-setting.edit') }}" class="text-sm text-ink/50 hover:text-ink">← Edit Hero</a>
            <a href="{{ route('admin.hero-stat.create') }}"
               class="inline-flex items-center gap-2 rounded-xl bg-emerald-800 hover:bg-emerald-900 transition text-white text-sm font-medium px-4 py-2.5">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                    <path d="M12 5v14M5 12h14"/>
                </svg>
                Tambah Statistik
            </a>
        </div>
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
                        <th class="px-6 py-3 font-medium">Label</th>
                        <th class="px-6 py-3 font-medium">Nilai</th>
                        <th class="px-6 py-3 font-medium">Suffix</th>
                        <th class="hidden sm:table-cell px-6 py-3 font-medium">Urutan</th>
                        <th class="px-6 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($stats as $stat)
                        <tr class="border-b border-black/5 last:border-0">
                            <td class="px-6 py-4 font-medium text-ink">{{ $stat->label }}</td>
                            <td class="px-6 py-4 text-ink/70">{{ $stat->value }}</td>
                            <td class="px-6 py-4 text-ink/50">{{ $stat->suffix ?: '—' }}</td>
                            <td class="hidden sm:table-cell px-6 py-4 text-ink/50">{{ $stat->urutan }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('admin.hero-stat.edit', $stat) }}" class="text-xs text-ink/50 hover:text-emerald-700">Edit</a>
                                    <form method="POST" action="{{ route('admin.hero-stat.destroy', $stat) }}"
                                          onsubmit="return confirm('Hapus statistik &quot;{{ $stat->label }}&quot;?');">
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
                                Belum ada statistik.
                                <a href="{{ route('admin.hero-stat.create') }}" class="text-emerald-700 hover:underline">Tambah statistik pertama →</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection