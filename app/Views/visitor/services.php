<?= $this->extend('layouts/visitor_layout') ?>

<?php // Section untuk judul halaman spesifik ?>
<?= $this->section('title') ?>
Layanan Kami - RuangSela
<?= $this->endSection() ?>

<?php // Section untuk menyisipkan CSS khusus halaman ini ?>
<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/services.css') ?>">
<?= $this->endSection() ?>

<?php // Section untuk konten utama halaman ?>
<?= $this->section('content') ?>

<!-- SECTION 1: PAGE HERO -->
<section class="page-hero-section">
    <div class="page-hero-container">
        <h1>Layanan Lengkap Kami</h1>
        <p class="intro-text">
            RuangSela hadir sebagai ruang aman untuk berbagi cerita dan menemukan solusi. Kami siap mendampingi perjalanan Anda menuju kesehatan mental yang lebih baik.
        </p>
    </div>
</section>

<!-- SECTION 2: KONSULTASI TERAPIS PROFESIONAL -->
<section class="consultation-section">
    <div class="consultation-container">
        <div class="text-content">
            <h2>Konsultasi Terapis <span>Profesional</span></h2>
            <p class="description">Dapatkan dukungan dari terapis berlisensi yang siap membantu Anda mengatasi tantangan emosional melalui sesi konsultasi yang nyaman dan aman.</p>
            <ul class="steps-list">
                <li><span class="step-number">1</span><p>Pilih terapis sesuai kebutuhan Anda</p></li>
                <li><span class="step-number">2</span><p>Jadwalkan sesi konsultasi yang nyaman</p></li>
                <li><span class="step-number">3</span><p>Lakukan konsultasi via video call atau chat</p></li>
                <li><span class="step-number">4</span><p>Dapatkan solusi dan rencana tindak lanjut</p></li>
            </ul>
        </div>
        <div class="image-content">
            <img src="<?= base_url('assets/images/illustrations/service-section.png') ?>" alt="Terapis sedang berkonsultasi dengan klien">
        </div>
    </div>
</section>

<!-- SECTION 3: MENGAPA MEMILIH KAMI -->
<section class="why-us-section">
    <div class="why-us-container">
        <h2 class="section-title">Mengapa Memilih Konsultasi di RuangSela?</h2>
        <p class="section-subtitle">Terapis kami memberikan panduan dan dukungan yang Anda butuhkan dengan pendekatan profesional dan empatik.</p>
        <div class="features-grid">
            <div class="feature-card">
                <div class="icon-container"><i class="ri-lock-line"></i></div>
                <div><h3>Sesi Privat dan Rahasia</h3><p>Semua sesi dijamin kerahasiaannya sesuai kode etik profesional.</p></div>
            </div>
            <div class="feature-card">
                <div class="icon-container"><i class="ri-stethoscope-line"></i></div>
                <div><h3>Terapis Berbagai Spesialisasi</h3><p>Temukan terapis yang sesuai dengan kebutuhan Anda dari berbagai spesialisasi.</p></div>
            </div>
            <div class="feature-card">
                <div class="icon-container"><i class="ri-calendar-2-line"></i></div>
                <div><h3>Jadwal Fleksibel</h3><p>Atur jadwal konsultasi sesuai waktu nyaman Anda via video call atau chat.</p></div>
            </div>
            <div class="feature-card">
                <div class="icon-container"><i class="ri-clipboard-line"></i></div>
                <div><h3>Pendekatan Berbasis Bukti</h3><p>Metode terapi yang digunakan berbasis pada penelitian ilmiah terkini.</p></div>
            </div>
        </div>
        <a href="<?= site_url('packages') ?>" class="cta-button">Lihat Paket Konsultasi <i class="ri-arrow-right-s-line"></i></a>
    </div>
</section>

