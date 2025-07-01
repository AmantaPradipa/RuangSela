<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>
Edit FAQ
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/faq_admin.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="page-container">
    <header class="page-header">
        <h1>Edit FAQ</h1>
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

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <section class="card">
        <form action="<?= site_url('admin/faqs/update/' . $faq['id']) ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">
            <div class="form-grid">
                <div class="form-group full-width">
                    <label for="question">Pertanyaan</label>
                    <textarea id="question" name="question" class="form-control" rows="3" required><?= old('question', $faq['question']) ?></textarea>
                </div>
                <div class="form-group full-width">
                    <label for="answer">Jawaban</label>
                    <textarea id="answer" name="answer" class="form-control" rows="5" required><?= old('answer', $faq['answer']) ?></textarea>
                </div>
                <div class="form-group">
                    <label for="category">Kategori</label>
                    <input type="text" id="category" name="category" class="form-control" value="<?= old('category', $faq['category']) ?>" placeholder="Contoh: Umum, Konsultasi">
                </div>
                <div class="form-group">
                    <label for="is_active">Status Aktif</label>
                    <select id="is_active" name="is_active" class="form-control" required>
                        <option value="1" <?= old('is_active', $faq['is_active']) == '1' ? 'selected' : '' ?>>Aktif</option>
                        <option value="0" <?= old('is_active', $faq['is_active']) == '0' ? 'selected' : '' ?>>Nonaktif</option>
                    </select>
                </div>
            </div>
            <div class="form-actions">
                <a href="<?= site_url('admin/faqs') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </section>

</div>

<?= $this->endSection() ?>
