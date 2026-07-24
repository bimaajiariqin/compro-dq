<?php

namespace App\Http\Controllers;

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

        // Legalitas Lembaga bersifat statis. 'icon' merujuk ke file gambar
        // yang disimpan di public/images/legalitas/{icon}.png
        $legalitas = [
            [
                'nama'  => 'Yayasan',
                'label' => 'Akta Yayasan',
                'icon'  => 'kemenkumham',
                'link'  => 'https://ahu.go.id/pencarian/detail-yayasan/XXXXXXX',
            ],
            [
                'nama'  => 'Kemenag',
                'label' => 'Izin Lembaga Amil Zakat',
                'icon'  => 'kemenag',
                'link'  => 'https://simbi.kemenag.go.id/laz/XXXXXXX',
            ],
            [
                'nama'  => 'BWI',
                'label' => 'Izin Nazhir Wakaf',
                'icon'  => 'bwi',
                'link'  => 'https://bwi.go.id/nazhir/XXXXXXX',
            ],
            [
                'nama'  => 'Kemensos',
                'label' => 'Izin Lembaga Sosial',
                'icon'  => 'kemensos',
                'link'  => 'https://kemensos.go.id/XXXXXXX',
            ],
            [
                'nama'  => 'BAZNAS',
                'label' => 'Rekomendasi BAZNAS',
                'icon'  => 'baznas',
                'link'  => 'https://baznas.go.id/XXXXXXX',
            ],
        ];

        // Riwayat perjalanan lembaga. 'logo' opsional -> file di
        // public/images/riwayat/{logo}.png, dikosongkan jika tidak perlu logo.
        $riwayat = [
            [
                'tanggal' => '11 November 2011',
                'judul'   => 'Berdirinya Dompet Al-Qur\'an Indonesia',
                'desc'    => 'Pada 11 November 2007, 5 orang tokoh sepakat mendirikan lembaga sosial menunjang perkembangan Pondok Pesantren Tahfizh Al-Qur\'an Darul Fikri.',
                'logo'    => null,
            ],

            [
                'tanggal' => '19 Maret 2013',
                'judul'   => 'Berdirinya Yayasan',
                'desc'    => 'Yayasan Dompet Al-Qur\'an Indonesia berdiri secara resmi. Akta notaris nomor 181 menjadi landasan sah berdirinya Dompet Al-Qur\'an Indonesia.',
                'logo'    => 'dq-1',
            ],

            [
                'tanggal' => '30 Maret 2016',
                'judul'   => 'Teraudit Wajar Tanpa Pengecualian (WTP)',
                'desc'    => 'Laporan Keuangan Dompet Al-Qur\'an Indonesia teraudit WTP oleh Akuntan Publik, mencerminkan pengelolaan dana yang transparan dan profesional.',
                'logo'    => null,
            ],

            [
                'tanggal' => '05 April 2017',
                'judul'   => 'Menjadi Lembaga Sosial Kemanusiaan',
                'desc'    => 'Dompet Al-Qur\'an Indonesia terdaftar di Dinas Sosial Kabupaten Sidoarjo sebagai lembaga sosial kemanusiaan.',
                'logo'    => 'dq-2',
            ],

            [
                'tanggal' => '25 Januari 2021',
                'judul'   => 'Resmi Sebagai Lembaga Amil Zakat',
                'desc'    => 'Dompet Al-Qur\'an Indonesia resmi ditetapkan sebagai Lembaga Amil Zakat tingkat Provinsi oleh Kementerian Agama Republik Indonesia.',
                'logo'    => null,
            ],

            [
                'tanggal' => '14 Maret 2023',
                'judul'   => 'Mendapat Izin Wakaf',
                'desc'    => 'Telah memperoleh izin resmi sebagai Nazhir Wakaf dari Badan Wakaf Indonesia, sebagai bentuk legalitas dalam pengelolaan wakaf.',
                'logo'    => null,
            ],
        ];

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