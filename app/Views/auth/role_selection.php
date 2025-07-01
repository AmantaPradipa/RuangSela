<?= $this->extend('layouts/auth_layout') ?>

<?= $this->section('title') ?>
Pilih Peran
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="form-container role-selection-container">
    <h2>Pilih Peran Anda</h2>
    <p class="subtitle">Silakan pilih peran yang paling sesuai dengan Anda untuk melanjutkan pendaftaran.</p>

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

    <form id="role-selection-form" action="<?= site_url('select-role') ?>" method="post">
        <?= csrf_field() ?>
        

        <div class="role-options">
            <label class="role-card">
                <input type="radio" name="role" value="client" <?= old('role') == 'client' ? 'checked' : '' ?> required>
                <div class="card-content">
                    <i class="ri-user-3-line"></i>
                    <h3>Klien</h3>
                    <p>Saya mencari bantuan dan dukungan kesehatan mental.</p>
                </div>
            </label>
            <label class="role-card">
                <input type="radio" name="role" value="therapist" <?= old('role') == 'therapist' ? 'checked' : '' ?> required>
                <div class="card-content">
                    <i class="ri-stethoscope-line"></i>
                    <h3>Terapis</h3>
                    <p>Saya adalah profesional kesehatan mental yang ingin menawarkan layanan.</p>
                </div>
            </label>
        </div>

        <button type="submit" class="submit-btn">Lanjutkan</button>
    </form>
</div>
<?= $this->endSection() ?>