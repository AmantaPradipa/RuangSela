<?= $this->extend('layouts/therapist_layout') ?>

<?= $this->section('title') ?>
Manajemen Klien
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/client_management.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="page-container">

    <header class="page-header">
        <h1>Manajemen Klien</h1>
        <a href="<?= site_url('therapist/klien/create') ?>" class="btn btn-primary"><i class="ri-add-line"></i> Tambah Klien Baru</a>
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
            <a href="#" class="active" data-status="all">Semua Klien</a>
            <a href="#" data-status="active">Klien Aktif</a>
            <a href="#" data-status="new">Klien Baru</a>
        </nav>
    </div>

    <!-- User List Section -->
    <section class="card">
        <div class="section-header">
            <h2>Daftar Klien</h2>
            <button class="btn btn-secondary"><i class="ri-upload-line"></i> Export</button>
        </div>
        <div class="filters">
            <div class="filter-item">
                <i class="ri-search-line"></i>
                <input type="text" class="form-control" id="search-clients" placeholder="Cari klien...">
            </div>
            <select class="form-control" id="filter-category">
                <option value="all">Semua Kategori</option>
                <option value="Klien Aktif">Klien Aktif</option>
                <option value="Klien Baru">Klien Baru</option>
            </select>
            <button class="btn btn-filter" id="apply-filter"><i class="ri-filter-3-line"></i> Filter</button>
        </div>
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Sesi Terakhir</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="clients-table-body">
                    <?php if (!empty($clients)) : ?>
                        <?php foreach ($clients as $client) : ?>
                            <tr data-status="Aktif" data-category="Klien Aktif" data-name="<?= esc($client->first_name . ' ' . $client->last_name) ?>">
                                <td>#CLI<?= esc($client->id) ?></td>
                                <td><?= esc($client->first_name . ' ' . $client->last_name) ?></td>
                                <td><?= esc($client->email) ?></td>
                                <td>N/A</td> <!-- TODO: Fetch last session date -->
                                <td><span class="tag tag-green">Aktif</span></td> <!-- TODO: Dynamic status -->
                                <td class="table-actions">
                                    <a href="<?= site_url('therapist/klien/view/' . $client->id) ?>" title="Lihat Detail"><i class="ri-eye-fill"></i></a>
                                    <a href="#" title="Kirim Pesan"><i class="ri-message-3-fill"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6">Tidak ada klien yang ditemukan.</td>
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
<script src="<?= base_url('assets/js/pages/therapist_clients.js') ?>"></script>
<?= $this->endSection() ?>
