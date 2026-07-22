@extends('Admin.layouts.app')

@section('title', 'Tambah Berita')
@section('breadcrumb', 'Konten / Berita')
@section('page-title', 'Tambah Berita')

@section('content')
<div class="max-w-2xl">
    <div class="rounded-2xl border border-black/5 bg-white p-6">
        <form id="berita-form" method="POST" action="{{ route('admin.berita.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label for="judul" class="block text-sm font-medium text-ink/70 mb-1.5">Judul</label>
                <input id="judul" name="judul" type="text" value="{{ old('judul') }}" required autofocus
                       placeholder="Judul berita"
                       class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm placeholder:text-ink/30
                              focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                @error('judul') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="thumbnail" class="block text-sm font-medium text-ink/70 mb-1.5">Thumbnail</label>
                <input id="thumbnail" name="thumbnail" type="file" accept="image/png,image/jpeg,image/webp" required
                       class="w-full text-sm text-ink/60
                              file:mr-4 file:rounded-lg file:border-0 file:bg-emerald-700/10 file:px-4 file:py-2
                              file:text-sm file:font-medium file:text-emerald-800 hover:file:bg-emerald-700/20">
                @error('thumbnail') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                <p class="mt-1.5 text-xs text-ink/40">JPG, PNG, atau WEBP. Maksimal 2MB.</p>
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label for="nama_penerbit" class="block text-sm font-medium text-ink/70 mb-1.5">Nama Penerbit</label>
                    <input id="nama_penerbit" name="nama_penerbit" type="text" value="{{ old('nama_penerbit') }}" required
                           placeholder="Mis. Tim Media DQ"
                           class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm placeholder:text-ink/30
                                  focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                    @error('nama_penerbit') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="tanggal_terbit" class="block text-sm font-medium text-ink/70 mb-1.5">Tanggal Terbit</label>
                    <input id="tanggal_terbit" name="tanggal_terbit" type="date" value="{{ old('tanggal_terbit') }}" required
                           class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                    @error('tanggal_terbit') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label for="kategori" class="block text-sm font-medium text-ink/70 mb-1.5">Kategori</label>
                    <select id="kategori" name="kategori" required
                            class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                                   focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                        <option value="" disabled {{ old('kategori') ? '' : 'selected' }}>Pilih kategori</option>
                        @foreach ($kategoriOptions as $option)
                            <option value="{{ $option }}" {{ old('kategori') === $option ? 'selected' : '' }}>{{ $option }}</option>
                        @endforeach
                    </select>
                    @error('kategori') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="filter_program" class="block text-sm font-medium text-ink/70 mb-1.5">Filter Program</label>
                    <select id="filter_program" name="filter_program" required
                            class="w-full rounded-xl border border-black/10 bg-white px-4 py-2.5 text-sm
                                   focus:outline-none focus:ring-2 focus:ring-emerald-700/30 focus:border-emerald-700">
                        <option value="" disabled {{ old('filter_program') ? '' : 'selected' }}>Pilih program</option>
                        @foreach ($filterProgramOptions as $option)
                            <option value="{{ $option }}" {{ old('filter_program') === $option ? 'selected' : '' }}>{{ $option }}</option>
                        @endforeach
                    </select>
                    @error('filter_program') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-ink/70 mb-1.5">Deskripsi</label>

                <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">

                <div class="rounded-xl border border-black/10 overflow-hidden focus-within:ring-2 focus-within:ring-emerald-700/30 focus-within:border-emerald-700">
                    <div id="editor-deskripsi" style="min-height:280px;" class="bg-white text-sm">{!! old('deskripsi') !!}</div>
                </div>
                <textarea name="deskripsi" id="deskripsi" hidden>{{ old('deskripsi') }}</textarea>

                @error('deskripsi') <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="rounded-xl bg-emerald-800 hover:bg-emerald-900 transition text-white text-sm font-medium px-5 py-2.5">
                    Simpan
                </button>
                <a href="{{ route('admin.berita.index') }}" class="text-sm text-ink/50 hover:text-ink">Batal</a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
<script>
(function () {
    const hiddenTextarea = document.getElementById('deskripsi');
    const form = document.getElementById('berita-form');

    const quillEditor = new Quill('#editor-deskripsi', {
        theme: 'snow',
        placeholder: 'Tulis isi berita di sini...',
        modules: {
            toolbar: {
                container: [
                    [{ header: [2, 3, false] }],
                    ['bold', 'italic', 'underline'],
                    ['blockquote'],
                    [{ list: 'ordered' }, { list: 'bullet' }],
                    ['link', 'image'],
                    ['clean'],
                ],
                handlers: { image: imageHandler },
            },
        },
    });

    quillEditor.on('text-change', function () {
        hiddenTextarea.value = quillEditor.root.innerHTML;
    });
    hiddenTextarea.value = quillEditor.root.innerHTML;

    function imageHandler() {
        const input = document.createElement('input');
        input.type = 'file';
        input.accept = 'image/*';
        input.click();

        input.onchange = async () => {
            const formData = new FormData();
            formData.append('image', input.files[0]);

            try {
                const res = await fetch('{{ route('admin.berita.upload-gambar') }}', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: formData,
                });

                if (!res.ok) {
                    console.error('Upload gagal, status:', res.status);
                    alert('Gagal upload gambar. Cek console untuk detail.');
                    return;
                }

                const data = await res.json();
                const range = quillEditor.getSelection(true) || { index: quillEditor.getLength() };
                quillEditor.insertEmbed(range.index, 'image', data.location, 'user');
                quillEditor.setSelection(range.index + 1);
            } catch (err) {
                console.error('Upload error:', err);
                alert('Terjadi error saat upload gambar. Cek console.');
            }
        };
    }

    form.addEventListener('submit', function () {
        hiddenTextarea.value = quillEditor.root.innerHTML;
        console.log('Deskripsi yang dikirim:', hiddenTextarea.value);
    });
})();
</script>
@endsection