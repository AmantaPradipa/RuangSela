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
            <?php if (!empty($packages)) : ?>
                <?php foreach ($packages as $package) : ?>
                    <div class="pricing-card <?= (str_contains($package['name'], 'Pendampingan')) ? 'popular' : '' ?>">
                        <?php if (str_contains($package['name'], 'Pendampingan')) : ?>
                            <div class="popular-banner">Popular</div>
                        <?php endif; ?>
                        <h3 class="package-name"><?= esc($package['name']) ?></h3>
                        <p class="package-price">Rp <?= number_format($package['price'], 0, ',', '.') ?></p>
                        <p class="package-duration"><?= esc($package['description']) ?></p>
                        <ul class="features-list">
                            <?php if (!empty($package['features']) && is_array($package['features'])) : ?>
                                <?php foreach ($package['features'] as $feature) : ?>
                                    <li><i class="ri-checkbox-circle-line"></i><span><?= esc($feature) ?></span></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                        <a href="<?= site_url('client/packages/purchase/' . $package['id']) ?>" class="cta-button">Pilih Paket Ini</a>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="no-packages-card" style="text-align: center; grid-column: 1 / -1; padding: 2rem;">
                    <h3>Belum Ada Paket yang Tersedia</h3>
                    <p>Saat ini belum ada paket konsultasi yang tersedia. Silakan kembali lagi nanti.</p>
                </div>
            <?php endif; ?>
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
            <h2 class="section-title">Ulasan Pengguna Tentang RuangSela</h2>
            <p class="section-subtitle">Simak apa kata mereka yang telah memberikan masukan tentang pengalaman mereka menggunakan platform kami.</p>
        </div>
        <div class="testimonials-grid">
            <?php if (!empty($testimonials) && is_array($testimonials)) : ?>
                <?php foreach ($testimonials as $testimonial) : ?>
                    <div class="testimonial-card">
                        <div class="card-header">
                            <div class="avatar">
                                <?php if (!empty($testimonial['profile_picture'])) : ?>
                                    <img src="<?= asset_url($testimonial['profile_picture'], 'assets/images/avatars/default-avatar.png') ?>" alt="Avatar Pengguna">
                                <?php else : ?>
                                    <?= esc($testimonial['user_initials']) ?>
                                <?php endif; ?>
                            </div>
                            <div class="user-info">
                                <h3 class="user-name"><?= esc($testimonial['user_name']) ?></h3>
                                <div class="star-rating">
                                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                                        <i class="ri-star-s-fill<?= $i > $testimonial['rating'] ? ' star-inactive' : '' ?>"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                        <p class="testimonial-text">"<?= esc($testimonial['comment']) ?>"</p>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="no-testimonials" style="grid-column: 1 / -1; text-align: center; padding: 2rem 0; color: #666;">
                    <p>Belum ada testimoni untuk saat ini.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
