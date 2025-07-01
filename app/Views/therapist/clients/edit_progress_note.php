<?= $this->extend('layouts/therapist_layout') ?>

<?= $this->section('title') ?>
Edit Catatan Kemajuan
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/client_detail.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="page-container">
    <header class="page-header">
        <h1>Edit Catatan Kemajuan untuk Klien: <?= esc($client['first_name'] . ' ' . $client['last_name']) ?></h1>
        <div class="breadcrumbs">
            <a href="<?= site_url('therapist/klien') ?>">Manajemen Klien</a> / <a href="<?= site_url('therapist/klien/view/' . $client['id']) ?>">Detail Klien</a> / Edit Catatan
        </div>
    </header>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <section class="card">
        <form action="<?= site_url('therapist/klien/update-note/' . $note->id) ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="client_id" value="<?= esc($client['id']) ?>">
            <div class="form-group full-width">
                <label for="note">Catatan Kemajuan</label>
                <textarea id="note" name="note" class="form-control" rows="10" required><?= old('note', $note->note) ?></textarea>
            </div>
            <div class="form-actions">
                <a href="<?= site_url('therapist/klien/view/' . $client['id']) ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </section>
</div>

<?= $this->endSection() ?>