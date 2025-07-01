<?= $this->extend('layouts/therapist_layout') ?>

<?= $this->section('title') ?>
Kelola Jadwal - RuangSela Terapis
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/schedule.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/schedule.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="page-layout">
    <main class="main-content">
        <header class="main-header">
            <h1>Kelola Jadwal Anda</h1>
            <p>Atur ketersediaan Anda untuk sesi konsultasi.</p>
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

        <div class="card">
            <h2 class="section-title">Jadwal Ketersediaan Mingguan</h2>
            <form action="<?= site_url('therapist/schedule/save') ?>" method="post">
                <?= csrf_field() ?>
                <div class="schedule-form-grid">
                    <div class="form-group">
                        <label for="day_of_week">Hari</label>
                        <select id="day_of_week" name="day_of_week" class="form-control" required>
                            <option value="">Pilih Hari</option>
                            <option value="Monday">Senin</option>
                            <option value="Tuesday">Selasa</option>
                            <option value="Wednesday">Rabu</option>
                            <option value="Thursday">Kamis</option>
                            <option value="Friday">Jumat</option>
                            <option value="Saturday">Sabtu</option>
                            <option value="Sunday">Minggu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="start_time">Waktu Mulai</label>
                        <input type="time" id="start_time" name="start_time" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="end_time">Waktu Selesai</label>
                        <input type="time" id="end_time" name="end_time" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="is_available">Status</label>
                        <select id="is_available" name="is_available" class="form-control" required>
                            <option value="1">Tersedia</option>
                            <option value="0">Tidak Tersedia</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Jadwal</button>
            </form>
        </div>

        <div class="card">
            <h2 class="section-title">Jadwal Tersimpan</h2>
            <?php if (!empty($schedules)) : ?>
                <table class="schedule-table">
                    <thead>
                        <tr>
                            <th>Hari</th>
                            <th>Waktu</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($schedules as $schedule) : ?>
                            <tr>
                                <td><?= esc($schedule->day_of_week) ?></td>
                                <td><?= esc($schedule->start_time) ?> - <?= esc($schedule->end_time) ?></td>
                                <td>
                                    <?php if ($schedule->is_available) : ?>
                                        <span class="badge badge-green">Tersedia</span>
                                    <?php else : ?>
                                        <span class="badge badge-red">Tidak Tersedia</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= site_url('therapist/schedule/delete/' . $schedule->id) ?>" class="btn btn-danger btn-sm">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p>Belum ada jadwal yang tersimpan.</p>
            <?php endif; ?>
        </div>
    </main>

    <aside class="sidebar">
        <div class="card">
            <h2 class="section-title">Ringkasan Jadwal</h2>
            <p>Gunakan halaman ini untuk mengatur kapan Anda tersedia untuk sesi konsultasi. Klien hanya dapat membuat janji temu pada waktu yang Anda tandai sebagai 'Tersedia'.</p>
            <ul class="summary-list">
                <li><i class="ri-calendar-check-line"></i> Total Hari Tersedia: <span><?= count(array_filter($schedules, function($s){ return $s->is_available == 1; })) ?></span></li>
                <li><i class="ri-time-line"></i> Total Jam Tersedia: <span><?= array_sum(array_map(function($s){ return $s->is_available ? (strtotime($s->end_time) - strtotime($s->start_time))/3600 : 0; }, $schedules)) ?> jam</span></li>
            </ul>
        </div>

        <div class="card">
            <h2 class="section-title">Tips Mengelola Jadwal</h2>
            <ul class="tips-list">
                <li>Perbarui jadwal secara berkala untuk menghindari bentrok.</li>
                <li>Blokir waktu untuk istirahat dan kegiatan pribadi.</li>
                <li>Pertimbangkan zona waktu klien jika Anda melayani secara global.</li>
            </ul>
        </div>
    </aside>
</div>

<?= $this->endSection() ?>