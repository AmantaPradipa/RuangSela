<?= $this->extend('layouts/visitor_layout') ?>

<?= $this->section('title') ?>
Paket Konsultasi - RuangSela
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/packages.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- BAGIAN 1: HEADER UTAMA -->
<section class="packages-hero-section">
    <div class="packages-hero-container">
        <h1 class="section-title">
            Paket Konsultasi <span class="highlight-text">Online</span>
        </h1>
        <p class="section-description">
            Pilih paket konsultasi yang paling sesuai dengan kebutuhan dan preferensi Anda untuk memulai perjalanan menuju kesehatan mental yang lebih baik.
        </p>
    </div>
</section>

<!-- BAGIAN 2: PILIHAN PAKET -->
<section class="pricing-section">
    <div class="pricing-container">
        <header class="pricing-header">
            <h2 class="pricing-title">Pilihan Paket Fleksibel Kami</h2>
            <p class="pricing-subtitle">Kami menyediakan berbagai pilihan paket untuk memastikan Anda mendapatkan dukungan yang tepat dengan cara yang paling nyaman.</p>
        </header>
        <div class="pricing-cards-container">
            <!-- Paket Pengantar -->
            <div class="pricing-card">
                <h3 class="package-name">Paket Pengantar</h3>
                <p class="package-price">Rp 199.999</p>
                <p class="package-duration">Durasi: 3 Hari Akses</p>
                <ul class="features-list">
                    <li><i class="ri-checkbox-circle-line"></i><span>1 Sesi Konsultasi Online (60 Menit)</span></li>
                    <li><i class="ri-checkbox-circle-line"></i><span>Akses Penuh Artikel Edukasi</span></li>
                    <li><i class="ri-checkbox-circle-line"></i><span>Akses Penuh Diskusi Komunitas</span></li>
                    <li><i class="ri-checkbox-circle-line"></i><span>Akses Penuh Relaksasi Pure Tone</span></li>
                    <li><i class="ri-checkbox-circle-line"></i><span>Akses 1 Jenis Psikotes Pilihan</span></li>
                </ul>
                <a href="<?= site_url('client/packages/purchase/1') ?>" class="cta-button">Pilih Paket Ini</a>
            </div>
            <!-- Paket Pendampingan (Popular) -->
            <div class="pricing-card popular">
                <div class="popular-banner">Popular</div>
                <h3 class="package-name">Paket Pendampingan</h3>
                <p class="package-price">Rp 499.999</p>
                <p class="package-duration">Durasi: 7 Hari Akses</p>
                <ul class="features-list">
                    <li><i class="ri-checkbox-circle-line"></i><span>2 Sesi Konsultasi Online (masing-masing 60 Menit)</span></li>
                    <li><i class="ri-checkbox-circle-line"></i><span>Akses Penuh Artikel Edukasi</span></li>
                    <li><i class="ri-checkbox-circle-line"></i><span>Akses Penuh Diskusi Komunitas</span></li>
                    <li><i class="ri-checkbox-circle-line"></i><span>Akses Penuh Relaksasi Pure Tone</span></li>
                    <li><i class="ri-checkbox-circle-line"></i><span>Akses 2 Jenis Psikotes Pilihan</span></li>
                    <li><i class="ri-checkbox-circle-line"></i><span>Laporan Perkembangan Singkat</span></li>
                    <li><i class="ri-checkbox-circle-line"></i><span>Prioritas Respon Pop-up Chat Admin</span></li>
                </ul>
                <a href="<?= site_url('client/packages/purchase/2') ?>" class="cta-button">Pilih Paket Ini</a>
            </div>
            <!-- Paket Transformasi -->
            <div class="pricing-card">
                <h3 class="package-name">Paket Transformasi</h3>
                <p class="package-price">Rp 749.999</p>
                <p class="package-duration">Durasi: 30 Hari Akses</p>
                <ul class="features-list">
                    <li><i class="ri-checkbox-circle-line"></i><span>4 Sesi Konsultasi Online (masing-masing 60 Menit)</span></li>
                    <li><i class="ri-checkbox-circle-line"></i><span>Akses Penuh Artikel Edukasi Premium</span></li>
                    <li><i class="ri-checkbox-circle-line"></i><span>Akses Penuh Diskusi Komunitas Eksklusif</span></li>
                    <li><i class="ri-checkbox-circle-line"></i><span>Akses Penuh Relaksasi Pure Tone Frequency</span></li>
                    <li><i class="ri-checkbox-circle-line"></i><span>Akses Semua Jenis Psikotes</span></li>
                    <li><i class="ri-checkbox-circle-line"></i><span>Laporan Perkembangan Lengkap</span></li>
                    <li><i class="ri-checkbox-circle-line"></i><span>Dukungan Penuh Pop-up Chat Admin 24/7</span></li>
                </ul>
                <a href="<?= site_url('client/packages/purchase/3') ?>" class="cta-button">Pilih Paket Ini</a>
            </div>
        </div>
    </div>
