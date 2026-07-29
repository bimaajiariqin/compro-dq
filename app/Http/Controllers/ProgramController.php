<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\ProgramPokok;
use Illuminate\View\View;

class ProgramController extends Controller
{
    /**
     * Halaman Program Peduli Pendidikan (/program/pendidikan)
     */
    public function pendidikan(): View
    {
        $berita = Berita::where('filter_program', 'Pendidikan')
            ->orderByDesc('tanggal_terbit')
            ->get();

        $programPokok = ProgramPokok::where('kategori_program', 'Pendidikan')
            ->latest()
            ->get();

        return view('Program.pendidikan', [
            'berita' => $berita,
            'programPokok' => $programPokok,
        ]);
    }

    /**
     * Halaman Program Peduli Ekonomi (/program/ekonomi)
     */
    public function ekonomi(): View
    {
        $berita = Berita::where('filter_program', 'Ekonomi')
            ->orderByDesc('tanggal_terbit')
            ->get();

        $programPokok = ProgramPokok::where('kategori_program', 'Ekonomi')
            ->latest()
            ->get();

        return view('Program.ekonomi', [
            'berita' => $berita,
            'programPokok' => $programPokok,
        ]);
    }

    /**
     * Halaman Program Peduli Dakwah (/program/dakwah)
     */
    public function dakwah(): View
    {
        $berita = Berita::where('filter_program', 'Dakwah')
            ->orderByDesc('tanggal_terbit')
            ->get();

        $programPokok = ProgramPokok::where('kategori_program', 'Dakwah')
            ->latest()
            ->get();

        return view('Program.dakwah', [
            'berita' => $berita,
            'programPokok' => $programPokok,
        ]);
    }

    /**
     * Halaman Program Peduli Kemanusiaan (/program/kemanusiaan)
     */
    public function kemanusiaan(): View
    {
        $berita = Berita::where('filter_program', 'Kemanusiaan')
            ->orderByDesc('tanggal_terbit')
            ->get();

        $programPokok = ProgramPokok::where('kategori_program', 'Kemanusiaan')
            ->latest()
            ->get();

        return view('Program.kemanusiaan', [
            'berita' => $berita,
            'programPokok' => $programPokok,
        ]);
    }
}