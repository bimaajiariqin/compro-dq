/**
 * program-berita-slider.js
 * Slider "Berita Terkait" dengan navigasi dot, dipakai di semua
 * halaman Program (Pendidikan, Ekonomi, Dakwah, Kemanusiaan).
 *
 * Menampilkan `pageSize` kartu per slide (default 4, sesuai
 * data-page-size di elemen [data-berita-slider]) dan menggeser
 * track dengan transform translateX berdasarkan dot yang dipilih.
 */
(function () {
    document.querySelectorAll('[data-berita-slider]').forEach((slider) => {
        const track = slider.querySelector('[data-berita-track]');
        const items = track ? Array.from(track.querySelectorAll('[data-slide-item]')) : [];
        const pageSize = parseInt(slider.dataset.pageSize, 10) || 4;
        const dotsWrap = slider.parentElement.querySelector('[data-berita-dots]');

        if (!track || items.length <= pageSize || !dotsWrap) {
            return;
        }

        const pageCount = Math.ceil(items.length / pageSize);
        let current = 0;

        dotsWrap.innerHTML = '';
        for (let i = 0; i < pageCount; i++) {
            const dot = document.createElement('button');
            dot.type = 'button';
            dot.setAttribute('aria-label', `Halaman berita ${i + 1}`);
            if (i === 0) dot.classList.add('is-active');
            dot.addEventListener('click', () => goTo(i));
            dotsWrap.appendChild(dot);
        }

        function goTo(page) {
            current = Math.max(0, Math.min(page, pageCount - 1));
            const offset = current * 100;
            track.style.transform = `translateX(-${offset}%)`;

            dotsWrap.querySelectorAll('button').forEach((btn, i) => {
                btn.classList.toggle('is-active', i === current);
            });
        }

        goTo(0);
    });
})();