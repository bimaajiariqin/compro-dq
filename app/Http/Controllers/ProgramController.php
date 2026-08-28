<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\CeritaPenerimaManfaat;
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

        $ceritaPenerimaManfaat = CeritaPenerimaManfaat::aktif()
            ->kategori('Pendidikan')
            ->terurut()
            ->get();

        return view('Program.pendidikan', [
            'berita' => $berita,
            'programPokok' => $programPokok,
            'ceritaPenerimaManfaat' => $ceritaPenerimaManfaat,
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

        $ceritaPenerimaManfaat = CeritaPenerimaManfaat::aktif()
            ->kategori('Ekonomi')
            ->terurut()
            ->get();

        return view('Program.ekonomi', [
            'berita' => $berita,
            'programPokok' => $programPokok,
            'ceritaPenerimaManfaat' => $ceritaPenerimaManfaat,
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

        $ceritaPenerimaManfaat = CeritaPenerimaManfaat::aktif()
            ->kategori('Dakwah')
            ->terurut()
            ->get();

        return view('Program.dakwah', [
            'berita' => $berita,
            'programPokok' => $programPokok,
            'ceritaPenerimaManfaat' => $ceritaPenerimaManfaat,
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

        $ceritaPenerimaManfaat = CeritaPenerimaManfaat::aktif()
            ->kategori('Kemanusiaan')
            ->terurut()
            ->get();

        return view('Program.kemanusiaan', [
            'berita' => $berita,
            'programPokok' => $programPokok,
            'ceritaPenerimaManfaat' => $ceritaPenerimaManfaat,
        ]);
    }
}