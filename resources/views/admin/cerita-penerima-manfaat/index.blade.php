@extends('admin.layouts.app')

@section('title', 'Cerita Penerima Manfaat')
@section('breadcrumb', 'Admin')
@section('page-title', 'Cerita Penerima Manfaat')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <h2 class="font-display text-2xl text-ink">Cerita Penerima Manfaat</h2>
            <p class="text-sm text-ink/50 mt-1">Kelola testimoni & kisah para penerima manfaat program.</p>
        </div>
        <a href="{{ route('admin.cerita-penerima-manfaat.create') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-emerald-700 text-white text-sm font-medium px-4 py-2.5 hover:bg-emerald-800 transition shrink-0">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
            Tambah Cerita
        </a>
    </div>

    @if (session('success'))
        <div class="rounded-xl bg-emerald-700/10 border border-emerald-700/20 text-emerald-800 text-sm px-4 py-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="rounded-2xl border border-black/5 bg-white p-4 sm:p-6">

        <form method="GET" action="{{ route('admin.cerita-penerima-manfaat.index') }}" class="mb-5">
            <select name="kategori_program" onchange="this.form.submit()"
                    class="w-full sm:w-64 rounded-lg border border-black/10 text-sm px-3 py-2 text-ink focus:outline-none focus:ring-2 focus:ring-emerald-700/20">
                <option value="">Semua Kategori Program</option>
                @foreach ($kategoriOptions as $kategori)
                    <option value="{{ $kategori }}" @selected($filterKategori === $kategori)>{{ $kategori }}</option>
                @endforeach
            </select>
        </form>

        <div class="overflow-x-auto -mx-4 sm:mx-0">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-xs text-ink/40 uppercase tracking-wide border-b border-black/5">
                        <th class="py-3 px-4 sm:px-0 font-medium">Foto</th>
                        <th class="py-3 px-4 font-medium">Nama</th>
                        <th class="py-3 px-4 font-medium">Jabatan</th>
                        <th class="py-3 px-4 font-medium">Kategori Program</th>
                        <th class="py-3 px-4 font-medium text-center">Urutan</th>
                        <th class="py-3 px-4 font-medium text-center">Status</th>
                        <th class="py-3 px-4 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cerita as $item)
                        <tr class="border-b border-black/5 last:border-0 hover:bg-ink/[0.02]">
                            <td class="py-3 px-4 sm:px-0">
                                @if ($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}"
                                         class="h-11 w-11 rounded-full object-cover border border-black/5">
                                @else
                                    <span class="h-11 w-11 rounded-full bg-emerald-700/10 text-emerald-700 flex items-center justify-center font-display text-sm">
                                        {{ strtoupper(substr($item->nama, 0, 1)) }}
                                    </span>
                                @endif
                            </td>
                            <td class="py-3 px-4 font-medium text-ink">{{ $item->nama }}</td>
                            <td class="py-3 px-4 text-ink/60">{{ $item->jabatan ?: '—' }}</td>
                            <td class="py-3 px-4 text-ink/60">{{ $item->kategori_program }}</td>
                            <td class="py-3 px-4 text-center text-ink/60">{{ $item->urutan }}</td>
                            <td class="py-3 px-4 text-center">
                                @if ($item->is_active)
                                    <span class="inline-flex items-center rounded-full bg-emerald-700/10 text-emerald-700 text-xs font-medium px-2.5 py-1">Aktif</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-ink/5 text-ink/40 text-xs font-medium px-2.5 py-1">Nonaktif</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('admin.cerita-penerima-manfaat.edit', $item) }}"
                                       class="text-xs text-ink/50 hover:text-emerald-700">Edit</a>
                                    <form action="{{ route('admin.cerita-penerima-manfaat.destroy', $item) }}"
                                          method="POST" onsubmit="return confirm('Hapus cerita dari {{ $item->nama }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs text-red-600/70 hover:text-red-600">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-10 text-center">
                                <p class="text-sm text-ink/40">Belum ada cerita penerima manfaat.</p>
                                <a href="{{ route('admin.cerita-penerima-manfaat.create') }}" class="inline-block mt-3 text-xs text-emerald-700 hover:underline">
                                    Tambah cerita pertama →
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($cerita instanceof \Illuminate\Pagination\LengthAwarePaginator && $cerita->hasPages())
            <div class="mt-5 pt-4 border-t border-black/5">
                {{ $cerita->links() }}
            </div>
        @endif
    </div>
</div>
@endsection