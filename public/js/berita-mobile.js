document.addEventListener('DOMContentLoaded', function () {

  var mobileItems = document.querySelectorAll('.berita-mobile-item');
  var filterTabs = document.querySelectorAll('.berita-tab');
  var mobileEmpty = document.getElementById('beritaMobileEmpty');
  var currentFilter = 'semua';

  if (!mobileItems.length) return;

  /* Tidak ada pagination/dot di mobile — semua item yang cocok dengan
     filter langsung tampil, di-collapse halus lewat CSS (max-height),
     bukan JS yang menghitung tinggi. */
  function applyMobileFilter() {
    var visibleCount = 0;

    mobileItems.forEach(function (item) {
      var kategori = (item.dataset.kategori || '').toLowerCase();
      var program = (item.dataset.program || '').toLowerCase();
      var match = currentFilter === 'semua' || kategori === currentFilter || program === currentFilter;

      item.classList.toggle('is-hidden-filter', !match);
      if (match) visibleCount++;
    });

    if (mobileEmpty) mobileEmpty.style.display = visibleCount ? 'none' : 'block';
  }

  if (filterTabs.length) {
    filterTabs.forEach(function (tab) {
      tab.addEventListener('click', function () {
        currentFilter = (tab.dataset.filter || 'semua').toLowerCase();
        applyMobileFilter();
      });
    });
  }

  applyMobileFilter();
});