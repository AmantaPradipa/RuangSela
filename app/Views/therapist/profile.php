<?= $this->extend('layouts/therapist_layout') ?>

<?= $this->section('title') ?>
Pengaturan Akun - Terapis
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
        <a href="#" class="nav-item active"><i class="ri-user-line"></i> <span>Profil</span></a>
        <a href="#" class="nav-item"><i class="ri-lock-line"></i> <span>Keamanan</span></a>
        <a href="#" class="nav-item"><i class="ri-notification-3-line"></i> <span>Notifikasi</span></a>
        <a href="#" class="nav-item"><i class="ri-shield-line"></i> <span>Privasi</span></a>
        <a href="#" class="nav-item"><i class="ri-wallet-3-line"></i> <span>Payroll</span></a>
        <a href="#" class="nav-item"><i class="ri-question-line"></i> <span>Bantuan</span></a>
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
            <img src="<?= asset_url($user['profile_picture'], 'assets/images/avatars/default-avatar.png') ?>" alt="Foto Profil Dr. <?= esc($user['first_name']) ?>" class="profile-pic">
            <div class="camera-icon">
                <i class="ri-camera-line"></i>
            </div>
        </div>
        <p class="upload-caption">Ukuran maksimal file: 1MB (Format: JPG, PNG)</p>
        <div class="profile-meta">
            <h2><?= esc($therapist->expertise ?? 'Terapis') ?></h2>
            <div class="profile-meta-details">
                <span class="rating"><span class="stars">★★★★★</span> 4.9/5.0</span><span>•</span><span>Pengalaman <?= esc($therapist->experience_years ?? 0) ?> tahun</span>
            </div>
        </div>
    </header>

    <!-- Form Sections -->
    <form action="<?= site_url('therapist/profile/update') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="file" id="profile-pic-input" name="profile_picture" style="display: none;" accept="image/jpeg, image/png">
        <section class="form-card">
            <h2>Informasi Pribadi</h2>
            <div class="form-grid">
                <div class="form-group"><label for="first_name">Nama Depan</label><input type="text" id="first_name" name="first_name" class="form-control" value="<?= esc($user['first_name']) ?>"></div>
                <div class="form-group"><label for="last_name">Nama Belakang</label><input type="text" id="last_name" name="last_name" class="form-control" value="<?= esc($user['last_name']) ?>"></div>
                <div class="form-group"><label for="username">Nama Pengguna</label><input type="text" id="username" name="username" class="form-control" value="<?= esc($user['username']) ?>"></div>
                <div class="form-group"><label for="email">Email</label><input type="email" id="email" name="email" class="form-control" value="<?= esc($user['email']) ?>"></div>
                <div class="form-group"><label for="experience_years">Pengalaman (Tahun)</label><input type="number" id="experience_years" name="experience_years" class="form-control" value="<?= esc($therapist->experience_years ?? '') ?>"></div>
                <div class="form-group"><label for="license_number">Nomor Izin Praktik</label><input type="text" id="license_number" name="license_number" class="form-control" value="<?= esc($therapist->license_number ?? '') ?>"></div>
            </div>
        </section>
            
        <section class="form-card">
            <h2>Bidang Keahlian</h2>
            <div class="form-group full-width">
                <label for="expertise">Daftar Keahlian (Pisahkan dengan koma)</label>
                <input type="text" id="expertise" name="expertise" class="form-control" value="<?= esc($therapist->expertise ?? '') ?>" placeholder="Contoh: Kecemasan, Depresi, Trauma">
            </div>
        </section>
        
        <section class="form-card">
            <h2>Tentang Saya</h2>
            <div class="form-group full-width">
                <label for="bio">Bio</label>
                <textarea id="bio" name="bio" class="form-control" placeholder="Tulis biografi profesional singkat..."><?= esc($therapist->bio ?? '') ?></textarea>
            </div>
        </section>

        <section class="form-card">
            <h2>Dokumen Verifikasi</h2>
            <div class="form-grid">
                <div class="form-group">
                    <label for="license_file">Salinan Lisensi Profesional</label>
                    <?php if (!empty($therapist->license_file)) : ?>
                        <p>File saat ini: <a href="<?= base_url($therapist->license_file) ?>" target="_blank">Lihat File</a></p>
                    <?php endif; ?>
                    <input type="file" name="license_file" id="license_file" class="form-control" accept="application/pdf,image/*">
                </div>
                <div class="form-group">
                    <label for="id_card_file">Dokumen Identitas (KTP/Paspor)</label>
                    <?php if (!empty($user['id_card_file'])) : ?>
                        <p>File saat ini: <a href="<?= base_url($user['id_card_file']) ?>" target="_blank">Lihat File</a></p>
                    <?php endif; ?>
                    <input type="file" name="id_card_file" id="id_card_file" class="form-control" accept="application/pdf,image/*">
                </div>
                <div class="form-group full-width">
                    <label for="education">Pendidikan Terakhir (Pisahkan dengan koma)</label>
                    <textarea id="education" name="education" class="form-control" rows="3" placeholder="Contoh: S1 Psikologi, S2 Psikologi Klinis"><?= old('education', is_array($therapist['education']) ? implode(', ', $therapist['education']) : '') ?></textarea>
                </div>
            </div>
        </section>
        
        <section class="form-card">
            <h2>Informasi Kontak & Payroll</h2>
            <div class="form-grid">
                <div class="form-group"><label for="phone">Nomor Telepon</label><input type="tel" id="phone" name="phone" class="form-control" value="<?= esc($user['phone'] ?? '') ?>"></div>
                <div class="form-group"><label for="address">Alamat</label><input type="text" id="address" name="address" class="form-control" value="<?= esc($user['address'] ?? '') ?>"></div>
                <div class="form-group"><label for="bank">Bank</label><div class="select-wrapper"><select id="bank" name="bank" class="form-control"><option value="mandiri" selected>Bank Mandiri</option><option>Bank Lainnya</option></select></div></div>
                <div class="form-group"><label for="account-number">Nomor Rekening</label><input type="text" id="account-number" name="account_number" class="form-control" value="<?= esc($user['account_number'] ?? '') ?>"></div>
            </div>
        </section>

        <div class="action-buttons">
            <button type="button" class="btn btn-secondary">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </form>
</div>
<?= $this->section('pageScripts') ?>
<script src="<?= base_url('assets/js/profile.js') ?>"></script>
<?= $this->endSection() ?>