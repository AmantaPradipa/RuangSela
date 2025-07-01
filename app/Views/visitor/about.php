<?= $this->extend('layouts/visitor_layout') ?>

<?= $this->section('title') ?>
Tentang Kami - RuangSela
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/services.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="page-hero-section">
    <div class="page-hero-container">
        <h1>Tentang RuangSela</h1>
        <p class="intro-text">
            Kami adalah tim yang berdedikasi untuk menyediakan dukungan kesehatan mental yang mudah diakses dan berkualitas bagi semua.
        </p>
    </div>
</section>

<section class="consultation-section">
    <div class="consultation-container">
        <div class="text-content">
            <h2>Misi Kami</h2>
            <p class="description">Menciptakan ruang aman dan suportif di mana setiap individu dapat menemukan dukungan profesional untuk perjalanan kesehatan mental mereka.</p>
            <ul class="steps-list">
                <li><span class="step-number">1</span><p>Memberikan akses mudah ke terapis berlisensi.</p></li>
                <li><span class="step-number">2</span><p>Menyediakan sumber daya edukatif yang relevan.</p></li>
                <li><span class="step-number">3</span><p>Membangun komunitas yang saling mendukung.</p></li>
            </ul>
        </div>
        <div class="image-content">
            <img src="<?= base_url('assets/images/illustrations/service-section.png') ?>" alt="Tentang Kami">
        </div>
    </div>
</section>

<section class="why-us-section">
    <div class="why-us-container">
        <h2 class="section-title">Nilai-nilai Kami</h2>
        <p class="section-subtitle">Kami berpegang teguh pada prinsip-prinsip berikut dalam setiap aspek layanan kami.</p>
        <div class="features-grid">
            <div class="feature-card">
                <div class="icon-container"><i class="ri-heart-line"></i></div>
                <div><h3>Empati</h3><p>Mendengarkan dan memahami dengan sepenuh hati.</p></div>
            </div>
            <div class="feature-card">
                <div class="icon-container"><i class="ri-shield-check-line"></i></div>
                <div><h3>Integritas</h3><p>Menjaga kerahasiaan dan etika profesional.</p></div>
            </div>
            <div class="feature-card">
                <div class="icon-container"><i class="ri-lightbulb-line"></i></div>
                <div><h3>Inovasi</h3><p>Terus mengembangkan layanan terbaik.</p></div>
            </div>
            <div class="feature-card">
                <div class="icon-container"><i class="ri-group-line"></i></div>
                <div><h3>Kolaborasi</h3><p>Bekerja sama untuk hasil terbaik.</p></div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>