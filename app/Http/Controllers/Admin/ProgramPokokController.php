<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramPokok;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProgramPokokController extends Controller
{
    protected array $kategoriOptions = ['Pendidikan', 'Ekonomi', 'Dakwah', 'Kemanusiaan'];

    protected string $uploadFolder = 'program-pokok';

    public function index()
    {
        $programPokok = ProgramPokok::latest()->get();

        return view('Admin.program-pokok.index', compact('programPokok'));
    }

    public function create()
    {
        $kategoriOptions = $this->kategoriOptions;

        return view('Admin.program-pokok.create', compact('kategoriOptions'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        if ($request->hasFile('icon')) {
            $validated['icon'] = $this->uploadIcon($request);
        }

        ProgramPokok::create($validated);

        return redirect()
            ->route('admin.program-pokok.index')
            ->with('success', 'Program pokok berhasil ditambahkan.');
    }

    public function edit(ProgramPokok $programPokok)
    {
        $kategoriOptions = $this->kategoriOptions;

        return view('Admin.program-pokok.edit', compact('programPokok', 'kategoriOptions'));
    }

    public function update(Request $request, ProgramPokok $programPokok)
    {
        $validated = $this->validateData($request);

        if ($request->hasFile('icon')) {
            $this->deleteIcon($programPokok->icon);
            $validated['icon'] = $this->uploadIcon($request);
        }

        $programPokok->update($validated);

        return redirect()
            ->route('admin.program-pokok.index')
            ->with('success', 'Program pokok berhasil diperbarui.');
    }

    public function destroy(ProgramPokok $programPokok)
    {
        $this->deleteIcon($programPokok->icon);

        $programPokok->delete();

        return redirect()
            ->route('admin.program-pokok.index')
            ->with('success', 'Program pokok berhasil dihapus.');
    }

    protected function validateData(Request $request): array
    {
        $validated = $request->validate([
            'kategori_program' => 'required|in:' . implode(',', $this->kategoriOptions),
            'judul' => 'required|string|max:150',
            'deskripsi' => 'required|string',
            'link' => 'nullable|url|max:500',
            'icon' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        // icon ditangani terpisah lewat upload file, jangan ikut mass-assign sebagai UploadedFile
        unset($validated['icon']);

        return $validated;
    }

    protected function uploadIcon(Request $request): string
    {
        $file = $request->file('icon');
        $filename = Str::random(20) . '_' . time() . '.' . $file->getClientOriginalExtension();

        $destination = public_path('storage/' . $this->uploadFolder);
        if (! is_dir($destination)) {
            mkdir($destination, 0755, true);
        }

        $file->move($destination, $filename);

        return $this->uploadFolder . '/' . $filename;
    }

    protected function deleteIcon(?string $path): void
    {
        if (! $path) {
            return;
        }

        $fullPath = public_path('storage/' . $path);
        if (file_exists($fullPath)) {
            @unlink($fullPath);
        }
    }
}