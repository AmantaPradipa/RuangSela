<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>
Verifikasi Dokumen Terapis
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/verification.css') ?>">
<?= 
$this->endSection() ?>



<?= $this->section('content') ?>

<div class="page-container">
    <header class="page-header">
        <h1>Verifikasi Dokumen Terapis</h1>
        <div class="header-actions d-flex flex-wrap gap-3 align-items-center">
            <div class="search-bar">
                <i class="ri-search-line"></i>
                <input type="text" id="search-therapist-verification" placeholder="Cari terapis..." class="form-control">
            </div>
            <select class="status-filter form-control" id="filter-verification-status">
                <option value="all">Semua Status</option>
                <option value="pending">Menunggu</option>
                <option value="verified">Terverifikasi</option>
                <option value="rejected">Ditolak</option>
            </select>
        </div>
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

    <div class="content-layout">
        <!-- Left Panel: Therapist List -->
        <aside class="content-sidebar card">
            <nav class="list-tabs content-tabs">
                <a href="#" class="active" data-status="all">Semua (<?= count($therapists) ?>)</a>
                <a href="#" data-status="pending">Menunggu (<?= count(array_filter($therapists, fn($t) => $t->verification_status === 'pending')) ?>)</a>
                <a href="#" data-status="verified">Terverifikasi (<?= count(array_filter($therapists, fn($t) => $t->verification_status === 'verified')) ?>)</a>
                <a href="#" data-status="rejected">Ditolak (<?= count(array_filter($therapists, fn($t) => $t->verification_status === 'rejected')) ?>)</a>
            </nav>
            <div class="therapist-scroll-list" id="therapist-scroll-list">
                <?php if (!empty($therapists)) : ?>
                    <?php foreach ($therapists as $therapist) : ?>
                        <a href="<?= site_url('admin/therapists/verify/' . $therapist->id) ?>" class="therapist-item d-flex align-items-center gap-3 p-3 border-b border-gray-200 <?= ($therapist->verification_status === 'pending') ? 'active' : '' ?>" data-status="<?= esc($therapist->verification_status) ?>" data-name="<?= esc($therapist->first_name . ' ' . $therapist->last_name) ?>">
                            <img src="<?= asset_url($therapist->profile_picture, 'assets/images/avatars/default-avatar.png') ?>" alt="Avatar" class="avatar rounded-full w-12 h-12">
                            <div class="therapist-info flex-grow-1">
                                <h3 class="font-semibold text-base">Dr. <?= esc($therapist->first_name . ' ' . $therapist->last_name) ?></h3>
                                <p class="text-sm text-muted"><?= esc($therapist->expertise) ?></p>
                                <div class="therapist-progress d-flex align-items-center gap-2 mt-2">
                                    <span class="text-xs text-muted">Progress: N/A</span>
                                    <div class="progress-bar flex-grow-1 h-1 bg-gray-200 rounded-full"><div class="progress-bar-inner h-full bg-primary-500 rounded-full" style="width: 0%;"></div></div>
                                    <?php if ($therapist->verification_status === 'pending') : ?>
                                        <span class="tag tag-yellow">Menunggu</span>
                                    <?php elseif ($therapist->verification_status === 'verified') : ?>
                                        <span class="tag tag-green">Terverifikasi</span>
                                    <?php else : ?>
                                        <span class="tag tag-red">Ditolak</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <span class="item-date text-sm text-muted"><i class="ri-calendar-line"></i> <?= date('d M Y', strtotime($therapist->created_at)) ?></span>
                        </a>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p class="p-4 text-muted text-center">Tidak ada terapis untuk diverifikasi.</p>
                <?php endif; ?>
            </div>
        </aside>

        <!-- Right Panel: Verification Details (Placeholder for now, will be filled by detail view) -->
        <main class="content-main card">
            <p class="text-muted text-center">Pilih terapis dari daftar di samping untuk melihat detail verifikasi.</p>
        </main>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script src="<?= base_url('assets/js/pages/admin_verification.js') ?>"></script>
<?= $this->endSection() ?>
