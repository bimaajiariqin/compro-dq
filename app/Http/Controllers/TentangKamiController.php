<?php

namespace App\Http\Controllers;

use App\Models\Legalitas;
use App\Models\Riwayat;
use App\Models\LaporanKeuangan;
use App\Models\Penghargaan;
use App\Models\WebsiteVisit;
use Illuminate\Http\Request;

class TentangKamiController extends Controller
{
    public function index(Request $request)
    {
        $this->trackVisit($request);

        // Laporan Keuangan: 1 record per tahun -> urutkan tahun terbaru dulu
        $laporanKeuangan = LaporanKeuangan::orderByDesc('tahun')->get();

        // Penghargaan: bisa lebih dari 1 per tahun -> kelompokkan per tahun
        $penghargaan = Penghargaan::orderByDesc('tanggal_terbit')
            ->get()
            ->groupBy('tahun')
            ->sortKeysDesc();

        // Legalitas Lembaga sekarang dikelola lewat admin panel
        $legalitas = Legalitas::orderBy('urutan')->orderBy('id')->get();

        // Riwayat perjalanan lembaga sekarang dikelola lewat admin panel
        $riwayat = Riwayat::orderBy('urutan')->orderBy('id')->get();

        // Profil kepengurusan. 'foto' merujuk ke file di public/images/pengurus/{foto}.
        // 'is_ketua' menandai anggota yang merupakan ketua/pimpinan kelompok tsb —
        // dipakai di Blade & CSS mobile untuk menempatkan ketua di baris atas,
        // terpisah dari anggota lain di bawahnya.
        $kepengurusan = [
            'Penasehat' => [
                ['nama' => null, 'jabatan' => null, 'foto' => 'penasehat-1.png', 'is_ketua' => false],
            ],
            'Dewan Pembina' => [
                ['nama' => null, 'jabatan' => null, 'foto' => 'pembina-1.png', 'is_ketua' => false],
                ['nama' => null, 'jabatan' => null, 'foto' => 'ketua-pembina.png', 'is_ketua' => true],
                ['nama' => null, 'jabatan' => null, 'foto' => 'pembina-2.png', 'is_ketua' => false],
            ],
            'Dewan Pengawas Syariah' => [
                ['nama' => null, 'jabatan' => null, 'foto' => 'pengawas-1.png', 'is_ketua' => false],
                ['nama' => null, 'jabatan' => null, 'foto' => 'ketua-pengawas.png', 'is_ketua' => true],
                ['nama' => null, 'jabatan' => null, 'foto' => 'pengawas-2.png', 'is_ketua' => false],
            ],
            'Dewan Pengurus' => [
                ['nama' => null, 'jabatan' => null, 'foto' => 'pengurus-1.png', 'is_ketua' => false],
                ['nama' => null, 'jabatan' => null, 'foto' => 'ketua-pengurus.png', 'is_ketua' => true],
                ['nama' => null, 'jabatan' => null, 'foto' => 'pengurus-2.png', 'is_ketua' => false],
            ],
            'Direktur LAZ & Wakaf' => [
                ['nama' => null, 'jabatan' => null, 'foto' => 'direktur-laz.png', 'is_ketua' => false],
                ['nama' => null, 'jabatan' => null, 'foto' => 'direktur-wakaf.png', 'is_ketua' => false],
            ],
        ];

        $visitorStats = $this->visitorStats();

        return view('tentang-kami', compact(
            'laporanKeuangan',
            'penghargaan',
            'legalitas',
            'riwayat',
            'kepengurusan',
            'visitorStats'
        ));
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