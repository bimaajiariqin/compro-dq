<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Testimoni;
use App\Models\WebsiteVisit;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Kategori & filter program yang dipakai untuk tab filter di section Berita.
     * Diambil dari ENUM kolom `kategori` dan `filter_program` pada tabel `berita`.
     */
    public const KATEGORI = ['Inspirasi', 'Kegiatan', 'Informasi'];
    public const FILTER_PROGRAM = ['Pendidikan', 'Ekonomi', 'Dakwah', 'Kemanusiaan'];

    public function index(Request $request): View
    {
        $this->trackVisit($request);

        $testimoni = Testimoni::orderByDesc('created_at')->get();

        $berita = Berita::orderByDesc('tanggal_terbit')->take(24)->get();

        // Angka pilar/donatur/penerima manfaat/dana tersalurkan belum punya tabel
        // sumber datanya sendiri di database saat ini, jadi untuk sementara
        // di-hardcode di sini. Ganti ke query asli begitu tabelnya tersedia.
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
            'kategoriOptions'    => self::KATEGORI,
            'filterProgramOptions' => self::FILTER_PROGRAM,
            'impactStats'        => $impactStats,
            'visitorStats'       => $visitorStats,
        ]);
    }

    /**
     * Menambah hitungan pengunjung untuk hari ini, maksimal satu kali per sesi
     * browser per hari — jadi me-reload halaman tidak akan menambah angka
     * terus-menerus.
     */
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