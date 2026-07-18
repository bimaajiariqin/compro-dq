<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekening Donasi — Dompet Al-Qur'an Indonesia</title>
    <meta name="description" content="Salurkan zakat, infak, sedekah, dan wakaf Anda melalui rekening resmi Dompet Al-Qur'an Indonesia.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/rekening-donasi.css') }}">
</head>
<body>

@include('partials.navbar')

<section class="rekening-page">
    <div class="container">

        <div class="rekening-heading">
            <h1 class="rekening-title">Rekening <span>Dompet Al-Qur'an Indonesia</span></h1>
            <p class="rekening-subtitle">
                Salurkan zakat, infak, sedekah, dan wakaf Anda dengan mudah melalui rekening resmi
                Dompet Al-Qur'an Indonesia. Setiap amanah yang Anda titipkan dikelola secara profesional,
                transparan, dan tepat sasaran untuk menghadirkan manfaat bagi umat.
            </p>
        </div>

        @forelse (['Infaq', 'Zakat', 'Wakaf'] as $kategori)
            @if (isset($rekeningByKategori[$kategori]) && $rekeningByKategori[$kategori]->isNotEmpty())
                <div class="rekening-group">
                    <h2 class="rekening-group-title">Rekening <span>{{ $kategori }}</span></h2>

                    <div class="rekening-grid">
                        @foreach ($rekeningByKategori[$kategori] as $item)
                            <div class="rekening-card">
                                <div class="rekening-logo">
                                    @if ($item->logo)
                                        <img src="{{ asset('storage/' . $item->logo) }}" alt="{{ $item->nama_bank }}">
                                    @else
                                        <span class="rekening-logo-fallback">{{ \Illuminate\Support\Str::limit($item->nama_bank, 3, '') }}</span>
                                    @endif
                                </div>

                                <div class="rekening-info">
                                    <p class="rekening-number">{{ $item->no_rekening }}</p>
                                    <p class="rekening-owner">a/n {{ $item->atas_nama }}</p>
                                </div>

                                <button type="button" class="rekening-copy" data-copy="{{ $item->no_rekening }}">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/>
                                    </svg>
                                    <span class="rekening-copy-label">Salin</span>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @empty
        @endforelse

        @if ($rekeningByKategori->isEmpty())
            <p class="rekening-empty">Belum ada rekening donasi yang ditambahkan.</p>
        @endif

    </div>
</section>

@include('partials.footer')

<script src="{{ asset('js/landing.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.rekening-copy').forEach(function (button) {
            var label = button.querySelector('.rekening-copy-label');
            var defaultText = label.textContent;

            button.addEventListener('click', function () {
                var value = button.dataset.copy;

                navigator.clipboard.writeText(value).then(function () {
                    button.classList.add('is-copied');
                    label.textContent = 'Tersalin!';

                    setTimeout(function () {
                        button.classList.remove('is-copied');
                        label.textContent = defaultText;
                    }, 1800);
                });
            });
        });
    });
</script>
</body>
</html>