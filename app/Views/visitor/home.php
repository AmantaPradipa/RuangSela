<?= $this->extend('layouts/visitor_layout') ?>

<?php // Section untuk judul halaman spesifik ?>
<?= $this->section('title') ?>
Beranda - RuangSela
<?= $this->endSection() ?>

<?php // Section untuk menyisipkan CSS khusus halaman ini ?>
<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/landing.css') ?>">
<?= $this->endSection() ?>

<?php // Section untuk konten utama halaman ?>
<?= $this->section('content') ?>

<!-- HERO SECTION -->
<section class="hero-section">
    <div class="hero-content">
        <h1>
            RuangSela: <span class="highlight">Dukungan Kesehatan Mental Anda</span> Dimulai Di Sini.
        </h1>
        <p>
            Kami menyediakan ruang aman dan profesional untuk Anda bertumbuh,
            menemukan ketenangan, dan meningkatkan kualitas hidup melalui layanan
            kesehatan mental yang terintegrasi.
        </p>
        <div class="hero-actions">
            <a href="<?= site_url('layanan') ?>" class="hero-btn primary">Lihat Layanan Kami</a>
            <a href="#tentang" class="hero-btn secondary">Pelajari Lebih Lanjut</a>
        </div>
    </div>
</section>

<!-- ABOUT SECTION -->
<div class="about-container" id="tentang">
    <header class="about-header">
        <h1>Tentang RuangSela</h1>
        <p>Memahami siapa kami, apa yang kami perjuangkan, dan bagaimana kami dapat membantu Anda.</p>
    </header>
    <section class="about-intro">
        <h2>Apa Itu RuangSela?</h2>
        <p>RuangSela adalah platform kesehatan mental yang berdedikasi untuk menyediakan akses mudah dan terjangkau ke layanan psikologis berkualitas. Misi kami adalah menciptakan ruang yang aman, suportif, dan memberdayakan bagi siapa saja yang ingin memahami diri lebih baik, mengatasi tantangan hidup, dan mencapai kesejahteraan mental.</p>
    </section>
</div>

<!-- SERVICES SECTION -->
<div class="services-section-wrapper">
    <section class="services-section">
        <h2>Apa yang Kami Berikan?</h2>
        <p class="intro-p">Kami menawarkan serangkaian layanan terpadu yang dirancang untuk memenuhi berbagai kebutuhan kesehatan mental Anda.</p>
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon"><i class="ri-group-line"></i></div>
                <h3>Konsultasi Profesional</h3>
                <p>Konsultasi dengan psikolog dan konselor berpengalaman melalui video call, chat, atau telepon.</p>
            </div>
            <div class="service-card">
                <div class="service-icon"><i class="ri-flask-line"></i></div>
                <h3>Tes Psikologi</h3>
                <p>Berbagai tes psikologi untuk membantu Anda memahami diri dan mengidentifikasi area yang perlu ditingkatkan.</p>
            </div>
            <div class="service-card">
                <div class="service-icon"><i class="ri-book-read-line"></i></div>
                <h3>Sumber Daya Edukatif</h3>
                <p>Artikel, panduan, dan materi edukatif untuk meningkatkan pemahaman tentang kesehatan mental.</p>
            </div>
        </div>
    </section>
</div>

<!-- TEAM SECTION -->
<section class="team-section">
    <div class="team-container">
        <div class="team-header">
            <h2>Siapa Dibalik RuangSela</h2>
            <p>Bertemu dengan tim profesional dan berdedikasi yang siap mendukung membantu dalam kesehatan mental Anda.</p>
        </div>
        <div class="team-grid">
            <!-- Asumsikan gambar ada di public/assets/images/team/ -->
            <div class="team-card">
                <div class="team-photo-wrapper photo-bg-1"><img src="<?= base_url('assets/images/avatars/ava-callista.png') ?>" alt="Foto Callista"></div>
                <div class="team-info"><h3>Callista</h3><p class="role">Designer</p></div>
            </div>
            <div class="team-card">
                <div class="team-photo-wrapper photo-bg-2"><img src="<?= base_url('assets/images/avatars/ava-amanta.png') ?>" alt="Foto Amanta Pradipa"></div>
                <div class="team-info"><h3>Amanta Pradipa</h3><p class="role">Full Stack Developer</p></div>
            </div>
            <div class="team-card">
                <div class="team-photo-wrapper photo-bg-3"><img src="<?= base_url('assets/images/avatars/ava-dina.png') ?>" alt="Foto Dina"></div>
                <div class="team-info"><h3>Dina</h3><p class="role">Project Manager</p></div>
            </div>
        </div>
        <div class="team-cta">
            <a href="#" class="btn-team">Lihat Tim Selengkapnya</a>
        </div>
    </div>
</section>

<!-- TESTIMONIALS SECTION -->
<div class="testimonials-section-wrapper">
    <section class="testimonials-section">
        <h2>Ulasan Pengguna Tentang RuangSela</h2>
        <p class="subtitle">Simak apa kata mereka yang telah memberikan masukan tentang pengalaman mereka menggunakan platform kami.</p>
        <div class="testimonial-grid">
            <?php if (!empty($testimonials) && is_array($testimonials)) : ?>
                <?php foreach ($testimonials as $testimonial) : ?>
                    <div class="testimonial-card">
                        <span class="quote-icon">”</span>
                        <div>
                            <p class="testimonial-quote">"<?= esc($testimonial['comment'], 'html') ?>"</p>
                        </div>
                        <div>
                            <hr class="card-divider">
                            <div class="user-info">
                                <div class="user-avatar"><?= esc($testimonial['user_initials'], 'html') ?></div>
                                <div class="user-details">
                                    <p class="user-name"><?= esc($testimonial['user_name'], 'html') ?></p>
                                    <div class="star-rating">
                                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                                            <i class="ri-star-s-fill<?= $i > $testimonial['rating'] ? ' star-inactive' : '' ?>"></i>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="no-testimonials" style="grid-column: 1 / -1; text-align: center; padding: 4rem 0; color: var(--light-text, #777);">
                    <p>Belum ada testimoni untuk saat ini.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
</div>

<?= $this->endSection() ?>

<?php // Section untuk menyisipkan JS khusus halaman ini ?>
<?= $this->section('pageScripts') ?>
<script src="<?= base_url('assets/js/pages/landing.js') ?>"></script>
<?= $this->endSection() ?>
