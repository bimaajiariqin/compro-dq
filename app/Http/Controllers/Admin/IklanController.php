<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Iklan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class IklanController extends Controller
{
    /**
     * Folder tempat thumbnail disimpan, relatif terhadap public/storage.
     * Sama seperti modul lain — disimpan langsung ke folder nyata,
     * tidak lewat symlink `storage:link`.
     */
    private const THUMBNAIL_FOLDER = 'iklan';

    public function index(): View
    {
        $iklan = Iklan::orderByDesc('created_at')->get();

        return view('Admin.iklan.index', compact('iklan'));
    }

    public function create(): View
    {
        return view('Admin.iklan.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);
        unset($validated['thumbnail']);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $this->storeThumbnail($request);
        }

        Iklan::create($validated);

        return redirect()->route('iklan.index')->with('success', 'Iklan berhasil ditambahkan.');
    }

    public function show(Iklan $iklan): RedirectResponse
    {
        return redirect()->route('iklan.edit', $iklan);
    }

    public function edit(Iklan $iklan): View
    {
        return view('Admin.iklan.edit', compact('iklan'));
    }

    public function update(Request $request, Iklan $iklan): RedirectResponse
    {
        $validated = $this->validated($request);
        unset($validated['thumbnail']);

        if ($request->hasFile('thumbnail')) {
            $this->deleteThumbnail($iklan->thumbnail);
            $validated['thumbnail'] = $this->storeThumbnail($request);
        }

        $iklan->update($validated);

        return redirect()->route('iklan.index')->with('success', 'Iklan berhasil diperbarui.');
    }

    public function destroy(Iklan $iklan): RedirectResponse
    {
        $this->deleteThumbnail($iklan->thumbnail);

        $iklan->delete();

        return redirect()->route('iklan.index')->with('success', 'Iklan berhasil dihapus.');
    }

    private function storeThumbnail(Request $request): string
    {
        $destinationPath = public_path('storage/' . self::THUMBNAIL_FOLDER);

        if (! File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        $file = $request->file('thumbnail');
        $extension = strtolower($file->getClientOriginalExtension());
        $filename = uniqid() . '_' . time() . '.' . $extension;

        $file->move($destinationPath, $filename);

        return self::THUMBNAIL_FOLDER . '/' . $filename;
    }

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
        return $request->validate([
            'thumbnail' => [
                $request->isMethod('post') ? 'required' : 'nullable',
                'image', 'mimes:jpg,jpeg,png,webp', 'max:2048',
            ],
            'link' => ['required', 'url', 'max:500'],
        ], [
            'thumbnail.required' => 'Thumbnail wajib diunggah.',
            'thumbnail.image'    => 'File harus berupa gambar.',
            'thumbnail.mimes'    => 'Format gambar harus jpg, jpeg, png, atau webp.',
            'thumbnail.max'      => 'Ukuran gambar maksimal 2MB.',
            'link.required'      => 'Link tujuan wajib diisi.',
            'link.url'           => 'Link harus berupa URL yang valid (contoh: https://...).',
        ]);
    }
}