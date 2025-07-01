<?= $this->extend('layouts/client_layout') ?>

<?= $this->section('title') ?>
Artikel
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/articles.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<section class="article-header-section">
    <div class="article-header-container">
        <h1 class="section-title">
            Artikel <span class="highlight-text">Kesehatan Mental</span>
        </h1>
        <p class="section-subtitle">
            Temukan wawasan, tips, dan informasi terbaru dari para ahli untuk mendukung perjalanan kesehatan mental Anda.
        </p>
    </div>
</section>

<section class="articles-section">
    <div class="articles-container">
        <header class="articles-header">
            <nav class="filter-nav">
                <button class="filter-btn active" data-category="all">Semua</button>
                <button class="filter-btn" data-category="stres & kecemasan">Stres & Kecemasan</button>
                <button class="filter-btn" data-category="hubungan">Hubungan</button>
                <button class="filter-btn" data-category="pengembangan diri">Pengembangan Diri</button>
                <button class="filter-btn" data-category="mindfulness">Mindfulness</button>
            </nav>
            <div class="search-bar">
                <i class="ri-search-line search-icon"></i>
                <input type="text" class="search-input" id="search-articles" placeholder="Cari artikel...">
            </div>
        </header>

        <main class="articles-grid" id="articles-grid">
            <?php if (!empty($articles)): ?>
                <?php foreach ($articles as $article): ?>
                    <article class="article-card" data-category="<?= esc($article['category'] ?? 'Umum') ?>" data-title="<?= esc($article['title']) ?>" data-excerpt="<?= esc($article['excerpt']) ?>">
                        <div class="card-image-wrapper">
                            <img src="<?= asset_url($article['featured_image'], 'assets/images/default_article.png') ?>" alt="<?= esc($article['title']) ?>">
                        </div>
                        <div class="card-content">
                            <p class="card-category"><?= esc($article['category'] ?? 'Umum') ?></p>
                            <h2 class="card-title"><a href="<?= site_url('client/artikel/detail/' . $article['id']) ?>"><?= esc($article['title']) ?></a></h2>
                            <p class="card-excerpt"><?= esc($article['excerpt']) ?></p>
                            <div class="card-meta">
                                <span class="meta-item"><i class="ri-calendar-line"></i> <?= date('d M Y', strtotime($article['created_at'])) ?></span>
                                <span class="meta-item"><i class="ri-user-line"></i> <?= esc($article['author_name'] ?? 'Admin') ?></span>
                            </div>
                            <a href="<?= site_url('client/artikel/detail/' . $article['id']) ?>" class="read-more-link">Baca Selengkapnya <i class="ri-arrow-right-line"></i></a>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Tidak ada artikel yang ditemukan.</p>
            <?php endif; ?>
        </main>
        
        <nav class="pagination">
            <?= $pager->links('articles', 'articles_pager') ?>
        </nav>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script src="<?= base_url('assets/js/pages/articles.js') ?>"></script>
<?= $this->endSection() ?>