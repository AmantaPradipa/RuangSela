<?= $this->extend('layouts/client_layout') ?>

<?= $this->section('title') ?>
Dashboard Klien
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/dashboard_client.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>
<div class="page-container">
    <header class="page-header">
        <h1>Selamat Datang Kembali, <?= esc($user['first_name']) ?>!</h1>
        <a href="<?= site_url('client/konsultasi/book') ?>" class="btn btn-primary"><i class="ri-add-line"></i> Jadwalkan Sesi</a>
    </header>

    <section class="stats-grid">
        <div class="card stat-card">
            <div class="stat-info">
                <p class="label">Sesi Terjadwal</p>
                <p class="value"><?= !empty($upcomingAppointments) ? count($upcomingAppointments) : 0 ?></p>
            </div>
        </div>
        <div class="card stat-card">
            <div class="stat-info">
                <p class="label">Paket Aktif</p>
                <p class="value"><?= esc($activePackage['name'] ?? 'Tidak Ada') ?></p>
            </div>
        </div>
        <div class="card stat-card">
            <div class="stat-info">
                <p class="label">Sisa Sesi</p>
                <p class="value"><?= esc($activePackage['sessions_count'] ?? 0) ?></p>
            </div>
        </div>
    </section>

    <section class="card">
        <div class="section-header">
            <h2>Aktivitas Terbaru</h2>
        </div>
        <div class="activity-list">
            <?php if (!empty($recentActivities)) : ?>
                <?php foreach ($recentActivities as $activity) : ?>
                    <div class="activity-item">
                        <i class="ri-history-line"></i>
                        <p><?= esc($activity['action_type']) ?> pada <?= \CodeIgniter\I18n\Time::parse($activity['created_at'])->humanize() ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Tidak ada aktivitas terbaru.</p>
            <?php endif; ?>
        </div>
    </section>

    <section class="card chart-card">
        <div class="section-header">
            <h2>Perkembangan Mood</h2>
        </div>
        <canvas id="moodChart"></canvas>
    </section>
</div>

<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?= base_url('assets/js/pages/client_dashboard.js') ?>"></script>
<?= $this->endSection() ?>