@extends('Admin.layouts.app')

@section('title', 'FAQ Program')
@section('breadcrumb', 'Konten / FAQ Program')
@section('page-title', 'FAQ Program')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div></div>
    <a href="{{ route('admin.faq.create') }}"
       class="rounded-xl bg-emerald-800 hover:bg-emerald-900 transition text-white text-sm font-medium px-5 py-2.5">
        + Tambah FAQ
    </a>
</div>

@if (session('success'))
    <div class="mb-5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm px-4 py-3">
        {{ session('success') }}
    </div>
@endif

<div class="flex flex-wrap gap-2 mb-6">
    <a href="{{ route('admin.faq.index') }}"
       class="px-4 py-1.5 rounded-full text-xs font-medium border transition
              {{ $kategoriAktif ? 'border-black/10 text-ink/60 hover:bg-black/5' : 'bg-emerald-800 border-emerald-800 text-white' }}">
        Semua
    </a>
    @foreach ($kategoriList as $kategori)
        <a href="{{ route('admin.faq.index', ['kategori' => $kategori]) }}"
           class="px-4 py-1.5 rounded-full text-xs font-medium border transition
                  {{ $kategoriAktif === $kategori ? 'bg-emerald-800 border-emerald-800 text-white' : 'border-black/10 text-ink/60 hover:bg-black/5' }}">
            {{ $kategori }}
        </a>
    @endforeach
</div>

@forelse ($faqs as $kategori => $items)
    <div class="rounded-2xl border border-black/5 bg-white mb-6 overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b border-black/5">
            <h2 class="text-sm font-semibold text-ink">{{ $kategori }}</h2>
            <span class="text-xs text-ink/40">{{ $items->count() }} FAQ</span>
        </div>

        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-xs text-ink/40 border-b border-black/5">
                    <th class="px-6 py-3 font-medium w-16">Urutan</th>
                    <th class="px-6 py-3 font-medium">Pertanyaan</th>
                    <th class="px-6 py-3 font-medium w-28">Status</th>
                    <th class="px-6 py-3 font-medium w-40">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr class="border-b border-black/5 last:border-0">
                        <td class="px-6 py-3 text-ink/60">{{ $item->urutan }}</td>
                        <td class="px-6 py-3 text-ink">{{ $item->pertanyaan }}</td>
                        <td class="px-6 py-3">
                            @if ($item->is_active)
                                <span class="inline-flex items-center rounded-full bg-emerald-50 text-emerald-700 text-xs font-medium px-2.5 py-1">Aktif</span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-black/5 text-ink/50 text-xs font-medium px-2.5 py-1">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-6 py-3">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.faq.edit', $item) }}" class="text-emerald-700 hover:text-emerald-900 font-medium">Edit</a>
                                <form action="{{ route('admin.faq.destroy', $item) }}" method="POST"
                                      onsubmit="return confirm('Hapus FAQ ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@empty
    <div class="rounded-2xl border border-black/5 bg-white py-16 text-center text-sm text-ink/40">
        Belum ada FAQ. Klik "Tambah FAQ" untuk membuat yang pertama.
    </div>
@endforelse
@endsection