<?= $this->extend('layouts/client_layout') ?>

<?= $this->section('title') ?>
Riwayat Transaksi
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/payment.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="page-container">
    <header class="page-header">
        <h1>Riwayat Transaksi Anda</h1>
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
            <h2>Daftar Transaksi</h2>
        </div>
        <div class="filters">
            <div class="filter-item">
                <i class="ri-search-line"></i>
                <input type="text" class="form-control" id="search-transactions" placeholder="Cari transaksi...">
            </div>
            <select class="form-control" id="filter-type">
                <option value="all">Semua Tipe</option>
                <option value="Pembelian Paket">Pembelian Paket</option>
                <option value="Pembayaran Sesi">Pembayaran Sesi</option>
            </select>
            <select class="form-control" id="filter-status">
                <option value="all">Semua Status</option>
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
                <option value="failed">Failed</option>
            </select>
            <button class="btn btn-filter" id="apply-filter"><i class="ri-filter-3-line"></i> Filter</button>
        </div>
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Tipe</th>
                        <th>Jumlah</th>
                        <th>Metode Pembayaran</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="transactions-table-body">
                    <?php if (!empty($transactions)) : ?>
                        <?php foreach ($transactions as $transaction) : ?>
                            <tr data-status="<?= esc($transaction['status']) ?>">
                                <td>#TRX<?= esc($transaction['id']) ?></td>
                                <td>Pembelian Paket</td>
                                <td>Rp <?= number_format(esc($transaction['amount']), 0, ',', '.') ?></td>
                                <td><?= esc($transaction['payment_method']) ?></td>
                                <td>
                                    <?php if ($transaction['status'] === 'completed') : ?>
                                        <span class="tag tag-green">Completed</span>
                                    <?php elseif ($transaction['status'] === 'pending') : ?>
                                        <span class="tag tag-yellow">Pending</span>
                                    <?php else : ?>
                                        <span class="tag tag-red">Failed</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= date('d M Y', strtotime($transaction['transaction_date'])) ?></td>
                                <td class="table-actions">
                                    <a href="<?= site_url('client/transactions/view/' . $transaction['id']) ?>" title="Lihat Detail"><i class="ri-eye-fill"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7">Tidak ada transaksi yang ditemukan.</td>
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
<script src="<?= base_url('assets/js/pages/client_transactions.js') ?>"></script>
<?= $this->endSection() ?>