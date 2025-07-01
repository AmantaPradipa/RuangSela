<?= $this->extend('layouts/client_layout') ?>

<?= $this->section('title') ?>
Pembelian Berhasil
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/payment.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="page-container">
    <h1 class="main-title">Pembelian Berhasil!</h1>
    <div class="stepper">
        <div class="step done">1</div><div class="step-line done"></div>
        <div class="step done">2</div><div class="step-line done"></div>
        <div class="step active">3</div>
    </div>

    <section class="card text-center">
        <div class="card-header">
            <h2>Terima Kasih atas Pembelian Anda!</h2>
        </div>
        <p>Pembayaran Anda telah kami terima dan sedang dalam proses verifikasi oleh tim kami.</p>
        <p>Anda akan menerima notifikasi setelah pembayaran Anda berhasil diverifikasi dan paket konsultasi Anda aktif.</p>
        <div class="action-buttons" style="justify-content: center;">
            <a href="<?= site_url('client/dashboard') ?>" class="btn btn-primary">Kembali ke Dashboard</a>
            <a href="<?= site_url('client/transactions') ?>" class="btn btn-secondary">Lihat Riwayat Transaksi</a>
        </div>
    </section>
</div>

<?= $this->endSection() ?>