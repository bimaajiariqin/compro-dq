<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Peduli Dakwah</title>
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

@include('partials.wa-floating')

{{-- =====================================================================
     HERO
     ===================================================================== --}}
<section class="program-hero">
    <div class="container program-hero__inner">

        <div class="program-hero__media">
            <img src="{{ asset('assets/dakwah.png') }}" alt="Program Peduli Dakwah" class="program-hero__img">
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
     $programPokok dikirim dari ProgramController::dakwah(), sudah
     difilter where kategori_program = 'Dakwah' (tabel program_pokok).
     ===================================================================== --}}
<section class="section program-pokok" id="program-pokok">
    <div class="container">

        <h2 class="section-title">Program <span>Pokok</span> Kami</h2>

        <div class="program-pokok__grid">
            @forelse ($programPokok as $item)
                @if ($item->link)
                    <a href="{{ $item->link }}" target="_blank" rel="noopener" class="program-pokok__card">
                        <span class="program-pokok__icon">
                            @if ($item->icon)
                                <img src="{{ asset('storage/' . $item->icon) }}" alt="{{ $item->judul }}">
                            @endif
                        </span>
                        <h3 class="program-pokok__title">{{ $item->judul }}</h3>
                        <p class="program-pokok__desc">{{ $item->deskripsi }}</p>
                    </a>
                @else
                    <div class="program-pokok__card">
                        <span class="program-pokok__icon">
                            @if ($item->icon)
                                <img src="{{ asset('storage/' . $item->icon) }}" alt="{{ $item->judul }}">
                            @endif
                        </span>
                        <h3 class="program-pokok__title">{{ $item->judul }}</h3>
                        <p class="program-pokok__desc">{{ $item->deskripsi }}</p>
                    </div>
                @endif
            @empty
                <p class="program-pokok__empty">Belum ada program pokok untuk kategori ini.</p>
            @endforelse
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