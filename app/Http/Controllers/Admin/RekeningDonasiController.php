<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RekeningDonasi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class RekeningDonasiController extends Controller
{
    public const KATEGORI = ['Infaq', 'Zakat', 'Wakaf'];

    /**
     * Folder tempat logo bank disimpan, relatif terhadap public/storage.
     * Sama seperti Berita/Penghargaan/Testimoni — disimpan langsung ke
     * folder nyata, tidak lewat symlink `storage:link`.
     */
    private const LOGO_FOLDER = 'rekening';

    public function index(): View
    {
        $rekening = RekeningDonasi::orderBy('kategori')->orderBy('nama_bank')->get();

        return view('Admin.rekening-donasi.index', compact('rekening'));
    }

    public function create(): View
    {
        return view('Admin.rekening-donasi.create', [
            'kategoriOptions' => self::KATEGORI,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);
        unset($validated['logo']);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $this->storeLogo($request);
        }

        RekeningDonasi::create($validated);

        return redirect()->route('admin.rekening-donasi.index')->with('success', 'Rekening berhasil ditambahkan.');
    }

    public function show(RekeningDonasi $rekening_donasi): RedirectResponse
    {
        return redirect()->route('admin.rekening-donasi.edit', $rekening_donasi);
    }

    public function edit(RekeningDonasi $rekening_donasi): View
    {
        return view('Admin.rekening-donasi.edit', [
            'rekening' => $rekening_donasi,
            'kategoriOptions' => self::KATEGORI,
        ]);
    }

    public function update(Request $request, RekeningDonasi $rekening_donasi): RedirectResponse
    {
        $validated = $this->validated($request);
        unset($validated['logo']);

        if ($request->hasFile('logo')) {
            $this->deleteLogo($rekening_donasi->logo);
            $validated['logo'] = $this->storeLogo($request);
        }

        $rekening_donasi->update($validated);

        return redirect()->route('admin.rekening-donasi.index')->with('success', 'Rekening berhasil diperbarui.');
    }

    public function destroy(RekeningDonasi $rekening_donasi): RedirectResponse
    {
        $this->deleteLogo($rekening_donasi->logo);

        $rekening_donasi->delete();

        return redirect()->route('admin.rekening-donasi.index')->with('success', 'Rekening berhasil dihapus.');
    }

    private function storeLogo(Request $request): string
    {
        $destinationPath = public_path('storage/' . self::LOGO_FOLDER);

        if (! File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        $file = $request->file('logo');
        $extension = strtolower($file->getClientOriginalExtension());
        $filename = uniqid() . '_' . time() . '.' . $extension;

        $file->move($destinationPath, $filename);

        return self::LOGO_FOLDER . '/' . $filename;
    }

    private function deleteLogo(?string $relativePath): void
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
            'kategori'    => ['required', 'in:' . implode(',', self::KATEGORI)],
            'nama_bank'   => ['required', 'string', 'max:150'],
            'no_rekening' => ['required', 'string', 'max:100'],
            'atas_nama'   => ['required', 'string', 'max:150'],
            'logo'        => [
                $request->isMethod('post') ? 'required' : 'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp,svg',
                'max:1024',
            ],
        ], [
            'kategori.required'    => 'Kategori wajib dipilih.',
            'kategori.in'          => 'Kategori tidak valid.',
            'nama_bank.required'   => 'Nama bank wajib diisi.',
            'no_rekening.required' => 'Nomor rekening wajib diisi.',
            'atas_nama.required'   => 'Atas nama wajib diisi.',
            'logo.required'        => 'Logo bank wajib diunggah.',
            'logo.image'           => 'File harus berupa gambar.',
            'logo.mimes'           => 'Format logo harus jpg, jpeg, png, webp, atau svg.',
            'logo.max'             => 'Ukuran logo maksimal 1MB.',
        ]);
    }
}