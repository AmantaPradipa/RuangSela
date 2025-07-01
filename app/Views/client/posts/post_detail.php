<?= $this->extend('layouts/client_layout') ?>

<?= $this->section('title') ?>
Detail Postingan
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/article-detail.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="page-container">
    <header class="page-header">
        <h1>Detail Postingan</h1>
        <div class="breadcrumbs">
            <a href="<?= site_url('client/komunitas') ?>">Komunitas</a> / Postingan
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

    <section class="card post-detail-card">
        <div class="post-header">
            <img src="<?= asset_url($post['user_profile_picture'], 'assets/images/default_avatar.png') ?>" alt="Avatar" class="post-avatar">
            <div class="post-meta">
                <span class="post-author"><?= esc($post['user_name']) ?></span>
                <span class="post-date"><?= date('d M Y', strtotime($post['created_at'])) ?></span>
            </div>
        </div>
        <h3 class="post-title"><?= esc($post['title']) ?></h3>
        <p class="post-content"><?= esc($post['content']) ?></p>
        <?php if (!empty($post['post_image'])) : ?>
            <img src="<?= asset_url($post['post_image']) ?>" alt="Post Image" class="post-image">
        <?php endif; ?>
        <div class="post-actions">
            <span class="action-item"><i class="ri-chat-3-line"></i> <?= esc($post['comment_count']) ?> Komentar</span>
            <span class="action-item"><i class="ri-thumb-up-line"></i> <?= esc($post['like_count']) ?> Suka</span>
        </div>
    </section>

    <section class="card comments-section">
        <div class="section-header">
            <h2>Komentar</h2>
        </div>
        <form action="<?= site_url('client/komunitas/comment/' . $post['id']) ?>" method="post" class="comment-form">
            <?= csrf_field() ?>
            <textarea name="comment" placeholder="Tambahkan komentar Anda..." rows="3" class="form-control"></textarea>
            <button type="submit" class="btn btn-primary">Kirim Komentar</button>
        </form>

        <div class="comments-list">
            <?php if (!empty($comments)) : ?>
                <?php foreach ($comments as $comment) : ?>
                    <div class="comment-item">
                        <div class="comment-header">
                            <img src="<?= asset_url($comment['user_profile_picture'], 'assets/images/avatars/default-avatar.png') ?>" alt="Avatar" class="comment-avatar">
                            <div class="comment-meta">
                                <span class="comment-author"><?= esc($comment['user_name']) ?></span>
                                <span class="comment-date"><?= date('d M Y', strtotime($comment['created_at'])) ?></span>
                            </div>
                        </div>
                        <p class="comment-content"><?= esc($comment['comment']) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Belum ada komentar untuk postingan ini.</p>
            <?php endif; ?>
        </div>
    </section>
</div>

<?= $this->endSection() ?>