<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>
Tambah Pengguna Baru
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/user_management.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/user_management.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="page-container">

    <header class="page-header">
        <h1>Tambah Pengguna Baru</h1>
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
        <form action="<?= site_url('admin/users/save') ?>" method="post">
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
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" name="role" class="form-control" required>
                        <option value="client" <?= old('role') == 'client' ? 'selected' : '' ?>>Client</option>
                        <option value="therapist" <?= old('role') == 'therapist' ? 'selected' : '' ?>>Therapist</option>
                        <option value="admin" <?= old('role') == 'admin' ? 'selected' : '' ?>>Admin</option>
                    </select>
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
                <a href="<?= site_url('admin/users') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Pengguna</button>
            </div>
        </form>
    </section>

</div>

<?= $this->endSection() ?>
