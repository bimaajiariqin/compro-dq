document.addEventListener('DOMContentLoaded', () => {
    const list = document.querySelector('[data-faq-list]');
    if (!list) return;

    list.addEventListener('click', (event) => {
        const toggle = event.target.closest('[data-faq-toggle]');
        if (!toggle) return;

        const item = toggle.closest('[data-faq-item]');
        const isOpen = item.classList.contains('is-open');

        item.classList.toggle('is-open', !isOpen);
        toggle.setAttribute('aria-expanded', String(!isOpen));
    });
});