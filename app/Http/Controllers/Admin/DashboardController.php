<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\LaporanKeuangan;
use App\Models\Penghargaan;
use App\Models\Testimoni;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'berita'            => Berita::count(),
            'testimoni'         => Testimoni::count(),
            'penghargaan'       => Penghargaan::count(),
            'laporan_keuangan'  => LaporanKeuangan::count(),
        ];

        $beritaTerbaru = Berita::orderByDesc('tanggal_terbit')->take(5)->get();

        return view('Admin.dashboard.index', compact('stats', 'beritaTerbaru'));
    }
}