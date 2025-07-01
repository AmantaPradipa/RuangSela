<?= $this->extend('layouts/therapist_layout') ?>

<?= $this->section('title') ?>
Janji Temu
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/appointments.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="page-container">
    <header class="page-header">
        <h1>Janji Temu Anda</h1>
    </header>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <div class="appointments-list">
        <?php if (!empty($appointments)) : ?>
            <?php foreach ($appointments as $appointment) : ?>
                <div class="appointment-item">
                    <div class="appointment-details">
                        <h3>Sesi Konsultasi dengan <?= esc($appointment->client_first_name . ' ' . $appointment->client_last_name) ?></h3>
                        <p><strong>Waktu:</strong> <?= date('d M Y, H:i', strtotime($appointment->scheduled_at)) ?></p>
                        <p><strong>Durasi:</strong> <?= esc($appointment->duration_minutes) ?> menit</p>
                        <p><strong>Status:</strong> <span class="status-badge status-<?= esc($appointment->status) ?>"><?= esc($appointment->status) ?></span></p>
                    </div>
                    <div class="appointment-actions">
                        <?php if ($appointment->status === 'scheduled') : ?>
                            <a href="<?= site_url('therapist/appointments/join/' . $appointment->id) ?>" class="btn btn-primary">Gabung Sesi</a>
                            <button class="btn btn-secondary">Batalkan</button>
                        <?php elseif ($appointment->status === 'completed') : ?>
                            <button class="btn btn-secondary">Lihat Catatan</button>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>Anda belum memiliki janji temu yang terjadwal.</p>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>