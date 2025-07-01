<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>
Manajemen Pengguna
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/user_management.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="page-container">

    <header class="page-header">
        <h1>Manajemen Pengguna</h1>
        <a href="<?= site_url('admin/users/create') ?>" class="btn btn-primary"><i class="ri-add-line"></i> Tambah Pengguna Baru</a>
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
            <a href="#" class="active" data-status="all">Semua Pengguna</a>
            <a href="#" data-status="active">Pengguna Aktif</a>
            <a href="#" data-status="new">Pengguna Baru</a>
            <a href="#" data-status="package">Paket Konsultasi</a>
        </nav>
    </div>

    <!-- User List Section -->
    <section class="card">
        <div class="section-header">
            <h2>Daftar Pengguna</h2>
            <button class="btn btn-secondary"><i class="ri-upload-line"></i> Export</button>
        </div>
        <div class="filters d-flex flex-wrap gap-3 align-items-center">
            <div class="filter-item search-bar">
                <i class="ri-search-line"></i>
                <input type="text" class="form-control" id="search-users" placeholder="Cari pengguna...">
            </div>
            <select class="form-control" id="filter-role">
                <option value="all">Semua Kategori</option>
                <option value="client">Client</option>
                <option value="therapist">Terapis</option>
                <option value="admin">Admin</option>
            </select>
            <select class="form-control" id="filter-status">
                <option value="all">Semua Status</option>
                <option value="Aktif">Aktif</option>
                <option value="Nonaktif">Nonaktif</option>
                <option value="Pending">Pending</option>
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
                        <th>Role</th>
                        <th>Tanggal Registrasi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="users-table-body">
                    <?php if (!empty($users)) : ?>
                        <?php foreach ($users as $user) : ?>
                            <tr data-role="<?= esc($user['role']) ?>" data-status="<?= $user['is_active'] ? 'Aktif' : 'Nonaktif' ?>">
                                <td>#USR<?= esc($user['id']) ?></td>
                                <td><?= esc($user['first_name'] . ' ' . $user['last_name']) ?></td>
                                <td><?= esc($user['email']) ?></td>
                                <td><span class="tag tag-<?= esc($user['role']) ?>"><?= esc(ucfirst($user['role'])) ?></span></td>
                                <td><?= date('d M Y', strtotime($user['created_at'])) ?></td>
                                <td>
                                    <?php if ($user['is_active']) : ?>
                                        <span class="tag tag-green">Aktif</span>
                                    <?php else : ?>
                                        <span class="tag tag-red">Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                <td class="table-actions">
                                    <a href="<?= site_url('admin/users/edit/' . $user['id']) ?>" title="Edit"><i class="ri-pencil-fill"></i></a>
                                    <form action="<?= site_url('admin/users/' . $user['id']) ?>" method="post" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn-icon" title="Hapus"><i class="ri-delete-bin-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7">Tidak ada pengguna yang ditemukan.</td>
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
<script src="<?= base_url('assets/js/pages/admin_users.js') ?>"></script>
<?= $this->endSection() ?>
