<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengurusController extends Controller
{
    public const KELOMPOK_OPTIONS = [
        'Penasehat',
        'Dewan Pembina',
        'Dewan Pengawas Syariah',
        'Dewan Pengurus',
        'Direktur LAZ & Wakaf',
    ];

    public function index()
    {
        $pengurusList = Pengurus::orderBy('urutan_grup')
            ->orderBy('urutan')
            ->orderBy('id')
            ->get()
            ->groupBy('kelompok');

        return view('admin.pengurus.index', compact('pengurusList'));
    }

    public function create()
    {
        return view('admin.pengurus.create', [
            'kelompokOptions' => self::KELOMPOK_OPTIONS,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kelompok'    => 'required|string|max:100',
            'nama'        => 'nullable|string|max:150',
            'jabatan'     => 'nullable|string|max:150',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_ketua'    => 'nullable|boolean',
            'urutan_grup' => 'nullable|integer|min:0',
            'urutan'      => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('pengurus', 'public');
        }

        Pengurus::create([
            'kelompok'    => $validated['kelompok'],
            'nama'        => $validated['nama'] ?? null,
            'jabatan'     => $validated['jabatan'] ?? null,
            'foto'        => $validated['foto'] ?? null,
            'is_ketua'    => $request->boolean('is_ketua'),
            'urutan_grup' => $validated['urutan_grup'] ?? 0,
            'urutan'      => $validated['urutan'] ?? 0,
        ]);

        return redirect()
            ->route('admin.pengurus.index')
            ->with('success', 'Pengurus berhasil ditambahkan.');
    }

    public function edit(Pengurus $pengurus)
    {
        return view('admin.pengurus.edit', [
            'pengurus'        => $pengurus,
            'kelompokOptions' => self::KELOMPOK_OPTIONS,
        ]);
    }

    public function update(Request $request, Pengurus $pengurus)
    {
        $validated = $request->validate([
            'kelompok'    => 'required|string|max:100',
            'nama'        => 'nullable|string|max:150',
            'jabatan'     => 'nullable|string|max:150',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_ketua'    => 'nullable|boolean',
            'urutan_grup' => 'nullable|integer|min:0',
            'urutan'      => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('foto')) {
            if ($pengurus->foto) {
                Storage::disk('public')->delete($pengurus->foto);
            }
            $validated['foto'] = $request->file('foto')->store('pengurus', 'public');
        }

        $pengurus->update([
            'kelompok'    => $validated['kelompok'],
            'nama'        => $validated['nama'] ?? null,
            'jabatan'     => $validated['jabatan'] ?? null,
            'foto'        => $validated['foto'] ?? $pengurus->foto,
            'is_ketua'    => $request->boolean('is_ketua'),
            'urutan_grup' => $validated['urutan_grup'] ?? $pengurus->urutan_grup,
            'urutan'      => $validated['urutan'] ?? $pengurus->urutan,
        ]);

        return redirect()
            ->route('admin.pengurus.index')
            ->with('success', 'Pengurus berhasil diperbarui.');
    }

    public function destroy(Pengurus $pengurus)
    {
        if ($pengurus->foto) {
            Storage::disk('public')->delete($pengurus->foto);
        }
        $pengurus->delete();

        return redirect()
            ->route('admin.pengurus.index')
            ->with('success', 'Pengurus berhasil dihapus.');
    }
}