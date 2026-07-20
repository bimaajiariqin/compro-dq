<?php

namespace App\Http\Controllers;

use App\Models\LaporanKeuangan;
use App\Models\Penghargaan;

class TentangKamiController extends Controller
{
    public function index()
    {
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
                'icon'  => 'yayasan',
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
                'tanggal' => '11 November 2007',
                'judul'   => 'Berdirinya Dompet Al-Qur\'an Indonesia',
                'desc'    => 'Pada 11 November 2007, 5 orang tokoh sepakat mendirikan lembaga sosial menunjang perkembangan Pondok Pesantren Tahfizh Al-Qur\'an Darul Fikri.',
                'logo'    => null,
            ],
            [
                'tanggal' => '14 Maret 2012',
                'judul'   => 'Berdirinya Yayasan',
                'desc'    => 'Yayasan Dompet Al-Qur\'an Indonesia berdiri secara resmi. Akta notaris nomor 181 menjadi landasan sah berdirinya Dompet Al-Qur\'an Indonesia.',
                'logo'    => 'dompet-alquran',
            ],
            [
                'tanggal' => '05 April 2015',
                'judul'   => 'Menjadi Lembaga Sosial Kemanusiaan',
                'desc'    => 'Dompet Al-Qur\'an Indonesia terdaftar di Dinas Sosial Kabupaten Sidoarjo sebagai lembaga sosial kemanusiaan.',
                'logo'    => 'dq-badge',
            ],
            [
                'tanggal' => '30 Maret 2016',
                'judul'   => 'Teraudit Wajar Tanpa Pengecualian (WTP)',
                'desc'    => 'Laporan Keuangan Dompet Al-Qur\'an Indonesia teraudit WTP oleh Akuntan Publik, mencerminkan pengelolaan dana yang transparan dan profesional.',
                'logo'    => null,
            ],
            [
                'tanggal' => '23 Januari 2020',
                'judul'   => 'Resmi Sebagai Lembaga Amil Zakat',
                'desc'    => 'Dompet Al-Qur\'an Indonesia resmi ditetapkan sebagai Lembaga Amil Zakat tingkat Provinsi oleh Kementerian Agama Republik Indonesia.',
                'logo'    => null,
            ],
            [
                'tanggal' => '14 Maret 2023',
                'judul'   => 'Mendapat Izin Wakaf',
                'desc'    => 'Telah memperoleh izin resmi sebagai Nazhir Wakaf dari Badan Wakaf Indonesia, sebagai bentuk legalitas dalam pengelolaan wakaf.',
                'logo'    => 'bwi-badge',
            ],
        ];

        // Profil kepengurusan. 'foto' merujuk ke file di public/images/pengurus/{foto}
        $kepengurusan = [
            'Penasehat' => [
                ['nama' => 'K. H. Muhammad Shaleh Drehem, Lc.', 'jabatan' => 'Penasehat DQ', 'foto' => 'penasehat-1.jpg'],
            ],
            'Dewan Pembina' => [
                ['nama' => 'K. H. Syaiful Arifin, S.S., M.Pd.', 'jabatan' => 'Anggota Dewan Pembina', 'foto' => 'pembina-1.jpg'],
                ['nama' => 'K. H. Agung Cahyadi, Lc. M.A.', 'jabatan' => 'Ketua Dewan Pembina', 'foto' => 'pembina-2.jpg'],
                ['nama' => 'Ust. M. Mohamad Yoto, SKM. M.Kes', 'jabatan' => 'Anggota Dewan Pembina', 'foto' => 'pembina-3.jpg'],
            ],
            'Dewan Pengawas Syariah' => [
                ['nama' => 'K. H. Nashir Fahmi, S.Ag., M.H.I', 'jabatan' => 'Anggota Dewan Pengawas Syariah', 'foto' => 'pengawas-1.jpg'],
                ['nama' => 'K. H. Farid Dhofir, Lc. M.Si', 'jabatan' => 'Ketua Dewan Pengawas Syariah', 'foto' => 'pengawas-2.jpg'],
                ['nama' => 'K.H. Saifuddin Yahya, Lc', 'jabatan' => 'Anggota Dewan Pengawas Syariah', 'foto' => 'pengawas-3.jpg'],
            ],
            'Dewan Pengurus' => [
                ['nama' => 'Ust. Basuki Rakhmad, M.Pd', 'jabatan' => 'Sekretaris Dewan Pengurus', 'foto' => 'pengurus-1.jpg'],
                ['nama' => 'K. H. Syai\'in Anshori, S.Ag, M.H.I', 'jabatan' => 'Ketua Dewan Pengurus', 'foto' => 'pengurus-2.jpg'],
                ['nama' => 'Ust. Suwandi, ST', 'jabatan' => 'Bendahara Dewan Pengurus', 'foto' => 'pengurus-3.jpg'],
            ],
            'Direktur LAZ & Wakaf' => [
                ['nama' => 'Agung Untuk Utsanan, S.T, M.M', 'jabatan' => 'Direktur Utama Dompet Al-Qur\'an', 'foto' => 'direktur-1.jpg'],
                ['nama' => 'Agung Heru Setiawan', 'jabatan' => 'Direktur Manajemen Wakaf Dompet', 'foto' => 'direktur-2.jpg'],
            ],
        ];

        return view('tentang-kami', compact(
            'laporanKeuangan',
            'penghargaan',
            'legalitas',
            'riwayat',
            'kepengurusan'
        ));
    }
}