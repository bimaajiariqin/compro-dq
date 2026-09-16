/* ============================================================
   Matikan scroll restoration otomatis browser supaya reload
   halaman /berita tidak "mengembalikan" posisi scroll terakhir
   (misalnya ke area pagination), dan selalu mulai dari atas.
   ============================================================ */
if ('scrollRestoration' in history) {
  history.scrollRestoration = 'manual';
}
window.scrollTo(0, 0);

document.addEventListener('DOMContentLoaded', function () {

  /* ============================================================
     1. Generic scroll-reveal for elements with .reveal
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
     2. Berita — filter tabs bersama + pagination desktop & mobile
        - Desktop: pageSize dinamis (jumlah kolom grid x 4 baris)
        - Mobile : pageSize tetap 15 berita per halaman
     ============================================================ */
  var beritaTabs = document.querySelectorAll('.berita-tab');
  var beritaCards = document.querySelectorAll('.berita-card');
  var beritaGrid = document.getElementById('beritaGrid');
  var beritaPagination = document.getElementById('beritaPagination');
  var beritaEmpty = document.getElementById('beritaEmpty');

  var mobileItems = document.querySelectorAll('.berita-mobile-item');
  var mobilePagination = document.getElementById('beritaMobilePagination');
  var mobileEmpty = document.getElementById('beritaMobileEmpty');
  var MOBILE_PAGE_SIZE = 15;

  var ROWS_PER_PAGE = 4;
  var currentFilter = 'semua';
  var desktopPage = 0;
  var mobilePage = 0;
  var beritaResizeTimer = null;

  function getGridColumns() {
    if (!beritaGrid) return 1;
    var cols = getComputedStyle(beritaGrid).gridTemplateColumns
      .split(' ')
      .filter(function (v) { return v && v !== '0px'; });
    return cols.length || 1;
  }

  function getDesktopPageSize() {
    return getGridColumns() * ROWS_PER_PAGE;
  }

  function matchesFilter(el) {
    if (currentFilter === 'semua') return true;
    var kategori = (el.dataset.kategori || '').toLowerCase();
    var program = (el.dataset.program || '').toLowerCase();
    return kategori === currentFilter || program === currentFilter;
  }

  function getFilteredCards() {
    return Array.prototype.filter.call(beritaCards, matchesFilter);
  }

  function getFilteredMobileItems() {
    return Array.prototype.filter.call(mobileItems, matchesFilter);
  }

  /* ----------------------------------------------------------
     Daftar nomor halaman dengan elipsis — dipakai desktop & mobile
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
     Render tombol Arrow-Pill-Arrow generik — dipakai desktop & mobile

     PENTING: fungsi ini TIDAK melakukan scrollIntoView apa pun.
     Scroll-ke-posisi hanya boleh terjadi sebagai AKIBAT dari aksi
     user (klik nomor/arrow), bukan setiap kali di-render — kalau
     scrollIntoView ditaruh di sini, dia akan ikut kepanggil saat
     render pertama kali (page load / refresh) dan bikin browser
     otomatis scroll ke area pagination meskipun user belum
     ngapa-ngapain.
     ---------------------------------------------------------- */
  function renderPaginationControls(container, current, totalPages, onGoToPage) {
    container.innerHTML = '';
    if (totalPages <= 1) return;

    var activePageNumber = current + 1;

    var prevBtn = document.createElement('button');
    prevBtn.type = 'button';
    prevBtn.className = 'berita-page-arrow berita-page-prev';
    prevBtn.setAttribute('aria-label', 'Halaman sebelumnya');
    prevBtn.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M15 6l-6 6 6 6" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"/></svg>';
    prevBtn.disabled = current === 0;
    prevBtn.addEventListener('click', function () { onGoToPage(current - 1); });
    container.appendChild(prevBtn);

    var pill = document.createElement('div');
    pill.className = 'berita-page-pill';

    buildPageList(activePageNumber, totalPages).forEach(function (item) {
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
        numBtn.addEventListener('click', function () { onGoToPage(pageIndex); });
      })(item - 1);
      pill.appendChild(numBtn);
    });

    container.appendChild(pill);

    var nextBtn = document.createElement('button');
    nextBtn.type = 'button';
    nextBtn.className = 'berita-page-arrow berita-page-next';
    nextBtn.setAttribute('aria-label', 'Halaman berikutnya');
    nextBtn.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M9 6l6 6-6 6" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"/></svg>';
    nextBtn.disabled = current === totalPages - 1;
    nextBtn.addEventListener('click', function () { onGoToPage(current + 1); });
    container.appendChild(nextBtn);

    // Auto-scroll horizontal pill (supaya nomor aktif kelihatan di
    // dalam pill-nya sendiri kalau nomornya banyak) TETAP dipakai,
    // tapi di-scope ke dalam pill saja (bukan window), jadi tidak
    // ikut menggeser scroll utama halaman.
    var activeEl = pill.querySelector('.berita-page-number.is-active');
    if (activeEl && typeof activeEl.scrollIntoView === 'function') {
      activeEl.scrollIntoView({ block: 'nearest', inline: 'nearest' });
    }
  }

  /* ---------------- Desktop render ---------------- */
  function renderDesktopPage(opts) {
    if (!beritaCards.length) return;
    var scrollAfter = !!(opts && opts.scrollAfter);

    var filtered = getFilteredCards();
    var pageSize = getDesktopPageSize();
    var totalPages = Math.max(1, Math.ceil(filtered.length / pageSize));
    desktopPage = Math.min(desktopPage, totalPages - 1);

    beritaCards.forEach(function (card) { card.classList.remove('is-visible'); });
    filtered.forEach(function (card, i) {
      if (Math.floor(i / pageSize) === desktopPage) card.classList.add('is-visible');
    });

    if (beritaEmpty) beritaEmpty.style.display = filtered.length ? 'none' : 'block';

    if (beritaPagination) {
      renderPaginationControls(beritaPagination, desktopPage, totalPages, function (p) {
        desktopPage = Math.max(0, Math.min(p, totalPages - 1));
        renderDesktopPage({ scrollAfter: true });
      });
    }

    // Scroll ke atas grid HANYA kalau dipicu klik pagination,
    // bukan saat render awal / refresh halaman.
    if (scrollAfter && beritaGrid) {
      beritaGrid.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  }

  /* ---------------- Mobile render (maksimal 15 berita/halaman) ---------------- */
  function renderMobilePage(opts) {
    if (!mobileItems.length) return;
    var scrollAfter = !!(opts && opts.scrollAfter);

    var filtered = getFilteredMobileItems();
    var totalPages = Math.max(1, Math.ceil(filtered.length / MOBILE_PAGE_SIZE));
    mobilePage = Math.min(mobilePage, totalPages - 1);

    mobileItems.forEach(function (item) { item.classList.add('is-hidden-filter'); });
    filtered.forEach(function (item, i) {
      if (Math.floor(i / MOBILE_PAGE_SIZE) === mobilePage) {
        item.classList.remove('is-hidden-filter');
      }
    });

    if (mobileEmpty) mobileEmpty.style.display = filtered.length ? 'none' : 'block';

    if (mobilePagination) {
      renderPaginationControls(mobilePagination, mobilePage, totalPages, function (p) {
        mobilePage = Math.max(0, Math.min(p, totalPages - 1));
        renderMobilePage({ scrollAfter: true });
      });
    }

    // Scroll ke pagination HANYA kalau dipicu klik pagination,
    // bukan saat render awal / refresh halaman.
    if (scrollAfter && mobilePagination) {
      mobilePagination.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  }

  if (beritaTabs.length) {
    beritaTabs.forEach(function (tab) {
      tab.addEventListener('click', function () {
        beritaTabs.forEach(function (t) { t.classList.remove('is-active'); });
        tab.classList.add('is-active');
        currentFilter = (tab.dataset.filter || 'semua').toLowerCase();
        desktopPage = 0;
        mobilePage = 0;
        renderDesktopPage();
        renderMobilePage();
      });
    });
  }

  // Render pertama kali (page load / refresh): TIDAK scroll ke mana pun.
  renderDesktopPage();
  renderMobilePage();

  window.addEventListener('resize', function () {
    clearTimeout(beritaResizeTimer);
    beritaResizeTimer = setTimeout(function () {
      desktopPage = 0;
      renderDesktopPage();
    }, 200);
  });

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