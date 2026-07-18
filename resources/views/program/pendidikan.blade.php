<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Peduli Pendidikan — Dompet Al-Qur'an Indonesia</title>
    <meta name="description" content="Peduli Pendidikan adalah program Dompet Al-Qur'an Indonesia yang mendukung pendidikan anak-anak dan generasi muda dari keluarga prasejahtera melalui beasiswa, perlengkapan sekolah, dan pembinaan karakter Islami.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- CSS bersama seluruh situs --}}
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    {{-- CSS khusus 4 halaman Program (Pendidikan, Ekonomi, Dakwah, Kemanusiaan) --}}
    <link rel="stylesheet" href="{{ asset('css/program.css') }}">
</head>
<body>

@include('partials.navbar')

{{-- =====================================================================
     HERO
     ===================================================================== --}}
<section class="program-hero">
    <div class="container program-hero__inner">

        <div class="program-hero__media">
            <img src="{{ asset('assets/pendidikan-hero.png') }}" alt="Program Peduli Pendidikan" class="program-hero__img">
        </div>

        <div class="program-hero__content">
            <h1 class="program-hero__title">Program <span>Peduli Pendidikan</span></h1>
            <p class="program-hero__desc">
                Peduli Pendidikan merupakan program Dompet Al-Qur'an Indonesia yang mendukung pendidikan anak-anak
                dan generasi muda dari keluarga prasejahtera melalui beasiswa, perlengkapan sekolah, pembinaan
                karakter Islami, dan dukungan sarana belajar. Program ini bertujuan menciptakan generasi Qurani
                yang cerdas, berdaya, berakhlak mulia, dan siap meraih masa depan yang lebih baik.
            </p>
            <a href="#program-pokok" class="btn-primary program-hero__cta">
                Lihat Detail
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M13 6L19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>

    </div>
</section>

{{-- =====================================================================
     PROGRAM POKOK
     Isi array ini yang beda-beda tiap halaman Program
     (Pendidikan / Ekonomi / Dakwah / Kemanusiaan).
     ===================================================================== --}}
@php
    $programPokok = [
        [
            'title' => 'Beasiswa Pendidikan',
            'desc'  => 'Bantuan biaya pendidikan bagi siswa dan mahasiswa berprestasi dari keluarga prasejahtera.',
            'icon'  => '<path d="M12 3L2 8l10 5 10-5-10-5z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M6 10.5V16c0 1.1 2.7 2.5 6 2.5s6-1.4 6-2.5v-5.5" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M21 9v6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>',
        ],
        [
            'title' => 'Paket Perlengkapan Sekolah',
            'desc'  => 'Penyaluran tas, seragam, sepatu, alat tulis, dan kebutuhan sekolah lainnya agar anak dapat belajar dengan nyaman.',
            'icon'  => '<path d="M4 20l1-4.2L15.2 5.6a1.5 1.5 0 012.1 0l1.1 1.1a1.5 1.5 0 010 2.1L8.2 19 4 20z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M13.5 7.3l3.2 3.2" stroke="currentColor" stroke-width="1.7"/>',
        ],
        [
            'title' => 'Rumah Belajar Qurani',
            'desc'  => "Program pendampingan belajar yang menggabungkan pelajaran akademik dengan pembelajaran Al-Qur'an dan nilai-nilai Islam.",
            'icon'  => '<path d="M4 11.5L12 4l8 7.5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/><path d="M6 10v9a1 1 0 001 1h10a1 1 0 001-1v-9" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M10 20v-5h4v5" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>',
        ],
        [
            'title' => 'Pembinaan Karakter Islami',
            'desc'  => 'Kegiatan pembinaan akhlak, kepemimpinan, dan pembiasaan ibadah untuk membentuk generasi yang berkarakter mulia.',
            'icon'  => '<path d="M20 14.5A8.5 8.5 0 119.5 4a6.8 6.8 0 1010.5 10.5z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>',
        ],
        [
            'title' => "Distribusi Al-Qur'an & Buku Islami",
            'desc'  => "Penyaluran Al-Qur'an, Iqra', buku-buku Islami, dan buku edukatif untuk mendukung kegiatan belajar dan meningkatkan literasi keislaman.",
            'icon'  => '<path d="M12 6.5c-1.7-1-4-1.5-6.5-1.5v13c2.5 0 4.8.5 6.5 1.5" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M12 6.5c1.7-1 4-1.5 6.5-1.5v13c-2.5 0-4.8.5-6.5 1.5V6.5z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>',
        ],
        [
            'title' => 'Sekolah Layak Belajar',
            'desc'  => 'Renovasi ruang kelas serta penyediaan sarana dan prasarana pendidikan yang nyaman dan aman.',
            'icon'  => '<path d="M5 20V6.5L12 3l7 3.5V20" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M9 20v-4h6v4" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M9 11h.01M12 11h.01M15 11h.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>',
        ],
        [
            'title' => 'Gerakan Peduli Pendidikan',
            'desc'  => 'Aksi kolaborasi bersama masyarakat dan donatur untuk memenuhi kebutuhan pendidikan anak-anak serta mendukung keberlangsungan proses belajar.',
            'icon'  => '<path d="M12 20s-6.5-3.9-9-8.2C1.4 8.6 3 5.5 6 5.5c1.7 0 3 1 4 2.3 1-1.3 2.3-2.3 4-2.3 3 0 4.6 3.1 3 6.3-2.5 4.3-9 8.2-9 8.2z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>',
        ],
    ];
