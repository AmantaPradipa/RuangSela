<?= $this->extend('layouts/visitor_layout') ?>

<?= $this->section('title') ?>
Daftar Terapis Profesional - RuangSela
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/therapists.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- BAGIAN 1: HERO -->
<section class="therapist-hero-section">
    <div class="therapist-hero-container">
        <h2>
            Temukan Terapis <span class="highlight-text">Profesional Kami</span>
        </h2>
        <p>
            Jelajahi daftar terapis berlisensi dan berpengalaman kami. Pilih yang paling sesuai dengan kebutuhan dan preferensi Anda.
        </p>
    </div>
</section>

<!-- BAGIAN 2: DAFTAR TERAPIS & FILTER -->
<section class="therapist-list-section">
    <div class="therapist-list-container">
        <!-- Filter Box -->
        <div class="filter-box">
            <form class="filter-form">
                <div class="form-group">
                    <label for="search-name">Cari Nama Terapis</label>
                    <div class="input-wrapper">
                        <input type="text" id="search-name" placeholder="Masukkan nama terapis...">
                        <i class="ri-search-line icon"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label for="specialization">Spesialisasi</label>
                    <div class="select-wrapper">
                        <select id="specialization">
                            <option selected>Semua Spesialisasi</option>
                            <option>Depresi</option>
                            <option>Kecemasan</option>
                            <option>Hubungan</option>
                        </select>
                        <i class="ri-arrow-down-s-line icon"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label for="rating">Rating Minimal</label>
                    <div class="select-wrapper">
                        <select id="rating">
                            <option selected>Semua Rating</option>
                            <option>★★★★★ (5)</option>
                            <option>★★★★☆ (4)</option>
                            <option>★★★☆☆ (3)</option>
                            <option>★★☆☆☆ (2)</option>
                            <option>★☆☆☆☆ (1)</option>
                        </select>
                        <i class="ri-arrow-down-s-line icon"></i>
                    </div>
                </div>
                <div class="form-group button-group">
                    <button type="submit" class="filter-button">Terapkan Filter</button>
                </div>
            </form>
        </div>

        <!-- Therapist Grid -->
        <div class="therapist-grid">
            <?php if (!empty($therapists)) : ?>
                <?php foreach ($therapists as $therapist) : ?>
                    <div class="therapist-card">
                        <div class="card-header">
                            <img src="<?= asset_url($therapist->profile_picture, 'assets/images/avatars/default-avatar.png') ?>" alt="Foto <?= esc($therapist->first_name) ?>" class="profile-pic">
                            <div class="therapist-info">
                                <h3><?= esc($therapist->first_name . ' ' . $therapist->last_name) ?></h3>
                                <p><?= esc($therapist->expertise) ?></p>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-tags">
                                <?php if (!empty($therapist->expertise)) : ?>
                                    <?php foreach (explode(',', $therapist->expertise) as $exp) : ?>
                                        <span><?= esc(trim($exp)) ?></span>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <div class="rating-info">
                                <i class="ri-star-s-fill"></i>
                                <span class="rating-text">N/A (0 sesi)</span> <!-- Rating and session count not available in model yet -->
                            </div>
                            <p class="experience-text">Pengalaman: <?= esc($therapist->experience_years) ?> Tahun</p>
                        </div>
                        <a href="<?= site_url('terapis/detail/' . $therapist->id) ?>" class="profile-button">Lihat Profil Lengkap</a>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Tidak ada terapis yang ditemukan.</p>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <?php if (isset($pager) && $pager->getPageCount() > 1) : ?>
            <?= $pager->links('therapists', 'therapists_pager') ?>
        <?php endif ?>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script src="<?= base_url('assets/js/pages/therapists.js') ?>"></script>
<?= $this->endSection() ?>
