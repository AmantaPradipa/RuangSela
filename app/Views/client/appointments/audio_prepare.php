<?= $this->extend('layouts/client_layout') ?>

<?= $this->section('title') ?>
Persiapan Sesi
<?= $this->endSection() ?>

<?= $this->section('pageStyles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/pages/audio_prepare.css') ?>">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="page-container">
    <header class="page-header">
        <h1>Persiapan Sesi Konsultasi</h1>
        <p>Sesi Anda dengan Dr. [Nama Terapis] akan segera dimulai. Dengarkan audio ini untuk relaksasi.</p>
    </header>

    <section class="card audio-prepare-card">
        <div class="audio-player-container">
            <audio id="preparation-audio" src="<?= esc($audio_file) ?>" preload="auto" loop></audio>
            <div class="controls">
                <button id="play-pause-btn"><i class="ri-play-fill"></i></button>
                <div class="progress-bar-wrapper">
                    <div id="progress-bar"></div>
                </div>
                <span id="time-display">00:00 / 00:00</span>
            </div>
        </div>
        <p class="audio-description">Audio frekuensi 432 Hz ini dirancang untuk membantu Anda rileks dan fokus sebelum sesi konsultasi.</p>
        <div class="countdown-timer">
            Sesi dimulai dalam: <span id="countdown"></span>
        </div>
        <a href="<?= site_url('client/appointments/join/' . $appointment->id) ?>" class="btn btn-primary btn-lg mt-4" id="join-session-btn" style="display:none;">Gabung Sesi Sekarang</a>
    </section>
</div>

<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const audio = document.getElementById('preparation-audio');
        const playPauseBtn = document.getElementById('play-pause-btn');
        const progressBar = document.getElementById('progress-bar');
        const timeDisplay = document.getElementById('time-display');
        const countdownSpan = document.getElementById('countdown');
        const joinSessionBtn = document.getElementById('join-session-btn');

        let countdownInterval;

        // Set session start time (replace with actual appointment time from backend)
        const sessionStartTime = new Date("<?= esc($appointment->scheduled_at) ?>").getTime();

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = sessionStartTime - now;

            const minutes = Math.floor((distance %% (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance %% (1000 * 60)) / 1000);

            if (distance < 0) {
                clearInterval(countdownInterval);
                countdownSpan.textContent = "Sesi telah dimulai!";
                joinSessionBtn.style.display = 'block';
                audio.pause();
                playPauseBtn.disabled = true;
            } else {
                countdownSpan.textContent = minutes + "m " + seconds + "s ";
            }
        }

        // Initial call and set interval
        updateCountdown();
        countdownInterval = setInterval(updateCountdown, 1000);

        playPauseBtn.addEventListener('click', () => {
            if (audio.paused) {
                audio.play();
                playPauseBtn.innerHTML = '<i class="ri-pause-fill"></i>';
            } else {
                audio.pause();
                playPauseBtn.innerHTML = '<i class="ri-play-fill"></i>';
            }
        });

        audio.addEventListener('timeupdate', () => {
            const progress = (audio.currentTime / audio.duration) * 100;
            progressBar.style.width = progress + '%';

            const currentMinutes = Math.floor(audio.currentTime / 60);
            const currentSeconds = Math.floor(audio.currentTime %% 60);
            const durationMinutes = Math.floor(audio.duration / 60);
            const durationSeconds = Math.floor(audio.duration %% 60);

            timeDisplay.textContent = 
                `${String(currentMinutes).padStart(2, '0')}:${String(currentSeconds).padStart(2, '0')} / ` +
                `${String(durationMinutes).padStart(2, '0')}:${String(durationSeconds).padStart(2, '0')}`;
        });

        audio.addEventListener('ended', () => {
            playPauseBtn.innerHTML = '<i class="ri-play-fill"></i>';
            progressBar.style.width = '0%';
            timeDisplay.textContent = '00:00 / 00:00';
        });
    });
</script>
<?= $this->endSection() ?>