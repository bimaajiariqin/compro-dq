@extends('Admin.layouts.app')

@section('title', 'Profil Kepengurusan')
@section('breadcrumb', 'Konten')
@section('page-title', 'Profil Kepengurusan')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between flex-wrap gap-3">
        <div>
            <h2 class="font-display text-2xl text-ink">Profil Kepengurusan</h2>
            <p class="text-sm text-ink/50 mt-1">Kelola struktur pengurus yang tampil di halaman Tentang Kami.</p>
        </div>
        <a href="{{ route('admin.pengurus.create') }}"
           class="inline-flex items-center gap-2 rounded-xl bg-emerald-800 hover:bg-emerald-900 transition text-white text-sm font-medium px-4 py-2.5">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Tambah Pengurus
        </a>
    </div>

    @if (session('success'))
        <div class="rounded-xl border border-emerald-700/20 bg-emerald-700/5 px-4 py-3 text-sm text-emerald-800">
            {{ session('success') }}
        </div>
    @endif

    @forelse ($pengurusList as $kelompok => $anggota)
        <div class="rounded-2xl border border-black/5 bg-white overflow-hidden">
            <div class="px-6 py-3 border-b border-black/5 bg-black/[0.02]">
                <h3 class="text-sm font-semibold text-ink">{{ $kelompok }}</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[640px] text-sm">
                    <thead>
                        <tr class="border-b border-black/5 text-left text-xs uppercase tracking-wide text-ink/40">
                            <th class="px-6 py-3 font-medium">Foto</th>
                            <th class="px-6 py-3 font-medium">Nama</th>
                            <th class="px-6 py-3 font-medium">Jabatan</th>
                            <th class="hidden sm:table-cell px-6 py-3 font-medium">Ketua</th>
                            <th class="hidden sm:table-cell px-6 py-3 font-medium">Urutan</th>
                            <th class="px-6 py-3 font-medium text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($anggota as $orang)
                            <tr class="border-b border-black/5 last:border-0">
                                <td class="px-6 py-4">
                                    @if ($orang->foto)
                                        <img src="{{ asset('storage/' . $orang->foto) }}" alt="{{ $orang->nama ?? 'Foto pengurus' }}"
                                             class="h-10 w-10 rounded-full object-cover border border-black/5">
                                    @else
                                        <span class="h-10 w-10 rounded-full bg-gold-500/10 text-gold-600 flex items-center justify-center text-xs">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-ink">{{ $orang->nama ?? '-' }}</td>
                                <td class="px-6 py-4 text-ink/70">{{ $orang->jabatan ?? '-' }}</td>
                                <td class="hidden sm:table-cell px-6 py-4">
                                    @if ($orang->is_ketua)
                                        <span class="inline-flex items-center rounded-full bg-emerald-700/10 text-emerald-800 text-xs px-2.5 py-1">Ketua</span>
                                    @else
                                        <span class="text-ink/30">—</span>
                                    @endif
                                </td>
                                <td class="hidden sm:table-cell px-6 py-4 text-ink/50">{{ $orang->urutan }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-3">
                                        <a href="{{ route('admin.pengurus.edit', $orang) }}" class="text-xs text-ink/50 hover:text-emerald-700">Edit</a>
                                        <form method="POST" action="{{ route('admin.pengurus.destroy', $orang) }}"
                                              onsubmit="return confirm('Hapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs text-red-500 hover:text-red-700">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @empty
        <div class="rounded-2xl border border-black/5 bg-white px-6 py-10 text-center text-sm text-ink/40">
            Belum ada data pengurus.
            <a href="{{ route('admin.pengurus.create') }}" class="text-emerald-700 hover:underline">Tambah pertama →</a>
        </div>
    @endforelse
</div>
@endsection