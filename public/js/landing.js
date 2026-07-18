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
     6. Berita — filter tabs + client-side pagination (dots)
     Halaman dibatasi 2 BARIS. Jumlah kartu per halaman dihitung
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

  function renderBeritaPage() {
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
        for (var p = 0; p < totalPages; p++) {
          var dot = document.createElement('button');
          dot.type = 'button';
          dot.setAttribute('aria-label', 'Halaman ' + (p + 1));
          if (p === currentPage) dot.classList.add('is-active');
          (function (pageIndex) {
            dot.addEventListener('click', function () {
              currentPage = pageIndex;
              renderBeritaPage();
              if (beritaGrid) beritaGrid.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
          })(p);
          beritaPagination.appendChild(dot);
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
        renderBeritaPage();
      });
    });
  }

  if (beritaCards.length) {
    renderBeritaPage();

    // Jumlah kolom bisa berubah saat layar di-resize (breakpoint),
    // jadi kartu per halaman & dot dihitung ulang (di-debounce).
    window.addEventListener('resize', function () {
      clearTimeout(beritaResizeTimer);
      beritaResizeTimer = setTimeout(function () {
        currentPage = 0;
        renderBeritaPage();
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