<?= $this->extend('layouts/visitor_layout') ?>

<?= $this->section('title') ?>
Profil Terapis - <?= esc($therapist->first_name . ' ' . $therapist->last_name) ?> - RuangSela
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/therapist-detail.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="therapist-detail-container">
    <!-- BAGIAN 1: PROFILE HEADER -->
    <header class="profile-header">
        <div class="profile-banner"></div>
        <div class="profile-header-content">
            <div class="profile-avatar">
                <img src="<?= asset_url($therapist->profile_picture, 'assets/images/avatars/default-avatar.png') ?>" alt="Foto Profil <?= esc($therapist->first_name) ?>">
            </div>
            <div class="profile-info">
                <h1 class="therapist-name"><?= esc($therapist->first_name . ' ' . $therapist->last_name) ?></h1>
                <p class="therapist-specialty"><?= esc($therapist->expertise) ?></p>
                <div class="therapist-meta">
                    <span class="meta-item"><i class="ri-map-pin-line"></i> <?= esc($therapist->city) ?>, <?= esc($therapist->country) ?></span>
                    <span class="meta-item"><i class="ri-award-line"></i> Pengalaman <?= esc($therapist->experience_years) ?> Tahun</span>
                </div>
            </div>
            <div class="profile-actions">
                <a href="#schedule-section" class="btn btn-primary">Jadwalkan Konsultasi</a>
            </div>
        </div>
    </header>

    <!-- BAGIAN 2: KONTEN UTAMA (KIRI) & SIDEBAR (KANAN) -->
    <div class="profile-body">
        <!-- Kolom Kiri: Detail Info Terapis -->
        <main class="profile-main">
            <!-- TENTANG SAYA -->
            <section class="profile-section">
                <h2 class="section-title">Tentang Saya</h2>
                <p class="section-text">
                    <?= esc($therapist->bio) ?>
                </p>
            </section>

            <!-- KEAHLIAN -->
            <section class="profile-section">
                <h2 class="section-title">Keahlian</h2>
                <div class="tags-container">
                    <!-- Assuming expertise is a comma-separated string -->
                    <?php foreach (explode(',', $therapist->expertise) as $exp) : ?>
                        <span class="tag"><?= esc(trim($exp)) ?></span>
                    <?php endforeach; ?>
                </div>
            </section>

            <!-- PENDIDIKAN -->
            <section class="profile-section">
                <h2 class="section-title">Pendidikan & Lisensi</h2>
                <ul class="info-list">
                    <?php if (!empty($therapist->education)) : ?>
                        <?php foreach ($therapist->education as $edu) : ?>
                            <li><i class="ri-award-fill"></i> <?= esc($edu) ?></li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <li><i class="ri-file-shield-2-line"></i> Nomor SIPP: <?= esc($therapist->license_number) ?></li>
                </ul>
            </section>

            <!-- JADWAL TERSEDIA -->
            <section class="profile-section" id="schedule-section">
                <h2 class="section-title">Jadwal Tersedia</h2>
                <div class="schedule-grid">
                    <div class="day-card">
                        <div class="day-name">Senin</div>
                        <div class="time-slot">09:00 - 17:00</div>
                    </div>
                    <div class="day-card">
                        <div class="day-name">Selasa</div>
                        <div class="time-slot">09:00 - 17:00</div>
                    </div>
                    <div class="day-card day-off">
                        <div class="day-name">Rabu</div>
                        <div class="time-slot">Libur</div>
                    </div>
                    <div class="day-card">
                        <div class="day-name">Kamis</div>
                        <div class="time-slot">09:00 - 17:00</div>
                    </div>
                    <div class="day-card">
                        <div class="day-name">Jumat</div>
                        <div class="time-slot">09:00 - 15:00</div>
                    </div>
                </div>
                <p class="schedule-note">Jadwal di atas adalah ketersediaan umum. Silakan klik "Jadwalkan Konsultasi" untuk melihat slot waktu yang spesifik.</p>
            </section>

            <!-- ULASAN KLIEN -->
            <section class="profile-section">
                <h2 class="section-title">Ulasan Klien</h2>
                <div class="reviews-summary">
                    <div class="overall-rating">
                        <span class="rating-value">4.8</span>
                        <div class="rating-stars">
                            <i class="ri-star-s-fill"></i><i class="ri-star-s-fill"></i><i class="ri-star-s-fill"></i><i class="ri-star-s-fill"></i><i class="ri-star-half-s-line"></i>
                        </div>
                        <span class="total-reviews">dari 250 ulasan</span>
                    </div>
                </div>

                <div class="review-list">
                    <?php if (!empty($therapist->reviews)) : ?>
                        <?php foreach ($therapist->reviews as $review) : ?>
                            <div class="review-card">
                                <div class="review-header">
                                    <div class="reviewer-info">
                                        <span class="reviewer-name"><?= esc($review->first_name . ' ' . substr($review->last_name, 0, 1) . '.') ?></span>
                                        <span class="review-date"><?= date('d M Y', strtotime($review->created_at)) ?></span>
                                    </div>
                                    <div class="review-stars">
                                        <?php for ($i = 0; $i < $review->rating; $i++): ?><i class="ri-star-s-fill"></i><?php endfor; ?>
                                        <?php for ($i = $review->rating; $i < 5; $i++): ?><i class="ri-star-s-line"></i><?php endfor; ?>
                                    </div>
                                </div>
                                <p class="review-text">"<?= esc($review->comment) ?>"</p>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>Belum ada ulasan untuk terapis ini.</p>
                    <?php endif; ?>
                </div>
                <?php if (!empty($therapist->reviews)) : ?>
                    <a href="#" class="btn btn-secondary">Lihat semua ulasan</a>
                <?php endif; ?>
            </section>
        </main>

        <!-- Kolom Kanan: Sidebar Aksi -->
        <aside class="profile-sidebar">
            <div class="action-card">
                <h3>Jadwalkan Sesi Konsultasi</h3>
                <p>Pilih paket konsultasi dan temukan waktu yang paling sesuai untuk Anda memulai sesi dengan Dr. Anisa.</p>
                <div class="price-info">
                    Mulai dari <span>Rp 199.999</span> / sesi
                </div>
                <a href="<?= site_url('konsultasi') ?>" class="btn btn-primary btn-block">Lihat Paket & Jadwalkan</a>
            </div>
        </aside>
    </div>
</div>

<?= $this->endSection() ?>
