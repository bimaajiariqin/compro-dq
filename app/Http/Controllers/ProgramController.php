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

    // 3 halaman program lainnya memakai pola yang sama: query filter_program
    // berbeda, lalu view Program/{nama}.blade.php sendiri (isi Program Pokok
    // ditulis langsung di masing-masing view, lihat komentar @php di dalamnya).
    //
    // public function ekonomi(): View
    // {
    //     $berita = Berita::where('filter_program', 'Ekonomi')->orderByDesc('tanggal_terbit')->get();
    //     return view('Program.ekonomi', ['berita' => $berita]);
    // }
}