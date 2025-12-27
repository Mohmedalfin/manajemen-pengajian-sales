document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('searchInput');
    const form = document.getElementById('searchForm');

    if (!input || !form) return;

    let timer = null;

    input.addEventListener('input', function () {
        clearTimeout(timer);

        timer = setTimeout(() => {
            if (this.value.trim() === '') {
                window.location.href = window.location.pathname;
            } else {
                form.submit();
            }
        }, 400);
    });
});
