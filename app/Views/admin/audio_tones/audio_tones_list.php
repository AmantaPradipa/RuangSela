<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>
Manajemen Audio Tone
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/audio_tones_admin.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="page-container">
    <header class="page-header">
        <h1>Manajemen Audio Tone</h1>
        <a href="<?= site_url('admin/audio-tones/create') ?>" class="btn btn-primary"><i class="ri-add-line"></i> Tambah Audio Tone Baru</a>
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
            <h2>Daftar Audio Tone</h2>
        </div>
        <div class="filters d-flex flex-wrap gap-3 align-items-center">
            <div class="filter-item search-bar">
                <i class="ri-search-line"></i>
                <input type="text" class="form-control" placeholder="Cari Audio Tone...">
            </div>
            <select class="form-control">
                <option>Semua Status</option>
                <option>Publik</option>
                <option>Privat</option>
            </select>
            <button class="btn btn-secondary"><i class="ri-filter-3-line"></i> Filter</button>
        </div>
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Frekuensi (Hz)</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($audioTones)) : ?>
                        <?php foreach ($audioTones as $tone) : ?>
                            <tr>
                                <td>#AUD<?= esc($tone['id']) ?></td>
                                <td><?= esc($tone['title']) ?></td>
                                <td><?= esc($tone['frequency_hz']) ?></td>
                                <td>
                                    <?php if ($tone['is_public']) : ?>
                                        <span class="tag tag-green">Publik</span>
                                    <?php else : ?>
                                        <span class="tag tag-red">Privat</span>
                                    <?php endif; ?>
                                </td>
                                <td class="table-actions">
                                    <a href="<?= site_url('admin/audio-tones/edit/' . $tone['id']) ?>" title="Edit"><i class="ri-pencil-fill"></i></a>
                                    <form action="<?= site_url('admin/audio-tones/' . $tone['id']) ?>" method="post" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus Audio Tone ini?');">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn-icon" title="Hapus"><i class="ri-delete-bin-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5">Tidak ada Audio Tone yang ditemukan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="pagination">
            <a href="#"><i class="ri-arrow-left-s-line"></i></a>
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#"><i class="ri-arrow-right-s-line"></i></a>
        </div>
    </section>

</div>

<?= $this->endSection() ?>
