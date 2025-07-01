<?= $this->extend('layouts/therapist_layout') ?>

<?= $this->section('title') ?>
Ulasan Klien
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/client_detail.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/community.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="page-container">
    <header class="page-header">
        <h1>Ulasan Klien Anda</h1>
    </header>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <section class="card">
        <div class="section-header">
            <h2>Daftar Ulasan</h2>
        </div>
        <div class="filters">
            <div class="filter-item">
                <i class="ri-search-line"></i>
                <input type="text" class="form-control" id="search-reviews" placeholder="Cari ulasan...">
            </div>
            <select class="form-control" id="filter-rating">
                <option value="all">Semua Rating</option>
                <option value="5">5 Bintang</option>
                <option value="4">4 Bintang</option>
                <option value="3">3 Bintang</option>
                <option value="2">2 Bintang</option>
                <option value="1">1 Bintang</option>
            </select>
            <button class="btn btn-filter" id="apply-filter"><i class="ri-filter-3-line"></i> Filter</button>
        </div>
        <div class="comments-list" id="reviews-list">
            <?php if (!empty($reviews)) : ?>
                <?php foreach ($reviews as $review) : ?>
                    <div class="comment-item" data-rating="<?= esc($review['rating']) ?>" data-user-name="<?= esc($review['user_name']) ?>" data-comment="<?= esc($review['comment']) ?>">
                        <div class="comment-header">
                            <img src="<?= asset_url($review['user_profile_picture'], 'assets/images/avatars/default-avatar.png') ?>" alt="Avatar" class="comment-avatar">
                            <div class="comment-meta">
                                <span class="comment-author"><?= esc($review['user_name']) ?></span>
                                <span class="comment-date"><?= date('d M Y', strtotime($review['created_at'])) ?></span>
                            </div>
                        </div>
                        <div class="star-rating">
                            <?php for ($i = 0; $i < $review['rating']; $i++): ?><i class="ri-star-fill"></i><?php endfor; ?>
                            <?php for ($i = $review['rating']; $i < 5; $i++): ?><i class="ri-star-line"></i><?php endfor; ?>
                        </div>
                        <p class="comment-content"><?= esc($review['comment']) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Belum ada ulasan yang ditemukan.</p>
            <?php endif; ?>
        </div>
        <div class="pagination">
            <a href="#"><i class="ri-arrow-left-s-line"></i></a>
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#"><i class="ri-arrow-right-s-line"></i></a>
        </div>
    </section>

</div>

<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script src="<?= base_url('assets/js/pages/therapist_reviews.js') ?>"></script>
<?= $this->endSection() ?>