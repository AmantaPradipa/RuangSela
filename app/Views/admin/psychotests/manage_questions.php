<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>
Kelola Pertanyaan Psikotes
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/psychotest_admin.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="page-container">

    <header class="page-header">
        <h1>Kelola Pertanyaan untuk Psikotes: <?= esc($psychotest->title) ?></h1>
        <a href="<?= site_url('admin/psychotests/questions/create/' . $psychotest->id) ?>" class="btn btn-primary"><i class="ri-add-line"></i> Tambah Pertanyaan Baru</a>
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
            <h2>Daftar Pertanyaan</h2>
        </div>
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pertanyaan</th>
                        <th>Tipe</th>
                        <th>Urutan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($questions)) : ?>
                        <?php foreach ($questions as $question) : ?>
                            <tr>
                                <td>#Q<?= esc($question->id) ?></td>
                                <td><?= esc($question->question_text) ?></td>
                                <td><?= esc($question->question_type) ?></td>
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
                            <td colspan="5">Tidak ada pertanyaan yang ditemukan untuk psikotes ini.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>

</div>

<?= $this->endSection() ?>