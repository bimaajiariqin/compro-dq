@php
    $faq = $faq ?? null;
@endphp

@if ($errors->any())
    <div class="mb-5 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3">
        <ul class="list-disc pl-4 space-y-0.5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="space-y-5">
    <div>
        <label for="kategori_program" class="block text-sm font-medium text-ink/70 mb-1.5">Kategori Program</label>
        <select id="kategori_program" name="kategori_program" required
                class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                       focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
            <option value="" disabled {{ old('kategori_program', $faq->kategori_program ?? '') ? '' : 'selected' }}>-- Pilih Kategori --</option>
            @foreach ($kategoriList as $kategori)
                <option value="{{ $kategori }}"
                    @selected(old('kategori_program', $faq->kategori_program ?? '') === $kategori)>
                    {{ $kategori }}
                </option>
            @endforeach
        </select>
        @error('kategori_program') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="pertanyaan" class="block text-sm font-medium text-ink/70 mb-1.5">Pertanyaan</label>
        <input id="pertanyaan" name="pertanyaan" type="text" maxlength="255" required
               value="{{ old('pertanyaan', $faq->pertanyaan ?? '') }}"
               placeholder="Contoh: Siapa penerima manfaat program?"
               class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm placeholder:text-ink/30
                      focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
        @error('pertanyaan') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="jawaban" class="block text-sm font-medium text-ink/70 mb-1.5">Jawaban</label>
        <textarea id="jawaban" name="jawaban" rows="5" required
                  placeholder="Tulis jawaban lengkap di sini..."
                  class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm placeholder:text-ink/30
                         focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">{{ old('jawaban', $faq->jawaban ?? '') }}</textarea>
        @error('jawaban') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="grid sm:grid-cols-2 gap-5 items-end">
        <div>
            <label for="urutan" class="block text-sm font-medium text-ink/70 mb-1.5">Urutan Tampil</label>
            <input id="urutan" name="urutan" type="number" min="0"
                   value="{{ old('urutan', $faq->urutan ?? 0) }}"
                   class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                          focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
            @error('urutan') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center pb-2.5">
            <label class="flex items-center gap-2 text-sm text-ink/70">
                <input type="checkbox" name="is_active" value="1"
                       @checked(old('is_active', $faq->is_active ?? true))
                       class="rounded border-black/20 text-emerald-700 focus:ring-emerald-700/30">
                Tampilkan di halaman program
            </label>
        </div>
    </div>
</div>