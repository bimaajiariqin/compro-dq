<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Peduli Dakwah — Dompet Al-Qur'an Indonesia</title>
    <meta name="description" content="Peduli Dakwah adalah program Dompet Al-Qur'an Indonesia yang berfokus pada penguatan syiar Islam melalui distribusi Al-Qur'an, pembinaan umat dan mualaf, serta dukungan bagi dai.">

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
            <img src="{{ asset('assets/dakwah-hero.png') }}" alt="Program Peduli Dakwah" class="program-hero__img">
        </div>

        <div class="program-hero__content">
            <h1 class="program-hero__title">Program <span>Peduli Dakwah</span></h1>
            <p class="program-hero__desc">
                Peduli Dakwah merupakan program Dompet Al-Qur'an Indonesia yang berfokus pada penguatan syiar
                Islam melalui distribusi Al-Qur'an, pembinaan umat dan mualaf, dukungan bagi dai, serta
                pengembangan sarana ibadah dan pendidikan keislaman. Program ini bertujuan memperluas akses
                pembelajaran Islam, menumbuhkan nilai-nilai Qurani, serta membangun masyarakat yang beriman,
                berakhlak mulia, dan memberikan manfaat bagi sesama.
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
            'title' => 'Safari Dakwah',
            'desc'  => 'Kegiatan dakwah dan pembinaan ke daerah terpencil, pedalaman, atau wilayah dengan akses dakwah yang terbatas.',
            'icon'  => '<path d="M12 21c4-4.5 7-8.4 7-11.5A7 7 0 105 9.5C5 12.6 8 16.5 12 21z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M12 12.2a2.7 2.7 0 100-5.4 2.7 2.7 0 000 5.4z" stroke="currentColor" stroke-width="1.7"/>',
        ],
        [
            'title' => 'Rumah Belajar Qurani',
            'desc'  => "Program pendampingan belajar yang menggabungkan pelajaran akademik dengan pembelajaran Al-Qur'an dan nilai-nilai Islam.",
            'icon'  => '<path d="M4 11.5L12 4l8 7.5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/><path d="M6 10v9a1 1 0 001 1h10a1 1 0 001-1v-9" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M10 20v-5h4v5" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>',
        ],
        [
            'title' => "Distribusi Al-Qur'an & Buku Islami",
            'desc'  => "Penyaluran Al-Qur'an, Iqra', buku-buku Islami, dan buku edukatif untuk mendukung kegiatan belajar dan meningkatkan literasi keislaman.",
            'icon'  => '<path d="M12 6.5c-1.7-1-4-1.5-6.5-1.5v13c2.5 0 4.8.5 6.5 1.5" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M12 6.5c1.7-1 4-1.5 6.5-1.5v13c-2.5 0-4.8.5-6.5 1.5V6.5z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>',
        ],
        [
            'title' => 'Pembinaan Karakter Islami',
            'desc'  => 'Kegiatan pembinaan akhlak, kepemimpinan, dan pembiasaan ibadah untuk membentuk generasi yang berkarakter mulia.',
            'icon'  => '<path d="M20 14.5A8.5 8.5 0 119.5 4a6.8 6.8 0 1010.5 10.5z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>',
        ],
        [
            'title' => 'Masjid Berdaya',
            'desc'  => 'Pemberdayaan masjid melalui dukungan sarana ibadah, kegiatan dakwah, dan program pembinaan jamaah.',
            'icon'  => '<path d="M4 20V11l3.5-3 3-3.5L14 8l3.5 3V20" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M4 20h16M9 20v-5a1.5 1.5 0 013 0v5" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M9.5 4.2a1 1 0 112 0" stroke="currentColor" stroke-width="1.7"/>',
        ],
        [
            'title' => 'Layanan Mualaf',
            'desc'  => 'Program pembinaan dan pendampingan bagi mualaf untuk memperkuat pemahaman serta pengamalan ajaran Islam.',
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
     $berita dikirim dari ProgramController::dakwah(), sudah difilter
     where filter_program = 'Dakwah'.
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