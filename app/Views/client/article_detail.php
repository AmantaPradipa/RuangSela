<?= $this->extend('layouts/client_layout') ?>

<?= $this->section('title') ?>
Detail Artikel
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/article-detail.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<main class="article-page-content">
    <div class="article-container">
        <article class="article-content">
            <header class="article-header">
                <h1><?= esc($article['title']) ?></h1>
                <div class="article-meta">
                    <div class="author-info">
                        <i class="ri-user-line"></i>
                        <span><?= esc($article['author_name']) ?></span>
                    </div>
                    <div class="publish-date">
                        <i class="ri-calendar-line"></i>
                        <span>Diterbitkan pada <?= date('d F Y', strtotime($article['created_at'])) ?></span>
                    </div>
                </div>
            </header>

            <?php if (!empty($article['featured_image'])): ?>
                <figure class="featured-image">
                    <img src="<?= asset_url($article['featured_image'], 'assets/images/default_article.png') ?>" alt="<?= esc($article['title']) ?>">
                </figure>
            <?php endif; ?>

            <section class="article-body">
                <?= $article['content'] ?>
            </section>
        </article>

        <aside class="sidebar">
            <div class="sidebar-widget">
                <h3>Artikel Terkait</h3>
                <div class="related-articles">
                    <p>Fitur artikel terkait akan segera hadir.</p>
                </div>
            </div>
        </aside>
    </div>
</main>

<?= $this->endSection() ?>