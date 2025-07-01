<?= $this->extend('layouts/therapist_layout') ?>

<?= $this->section('title') ?>
Manajemen Artikel
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/articles_admin.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="page-container">
    <header class="page-header">
        <h1>Manajemen Artikel</h1>
        <div class="filter-controls">
            <div class="search-bar">
                <i class="ri-search-line"></i>
                <input type="text" id="search-articles" placeholder="Cari artikel, topik, atau penulis...">
            </div>
            <div class="filter-tags">
                <a href="#" class="filter-tag active" data-status="all">Semua</a>
                <a href="#" class="filter-tag" data-status="published">Dipublikasi</a>
                <a href="#" class="filter-tag" data-status="draft">Draft</a>
            </div>
            <a href="<?= site_url('therapist/artikel/create') ?>" class="write-article-btn">
                <i class="ri-add-line"></i>
                <span>Tulis Artikel</span>
            </a>
        </div>
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

    <section class="article-grid" id="article-grid">
        <?php if (!empty($articles)) : ?>
            <?php foreach ($articles as $article) : ?>
                <article class="article-card" data-status="<?= $article['is_published'] ? 'published' : 'draft' ?>" data-title="<?= esc($article['title']) ?>" data-excerpt="<?= esc($article['excerpt']) ?>">
                    <div class="card-image-wrapper">
                        <img src="<?= asset_url($article['featured_image'], 'assets/images/default_article.png') ?>" alt="<?= esc($article['title']) ?>">
                    </div>
                    <div class="card-content">
                        <p class="card-category"><?= esc($article['category'] ?? 'Umum') ?></p>
                        <h2 class="card-title"><a href="<?= site_url('artikel/detail/' . $article['id']) ?>"><?= esc($article['title']) ?></a></h2>
                        <p class="card-excerpt"><?= esc($article['excerpt']) ?></p>
                        <div class="card-meta">
                            <span class="meta-item"><i class="ri-calendar-line"></i> <?= date('d M Y', strtotime($article['created_at'])) ?></span>
                            <span class="meta-item"><i class="ri-user-line"></i> <?= esc($user['first_name'] . ' ' . $user['last_name']) ?></span>
                        </div>
                        <div class="card-actions">
                            <a href="<?= site_url('therapist/artikel/edit/' . $article['id']) ?>" class="btn btn-sm btn-primary">Edit</a>
                            <form action="<?= site_url('therapist/artikel/delete/' . $article['id']) ?>" method="post" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php else : ?>
            <p>Anda belum menulis artikel apapun.</p>
        <?php endif; ?>
    </section>

    <footer class="pagination-controls">
        <div class="pagination">
            <a href="#" class="arrow">
                <i class="ri-arrow-left-s-line"></i>
            </a>
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#" class="arrow">
                <i class="ri-arrow-right-s-line"></i>
            </a>
        </div>
        <a href="#" class="load-more-btn">Muat Lebih Banyak</a>
    </footer>
</div>

<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script src="<?= base_url('assets/js/pages/therapist_articles.js') ?>"></script>
<?= $this->endSection() ?>
