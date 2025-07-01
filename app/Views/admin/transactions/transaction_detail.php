<?= $this->extend('layouts/admin_layout') ?>

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
        <div class="breadcrumbs text-muted">
            <a href="<?= site_url('admin/transactions') ?>">Manajemen Transaksi</a> / #<?= esc($transaction['id']) ?>
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
                        <label>Pengguna</label>
                        <p><?= esc($transaction['user_name']) ?> (<?= esc($transaction['user_email']) ?>)</p>
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
                        <p><?= date('d M Y H:i', strtotime($transaction['transaction_date'])) ?></p>
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
                    <h2>Catatan Admin</h2>
                </div>
                <div class="info-grid">
                    <div class="info-item full-width">
                        <label>Deskripsi Transaksi</label>
                        <p><?= esc($transaction['description'] ?? 'Tidak ada deskripsi.') ?></p>
                    </div>
                </div>
            </section>
        </main>

        <!-- Sidebar with Actions -->
        <aside class="content-sidebar">
            <div class="card">
                <div class="card-header">
                    <h2>Aksi Transaksi</h2>
                </div>

                <div class="info-item mb-4">
                    <label>Status Saat Ini</label>
                    <?php if ($transaction['status'] === 'completed') : ?>
                        <span class="tag tag-green">Completed</span>
                    <?php elseif ($transaction['status'] === 'pending') : ?>
                        <span class="tag tag-yellow">Pending</span>
                    <?php else : ?>
                        <span class="tag tag-red">Failed</span>
                    <?php endif; ?>
                </div>

                <form action="<?= site_url('admin/transactions/update-status/' . $transaction['id']) ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="status">Ubah Status</label>
                        <select id="status" name="status" class="form-control">
                            <option value="pending" <?= ($transaction['status'] === 'pending') ? 'selected' : '' ?>>Pending</option>
                            <option value="completed" <?= ($transaction['status'] === 'completed') ? 'selected' : '' ?>>Completed</option>
                            <option value="failed" <?= ($transaction['status'] === 'failed') ? 'selected' : '' ?>>Failed</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="admin_notes">Catatan Admin (opsional)</label>
                        <textarea id="admin_notes" name="admin_notes" class="form-control" rows="4" placeholder="Tambahkan catatan admin di sini..."><?= esc($transaction['admin_notes']) ?></textarea>
                    </div>
                    <div class="action-buttons">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </aside>
    </div>
</div>

<?= $this->endSection() ?>