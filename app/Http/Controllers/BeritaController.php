<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\WebsiteVisit;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BeritaController extends Controller
{
    public const KATEGORI = ['Inspirasi', 'Kegiatan', 'Informasi'];
    public const FILTER_PROGRAM = ['Pendidikan', 'Ekonomi', 'Dakwah', 'Kemanusiaan'];

    /**
     * Halaman daftar semua berita (/berita), dengan tab filter + paginasi
     * yang berjalan di sisi browser (sama seperti section Berita di Beranda).
     */
    public function index(Request $request): View
    {
        $this->trackVisit($request);

        $berita = Berita::orderByDesc('tanggal_terbit')->get();

        $visitorStats = $this->visitorStats();

        return view('berita', [
            'berita'               => $berita,
            'kategoriOptions'      => self::KATEGORI,
            'filterProgramOptions' => self::FILTER_PROGRAM,
            'visitorStats'         => $visitorStats,
        ]);
    }

    /**
     * Show a single berita article, with a short list of other recent
     * articles in the sidebar ("Berita Lainnya").
     */
    public function show(Request $request, Berita $berita): View
    {
        $this->trackVisit($request);

        $beritaLainnya = Berita::where('id', '!=', $berita->id)
            ->orderByDesc('tanggal_terbit')
            ->take(4)
            ->get();

        return view('berita-detail', [
            'berita'        => $berita,
            'beritaLainnya' => $beritaLainnya,
            'visitorStats'  => $this->visitorStats(),
        ]);
    }

    private function visitorStats(): array
    {
        return [
            'hari_ini'  => (int) (WebsiteVisit::whereDate('visit_date', today())->value('count') ?? 0),
            'bulan_ini' => (int) WebsiteVisit::whereYear('visit_date', now()->year)
                ->whereMonth('visit_date', now()->month)
                ->sum('count'),
            'tahun_ini' => (int) WebsiteVisit::whereYear('visit_date', now()->year)->sum('count'),
        ];
    }

    private function trackVisit(Request $request): void
    {
        $today = today()->toDateString();

        if ($request->session()->get('dq_last_visit_date') === $today) {
            return;
        }

        $visit = WebsiteVisit::firstOrCreate(
            ['visit_date' => $today],
            ['count' => 0]
        );
        $visit->increment('count');

        $request->session()->put('dq_last_visit_date', $today);
    }
}