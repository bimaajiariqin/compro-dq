<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RiwayatController extends Controller
{
    public function index()
    {
        $riwayatList = Riwayat::orderBy('urutan')->orderBy('id')->get();

        return view('admin.riwayat.index', compact('riwayatList'));
    }

    public function create()
    {
        return view('admin.riwayat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal'   => 'required|string|max:50',
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'logo'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'urutan'    => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('riwayat', 'public');
        }

        Riwayat::create([
            'tanggal'   => $validated['tanggal'],
            'judul'     => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'logo'      => $validated['logo'] ?? null,
            'urutan'    => $validated['urutan'] ?? 0,
        ]);

        return redirect()
            ->route('admin.riwayat.index')
            ->with('success', 'Riwayat berhasil ditambahkan.');
    }

    public function edit(Riwayat $riwayat)
    {
        return view('admin.riwayat.edit', compact('riwayat'));
    }

    public function update(Request $request, Riwayat $riwayat)
    {
        $validated = $request->validate([
            'tanggal'   => 'required|string|max:50',
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'logo'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'urutan'    => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('logo')) {
            if ($riwayat->logo) {
                Storage::disk('public')->delete($riwayat->logo);
            }
            $validated['logo'] = $request->file('logo')->store('riwayat', 'public');
        }

        $riwayat->update([
            'tanggal'   => $validated['tanggal'],
            'judul'     => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'logo'      => $validated['logo'] ?? $riwayat->logo,
            'urutan'    => $validated['urutan'] ?? $riwayat->urutan,
        ]);

        return redirect()
            ->route('admin.riwayat.index')
            ->with('success', 'Riwayat berhasil diperbarui.');
    }

    public function destroy(Riwayat $riwayat)
    {
        if ($riwayat->logo) {
            Storage::disk('public')->delete($riwayat->logo);
        }
        $riwayat->delete();

        return redirect()
            ->route('admin.riwayat.index')
            ->with('success', 'Riwayat berhasil dihapus.');
    }
}