<?= $this->extend('layouts/client_layout') ?>

<?= $this->section('title') ?>
Detail Tiket Dukungan
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/ticket_detail.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="page-container">

    <header class="page-header">
        <h1>Detail Tiket Dukungan #<?= esc($ticket['id']) ?></h1>
        <div class="breadcrumbs">
            <a href="<?= site_url('client/support') ?>">Tiket Dukungan</a> / #<?= esc($ticket['id']) ?>
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

        <!-- Main Content Area -->
        <main class="content-main">
            <section class="card">
                <div class="card-header">
                    <h2>Informasi Tiket</h2>
                </div>
                <div class="info-grid">
                    <div class="info-item">
                        <label>Subjek</label>
                        <p><?= esc($ticket['subject']) ?></p>
                    </div>
                    <div class="info-item">
                        <label>Pelapor</label>
                        <p><?= esc($user['first_name'] . ' ' . $user['last_name']) ?> (<?= esc($user['email']) ?>)</p>
                    </div>
                    <div class="info-item">
                        <label>Kategori</label>
                        <p><span class="tag tag-blue"><?= esc($ticket['category']) ?></span></p>
                    </div>
                    <div class="info-item">
                        <label>Prioritas</label>
                        <p>
                            <?php if ($ticket['priority'] === 'high') : ?>
                                <span class="tag tag-red">Tinggi</span>
                            <?php elseif ($ticket['priority'] === 'medium') : ?>
                                <span class="tag tag-yellow">Sedang</span>
                            <?php else : ?>
                                <span class="tag tag-green">Rendah</span>
                            <?php endif; ?>
                        </p>
                    </div>
                    <div class="info-item full-width">
                        <label>Deskripsi</label>
                        <p><?= esc($ticket['description']) ?></p>
                    </div>
                </div>
            </section>

            <section class="card">
                <div class="card-header">
                    <h2>Riwayat Respon</h2>
                </div>
                <div class="response-list">
                    <?php if (!empty($responses)) : ?>
                        <?php foreach ($responses as $response) : ?>
                            <div class="response-item <?= ($response['user_id'] == session()->get('user_id')) ? 'admin-response' : 'user-response' ?>">
                                <div class="response-header">
                                    <span class="author"><?= ($response['user_id'] == session()->get('user_id')) ? 'Anda' : 'Pengguna' ?></span>
                                    <span class="date"><?= date('d M Y, H:i', strtotime($response['created_at'])) ?></span>
                                </div>
                                <p class="message"><?= esc($response['message']) ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p class="text-center text-muted">Belum ada respon untuk tiket ini.</p>
                    <?php endif; ?>
                </div>
            </section>
        </main>

        <!-- Sidebar with Actions -->
        <aside class="content-sidebar">
            <div class="card">
                <div class="card-header">
                    <h2>Aksi Tiket</h2>
                </div>

                <div class="info-item" style="margin-bottom: 20px;">
                    <label>Status Saat Ini</label>
                    <?php if ($ticket['status'] === 'open') : ?>
                        <span class="tag tag-yellow">Open</span>
                    <?php elseif ($ticket['status'] === 'in_progress') : ?>
                        <span class="tag tag-blue">In Progress</span>
                    <?php elseif ($ticket['status'] === 'resolved') : ?>
                        <span class="tag tag-green">Resolved</span>
                    <?php else : ?>
                        <span class="tag tag-grey">Closed</span>
                    <?php endif; ?>
                </div>

                <form action="<?= site_url('client/support/update-status/' . $ticket['id']) ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="status">Ubah Status</label>
                        <select id="status" name="status" class="form-control">
                            <option value="open" <?= ($ticket['status'] === 'open') ? 'selected' : '' ?>>Open</option>
                            <option value="in_progress" <?= ($ticket['status'] === 'in_progress') ? 'selected' : '' ?>>In Progress</option>
                            <option value="resolved" <?= ($ticket['status'] === 'resolved') ? 'selected' : '' ?>>Resolved</option>
                            <option value="closed" <?= ($ticket['status'] === 'closed') ? 'selected' : '' ?>>Closed</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="priority">Ubah Prioritas</label>
                        <select id="priority" name="priority" class="form-control">
                            <option value="low" <?= ($ticket['priority'] === 'low') ? 'selected' : '' ?>>Low</option>
                            <option value="medium" <?= ($ticket['priority'] === 'medium') ? 'selected' : '' ?>>Medium</option>
                            <option value="high" <?= ($ticket['priority'] === 'high') ? 'selected' : '' ?>>High</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="response_message">Tambahkan Respon</label>
                        <textarea id="response_message" name="response_message" class="form-control" rows="4" placeholder="Tulis respon Anda di sini..."></textarea>
                    </div>
                    <div class="action-buttons">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </aside>
    </div>
</div>

<?= $this->endSection() ?>