<?= $this->extend('layouts/client_layout') ?>

<?= $this->section('title') ?>
Detail Transaksi
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/payment.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="page-container">

    <header class="page-header">
        <h1>Detail Transaksi #<?= esc($transaction['id']) ?></h1>
        <div class="breadcrumbs">
            <a href="<?= site_url('client/transactions') ?>">Riwayat Transaksi</a> / #<?= esc($transaction['id']) ?>
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
            <section class="card">
                <div class="card-header">
                    <h2>Informasi Transaksi</h2>
                </div>
                <div class="info-grid">
                    <div class="info-item">
                        <label>ID Transaksi</label>
                        <p>#TRX<?= esc($transaction['id']) ?></p>
                    </div>
                    <div class="info-item">
                        <label>Tipe Transaksi</label>
                        <p>Pembelian Paket</p>
                    </div>
                    <div class="info-item">
                        <label>Jumlah</label>
                        <p>Rp <?= number_format(esc($transaction['amount']), 0, ',', '.') ?></p>
                    </div>
                    <div class="info-item">
                        <label>Metode Pembayaran</label>
                        <p><?= esc($transaction['payment_method']) ?></p>
                    </div>
                    <div class="info-item">
                        <label>Status</label>
                        <p>
                            <?php if ($transaction['status'] === 'completed') : ?>
                                <span class="tag tag-green">Completed</span>
                            <?php elseif ($transaction['status'] === 'pending') : ?>
                                <span class="tag tag-yellow">Pending</span>
                            <?php else : ?>
                                <span class="tag tag-red">Failed</span>
                            <?php endif; ?>
                        </p>
                    </div>
                    <div class="info-item">
                        <label>Tanggal Transaksi</label>
                        <p><?= date('d M Y H:i', strtotime($transaction['created_at'])) ?></p>
                    </div>
                    <?php if (!empty($transaction['package_name'])) : ?>
                    <div class="info-item full-width">
                        <label>Paket Terkait</label>
                        <p><?= esc($transaction['package_name']) ?></p>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($transaction['proof_file'])) : ?>
                    <div class="info-item full-width">
                        <label>Bukti Pembayaran</label>
                        <p><a href="<?= base_url($transaction['proof_file']) ?>" target="_blank">Lihat Bukti</a></p>
                    </div>
                    <?php endif; ?>
                </div>
            </section>

            <section class="card">
                <div class="card-header">
                    <h2>Catatan Tambahan</h2>
                </div>
                <div class="info-grid">
                    <div class="info-item full-width">
                        <label>Deskripsi Transaksi</label>
                        <p><?= esc($transaction['description'] ?? 'Tidak ada deskripsi.') ?></p>
                    </div>
                </div>
            </section>
        </main>

        <aside class="content-sidebar">
            <div class="card">
                <div class="card-header">
                    <h2>Aksi</h2>
                </div>
                <div class="action-buttons">
                    <a href="<?= site_url('client/transactions') ?>" class="btn btn-secondary">Kembali ke Daftar</a>
                </div>
            </div>
        </aside>
    </div>
</div>

<?= $this->endSection() ?>