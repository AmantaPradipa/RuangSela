<?= $this->extend('layouts/client_layout') ?>

<?= $this->section('title') ?>
Tiket Dukungan
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/tickets_admin.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="page-container">
    <header class="page-header">
        <h1>Tiket Dukungan Anda</h1>
        <a href="<?= site_url('client/support/create') ?>" class="btn btn-primary"><i class="ri-add-line"></i> Buat Tiket Baru</a>
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
            <h2>Daftar Tiket</h2>
        </div>
        <div class="filters">
            <div class="filter-item">
                <i class="ri-search-line"></i>
                <input type="text" class="form-control" id="search-tickets" placeholder="Cari tiket...">
            </div>
            <select class="form-control" id="filter-category">
                <option value="all">Semua Kategori</option>
                <option value="Bug">Bug</option>
                <option value="Feedback">Feedback</option>
                <option value="Payment">Payment</option>
                <option value="Other">Other</option>
            </select>
            <select class="form-control" id="filter-status">
                <option value="all">Semua Status</option>
                <option value="open">Open</option>
                <option value="in_progress">In Progress</option>
                <option value="resolved">Resolved</option>
                <option value="closed">Closed</option>
            </select>
            <button class="btn btn-filter" id="apply-filter"><i class="ri-filter-3-line"></i> Filter</button>
        </div>
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Subjek</th>
                        <th>Kategori</th>
                        <th>Prioritas</th>
                        <th>Status</th>
                        <th>Tanggal Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="tickets-table-body">
                    <?php if (!empty($tickets)) : ?>
                        <?php foreach ($tickets as $ticket) : ?>
                            <tr data-category="<?= esc($ticket['category']) ?>" data-priority="<?= esc($ticket['priority']) ?>" data-status="<?= esc($ticket['status']) ?>">
                                <td>#TKT<?= esc($ticket['id']) ?></td>
                                <td><?= esc($ticket['subject']) ?></td>
                                <td><span class="tag tag-blue"><?= esc($ticket['category']) ?></span></td>
                                <td>
                                    <?php if ($ticket['priority'] === 'high') : ?>
                                        <span class="tag tag-red">Tinggi</span>
                                    <?php elseif ($ticket['priority'] === 'medium') : ?>
                                        <span class="tag tag-yellow">Sedang</span>
                                    <?php else : ?>
                                        <span class="tag tag-green">Rendah</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($ticket['status'] === 'open') : ?>
                                        <span class="tag tag-yellow">Open</span>
                                    <?php elseif ($ticket['status'] === 'in_progress') : ?>
                                        <span class="tag tag-blue">In Progress</span>
                                    <?php elseif ($ticket['status'] === 'resolved') : ?>
                                        <span class="tag tag-green">Resolved</span>
                                    <?php else : ?>
                                        <span class="tag tag-grey">Closed</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= date('d M Y', strtotime($ticket['created_at'])) ?></td>
                                <td class="table-actions">
                                    <a href="<?= site_url('client/support/view/' . $ticket['id']) ?>" title="Lihat Detail"><i class="ri-eye-fill"></i></a>
                                    <form action="<?= site_url('client/support/' . $ticket['id']) ?>" method="post" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tiket ini?');">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn-icon" title="Hapus"><i class="ri-delete-bin-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7">Tidak ada tiket dukungan yang ditemukan.</td>
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
<script src="<?= base_url('assets/js/pages/client_tickets.js') ?>"></script>
<?= $this->endSection() ?>