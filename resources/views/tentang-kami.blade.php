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
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    {{-- CSS khusus 4 halaman Program (Pendidikan, Ekonomi, Dakwah, Kemanusiaan) --}}
    <link rel="stylesheet" href="{{ asset('css/tentang-kami.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

@include('partials.navbar')

@include('partials.wa-floating')

<div class="tk">

{{-- ============ PROFIL LEMBAGA ============ --}}
<section class="hero">
    <div class="container hero__grid">
        <div class="hero__mark">
            <img src="assets/logo-1.png" alt="Amil Dompet Al-Qur'an">
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
                <span class="vm-icon vm-icon--visi">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                        <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/>
                    </svg>
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
                <span class="vm-icon vm-icon--misi">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                        <path d="M4 22V4a1 1 0 011-1h13.5a.5.5 0 01.4.8l-3.4 4.2 3.4 4.2a.5.5 0 01-.4.8H5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
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
                        @if ($item->icon)
                            <img src="{{ asset('storage/' . $item->icon) }}"
                                 alt="{{ $item->nama }}"
                                 loading="lazy">
                        @else
                            <span class="legalitas-card__badge-fallback">{{ Str::substr($item->nama, 0, 1) }}</span>
                        @endif
                    </span>
                    <p class="legalitas-card__label">{{ $item->label }}</p>
                    @if ($item->link)
                        <a href="{{ $item->link }}" target="_blank" rel="noopener" class="legalitas-card__link">
                            Lihat Izin
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none"><path d="M7 17L17 7M7 7h10v10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                        </a>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============ LAPORAN KEUANGAN ============ --}}
{{-- Link langsung ke dokumen PDF (dibuka di tab baru, memakai viewer PDF bawaan browser) --}}
<section class="section-blue">
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
{{-- Timeline "gunung" zigzag: titik naik-turun bergantian dengan label
     di atas (puncak) / di bawah (lembah), tag tahun berbentuk pita,
     dan garis tebal yang menghubungkan tiap titik. Garis digambar via
     SVG + JS supaya presisi mengikuti posisi titik meski jumlah item
     dari database berbeda-beda (tidak hardcode 5 titik). Tinggi chart
     dan jarak puncak/lembah (--peak/--valley) JUGA dihitung via JS dari
     tinggi label asli, supaya deskripsi panjang apa pun tidak kepotong
     vertikal (lihat adjustJourneyHeight di bawah). --}}
<section class="section journey-section">
    <div class="container">
        <div class="journey-head fade-in">
            <h2 class="section-title">Awal <span class="eyebrow">Perjalanan Kami</span></h2>
            <p class="section-lead">
                Sejak awal berdiri, Dompet Al-Qur'an Indonesia berkomitmen menjadi jembatan kebaikan yang amanah,
                profesional, dan berdampak bagi masyarakat.
            </p>
        </div>

        <div class="journey-wrap">
            <button type="button" class="journey-arrow journey-arrow--prev" id="journeyPrev" aria-label="Sebelumnya">
                <svg viewBox="0 0 24 24" fill="none"><path d="M15 6l-6 6 6 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>

            <div class="journey" id="journey">
                <div class="journey__chart" id="journeyChart">
                    <svg class="journey__svg" id="journeySvg" preserveAspectRatio="none">
                        <path id="journeyShadowPath" class="journey__line-shadow"></path>
                        <path id="journeyLinePath" class="journey__line"></path>
                    </svg>

                    @foreach ($riwayat as $i => $r)
                        @php $pos = $i % 2 === 0 ? 'top' : 'bottom'; @endphp
                        <div class="journey__point journey__point--{{ $pos }}" style="--d: {{ $i * 90 }}ms">
                            <div class="journey__label">
                                <span class="journey__tag">{{ $r->tanggal }}</span>
                                <div class="journey__label-row">
                                    <span class="journey__icon">
                                        @if($r->logo)
                                            <img src="{{ asset('storage/' . $r->logo) }}" alt="{{ $r->judul }}">
                                        @else
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M12 2l2.4 6.6L21 11l-6.6 2.4L12 20l-2.4-6.6L3 11l6.6-2.4L12 2z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>
                                        @endif
                                    </span>
                                    <div class="journey__text">
                                        <h3 class="journey__title">{{ $r->judul }}</h3>
                                        <p class="journey__desc">{{ $r->deskripsi }}</p>
                                    </div>
                                </div>
                            </div>
                            <span class="journey__stem"></span>
                            <span class="journey__dot"></span>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="button" class="journey-arrow journey-arrow--next" id="journeyNext" aria-label="Selanjutnya">
                <svg viewBox="0 0 24 24" fill="none"><path d="M9 6l6 6-6 6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
        </div>
    </div>
