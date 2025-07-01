<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('title') ?>
Manajemen Paket Konsultasi
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/package_management.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="page-container">

    <header class="page-header">
        <h1>Manajemen Paket Konsultasi</h1>
        <a href="<?= site_url('admin/packages/create') ?>" class="btn btn-primary"><i class="ri-add-line"></i> Tambah Paket Baru</a>
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
            <h2>Daftar Paket</h2>
        </div>
        <div class="package-grid">
            <?php if (!empty($packages)) : ?>
                <?php foreach ($packages as $package) : ?>
                    <div class="package-card">
                        <h3><?= esc($package['name']) ?></h3>
                        <p class="price">Rp <?= number_format($package['price'], 0, ',', '.') ?></p>
                        <p class="description"><?= esc($package['description']) ?></p>
                        <ul>
                            <?php if (!empty($package['features']) && is_array($package['features'])) : ?>
                                <?php foreach ($package['features'] as $feature) : ?>
                                    <li><i class="ri-check-line"></i> <?= esc($feature) ?></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                        <div class="actions">
                            <a href="<?= site_url('admin/packages/edit/' . $package['id']) ?>" class="btn btn-edit"><i class="ri-edit-2-line"></i> Edit</a>
                            <form action="<?= site_url('admin/packages/' . $package['id']) ?>" method="post" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket ini?');">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-delete"><i class="ri-delete-bin-2-line"></i> Hapus</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-center text-muted">Tidak ada paket yang ditemukan.</p>
            <?php endif; ?>
        </div>
    </section>

</div>

<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script src="<?= base_url('assets/js/pages/admin_packages.js') ?>"></script>
<?= $this->endSection() ?>
