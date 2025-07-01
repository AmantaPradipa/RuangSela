<?= $this->extend('layouts/client_layout') ?>

<?= $this->section('title') ?>
Terapi Frekuensi Audio
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/frequency.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<!-- BAGIAN 1: HERO -->
<section class="audio-hero-section">
    <div class="audio-hero-container">
        <h1>Terapi <span class="highlight-text">Frekuensi Audio</span></h1>
        <p>Dengarkan frekuensi yang dirancang khusus untuk membantu relaksasi, meningkatkan fokus, dan menyeimbangkan kondisi mental Anda. Gunakan headphone untuk pengalaman terbaik.</p>
    </div>
</section>

<!-- BAGIAN 2: PILIHAN FREKUENSI -->
<section class="frequency-selection-section">
    <div class="frequency-container">
        <div class="frequency-grid">
            <?php if (!empty($tones) && is_array($tones)) : ?>
                <?php foreach ($tones as $tone) : ?>
                    <div class="frequency-card">
                        <div class="frequency-card-header">
                            <div class="frequency-info">
                                <div class="frequency-icon">
                                    <i class="<?= esc($tone['icon']) ?>"></i>
                                </div>
                                <div class="frequency-title">
                                    <h3><?= esc($tone['title']) ?></h3>
                                    <span><?= esc($tone['subtitle']) ?></span>
                                </div>
                            </div>
                            <button class="play-btn" data-src="<?= asset_url(esc($tone['file'])) ?>">
                                <i class="ri-play-circle-fill"></i>
                            </button>
                        </div>
                        <p class="description"><?= esc($tone['description']) ?></p>
                        <p class="duration-label">Pilih Durasi:</p>
                        <div class="duration-options">
                            <button class="duration-btn" data-duration="5">5 menit</button>
                            <button class="duration-btn" data-duration="10">10 menit</button>
                            <button class="duration-btn" data-duration="15">15 menit</button>
                            <button class="duration-btn active" data-duration="free">Bebas</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Tidak ada audio terapi yang tersedia saat ini.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- BAGIAN 3: TENTANG TERAPI -->
<section class="about-therapy-section">
    <div class="about-therapy-container">
        <h2>Tentang Terapi Frekuensi</h2>
        <p class="section-subtitle">Pahami bagaimana gelombang suara dapat memengaruhi pikiran dan tubuh Anda.</p>
        <div class="about-content">
            <div class="about-left">
                <h3>Apa itu Terapi Frekuensi?</h3>
                <p>Terapi frekuensi audio, atau *binaural beats* dan *isochronic tones*, adalah metode yang menggunakan gelombang suara dengan frekuensi spesifik untuk merangsang otak. Tujuannya adalah untuk mendorong otak memasuki keadaan tertentu, seperti relaksasi, fokus, atau tidur nyenyak.</p>
            </div>
            <div class="about-right">
                <h3>Manfaat Utama</h3>
                <ul class="info-list">
                    <li>Membantu meredakan stres dan kecemasan.</li>
                    <li>Meningkatkan kualitas tidur dan relaksasi.</li>
                    <li>Meningkatkan fokus dan konsentrasi.</li>
                    <li>Menyeimbangkan energi dalam tubuh.</li>
                    <li>Mendukung meditasi dan mindfulness.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script src="<?= base_url('assets/js/components/audio_player.js') ?>"></script>
<?= $this->endSection() ?>