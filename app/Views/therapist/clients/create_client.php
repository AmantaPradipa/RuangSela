<?= $this->extend('layouts/therapist_layout') ?>

<?= $this->section('title') ?>
Tambah Klien Baru
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/user_management.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="page-container">

    <header class="page-header">
        <h1>Tambah Klien Baru</h1>
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
        <form action="<?= site_url('therapist/klien/save') ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-grid">
                <div class="form-group">
                    <label for="first_name">Nama Depan</label>
                    <input type="text" id="first_name" name="first_name" class="form-control" value="<?= old('first_name') ?>" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Nama Belakang</label>
                    <input type="text" id="last_name" name="last_name" class="form-control" value="<?= old('last_name') ?>">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control" value="<?= old('username') ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="<?= old('email') ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password (Default)</label>
                    <input type="password" id="password" name="password" class="form-control" value="<?= old('password', 'password123') ?>" required>
                    <small class="form-text text-muted">Klien dapat mengubah ini setelah login.</small>
                </div>
            </div>
            <div class="form-actions">
                <a href="<?= site_url('therapist/klien') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Klien Baru</button>
            </div>
        </form>
    </section>

</div>

<?= $this->endSection() ?>