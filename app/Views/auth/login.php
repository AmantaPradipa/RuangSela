<?= $this->extend('layouts/auth_layout') ?>

<?= $this->section('content') ?>
<div class="right-pane">
    <div class="form-container">
        <div class="form-header">
            <h2>Selamat Datang Kembali!</h2>
            <p>Belum punya akun? <a href="<?= site_url('register') ?>">Daftar di sini</a></p>
        </div>

        <?= view('components/shared/_alerts') ?>

        <form action="<?= site_url('login') ?>" method="post">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan alamat email Anda" value="<?= old('email') ?>">
            </div>

            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan kata sandi Anda">
            </div>

            <div class="form-options">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Ingat saya</label>
                </div>
                <a href="<?= site_url('forgot-password') ?>" class="forgot-password-link">Lupa Kata Sandi?</a>
            </div>

            <button type="submit" class="submit-btn">Masuk</button>

            <div class="separator">atau lanjutkan dengan</div>

            <button type="button" class="social-login-btn">
                <i class="ri-google-fill"></i>
                <span>Masuk dengan Google</span>
            </button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>