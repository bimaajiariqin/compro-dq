@extends('Admin.layouts.app')

@section('title', 'Dashboard')
@section('breadcrumb', 'Admin')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-8">

    <div>
        <h2 class="font-display text-2xl text-ink">Selamat datang kembali</h2>
        <p class="text-sm text-ink/50 mt-1">Ringkasan konten company profile Dompet Al-Qur'an Indonesia.</p>
    </div>

    {{-- Stat cards --}}
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-5">

        <div class="rounded-2xl border border-black/5 bg-white p-5">
            <div class="flex items-center justify-between">
                <span class="h-9 w-9 rounded-lg bg-emerald-700/10 text-emerald-700 flex items-center justify-center">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h13a2 2 0 0 1 2 2v13a1 1 0 0 1-1 1H6a2 2 0 0 1-2-2V4Z"/><path d="M8 8h8M8 12h8M8 16h4"/>
                    </svg>
                </span>
                <a href="{{ route('admin.berita.index') }}" class="text-xs text-emerald-700 hover:underline">Kelola →</a>
            </div>
            <p class="font-display text-3xl mt-4">{{ $stats['berita'] }}</p>
            <p class="text-sm text-ink/50">Berita</p>
        </div>

        <div class="rounded-2xl border border-black/5 bg-white p-5">
            <div class="flex items-center justify-between">
                <span class="h-9 w-9 rounded-lg bg-emerald-700/10 text-emerald-700 flex items-center justify-center">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15a2 2 0 0 1-2 2H8l-5 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2Z"/>
                    </svg>
                </span>
                <a href="{{ route('admin.testimoni.index') }}" class="text-xs text-emerald-700 hover:underline">Kelola →</a>
            </div>
            <p class="font-display text-3xl mt-4">{{ $stats['testimoni'] }}</p>
            <p class="text-sm text-ink/50">Testimoni</p>
        </div>

        <div class="rounded-2xl border border-black/5 bg-white p-5">
            <div class="flex items-center justify-between">
                <span class="h-9 w-9 rounded-lg bg-gold-500/10 text-gold-500 flex items-center justify-center">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="8" r="5"/><path d="M8.5 12.5 7 21l5-3 5 3-1.5-8.5"/>
                    </svg>
                </span>
                <a href="{{ route('admin.penghargaan.index') }}" class="text-xs text-emerald-700 hover:underline">Kelola →</a>
            </div>
            <p class="font-display text-3xl mt-4">{{ $stats['penghargaan'] }}</p>
            <p class="text-sm text-ink/50">Penghargaan</p>
        </div>

        <div class="rounded-2xl border border-black/5 bg-white p-5">
            <div class="flex items-center justify-between">
                <span class="h-9 w-9 rounded-lg bg-emerald-700/10 text-emerald-700 flex items-center justify-center">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 3v5h5"/><path d="M6 3h8l5 5v13a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Z"/><path d="M9 13h6M9 17h6"/>
                    </svg>
                </span>
                <a href="{{ route('admin.laporan-keuangan.index') }}" class="text-xs text-emerald-700 hover:underline">Kelola →</a>
            </div>
            <p class="font-display text-3xl mt-4">{{ $stats['laporan_keuangan'] }}</p>
            <p class="text-sm text-ink/50">Laporan Keuangan</p>
        </div>

        <div class="rounded-2xl border border-black/5 bg-white p-5">
            <div class="flex items-center justify-between">
                <span class="h-9 w-9 rounded-lg bg-emerald-700/10 text-emerald-700 flex items-center justify-center">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2 3 7l9 5 9-5-9-5Z"/><path d="M3 12l9 5 9-5"/><path d="M3 17l9 5 9-5"/>
                    </svg>
                </span>
                <a href="{{ route('admin.program-pokok.index') }}" class="text-xs text-emerald-700 hover:underline">Kelola →</a>
            </div>
            <p class="font-display text-3xl mt-4">{{ $stats['program_pokok'] }}</p>
            <p class="text-sm text-ink/50">Program Pokok</p>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">

        {{-- Recent berita --}}
        <div class="lg:col-span-2 rounded-2xl border border-black/5 bg-white p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-display text-lg">Berita Terbaru</h3>
                <a href="{{ route('admin.berita.index') }}" class="text-xs text-emerald-700 hover:underline">Lihat semua</a>
            </div>

            @forelse ($beritaTerbaru as $berita)
                <div class="flex items-center justify-between py-3 {{ !$loop->last ? 'border-b border-black/5' : '' }}">
                    <div class="flex items-center gap-3 min-w-0 pr-4">
                        @if ($berita->thumbnail)
                            <img src="{{ asset('storage/' . $berita->thumbnail) }}" alt="{{ $berita->judul }}"
                                 class="h-10 w-10 rounded-lg object-cover shrink-0 border border-black/5">
                        @else
                            <span class="h-10 w-10 rounded-lg bg-ink/5 text-ink/30 flex items-center justify-center shrink-0">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-5-5L5 21"/>
                                </svg>
                            </span>
                        @endif
                        <div class="min-w-0">
                            <p class="text-sm font-medium text-ink truncate">{{ $berita->judul }}</p>
                            <p class="text-xs text-ink/40 mt-0.5">{{ $berita->kategori }} · {{ $berita->tanggal_terbit->translatedFormat('d M Y') }}</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.berita.edit', $berita) }}" class="shrink-0 text-xs text-ink/50 hover:text-emerald-700">Edit</a>
                </div>
            @empty
                <div class="py-10 text-center">
                    <p class="text-sm text-ink/40">Belum ada berita yang dipublikasikan.</p>
                    <a href="{{ route('admin.berita.create') }}" class="inline-block mt-3 text-xs text-emerald-700 hover:underline">Tambah berita pertama →</a>
                </div>
            @endforelse
        </div>

        {{-- Quick links --}}
        <div class="rounded-2xl bg-emerald-950 text-emerald-50 p-6 flex flex-col justify-between">
            <div>
                <h3 class="font-display text-lg text-white">Akses Cepat</h3>
                <p class="text-sm text-emerald-100/60 mt-1">Kelola konten company profile.</p>
            </div>

            <div class="mt-6 space-y-2">
                <a href="{{ route('admin.berita.create') }}" class="flex items-center justify-between px-3 py-2.5 rounded-lg text-sm bg-white/5 hover:bg-white/10 transition">
                    Tambah Berita <span>+</span>
                </a>
                <a href="{{ route('admin.testimoni.create') }}" class="flex items-center justify-between px-3 py-2.5 rounded-lg text-sm bg-white/5 hover:bg-white/10 transition">
                    Tambah Testimoni <span>+</span>
                </a>
                <a href="{{ route('admin.program-pokok.create') }}" class="flex items-center justify-between px-3 py-2.5 rounded-lg text-sm bg-white/5 hover:bg-white/10 transition">
                    Tambah Program Pokok <span>+</span>
                </a>
                <a href="{{ route('admin.laporan-keuangan.create') }}" class="flex items-center justify-between px-3 py-2.5 rounded-lg text-sm bg-white/5 hover:bg-white/10 transition">
                    Unggah Laporan Keuangan <span>+</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-lg text-sm bg-white/5 hover:bg-white/10 transition">
                    Kelola Akun Admin <span>→</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection