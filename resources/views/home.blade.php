<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dompet Al-Qur'an Indonesia</title>
    <meta name="description" content="Salurkan amanah Anda melalui Dompet Al-Qur'an Indonesia, lembaga yang profesional, transparan, dan terpercaya.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>
<body>

@include('partials.navbar')

{{-- ==========================================================
     HERO
     ========================================================== --}}
<section class="hero">
    <div class="container">
        <div class="hero-heading">
            <p class="hero-eyebrow">
                Selamat Datang di <span>Dompet Al-Qur'an Indonesia</span>
            </p>
            <h1 class="hero-title" data-id="Banyak Jalan Menuju Kebaikan, Mari Berbagi Bersama." data-en="Many Paths to Goodness, Let's Share Together.">
                Banyak Jalan Menuju Kebaikan, Mari Berbagi Bersama.
            </h1>
            <p class="hero-subtitle" data-id="Salurkan amanah Anda melalui lembaga yang profesional, transparan, dan terpercaya untuk menciptakan perubahan yang berkelanjutan." data-en="Channel your trust through a professional, transparent, and reliable institution to create sustainable change.">
                Salurkan amanah Anda melalui lembaga yang profesional, transparan, dan terpercaya untuk menciptakan perubahan yang berkelanjutan.
            </p>
        </div>

        <div class="hero-photo-wrap reveal">
            <img src="{{ asset('assets/hero.png') }}" alt="Relawan Dompet Al-Qur'an Indonesia" class="hero-photo">

            <svg class="hero-sparkle hero-sparkle-1" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3l1.9 5.8L20 11l-6.1 2.2L12 19l-1.9-5.8L4 11l6.1-2.2L12 3z"/></svg>
            <svg class="hero-sparkle hero-sparkle-2" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3l1.9 5.8L20 11l-6.1 2.2L12 19l-1.9-5.8L4 11l6.1-2.2L12 3z"/></svg>
            <svg class="hero-sparkle hero-sparkle-3" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3l1.9 5.8L20 11l-6.1 2.2L12 19l-1.9-5.8L4 11l6.1-2.2L12 3z"/></svg>
        </div>

        <div class="hero-stats reveal">
            @foreach ($impactStats as $stat)
                <div class="hero-stat">
                    <p class="hero-stat-value">
                        <span data-counter="{{ $stat['value'] }}" data-suffix="{{ $stat['suffix'] }}">0</span>
                    </p>
                    <p class="hero-stat-label">{{ $stat['label'] }}</p>
                </div>
            @endforeach
        </div>

        <div class="hero-bottom-space"></div>
    </div>
</section>

{{-- ==========================================================
     ABOUT
     ========================================================== --}}
<section class="section-soft" id="about">
    <div class="container">
        <div class="about reveal">
            <div class="about-image">
                <img src="{{ asset('assets/about.png') }}" alt="Kegiatan Dompet Al-Qur'an Indonesia">
            </div>
            <div class="about-text">
                <h2 class="section-title">
                    Kenapa Harus <span>Dompet Al-Qur'an Indonesia?</span>
                </h2>
                <p>
                    Di tengah banyaknya pilihan, kami percaya bahwa menunaikan amanah kebaikan harus
                    dilakukan dengan penuh tanggung jawab. Karena itu, Dompet Al-Qur'an Indonesia hadir
                    sebagai mitra terbaik Anda dalam menebar manfaat dengan pengelolaan yang amanah, tim
                    yang profesional, dan penyaluran yang tepat sasaran.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- ==========================================================
     LAYANAN KEBAIKAN KAMI
     ========================================================== --}}
<section class="section-soft" id="layanan">
    <div class="container">
        <h2 class="section-title">Layanan <span>Kebaikan Kami</span></h2>

        <div class="layanan-grid reveal">
            <a href="https://api.whatsapp.com/send/?phone=6281385002300&text&type=phone_number&app_absent=0" class="layanan-card">
                <span class="layanan-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H8l-5 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2Z"/></svg>
                </span>
                <h3>Konsultasi ZISWAF</h3>
                <p>Punya pertanyaan tentang zakat, infak, sedekah, atau wakaf? Tim kami siap membantu hingga Anda paham.</p>
            </a>

            <a href="https://orangbaik.id" class="layanan-card is-highlight">
                <span class="layanan-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.8 8.6c0-2.6-2.1-4.6-4.6-4.6-1.7 0-3.2.9-4.2 2.3-1-1.4-2.5-2.3-4.2-2.3-2.5 0-4.6 2-4.6 4.6 0 4.8 8.8 10.4 8.8 10.4s8.8-5.6 8.8-10.4Z"/></svg>
                </span>
                <h3>Donasi Online</h3>
                <p>Salurkan donasi Anda kapan pun, di mana pun. Pilih program, transfer dengan mudah, kebaikan pun tersampaikan.</p>
            </a>

            <a href="https://orangbaik.id/kalkulator-banget/" class="layanan-card">
                <span class="layanan-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="2"/><line x1="8" y1="6" x2="16" y2="6"/><line x1="16" y1="18" x2="16" y2="14"/><circle cx="8.5" cy="10.5" r="0.6" fill="currentColor" stroke="none"/><circle cx="12" cy="10.5" r="0.6" fill="currentColor" stroke="none"/><circle cx="8.5" cy="14.5" r="0.6" fill="currentColor" stroke="none"/><circle cx="12" cy="14.5" r="0.6" fill="currentColor" stroke="none"/><circle cx="8.5" cy="18" r="0.6" fill="currentColor" stroke="none"/><circle cx="12" cy="18" r="0.6" fill="currentColor" stroke="none"/></svg>
                </span>
                <h3>Kalkulator Zakat</h3>
                <p>Hitung kewajiban zakat Anda secara mudah dan cepat. Masukkan datanya, dan kami bantu menghitungnya secara akurat.</p>
            </a>

            <a href="https://fliphtml5.com/bookcase/ytxkr/" class="layanan-card is-highlight">
                <span class="layanan-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                </span>
                <h3>Inspirasi Kebaikan</h3>
                <p>Ikuti cerita inspiratif serta perkembangan program-program Dompet Al-Qur'an Indonesia melalui majalah digital kami.</p>
            </a>
        </div>
    </div>
