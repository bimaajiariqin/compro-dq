<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dompet Al-Qur'an Indonesia</title>
    <meta name="description" content="Peduli Dakwah adalah program Dompet Al-Qur'an Indonesia yang berfokus pada penguatan syiar Islam melalui distribusi Al-Qur'an, pembinaan umat dan mualaf, serta dukungan bagi dai.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- CSS bersama seluruh situs --}}
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    {{-- CSS khusus 4 halaman Program (Pendidikan, Ekonomi, Dakwah, Kemanusiaan) --}}
    <link rel="stylesheet" href="{{ asset('css/tentang-kami.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

@include('partials.navbar')

<div class="tk">

{{-- ============ PROFIL LEMBAGA ============ --}}
<section class="hero">
    <div class="container hero__grid">
        <div class="hero__mark">
            <img src="assets/logo.png" alt="Amil Dompet Al-Qur'an">
        </div>
        <div class="fade-in">
            <h1 class="hero__title">Profil <span class="eyebrow">Lembaga</span></h1>
            <p class="hero__text">
                LAZNAS Dompet Al-Qur'an Indonesia (DQ) adalah Lembaga Amil Zakat Nasional dan Nazhir Wakaf resmi yang
                berada di bawah naungan Kementerian Agama RI dan Badan Wakaf Indonesia (BWI). LAZNAS DQ telah teraudit
                dengan predikat Wajar Tanpa Pengecualian (WTP) sebagai bentuk komitmen terhadap transparansi dan
                akuntabilitas. LAZNAS DQ mengelola dana Zakat, Infak, Sedekah, dan Wakaf untuk disalurkan melalui
                berbagai program, seperti: Pendidikan, Ekonomi, Dakwah, dan Kemanusiaan, demi mewujudkan kesejahteraan
                masyarakat secara berkelanjutan.
            </p>
        </div>
    </div>
</section>

{{-- ============ VISI & MISI ============ --}}
<section class="section">
    <div class="container visi-misi">
        <div class="fade-in">
            <h2 class="section-title">Visi & Misi <span class="eyebrow">Lembaga</span></h2>

            <div class="vm-block">
                <span class="vm-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 2l3 7h7l-5.5 4.5L18.5 21 12 16.5 5.5 21 7.5 13.5 2 9h7l3-7z" fill="currentColor"/></svg>
                </span>
                <div>
                    <h3>Visi Lembaga</h3>
                    <p>
                        Menjadi Lembaga Profesional dalam Pemberdayaan dan Pelayanan serta membangun masyarakat yang
                        akrab dengan Al-Qur'an.
                    </p>
                </div>
            </div>

            <div class="vm-block">
                <span class="vm-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke="currentColor" stroke-width="2"/></svg>
                </span>
                <div style="flex:1;">
                    <h3>Misi Lembaga</h3>
                    <ol>
                        <li>Aktif dalam membangun jaringan filantropi yang profesional</li>
                        <li>Meningkatkan kemandirian dan mengakrabkan masyarakat Indonesia dengan Al-Qur'an</li>
                        <li>Meningkatkan sumber daya melalui keunggulan lembaga</li>
                    </ol>
                    <p class="vm-note">
                        Menjadi landasan dalam menciptakan masa depan yang lebih baik melalui inovasi, integritas, dan pelayanan.
                    </p>
                </div>
            </div>
        </div>

        <div class="visi-misi__image fade-in">
            <img src="assets/visi-misi.png" alt="Amil Dompet Al-Qur'an">
        </div>
    </div>
</section>

