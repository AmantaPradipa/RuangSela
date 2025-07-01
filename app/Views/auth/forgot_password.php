<?= $this->extend('layouts/auth_layout') ?>

<?= $this->section('title') ?>
Lupa Kata Sandi
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="main-content">
    <div class="left-pane">
        <div class="logo-section">
            <div class="logo-icon"><img src="<?= base_url('assets/images/logos/logo-white.png') ?>" alt="RuangSela Logo"></div>
            <h1>RuangSela</h1>
        </div>
        <p class="description">
            Platform konsultasi kesehatan mental yang menghubungkan Anda dengan psikolog profesional.
            Temukan dukungan yang Anda butuhkan untuk hidup yang lebih seimbang dan bahagia.
        </p>
        <div class="stats-container">
            <div class="stat-box">
                <div class="number">250+</div>
                <div class="label">Terapis Berpengalaman</div>
            </div>
            <div class="stat-box">
                <div class="number">10K+</div>
                <div class="label">Sesi Konsultasi</div>
            </div>
        </div>

        <?php if (isset($bestReview) && !empty($bestReview)): ?>
        <div class="testimonial-card">
            <div class="stars">
                <?php for ($i = 0; $i < $bestReview['rating']; $i++): ?>
                    <i class="ri-star-fill"></i>
                <?php endfor; ?>
                <?php for ($i = $bestReview['rating']; $i < 5; $i++): ?>
                    <i class="ri-star-line"></i>
                <?php endfor; ?>
            </div>
            <p class="quote">"<?= esc($bestReview['comment']) ?>"</p>
            <div class="testimonial-author">
                <div class="author-avatar"><?= esc($bestReview['user_initials']) ?></div>
                <div class="author-info">
                    <div class="name"><?= esc($bestReview['user_name']) ?></div>
                    <div class="details">Pengguna RuangSela</div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div class="right-pane">
        <nav class="form-nav">
            <a href="<?= site_url('login') ?>">Masuk</a>
            <a href="<?= site_url('register') ?>">Daftar</a>
        </nav>

        <div class="form-container">
            <h2>Lupa Kata Sandi?</h2>
            <p class="subtitle">Masukkan email Anda untuk menerima tautan reset kata sandi.</p>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>
            
            <form id="forgot-password-form" action="<?= site_url('forgot-password') ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-wrapper">
                        <i class="ri-mail-line"></i>
                        <input type="email" name="email" id="email" placeholder="Masukkan email Anda" required value="<?= old('email') ?>">
                    </div>
                </div>
                
                <button type="submit" class="submit-btn">Kirim Tautan Reset</button>
            </form>

            <p class="login-link">
                Kembali ke <a href="<?= site_url('login') ?>">Masuk</a>
            </p>

            <p class="ssl-notice">
                <i class="ri-shield-check-line"></i> Dijamin aman dengan enkripsi SSL
            </p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>