</section>

{{-- ============ PROFIL KEPENGURUSAN ============ --}}
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
                        <div class="pengurus-card {{ $orang->is_ketua ? 'pengurus-card--ketua' : '' }}">
                            @if ($orang->foto)
                                <img src="{{ asset('storage/' . $orang->foto) }}" alt="{{ $orang->nama }}" loading="lazy">
                            @endif
                            <p class="pengurus-card__name">{{ $orang->nama }}</p>
                            <p class="pengurus-card__role">{{ $orang->jabatan }}</p>
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
<section class="section">
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
    // ===================== JOURNEY MOUNTAIN — TINGGI DINAMIS =====================
    // Mengukur tinggi ASLI label puncak & lembah (setelah teks deskripsi
    // ditampilkan penuh, tanpa line-clamp) lalu mengatur --peak, --valley,
    // dan tinggi .journey__chart sesuai kebutuhan konten sebenarnya —
    // bukan angka tebakan tetap. Ini mencegah judul/ikon/deskripsi kepotong
    // di tepi atas/bawah container (yang overflow-y-nya otomatis clip
    // karena overflow-x: auto pada .journey).
    //
    // --amplitude (diatur lewat CSS per breakpoint) dipertahankan sebagai
    // jarak vertikal puncak↔lembah supaya siluet "gunung" tetap konsisten;
    // hanya --peak/--valley/tinggi total yang menyesuaikan panjang teks.
    (function () {
        const chart = document.getElementById('journeyChart');
        if (!chart) return;

        function adjustJourneyHeight() {
            const topLabels = chart.querySelectorAll('.journey__point--top .journey__label');
            const bottomLabels = chart.querySelectorAll('.journey__point--bottom .journey__label');
            if (!topLabels.length && !bottomLabels.length) return;

            const styles = getComputedStyle(chart);
            const gap = parseFloat(styles.getPropertyValue('--gap')) || 20;
            const amplitude = parseFloat(styles.getPropertyValue('--amplitude')) || 200;
            const buffer = 24;   // jarak aman ekstra supaya tidak mepet tepi
            const minPeak = 160; // tinggi minimum, supaya siluet gunung tidak gepeng kalau semua teks pendek

            let maxTop = 0;
            topLabels.forEach(el => { maxTop = Math.max(maxTop, el.scrollHeight); });
            let maxBottom = 0;
            bottomLabels.forEach(el => { maxBottom = Math.max(maxBottom, el.scrollHeight); });

            const peak = Math.max(minPeak, maxTop + gap + buffer);
            const valley = peak + amplitude;
            const height = valley + maxBottom + gap + buffer;

            chart.style.setProperty('--peak', peak + 'px');
            chart.style.setProperty('--valley', valley + 'px');
            chart.style.height = height + 'px';
        }

        // Diekspos supaya IIFE garis SVG di bawah bisa memanggilnya
        // sebelum menggambar ulang garis (posisi titik berubah begitu
        // tinggi chart berubah).
        window.__dqAdjustJourneyHeight = adjustJourneyHeight;
        adjustJourneyHeight();
    })();

    // ===================== JOURNEY MOUNTAIN LINE =====================
    // Menggambar garis zigzag (SVG path) yang menghubungkan setiap titik
    // (.journey__dot) di section "Awal Perjalanan Kami" / Company Milestones.
    // Dihitung otomatis dari posisi asli tiap titik supaya tetap presisi
    // berapa pun jumlah datanya (tidak hardcode jumlah/posisi).
    (function () {
        const chart = document.getElementById('journeyChart');
        const svg = document.getElementById('journeySvg');
        const linePath = document.getElementById('journeyLinePath');
        const shadowPath = document.getElementById('journeyShadowPath');
        if (!chart || !svg || !linePath || !shadowPath) return;

        function drawLine() {
            // Pastikan tinggi chart sudah menyesuaikan konten asli sebelum
            // mengambil posisi titik, supaya garis mengikuti posisi final.
            if (window.__dqAdjustJourneyHeight) window.__dqAdjustJourneyHeight();

            const dots = chart.querySelectorAll('.journey__dot');
            if (!dots.length) return;

            const chartRect = chart.getBoundingClientRect();
            svg.setAttribute('viewBox', `0 0 ${chartRect.width} ${chartRect.height}`);

            // Ambil posisi tiap titik (dot).
            const pts = [];
            dots.forEach(dot => {
                const r = dot.getBoundingClientRect();
                pts.push({
                    x: r.left - chartRect.left + r.width / 2,
                    y: r.top - chartRect.top + r.height / 2
                });
            });

            // Tambahkan titik "landasan" di tepi kiri & kanan chart supaya
            // garis meluncur turun ke sudut bawah sebelum titik pertama dan
            // setelah titik terakhir — bentuk pegunungan seperti desain acuan,
            // bukan berhenti tiba-tiba tepat di dot pertama/terakhir.
            const lead  = { x: 0, y: chartRect.height };
            const trail = { x: chartRect.width, y: chartRect.height };
            const allPts = [lead, ...pts, trail];

            const d = allPts
                .map((p, i) => (i === 0 ? 'M' : 'L') + p.x.toFixed(1) + ' ' + p.y.toFixed(1))
                .join(' ');

            linePath.setAttribute('d', d);
            shadowPath.setAttribute('d', d);
        }

        function debounce(fn, wait) {
            let t;
            return function (...args) {
                clearTimeout(t);
                t = setTimeout(() => fn.apply(this, args), wait);
            };
        }

        window.addEventListener('load', drawLine);
        window.addEventListener('resize', debounce(drawLine, 150));
        if (document.fonts && document.fonts.ready) {
            document.fonts.ready.then(drawLine);
        }
        // Jalankan segera juga (jika load event sudah lewat saat script ini dieksekusi)
        drawLine();
        setTimeout(drawLine, 300);
    })();

    // ===================== JOURNEY ARROW NAVIGATION =====================
    // Tombol panah kiri/kanan menggeser timeline sejauh lebar satu titik.
    // Panah otomatis meredup/nonaktif saat sudah mentok di ujung kiri/kanan.
    (function () {
        const journeyEl = document.getElementById('journey');
        const prevBtn = document.getElementById('journeyPrev');
        const nextBtn = document.getElementById('journeyNext');
        if (!journeyEl || !prevBtn || !nextBtn) return;

        function debounce(fn, wait) {
            let t;
            return function (...args) {
                clearTimeout(t);
                t = setTimeout(() => fn.apply(this, args), wait);
            };
        }

        function stepWidth() {
            const point = journeyEl.querySelector('.journey__point');
            return point ? point.getBoundingClientRect().width + 0 : 240;
        }

        function updateArrows() {
            const maxScroll = journeyEl.scrollWidth - journeyEl.clientWidth - 1;
            prevBtn.disabled = journeyEl.scrollLeft <= 0;
            nextBtn.disabled = maxScroll <= 0 || journeyEl.scrollLeft >= maxScroll;
        }

        prevBtn.addEventListener('click', () => {
            journeyEl.scrollBy({ left: -stepWidth(), behavior: 'smooth' });
        });
        nextBtn.addEventListener('click', () => {
            journeyEl.scrollBy({ left: stepWidth(), behavior: 'smooth' });
        });

        journeyEl.addEventListener('scroll', debounce(updateArrows, 80));
        window.addEventListener('resize', debounce(updateArrows, 150));
        updateArrows();
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