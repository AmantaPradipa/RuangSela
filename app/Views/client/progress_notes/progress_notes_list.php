<?= $this->extend('layouts/client_layout') ?>

<?= $this->section('title') ?>
Catatan Kemajuan
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/client_detail.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="page-container">
    <header class="page-header">
        <h1>Catatan Kemajuan Anda</h1>
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
            <h2>Daftar Catatan</h2>
        </div>
        <div class="notes-list">
            <?php if (!empty($progressNotes)) : ?>
                <?php foreach ($progressNotes as $note) : ?>
                    <div class="note-item">
                        <p class="note-date">Dari Terapis: <?= esc($note['therapist_name']) ?> pada <?= date('d M Y, H:i', strtotime($note['created_at'])) ?></p>
                        <p class="note-content"><?= esc($note['note']) ?></p>
                        <?php if (!empty($note['appointment_date'])) : ?>
                            <p class="note-meta">Terkait Sesi Tanggal: <?= date('d M Y', strtotime($note['appointment_date'])) ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Belum ada catatan kemajuan dari terapis Anda.</p>
            <?php endif; ?>
        </div>
    </section>
</div>

<?= $this->endSection() ?>