{{-- ============ LEGALITAS LEMBAGA ============ --}}
{{-- FIX: badge huruf diganti dengan foto/logo asli dari public/images/legalitas --}}
<section class="section section--soft">
    <div class="container">
        <h2 class="section-title">Legalitas <span class="eyebrow">Lembaga</span></h2>
        <p class="section-lead">
            Lembaga kami beroperasi secara resmi dan profesional dengan legalitas yang sah sesuai peraturan berlaku,
            sebagai bentuk komitmen dalam membangun kepercayaan, transparansi, dan pelayanan yang bertanggung jawab.
        </p>

        <div class="legalitas-grid">
            @foreach ($legalitas as $item)
                <div class="legalitas-card">
                    <span class="legalitas-card__badge">
                        <img src="{{ asset('assets/' . $item['icon'] . '.png') }}"
                             alt="{{ $item['nama'] }}"
                             loading="lazy">
                    </span>
                    <p class="legalitas-card__label">{{ $item['label'] }}</p>
                    <a href="{{ $item['link'] }}" target="_blank" rel="noopener" class="legalitas-card__link">
                        Lihat Izin
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none"><path d="M7 17L17 7M7 7h10v10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============ LAPORAN KEUANGAN ============ --}}
{{-- Link langsung ke dokumen PDF (dibuka di tab baru, memakai viewer PDF bawaan browser) --}}
<section class="section">
    <div class="container">
        <h2 class="section-title">Laporan <span class="eyebrow">Keuangan</span></h2>
        <p class="section-lead">
            Lihat laporan keuangan orangbaik.id yang telah diaudit secara independen setiap tahun sebagai wujud komitmen
            kami terhadap transparansi dan pengelolaan dana yang amanah.
        </p>

        @if ($laporanKeuangan->isEmpty())
            <p class="lk-empty">Belum ada laporan keuangan yang tersedia.</p>
        @else
            <div class="year-tabs" id="lk-tabs">
                @foreach ($laporanKeuangan as $i => $lk)
                    <button
                        type="button"
                        class="year-tab {{ $i === 0 ? 'is-active' : '' }}"
                        data-lk-target="lk-panel-{{ $lk->tahun }}"
                    >{{ $lk->tahun }}</button>
                @endforeach
            </div>

            <div id="lk-panels">
                @foreach ($laporanKeuangan as $i => $lk)
                    @php
                        // Jika di DB sudah berupa URL penuh (http/https) pakai apa adanya.
                        // Jika berupa path relatif hasil Storage::put() (mis. "laporan/2024.pdf"),
                        // ubah ke URL publik lewat Storage::url() — inilah penyebab "not found"
                        // sebelumnya karena path relatif dipakai langsung sebagai href.
                        $lkUrl = \Illuminate\Support\Str::startsWith($lk->link_dokumen, ['http://', 'https://'])
                            ? $lk->link_dokumen
                            : \Illuminate\Support\Facades\Storage::url($lk->link_dokumen);
                    @endphp
                    <div id="lk-panel-{{ $lk->tahun }}" class="lk-panel {{ $i === 0 ? '' : 'is-hidden' }}">
                        <a href="{{ $lkUrl }}" target="_blank" rel="noopener" class="lk-doc">
                            <span class="lk-doc__label">
                                <span class="lk-doc__icon">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6z" stroke="currentColor" stroke-width="2"/><path d="M14 2v6h6" stroke="currentColor" stroke-width="2"/></svg>
                                </span>
                                <span class="lk-doc__text">Laporan Keuangan {{ $lk->tahun }}</span>
                            </span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M9 6l6 6-6 6" stroke="#9AA1AF" stroke-width="2" stroke-linecap="round"/></svg>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- ============ AWAL PERJALANAN KAMI ============ --}}
{{-- FIX: didesain ulang mengikuti referensi desain (jalur zig-zag melengkung
     dengan kartu berselang-seling solid/outline dan logo opsional). --}}
<section class="section section--soft">
    <div class="container">
        <h2 class="section-title">Awal <span class="eyebrow">Perjalanan Kami</span></h2>
        <p class="section-lead">
            Sejak awal berdiri, Dompet Al-Qur'an Indonesia berkomitmen menjadi jembatan kebaikan yang amanah,
            profesional, dan berdampak bagi masyarakat.
        </p>

        <div class="journey" id="journey">
            @foreach ($riwayat as $i => $r)
                <div class="journey__item journey__item--reveal" style="transition-delay: {{ $i * 80 }}ms">
                    <div class="journey__marker">
                        <span class="journey__dot"></span>
                    </div>
                    <div class="journey__content">
                        <span class="journey__date">{{ $r['tanggal'] }}</span>
                        <h3 class="journey__title">{{ $r['judul'] }}</h3>
                        <div class="journey__body">
                            @if(!empty($r['logo']))
                                <img class="journey__logo" src="{{ asset('assets/' . $r['logo'] . '.png') }}" alt="{{ $r['judul'] }}">
                            @endif
                            <p class="journey__desc">{{ $r['desc'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============ PROFIL KEPENGURUSAN ============ --}}
{{-- FIX: foto asli dari public/images/pengurus, grid dipusatkan (flex + center).
     Ketua/pimpinan kelompok (is_ketua) diberi class tambahan
     "pengurus-card--ketua" supaya di mobile bisa ditata terpisah
     di baris atas, dengan anggota lain di bawahnya. --}}
<section class="section">
    <div class="container">
        <h2 class="section-title">Profil <span class="eyebrow">Kepengurusan</span></h2>
        <p class="section-lead">
            Lembaga Dompet Al-Qur'an Indonesia (DQ) dikelola oleh tim profesional yang berkomitmen untuk mengelola dengan
            amanah dan transparan.
        </p>

        @foreach ($kepengurusan as $kelompok => $anggota)
            <div class="pengurus-group">
                <h3 class="pengurus-group__title">{{ $kelompok }}</h3>
                <div class="pengurus-grid">
                    @foreach ($anggota as $orang)
                        <div class="pengurus-card {{ !empty($orang['is_ketua']) ? 'pengurus-card--ketua' : '' }}">
                            <img src="{{ asset('assets/' . $orang['foto']) }}" alt="{{ $orang['nama'] }}" loading="lazy">
                            <p class="pengurus-card__name">{{ $orang['nama'] }}</p>
                            <p class="pengurus-card__role">{{ $orang['jabatan'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</section>

{{-- ============ PENGHARGAAN ============ --}}
{{-- Diramping-kan: kartu kecil, hanya thumbnail + badge tahun + judul singkat,
     karena isinya cuma sertifikat (tidak butuh detail org/tanggal yang panjang). --}}
<section class="section section--soft">
    <div class="container">
        <h2 class="section-title">Penghargaan <span class="eyebrow">yang di Peroleh</span></h2>
        <p class="section-lead">
            Apresiasi atas komitmen kami dalam menghadirkan pelayanan yang amanah, profesional, dan berdampak bagi
            masyarakat.
        </p>

        @if ($penghargaan->isEmpty())
            <p class="pgh-empty">Belum ada penghargaan yang tersedia.</p>
        @else
            <div class="year-tabs" id="pgh-tabs">
                @foreach ($penghargaan as $tahun => $items)
                    <button
                        type="button"
                        class="year-tab {{ $loop->first ? 'is-active' : '' }}"
                        data-pgh-target="pgh-panel-{{ $tahun }}"
                    >{{ $tahun }}</button>
                @endforeach
            </div>

            <div id="pgh-panels">
                @foreach ($penghargaan as $tahun => $items)
                    <div id="pgh-panel-{{ $tahun }}" class="pgh-panel {{ $loop->first ? '' : 'is-hidden' }}">
                        <div class="pgh-grid">
                            @foreach ($items as $award)
                                @php
                                    $pghFallback = 'https://placehold.co/400x300/EAF0FB/3365AF?text=Penghargaan';
                                    $toUrl = fn ($path) => $path
                                        ? (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://'])
                                            ? $path
                                            : \Illuminate\Support\Facades\Storage::url($path))
                                        : null;
                                    // Sebagian data mungkin hanya punya kolom `dokumen` (belum ada kolom
                                    // `gambar` terpisah) — pakai itu sebagai gambar kalau `gambar` kosong,
                                    // supaya foto penghargaan yang sudah diupload tetap tampil.
                                    $pghImg = $toUrl($award->gambar) ?? $toUrl($award->dokumen) ?? $pghFallback;
                                    $pghDoc = $toUrl($award->dokumen) ?? '#';
                                @endphp
                                <a href="{{ $pghDoc }}" target="_blank" rel="noopener" class="pgh-card">
                                    <div class="pgh-card__thumb">
                                        <img src="{{ $pghImg }}" alt="{{ $award->judul }}" loading="lazy"
                                             onerror="this.onerror=null;this.src='{{ $pghFallback }}';">
                                        <span class="pgh-card__year">{{ $tahun }}</span>
                                    </div>
                                    <div class="pgh-card__body">
                                        <p class="pgh-card__title">{{ $award->judul }}</p>
                                        <p class="pgh-card__date">
                                            {{ optional($award->tanggal_terbit)->translatedFormat('d F Y') }}
                                        </p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

</div>{{-- /.tk --}}

@include('partials.footer')


<script>
    // Animasi reveal untuk Awal Perjalanan Kami: setiap item muncul (fade + slide)
    // saat scroll masuk viewport, dengan jeda bertahap antar item.
    (function () {
        const rows = document.querySelectorAll('.journey__item--reveal');
        if (!rows.length) return;

        if (!('IntersectionObserver' in window)) {
            rows.forEach(row => row.classList.add('is-visible'));
            return;
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.25, rootMargin: '0px 0px -60px 0px' });

        rows.forEach(row => observer.observe(row));
    })();

    // Tab switcher: Laporan Keuangan
    document.querySelectorAll('#lk-tabs .year-tab').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('#lk-tabs .year-tab').forEach(b => b.classList.remove('is-active'));
            btn.classList.add('is-active');
            document.querySelectorAll('.lk-panel').forEach(p => p.classList.add('is-hidden'));
            document.getElementById(btn.dataset.lkTarget).classList.remove('is-hidden');
        });
    });

    // Tab switcher: Penghargaan
    document.querySelectorAll('#pgh-tabs .year-tab').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('#pgh-tabs .year-tab').forEach(b => b.classList.remove('is-active'));
            btn.classList.add('is-active');
            document.querySelectorAll('.pgh-panel').forEach(p => p.classList.add('is-hidden'));
            document.getElementById(btn.dataset.pghTarget).classList.remove('is-hidden');
        });
    });
</script>

</body>
</html>