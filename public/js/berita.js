document.addEventListener('DOMContentLoaded', function () {

  /* ============================================================
     1. Generic scroll-reveal for elements with .reveal
     (dipakai oleh .berita-tabs dan .berita-grid)
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
     2. Berita — filter tabs + client-side pagination (dots)
     Halaman dibatasi 4 BARIS. Jumlah kartu per halaman dihitung
     otomatis dari jumlah kolom grid yang sedang render (responsif
     terhadap resize / breakpoint), bukan angka tetap.
     ============================================================ */
  var beritaTabs = document.querySelectorAll('.berita-tab');
  var beritaCards = document.querySelectorAll('.berita-card');
  var beritaGrid = document.getElementById('beritaGrid');
  var beritaPagination = document.getElementById('beritaPagination');
  var beritaEmpty = document.getElementById('beritaEmpty');
  var ROWS_PER_PAGE = 4;
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
     3. Program dropdown links -> scroll to Berita section and
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