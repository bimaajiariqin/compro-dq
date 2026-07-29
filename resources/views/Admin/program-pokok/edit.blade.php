@extends('Admin.layouts.app')

@section('title', 'Edit Program Pokok')
@section('breadcrumb', 'Konten / Program Pokok')
@section('page-title', 'Edit Program Pokok')

@section('content')
<div class="max-w-2xl">
    <div class="rounded-2xl border border-black/5 bg-white p-6">
        <form method="POST" action="{{ route('admin.program-pokok.update', $programPokok) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="kategori_program" class="block text-sm font-medium text-ink/70 mb-1.5">Kategori Program</label>
                <select id="kategori_program" name="kategori_program" required
                        class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                               focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                    <option value="" disabled>Pilih kategori</option>
                    @foreach ($kategoriOptions as $option)
                        <option value="{{ $option }}" {{ old('kategori_program', $programPokok->kategori_program) === $option ? 'selected' : '' }}>Peduli {{ $option }}</option>
                    @endforeach
                </select>
                @error('kategori_program') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                <p class="mt-1.5 text-xs text-ink/40">Menentukan program pokok ini muncul di halaman Program yang mana.</p>
            </div>

            <div>
                <label for="judul" class="block text-sm font-medium text-ink/70 mb-1.5">Judul</label>
                <input id="judul" name="judul" type="text" value="{{ old('judul', $programPokok->judul) }}" required autofocus
                       placeholder="Mis. Beasiswa Pendidikan"
                       class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm placeholder:text-ink/30
                              focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                @error('judul') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-medium text-ink/70 mb-1.5">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="3" required
                          placeholder="Deskripsi singkat program pokok ini..."
                          class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm placeholder:text-ink/30
                                 focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">{{ old('deskripsi', $programPokok->deskripsi) }}</textarea>
                @error('deskripsi') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="link" class="block text-sm font-medium text-ink/70 mb-1.5">Link Program (opsional)</label>
                <input id="link" name="link" type="url" value="{{ old('link', $programPokok->link) }}"
                       placeholder="https://contoh.com/program-ini"
                       class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm placeholder:text-ink/30
                              focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                @error('link') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                <p class="mt-1.5 text-xs text-ink/40">Kalau diisi, kartu program pokok ini bisa diklik menuju link tersebut. Kosongkan kalau tidak perlu.</p>
            </div>

            <div>
                @if ($programPokok->icon)
                    <label class="block text-sm font-medium text-ink/70 mb-1.5">Icon Saat Ini</label>
                    <img src="{{ asset('storage/' . $programPokok->icon) }}" alt="{{ $programPokok->judul }}"
                         class="h-14 w-14 rounded-lg object-cover border border-black/10 mb-3">
                @endif

                <label for="icon" class="block text-sm font-medium text-ink/70 mb-1.5">
                    {{ $programPokok->icon ? 'Ganti Icon (opsional)' : 'Icon (PNG/JPG)' }}
                </label>
                <input id="icon" name="icon" type="file" accept="image/png,image/jpeg"
                       class="w-full text-sm text-ink/60
                              file:mr-4 file:rounded-lg file:border-0 file:bg-emerald-700/10 file:px-4 file:py-2
                              file:text-sm file:font-medium file:text-emerald-800 hover:file:bg-emerald-700/20">
                @error('icon') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                <p class="mt-1.5 text-xs text-ink/40">Kosongkan jika tidak ingin mengganti icon. Format PNG atau JPG, maksimal 2MB.</p>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="rounded-xl bg-emerald-800 hover:bg-emerald-900 transition text-white text-sm font-medium px-5 py-2.5">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.program-pokok.index') }}" class="text-sm text-ink/50 hover:text-ink">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection