<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>
Dashboard
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/dashboard_admin.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>
<div class="page-container">
    <header class="page-header">
        <h1>Dashboard</h1>
        <a href="#" class="btn btn-primary"><i class="ri-download-2-line"></i> Laporan</a>
    </header>

    <!-- STATS CARDS -->
    <section class="stats-grid">
        <div class="card stat-card">
            <div class="stat-icon icon-users"><i class="ri-group-line"></i></div>
            <div class="stat-info">
                <p class="label">Total Pengguna</p>
                <p class="value"><?= esc($totalUsers) ?></p>
            </div>
        </div>
        <div class="card stat-card">
            <div class="stat-icon icon-therapists"><i class="ri-user-star-line"></i></div>
            <div class="stat-info">
                <p class="label">Total Terapis</p>
                <p class="value"><?= esc($totalTherapists) ?></p>
            </div>
        </div>
        <div class="card stat-card">
            <div class="stat-icon icon-articles"><i class="ri-newspaper-line"></i></div>
            <div class="stat-info">
                <p class="label">Total Artikel</p>
                <p class="value"><?= esc($totalArticles) ?></p>
            </div>
        </div>
        <div class="card stat-card">
            <div class="stat-icon icon-tickets"><i class="ri-customer-service-2-line"></i></div>
            <div class="stat-info">
                <p class="label">Tiket Terbuka</p>
                <p class="value"><?= esc($pendingSupportTickets) ?></p>
            </div>
        </div>
    </section>

    <!-- VERIFIKASI TERAPIS TABLE -->
    <section class="card">
        <div class="section-header">
            <h2>Verifikasi Terapis Tertunda</h2>
            <a href="<?= site_url('admin/therapists/verification') ?>" class="btn btn-secondary btn-sm">Lihat Semua</a>
        </div>
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nama Terapis</th>
                        <th>Spesialisasi</th>
                        <th>Tanggal Daftar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($recentTherapistVerifications)) : ?>
                        <?php foreach ($recentTherapistVerifications as $therapist) : ?>
                            <tr>
                                <td>
                                    <div class="therapist-info d-flex align-items-center gap-2">
                                        <img src="<?= asset_url($therapist->profile_picture, 'assets/images/avatars/default-avatar.png') ?>" alt="Avatar" class="rounded-full w-10 h-10">
                                        <div>
                                            <div class="name font-medium"><?= esc($therapist->first_name . ' ' . $therapist->last_name) ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td><?= esc($therapist->expertise) ?></td>
                                <td><?= date('d M Y', strtotime($therapist->created_at)) ?></td>
                                <td><span class="tag tag-orange">Menunggu</span></td>
                                <td>
                                    <a href="<?= site_url('admin/therapists/verify/' . $therapist->id) ?>" class="btn btn-primary btn-sm">Verifikasi</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr><td colspan="5" class="text-center text-muted">Tidak ada permintaan verifikasi terapis terbaru.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script src="<?= base_url('assets/js/pages/admin_dashboard.js') ?>"></script>
<?= $this->endSection() ?>
