<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Iklan;
use App\Models\Testimoni;
use App\Models\VideoKebaikan;
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

        $berita = Berita::orderByDesc('tanggal_terbit')->take(24)->get();

        $iklan = Iklan::orderByDesc('created_at')->get();

        // Title/channel/thumbnail sudah tersimpan di database (diisi otomatis
        // saat data dibuat/diedit lewat model VideoKebaikan), jadi di sini
        // tinggal query biasa — gak ada panggilan ke API YouTube lagi.
        $videoKebaikan = VideoKebaikan::orderByDesc('created_at')->get();

        $impactStats = [
            ['label' => 'Pilar Program', 'value' => 4, 'suffix' => ''],
            ['label' => 'Donatur', 'value' => 1000, 'suffix' => '+'],
            ['label' => 'Penerima Manfaat', 'value' => 10000, 'suffix' => '+'],
            ['label' => 'Dana Tersalurkan', 'value' => 700, 'suffix' => 'JT+'],
        ];

        $visitorStats = [
            'hari_ini'  => (int) (WebsiteVisit::whereDate('visit_date', today())->value('count') ?? 0),
            'bulan_ini' => (int) WebsiteVisit::whereYear('visit_date', now()->year)
                ->whereMonth('visit_date', now()->month)
                ->sum('count'),
            'tahun_ini' => (int) WebsiteVisit::whereYear('visit_date', now()->year)->sum('count'),
        ];

        return view('home', [
            'testimoni'          => $testimoni,
            'berita'             => $berita,
            'iklan'              => $iklan,
            'videoKebaikan'      => $videoKebaikan,
            'kategoriOptions'    => self::KATEGORI,
            'filterProgramOptions' => self::FILTER_PROGRAM,
            'impactStats'        => $impactStats,
            'visitorStats'       => $visitorStats,
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