</section>

{{-- ==========================================================
     TESTIMONI
     ========================================================== --}}
<section class="section" id="testimoni">
    <div class="container">
        <div class="testimoni-card reveal">
            <h2 class="section-title testimoni-title">Apa <span>Kata Mereka?</span></h2>

            @if ($testimoni->isEmpty())
                <p class="testimoni-empty">Belum ada testimoni yang ditambahkan.</p>
            @else
                <button type="button" class="testimoni-arrow testimoni-arrow-prev" id="testimoniPrev" aria-label="Sebelumnya">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                </button>
                <button type="button" class="testimoni-arrow testimoni-arrow-next" id="testimoniNext" aria-label="Berikutnya">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                </button>

                <div class="testimoni-track">
                    @foreach ($testimoni as $item)
                        <div class="testimoni-slide">
                            <p class="testimoni-quote">&ldquo;{{ $item->isi_testimoni }}&rdquo;</p>
                            <img src="{{ asset('storage/' . $item->foto_profil) }}" alt="{{ $item->nama }}" class="testimoni-avatar">
                            <p class="testimoni-name">{{ $item->nama }}</p>
                            <p class="testimoni-role">{{ $item->jabatan }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>

{{-- ==========================================================
     MITRA KEBAIKAN KAMI
     ========================================================== --}}
<section class="section-soft">
    <div class="container">
        <div class="text-center reveal" style="margin-bottom: 32px;">
            <h2 class="section-title">Mitra <span>Kebaikan Kami</span></h2>
            <p class="section-subtitle mx-auto text-center">Kolaborasi kebaikan, bersinergi dalam menebar manfaat</p>
        </div>
    </div>

    <div class="mitra-marquee reveal">
        @php
            $mitraLogos = ['mitra-1.png', 'mitra-2.png', 'mitra-3.png', 'mitra-4.png', 'mitra-5.png', 'mitra-6.png', 'mitra-7.png'];
        @endphp
        <div class="mitra-track">
            {{-- Daftar dirender dua kali berurutan supaya animasi scroll terlihat menyambung tanpa putus --}}
            @for ($i = 0; $i < 2; $i++)
                @foreach ($mitraLogos as $logo)
                    <img src="{{ asset('assets/' . $logo) }}" alt="Logo mitra" class="mitra-logo">
                @endforeach
            @endfor
        </div>
    </div>
</section>

{{-- ==========================================================
     BERITA & INFORMASI TERKINI
     ========================================================== --}}
<section class="section-soft" id="berita">
    <div class="container">
        <h2 class="section-title"><span>Berita & Informasi</span> Terkini</h2>
        <p class="section-subtitle">
            Ikuti berbagai berita dan informasi terkini mengenai program, penyaluran, kegiatan, serta
            kisah inspiratif dari Dompet Al-Qur'an Indonesia. Kami berkomitmen menghadirkan informasi
            yang transparan, aktual, dan bermanfaat bagi masyarakat.
        </p>

        <div class="berita-tabs reveal">
            <button type="button" class="berita-tab is-active" data-filter="semua">Semua</button>
            @foreach ($kategoriOptions as $kategori)
                <button type="button" class="berita-tab" data-filter="{{ strtolower($kategori) }}">{{ $kategori }}</button>
            @endforeach
            @foreach ($filterProgramOptions as $program)
                <button type="button" class="berita-tab" data-filter="{{ strtolower($program) }}">{{ $program }}</button>
            @endforeach
        </div>

        <div class="berita-grid reveal" id="beritaGrid">
            @forelse ($berita as $item)
                <div class="berita-card is-visible"
                     data-kategori="{{ strtolower($item->kategori) }}"
                     data-program="{{ strtolower($item->filter_program) }}">
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
                                <span>{{ $item->nama_penerbit }} · {{ $item->tanggal_terbit->translatedFormat('d M Y') }}</span>
                            </span>
                            <span class="berita-badge">{{ $item->filter_program }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <p class="berita-empty">Belum ada berita yang dipublikasikan.</p>
            @endforelse

            @if ($berita->isNotEmpty())
                <p class="berita-empty" id="beritaEmpty" style="display: none;">Tidak ada berita untuk kategori ini.</p>
            @endif
        </div>

        <div class="berita-pagination" id="beritaPagination"></div>
    </div>
</section>

{{-- ==========================================================
     CTA
     ========================================================== --}}
<section class="section" id="cta">
    <div class="container cta-container">
        <div class="cta-photo">
            <img src="{{ asset('assets/cta.png') }}" alt="Bersama Dompet Al-Qur'an Indonesia" class="cta-photo-img">
        </div>

        <div class="cta-content">
            <div class="cta-top">
                <h3 class="cta-title">Siap Jadi<br><span>#JembatanKebaikan?</span></h3>

                <a href="#" class="btn btn-primary cta-btn">
                    Gabung Sekarang
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>

            <p class="cta-text">Yuk, gabung jadi penghubung kebaikan bersama relawan kebaikan lainnya!</p>
        </div>
    </div>
</section>

@include('partials.footer')

<script src="{{ asset('js/landing.js') }}"></script>
</body>
</html>