<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>
Pengaturan Akun Admin
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/profile.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>
<div class="page-container">
    <header class="page-header">
        <h1>Pengaturan Akun Admin</h1>
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

    <header class="profile-header">
        <div class="profile-pic-wrapper">
            <img src="<?= asset_url($user['profile_picture'], 'assets/images/avatars/default-avatar.png') ?>" alt="Foto Profil <?= esc($user['first_name']) ?>" class="profile-pic">
            <div class="camera-icon">
                <i class="ri-camera-line"></i>
            </div>
        </div>
        <p class="upload-caption">Ukuran maksimal file: 1MB (Format: JPG, PNG)</p>
    </header>

    <!-- Form Sections -->
    <form action="<?= site_url('admin/profile/update') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="file" id="profile-pic-input" name="profile_picture" style="display: none;" accept="image/jpeg, image/png">
        <!-- Personal Information Card -->
        <section class="card">
            <h2>Informasi Pribadi</h2>
            <div class="form-grid">
                <div class="form-group"><label for="first_name">Nama Depan</label><input type="text" id="first_name" name="first_name" class="form-control" value="<?= esc($user['first_name']) ?>"></div>
                <div class="form-group"><label for="last_name">Nama Belakang</label><input type="text" id="last_name" name="last_name" class="form-control" value="<?= esc($user['last_name']) ?>"></div>
                <div class="form-group"><label for="username">Nama Pengguna</label><input type="text" id="username" name="username" class="form-control" value="<?= esc($user['username']) ?>"></div>
                <div class="form-group"><label for="email">Email</label><input type="email" id="email" name="email" class="form-control" value="<?= esc($user['email']) ?>"></div>
            </div>
        </section>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <button type="button" class="btn btn-secondary">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </form>

    <p class="footer-note text-muted">Terakhir diperbarui: <?= date('d F Y, H:i', strtotime($user['updated_at'])) ?></p>
</div>

<?= $this->section('pageScripts') ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const profilePicInput = document.getElementById('profile-pic-input');
        const profilePic = document.querySelector('.profile-pic');
        const cameraIcon = document.querySelector('.camera-icon');

        cameraIcon.addEventListener('click', function() {
            profilePicInput.click();
        });

        profilePicInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    profilePic.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>
<?= $this->endSection() ?>