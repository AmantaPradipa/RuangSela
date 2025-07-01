document.addEventListener('DOMContentLoaded', function() {
    let currentAudio = null;
    let timeoutId = null;

    const playButtons = document.querySelectorAll('.play-btn');
    const durationButtons = document.querySelectorAll('.duration-btn');

    function stopCurrentAudio() {
        if (currentAudio) {
            currentAudio.pause();
            currentAudio.currentTime = 0;
            const playingButton = document.querySelector('.play-btn .ri-pause-circle-fill');
            if (playingButton) {
                playingButton.classList.remove('ri-pause-circle-fill');
                playingButton.classList.add('ri-play-circle-fill');
            }
        }
        if (timeoutId) {
            clearTimeout(timeoutId);
            timeoutId = null;
        }
    }

    playButtons.forEach(button => {
        button.addEventListener('click', function() {
            const audioSrc = this.dataset.src;
            const icon = this.querySelector('i');

            if (currentAudio && currentAudio.src === audioSrc) {
                // Same audio, toggle play/pause
                if (currentAudio.paused) {
                    currentAudio.play();
                    icon.classList.remove('ri-play-circle-fill');
                    icon.classList.add('ri-pause-circle-fill');
                } else {
                    stopCurrentAudio();
                }
            } else {
                // Different audio, stop current and play new
                stopCurrentAudio();

                currentAudio = new Audio(audioSrc);
                currentAudio.play();
                icon.classList.remove('ri-play-circle-fill');
                icon.classList.add('ri-pause-circle-fill');

                // Reset active duration button
                durationButtons.forEach(btn => btn.classList.remove('active'));
                this.closest('.frequency-card').querySelector('.duration-btn[data-duration="free"]').classList.add('active');
            }
        });
    });

    durationButtons.forEach(button => {
        button.addEventListener('click', function() {
            const card = this.closest('.frequency-card');
            const playBtn = card.querySelector('.play-btn');
            const audioSrc = playBtn.dataset.src;
            const duration = this.dataset.duration;

            // Deactivate all duration buttons in this card
            card.querySelectorAll('.duration-btn').forEach(btn => btn.classList.remove('active'));
            // Activate clicked button
            this.classList.add('active');

            stopCurrentAudio(); // Stop any currently playing audio

            if (duration !== 'free') {
                currentAudio = new Audio(audioSrc);
                currentAudio.play();
                playBtn.querySelector('i').classList.remove('ri-play-circle-fill');
                playBtn.querySelector('i').classList.add('ri-pause-circle-fill');

                timeoutId = setTimeout(() => {
                    stopCurrentAudio();
                    alert('Sesi audio ' + duration + ' menit telah berakhir.');
                }, parseInt(duration) * 60 * 1000); // Convert minutes to milliseconds
            }
        });
    });
});