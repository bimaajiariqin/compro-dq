<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Peduli Kemanusiaan — Dompet Al-Qur'an Indonesia</title>
    <meta name="description" content="Peduli Kemanusiaan adalah program Dompet Al-Qur'an Indonesia yang berfokus pada bantuan kemanusiaan bagi masyarakat terdampak bencana, krisis, dan kondisi darurat.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- CSS bersama seluruh situs --}}
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    {{-- CSS khusus 4 halaman Program (Pendidikan, Ekonomi, Dakwah, Kemanusiaan) --}}
    <link rel="stylesheet" href="{{ asset('css/program.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

@include('partials.navbar')

{{-- =====================================================================
     HERO
     ===================================================================== --}}
<section class="program-hero">
    <div class="container program-hero__inner">

        <div class="program-hero__media">
            <img src="{{ asset('assets/kemanusiaan-hero.png') }}" alt="Program Peduli Kemanusiaan" class="program-hero__img">
        </div>

        <div class="program-hero__content">
            <h1 class="program-hero__title">Program <span>Peduli Kemanusiaan</span></h1>
            <p class="program-hero__desc">
                Peduli Kemanusiaan merupakan program Dompet Al-Qur'an Indonesia yang berfokus pada pemberian
                bantuan kemanusiaan bagi masyarakat yang terdampak bencana, krisis, dan kondisi darurat. Melalui
                bantuan pangan, layanan kesehatan, hunian sementara, serta pemulihan pascabencana, program ini
                bertujuan menghadirkan kepedulian, meringankan beban para penyintas, dan membantu mereka bangkit
                menuju kehidupan yang lebih baik.
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
     ===================================================================== --}}
@php
    $programPokok = [
        [
            'title' => 'Paket Pangan Kemanusiaan',
            'desc'  => 'Distribusi bahan pangan dan kebutuhan pokok bagi keluarga yang membutuhkan.',
            'icon'  => '<path d="M6 8h12l-1.2 11.2a1 1 0 01-1 .8H8.2a1 1 0 01-1-.8L6 8z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M9 8V6a3 3 0 016 0v2" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>',
        ],
        [
            'title' => 'Tanggap Bencana',
            'desc'  => 'Bantuan darurat bagi masyarakat terdampak bencana alam dan musibah.',
            'icon'  => '<path d="M12 4L2.5 20h19L12 4z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M12 10.5v4M12 17h.01" stroke="currentColor" stroke-width="1.9" stroke-linecap="round"/>',
        ],
        [
            'title' => 'Hunian Sementara',
            'desc'  => 'Penyediaan tempat tinggal sementara bagi masyarakat yang kehilangan tempat tinggal akibat bencana.',
            'icon'  => '<path d="M4 11.5L12 4l8 7.5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/><path d="M6 10v9a1 1 0 001 1h10a1 1 0 001-1v-9" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M10 20v-5h4v5" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>',
        ],
        [
            'title' => 'Bantuan Air Bersih',
            'desc'  => 'Penyediaan air bersih, sanitasi, dan perlengkapan kebersihan di wilayah terdampak.',
            'icon'  => '<path d="M12 3.5C9 8 6.5 11.5 6.5 14.8a5.5 5.5 0 0011 0C17.5 11.5 15 8 12 3.5z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>',
        ],
        [
            'title' => 'Dapur Umum',
            'desc'  => 'Penyediaan makanan siap saji bagi penyintas bencana dan masyarakat dalam kondisi darurat.',
            'icon'  => '<path d="M4 9.5h16v9a1 1 0 01-1 1H5a1 1 0 01-1-1v-9z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M4 9.5l1.5-5h13l1.5 5" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M9 13.5v3M15 13.5v3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>',
        ],
        [
            'title' => 'Relawan Kemanusiaan',
            'desc'  => 'Pemberdayaan dan pelatihan relawan untuk mendukung aksi kemanusiaan di berbagai wilayah.',
            'icon'  => '<path d="M12 21s-7-4.4-9.3-9.1C1.3 9 3 5.5 6.3 5.5c1.9 0 3.4 1.1 4.4 2.6C11.7 6.6 13.2 5.5 15.1 5.5c3.3 0 5 3.5 3.6 6.4C16.4 16.6 12 21 12 21z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>',
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
     $berita dikirim dari ProgramController::kemanusiaan(), sudah difilter
     where filter_program = 'Kemanusiaan'.
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