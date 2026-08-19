<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Legalitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LegalitasController extends Controller
{
    public function index()
    {
        $legalitasList = Legalitas::orderBy('urutan')->orderBy('id')->get();

        return view('admin.legalitas.index', compact('legalitasList'));
    }

    public function create()
    {
        return view('admin.legalitas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'   => 'required|string|max:100',
            'label'  => 'required|string|max:150',
            'icon'   => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'link'   => 'nullable|url|max:500',
            'urutan' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('icon')) {
            $validated['icon'] = $request->file('icon')->store('legalitas', 'public');
        }

        Legalitas::create([
            'nama'   => $validated['nama'],
            'label'  => $validated['label'],
            'icon'   => $validated['icon'] ?? null,
            'link'   => $validated['link'] ?? null,
            'urutan' => $validated['urutan'] ?? 0,
        ]);

        return redirect()
            ->route('admin.legalitas.index')
            ->with('success', 'Legalitas berhasil ditambahkan.');
    }

    public function edit(Legalitas $legalitas)
    {
        return view('admin.legalitas.edit', compact('legalitas'));
    }

    public function update(Request $request, Legalitas $legalitas)
    {
        $validated = $request->validate([
            'nama'   => 'required|string|max:100',
            'label'  => 'required|string|max:150',
            'icon'   => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'link'   => 'nullable|url|max:500',
            'urutan' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('icon')) {
            if ($legalitas->icon) {
                Storage::disk('public')->delete($legalitas->icon);
            }
            $validated['icon'] = $request->file('icon')->store('legalitas', 'public');
        }

        $legalitas->update([
            'nama'   => $validated['nama'],
            'label'  => $validated['label'],
            'icon'   => $validated['icon'] ?? $legalitas->icon,
            'link'   => $validated['link'] ?? null,
            'urutan' => $validated['urutan'] ?? $legalitas->urutan,
        ]);

        return redirect()
            ->route('admin.legalitas.index')
            ->with('success', 'Legalitas berhasil diperbarui.');
    }

    public function destroy(Legalitas $legalitas)
    {
        if ($legalitas->icon) {
            Storage::disk('public')->delete($legalitas->icon);
        }
        $legalitas->delete();

        return redirect()
            ->route('admin.legalitas.index')
            ->with('success', 'Legalitas berhasil dihapus.');
    }
}