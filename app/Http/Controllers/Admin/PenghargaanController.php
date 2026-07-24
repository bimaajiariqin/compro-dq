<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penghargaan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class PenghargaanController extends Controller
{
    /**
     * Folder tempat dokumen disimpan, relatif terhadap public/storage.
     * Sama seperti Berita & Laporan Keuangan — disimpan langsung ke folder
     * nyata, tidak lewat symlink `storage:link`.
     */
    private const DOKUMEN_FOLDER = 'penghargaan';

    public function index(): View
    {
        $penghargaan = Penghargaan::orderByDesc('tanggal_terbit')->paginate(10);

        return view('admin.penghargaan.index', compact('penghargaan'));
    }

    public function create(): View
    {
        return view('admin.penghargaan.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);
        unset($validated['dokumen']);

        $validated['dokumen'] = $this->storeDokumen($request);

        Penghargaan::create($validated);

        return redirect()->route('admin.penghargaan.index')->with('success', 'Penghargaan berhasil ditambahkan.');
    }

    /**
     * No dedicated detail page — redirect to edit.
     */
    public function show(Penghargaan $penghargaan): RedirectResponse
    {
        return redirect()->route('admin.penghargaan.edit', $penghargaan);
    }

    public function edit(Penghargaan $penghargaan): View
    {
        return view('admin.penghargaan.edit', compact('penghargaan'));
    }

    public function update(Request $request, Penghargaan $penghargaan): RedirectResponse
    {
        $validated = $this->validated($request);
        unset($validated['dokumen']);

        if ($request->hasFile('dokumen')) {
            $this->deleteDokumen($penghargaan->dokumen);
            $validated['dokumen'] = $this->storeDokumen($request);
        }

        $penghargaan->update($validated);

        return redirect()->route('admin.penghargaan.index')->with('success', 'Penghargaan berhasil diperbarui.');
    }

    public function destroy(Penghargaan $penghargaan): RedirectResponse
    {
        $this->deleteDokumen($penghargaan->dokumen);

        $penghargaan->delete();

        return redirect()->route('admin.penghargaan.index')->with('success', 'Penghargaan berhasil dihapus.');
    }

    /**
     * Move the uploaded file straight into public/storage/penghargaan
     * (creating the folder first if it doesn't exist yet) — no symlink involved.
     * Returns the relative path stored in the database, e.g. "penghargaan/abcd1234.jpg".
     */
    private function storeDokumen(Request $request): string
    {
        $destinationPath = public_path('storage/' . self::DOKUMEN_FOLDER);

        if (! File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        $file = $request->file('dokumen');
        $extension = strtolower($file->getClientOriginalExtension());
        $filename = uniqid() . '_' . time() . '.' . $extension;

        $file->move($destinationPath, $filename);

        return self::DOKUMEN_FOLDER . '/' . $filename;
    }

    /**
     * Delete a previously stored dokumen file, if it exists.
     */
    private function deleteDokumen(?string $relativePath): void
    {
        if (! $relativePath) {
            return;
        }

        $fullPath = public_path('storage/' . $relativePath);

        if (File::exists($fullPath)) {
            File::delete($fullPath);
        }
    }

    /**
     * Shared validation rules for store & update.
     * `dokumen` accepts either an image or a PDF.
     */
    private function validated(Request $request): array
    {
        $currentYear = (int) date('Y');

        return $request->validate([
            'judul'          => ['required', 'string', 'max:255'],
            'tanggal_terbit' => ['required', 'date'],
            'tahun'          => ['required', 'integer', 'digits:4', 'min:2000', 'max:' . ($currentYear + 1)],
            'dokumen'        => [
                $request->isMethod('post') ? 'required' : 'nullable',
                'file',
                'mimes:jpg,jpeg,png,webp,pdf',
                'max:10240',
            ],
        ], [
            'judul.required'          => 'Judul wajib diisi.',
            'tanggal_terbit.required' => 'Tanggal terbit wajib diisi.',
            'tanggal_terbit.date'     => 'Tanggal terbit tidak valid.',
            'tahun.required'          => 'Tahun wajib diisi.',
            'tahun.integer'           => 'Tahun harus berupa angka.',
            'tahun.digits'            => 'Tahun harus terdiri dari 4 digit.',
            'tahun.min'               => 'Tahun tidak valid.',
            'tahun.max'               => 'Tahun tidak boleh lebih dari ' . ($currentYear + 1) . '.',
            'dokumen.required'        => 'Dokumen wajib diunggah.',
            'dokumen.file'            => 'File tidak valid.',
            'dokumen.mimes'           => 'Dokumen harus berformat JPG, PNG, WEBP, atau PDF.',
            'dokumen.max'             => 'Ukuran dokumen maksimal 10MB.',
        ]);
    }
}