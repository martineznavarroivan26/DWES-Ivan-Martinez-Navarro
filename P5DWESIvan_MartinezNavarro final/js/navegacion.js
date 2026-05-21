document.addEventListener('DOMContentLoaded', function () {
    var header = document.querySelector('.site-header');
    if (!header) {
        return;
    }

    function updateHeaderOnScroll() {
        if (window.scrollY > 18) {
            header.classList.add('brand-translucent');
        } else {
            header.classList.remove('brand-translucent');
        }
    }

    updateHeaderOnScroll();
    window.addEventListener('scroll', updateHeaderOnScroll, { passive: true });
});
