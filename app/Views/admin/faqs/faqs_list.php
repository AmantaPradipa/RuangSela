<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>
Manajemen FAQ
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/faq_admin.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="page-container">
    <header class="page-header">
        <h1>Manajemen FAQ</h1>
        <a href="<?= site_url('admin/faqs/create') ?>" class="btn btn-primary"><i class="ri-add-line"></i> Tambah FAQ Baru</a>
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

    <section class="card">
        <div class="section-header">
            <h2>Daftar FAQ</h2>
        </div>
        <div class="filters d-flex flex-wrap gap-3 align-items-center">
            <div class="filter-item search-bar">
                <i class="ri-search-line"></i>
                <input type="text" class="form-control" id="search-faq" placeholder="Cari FAQ...">
            </div>
            <select class="form-control" id="filter-category">
                <option value="all">Semua Kategori</option>
                <option value="Umum">Umum</option>
                <option value="Konsultasi">Konsultasi</option>
                <option value="Pembayaran">Pembayaran</option>
            </select>
            <select class="form-control" id="filter-status">
                <option value="all">Semua Status</option>
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
                        <th>Pertanyaan</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="faq-table-body">
                    <?php if (!empty($faqs)) : ?>
                        <?php foreach ($faqs as $faq) : ?>
                            <tr data-category="<?= esc($faq['category']) ?>" data-status="<?= $faq['is_active'] ? 'Aktif' : 'Nonaktif' ?>">
                                <td>#FAQ<?= esc($faq['id']) ?></td>
                                <td><?= esc($faq['question']) ?></td>
                                <td><span class="tag tag-blue"><?= esc($faq['category']) ?></span></td>
                                <td>
                                    <?php if ($faq['is_active']) : ?>
                                        <span class="tag tag-green">Aktif</span>
                                    <?php else : ?>
                                        <span class="tag tag-red">Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                <td class="table-actions">
                                    <a href="<?= site_url('admin/faqs/edit/' . $faq['id']) ?>" title="Edit"><i class="ri-pencil-fill"></i></a>
                                    <form action="<?= site_url('admin/faqs/' . $faq['id']) ?>" method="post" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus FAQ ini?');">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn-icon" title="Hapus"><i class="ri-delete-bin-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5">Tidak ada FAQ yang ditemukan.</td>
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
<script src="<?= base_url('assets/js/pages/admin_faqs.js') ?>"></script>
<?= $this->endSection() ?>
