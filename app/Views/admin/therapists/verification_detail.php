<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>
<?= esc($title) ?>
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/verification_detail.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="page-container">

    <header class="page-header">
        <h1>Detail & Verifikasi Terapis</h1>
        <div class="breadcrumbs">
            <a href="<?= site_url('admin/therapists/verification') ?>">Verifikasi Terapis</a> / Dr. <?= esc($user['first_name']) ?>
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

        <!-- Main Content Area -->
        <main class="content-main">
            <!-- Therapist Information Card -->
            <section class="card">
                <div class="card-header">
                    <h2>Informasi Terapis</h2>
                </div>
                <div class="profile-header d-flex align-items-center gap-3 mb-4">
                    <img src="<?= asset_url($user['profile_picture'], 'assets/images/avatars/default-avatar.png') ?>" alt="Avatar Dr. <?= esc($user['first_name']) ?>" class="rounded-full w-20 h-20">
                    <div>
                        <p class="name font-semibold text-lg">Dr. <?= esc($user['first_name'] . ' ' . $user['last_name']) ?>, M.Psi.</p>
                        <p class="email text-sm text-muted"><?= esc($user['email']) ?></p>
                    </div>
                </div>

                <div class="info-grid">
                    <div class="info-item">
                        <label>Spesialisasi</label>
                        <p><?= esc($therapist->expertise) ?></p>
                    </div>
                    <div class="info-item">
                        <label>Nomor Telepon</label>
                        <p><?= esc($user['phone'] ?? 'N/A') ?></p>
                    </div>
                    <div class="info-item">
                        <label>Nomor SIPP (Surat Izin Praktik)</label>
                        <p><?= esc($therapist->license_number) ?></p>
                    </div>
                    <div class="info-item">
                        <label>Pengalaman</label>
                        <p><?= esc($therapist->experience_years) ?> Tahun</p>
                    </div>
                    <div class="info-item">
                        <label>Pendidikan Terakhir</label>
                        <p><?= esc($therapist->education) ?></p>
                    </div>
                    <div class="info-item">
                        <label>Bio</label>
                        <p><?= esc($therapist->bio) ?></p>
                    </div>
                </div>
            </section>

            <!-- Documents Card -->
            <section class="card">
                <div class="card-header">
                    <h2>Dokumen Verifikasi</h2>
                </div>
                <ul class="document-list">
                    <li class="document-item">
                        <div class="document-info">
                            <i class="ri-file-text-line"></i>
                            <span>Salinan Lisensi Profesional</span>
                        </div>
                        <?php if (!empty($therapist->license_file)) : ?>
                            <a href="<?= base_url($therapist->license_file) ?>" target="_blank" class="btn btn-outline btn-sm">Lihat Dokumen</a>
                        <?php else : ?>
                            <span class="text-muted">Tidak ada dokumen</span>
                        <?php endif; ?>
                    </li>
                    <li class="document-item">
                        <div class="document-info">
                            <i class="ri-file-text-line"></i>
                            <span>Dokumen Identitas (KTP/Paspor)</span>
                        </div>
                        <?php if (!empty($user->id_card_file)) : ?>
                            <a href="<?= base_url($user->id_card_file) ?>" target="_blank" class="btn btn-outline btn-sm">Lihat Dokumen</a>
                        <?php else : ?>
                            <span class="text-muted">Tidak ada dokumen</span>
                        <?php endif; ?>
                    </li>
                </ul>
            </section>
        </main>

        <!-- Sidebar with Actions -->
        <aside class="content-sidebar">
            <div class="card">
                <div class="card-header">
                    <h2>Ringkasan & Aksi</h2>
                </div>

                <div class="info-item" style="margin-bottom: 20px;">
                    <label>Status Saat Ini</label>
                    <?php if ($therapist->verification_status === 'pending') : ?>
                        <span class="tag orange">Menunggu Verifikasi</span>
                    <?php elseif ($therapist->verification_status === 'verified') : ?>
                        <span class="tag green">Terverifikasi</span>
                    <?php else : ?>
                        <span class="tag grey">Ditolak</span>
                    <?php endif; ?>
                </div>
                <div class="info-item" style="margin-bottom: 24px;">
                    <label>Tanggal Pendaftaran</label>
                    <p><?= date('d M Y', strtotime($therapist->created_at)) ?></p>
                </div>

                <form action="<?= site_url('admin/therapists/verify/' . $therapist->id) ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="verification_notes">Catatan Verifikasi (opsional)</label>
                        <textarea id="verification_notes" name="verification_notes" class="form-control" rows="4" placeholder="Tambahkan catatan verifikasi di sini..."><?= esc($therapist->verification_notes) ?></textarea>
                    </div>
                    <div class="action-buttons">
                        <?php if ($therapist->verification_status === 'pending') : ?>
                            <button type="submit" name="action" value="reject" class="btn btn-danger"><i class="ri-close-circle-line"></i>Tolak Pengajuan</button>
                            <button type="submit" name="action" value="verify" class="btn btn-success"><i class="ri-check-line"></i>Setujui & Verifikasi</button>
                        <?php else : ?>
                            <p class="text-muted text-center">Status verifikasi sudah final.</p>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </aside>
    </div>
</div>

<?= $this->endSection() ?>
