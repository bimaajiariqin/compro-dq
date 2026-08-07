<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $berita->judul }} — Dompet Al-Qur'an Indonesia</title>
    <meta name="description" content="{{ \Illuminate\Support\Str::limit(strip_tags($berita->deskripsi), 160) }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/berita-detail.css') }}">
</head>
<body>

@include('partials.navbar')

@include('partials.wa-floating')

<section class="article-page">
    <div class="container">
        <div class="article-layout">

            {{-- ==================================================
                 MAIN ARTICLE
                 ================================================== --}}
            <article class="article-main">

                @if ($berita->thumbnail)
                    <div class="article-cover">
                        <img src="{{ asset('storage/' . $berita->thumbnail) }}" alt="{{ $berita->judul }}">
                    </div>
                @endif

                <h1 class="article-title">{{ $berita->judul }}</h1>

                <div class="article-byline">
                    <span class="article-byline-author">{{ $berita->nama_penerbit }}</span>
                    <span class="article-byline-date">{{ $berita->tanggal_terbit->translatedFormat('d F Y') }}</span>
                </div>

                <div class="article-body">
                    {!! $berita->deskripsi !!}
                </div>
            </article>

            {{-- ==================================================
                 SIDEBAR — BERITA LAINNYA
                 ================================================== --}}
            <aside class="article-sidebar">
                <h2 class="sidebar-title">Berita Lainnya</h2>

                @if ($beritaLainnya->isEmpty())
                    <p class="sidebar-empty">Belum ada berita lain.</p>
                @else
                    <div class="sidebar-list">
                        @foreach ($beritaLainnya as $item)
                            <a href="{{ route('berita.show', $item) }}" class="sidebar-card">
                                @if ($item->thumbnail)
                                    <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->judul }}" class="sidebar-thumb">
                                @else
                                    <div class="sidebar-thumb"></div>
                                @endif
                                <div class="sidebar-body">
                                    <h3 class="sidebar-card-title">{{ $item->judul }}</h3>
                                    <span class="sidebar-category">{{ $item->kategori }}</span>
                                    <span class="sidebar-date">{{ $item->tanggal_terbit->translatedFormat('d M Y') }}</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </aside>

        </div>
    </div>
</section>

@include('partials.footer')

<script src="{{ asset('js/landing.js') }}"></script>
</body>
</html>