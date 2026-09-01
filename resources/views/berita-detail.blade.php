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
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
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

                {{-- ==================================================
                     SHARE
                     ================================================== --}}
                <div class="article-share" id="articleShare" data-url="{{ url()->current() }}" data-title="{{ $berita->judul }}">
                    <span class="article-share-label">Bagikan:</span>
                    <div class="article-share-list">

                        <a class="article-share-btn article-share-btn--whatsapp"
                           href="https://api.whatsapp.com/send?text={{ urlencode($berita->judul . ' - ' . url()->current()) }}"
                           target="_blank" rel="noopener noreferrer" aria-label="Bagikan ke WhatsApp">
                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12.001 2C6.478 2 2 6.478 2 12c0 1.98.579 3.827 1.578 5.38L2 22l4.75-1.548A9.953 9.953 0 0 0 12.001 22c5.523 0 10-4.477 10-10s-4.477-10-10-10zm0 18.222a8.2 8.2 0 0 1-4.19-1.148l-.3-.178-3.12 1.016 1.03-3.037-.196-.312A8.223 8.223 0 1 1 20.222 12a8.23 8.23 0 0 1-8.221 8.222z"/></svg>
                        </a>

                        <a class="article-share-btn article-share-btn--facebook"
                           href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                           target="_blank" rel="noopener noreferrer" aria-label="Bagikan ke Facebook">
                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M22 12.06C22 6.5 17.52 2 12 2S2 6.5 2 12.06c0 5.02 3.66 9.18 8.44 9.94v-7.03H7.9v-2.91h2.54V9.85c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.24.2 2.24.2v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56v1.88h2.78l-.44 2.91h-2.34V22c4.78-.76 8.44-4.92 8.44-9.94z"/></svg>
                        </a>

                        <a class="article-share-btn article-share-btn--twitter"
                           href="https://twitter.com/intent/tweet?text={{ urlencode($berita->judul) }}&url={{ urlencode(url()->current()) }}"
                           target="_blank" rel="noopener noreferrer" aria-label="Bagikan ke X / Twitter">
                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>

                        <a class="article-share-btn article-share-btn--telegram"
                           href="https://t.me/share/url?url={{ urlencode(url()->current()) }}&text={{ urlencode($berita->judul) }}"
                           target="_blank" rel="noopener noreferrer" aria-label="Bagikan ke Telegram">
                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M21.94 4.36c.28-1.14-.86-2.05-1.94-1.62L2.4 9.87c-1.18.46-1.17 2.14.02 2.58l4.32 1.6 1.68 5.44c.27.87 1.36 1.13 2.02.5l2.4-2.28 4.48 3.31c.94.7 2.29.2 2.54-.94l3.08-14.72zM8.5 13.6l9.4-6.02c.35-.22.7.22.4.5l-7.6 6.9-.3 3.4-1.9-4.78z"/></svg>
                        </a>

                        <button type="button" class="article-share-btn article-share-btn--copy" id="copyLinkBtn" aria-label="Salin tautan">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.07 0l2.83-2.83a5 5 0 0 0-7.07-7.07l-1.5 1.5"/><path d="M14 11a5 5 0 0 0-7.07 0l-2.83 2.83a5 5 0 0 0 7.07 7.07l1.5-1.5"/></svg>
                        </button>

                    </div>
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
<script>
document.addEventListener('DOMContentLoaded', function () {
    const shareBlock = document.getElementById('articleShare');
    const copyBtn = document.getElementById('copyLinkBtn');
    if (!shareBlock || !copyBtn) return;

    copyBtn.addEventListener('click', async function () {
        const url = shareBlock.dataset.url;
        try {
            await navigator.clipboard.writeText(url);
        } catch (e) {
            // fallback untuk browser lama / non-HTTPS
            const temp = document.createElement('textarea');
            temp.value = url;
            document.body.appendChild(temp);
            temp.select();
            document.execCommand('copy');
            document.body.removeChild(temp);
        }
        copyBtn.classList.add('is-copied');
        setTimeout(() => copyBtn.classList.remove('is-copied'), 1600);
    });
});
</script>
</body>
</html>