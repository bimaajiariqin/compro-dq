@extends('Admin.layouts.app')

@section('title', 'Testimoni')
@section('breadcrumb', 'Konten')
@section('page-title', 'Testimoni')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between flex-wrap gap-3">
        <div>
            <h2 class="font-display text-2xl text-ink">Testimoni</h2>
            <p class="text-sm text-ink/50 mt-1">Kelola testimoni yang tampil di halaman company profile.</p>
        </div>
        <a href="{{ route('testimoni.create') }}"
           class="inline-flex items-center gap-2 rounded-xl bg-emerald-800 hover:bg-emerald-900 transition text-white text-sm font-medium px-4 py-2.5">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Tambah Testimoni
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
                        <th class="px-6 py-3 font-medium">Orang</th>
                        <th class="px-6 py-3 font-medium">Testimoni</th>
                        <th class="hidden sm:table-cell px-6 py-3 font-medium">Ditambahkan</th>
                        <th class="px-6 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($testimoni as $item)
                        <tr class="border-b border-black/5 last:border-0 align-top">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ asset('storage/' . $item->foto_profil) }}" alt="{{ $item->nama }}"
                                         class="h-11 w-11 rounded-full object-cover shrink-0 border border-black/5">
                                    <div class="min-w-0">
                                        <p class="font-medium text-ink truncate">{{ $item->nama }}</p>
                                        <p class="text-xs text-ink/40 truncate">{{ $item->jabatan }}</p>
                                        <p class="sm:hidden text-xs text-ink/40 mt-0.5">
                                            {{ $item->created_at?->translatedFormat('d M Y') }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-ink/60 max-w-[220px] sm:max-w-sm">
                                {{ \Illuminate\Support\Str::limit($item->isi_testimoni, 90) }}
                            </td>
                            <td class="hidden sm:table-cell px-6 py-4 text-ink/50 whitespace-nowrap">
                                {{ $item->created_at?->translatedFormat('d M Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('testimoni.edit', $item) }}" class="text-xs text-ink/50 hover:text-emerald-700">Edit</a>
                                    <form method="POST" action="{{ route('testimoni.destroy', $item) }}"
                                          onsubmit="return confirm('Hapus testimoni dari {{ $item->nama }}? Tindakan ini tidak bisa dibatalkan.');">
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
                                Belum ada testimoni.
                                <a href="{{ route('testimoni.create') }}" class="text-emerald-700 hover:underline">Tambah testimoni pertama →</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($testimoni->hasPages())
        <div>{{ $testimoni->links() }}</div>
    @endif

</div>
@endsection