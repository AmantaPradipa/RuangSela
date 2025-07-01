<?= $this->extend('layouts/client_layout') ?>

<?= $this->section('title') ?>
Buat Janji Temu
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/book_appointment.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="page-container">
    <header class="page-header">
        <h1>Buat Janji Temu Baru</h1>
        <p>Pilih tanggal dan waktu yang tersedia untuk sesi konsultasi Anda.</p>
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

    <div class="content-layout">
        <main class="content-main">
            <section class="card">
                <div class="card-header">
                    <h2>Informasi Terapis</h2>
                </div>
                <?php if (!empty($therapist)) : ?>
                    <div class="therapist-info-card">
                        <img src="<?= asset_url($therapist->profile_picture, 'assets/images/avatars/default-avatar.png') ?>" alt="Foto Dr. <?= esc($therapist->first_name) ?>">
                        <div>
                            <h3>Dr. <?= esc($therapist->first_name . ' ' . $therapist->last_name) ?></h3>
                            <p><?= esc($therapist->expertise) ?></p>
                            <p>Pengalaman: <?= esc($therapist->experience_years) ?> Tahun</p>
                        </div>
                    </div>
                <?php else : ?>
                    <p>Silakan pilih terapis terlebih dahulu dari <a href="<?= site_url('terapis') ?>">daftar terapis</a>.</p>
                <?php endif; ?>
            </section>

            <?php if (!empty($therapist)) : ?>
                <section class="card">
                    <div class="card-header">
                        <h2>Pilih Tanggal & Waktu</h2>
                    </div>
                    <form action="<?= site_url('client/konsultasi/save') ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="therapist_id" value="<?= esc($therapist->id) ?>">
                        <input type="hidden" name="package_id" value="1"> <!-- TODO: Dynamic package selection -->

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="scheduled_date">Tanggal</label>
                                <input type="date" id="scheduled_date" name="scheduled_at" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="scheduled_time">Waktu</label>
                                <select id="scheduled_time" name="scheduled_time" class="form-control" required>
                                    <option value="">Pilih Waktu</option>
                                    <?php foreach ($schedules as $schedule) : ?>
                                        <option value="<?= esc($schedule->start_time) ?>"><?= esc($schedule->start_time) ?> - <?= esc($schedule->end_time) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="duration_minutes">Durasi (menit)</label>
                                <input type="number" id="duration_minutes" name="duration_minutes" class="form-control" value="60" required>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Konfirmasi Janji Temu</button>
                        </div>
                    </form>
                </section>
            <?php endif; ?>
        </main>

        <aside class="content-sidebar">
            <?php if (!empty($therapist)) : ?>
                <div class="card">
                    <div class="card-header">
                        <h2>Ringkasan Janji Temu</h2>
                    </div>
                    <p>Terapis: <?= esc($therapist->first_name . ' ' . $therapist->last_name) ?></p>
                    <p>Tanggal: <span id="summary_date">-</span></p>
                    <p>Waktu: <span id="summary_time">-</span></p>
                    <p>Durasi: <span id="summary_duration">-</span> menit</p>
                    <p>Metode: Video Call</p>
                </div>
            <?php endif; ?>
        </aside>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const scheduledDateInput = document.getElementById('scheduled_date');
        const scheduledTimeSelect = document.getElementById('scheduled_time');
        const durationMinutesInput = document.getElementById('duration_minutes');

        const summaryDateSpan = document.getElementById('summary_date');
        const summaryTimeSpan = document.getElementById('summary_time');
        const summaryDurationSpan = document.getElementById('summary_duration');

        function updateSummary() {
            summaryDateSpan.textContent = scheduledDateInput.value;
            summaryTimeSpan.textContent = scheduledTimeSelect.value;
            summaryDurationSpan.textContent = durationMinutesInput.value;
        }

        scheduledDateInput.addEventListener('change', updateSummary);
        scheduledTimeSelect.addEventListener('change', updateSummary);
        durationMinutesInput.addEventListener('input', updateSummary);

        updateSummary(); // Initial update
    });
</script>
<?= $this->endSection() ?>
