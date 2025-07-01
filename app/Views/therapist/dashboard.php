<?= $this->extend('layouts/therapist_layout') ?>

<?= $this->section('title') ?>
Dashboard Terapis
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/dashboard_therapist.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>
<div class="page-container">
    <header class="page-header">
        <h1>Dashboard Terapis</h1>
        <a href="<?= site_url('therapist/jadwal') ?>" class="btn btn-primary"><i class="ri-calendar-line"></i> Kelola Jadwal</a>
    </header>

    <section class="stats-grid">
        <div class="card stat-card">
            <div class="stat-info">
                <p class="label">Sesi Mendatang</p>
                <p class="value"><?= count($upcomingAppointments) ?></p>
            </div>
        </div>
        <div class="card stat-card">
            <div class="stat-info">
                <p class="label">Ulasan Baru</p>
                <p class="value"><?= count($recentReviews) ?></p>
            </div>
        </div>
        <div class="card stat-card">
            <div class="stat-info">
                <p class="label">Total Klien</p>
                <p class="value">N/A</p> <!-- TODO: Fetch total clients -->
            </div>
        </div>
    </section>

    <section class="card">
        <div class="section-header">
            <h2>Sesi Mendatang</h2>
            <a href="<?= site_url('therapist/jadwal') ?>" class="btn btn-secondary btn-sm">Lihat Semua</a>
        </div>
        <div class="activity-list">
            <?php if (!empty($upcomingAppointments)) : ?>
                <?php foreach ($upcomingAppointments as $appointment) : ?>
                    <div class="activity-item">
                        <i class="ri-calendar-check-line"></i>
                        <p>Sesi dengan <?= esc($appointment->client_first_name . ' ' . $appointment->client_last_name) ?> pada <?= date('d M Y, H:i', strtotime($appointment->scheduled_at)) ?></p>
                        <?php if (!empty($appointment->meeting_link)) : ?>
                            <a href="<?= esc($appointment->meeting_link) ?>" target="_blank" class="btn btn-sm btn-primary">Gabung Sesi</a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Tidak ada sesi mendatang.</p>
            <?php endif; ?>
        </div>
    </section>

    <section class="card">
        <div class="section-header">
            <h2>Ulasan Terbaru</h2>
            <a href="<?= site_url('therapist/ulasan') ?>" class="btn btn-secondary btn-sm">Lihat Semua</a>
        </div>
        <div class="activity-list">
            <?php if (!empty($recentReviews)) : ?>
                <?php foreach ($recentReviews as $review) : ?>
                    <div class="activity-item">
                        <i class="ri-star-line"></i>
                        <p>Ulasan dari <?= esc($review->first_name . ' ' . $review->last_name) ?>: "<?= esc(character_limiter($review->comment, 50)) ?>"</p>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Tidak ada ulasan terbaru.</p>
            <?php endif; ?>
        </div>
    </section>
</div>

<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script src="<?= base_url('assets/js/pages/therapist_dashboard.js') ?>"></script>
<?= $this->endSection() ?>
