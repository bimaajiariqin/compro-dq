/* ==========================================================================
   cerita-penerima-manfaat-slider.js
   Menggerakkan slider "Cerita Penerima Manfaat" lewat tombol panah
   prev/next serta memperbarui garis indikator progress bar secara dinamis.
   ========================================================================== */
(function () {
  document.querySelectorAll('[data-cpm-slider]').forEach(initCpmSlider);

  function initCpmSlider(root) {
    var track = root.querySelector('[data-cpm-track]');
    var items = Array.prototype.slice.call(track ? track.querySelectorAll('[data-cpm-item]') : []);
    if (!track || items.length === 0) return;

    var section = root.closest('.cpm');
    var prevBtn = section && section.querySelector('[data-cpm-prev]');
    var nextBtn = section && section.querySelector('[data-cpm-next]');
    var navLine = section && section.querySelector('.cpm__nav-line');
    if (!prevBtn || !nextBtn) return;

    var index = 0;
    var totalSlides = items.length;

    function isMobileLayout() {
      return window.matchMedia('(max-width: 640px)').matches;
    }

    function update() {
      // Update variabel garis progress di CSS
      if (navLine) {
        navLine.style.setProperty('--total-slides', totalSlides);
        navLine.style.setProperty('--active-index', index);
      }

      if (isMobileLayout()) {
        track.style.transform = 'none';
        prevBtn.disabled = false;
        nextBtn.disabled = false;
        return;
      }

      var styles = getComputedStyle(track);
      var gap = parseFloat(styles.columnGap || styles.gap || '0') || 0;
      var cardWidth = items[0].getBoundingClientRect().width;
      var offset = index * (cardWidth + gap);

      track.style.transform = 'translateX(-' + offset + 'px)';
      prevBtn.disabled = index === 0;
      nextBtn.disabled = index >= items.length - 1;
    }

    prevBtn.addEventListener('click', function () {
      if (index > 0) {
        index -= 1;
        update();
      }
    });

    nextBtn.addEventListener('click', function () {
      if (index < items.length - 1) {
        index += 1;
        update();
      }
    });

    window.addEventListener('resize', update);
    update();
  }
})();