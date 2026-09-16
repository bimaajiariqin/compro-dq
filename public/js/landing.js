document.addEventListener('DOMContentLoaded', function () {

  /* ============================================================
    1. Mobile nav toggle
    Logic ada di partials/navbar.blade.php (inline <script>),
    supaya nempel sama markup navbarnya. Jangan tambah lagi di sini
    biar gak dobel event listener pada #navbarToggle.
    ============================================================ */

  /* ============================================================
    2. Language toggle (ID/EN) — client-side text swap
    Elements to translate carry data-id="..." data-en="..."
    ============================================================ */
  var langButtons = document.querySelectorAll('[data-lang]');
  var translatable = document.querySelectorAll('[data-id][data-en]');
  var savedLang = localStorage.getItem('dq_lang') || 'id';

  function applyLang(lang) {
    translatable.forEach(function (el) {
      el.textContent = el.dataset[lang];
    });
    langButtons.forEach(function (btn) {
      btn.classList.toggle('is-active', btn.dataset.lang === lang);
    });
    document.documentElement.lang = lang;
    localStorage.setItem('dq_lang', lang);
  }

  langButtons.forEach(function (btn) {
    btn.addEventListener('click', function () {
      applyLang(btn.dataset.lang);
    });
  });

  applyLang(savedLang);

  /* ============================================================
    3. Animated counters — run once, when the stats section
    scrolls into view
    ============================================================ */
  var counters = document.querySelectorAll('[data-counter]');

  function animateCounter(el) {
    var target = parseFloat(el.dataset.counter);
    var suffix = el.dataset.suffix || '';
    var duration = 1400;
    var startTime = null;

    function step(timestamp) {
      if (!startTime) startTime = timestamp;
      var progress = Math.min((timestamp - startTime) / duration, 1);
      var eased = 1 - Math.pow(1 - progress, 3); // ease-out cubic
      var current = Math.floor(eased * target);
      el.textContent = current.toLocaleString('id-ID') + suffix;

      if (progress < 1) {
        requestAnimationFrame(step);
      } else {
        el.textContent = target.toLocaleString('id-ID') + suffix;
      }
    }

    requestAnimationFrame(step);
  }

  if (counters.length && 'IntersectionObserver' in window) {
    var counterObserver = new IntersectionObserver(function (entries, observer) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          animateCounter(entry.target);
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.4 });

    counters.forEach(function (el) { counterObserver.observe(el); });
  } else {
    counters.forEach(function (el) {
      el.textContent = parseFloat(el.dataset.counter).toLocaleString('id-ID') + (el.dataset.suffix || '');
    });
  }

  /* ============================================================
    4. Generic scroll-reveal for sections/cards with .reveal
    ============================================================ */
  var revealEls = document.querySelectorAll('.reveal');
  if (revealEls.length && 'IntersectionObserver' in window) {
    var revealObserver = new IntersectionObserver(function (entries, observer) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15 });

    revealEls.forEach(function (el) { revealObserver.observe(el); });
  } else {
    revealEls.forEach(function (el) { el.classList.add('is-visible'); });
  }

  /* ============================================================
    5. Testimoni slider
    ============================================================ */
  var testimoniSlides = document.querySelectorAll('.testimoni-slide');
  var testimoniDotsWrap = document.getElementById('testimoniDots');
  var testimoniPrev = document.getElementById('testimoniPrev');
  var testimoniNext = document.getElementById('testimoniNext');
  var testimoniIndex = 0;
  var testimoniTimer = null;

  function showTestimoni(index) {
    if (!testimoniSlides.length) return;
    testimoniIndex = (index + testimoniSlides.length) % testimoniSlides.length;

    testimoniSlides.forEach(function (slide, i) {
      slide.classList.toggle('is-active', i === testimoniIndex);
    });

    if (testimoniDotsWrap) {
      testimoniDotsWrap.querySelectorAll('button').forEach(function (dot, i) {
        dot.classList.toggle('is-active', i === testimoniIndex);
      });
    }
  }

  function startTestimoniAutoplay() {
    stopTestimoniAutoplay();
    if (testimoniSlides.length > 1) {
      testimoniTimer = setInterval(function () {
        showTestimoni(testimoniIndex + 1);
      }, 6000);
    }
  }

  function stopTestimoniAutoplay() {
    if (testimoniTimer) clearInterval(testimoniTimer);
  }

  if (testimoniSlides.length) {
    showTestimoni(0);
    startTestimoniAutoplay();

    if (testimoniPrev) {
      testimoniPrev.addEventListener('click', function () {
        showTestimoni(testimoniIndex - 1);
        startTestimoniAutoplay();
      });
    }
    if (testimoniNext) {
      testimoniNext.addEventListener('click', function () {
        showTestimoni(testimoniIndex + 1);
        startTestimoniAutoplay();
      });
    }
    if (testimoniDotsWrap) {
      testimoniDotsWrap.querySelectorAll('button').forEach(function (dot, i) {
        dot.addEventListener('click', function () {
          showTestimoni(i);
          startTestimoniAutoplay();
        });
      });
    }
  }

  /* ============================================================
    6. Berita — filter tabs + client-side pagination (Arrow-Pill-Arrow)
    Halaman dibatasi 2 BARIS (preview di landing page — beda dengan
    halaman /berita yang 4 baris). Jumlah kartu per halaman dihitung
    otomatis dari jumlah kolom grid yang sedang render (responsif
    terhadap resize / breakpoint), bukan angka tetap.
    ============================================================ */
  var beritaTabs = document.querySelectorAll('.berita-tab');
  var beritaCards = document.querySelectorAll('.berita-card');
  var beritaGrid = document.getElementById('beritaGrid');
  var beritaPagination = document.getElementById('beritaPagination');
  var beritaEmpty = document.getElementById('beritaEmpty');
  var ROWS_PER_PAGE = 2;
  var currentPage = 0;
  var currentFilter = 'semua';
  var beritaResizeTimer = null;

  function getGridColumns() {
    if (!beritaGrid) return 1;
    var cols = getComputedStyle(beritaGrid).gridTemplateColumns
      .split(' ')
      .filter(function (v) { return v && v !== '0px'; });
    return cols.length || 1;
  }

  function getBeritaPageSize() {
    return getGridColumns() * ROWS_PER_PAGE;
  }

  function getFilteredCards() {
    return Array.prototype.filter.call(beritaCards, function (card) {
      if (currentFilter === 'semua') return true;
      var kategori = (card.dataset.kategori || '').toLowerCase();
      var program = (card.dataset.program || '').toLowerCase();
      return kategori === currentFilter || program === currentFilter;
    });
  }

  function goToPage(pageIndex, totalPages) {
    currentPage = Math.max(0, Math.min(pageIndex, totalPages - 1));
    // true = ini hasil aksi user (klik nomor/panah halaman), jadi boleh
    // menyesuaikan posisi scroll (pill horizontal + scroll ke grid).
    renderBeritaPage(true);
    if (beritaGrid) beritaGrid.scrollIntoView({ behavior: 'smooth', block: 'start' });
  }

  /* ----------------------------------------------------------
     Membuat daftar nomor halaman yang akan ditampilkan, dengan
     elipsis ("...") saat halamannya banyak. Polanya sengaja
     minim: halaman 1, halaman aktif, dan 3 halaman terakhir —
     contoh untuk halaman aktif = 2 dari 26 halaman:
     1  2  ...  24  25  26
     Kalau total halamannya sedikit (<= 6), semua nomor
     ditampilkan tanpa elipsis sama sekali.
     ---------------------------------------------------------- */
  function buildPageList(current, total) {
    if (total <= 6) {
      var all = [];
      for (var p = 1; p <= total; p++) all.push(p);
      return all;
    }

    var pageSet = {};
    function addPage(p) { if (p >= 1 && p <= total) pageSet[p] = true; }

    addPage(1);
    addPage(total - 2); addPage(total - 1); addPage(total);
    addPage(current);

    var pages = Object.keys(pageSet).map(Number).sort(function (a, b) { return a - b; });

    var result = [];
    for (var i = 0; i < pages.length; i++) {
      if (i > 0 && pages[i] - pages[i - 1] > 1) result.push('...');
      result.push(pages[i]);
    }
    return result;
  }

  /* ----------------------------------------------------------
     centerActivePage (opsional, default false):
     Kalau true, tombol nomor halaman yang aktif akan di-scroll
     ke tengah pill (berguna di mobile kalau pill-nya overflow
     horizontal). Cuma boleh true saat dipicu aksi user langsung
     (klik tab/nomor/panah) — JANGAN true saat render pertama kali
     atau saat resize, karena scrollIntoView() bisa ikut nge-scroll
     window secara vertikal kalau elemennya masih di luar viewport,
     dan itu bikin halaman "lompat" ke section Berita saat load.
     ---------------------------------------------------------- */
  function renderBeritaPage(centerActivePage) {
    var filtered = getFilteredCards();
    var pageSize = getBeritaPageSize();
    var totalPages = Math.max(1, Math.ceil(filtered.length / pageSize));
    currentPage = Math.min(currentPage, totalPages - 1);

    beritaCards.forEach(function (card) { card.classList.remove('is-visible'); });

    filtered.forEach(function (card, i) {
      var page = Math.floor(i / pageSize);
      if (page === currentPage) card.classList.add('is-visible');
    });

    if (beritaEmpty) {
      beritaEmpty.style.display = filtered.length ? 'none' : 'block';
    }

    if (beritaPagination) {
      beritaPagination.innerHTML = '';

      if (totalPages > 1) {
        var activePageNumber = currentPage + 1; // tampilan 1-based

        // ---- Tombol Panah Kiri (Prev) ----
        var prevBtn = document.createElement('button');
        prevBtn.type = 'button';
        prevBtn.className = 'berita-page-arrow berita-page-prev';
        prevBtn.setAttribute('aria-label', 'Halaman sebelumnya');
        prevBtn.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M15 6l-6 6 6 6" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"/></svg>';
        prevBtn.disabled = currentPage === 0;
        prevBtn.addEventListener('click', function () {
          goToPage(currentPage - 1, totalPages);
        });
        beritaPagination.appendChild(prevBtn);

        // ---- Pill berisi nomor halaman + elipsis ----
        var pill = document.createElement('div');
        pill.className = 'berita-page-pill';

        var pageList = buildPageList(activePageNumber, totalPages);
        pageList.forEach(function (item) {
          if (item === '...') {
            var dots = document.createElement('span');
            dots.className = 'berita-page-dots';
            dots.textContent = '...';
            dots.setAttribute('aria-hidden', 'true');
            pill.appendChild(dots);
            return;
          }

          var numBtn = document.createElement('button');
          numBtn.type = 'button';
          numBtn.className = 'berita-page-number';
          numBtn.textContent = item;
          numBtn.setAttribute('aria-label', 'Halaman ' + item);
          if (item === activePageNumber) numBtn.classList.add('is-active');
          (function (pageIndex) {
            numBtn.addEventListener('click', function () {
              goToPage(pageIndex, totalPages);
            });
          })(item - 1);
          pill.appendChild(numBtn);
        });

        beritaPagination.appendChild(pill);

        // ---- Tombol Panah Kanan (Next) ----
        var nextBtn = document.createElement('button');
        nextBtn.type = 'button';
        nextBtn.className = 'berita-page-arrow berita-page-next';
        nextBtn.setAttribute('aria-label', 'Halaman berikutnya');
        nextBtn.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M9 6l6 6-6 6" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"/></svg>';
        nextBtn.disabled = currentPage === totalPages - 1;
        nextBtn.addEventListener('click', function () {
          goToPage(currentPage + 1, totalPages);
        });
        beritaPagination.appendChild(nextBtn);

        // Pastikan tombol halaman aktif selalu terlihat kalau pill di-scroll
        // (mobile) — HANYA kalau ini dipicu oleh aksi user, bukan render awal.
        if (centerActivePage) {
          var activeEl = pill.querySelector('.berita-page-number.is-active');
          if (activeEl) activeEl.scrollIntoView({ block: 'nearest', inline: 'center' });
        }
      }
    }
  }

  if (beritaTabs.length) {
    beritaTabs.forEach(function (tab) {
      tab.addEventListener('click', function () {
        beritaTabs.forEach(function (t) { t.classList.remove('is-active'); });
        tab.classList.add('is-active');
        currentFilter = (tab.dataset.filter || 'semua').toLowerCase();
        currentPage = 0;
        renderBeritaPage(true);
      });
    });
  }

  if (beritaCards.length) {
    renderBeritaPage(false);

    // Jumlah kolom bisa berubah saat layar di-resize (breakpoint),
    // jadi kartu per halaman & tombol dihitung ulang (di-debounce).
    window.addEventListener('resize', function () {
      clearTimeout(beritaResizeTimer);
      beritaResizeTimer = setTimeout(function () {
        currentPage = 0;
        renderBeritaPage(false);
      }, 200);
    });
  }

  /* ============================================================
    7. Program dropdown links -> scroll to Berita section and
    auto-select the matching filter tab
    ============================================================ */
  document.querySelectorAll('[data-goto-filter]').forEach(function (link) {
    link.addEventListener('click', function (e) {
      var filterValue = (link.dataset.gotoFilter || '').toLowerCase();
      var tab = document.querySelector('.berita-tab[data-filter="' + filterValue + '"]');
      var section = document.getElementById('berita');

      if (tab && section) {
        e.preventDefault();
        tab.click();
        section.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });

});