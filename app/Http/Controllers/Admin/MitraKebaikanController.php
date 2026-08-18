<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MitraKebaikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MitraKebaikanController extends Controller
{
    public function index()
    {
        $mitras = MitraKebaikan::orderBy('urutan')->orderBy('id')->get();

        return view('admin.mitra.index', compact('mitras'));
    }

    public function create()
    {
        return view('admin.mitra.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_mitra' => 'nullable|string|max:150',
            'logo'       => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'link'       => 'nullable|url|max:500', // opsional
            'urutan'     => 'nullable|integer|min:0',
        ]);

        $path = $request->file('logo')->store('mitra', 'public');

        MitraKebaikan::create([
            'nama_mitra' => $validated['nama_mitra'] ?? null,
            'logo'       => $path,
            'link'       => $validated['link'] ?? null,
            'urutan'     => $validated['urutan'] ?? 0,
        ]);

        return redirect()
            ->route('admin.mitra.index')
            ->with('success', 'Mitra kebaikan berhasil ditambahkan.');
    }

    public function edit(MitraKebaikan $mitra)
    {
        return view('admin.mitra.edit', compact('mitra'));
    }

    public function update(Request $request, MitraKebaikan $mitra)
    {
        $validated = $request->validate([
            'nama_mitra' => 'nullable|string|max:150',
            'logo'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'link'       => 'nullable|url|max:500', // opsional
            'urutan'     => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('logo')) {
            if ($mitra->logo) {
                Storage::disk('public')->delete($mitra->logo);
            }
            $validated['logo'] = $request->file('logo')->store('mitra', 'public');
        }

        $mitra->update([
            'nama_mitra' => $validated['nama_mitra'] ?? $mitra->nama_mitra,
            'logo'       => $validated['logo'] ?? $mitra->logo,
            'link'       => $validated['link'] ?? null,
            'urutan'     => $validated['urutan'] ?? $mitra->urutan,
        ]);

        return redirect()
            ->route('admin.mitra.index')
            ->with('success', 'Mitra kebaikan berhasil diperbarui.');
    }

    public function destroy(MitraKebaikan $mitra)
    {
        if ($mitra->logo) {
            Storage::disk('public')->delete($mitra->logo);
        }
        $mitra->delete();

        return redirect()
            ->route('admin.mitra.index')
            ->with('success', 'Mitra kebaikan berhasil dihapus.');
    }
}