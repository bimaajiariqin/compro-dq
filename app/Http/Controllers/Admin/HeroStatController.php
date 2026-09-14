<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroStat;
use Illuminate\Http\Request;

class HeroStatController extends Controller
{
    public function index()
    {
        $stats = HeroStat::orderBy('urutan')->orderBy('id')->get();

        return view('admin.hero-stat.index', compact('stats'));
    }

    public function create()
    {
        return view('admin.hero-stat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'label'  => 'required|string|max:100',
            'value'  => 'required|integer|min:0',
            'suffix' => 'nullable|string|max:20',
            'urutan' => 'nullable|integer|min:0',
        ]);

        HeroStat::create([
            'label'  => $validated['label'],
            'value'  => $validated['value'],
            'suffix' => $validated['suffix'] ?? null,
            'urutan' => $validated['urutan'] ?? 0,
        ]);

        return redirect()
            ->route('admin.hero-stat.index')
            ->with('success', 'Statistik hero berhasil ditambahkan.');
    }

    public function edit(HeroStat $heroStat)
    {
        return view('admin.hero-stat.edit', compact('heroStat'));
    }

    public function update(Request $request, HeroStat $heroStat)
    {
        $validated = $request->validate([
            'label'  => 'required|string|max:100',
            'value'  => 'required|integer|min:0',
            'suffix' => 'nullable|string|max:20',
            'urutan' => 'nullable|integer|min:0',
        ]);

        $heroStat->update([
            'label'  => $validated['label'],
            'value'  => $validated['value'],
            'suffix' => $validated['suffix'] ?? null,
            'urutan' => $validated['urutan'] ?? $heroStat->urutan,
        ]);

        return redirect()
            ->route('admin.hero-stat.index')
            ->with('success', 'Statistik hero berhasil diperbarui.');
    }

    public function destroy(HeroStat $heroStat)
    {
        $heroStat->delete();

        return redirect()
            ->route('admin.hero-stat.index')
            ->with('success', 'Statistik hero berhasil dihapus.');
    }
}