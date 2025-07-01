<?= $this->extend('layouts/therapist_layout') ?>

<?= $this->section('title') ?>
Buat Artikel Baru
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/create_article.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="editor-container">
    <!-- Header -->
    <header class="editor-header">
        <span class="save-status">Draft Tersimpan Otomatis</span>
        <button type="submit" form="article-form" class="btn-submit">Publikasikan</button>
    </header>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Editor Card -->
    <div class="editor-card">
        <form id="article-form" action="<?= site_url('therapist/artikel/save') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <input type="text" name="title" class="title-input" placeholder="Judul Artikel Anda" value="<?= old('title') ?>">

            <div class="form-group">
                <label for="excerpt" class="field-label">Ringkasan Artikel (Opsional)</label>
                <textarea name="excerpt" id="excerpt" class="textarea-field" placeholder="Ringkasan singkat artikel Anda..."><?= old('excerpt') ?></textarea>
            </div>

            <div class="form-group">
                <label for="featured_image" class="field-label">Gambar Unggulan (Opsional)</label>
                <input type="file" name="featured_image" id="featured_image" class="input-field">
            </div>

            <div class="form-group">
                <label for="content" class="field-label">Konten Artikel</label>
                <textarea name="content" id="content" class="main-textarea" placeholder="Tuliskan isi artikel Anda di sini..."><?= old('content') ?></textarea>
            </div>

            <div class="form-group">
                <label for="is_published" class="field-label">Status Publikasi</label>
                <select name="is_published" id="is_published" class="input-field">
                    <option value="0" <?= old('is_published') == '0' ? 'selected' : '' ?>>Draft</option>
                    <option value="1" <?= old('is_published') == '1' ? 'selected' : '' ?>>Publikasikan</option>
                </select>
            </div>

            <div class="tags-section">
                <label class="field-label">Tags (Pisahkan dengan koma)</label>
                <input type="text" name="tags" class="input-field" placeholder="Contoh: kecemasan, stres, mindfulness">
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
