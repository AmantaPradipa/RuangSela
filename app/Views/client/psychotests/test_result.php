<?= $this->extend('layouts/client_layout') ?>

<?= $this->section('title') ?>
Hasil Psikotes
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/test_result.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="page-container">
    <div class="result-card card">
        <div class="result-header">
            <i class="ri-check-double-line"></i>
            <h1>Hasil Psikotes Anda</h1>
            <p class="subtitle">Tes: <?= esc($psychotest->title) ?></p>
        </div>

        <div class="result-summary">
            <h2>Ringkasan Hasil</h2>
            <p><?= esc($testResult['result_summary']) ?></p>
        </div>

        <div class="score-details">
            <div class="score-item">
                <h3>Total Skor</h3>
                <p class="score-value"><?= esc($testResult['total_score']) ?></p>
            </div>
            <div class="score-item">
                <h3>Tanggal Tes</h3>
                <p class="score-value"><?= date('d M Y', strtotime($testResult['taken_at'])) ?></p>
            </div>
        </div>

        <div class="action-buttons">
            <a href="<?= site_url('client/psikotes') ?>" class="btn btn-secondary">Kembali ke Daftar Tes</a>
            <a href="<?= site_url('client/dashboard') ?>" class="btn btn-primary">Kembali ke Dashboard</a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
