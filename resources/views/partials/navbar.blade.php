{{-- ==========================================================
      NAVBAR
      Dipakai lewat @include('partials.navbar') di setiap halaman publik.
      ========================================================== --}}


  <header class="navbar">
      <div class="navbar-inner">
          <a href="{{ route('home') }}" class="navbar-brand">
              <img src="{{ asset('assets/logo.png') }}" alt="Dompet Al-Qur'an" class="brand-mark">
          </a>

          <nav class="navbar-menu">
              <div class="nav-item">
                  <a href="{{ route('home') }}" class="nav-link is-active">
                      <span data-id="Beranda" data-en="Home">Beranda</span>
                  </a>
              </div>

              <div class="nav-item">
                  <button type="button" class="nav-link">
                      <span data-id="Program" data-en="Programs">Program</span>
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                  </button>
                  <div class="nav-dropdown">
                      <a href="{{ route('program.pendidikan') }}">Peduli Pendidikan</a>
                      <a href="{{ route('program.ekonomi') }}">Peduli Ekonomi</a>
                      <a href="{{ route('program.dakwah') }}">Peduli Dakwah</a>
                      <a href="{{ route('program.kemanusiaan') }}">Peduli Kemanusiaan</a>
                  </div>
              </div>

              <div class="nav-item">
                  <button type="button" class="nav-link">
                      <span data-id="Layanan" data-en="Services">Layanan</span>
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                  </button>
                  <div class="nav-dropdown">
                      <a href="https://api.whatsapp.com/send/?phone=6281385002300&text&type=phone_number&app_absent=0" target="_blank">Konsultasi ZISWAF</a>
                      <a href="https://orangbaik.id" target="_blank">Donasi Online</a>
                      <a href="https://orangbaik.id/kalkulator-banget/" target="_blank">Kalkulator Zakat</a>
                      <a href="https://fliphtml5.com/bookcase/ytxkr/" target="_blank">Inspirasi Kebaikan</a>
                  </div>
              </div>

              <div class="nav-item">
                  <a href="{{ route('berita.index') }}" class="nav-link">
                      <span data-id="Berita" data-en="News">Berita</span>
                  </a>
              </div>

              <div class="nav-item">
                  <a href="{{ route('rekening.index') }}" class="nav-link">
                      <span data-id="Rekening Donasi" data-en="Donation Account">Rekening Donasi</span>
                  </a>
              </div>

              <div class="nav-item">
                  <a href="#about" class="nav-link">
                      <span data-id="Tentang Kami" data-en="About Us">Tentang Kami</span>
                  </a>
              </div>
          </nav>

          <div class="navbar-actions">
              <div class="lang-toggle">
                  <button type="button" data-lang="id" class="is-active">ID</button>
                  <button type="button" data-lang="en">EN</button>
              </div>
              <a href="https://orangbaik.id" class="btn btn-primary" target="_blank">
                  <span data-id="Donasi Sekarang" data-en="Donate Now">Donasi Sekarang</span>
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M20.42 4.58a5.4 5.4 0 0 0-7.65 0L12 5.34l-.77-.76a5.4 5.4 0 0 0-7.65 7.65L12 20.31l8.42-8.42a5.4 5.4 0 0 0 0-7.31Z"/>
                      <path d="M9 12h1.5l1 3 2-6 1 3H16"/>
                  </svg>
              </a>
              <button type="button" class="navbar-toggle" id="navbarToggle" aria-label="Buka menu" aria-expanded="false" aria-controls="mobileNav">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" class="icon-open"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" class="icon-close" style="display:none"><path d="M18 6 6 18M6 6l12 12"/></svg>
              </button>
          </div>

          {{-- ======================================================
              MOBILE NAV
              Disembunyikan lewat CSS (.mobile-nav), ditampilkan saat
              #navbarToggle diklik (lihat script di bawah).
              ====================================================== --}}
          <nav class="mobile-nav" id="mobileNav">
              <a href="{{ route('home') }}" class="nav-link is-active">
                  <span data-id="Beranda" data-en="Home">Beranda</span>
              </a>

              <div class="mobile-nav-group">
                  <button type="button" class="nav-link mobile-submenu-toggle" data-target="programSubmenu">
                      <span data-id="Program" data-en="Programs">Program</span>
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                  </button>
                  <div class="mobile-submenu" id="programSubmenu">
                      <a href="{{ route('program.pendidikan') }}">Peduli Pendidikan</a>
                      <a href="{{ route('program.ekonomi') }}">Peduli Ekonomi</a>
                      <a href="{{ route('program.dakwah') }}">Peduli Dakwah</a>
                      <a href="{{ route('program.kemanusiaan') }}">Peduli Kemanusiaan</a>
                  </div>
              </div>

              <div class="mobile-nav-group">
                  <button type="button" class="nav-link mobile-submenu-toggle" data-target="layananSubmenu">
                      <span data-id="Layanan" data-en="Services">Layanan</span>
                      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                  </button>
                  <div class="mobile-submenu" id="layananSubmenu">
                      <a href="https://api.whatsapp.com/send/?phone=6281385002300&text&type=phone_number&app_absent=0" target="_blank">Konsultasi ZISWAF</a>
                      <a href="https://orangbaik.id" target="_blank">Donasi Online</a>
                      <a href="https://orangbaik.id/kalkulator-banget/" target="_blank">Kalkulator Zakat</a>
                      <a href="https://fliphtml5.com/bookcase/ytxkr/" target="_blank">Inspirasi Kebaikan</a>
                  </div>
              </div>

              <a href="{{ route('berita.index') }}" class="nav-link">
                  <span data-id="Berita" data-en="News">Berita</span>
              </a>

              <a href="{{ route('rekening.index') }}" class="nav-link">
                  <span data-id="Rekening Donasi" data-en="Donation Account">Rekening Donasi</span>
              </a>

              <a href="#about" class="nav-link">
                  <span data-id="Tentang Kami" data-en="About Us">Tentang Kami</span>
              </a>

              <div class="mobile-nav-footer">
                  <div class="lang-toggle" data-lang-toggle-mobile>
                      <button type="button" data-lang="id" class="is-active">ID</button>
                      <button type="button" data-lang="en">EN</button>
                  </div>
              </div>
          </nav>
      </div>
  </header>

  <style>
      :root {
    /* Warna sesuai spesifikasi */
    --bg-soft: #F9F9F9;
    --bg-white: #FFFFFF;
    --text-brand: #3365AF;
    --text-dark: #101828;
    --text-muted: #5D5D5D;
    --border-muted: #d9d9d9;

    /* Turunan dari warna brand, dipakai untuk hover/tint/shadow — bukan warna baru */
    --text-brand-dark: #274E86;
    --text-brand-tint: rgba(51, 101, 175, 0.08);
    --text-brand-tint-strong: rgba(51, 101, 175, 0.14);
    --border-soft: rgba(36, 37, 39, 0.08);
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

  body {
    background: var(--bg-white);
  }

  .top-accent-bar {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--text-brand);
    z-index: 110;
  }

  .navbar {
    position: sticky;
    top: 12px;
    z-index: 100;
    max-width: 1000px;
    margin: 12px auto 0;
    background: var(--bg-white);
    border-radius: var(--radius-full);
    box-shadow: var(--border-muted);
    border: 0.5px solid var(--border-muted);
    transition: border-radius 0.15s ease;

  }

  .navbar-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 18px;
    padding: 8px 16px;
    flex-wrap: wrap;
  }

  .navbar-brand {
    display: flex;
    align-items: center;
    gap: 10px;
    font-family: var(--font-display);
    font-weight: 500;
    font-size: 14px;
    color: var(--text-dark);
    white-space: nowrap;
    flex-shrink: 0;
  }

  .navbar-brand img.brand-mark {
    position: relative;
    width: 38px !important;
    height: 38px !important;
    flex-shrink: 0;
    object-fit: contain;
    object-position: center;
  }

  .brand-mark-d,
  .brand-mark-q {
    position: absolute;
    top: 0;
    width: 26px;
    height: 26px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: var(--font-display);
    font-weight: 500;
    font-size: 12px;
    color: #fff;
  }

  .brand-mark-d {
    left: 0;
    background: var(--text-brand);
    z-index: 2;
  }

  .brand-mark-q {
    left: 14px;
    top: 8px;
    background: #9AB0CE;
    z-index: 1;
  }

  .navbar-menu {
    display: flex;
    align-items: center;
    gap: 2px;
    flex-wrap: nowrap;
  }

  .nav-item {
    position: relative;
    flex-shrink: 0;
  }

  .nav-link {
    display: flex;
    align-items: center;
    gap: 4px;
    padding: 7px 12px;
    border-radius: var(--radius-full);
    font-size: 13px;
    font-weight: 400;
    color: var(--text-dark);
    transition: background 0.15s ease, color 0.15s ease;
    background: none;
    border: none;
    white-space: nowrap;
  }

  .nav-link:hover {
    color: var(--text-brand);
  }

  .nav-link svg { transition: transform 0.15s ease; flex-shrink: 0; }
  .nav-item:hover .nav-link svg { transform: rotate(180deg); }

  .nav-dropdown {
    position: absolute;
    top: calc(100% + 8px);
    left: 0;
    min-width: 220px;
    background: var(--bg-white);
    border-radius: var(--radius-md);
    border: 1px solid var(--border-soft);
    box-shadow: var(--shadow-card);
    padding: 6px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(6px);
    transition: opacity 0.15s ease, transform 0.15s ease, visibility 0.15s ease;
  }

  .nav-item:hover .nav-dropdown,
  .nav-item.is-open .nav-dropdown {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
  }

  .nav-dropdown a {
    display: block;
    padding: 8px 10px;
    border-radius: var(--radius-sm);
    font-size: 13px;
    font-weight: 400;
    color: var(--text-muted);
    white-space: nowrap;
  }

  .nav-dropdown a:hover {
    color: var(--text-brand);
  }

  .navbar-actions {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-shrink: 0;
  }

  .lang-toggle {
    display: flex;
    align-items: center;
    border: 1px solid var(--border-soft);
    border-radius: var(--radius-full);
    padding: 2px;
    background: var(--bg-white);
    flex-shrink: 0;
  }

  .lang-toggle button {
    border: none;
    background: none;
    padding: 5px 10px;
    border-radius: var(--radius-full);
    font-size: 13px;
    font-weight: 500;
    color: var(--text-muted);
    white-space: nowrap;
  }

  .lang-toggle button.is-active {
    background: var(--text-brand);
    color: #fff;
  }

  .btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 9px 18px;
    border-radius: var(--radius-full);
    font-weight: 500;
    font-size: 13px;
    border: none;
    transition: transform 0.15s ease, box-shadow 0.15s ease, background 0.15s ease;
    white-space: nowrap;
    flex-shrink: 0;
  }

  .btn-primary {
    background: var(--text-brand);
    color: #fff;
    box-shadow: 0 12px 24px -10px var(--text-brand-tint-strong);
  }

  .btn-primary:hover {
    background: var(--text-brand-dark);
    transform: translateY(-1px);
  }

  .btn-outline {
    background: var(--bg-white);
    color: var(--text-brand);
    border: 1.5px solid var(--text-brand);
  }

  .btn-outline:hover {
    background: var(--text-brand-tint);
  }

  .navbar-toggle {
    display: none;
    border: none;
    background: none;
    padding: 6px;
    color: var(--text-dark);
  }

  @media (max-width: 960px) {
    .navbar-menu,
    .lang-toggle {
      display: none;
    }

    .navbar-toggle {
      display: inline-flex;
    }

    .navbar {
      margin: 10px 12px 0;
      max-width: none;
    }

    .navbar.navbar-mobile-open {
      border-radius: var(--radius-lg);
    }

    .navbar-inner {
      padding: 8px 14px;
    }

    .mobile-nav {
      display: none;
      flex-direction: column;
      gap: 4px;
      padding: 10px 16px 16px;
      background: var(--bg-white);
      border-top: 1px solid var(--border-soft);
      width: 100%;
      order: 10;
    }

    .mobile-nav.is-open {
      display: flex;
    }

    .mobile-nav .nav-link,
    .mobile-nav a.btn {
      white-space: normal;
      width: 100%;
      justify-content: space-between;
      text-align: left;
    }

    .mobile-nav-group {
      display: flex;
      flex-direction: column;
    }

    .mobile-submenu-toggle svg {
      transition: transform 0.15s ease;
    }

    .mobile-submenu-toggle.is-open svg {
      transform: rotate(180deg);
    }

    .mobile-submenu {
      display: none;
      flex-direction: column;
      padding-left: 12px;
    }

    .mobile-submenu.is-open {
      display: flex;
    }

    .mobile-submenu a {
      padding: 8px 10px;
      font-size: 13px;
      color: var(--text-muted);
    }

    .mobile-submenu a:hover {
      color: var(--text-brand);
    }

    .mobile-nav-footer {
      display: flex;
      align-items: center;
      justify-content: flex-start;
      gap: 10px;
      margin-top: 8px;
      padding-top: 12px;
      border-top: 1px solid var(--border-soft);
    }

    .mobile-nav-footer .lang-toggle {
      display: flex;
    }
  }
  </style>

  <script>
  (function () {
    var toggleBtn = document.getElementById('navbarToggle');
    var mobileNav = document.getElementById('mobileNav');
    if (!toggleBtn || !mobileNav) return;

    var iconOpen = toggleBtn.querySelector('.icon-open');
    var iconClose = toggleBtn.querySelector('.icon-close');
    var navbarEl = document.querySelector('.navbar');

    toggleBtn.addEventListener('click', function () {
      var isOpen = mobileNav.classList.toggle('is-open');
      toggleBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
      if (navbarEl) {
        navbarEl.classList.toggle('navbar-mobile-open', isOpen);
      }
      if (iconOpen && iconClose) {
        iconOpen.style.display = isOpen ? 'none' : '';
        iconClose.style.display = isOpen ? '' : 'none';
      }
    });

    // Submenu Program / Layanan di mobile: klik untuk buka/tutup
    var submenuToggles = mobileNav.querySelectorAll('.mobile-submenu-toggle');
    submenuToggles.forEach(function (btn) {
      btn.addEventListener('click', function () {
        var targetId = btn.getAttribute('data-target');
        var submenu = document.getElementById(targetId);
        if (!submenu) return;
        var isOpen = submenu.classList.toggle('is-open');
        btn.classList.toggle('is-open', isOpen);
      });
    });

    // Tutup mobile nav saat salah satu link diklik (kecuali toggle submenu)
    mobileNav.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () {
        mobileNav.classList.remove('is-open');
        if (navbarEl) navbarEl.classList.remove('navbar-mobile-open');
        toggleBtn.setAttribute('aria-expanded', 'false');
        if (iconOpen && iconClose) {
          iconOpen.style.display = '';
          iconClose.style.display = 'none';
        }
      });
    });
  })();
  </script>