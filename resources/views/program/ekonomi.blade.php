<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Peduli Ekonomi — Dompet Al-Qur'an Indonesia</title>
    <meta name="description" content="Peduli Ekonomi adalah program Dompet Al-Qur'an Indonesia yang berfokus pada pemberdayaan ekonomi masyarakat prasejahtera melalui bantuan modal usaha, pelatihan keterampilan, dan pendampingan usaha.">

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
            <img src="{{ asset('assets/ekonomi-hero.png') }}" alt="Program Peduli Ekonomi" class="program-hero__img">
        </div>

        <div class="program-hero__content">
            <h1 class="program-hero__title">Program <span>Peduli Ekonomi</span></h1>
            <p class="program-hero__desc">
                Peduli Ekonomi merupakan program Dompet Al-Qur'an Indonesia yang berfokus pada pemberdayaan
                ekonomi masyarakat prasejahtera melalui bantuan modal usaha, pelatihan keterampilan,
                pendampingan usaha, dan penguatan ekonomi berbasis syariah. Program ini bertujuan menciptakan
                masyarakat yang mandiri, produktif, dan berdaya sehingga mampu meningkatkan kesejahteraan
                keluarga serta memberikan manfaat bagi lingkungan sekitarnya.
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
            'title' => 'Bantuan Modal Usaha',
            'desc'  => 'Pemberian modal usaha bagi pelaku UMKM dan masyarakat prasejahtera untuk mengembangkan usahanya.',
            'icon'  => '<path d="M4 6.5h16a1 1 0 011 1V17a1 1 0 01-1 1H4a1 1 0 01-1-1V7.5a1 1 0 011-1z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M3.3 7l8.7 6 8.7-6" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>',
        ],
        [
            'title' => 'Rombong Berkah',
            'desc'  => 'Bantuan gerobak atau booth usaha bagi pedagang kecil agar dapat meningkatkan produktivitas dan pendapatan.',
            'icon'  => '<path d="M4 10l1.3-4.5A1 1 0 016.3 4.8h11.4a1 1 0 011 .7L20 10" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M4 10h16v8a1 1 0 01-1 1H5a1 1 0 01-1-1v-8z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M9 19v-5h6v5" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>',
        ],
        [
            'title' => 'Pelatihan Kewirausahaan',
            'desc'  => 'Pelatihan bisnis, pemasaran, dan pengelolaan usaha untuk meningkatkan kemampuan berwirausaha.',
            'icon'  => '<path d="M4 5h16v11H4z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M9 20h6M12 16v4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><path d="M7.5 12.5l2.4-2.6 2 1.8 3-3.3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>',
        ],
        [
            'title' => 'Pendampingan Ekonomi',
            'desc'  => 'Pendampingan berkelanjutan bagi pelaku usaha dalam pengembangan bisnis, manajemen, dan pemasaran.',
            'icon'  => '<path d="M8 12.5l2.5 2.5L16 9" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/><path d="M20 14.5A8.5 8.5 0 119.5 4a6.8 6.8 0 1010.5 10.5z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>',
        ],
        [
            'title' => 'Ekonomi Berdaya',
            'desc'  => 'Bantuan beserta pendampingannya sebagai sumber penghasilan bagi keluarga penerima manfaat.',
            'icon'  => '<path d="M12 21c-4.4 0-7-2-7-5.3 0-2 1.2-3 1.2-4.7 0-3 2.6-5.5 5.8-5.5s5.8 2.5 5.8 5.5c0 1.7 1.2 2.7 1.2 4.7 0 3.3-2.6 5.3-7 5.3z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M9.5 11.5c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>',
        ],
        [
            'title' => 'Ekonomi Kreatif',
            'desc'  => 'Pemberdayaan masyarakat melalui pelatihan dan pengembangan usaha berbasis keterampilan dan kreativitas.',
            'icon'  => '<path d="M4 5.5h16V16H4z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M2.5 19h19" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><path d="M9 16l1.2-2M15 16l-1.2-2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>',
        ],
        [
            'title' => 'Program Kemandirian Ekonomi',
            'desc'  => 'Pendampingan terpadu untuk membantu keluarga prasejahtera mencapai kemandirian ekonomi secara berkelanjutan.',
            'icon'  => '<path d="M8 12c-1.7-1.9-4.2-1.9-5.6-.4-1.4 1.5-1.3 3.9.4 5.3 1.9 1.5 4.7.7 6.2-1.4l2-2.8c1.5-2.1 4.3-2.9 6.2-1.4 1.7 1.4 1.8 3.8.4 5.3-1.4 1.5-3.9 1.5-5.6-.4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>',
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
     $berita dikirim dari ProgramController::ekonomi(), sudah difilter
     where filter_program = 'Ekonomi'.
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