</section>

<!-- BAGIAN 3: CARA MEMULAI -->
<section class="how-it-works-section">
    <div class="how-it-works-container">
        <div class="section-header">
            <h2 class="section-title">Bagaimana Cara Memulai Konsultasi?</h2>
            <div class="title-divider"></div>
            <p class="section-subtitle">Memulai konsultasi di RuangSela sangat mudah. Ikuti langkah-langkah sederhana di bawah ini untuk memulai.</p>
        </div>
        <div class="steps-container">
            <div class="step-card">
                <div class="step-icon"><i class="ri-user-add-line"></i></div>
                <h3 class="step-title">1. Daftar & Pilih Paket</h3>
                <p class="step-description">Buat akun RuangSela Anda dan pilih paket konsultasi yang paling sesuai dengan kebutuhan Anda.</p>
            </div>
            <div class="step-card">
                <div class="step-icon"><i class="ri-user-search-line"></i></div>
                <h3 class="step-title">2. Pilih Terapis Anda</h3>
                <p class="step-description">Jelajahi profil terapis kami yang berpengalaman dan pilih yang paling cocok dengan preferensi Anda.</p>
            </div>
            <div class="step-card">
                <div class="step-icon"><i class="ri-calendar-schedule-line"></i></div>
                <h3 class="step-title">3. Jadwalkan Sesi</h3>
                <p class="step-description">Atur jadwal sesi konsultasi pertama Anda melalui platform kami pada waktu yang paling nyaman bagi Anda.</p>
            </div>
        </div>
    </div>
</section>

<!-- BAGIAN 4: TESTIMONI -->
<section class="testimonials-section">
    <div class="testimonials-container">
        <div class="section-header">
            <h2 class="section-title">Pengalaman Konsultasi di RuangSela</h2>
            <p class="section-subtitle">Simak apa kata mereka yang telah merasakan manfaat dari layanan konsultasi kami.</p>
        </div>
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="card-header">
                    <div class="avatar"><i class="ri-user-3-line"></i></div>
                    <div class="user-info">
                        <h3 class="user-name">Ahmad Fauzi</h3>
                        <div class="star-rating">
                            <i class="ri-star-s-fill"></i><i class="ri-star-s-fill"></i><i class="ri-star-s-fill"></i><i class="ri-star-s-fill"></i><i class="ri-star-s-fill"></i>
                        </div>
                    </div>
                </div>
                <p class="testimonial-text">"Sesi konsultasi video sangat membantu saya mengatasi kecemasan. Terapisnya sabar dan memberikan insight yang berharga. Terima kasih RuangSela!"</p>
            </div>
            <div class="testimonial-card">
                <div class="card-header">
                    <div class="avatar"><i class="ri-user-3-line"></i></div>
                    <div class="user-info">
                        <h3 class="user-name">Lina Marlina</h3>
                        <div class="star-rating">
                            <i class="ri-star-s-fill"></i><i class="ri-star-s-fill"></i><i class="ri-star-s-fill"></i><i class="ri-star-s-fill"></i><i class="ri-star-s-fill"></i>
                        </div>
                    </div>
                </div>
                <p class="testimonial-text">"Layanan konsultasi RuangSela sangat profesional. Saya merasa nyaman berbagi masalah dan mendapatkan solusi yang praktis. Sangat direkomendasikan!"</p>
            </div>
            <div class="testimonial-card">
                <div class="card-header">
                    <div class="avatar"><i class="ri-user-3-line"></i></div>
                    <div class="user-info">
                        <h3 class="user-name">Putri Ayu</h3>
                        <div class="star-rating">
                            <i class="ri-star-s-fill"></i><i class="ri-star-s-fill"></i><i class="ri-star-s-fill"></i><i class="ri-star-s-fill"></i><i class="ri-star-s-fill"></i>
                        </div>
                    </div>
                </div>
                <p class="testimonial-text">"RuangSela membantu saya menemukan keseimbangan mental. Konselor yang ramah dan penuh pengertian membuat proses konsultasi menjadi menyenangkan."</p>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
