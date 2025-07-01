<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>
Edit Audio Tone
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/audio_tones_admin.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="page-container">

    <header class="page-header">
        <h1>Edit Audio Tone</h1>
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
        <form action="<?= site_url('admin/audio-tones/update/' . $audioTone['id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">
            <div class="form-grid">
                <div class="form-group">
                    <label for="title">Judul</label>
                    <input type="text" id="title" name="title" class="form-control" value="<?= old('title', $audioTone['title']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="frequency_hz">Frekuensi (Hz)</label>
                    <input type="number" id="frequency_hz" name="frequency_hz" class="form-control" value="<?= old('frequency_hz', $audioTone['frequency_hz']) ?>" required>
                </div>
                <div class="form-group full-width">
                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description" class="form-control" rows="3"><?= old('description', $audioTone['description']) ?></textarea>
                </div>
                <div class="form-group">
                    <label for="audio_file">File Audio</label>
                    <?php if (!empty($audioTone['file_path'])) : ?>
                        <p>File saat ini: <a href="<?= asset_url($audioTone['file_path']) ?>" target="_blank">Lihat File</a></p>
                    <?php endif; ?>
                    <input type="file" id="audio_file" name="audio_file" class="form-control">
                </div>
                <div class="form-group">
                    <label for="is_public">Status Publik</label>
                    <select id="is_public" name="is_public" class="form-control" required>
                        <option value="1" <?= old('is_public', $audioTone['is_public']) == '1' ? 'selected' : '' ?>>Publik</option>
                        <option value="0" <?= old('is_public', $audioTone['is_public']) == '0' ? 'selected' : '' ?>>Privat</option>
                    </select>
                </div>
            </div>
            <div class="form-actions">
                <a href="<?= site_url('admin/audio-tones') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </section>

</div>

<?= $this->endSection() ?>
