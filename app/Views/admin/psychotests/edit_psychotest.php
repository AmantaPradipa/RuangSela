<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>
Edit Psikotes
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/psychotest_admin.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="page-container">

    <header class="page-header">
        <h1>Edit Psikotes</h1>
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
        <form action="<?= site_url('admin/psychotests/update/' . $psychotest->id) ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">
            <div class="form-grid">
                <div class="form-group full-width">
                    <label for="title">Judul Psikotes</label>
                    <input type="text" id="title" name="title" class="form-control" value="<?= old('title', $psychotest->title) ?>" required>
                </div>
                <div class="form-group full-width">
                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description" class="form-control" rows="5"><?= old('description', $psychotest->description) ?></textarea>
                </div>
                <div class="form-group">
                    <label for="is_active">Status Aktif</label>
                    <select id="is_active" name="is_active" class="form-control" required>
                        <option value="1" <?= old('is_active', $psychotest->is_active) == '1' ? 'selected' : '' ?>>Aktif</option>
                        <option value="0" <?= old('is_active', $psychotest->is_active) == '0' ? 'selected' : '' ?>>Nonaktif</option>
                    </select>
                </div>
            </div>
            <div class="form-actions">
                <a href="<?= site_url('admin/psychotests') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </section>

    <section class="card">
        <div class="section-header">
            <h2>Pertanyaan Psikotes</h2>
            <a href="<?= site_url('admin/psychotests/manage-questions/' . $psychotest->id) ?>" class="btn btn-primary btn-sm"><i class="ri-add-line"></i> Kelola Pertanyaan</a>
        </div>
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pertanyaan</th>
                        <th>Urutan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="questions-table-body">
                    <?php if (!empty($questions)) : ?>
                        <?php foreach ($questions as $question) : ?>
                            <tr>
                                <td>#Q<?= esc($question->id) ?></td>
                                <td><?= esc($question->question_text) ?></td>
                                <td><?= esc($question->question_order) ?></td>
                                <td class="table-actions">
                                    <a href="<?= site_url('admin/psychotests/questions/edit/' . $question->id) ?>" title="Edit"><i class="ri-pencil-fill"></i></a>
                                    <form action="<?= site_url('admin/psychotests/questions/delete/' . $question->id) ?>" method="post" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pertanyaan ini?');">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn-icon" title="Hapus"><i class="ri-delete-bin-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="4">Tidak ada pertanyaan yang ditemukan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>

</div>

<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script src="<?= base_url('assets/js/pages/admin_psychotest_detail.js') ?>"></script>
<?= $this->endSection() ?>
