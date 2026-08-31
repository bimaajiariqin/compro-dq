/* ==========================================================================
   cerita-penerima-manfaat-slider.js
   Slider manual (swipe/drag & tombol navigasi) tanpa autoplay otomatis.
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
    var isProgrammaticScrolling = false;
    var scrollEndTimer = null;

    function isMobileLayout() {
      return window.matchMedia('(max-width: 640px)').matches;
    }

    function updateNavLine() {
      if (navLine) {
        navLine.style.setProperty('--total-slides', totalSlides);
        navLine.style.setProperty('--active-index', index);
      }
    }

    function updateButtonsState() {
      prevBtn.disabled = index === 0;
      nextBtn.disabled = index >= totalSlides - 1;
    }

    // Mendapatkan indeks item terdekat dari tengah container (untuk mobile scroll sync)
    function getClosestIndexToScroll() {
      var sliderRect = root.getBoundingClientRect();
      var sliderCenter = sliderRect.left + sliderRect.width / 2;

      var closestIndex = 0;
      var minDistance = Infinity;

      items.forEach(function (item, i) {
        var box = item.getBoundingClientRect();
        var itemCenter = box.left + box.width / 2;
        var distance = Math.abs(itemCenter - sliderCenter);

        if (distance < minDistance) {
          minDistance = distance;
          closestIndex = i;
        }
      });

      return closestIndex;
    }

    function update() {
      updateNavLine();
      updateButtonsState();

      if (!isMobileLayout()) {
        // Desktop Mode: Transform TranslateX
        var styles = getComputedStyle(track);
        var gap = parseFloat(styles.columnGap || styles.gap || '0') || 0;
        var cardWidth = items[0].getBoundingClientRect().width;
        var offset = index * (cardWidth + gap);

        track.style.transform = 'translateX(-' + offset + 'px)';
      }
    }

    function goToIndex(newIndex) {
      var resolvedIndex = newIndex;

      if (newIndex < 0) resolvedIndex = 0;
      if (newIndex >= totalSlides) resolvedIndex = totalSlides - 1;

      index = resolvedIndex;

      if (isMobileLayout()) {
        isProgrammaticScrolling = true;

        items[index].scrollIntoView({
          behavior: 'smooth',
          inline: 'center',
          block: 'nearest'
        });

        window.setTimeout(function () {
          isProgrammaticScrolling = false;
        }, 500);
      }

      update();
    }

    // ---------------------------------------------------------------- //
    // Event Listeners
    // ---------------------------------------------------------------- //

    prevBtn.addEventListener('click', function () {
      goToIndex(index - 1);
    });

    nextBtn.addEventListener('click', function () {
      goToIndex(index + 1);
    });

    // Sync indikator garis & tombol saat pengguna melakukan swipe manual di Mobile
    root.addEventListener('scroll', function () {
      if (!isMobileLayout() || isProgrammaticScrolling) return;

      window.clearTimeout(scrollEndTimer);
      scrollEndTimer = window.setTimeout(function () {
        var closest = getClosestIndexToScroll();
        if (index !== closest) {
          index = closest;
          updateNavLine();
          updateButtonsState();
        }
      }, 60);
    }, { passive: true });

    // Handle Window Resize
    window.addEventListener('resize', function () {
      if (isMobileLayout()) {
        track.style.transform = 'none';
      }
      update();
    });

    // Inisialisasi awal
    update();
  }
})();