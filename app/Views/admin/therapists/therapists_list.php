<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>
Manajemen Terapis
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/therapists.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="page-container">

    <header class="page-header">
        <h1>Manajemen Terapis</h1>
        <a href="<?= site_url('admin/therapists/create') ?>" class="btn btn-primary"><i class="ri-add-line"></i> Tambah Terapis Baru</a>
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

    <div class="content-tabs">
        <nav>
            <a href="#" class="active" data-status="all">Semua Terapis</a>
            <a href="#" data-status="active">Terapis Aktif</a>
            <a href="#" data-status="new">Terapis Baru</a>
        </nav>
    </div>

    <!-- Therapist List Section -->
    <section class="card">
        <div class="section-header">
            <h2>Daftar Terapis</h2>
            <button class="btn btn-secondary"><i class="ri-upload-line"></i> Export</button>
        </div>
        <div class="filters d-flex flex-wrap gap-3 align-items-center">
            <div class="filter-item search-bar">
                <i class="ri-search-line"></i>
                <input type="text" class="form-control" id="search-therapists" placeholder="Cari terapis...">
            </div>
            <select class="form-control" id="filter-specialization">
                <option value="all">Semua Spesialisasi</option>
                <option value="Kecemasan">Kecemasan</option>
                <option value="Depresi">Depresi</option>
                <option value="Hubungan">Hubungan</option>
            </select>
            <select class="form-control" id="filter-verification-status">
                <option value="all">Semua Status Verifikasi</option>
                <option value="verified">Terverifikasi</option>
                <option value="pending">Menunggu</option>
                <option value="rejected">Ditolak</option>
            </select>
            <select class="form-control" id="filter-account-status">
                <option value="all">Semua Status Akun</option>
                <option value="Aktif">Aktif</option>
                <option value="Nonaktif">Nonaktif</option>
            </select>
            <button class="btn btn-secondary" id="apply-filter"><i class="ri-filter-3-line"></i> Filter</button>
        </div>
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Spesialisasi</th>
                        <th>Status Verifikasi</th>
                        <th>Status Akun</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="therapist-table-body">
                    <?php if (!empty($therapists)) : ?>
                        <?php foreach ($therapists as $therapist) : ?>
                            <tr data-specialization="<?= esc($therapist['expertise']) ?>" data-verification-status="<?= esc($therapist['verification_status']) ?>" data-account-status="<?= $therapist['is_active'] ? 'Aktif' : 'Nonaktif' ?>">
                                <td>#TER<?= esc($therapist['id']) ?></td>
                                <td><?= esc($therapist['first_name'] . ' ' . $therapist['last_name']) ?></td>
                                <td><?= esc($therapist['email']) ?></td>
                                <td><?= esc($therapist['expertise']) ?></td>
                                <td>
                                    <?php if ($therapist['verification_status'] === 'verified') : ?>
                                        <span class="tag tag-green">Terverifikasi</span>
                                    <?php elseif ($therapist['verification_status'] === 'pending') : ?>
                                        <span class="tag tag-yellow">Menunggu</span>
                                    <?php else : ?>
                                        <span class="tag tag-red">Ditolak</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($therapist['is_active']) : ?>
                                        <span class="tag tag-green">Aktif</span>
                                    <?php else : ?>
                                        <span class="tag tag-red">Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                <td class="table-actions">
                                    <a href="<?= site_url('admin/therapists/edit/' . $therapist['id']) ?>" title="Edit"><i class="ri-pencil-fill"></i></a>
                                    <a href="<?= site_url('admin/therapists/verify/' . $therapist['id']) ?>" title="Lihat Verifikasi"><i class="ri-file-check-line"></i></a>
                                    <form action="<?= site_url('admin/therapists/' . $therapist['id']) ?>" method="post" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus terapis ini?');">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn-icon" title="Hapus"><i class="ri-delete-bin-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7">Tidak ada terapis yang ditemukan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="pagination">
            <a href="#"><i class="ri-arrow-left-s-line"></i></a>
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#"><i class="ri-arrow-right-s-line"></i></a>
        </div>
    </section>

</div>

<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script src="<?= base_url('assets/js/pages/admin_therapists.js') ?>"></script>
<?= $this->endSection() ?>