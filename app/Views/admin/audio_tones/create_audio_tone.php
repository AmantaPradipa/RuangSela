<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>
Tambah Audio Tone Baru
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/audio_tones_admin.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/audio_tones_admin.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="page-container">

    <header class="page-header">
        <h1>Tambah Audio Tone Baru</h1>
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
        <form action="<?= site_url('admin/audio-tones/save') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="form-grid">
                <div class="form-group">
                    <label for="title">Judul</label>
                    <input type="text" id="title" name="title" class="form-control" value="<?= old('title') ?>" required>
                </div>
                <div class="form-group">
                    <label for="frequency_hz">Frekuensi (Hz)</label>
                    <input type="number" id="frequency_hz" name="frequency_hz" class="form-control" value="<?= old('frequency_hz') ?>" required>
                </div>
                <div class="form-group full-width">
                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description" class="form-control" rows="3"><?= old('description') ?></textarea>
                </div>
                <div class="form-group">
                    <label for="audio_file">File Audio</label>
                    <input type="file" id="audio_file" name="audio_file" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="is_public">Status Publik</label>
                    <select id="is_public" name="is_public" class="form-control" required>
                        <option value="1" <?= old('is_public') == '1' ? 'selected' : '' ?>>Publik</option>
                        <option value="0" <?= old('is_public') == '0' ? 'selected' : '' ?>>Privat</option>
                    </select>
                </div>
            </div>
            <div class="form-actions">
                <a href="<?= site_url('admin/audio-tones') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Audio Tone</button>
            </div>
        </form>
    </section>

</div>

<?= $this->endSection() ?>
