const hamburger = document.getElementById('hamburger');
const nav = document.getElementById('nav');

if (hamburger && nav) {
    hamburger.addEventListener('click', function () {
        nav.classList.toggle('open');
    });

    nav.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', function () {
            nav.classList.remove('open');
        });
    });

    document.addEventListener('click', function (e) {
        if (!nav.contains(e.target) && !hamburger.contains(e.target)) {
            nav.classList.remove('open');
        }
    });

    window.addEventListener('resize', function () {
        if (window.innerWidth > 768) nav.classList.remove('open');
    });
}

/* dark / light mode toggle */
const themeToggle = document.getElementById('theme-toggle');

function applyTheme(theme) {
    if (theme === 'light') {
        document.body.classList.add('light-mode');
    } else {
        document.body.classList.remove('light-mode');
    }
    if (themeToggle) {
        themeToggle.textContent = theme === 'light' ? '☀️' : '🌙';
    }
}

applyTheme(localStorage.getItem('theme') || 'dark');

if (themeToggle) {
    themeToggle.addEventListener('click', function () {
        const isLight = document.body.classList.toggle('light-mode');
        const theme = isLight ? 'light' : 'dark';
        localStorage.setItem('theme', theme);
        themeToggle.textContent = isLight ? '☀️' : '🌙';
    });
}

/* language switch (ro / en) */
const langBtn = document.getElementById('lang-btn');
if (langBtn) {
    const currentLang = document.cookie.includes('lang=en') ? 'en' : 'ro';
    langBtn.textContent = currentLang === 'ro' ? 'RO' : 'EN';
    langBtn.addEventListener('click', function() {
        const newLang = document.cookie.includes('lang=en') ? 'ro' : 'en';
        document.cookie = 'lang=' + newLang + '; path=/; max-age=31536000';
        location.reload();
    });
}
