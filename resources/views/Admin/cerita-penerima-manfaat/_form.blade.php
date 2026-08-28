@php $isEdit = isset($item); @endphp

@if ($errors->any())
    <div class="rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 mb-6">
        <p class="font-medium mb-1">Periksa kembali input berikut:</p>
        <ul class="list-disc list-inside space-y-0.5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid gap-6 lg:grid-cols-3">

    {{-- Foto --}}
    <div class="lg:col-span-1 rounded-2xl border border-black/5 bg-white p-6">
        <label class="block text-sm font-medium text-ink mb-3">Foto</label>

        <div class="aspect-square w-full rounded-xl bg-ink/5 border border-dashed border-black/10 overflow-hidden flex items-center justify-center mb-3"
             id="foto-preview-wrap">
            @if ($isEdit && $item->foto)
                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}" id="foto-preview" class="h-full w-full object-cover">
            @else
                <svg id="foto-placeholder" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="text-ink/20">
                    <rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-5-5L5 21"/>
                </svg>
                <img src="" alt="" id="foto-preview" class="h-full w-full object-cover hidden">
            @endif
        </div>

        <input type="file" name="foto" accept="image/*" onchange="previewFoto(this)"
               class="block w-full text-xs text-ink/60 file:mr-3 file:rounded-lg file:border-0 file:bg-emerald-700/10 file:text-emerald-700 file:text-xs file:font-medium file:px-3 file:py-2 hover:file:bg-emerald-700/20">
        <p class="text-xs text-ink/40 mt-2">Format JPG/PNG, rasio 1:1 disarankan.</p>
    </div>

    {{-- Detail --}}
    <div class="lg:col-span-2 space-y-6">

        <div class="rounded-2xl border border-black/5 bg-white p-6 space-y-5">
            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-ink mb-1.5">Nama</label>
                    <input type="text" name="nama" value="{{ old('nama', $item->nama ?? '') }}"
                           class="w-full rounded-lg border border-black/10 text-sm px-3 py-2.5 text-ink focus:outline-none focus:ring-2 focus:ring-emerald-700/20"
                           placeholder="Nama penerima manfaat">
                </div>
                <div>
                    <label class="block text-sm font-medium text-ink mb-1.5">Jabatan / Peran</label>
                    <input type="text" name="jabatan" value="{{ old('jabatan', $item->jabatan ?? '') }}"
                           class="w-full rounded-lg border border-black/10 text-sm px-3 py-2.5 text-ink focus:outline-none focus:ring-2 focus:ring-emerald-700/20"
                           placeholder="mis. Penerima Beasiswa">
                </div>
            </div>

            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-ink mb-1.5">Kategori Program</label>
                    <select name="kategori_program"
                            class="w-full rounded-lg border border-black/10 text-sm px-3 py-2.5 text-ink focus:outline-none focus:ring-2 focus:ring-emerald-700/20">
                        <option value="">Pilih kategori</option>
                        @foreach ($kategoriOptions as $kategori)
                            <option value="{{ $kategori }}" @selected(old('kategori_program', $item->kategori_program ?? '') === $kategori)>
                                {{ $kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-ink mb-1.5">Urutan</label>
                    <input type="number" name="urutan" min="0" value="{{ old('urutan', $item->urutan ?? 0) }}"
                           class="w-full rounded-lg border border-black/10 text-sm px-3 py-2.5 text-ink focus:outline-none focus:ring-2 focus:ring-emerald-700/20">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-ink mb-1.5">Cerita</label>
                <textarea name="isi_cerita" rows="6"
                          class="w-full rounded-lg border border-black/10 text-sm px-3 py-2.5 text-ink focus:outline-none focus:ring-2 focus:ring-emerald-700/20"
                          placeholder="Tuliskan kisah penerima manfaat...">{{ old('isi_cerita', $item->isi_cerita ?? '') }}</textarea>
            </div>

            <label class="flex items-center gap-2.5 cursor-pointer w-fit">
                <input type="checkbox" name="is_active" value="1"
                       @checked(old('is_active', $item->is_active ?? true))
                       class="h-4 w-4 rounded border-black/20 text-emerald-700 focus:ring-emerald-700/20">
                <span class="text-sm text-ink">Tampilkan di halaman publik</span>
            </label>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit"
                    class="rounded-lg bg-emerald-700 text-white text-sm font-medium px-5 py-2.5 hover:bg-emerald-800 transition">
                {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Cerita' }}
            </button>
            <a href="{{ route('admin.cerita-penerima-manfaat.index') }}"
               class="rounded-lg border border-black/10 text-ink/60 text-sm font-medium px-5 py-2.5 hover:bg-ink/5 transition">
                Batal
            </a>
        </div>
    </div>
</div>

<script>
function previewFoto(input) {
    const preview = document.getElementById('foto-preview');
    const placeholder = document.getElementById('foto-placeholder');
    if (input.files && input.files[0]) {
        preview.src = URL.createObjectURL(input.files[0]);
        preview.classList.remove('hidden');
        if (placeholder) placeholder.classList.add('hidden');
    }
}
</script>