<?= $this->extend('layouts/auth_layout') ?>

<?= $this->section('content') ?>
<div class="right-pane">
    <div class="form-container">
        <div class="form-header">
            <h2>Buat Akun Baru</h2>
            <p>Sudah punya akun? <a href="<?= site_url('login') ?>">Masuk di sini</a></p>
        </div>

        <?= view('components/shared/_alerts') ?>

        <form action="<?= site_url('register') ?>" method="post">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="first_name">Nama Depan</label>
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Masukkan nama depan Anda" value="<?= old('first_name') ?>">
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Pilih username unik" value="<?= old('username') ?>">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan alamat email Anda" value="<?= old('email') ?>">
            </div>

            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Buat kata sandi (minimal 8 karakter)">
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="tos" name="tos" required>
                    <label class="form-check-label" for="tos">Saya menyetujui <a href="#">Syarat & Ketentuan</a> yang berlaku.</label>
                </div>
            </div>

            <button type="submit" class="submit-btn">Daftar</button>

        </form>
    </div>
</div>
<?= $this->endSection() ?>