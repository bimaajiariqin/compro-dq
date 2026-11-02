<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\HeroSetting;
use App\Models\HeroStat;
use App\Models\Iklan;
use App\Models\Testimoni;
use App\Models\VideoKebaikan;
use App\Models\VideoPertanyaan;
use App\Models\WebsiteVisit;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public const KATEGORI = ['Inspirasi', 'Kegiatan', 'Informasi'];
    public const FILTER_PROGRAM = ['Pendidikan', 'Ekonomi', 'Dakwah', 'Kemanusiaan'];

    public function index(Request $request): View
    {
        $this->trackVisit($request);

        $testimoni = Testimoni::orderByDesc('created_at')->get();

        // FIX: take(24) dihapus supaya SEMUA berita ikut dikirim ke
        // landing page, bukan cuma 24 yang terbaru. Sebelumnya berita
        // dengan tanggal_terbit lebih lama (mis. kategori/program
        // "Ekonomi") bisa terpotong limit ini dan jadi tidak pernah
        // muncul sama sekali di tab manapun -- termasuk tab "Semua".
        // Pagination tampilan tetap ditangani di client-side oleh
        // landing.js (ROWS_PER_PAGE), jadi aman dari sisi UI.
        $berita = Berita::orderByDesc('tanggal_terbit')->get();

        $iklan = Iklan::orderByDesc('created_at')->get();

        $videoKebaikan = VideoKebaikan::orderByDesc('created_at')->get();

        $videoPertanyaan = VideoPertanyaan::orderByDesc('created_at')->get();

        $heroSetting = HeroSetting::first();

        $impactStats = HeroStat::orderBy('urutan')->orderBy('id')->get()
            ->map(fn ($stat) => [
                'label'  => $stat->label,
                'value'  => $stat->value,
                'suffix' => $stat->suffix,
            ])
            ->toArray();

        $visitorStats = [
            'hari_ini'  => (int) (WebsiteVisit::whereDate('visit_date', today())->value('count') ?? 0),
            'bulan_ini' => (int) WebsiteVisit::whereYear('visit_date', now()->year)
                ->whereMonth('visit_date', now()->month)
                ->sum('count'),
            'tahun_ini' => (int) WebsiteVisit::whereYear('visit_date', now()->year)->sum('count'),
        ];

        return view('home', [
            'testimoni'            => $testimoni,
            'berita'               => $berita,
            'iklan'                => $iklan,
            'videoKebaikan'        => $videoKebaikan,
            'videoPertanyaan'      => $videoPertanyaan,
            'kategoriOptions'      => self::KATEGORI,
            'filterProgramOptions' => self::FILTER_PROGRAM,
            'heroSetting'          => $heroSetting,
            'impactStats'          => $impactStats,
            'visitorStats'         => $visitorStats,
        ]);
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