<!-- SECTION 4: TES PSIKOLOGI ONLINE -->
<section class="psychology-test-section">
    <div class="psychology-test-container">
        <div class="header-content">
            <h2 class="section-title">Tes Psikologi Online</h2>
            <div class="title-underline"></div>
            <p class="section-subtitle">Dirancang untuk mengetahui kondisi psikologis Anda melalui serangkaian tes terpercaya yang mudah diakses dari mana saja.</p>
        </div>
        <div class="content-card">
            <div class="card-image-wrapper">
                <img src="<?= base_url('assets/images/illustrations/service-section-2.png') ?>" alt="Orang sedang mengerjakan tes online">
            </div>
            <div class="card-content">
                <h3>Pahami Diri Lebih Dalam</h3>
                <p>Tes psikologi ini memberikan wawasan tentang berbagai aspek kepribadian, tingkat stres, kecemasan, hingga potensi minat Anda.</p>
                <ul class="feature-list">
                    <li><i class="ri-check-line"></i> Proses pengerjaan mudah dan cepat</li>
                    <li><i class="ri-check-line"></i> Laporan hasil yang komprehensif</li>
                    <li><i class="ri-check-line"></i> Dikembangkan berdasarkan standar psikometri</li>
                    <li><i class="ri-check-line"></i> Membantu mengidentifikasi area yang perlu perhatian</li>
                </ul>
                <a href="<?= site_url('psychotest') ?>" class="cta-button"><i class="ri-arrow-right-line"></i> Mulai Tes Sekarang</a>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 5: ARTIKEL KESEHATAN MENTAL (BARU) -->
<section class="articles-section">
    <div class="articles-container">
        <header class="articles-header">
            <h2>Artikel Kesehatan Mental</h2>
            <p>Wawasan dan informasi terpercaya untuk kesehatan mental yang lebih baik</p>
        </header>
        <div class="articles-content-wrapper">
            <div class="articles-image-column">
                <img src="<?= base_url('assets/images/illustrations/service-section-3.png') ?>" alt="Ilustrasi sekelompok orang berdiskusi tentang kesehatan mental">
            </div>
            <div class="articles-text-column">
                <h3>Sumber Informasi Terpercaya Anda</h3>
                <p class="description">Kami berkomitmen menyediakan artikel berkualitas tentang kesehatan mental yang mencakup berbagai topik seperti manajemen stres, mindfulness, hubungan interpersonal, dan gangguan mood. Semua konten ditulis oleh para profesional.</p>
                <div class="info-cards-grid">
                    <div class="info-card">
                        <div class="icon"><i class="ri-file-text-line"></i></div>
                        <div class="card-text"><strong>Topik</strong> Beragam</div>
                    </div>
                    <div class="info-card">
                        <div class="icon"><i class="ri-book-open-line"></i></div>
                        <div class="card-text"><strong>Bahasa</strong> Sederhana</div>
                    </div>
                    <div class="info-card">
                        <div class="icon"><i class="ri-lightbulb-flash-line"></i></div>
                        <div class="card-text"><strong>Tips</strong> Praktis</div>
                    </div>
                    <div class="info-card">
                        <div class="icon"><i class="ri-calendar-check-line"></i></div>
                        <div class="card-text"><strong>Update</strong> Berkala</div>
                    </div>
                </div>
                <a href="<?= site_url('artikel') ?>" class="articles-cta-button">Baca Artikel Terbaru <i class="ri-arrow-right-s-line"></i></a>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 6: LAYANAN PENDUKUNG -->
<section class="support-services-section">
    <div class="support-services-container">
        <header class="section-header">
            <h2>Layanan Pendukung Lainnya</h2>
            <p>Selain layanan utama, kami juga menyediakan berbagai dukungan lain untuk kesejahteraan mental Anda.</p>
        </header>
        <div class="services-wrapper">
            <div class="service-card">
                <div class="card-icon"><i class="ri-plant-line"></i></div>
                <h3>Terapi Relaksasi & Mindfulness</h3>
                <p>Temukan panduan audio untuk relaksasi, meditasi, dan latihan mindfulness guna menenangkan pikiran serta mengurangi stres.</p>
                <a href="<?= site_url('audio-frequency') ?>" class="card-cta">Jelajahi Audio Terapi <i class="ri-arrow-right-s-line"></i></a>
            </div>
            <div class="service-card">
                <div class="card-icon"><i class="ri-message-2-line"></i></div>
                <h3>Diskusi Komunitas Suportif</h3>
                <p>Bergabunglah dengan forum komunitas kami untuk berbagi pengalaman dan mendapatkan dukungan dari sesama. (Daftar Dahulu)</p>
                <a href="#" class="card-cta disabled">Gabung Komunitas <i class="ri-arrow-right-s-line"></i></a>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
