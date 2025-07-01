<?= $this->extend('layouts/therapist_layout') ?>

<?= $this->section('title') ?>
<?= esc($title) ?>
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/client_detail.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="page-container">
    <header class="page-header">
        <h1>Detail Klien: <?= esc($client['first_name'] . ' ' . $client['last_name']) ?></h1>
        <div class="breadcrumbs">
            <a href="<?= site_url('therapist/klien') ?>">Manajemen Klien</a> / <?= esc($client['first_name']) ?>
        </div>
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

    <div class="content-layout">
        <main class="content-main">
            <section class="card client-info-card">
                <div class="card-header">
                    <h2>Informasi Klien</h2>
                </div>
                <div class="client-profile-header">
                    <img src="<?= asset_url($client['profile_picture'], 'assets/images/avatars/default-avatar.png') ?>" alt="Foto Profil <?= esc($client['first_name']) ?>">
                    <div>
                        <p class="name"><?= esc($client['first_name'] . ' ' . $client['last_name']) ?></p>
                        <p class="email"><?= esc($client['email']) ?></p>
                    </div>
                </div>

                <div class="info-grid">
                    <div class="info-item">
                        <label>Username</label>
                        <p><?= esc($client['username']) ?></p>
                    </div>
                    <div class="info-item">
                        <label>Tanggal Bergabung</label>
                        <p><?= date('d M Y', strtotime($client['created_at'])) ?></p>
                    </div>
                    <div class="info-item">
                        <label>Nomor Telepon</label>
                        <p><?= esc($client['phone'] ?? 'N/A') ?></p>
                    </div>
                    <div class="info-item">
                        <label>Alamat</label>
                        <p><?= esc($client['address'] ?? 'N/A') ?></p>
                    </div>
                </div>
            </section>

            <section class="card appointments-card">
                <div class="card-header">
                    <h2>Riwayat Janji Temu</h2>
                </div>
                <?php if (!empty($appointments)) : ?>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Durasi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($appointments as $appointment) : ?>
                                <tr>
                                    <td><?= date('d M Y', strtotime($appointment->scheduled_at)) ?></td>
                                    <td><?= date('H:i', strtotime($appointment->scheduled_at)) ?></td>
                                    <td><?= esc($appointment->duration_minutes) ?> menit</td>
                                    <td><span class="badge badge-<?= esc($appointment->status) ?>"><?= esc($appointment->status) ?></span></td>
                                    <td><a href="#" class="link-arrow">Detail <i class="ri-arrow-right-s-line"></i></a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <p>Belum ada riwayat janji temu dengan klien ini.</p>
                <?php endif; ?>
            </section>
        </main>

        <aside class="content-sidebar">
            <section class="card progress-notes-card">
                <div class="card-header">
                    <h2>Catatan Kemajuan</h2>
                </div>
                <form action="<?= site_url('therapist/klien/save-note') ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="client_id" value="<?= esc($client['id']) ?>">
                    <input type="hidden" name="appointment_id" value="<?= esc($appointments[0]->id ?? '') ?>"> <!-- Assuming latest appointment for note -->
                    <div class="form-group">
                        <label for="note">Tambah Catatan Baru</label>
                        <textarea id="note" name="note" class="form-control" rows="5" placeholder="Tulis catatan kemajuan sesi..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Catatan</button>
                </form>

                <div class="notes-list">
                    <?php if (!empty($progressNotes)) : ?>
                        <?php foreach ($progressNotes as $note) : ?>
                            <div class="note-item">
                                <p class="note-date"><?= date('d M Y, H:i', strtotime($note->created_at)) ?></p>
                                <p class="note-content"><?= esc($note->note) ?></p>
                                <div class="note-actions">
                                    <a href="<?= site_url('therapist/klien/edit-note/' . $note->id) ?>" class="btn btn-sm btn-secondary">Edit</a>
                                    <form action="<?= site_url('therapist/klien/delete-note/' . $note->id) ?>" method="post" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus catatan ini?');">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>Belum ada catatan kemajuan untuk klien ini.</p>
                    <?php endif; ?>
                </div>
            </section>
        </aside>
    </div>
</div>

<?= $this->endSection() ?>
