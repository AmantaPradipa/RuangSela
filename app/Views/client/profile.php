<?= $this->extend('layouts/client_layout') ?>

<?= $this->section('title') ?>
Pengaturan Akun
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/profile.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>
<div class="page-container">
    <header class="page-header">
        <h1>Pengaturan Akun</h1>
    </header>

    <!-- Navigation -->
    <nav class="account-nav">
        <a href="#" class="nav-item active">
            <i class="ri-user-line"></i>
            <span>Profil</span>
        </a>
        <a href="#" class="nav-item">
            <i class="ri-lock-line"></i>
            <span>Keamanan</span>
        </a>
        <a href="#" class="nav-item">
            <i class="ri-notification-3-line"></i>
            <span>Notifikasi</span>
        </a>
        <a href="#" class="nav-item">
            <i class="ri-shield-line"></i>
            <span>Privasi</span>
        </a>
        <a href="#" class="nav-item">
            <i class="ri-question-line"></i>
            <span>Bantuan</span>
        </a>
    </nav>

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
    <form action="<?= site_url('client/profil/update') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="file" id="profile-pic-input" name="profile_picture" style="display: none;" accept="image/jpeg, image/png">
        <!-- Personal Information Card -->
        <section class="form-card">
            <h2>Informasi Pribadi</h2>
            <div class="form-grid">
                <div class="form-group"><label for="first_name">Nama Depan</label><input type="text" id="first_name" name="first_name" class="form-control" value="<?= esc($user['first_name']) ?>"></div>
                <div class="form-group"><label for="last_name">Nama Belakang</label><input type="text" id="last_name" name="last_name" class="form-control" value="<?= esc($user['last_name']) ?>"></div>
                <div class="form-group"><label for="username">Nama Pengguna</label><input type="text" id="username" name="username" class="form-control" value="<?= esc($user['username']) ?>"></div>
                <div class="form-group"><label for="email">Email</label><input type="email" id="email" name="email" class="form-control" value="<?= esc($user['email']) ?>"></div>
                <div class="form-group"><label for="birth_date">Tanggal Lahir</label><input type="date" id="birth_date" name="birth_date" class="form-control" value="<?= esc($user['birth_date'] ?? '') ?>"></div>
                <div class="form-group"><label for="gender">Jenis Kelamin</label><select id="gender" name="gender" class="form-control"><option value="female" <?= (isset($user['gender']) && $user['gender'] === 'female') ? 'selected' : '' ?>>Perempuan</option><option value="male" <?= (isset($user['gender']) && $user['gender'] === 'male') ? 'selected' : '' ?>>Laki-laki</option></select></div>
            </div>
        </section>

        <!-- Contact Information Card -->
        <section class="form-card">
            <h2>Informasi Kontak</h2>
            <div class="form-grid">
                <div class="form-group"><label for="phone">Nomor Telepon</label><input type="tel" id="phone" name="phone" class="form-control" value="<?= esc($user['phone'] ?? '') ?>"></div>
                <div class="form-group full-width"><label for="address">Alamat</label><input type="text" id="address" name="address" class="form-control" value="<?= esc($user['address'] ?? '') ?>"></div>
            </div>
        </section>

        <!-- Application Preferences Card -->
        <section class="form-card">
            <h2>Preferensi Aplikasi</h2>
            <div class="form-grid">
                <div class="form-group">
                    <label for="language">Bahasa</label>
                    <select id="language" name="language" class="form-control"><option value="id" selected>Indonesia</option><option value="en">English</option></select>
                </div>
                <div class="form-group">
                    <label for="timezone">Zona Waktu</label>
                    <select id="timezone" name="timezone" class="form-control"><option value="asia/jakarta" selected>WIB (Asia/Jakarta)</option><option value="asia/makassar">WITA (Asia/Makassar)</option><option value="asia/jayapura">WIT (Asia/Jayapura)</option></select>
                </div>
            </div>
        </section>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <button type="button" class="btn btn-secondary">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </form>

    <p class="footer-note">Terakhir diperbarui: <?= date('d F Y, H:i', strtotime($user['updated_at'])) ?></p>
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
