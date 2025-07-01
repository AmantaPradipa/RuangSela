<?= $this->extend('layouts/client_layout') ?>

<?= $this->section('title') ?>
Daftar Psikotes
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/psychotest.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<!-- BAGIAN 1: HERO -->
<section class="psychotest-hero-section">
    <div class="psychotest-hero-container">
        <h2>
            Tes Psikologi <span class="highlight-text">Online</span>
        </h2>
        <p>
            Pahami diri Anda lebih dalam melalui serangkaian tes psikologi yang dirancang oleh para ahli, mudah diakses, dan memberikan hasil yang informatif.
        </p>
    </div>
</section>

<!-- BAGIAN 2: PILIHAN TES -->
<section class="test-selection-section">
    <div class="test-selection-container">
        <h1>Pilih Tes yang Sesuai Untuk Anda</h1>
        <p class="subtitle">Kami menyediakan berbagai jenis tes yang dapat membantu Anda mengeksplorasi berbagai aspek diri.</p>

        <div class="test-grid">
            <?php if (!empty($tests)) : ?>
                <?php foreach ($tests as $test) : ?>
                    <div class="test-card">
                        <div class="icon-wrapper">
                            <i class="ri-heart-pulse-line"></i>
                        </div>
                        <h3 class="card-title"><?= esc($test->title) ?></h3>
                        <p class="card-description"><?= esc($test->description) ?></p>
                        <a href="<?= site_url('client/psikotes/take/' . esc($test->id)) ?>" class="cta-button active">Mulai Tes Sekarang</a>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="no-tests-card">
                    <div class="icon-wrapper">
                        <i class="ri-file-forbid-line"></i>
                    </div>
                    <h3>Belum Ada Tes yang Tersedia</h3>
                    <p>Saat ini belum ada tes psikologi yang dapat diambil. Silakan kembali lagi nanti.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- BAGIAN 3: MENGAPA MENGAMBIL TES -->
<section class="why-us-section">
    <div class="why-us-container">
        <header class="why-us-header">
            <h2>Mengapa Mengambil Tes Psikologi di RuangSela?</h2>
            <p>Tes psikologi kami dirancang untuk memberikan manfaat nyata bagi pemahaman dan pengembangan diri Anda.</p>
        </header>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon"><i class="ri-check-double-line"></i></div>
                <h3>Pemahaman Diri</h3>
                <p>Dapatkan wawasan mendalam tentang aspek-aspek psikologis diri Anda.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="ri-check-double-line"></i></div>
                <h3>Identifikasi Dini</h3>
                <p>Membantu mengenali potensi masalah kesehatan mental lebih awal.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="ri-check-double-line"></i></div>
                <h3>Pengembangan Diri</h3>
                <p>Hasil tes dapat menjadi panduan untuk pertumbuhan pribadi dan profesional.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="ri-check-double-line"></i></div>
                <h3>Mudah & Aksesibel</h3>
                <p>Tes dapat diakses kapan saja dan di mana saja secara online.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="ri-check-double-line"></i></div>
                <h3>Laporan Informatif</h3>
                <p>Dapatkan laporan hasil yang mudah dipahami beserta rekomendasi umum.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="ri-check-double-line"></i></div>
                <h3>Kerahasiaan Terjamin</h3>
                <p>Kami menjaga privasi data dan hasil tes Anda dengan standar keamanan tinggi.</p>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
