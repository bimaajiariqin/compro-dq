<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class BeritaController extends Controller
{
    public const KATEGORI = ['Inspirasi', 'Kegiatan', 'Informasi'];
    public const FILTER_PROGRAM = ['Pendidikan', 'Ekonomi', 'Dakwah', 'Kemanusiaan'];

    /**
     * Folder tempat thumbnail disimpan, relatif terhadap public/storage.
     */
    private const THUMBNAIL_FOLDER = 'berita';

    public function index(): View
    {
        $berita = Berita::orderByDesc('tanggal_terbit')->paginate(10);

        return view('Admin.berita.index', compact('berita'));
    }

    public function create(): View
    {
        return view('Admin.berita.create', [
            'kategoriOptions' => self::KATEGORI,
            'filterProgramOptions' => self::FILTER_PROGRAM,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $this->storeThumbnail($request);
        }

        Berita::create($validated);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function show(Berita $berita): RedirectResponse
    {
        return redirect()->route('berita.edit', $berita);
    }

    public function edit(Berita $berita): View
    {
        return view('Admin.berita.edit', [
            'berita' => $berita,
            'kategoriOptions' => self::KATEGORI,
            'filterProgramOptions' => self::FILTER_PROGRAM,
        ]);
    }

    public function update(Request $request, Berita $berita): RedirectResponse
    {
        $validated = $this->validated($request);

        if ($request->hasFile('thumbnail')) {
            $this->deleteThumbnail($berita->thumbnail);
            $validated['thumbnail'] = $this->storeThumbnail($request);
        }

        $berita->update($validated);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita): RedirectResponse
    {
        $this->deleteThumbnail($berita->thumbnail);

        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus.');
    }

    /**
     * Move the uploaded thumbnail straight into public/storage/berita
     * (creating the folder first if it doesn't exist yet) — no symlink involved.
     * Returns the relative path stored in the database, e.g. "berita/abcd1234.webp".
     */
    private function storeThumbnail(Request $request): string
    {
        $destinationPath = public_path('storage/' . self::THUMBNAIL_FOLDER);

        if (! File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        $file = $request->file('thumbnail');
        $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();

        $file->move($destinationPath, $filename);

        return self::THUMBNAIL_FOLDER . '/' . $filename;
    }

    /**
     * Delete a previously stored thumbnail file, if it exists.
     */
    private function deleteThumbnail(?string $relativePath): void
    {
        if (! $relativePath) {
            return;
        }

        $fullPath = public_path('storage/' . $relativePath);

        if (File::exists($fullPath)) {
            File::delete($fullPath);
        }
    }

    private function validated(Request $request): array
    {
        $rules = [
            'judul'          => ['required', 'string', 'max:255'],
            'nama_penerbit'  => ['required', 'string', 'max:150'],
            'tanggal_terbit' => ['required', 'date'],
            'kategori'       => ['required', 'in:' . implode(',', self::KATEGORI)],
            'filter_program' => ['required', 'in:' . implode(',', self::FILTER_PROGRAM)],
            'deskripsi'      => ['required', 'string'],
            'thumbnail'      => [
                $request->isMethod('post') ? 'required' : 'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ];

        return $request->validate($rules, [
            'judul.required'          => 'Judul wajib diisi.',
            'nama_penerbit.required'  => 'Nama penerbit wajib diisi.',
            'tanggal_terbit.required' => 'Tanggal terbit wajib diisi.',
            'tanggal_terbit.date'     => 'Tanggal terbit tidak valid.',
            'kategori.required'       => 'Kategori wajib dipilih.',
            'kategori.in'             => 'Kategori tidak valid.',
            'filter_program.required' => 'Filter program wajib dipilih.',
            'filter_program.in'       => 'Filter program tidak valid.',
            'deskripsi.required'      => 'Deskripsi wajib diisi.',
            'thumbnail.required'      => 'Thumbnail wajib diunggah.',
            'thumbnail.image'         => 'File harus berupa gambar.',
            'thumbnail.mimes'         => 'Format gambar harus jpg, jpeg, png, atau webp.',
            'thumbnail.max'           => 'Ukuran gambar maksimal 2MB.',
        ]);
    }
}