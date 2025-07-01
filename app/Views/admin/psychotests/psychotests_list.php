<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>
Manajemen Psikotes
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/psychotest_admin.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="page-container">
    <header class="page-header">
        <h1>Manajemen Psikotes</h1>
        <a href="<?= site_url('admin/psychotests/create') ?>" class="btn btn-primary"><i class="ri-add-line"></i> Tambah Psikotes Baru</a>
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
            <h2>Daftar Psikotes</h2>
        </div>
        <div class="filters d-flex flex-wrap gap-3 align-items-center">
            <div class="filter-item search-bar">
                <i class="ri-search-line"></i>
                <input type="text" class="form-control" id="search-psychotest" placeholder="Cari Psikotes...">
            </div>
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
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="psychotest-table-body">
                    <?php if (!empty($psychotests)) : ?>
                        <?php foreach ($psychotests as $psychotest) : ?>
                            <tr data-status="<?= $psychotest->is_active ? 'Aktif' : 'Nonaktif' ?>">
                                <td>#PSI<?= esc($psychotest->id) ?></td>
                                <td><?= esc($psychotest->title) ?></td>
                                <td><?= esc(character_limiter($psychotest->description, 100)) ?></td>
                                <td>
                                    <?php if ($psychotest->is_active) : ?>
                                        <span class="tag tag-green">Aktif</span>
                                    <?php else : ?>
                                        <span class="tag tag-red">Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                <td class="table-actions">
                                    <a href="<?= site_url('admin/psychotests/edit/' . $psychotest->id) ?>" title="Edit"><i class="ri-pencil-fill"></i></a>
                                    <a href="<?= site_url('admin/psychotests/manage-questions/' . $psychotest->id) ?>" title="Kelola Pertanyaan"><i class="ri-question-answer-line"></i></a>
                                    <form action="<?= site_url('admin/psychotests/' . $psychotest->id) ?>" method="post" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus Psikotes ini?');">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn-icon" title="Hapus"><i class="ri-delete-bin-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5">Tidak ada Psikotes yang ditemukan.</td>
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
<script src="<?= base_url('assets/js/pages/admin_psychotests.js') ?>"></script>
<?= $this->endSection() ?>
