<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FaqController extends Controller
{
    /**
     * Daftar FAQ (admin), bisa difilter per kategori lewat ?kategori=Dakwah
     */
    public function index(Request $request): View
    {
        $kategoriAktif = $request->get('kategori');

        $faqs = Faq::when($kategoriAktif, fn ($q) => $q->where('kategori_program', $kategoriAktif))
            ->orderBy('kategori_program')
            ->orderBy('urutan')
            ->get()
            ->groupBy('kategori_program');

        return view('admin.faq.index', [
            'faqs' => $faqs,
            'kategoriList' => Faq::KATEGORI,
            'kategoriAktif' => $kategoriAktif,
        ]);
    }

    public function create(): View
    {
        return view('admin.faq.create', [
            'kategoriList' => Faq::KATEGORI,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);

        Faq::create($validated);

        return redirect()
            ->route('admin.faq.index')
            ->with('success', 'FAQ berhasil ditambahkan.');
    }

    public function edit(Faq $faq): View
    {
        return view('admin.faq.edit', [
            'faq' => $faq,
            'kategoriList' => Faq::KATEGORI,
        ]);
    }

    public function update(Request $request, Faq $faq): RedirectResponse
    {
        $validated = $this->validated($request);

        $faq->update($validated);

        return redirect()
            ->route('admin.faq.index')
            ->with('success', 'FAQ berhasil diperbarui.');
    }

    public function destroy(Faq $faq): RedirectResponse
    {
        $faq->delete();

        return redirect()
            ->route('admin.faq.index')
            ->with('success', 'FAQ berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $validated = $request->validate([
            'kategori_program' => 'required|in:' . implode(',', Faq::KATEGORI),
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string',
            'urutan' => 'nullable|integer|min:0',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['urutan'] = $validated['urutan'] ?? 0;

        return $validated;
    }
}