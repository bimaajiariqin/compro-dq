/**
 * program-berita-slider.js
 * Slider "Berita Terkait" dengan navigasi dot, dipakai di semua
 * halaman Program (Pendidikan, Ekonomi, Dakwah, Kemanusiaan).
 *
 * Desktop/tablet (> 860px): menampilkan `pageSize` kartu per slide
 * (default 4, sesuai data-page-size di [data-berita-slider]) dan
 * menggeser track dengan transform translateX berdasarkan dot yang
 * dipilih.
 *
 * Mobile (<= 860px): dot & transform dimatikan, track dibiarkan
 * jadi flex row yang bisa di-scroll horizontal secara native
 * (swipe), ditangani lewat CSS (.program-berita__slider { overflow-x }).
 */
(function () {
    var MOBILE_QUERY = '(max-width: 860px)';

    document.querySelectorAll('[data-berita-slider]').forEach(function (slider) {
        var track = slider.querySelector('[data-berita-track]');
        var items = track ? Array.from(track.querySelectorAll('[data-slide-item]')) : [];
        var pageSize = parseInt(slider.dataset.pageSize, 10) || 4;
        var dotsWrap = slider.parentElement.querySelector('[data-berita-dots]');

        if (!track || items.length <= pageSize || !dotsWrap) {
            return;
        }

        var pageCount = Math.ceil(items.length / pageSize);
        var current = 0;
        var mql = window.matchMedia(MOBILE_QUERY);

        function isMobile() {
            return mql.matches;
        }

        function buildDots() {
            dotsWrap.innerHTML = '';
            for (var i = 0; i < pageCount; i++) {
                var dot = document.createElement('button');
                dot.type = 'button';
                dot.setAttribute('aria-label', 'Halaman berita ' + (i + 1));
                if (i === 0) dot.classList.add('is-active');
                dot.addEventListener('click', (function (pageIndex) {
                    return function () {
                        goTo(pageIndex);
                    };
                })(i));
                dotsWrap.appendChild(dot);
            }
        }

        function goTo(page) {
            current = Math.max(0, Math.min(page, pageCount - 1));
            var offset = current * 100;
            track.style.transform = 'translateX(-' + offset + '%)';

            dotsWrap.querySelectorAll('button').forEach(function (btn, i) {
                btn.classList.toggle('is-active', i === current);
            });
        }

        function enableDesktopSlider() {
            buildDots();
            goTo(0);
        }

        function enableMobileScroll() {
            // Di mobile, berita di-scroll horizontal langsung (swipe native),
            // jadi transform slider & dot navigasi tidak dipakai lagi.
            track.style.transform = '';
            track.scrollLeft = 0;
            dotsWrap.innerHTML = '';
        }

        function refresh() {
            if (isMobile()) {
                enableMobileScroll();
            } else {
                enableDesktopSlider();
            }
        }

        refresh();

        // Reset ulang saat breakpoint berubah (misal rotate device / resize browser)
        if (typeof mql.addEventListener === 'function') {
            mql.addEventListener('change', refresh);
        } else if (typeof mql.addListener === 'function') {
            // fallback untuk Safari lama
            mql.addListener(refresh);
        }
    });
})();