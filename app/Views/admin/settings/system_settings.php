<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>
Pengaturan Sistem
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/system_settings.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="page-container">

    <header class="page-header">
        <h1>Pengaturan Sistem</h1>
        <p class="subtitle">Kelola semua pengaturan platform RuangSela</p>
    </header>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="content-tabs">
        <nav>
            <a href="#" class="active">Umum</a>
            <a href="#">Konten</a>
            <a href="#">Rules</a>
            <a href="#">Notifikasi</a>
            <a href="#">Keamanan</a>
        </nav>
    </div>

    <!-- Section: Daftar Pengaturan -->
    <section class="card">
        <div class="section-header">
            <h2>Daftar Pengaturan</h2>
            <a href="#" class="btn btn-primary"><i class="ri-add-line"></i> Tambah Pengaturan</a>
        </div>
        <div class="filters d-flex flex-wrap gap-3 align-items-center">
            <div class="filter-item search-bar">
                <i class="ri-search-line"></i>
                <input type="text" class="form-control" placeholder="Cari pengaturan...">
            </div>
            <select class="form-control">
                <option>Semua Kategori</option>
                <option>Umum</option>
                <option>Konten</option>
                <option>Rules</option>
                <option>Notifikasi</option>
                <option>Keamanan</option>
            </select>
            <select class="form-control">
                <option>Semua Status</option>
                <option>Aktif</option>
                <option>Nonaktif</option>
            </select>
            <button class="btn btn-secondary"><i class="ri-filter-3-line"></i> Filter</button>
        </div>
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID Pengaturan</th>
                        <th>Nama Pengaturan</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Terakhir Diperbarui</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($settings)) : ?>
                        <?php foreach ($settings as $setting) : ?>
                            <tr>
                                <td><?= esc($setting['setting_key']) ?></td>
                                <td><?= esc($setting['description']) ?></td>
                                <td><span class="tag tag-blue">Umum</span></td> <!-- TODO: Dynamic category -->
                                <td>
                                    <?php if ($setting['setting_value'] === '1') : ?>
                                        <span class="tag tag-green">Aktif</span>
                                    <?php else : ?>
                                        <span class="tag tag-red">Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= date('d M Y', strtotime($setting['updated_at'])) ?></td>
                                <td class="table-actions">
                                    <a href="#" title="Edit" onclick=""><i class="ri-pencil-fill"></i></a>
                                    <form action="<?= site_url('admin/settings/' . $setting['setting_key']) ?>" method="post" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengaturan ini?');">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn-icon" title="Hapus"><i class="ri-delete-bin-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6">Tidak ada pengaturan yang ditemukan.</td>
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

    <!-- Section: Tambah/Edit Pengaturan -->
    <section class="card">
        <div class="card-header">
            <h2>Tambah/Edit Pengaturan</h2>
        </div>
        <form action="<?= site_url('admin/settings/save') ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-grid">
                <div class="form-group">
                    <label for="setting-key">Kunci Pengaturan</label>
                    <input type="text" id="setting-key" name="setting_key" class="form-control" placeholder="Contoh: app_name" value="<?= old('setting_key') ?>">
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <input type="text" id="description" name="description" class="form-control" placeholder="Deskripsi singkat pengaturan" value="<?= old('description') ?>">
                </div>
            </div>
            <div class="form-group full-width">
                <label for="setting-value">Nilai Pengaturan</label>
                <textarea id="setting-value" name="setting_value" class="form-control" rows="3" placeholder="Masukkan nilai pengaturan"><?= old('setting_value') ?></textarea>
            </div>
            <div class="form-actions">
                <button type="button" class="btn btn-secondary">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
            </div>
        </form>
    </section>

</div>

<?= $this->endSection() ?>
