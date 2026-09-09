<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Peduli Ekonomi</title>
    <meta name="description" content="Peduli Ekonomi adalah program Dompet Al-Qur'an Indonesia yang berfokus pada pemberdayaan ekonomi masyarakat prasejahtera melalui bantuan modal usaha, pelatihan keterampilan, dan pendampingan usaha.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- CSS bersama seluruh situs --}}
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
        <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    {{-- CSS khusus 4 halaman Program (Pendidikan, Ekonomi, Dakwah, Kemanusiaan) --}}
    <link rel="stylesheet" href="{{ asset('css/program.css') }}">
    {{-- CSS section "Cerita Penerima Manfaat" --}}
    <link rel="stylesheet" href="{{ asset('css/cerita-penerima-manfaat.css') }}">
    {{-- CSS section "FAQ" --}}
    <link rel="stylesheet" href="{{ asset('css/faq.css') }}">

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
            <img src="{{ asset('assets/ekonomi (1).png') }}" alt="Program Peduli Ekonomi" class="program-hero__img">
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
     $programPokok dikirim dari ProgramController::kemanusiaan(), sudah
     difilter where kategori_program = 'Kemanusiaan' (tabel program_pokok).
     ===================================================================== --}}
<section class="section program-pokok" id="program-pokok">
    <div class="container">

        <h2 class="section-title">Program <span>Pokok</span> Kami</h2>

        <div class="program-pokok__grid">
            @forelse ($programPokok as $item)
                <div class="program-pokok__card">

                    {{-- Panel foto + judul besar overlay. Kalau item punya link,
                         seluruh panel foto ini yang jadi area klik-nya. --}}
                    @if ($item->link)
                        <a href="{{ $item->link }}" target="_blank" rel="noopener" class="program-pokok__icon">
                            <span class="program-pokok__icon-title">{{ $item->judul }}</span>
                            @if ($item->icon)
                                <img src="{{ asset('storage/' . $item->icon) }}" alt="{{ $item->judul }}">
                            @endif
                        </a>
                    @else
                        <div class="program-pokok__icon">
                            <span class="program-pokok__icon-title">{{ $item->judul }}</span>
                            @if ($item->icon)
                                <img src="{{ asset('storage/' . $item->icon) }}" alt="{{ $item->judul }}">
                            @endif
                        </div>
                    @endif

                    {{-- Judul, deskripsi, dan tombol donasi --}}
                    <div class="program-pokok__content">
                        <h3 class="program-pokok__title">{{ $item->judul }}</h3>
                        <p class="program-pokok__desc">{{ $item->deskripsi }}</p>
                        <div class="program-pokok__actions">
                            <a href="{{ $item->link ?: route('rekening.index') }}"
                               @if ($item->link) target="_blank" rel="noopener" @endif
                               class="program-pokok__btn program-pokok__btn--donasi">
                                Donasi Sekarang
                            </a>
                        </div>
                    </div>

                </div>
            @empty
                <p class="program-pokok__empty">Belum ada program pokok untuk kategori ini.</p>
            @endforelse
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
{{-- ==================== Cerita Penerima Manfaat ==================== --}}
<section class="cpm">
    <div class="container">

        <h2 class="cpm__heading">
            Cerita sederhana,
            <strong>menjadi bagian program kami</strong>
        </h2>

        <div class="cpm__inner">

            {{-- Kolom intro --}}
            <div class="cpm__intro">
                <span class="cpm__quote-icon">
                    <svg viewBox="0 0 44 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 34V20.4C0 14.2 1.6 9 4.8 4.8 8 1.6 12 0 16.8 0v6.4c-2.8 0-5 .9-6.6 2.7-1.6 1.7-2.4 4-2.4 6.9h9v18h-16.8Z" fill="currentColor"/>
                        <path d="M22.8 34V20.4c0-6.2 1.6-11.4 4.8-15.6C30.8 1.6 34.8 0 39.6 0V6.4c-2.8 0-5 .9-6.6 2.7-1.6 1.7-2.4 4-2.4 6.9h9v18H22.8Z" fill="currentColor"/>
                    </svg>
                </span>

                <h3 class="cpm__title">Suara penerima manfaat program kami</h3>

                <div class="cpm__nav">
                    <button type="button" class="cpm__arrow" data-cpm-prev aria-label="Sebelumnya">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 12H5"/><path d="m12 19-7-7 7-7"/>
                        </svg>
                    </button>
                    <span class="cpm__nav-line"></span>
                    <button type="button" class="cpm__arrow" data-cpm-next aria-label="Berikutnya">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Slider card --}}
            <div class="cpm__slider" data-cpm-slider>
                <div class="cpm__track" data-cpm-track>
                    @forelse ($ceritaPenerimaManfaat as $cerita)
                        <div class="cpm__card" data-cpm-item>
                            <span class="cpm__card-quote">
                                <svg viewBox="0 0 44 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 34V20.4C0 14.2 1.6 9 4.8 4.8 8 1.6 12 0 16.8 0v6.4c-2.8 0-5 .9-6.6 2.7-1.6 1.7-2.4 4-2.4 6.9h9v18H0Z" fill="currentColor"/>
                                    <path d="M22.8 34V20.4c0-6.2 1.6-11.4 4.8-15.6C30.8 1.6 34.8 0 39.6 0V6.4c-2.8 0-5 .9-6.6 2.7-1.6 1.7-2.4 4-2.4 6.9h9v18H22.8Z" fill="currentColor"/>
                                </svg>
                            </span>

                            <p class="cpm__card-text">&ldquo;{{ $cerita->isi_cerita }}&rdquo;</p>

                            <div class="cpm__card-person">
                                <span class="cpm__card-name">{{ $cerita->nama }}</span>
                                @if ($cerita->jabatan)
                                    <span class="cpm__card-role">{{ $cerita->jabatan }}</span>
                                @endif
                            </div>

                            @if ($cerita->foto)
                                <img src="{{ asset('storage/' . $cerita->foto) }}" alt="{{ $cerita->nama }}" class="cpm__card-avatar">
                            @else
                                <span class="cpm__card-avatar cpm__card-avatar--placeholder">
                                    {{ strtoupper(substr($cerita->nama, 0, 1)) }}
                                </span>
                            @endif
                        </div>
                    @empty
                        <p class="berita-empty">Belum ada cerita penerima manfaat.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
{{-- ==================== /Cerita Penerima Manfaat ==================== --}}

