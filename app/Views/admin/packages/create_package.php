<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>
Tambah Paket Baru
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/package_management.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/package_management.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="page-container">

    <header class="page-header">
        <h1>Tambah Paket Baru</h1>
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
        <form action="<?= site_url('admin/packages/save') ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-grid">
                <div class="form-group">
                    <label for="name">Nama Paket</label>
                    <input type="text" id="name" name="name" class="form-control" value="<?= old('name') ?>" required>
                </div>
                <div class="form-group">
                    <label for="price">Harga</label>
                    <input type="number" id="price" name="price" class="form-control" value="<?= old('price') ?>" required>
                </div>
                <div class="form-group">
                    <label for="sessions_count">Jumlah Sesi</label>
                    <input type="number" id="sessions_count" name="sessions_count" class="form-control" value="<?= old('sessions_count') ?>" required>
                </div>
                <div class="form-group">
                    <label for="is_active">Status Aktif</label>
                    <select id="is_active" name="is_active" class="form-control" required>
                        <option value="1" <?= old('is_active') == '1' ? 'selected' : '' ?>>Aktif</option>
                        <option value="0" <?= old('is_active') == '0' ? 'selected' : '' ?>>Nonaktif</option>
                    </select>
                </div>
                <div class="form-group full-width">
                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description" class="form-control" rows="3"><?= old('description') ?></textarea>
                </div>
                <div class="form-group full-width">
                    <label for="features">Fitur (Pisahkan dengan koma)</label>
                    <textarea id="features" name="features" class="form-control" rows="3"><?= old('features') ?></textarea>
                </div>
            </div>
            <div class="form-actions">
                <a href="<?= site_url('admin/packages') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Paket</button>
            </div>
        </form>
    </section>

</div>

<?= $this->endSection() ?>
