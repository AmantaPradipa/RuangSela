<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>
Manajemen Artikel
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/articles_admin.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="page-container">
    <header class="page-header">
        <h1>Manajemen Artikel</h1>
        <a href="<?= site_url('admin/articles/create') ?>" class="btn btn-primary"><i class="ri-add-line"></i> Tambah Artikel Baru</a>
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
            <a href="#" class="active" data-status="all">Semua Artikel</a>
            <a href="#" data-status="published">Dipublikasi</a>
            <a href="#" data-status="draft">Draft</a>
        </nav>
    </div>

    <section class="card">
        <div class="section-header">
            <h2>Daftar Artikel</h2>
            <button class="btn btn-secondary"><i class="ri-upload-line"></i> Export</button>
        </div>
        <div class="filters d-flex flex-wrap gap-3 align-items-center">
            <div class="filter-item search-bar">
                <i class="ri-search-line"></i>
                <input type="text" class="form-control" id="search-articles" placeholder="Cari artikel...">
            </div>
            <select class="form-control" id="filter-category">
                <option value="all">Semua Kategori</option>
                <option value="Kesehatan Mental">Kesehatan Mental</option>
                <option value="Manajemen Stres">Manajemen Stres</option>
            </select>
            <select class="form-control" id="filter-status">
                <option value="all">Semua Status</option>
                <option value="published">Dipublikasi</option>
                <option value="draft">Draft</option>
            </select>
            <button class="btn btn-secondary" id="apply-filter"><i class="ri-filter-3-line"></i> Filter</button>
        </div>
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Tanggal Publikasi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="articles-table-body">
                    <?php if (!empty($articles)) : ?>
                        <?php foreach ($articles as $article) : ?>
                            <tr data-category="<?= esc($article['category']) ?>" data-status="<?= $article['is_published'] ? 'published' : 'draft' ?>">
                                <td>#ART<?= esc($article['id']) ?></td>
                                <td><?= esc($article['title']) ?></td>
                                <td><?= esc($article['author_name'] ?? 'N/A') ?></td>
                                <td><?= date('d M Y', strtotime($article['created_at'])) ?></td>
                                <td>
                                    <?php if ($article['is_published']) : ?>
                                        <span class="tag tag-green">Dipublikasi</span>
                                    <?php else : ?>
                                        <span class="tag tag-yellow">Draft</span>
                                    <?php endif; ?>
                                </td>
                                <td class="table-actions">
                                    <a href="<?= site_url('artikel/detail/' . $article['id']) ?>" title="Lihat" target="_blank"><i class="ri-eye-fill"></i></a>
                                    <a href="<?= site_url('admin/articles/edit/' . $article['id']) ?>" title="Edit"><i class="ri-pencil-fill"></i></a>
                                    <form action="<?= site_url('admin/articles/' . $article['id']) ?>" method="post" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn-icon" title="Hapus"><i class="ri-delete-bin-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6">Tidak ada artikel yang ditemukan.</td>
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
<script src="<?= base_url('assets/js/pages/admin_articles.js') ?>"></script>
<?= $this->endSection() ?>
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
            <a href="#" class="active">Semua Artikel</a>
            <a href="#">Dipublikasi</a>
            <a href="#">Draft</a>
        </nav>
    </div>

    <section class="card">
        <div class="section-header">
            <h2>Daftar Artikel</h2>
            <button class="btn btn-secondary"><i class="ri-upload-line"></i> Export</button>
        </div>
        <div class="filters">
            <div class="filter-item">
                <i class="ri-search-line"></i>
                <input type="text" class="form-control" placeholder="Cari artikel...">
            </div>
            <select class="form-control">
                <option>Semua Kategori</option>
                <option>Kesehatan Mental</option>
                <option>Manajemen Stres</option>
            </select>
            <select class="form-control">
                <option>Semua Status</option>
                <option>Dipublikasi</option>
                <option>Draft</option>
            </select>
            <button class="btn btn-filter"><i class="ri-filter-3-line"></i> Filter</button>
        </div>
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Tanggal Publikasi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($articles)) : ?>
                        <?php foreach ($articles as $article) : ?>
                            <tr>
                                <td>#ART<?= esc($article['id']) ?></td>
                                <td><?= esc($article['title']) ?></td>
                                <td><?= esc($article['author_name'] ?? 'N/A') ?></td>
                                <td><?= date('d M Y', strtotime($article['created_at'])) ?></td>
                                <td>
                                    <?php if ($article['is_published']) : ?>
                                        <span class="tag tag-green">Dipublikasi</span>
                                    <?php else : ?>
                                        <span class="tag tag-yellow">Draft</span>
                                    <?php endif; ?>
                                </td>
                                <td class="table-actions">
                                    <a href="<?= site_url('artikel/detail/' . $article['id']) ?>" title="Lihat" target="_blank"><i class="ri-eye-fill"></i></a>
                                    <a href="<?= site_url('admin/articles/edit/' . $article['id']) ?>" title="Edit"><i class="ri-pencil-fill"></i></a>
                                    <form action="<?= site_url('admin/articles/' . $article['id']) ?>" method="post" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn-icon" title="Hapus"><i class="ri-delete-bin-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6">Tidak ada artikel yang ditemukan.</td>
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
