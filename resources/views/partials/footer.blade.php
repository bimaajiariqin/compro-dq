{{-- ==========================================================
      FOOTER
      Dipakai lewat @include('partials.footer') di setiap halaman publik.
      Butuh variabel $visitorStats (array: hari_ini, bulan_ini, tahun_ini)
      dari controller — lihat HomeController::index().
      ========================================================== --}}
  <footer class="footer">
      <div class="container">
          <div class="footer-grid">
              <div>
                  <a href="{{ route('home') }}" class="footer-brand-link">
                      <img src="{{ asset('assets/logo_footer.png') }}" alt="Dompet Al-Qur'an Indonesia" class="footer-brand">
                  </a>
                  <p class="footer-about">
                      Bersama Dompet Al-Qur'an Indonesia, wujudkan kepedulian dengan berbagi untuk
                      menciptakan kehidupan yang lebih baik bagi sesama.
                  </p>
                  <ul class="footer-contact">
                      <li>
                          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                          <span>031-895-5057</span>
                      </li>
                      <li>
                          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 4h16v16H4z"/><path d="m22 6-10 7L2 6"/></svg>
                          <span>info@dompetalquran.or.id</span>
                      </li>
                      <li>
                          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                          <span>Ruko Citra City Blok R28, Sari Rogo, Sidoarjo, Sidoarjo Regency, East Java 61234</span>
                      </li>
                  </ul>
                  <div class="footer-social">
                      <a href="https://api.whatsapp.com/send/?phone=6281385002300&text&type=phone_number&app_absent=0" aria-label="WhatsApp">
                          <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12.04 2.003c-5.46 0-9.9 4.437-9.9 9.9 0 1.746.458 3.45 1.328 4.949L2 22l5.25-1.377a9.87 9.87 0 0 0 4.79 1.22h.004c5.46 0 9.9-4.436 9.9-9.9 0-2.645-1.03-5.13-2.9-7a9.83 9.83 0 0 0-7-2.94zm0 1.8a8 8 0 0 1 5.69 2.37 8.03 8.03 0 0 1 2.36 5.73c0 4.47-3.63 8.1-8.1 8.1a8.1 8.1 0 0 1-4.12-1.13l-.3-.17-3.12.82.83-3.04-.19-.31a8.06 8.06 0 0 1-1.24-4.31c0-4.47 3.64-8.1 8.11-8.1zm-4.5 4.2c-.17 0-.44.06-.67.32-.23.26-.87.85-.87 2.07 0 1.22.89 2.4 1.01 2.57.13.17 1.75 2.79 4.31 3.8 2.13.85 2.57.68 3.03.64.47-.04 1.5-.61 1.71-1.2.21-.6.21-1.1.15-1.21-.07-.11-.24-.17-.5-.3-.26-.14-1.5-.74-1.74-.82-.23-.09-.4-.13-.57.13-.17.26-.65.82-.8.99-.15.17-.29.19-.55.06-.26-.13-1.09-.4-2.08-1.28-.77-.68-1.29-1.53-1.44-1.79-.15-.26-.02-.4.11-.53.12-.12.26-.3.39-.45.13-.15.17-.26.26-.43.09-.17.04-.32-.02-.45-.06-.13-.57-1.4-.79-1.91-.2-.5-.41-.43-.57-.44a10 10 0 0 0-.49-.01z"/></svg>
                      </a>
                      <a href="https://web.facebook.com/dompetalquranofficial?locale=id_ID" aria-label="Facebook">
                          <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M22 12a10 10 0 1 0-11.6 9.87v-6.98H7.9V12h2.5V9.8c0-2.5 1.49-3.89 3.77-3.89 1.1 0 2.24.2 2.24.2v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56V12h2.78l-.44 2.89h-2.34v6.98A10 10 0 0 0 22 12z"/></svg>
                      </a>
                      <a href="https://www.instagram.com/dompetalquran/" aria-label="Instagram">
                          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="0.5" fill="currentColor"/></svg>
                      </a>
                      <a href="https://www.tiktok.com/@dompetalquran.id" aria-label="TikTok">
                          <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M16.5 3c.34 2.1 1.83 3.82 3.9 4.24v3.1a7.6 7.6 0 0 1-3.9-1.28v6.86a5.94 5.94 0 1 1-5.94-5.94c.2 0 .4.01.6.04v3.2a2.72 2.72 0 1 0 1.9 2.6V3h3.44z"/></svg>
                      </a>
                  </div>
              </div>

              <div class="footer-links-grid">
                  <p class="footer-heading" style="grid-column: 1; grid-row: 1;">Menu Utama</p>
                  <ul class="footer-links" style="grid-column: 1; grid-row: 2;">
                      <li><a href="{{ route('home') }}">Beranda</a></li>
                      <li><a href="{{ route('berita.index') }}">Berita</a></li>
                      <li><a href="{{ route('rekening.index') }}">Rekening Donasi</a></li>
                      <li><a href="#about">Tentang Kami</a></li>
                      <li><a href="{{ route('login') }}">Masuk</a></li>
                  </ul>

                  <p class="footer-heading" style="grid-column: 1; grid-row: 3;">Jejaring Layanan</p>
                  <ul class="footer-links" style="grid-column: 1; grid-row: 4;">
                      <li><a href="https://wakafdq.com" target="_blank" rel="noopener">Wakaf Dompet Al-Qur'an Indonesia</a></li>
                      <li><a href="https://orangbaik.id" target="_blank" rel="noopener">orangbaik.id</a></li>
                  </ul>

                  <p class="footer-heading" style="grid-column: 2; grid-row: 1;">Program Kami</p>
                  <ul class="footer-links" style="grid-column: 2; grid-row: 2;">
                      <li><a href="#berita" data-goto-filter="pendidikan">Peduli Pendidikan</a></li>
                      <li><a href="#berita" data-goto-filter="ekonomi">Peduli Ekonomi</a></li>
                      <li><a href="#berita" data-goto-filter="dakwah">Peduli Dakwah</a></li>
                      <li><a href="#berita" data-goto-filter="kemanusiaan">Peduli Kemanusiaan</a></li>
                  </ul>

                  <p class="footer-heading" style="grid-column: 2; grid-row: 3;">Pengunjung Website</p>
                  <ul class="footer-visits" style="grid-column: 2; grid-row: 4;">
                      <li><span class="label">Hari ini: </span> <span class="value">{{ number_format($visitorStats['hari_ini'], 0, ',', '.') }}</span></li>
                      <li><span class="label">Bulan ini: </span> <span class="value">{{ number_format($visitorStats['bulan_ini'], 0, ',', '.') }}</span></li>
                      <li><span class="label">Tahun ini: </span> <span class="value">{{ number_format($visitorStats['tahun_ini'], 0, ',', '.') }}</span></li>
                  </ul>
              </div>

              <div>
                  <p class="footer-heading">Lokasi Lembaga</p>
                  <div class="footer-map">
                      <iframe
                          src="https://www.google.com/maps?q=-7.4267403,112.6815088&output=embed"
                          loading="lazy"
                          referrerpolicy="no-referrer-when-downgrade"
                          title="Lokasi Dompet Al-Qur'an Indonesia">
                      </iframe>
                  </div>
              </div>
          </div>

          <div class="footer-bottom">
              Copyright © {{ date('Y') }} Dompet Al-Qur'an Indonesia. All Rights Reserved.
          </div>
      </div>
  </footer>

  <style>
      :root {
    /* Warna sesuai spesifikasi */
    --bg-soft: #F9F9F9;
    --bg-white: #FFFFFF;
    --text-brand: #3365AF;
    --text-dark: #101828;
    --text-muted: #5D5D5D;

    /* Turunan dari warna brand, dipakai untuk hover/tint/shadow — bukan warna baru */
    --text-brand-dark: #274E86;
    --text-brand-tint: rgba(51, 101, 175, 0.08);
    --text-brand-tint-strong: rgba(51, 101, 175, 0.14);
    --border-soft: #d9d9d9;
    --shadow-soft: 0 20px 40px -20px rgba(16, 24, 40, 0.18);
    --shadow-card: 0 10px 30px -12px rgba(16, 24, 40, 0.12);

    --radius-sm: 10px;
    --radius-md: 16px;
    --radius-lg: 24px;
    --radius-full: 999px;

    --font-body: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    --font-display: 'Inter', sans-serif;

    --container-width: 1200px;
  }

  /* ==========================================================================
    Footer
    ========================================================================== */

  .footer {
    background: var(--bg-white);
    border-top: 1px solid var(--border-soft);
    padding-top: 64px;
  }

  .footer-grid {
    display: grid;
    gap: 40px;
    grid-template-columns: 1fr;
  }

  @media (min-width: 860px) {
    .footer-grid { grid-template-columns: 1.3fr 2fr 1fr; }
  }

  .footer-links-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-template-rows: auto auto auto auto;
    column-gap: 40px;
  }

  .footer-links-grid .footer-heading:nth-of-type(2),
  .footer-links-grid .footer-heading:nth-of-type(4) {
    margin-top: 28px;
  }

  .footer-brand-link {
    display: inline-block;
    margin-bottom: 1px;
  }

  .footer-brand {
    height: 48px;
    width: auto;
    object-fit: contain;
    display: block;
  }

  .footer-about {
    font-size: 0.875rem;
    line-height: 1.2;
    margin-bottom: 18px;
  }

  .footer-contact {
    display: flex;
    flex-direction: column;
    gap: 20px;
    font-size: 0.875rem;
    margin-bottom: 18px;
  }

  .footer-contact li { display: flex; align-items: flex-start; gap: 8px; }
  .footer-contact svg { color: var(--text-brand); flex-shrink: 0; margin-top: 2px; }

  .footer-social {
    display: flex;
    gap: 10px;
  }

  .footer-social a {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    background: var(--bg-soft);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-brand);
    transition: background 0.15s ease, color 0.15s ease;
  }

  .footer-social a:hover {
    background: var(--text-brand);
    color: #fff;
  }

  .footer-heading {
    font-size: 0.85rem;
    font-weight: 700;
    color: var(--text-dark);
    text-transform: uppercase;
    letter-spacing: 0.03em;
    margin-bottom: 16px;
  }

  .footer-links li { margin-bottom: 10px; }

  .footer-links a {
    font-size: 0.9rem;
    color: var(--text-muted);
    transition: color 0.15s ease;
  }

  .footer-links a:hover { color: var(--text-brand); }

  .footer-visits {
    display: flex;
    flex-direction: column;
    gap: 6px;
    font-size: 0.85rem;
    margin-bottom: 24px;
  }

  .footer-visits li { display: flex; justify-content: flex-start; gap: 5px; }
  .footer-visits .label { color: var(--text-muted); }
  .footer-visits .value { color: var(--text-muted); font-weight: 500; }

  .footer-map {
    border-radius: var(--radius-md);
    overflow: hidden;
    border: 1px solid var(--border-soft);
    aspect-ratio: 4 / 3;
  }

  .footer-map iframe { width: 100%; height: 100%; border: 0; }

  .footer-bottom {
    margin-top: 48px;
    padding: 20px 0;
    border-top: 1px solid var(--border-soft);
    text-align: center;
    font-size: 0.8rem;
    color: var(--text-muted);
  }

  /* ==========================================================================
    Scroll reveal (JS toggles .is-visible)
    ========================================================================== */

  .reveal {
    opacity: 0;
    transform: translateY(18px);
    transition: opacity 0.6s ease, transform 0.6s ease;
  }

  .reveal.is-visible {
    opacity: 1;
    transform: translateY(0);
  }

  /* ==========================================================================
    Responsive
    ========================================================================== */

  @media (max-width: 960px) {
    .navbar-menu { display: none; }
    .navbar-toggle { display: flex; }
    .navbar-actions .lang-toggle { display: none; }
  }

  @media (max-width: 640px) {
    .section { padding: 48px 0; }
    .hero { padding-top: 32px; }
    .cta { text-align: center; }
    .cta-image { justify-self: center; }
  }

  /* Mobile nav (simple slide-down panel toggled via JS) */
  .mobile-nav {
    display: none;
    flex-direction: column;
    gap: 4px;
    padding: 12px 24px 20px;
    border-top: 1px solid var(--border-soft);
    background: var(--bg-white);
  }

  .mobile-nav.is-open { display: flex; }

  .mobile-nav .nav-link { justify-content: space-between; width: 100%; }

  .mobile-submenu {
    display: none;
    flex-direction: column;
    padding-left: 14px;
    gap: 2px;
  }

  .mobile-submenu.is-open { display: flex; }

  .mobile-submenu a {
    padding: 8px 12px;
    font-size: 0.875rem;
    color: var(--text-muted);
    border-radius: var(--radius-sm);
  }

  .mobile-submenu a:hover { background: var(--text-brand-tint); color: var(--text-brand); }

  .mobile-nav .btn { margin-top: 10px; }
  </style>