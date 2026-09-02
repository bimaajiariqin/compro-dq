<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSettingController extends Controller
{
    public function edit()
    {
        $hero = HeroSetting::firstOrCreate([], [
            'eyebrow_id'  => "Selamat Datang di Dompet Al-Qur'an Indonesia",
            'eyebrow_en'  => "Welcome to Dompet Al-Qur'an Indonesia",
            'judul_id'    => 'Banyak Jalan Menuju Kebaikan, Mari Berbagi Bersama.',
            'judul_en'    => "Many Paths to Goodness, Let's Share Together.",
            'subjudul_id' => 'Salurkan amanah Anda melalui lembaga yang profesional, transparan, dan terpercaya untuk menciptakan perubahan yang berkelanjutan.',
            'subjudul_en' => 'Channel your trust through a professional, transparent, and reliable institution to create sustainable change.',
        ]);

        return view('admin.hero-setting.edit', compact('hero'));
    }

    public function update(Request $request, HeroSetting $heroSetting)
    {
        // Field _en dibuat nullable karena form saat ini belum punya inputnya.
        // Kalau nanti input _en ditambahkan ke form, validasi ini tetap jalan normal.
        $validated = $request->validate([
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10048',
            'eyebrow_id'  => 'nullable|string|max:150',
            'eyebrow_en'  => 'nullable|string|max:150',
            'judul_id'    => 'required|string|max:255',
            'judul_en'    => 'nullable|string|max:255',
            'subjudul_id' => 'required|string',
            'subjudul_en' => 'nullable|string',
        ]);

        // Field _en yang tidak dikirim form dipertahankan nilai lamanya,
        // supaya tidak ke-null-kan tanpa sengaja.
        $validated['eyebrow_en']  = $validated['eyebrow_en']  ?? $heroSetting->eyebrow_en;
        $validated['judul_en']    = $validated['judul_en']    ?? $heroSetting->judul_en;
        $validated['subjudul_en'] = $validated['subjudul_en'] ?? $heroSetting->subjudul_en;

        if ($request->hasFile('foto')) {
            if ($heroSetting->foto) {
                Storage::disk('public')->delete($heroSetting->foto);
            }
            $validated['foto'] = $request->file('foto')->store('hero', 'public');
        }

        $heroSetting->update($validated);

        return redirect()
            ->route('admin.hero-setting.edit')
            ->with('success', 'Hero landing berhasil diperbarui.');
    }
}