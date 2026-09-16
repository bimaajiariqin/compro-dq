<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dompet Al-Qur'an Indonesia</title>
    <meta name="description" content="Ikuti berbagai berita dan informasi terkini seputar program, penyaluran, dan kegiatan Dompet Al-Qur'an Indonesia.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/berita-mobile.css') }}">
</head>
<body>

@include('partials.navbar')

@include('partials.wa-floating')

<section class="section" style="padding-top: 32px;">
    <div class="container">

        <div class="berita-tabs reveal">
            <button type="button" class="berita-tab is-active" data-filter="semua">Semua</button>
            @foreach ($kategoriOptions as $kategori)
                <button type="button" class="berita-tab" data-filter="{{ strtolower($kategori) }}">{{ $kategori }}</button>
            @endforeach
            @foreach ($filterProgramOptions as $program)
                <button type="button" class="berita-tab" data-filter="{{ strtolower($program) }}">{{ $program }}</button>
            @endforeach
        </div>

        {{-- ============================================================
             GRID DESKTOP (tetap seperti sebelumnya, otomatis disembunyikan
             lewat CSS di berita-mobile.css saat layar <=640px)
             ============================================================ --}}
        <div class="berita-grid reveal" id="beritaGrid" data-page-size="16">
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

        {{-- ============================================================
             LIST MOBILE — editorial minimalis, satu kolom, dengan pagination
             Independen total dari .berita-card / .berita-grid desktop.
             ============================================================ --}}
        <div class="berita-mobile-list" id="beritaMobileList">
            @forelse ($berita as $item)
                <a href="{{ route('berita.show', $item) }}"
                   class="berita-mobile-item {{ $item->thumbnail ? 'has-thumb' : '' }}"
                   data-kategori="{{ strtolower($item->kategori) }}"
                   data-program="{{ strtolower($item->filter_program) }}">

                    @if ($item->thumbnail)
                        <span class="berita-mobile-thumb-wrap">
                            <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->judul }}" class="berita-mobile-thumb" loading="lazy">
                        </span>
                    @endif

                    <span class="berita-mobile-content">
                        <span class="berita-mobile-category">{{ $item->filter_program }}</span>
                        <span class="berita-mobile-title">{{ $item->judul }}</span>
                        <span class="berita-mobile-meta">{{ $item->nama_penerbit }} · {{ $item->tanggal_terbit->translatedFormat('d M Y') }}</span>
                    </span>

                    <span class="berita-mobile-arrow" aria-hidden="true"></span>
                </a>
            @empty
            @endforelse
        </div>

        <div class="berita-mobile-pagination" id="beritaMobilePagination"></div>

        @if ($berita->isNotEmpty())
            <p class="berita-mobile-empty" id="beritaMobileEmpty" style="display: none;">Tidak ada berita untuk kategori ini.</p>
        @else
            <p class="berita-mobile-empty">Belum ada berita yang dipublikasikan.</p>
        @endif

    </div>
</section>

@include('partials.footer')

<script src="{{ asset('js/berita.js') }}"></script>
</body>
</html>