@endphp

<section class="section program-pokok" id="program-pokok">
    <div class="container">

        <h2 class="section-title">Program <span>Pokok</span> Kami</h2>

        <div class="program-pokok__grid">
            @foreach ($programPokok as $item)
                <div class="program-pokok__card">
                    <span class="program-pokok__icon">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">{!! $item['icon'] !!}</svg>
                    </span>
                    <h3 class="program-pokok__title">{{ $item['title'] }}</h3>
                    <p class="program-pokok__desc">{{ $item['desc'] }}</p>
                </div>
            @endforeach
        </div>

    </div>
</section>

{{-- =====================================================================
     BERITA & INFORMASI TERKAIT
     $berita dikirim dari ProgramController::pendidikan(), sudah difilter
     where filter_program = 'Pendidikan'.
     ===================================================================== --}}
<section class="section program-berita">
    <div class="container">

        <h2 class="section-title section-title--left">Berita &amp; Informasi <span>Terkait</span></h2>
        <p class="program-berita__lead">
            Ikuti berbagai berita dan informasi terkini mengenai program, penyaluran, kegiatan, serta kisah
            inspiratif dari Dompet Al-Qur'an Indonesia. Kami berkomitmen menghadirkan informasi yang transparan,
            aktual, dan bermanfaat bagi masyarakat.
        </p>

        <div class="program-berita__slider" data-berita-slider data-page-size="4">
            <div class="program-berita__track" data-berita-track>
                @forelse ($berita as $item)
                    <div class="berita-card program-berita__card is-visible" data-slide-item>
                        <a href="{{ route('berita.show', $item) }}">
                            @if ($item->thumbnail)
                                <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->judul }}" class="berita-thumb">
                            @else
                                <div class="berita-thumb"></div>
                            @endif
                        </a>
                        <div class="berita-body">
                            <h3 class="berita-title"><a href="{{ route('berita.show', $item) }}">{{ $item->judul }}</a></h3>
                            <div class="berita-meta">
                                <span class="publisher">
                                    <span>{{ $item->nama_penerbit }} &middot; {{ $item->tanggal_terbit->translatedFormat('d M Y') }}</span>
                                </span>
                                <span class="berita-badge">{{ $item->filter_program }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="berita-empty">Belum ada berita yang dipublikasikan.</p>
                @endforelse
            </div>
        </div>

        @if ($berita->count() > 4)
            <div class="program-berita__dots" data-berita-dots></div>
        @endif

    </div>
</section>

@include('partials.footer')

<script src="{{ asset('js/program-berita-slider.js') }}"></script>
</body>
</html>