<?php

namespace App\Http\Controllers;

use App\Models\Berita;
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

        return view('Program.pendidikan', [
            'berita' => $berita,
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

        return view('Program.ekonomi', [
            'berita' => $berita,
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

        return view('Program.dakwah', [
            'berita' => $berita,
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

        return view('Program.kemanusiaan', [
            'berita' => $berita,
        ]);
    }
}