// public/assets/js/global/header.js

document.addEventListener("DOMContentLoaded", function () {
    const header = document.getElementById("site-header");
    const headerLogo = document.getElementById("header-logo");

    // Cek apakah elemen header ada di halaman ini
    if (!header) {
        return;
    }

    const isStaticScrolled = header.dataset.staticScrolled === 'true';

    // Fungsi untuk mengatur header ke mode 'scrolled'
    const setHeaderScrolled = () => {
        header.classList.add("scrolled");
        if (headerLogo) {
            headerLogo.src = headerLogo.dataset.logoGreen;
        }
    };

    // Jika header ditandai sebagai 'static-scrolled' (misal: di halaman detail artikel),
    // langsung atur stylenya dan jangan tambahkan event listener scroll.
    if (isStaticScrolled) {
        setHeaderScrolled();
    } else {
        // --- FUNGSI UNTUK MENGUBAH BACKGROUND HEADER SAAT SCROLL ---
        const handleHeaderScroll = () => {
            // Tambahkan kelas 'scrolled' ke header jika pengguna scroll lebih dari 50px
            if (window.scrollY > 50) {
                header.classList.add("scrolled");
                if (headerLogo) headerLogo.src = headerLogo.dataset.logoGreen;
            } else {
                header.classList.remove("scrolled");
                if (headerLogo) headerLogo.src = headerLogo.dataset.logoWhite;
            }
        };

        // Tambahkan event listener saat scroll
        window.addEventListener("scroll", handleHeaderScroll);
        // Panggil fungsi sekali saat halaman dimuat untuk memeriksa posisi awal
        handleHeaderScroll();
    }

    // --- FUNGSI UNTUK MENANDAI MENU AKTIF BERDASARKAN URL ---
    const setActiveMenuItem = () => {
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('.header-nav ul li a');

        navLinks.forEach(link => {
            link.classList.remove('active');
            const linkPath = new URL(link.href).pathname;
            if (currentPath === linkPath || (linkPath === '/' && currentPath.startsWith('/index.php'))) {
                link.classList.add('active');
            }
        });
    };

    // Panggil fungsi untuk set menu aktif saat halaman selesai dimuat
    setActiveMenuItem();
});