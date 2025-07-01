<?= $this->extend('layouts/therapist_layout') ?>

<?= $this->section('title') ?>
Buat Postingan Komunitas
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/create_article.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="editor-container">
    <!-- Header -->
    <header class="editor-header">
        <span class="save-status">Draft Tersimpan Otomatis</span>
        <button type="submit" form="post-form" class="btn-submit">Publikasikan</button>
    </header>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="editor-card">
        <form id="post-form" action="<?= site_url('therapist/komunitas/save') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <input type="text" name="title" class="title-input" placeholder="Judul Postingan Anda" value="<?= old('title') ?>">

            <div class="form-group">
                <label for="content" class="field-label">Isi Postingan</label>
                <textarea name="content" id="content" class="main-textarea" placeholder="Tuliskan isi postingan Anda di sini..."><?= old('content') ?></textarea>
            </div>

            <div class="form-group">
                <label for="post_image" class="field-label">Gambar (Opsional)</label>
                <input type="file" name="post_image" id="post_image" class="input-field">
            </div>

            <div class="tags-section">
                <label class="field-label">Tags (Pisahkan dengan koma)</label>
                <input type="text" name="tags" class="input-field" placeholder="Contoh: studi kasus, etika, terapi kognitif">
            </div>

            <footer class="editor-footer">
                <div class="toolbar">
                    <div class="toolbar-group">
                        <button type="button" class="btn-icon" title="Bold"><i class="ri-bold"></i></button>
                        <button type="button" class="btn-icon" title="Italic"><i class="ri-italic"></i></button>
                        <button type="button" class="btn-icon" title="Underline"><i class="ri-underline"></i></button>
                    </div>
                    <div class="separator"></div>
                    <div class="toolbar-group">
                        <button type="button" class="btn-icon" title="Link"><i class="ri-link"></i></button>
                        <button type="button" class="btn-icon" title="Image"><i class="ri-image-line"></i></button>
                    </div>
                </div>
                <button type="button" class="btn-icon" title="Hapus Draft"><i class="ri-delete-bin-line"></i></button>
            </footer>
        </form>
    </div>
</div>

<?= $this->endSection() ?>