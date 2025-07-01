<?= $this->extend('layouts/therapist_layout') ?>

<?= $this->section('title') ?>
Komunitas Terapis
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/articles_admin.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="page-container">
    <header class="page-header">
        <h1>Forum Komunitas Terapis</h1>
        <a href="<?= site_url('therapist/komunitas/create') ?>" class="btn btn-primary"><i class="ri-add-line"></i> Buat Postingan Baru</a>
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

    <div class="content-tabs">
        <nav>
            <a href="#" class="active" data-filter="all">Semua Postingan</a>
            <a href="#" data-filter="my-posts">Postingan Saya</a>
            <a href="#" data-filter="popular">Populer</a>
        </nav>
    </div>

    <section class="card">
        <div class="section-header">
            <h2>Postingan Terbaru</h2>
        </div>
        <div class="filters">
            <div class="filter-item">
                <i class="ri-search-line"></i>
                <input type="text" class="form-control" id="search-posts" placeholder="Cari postingan...">
            </div>
            <select class="form-control" id="filter-topic">
                <option value="all">Semua Topik</option>
                <option value="Studi Kasus">Studi Kasus</option>
                <option value="Metode Terapi">Metode Terapi</option>
                <option value="Etika Profesional">Etika Profesional</option>
            </select>
            <button class="btn btn-filter" id="apply-filter"><i class="ri-filter-3-line"></i> Filter</button>
        </div>
        <div class="post-feed" id="post-feed">
            <?php if (!empty($posts)) : ?>
                <?php foreach ($posts as $post) : ?>
                    <div class="post-card" data-topic="<?= esc($post['topic']) ?>" data-user-id="<?= esc($post['user_id']) ?>">
                        <div class="post-header">
                            <img src="<?= asset_url($post['user_profile_picture'], 'assets/images/avatars/default-avatar.png') ?>" alt="Avatar" class="post-avatar">
                            <div class="post-meta">
                                <span class="post-author"><?= esc($post['user_name']) ?></span>
                                <span class="post-date"><?= date('d M Y', strtotime($post['created_at'])) ?></span>
                            </div>
                        </div>
                        <h3 class="post-title"><a href="<?= site_url('therapist/komunitas/view/' . $post['id']) ?>"><?= esc($post['title']) ?></a></h3>
                        <p class="post-content"><?= esc(character_limiter($post['content'], 150)) ?></p>
                        <div class="post-actions">
                            <span class="action-item"><i class="ri-chat-3-line"></i> <?= esc($post['comment_count']) ?> Komentar</span>
                            <span class="action-item"><i class="ri-thumb-up-line"></i> <?= esc($post['like_count']) ?> Suka</span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Tidak ada postingan yang ditemukan.</p>
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
<script src="<?= base_url('assets/js/pages/therapist_community.js') ?>"></script>
<?= $this->endSection() ?>