<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class TestimoniController extends Controller
{
    /**
     * Folder tempat foto profil disimpan, relatif terhadap public/storage.
     * Sama seperti Berita, Penghargaan & Laporan Keuangan — disimpan
     * langsung ke folder nyata, tidak lewat symlink `storage:link`.
     */
    private const FOTO_FOLDER = 'testimoni';

    public function index(): View
    {
        $testimoni = Testimoni::orderByDesc('created_at')->paginate(10);

        return view('Admin.testimoni.index', compact('testimoni'));
    }

    public function create(): View
    {
        return view('Admin.testimoni.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);
        unset($validated['foto_profil']);

        $validated['foto_profil'] = $this->storeFoto($request);

        Testimoni::create($validated);

        return redirect()->route('testimoni.index')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    /**
     * No dedicated detail page — redirect to edit.
     */
    public function show(Testimoni $testimoni): RedirectResponse
    {
        return redirect()->route('testimoni.edit', $testimoni);
    }

    public function edit(Testimoni $testimoni): View
    {
        return view('Admin.testimoni.edit', compact('testimoni'));
    }

    public function update(Request $request, Testimoni $testimoni): RedirectResponse
    {
        $validated = $this->validated($request);
        unset($validated['foto_profil']);

        if ($request->hasFile('foto_profil')) {
            $this->deleteFoto($testimoni->foto_profil);
            $validated['foto_profil'] = $this->storeFoto($request);
        }

        $testimoni->update($validated);

        return redirect()->route('testimoni.index')->with('success', 'Testimoni berhasil diperbarui.');
    }

    public function destroy(Testimoni $testimoni): RedirectResponse
    {
        $this->deleteFoto($testimoni->foto_profil);

        $testimoni->delete();

        return redirect()->route('testimoni.index')->with('success', 'Testimoni berhasil dihapus.');
    }

    /**
     * Move the uploaded photo straight into public/storage/testimoni
     * (creating the folder first if it doesn't exist yet) — no symlink involved.
     * Returns the relative path stored in the database, e.g. "testimoni/abcd1234.webp".
     */
    private function storeFoto(Request $request): string
    {
        $destinationPath = public_path('storage/' . self::FOTO_FOLDER);

        if (! File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        $file = $request->file('foto_profil');
        $extension = strtolower($file->getClientOriginalExtension());
        $filename = uniqid() . '_' . time() . '.' . $extension;

        $file->move($destinationPath, $filename);

        return self::FOTO_FOLDER . '/' . $filename;
    }

    /**
     * Delete a previously stored photo file, if it exists.
     */
    private function deleteFoto(?string $relativePath): void
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
        return $request->validate([
            'nama'          => ['required', 'string', 'max:150'],
            'jabatan'       => ['required', 'string', 'max:150'],
            'isi_testimoni' => ['required', 'string'],
            'foto_profil'   => [
                $request->isMethod('post') ? 'required' : 'nullable',
                'file',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ], [
            'nama.required'          => 'Nama wajib diisi.',
            'jabatan.required'       => 'Jabatan wajib diisi.',
            'isi_testimoni.required' => 'Isi testimoni wajib diisi.',
            'foto_profil.required'   => 'Foto profil wajib diunggah.',
            'foto_profil.file'       => 'File tidak valid.',
            'foto_profil.mimes'      => 'Format gambar harus jpg, jpeg, png, atau webp.',
            'foto_profil.max'        => 'Ukuran gambar maksimal 2MB.',
        ]);
    }
}