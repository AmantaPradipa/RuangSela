<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>
Tambah Psikotes Baru
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/psychotest_admin.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="page-container">

    <header class="page-header">
        <h1>Tambah Psikotes Baru</h1>
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
        <form action="<?= site_url('admin/psychotests/save') ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-grid">
                <div class="form-group full-width">
                    <label for="title">Judul Psikotes</label>
                    <input type="text" id="title" name="title" class="form-control" value="<?= old('title') ?>" required>
                </div>
                <div class="form-group full-width">
                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description" class="form-control" rows="5"><?= old('description') ?></textarea>
                </div>
                <div class="form-group">
                    <label for="is_active">Status Aktif</label>
                    <select id="is_active" name="is_active" class="form-control" required>
                        <option value="1" <?= old('is_active') == '1' ? 'selected' : '' ?>>Aktif</option>
                        <option value="0" <?= old('is_active') == '0' ? 'selected' : '' ?>>Nonaktif</option>
                    </select>
                </div>
            </div>
            <div class="form-actions">
                <a href="<?= site_url('admin/psychotests') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Psikotes</button>
            </div>
        </form>
    </section>

</div>

<?= $this->endSection() ?>
