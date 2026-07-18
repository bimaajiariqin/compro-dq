<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LaporanKeuangan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class LaporanKeuanganController extends Controller
{
    /**
     * Folder tempat dokumen PDF disimpan, relatif terhadap public/storage.
     * Sama seperti Berita — disimpan langsung ke folder nyata, tidak lewat symlink.
     */
    private const DOKUMEN_FOLDER = 'laporan-keuangan';

    public function index(): View
    {
        $laporan = LaporanKeuangan::orderByDesc('tahun')->paginate(10);

        return view('Admin.laporan-keuangan.index', compact('laporan'));
    }

    public function create(): View
    {
        return view('Admin.laporan-keuangan.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);
        unset($validated['dokumen']);

        $validated['link_dokumen'] = $this->storeDokumen($request);

        LaporanKeuangan::create($validated);

        return redirect()->route('laporan-keuangan.index')->with('success', 'Laporan keuangan berhasil ditambahkan.');
    }

    /**
     * No dedicated detail page — redirect to edit.
     */
    public function show(LaporanKeuangan $laporan_keuangan): RedirectResponse
    {
        return redirect()->route('laporan-keuangan.edit', $laporan_keuangan);
    }

    public function edit(LaporanKeuangan $laporan_keuangan): View
    {
        return view('Admin.laporan-keuangan.edit', ['laporan' => $laporan_keuangan]);
    }

    public function update(Request $request, LaporanKeuangan $laporan_keuangan): RedirectResponse
    {
        $validated = $this->validated($request, $laporan_keuangan->id);
        unset($validated['dokumen']);

        if ($request->hasFile('dokumen')) {
            $this->deleteDokumen($laporan_keuangan->link_dokumen);
            $validated['link_dokumen'] = $this->storeDokumen($request);
        }

        $laporan_keuangan->update($validated);

        return redirect()->route('laporan-keuangan.index')->with('success', 'Laporan keuangan berhasil diperbarui.');
    }

    public function destroy(LaporanKeuangan $laporan_keuangan): RedirectResponse
    {
        $this->deleteDokumen($laporan_keuangan->link_dokumen);

        $laporan_keuangan->delete();

        return redirect()->route('laporan-keuangan.index')->with('success', 'Laporan keuangan berhasil dihapus.');
    }

    /**
     * Move the uploaded PDF straight into public/storage/laporan-keuangan
     * (creating the folder first if it doesn't exist yet) — no symlink involved.
     * Returns the relative path stored in the database, e.g. "laporan-keuangan/abcd1234.pdf".
     */
    private function storeDokumen(Request $request): string
    {
        $destinationPath = public_path('storage/' . self::DOKUMEN_FOLDER);

        if (! File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        $file = $request->file('dokumen');
        $filename = uniqid() . '_' . time() . '.pdf';

        $file->move($destinationPath, $filename);

        return self::DOKUMEN_FOLDER . '/' . $filename;
    }

    /**
     * Delete a previously stored PDF file, if it exists.
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
     * `dokumen` (the uploaded file) is required on create, optional on update.
     */
    private function validated(Request $request, ?int $ignoreId = null): array
    {
        $currentYear = (int) date('Y');

        return $request->validate([
            'tahun'    => [
                'required',
                'integer',
                'digits:4',
                'min:2000',
                'max:' . ($currentYear + 1),
                'unique:laporan_keuangan,tahun' . ($ignoreId ? ',' . $ignoreId : ''),
            ],
            'dokumen' => [
                $request->isMethod('post') ? 'required' : 'nullable',
                'file',
                'mimes:pdf',
                'max:10240',
            ],
        ], [
            'tahun.required' => 'Tahun wajib diisi.',
            'tahun.integer'  => 'Tahun harus berupa angka.',
            'tahun.digits'   => 'Tahun harus terdiri dari 4 digit.',
            'tahun.min'      => 'Tahun tidak valid.',
            'tahun.max'      => 'Tahun tidak boleh lebih dari ' . ($currentYear + 1) . '.',
            'tahun.unique'   => 'Laporan keuangan untuk tahun ini sudah ada.',
            'dokumen.required' => 'Dokumen PDF wajib diunggah.',
            'dokumen.file'      => 'File tidak valid.',
            'dokumen.mimes'     => 'Dokumen harus berformat PDF.',
            'dokumen.max'       => 'Ukuran dokumen maksimal 10MB.',
        ]);
    }
}