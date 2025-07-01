<?php
    // Dapatkan URI service untuk mengecek segmen URL
    $uri = service('uri');
    // Ambil segmen pertama. Jika tidak ada, berarti halaman utama. Kita set sebagai 'beranda' untuk konsistensi.
    $current_segment = $uri->getSegment(1) ?: 'beranda';

    // Cek apakah ini halaman detail artikel. Asumsinya URL adalah /artikel/[slug]
    // Jika ya, header akan dibuat statis dalam mode 'scrolled'.
    $is_article_detail_page = ($current_segment === 'artikel' && $uri->getSegment(2));
?>
<!-- Header di visitor_layout.php memiliki style khusus (absolute) untuk landing page -->
<!-- Jika header ini digunakan di page lain, mungkin perlu class tambahan -->
<header class="site-header" id="site-header" <?= $is_article_detail_page ? 'data-static-scrolled="true"' : '' ?>>
    <!-- Logo -->
    <a href="<?= site_url('beranda') ?>" class="header-logo">
        <!-- Logo akan berubah saat di-scroll. Pastikan kedua file logo ada. -->
        <img src="<?= base_url('assets/images/logos/logo-white.png') ?>" 
            alt="Logo RuangSela"
            id="header-logo"
            data-logo-white="<?= base_url('assets/images/logos/logo-white.png') ?>"
            data-logo-green="<?= base_url('assets/images/logos/logo-green.png') ?>">
    </a>

    <!-- Menu Navigasi -->
    <nav class="header-nav">
        <ul>
            <!-- Menambahkan class 'active' secara dinamis berdasarkan segmen URL saat ini -->
            <li><a href="<?= site_url('beranda') ?>" class="<?= ($current_segment === 'beranda') ? 'active' : '' ?>">Beranda</a></li>
            <li><a href="<?= site_url('layanan') ?>" class="<?= ($current_segment === 'layanan') ? 'active' : '' ?>">Layanan</a></li>
            <li><a href="<?= site_url('konsultasi') ?>" class="<?= ($current_segment === 'konsultasi') ? 'active' : '' ?>">Konsultasi</a></li>
            <li><a href="<?= site_url('artikel') ?>" class="<?= ($current_segment === 'artikel') ? 'active' : '' ?>">Artikel</a></li>
            <li><a href="<?= site_url('psikotes') ?>" class="<?= ($current_segment === 'psikotes') ? 'active' : '' ?>">Tes Psikologi</a></li>
            <li><a href="<?= site_url('terapis') ?>" class="<?= ($current_segment === 'terapis') ? 'active' : '' ?>">Daftar Terapis</a></li>
            <li><a href="<?= site_url('faq') ?>" class="<?= ($current_segment === 'faq') ? 'active' : '' ?>">FAQ</a></li>
        </ul>
    </nav>

    <!-- Tombol Aksi (Masuk & Daftar) -->
    <div class="header-actions">
        <a href="<?= site_url('login') ?>" class="btn btn-login">Masuk</a>
        <a href="<?= site_url('register') ?>" class="btn btn-register">Daftar</a>
    </div>

    <!-- Tombol untuk Mobile (jika diperlukan nanti) -->
    <button class="mobile-menu-toggle" aria-label="Buka Menu">
        <i class="ri-menu-line"></i>
    </button>
</header>