{{-- ==================== FAQ ====================
     $faqs dikirim dari ProgramController::dakwah(), sudah difilter
     Faq::aktif()->kategori('Dakwah')->terurut()->get()
     ===================================================================== --}}
<section class="section faq" id="faq">
    <div class="container">

        <h2 class="faq__title">Pertanyaan Yang Sering Diajukan</h2>

        <div class="faq__list" data-faq-list>
            @forelse ($faqs as $item)
                <div class="faq__item" data-faq-item>
                    <button
                        type="button"
                        class="faq__question"
                        data-faq-toggle
                        aria-expanded="false"
                        aria-controls="faq-answer-{{ $item->id }}"
                    >
                        <span>{{ $item->pertanyaan }}</span>
                        <span class="faq__icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 5V19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </span>
                    </button>

                    <div
                        class="faq__answer"
                        id="faq-answer-{{ $item->id }}"
                        data-faq-answer
                    >
                        <div class="faq__answer-inner">
                            {{ $item->jawaban }}
                        </div>
                    </div>
                </div>
            @empty
                <p class="faq__empty">Belum ada pertanyaan untuk kategori ini.</p>
            @endforelse
        </div>

    </div>
</section>

@include('partials.footer')

<script src="{{ asset('js/program-berita-slider.js') }}"></script>
<script src="{{ asset('js/cerita-penerima-manfaat-slider.js') }}"></script>
<script src="{{ asset('js/faq-accordion.js') }}"></script>
</body>
</html>