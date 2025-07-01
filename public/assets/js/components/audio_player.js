document.addEventListener('DOMContentLoaded', function() {
    const audioPlayer = new Audio();
    let currentPlayingCard = null;
    let durationTimer = null;

    const frequencyCards = document.querySelectorAll('.frequency-card');

    frequencyCards.forEach(card => {
        const playBtn = card.querySelector('.play-btn');
        const audioSrc = playBtn.dataset.src;
        const durationButtons = card.querySelectorAll('.duration-btn');

        // Set 'Bebas' as active by default for each card
        const defaultFreeButton = card.querySelector('.duration-btn[data-duration="free"]');
        if (defaultFreeButton) {
            defaultFreeButton.classList.add('active');
        }

        // Handle Play/Pause Button
        playBtn.addEventListener('click', () => {
            if (currentPlayingCard === card && !audioPlayer.paused) {
                // Pause current audio
                audioPlayer.pause();
                clearTimeout(durationTimer);
            } else {
                // Stop any other audio
                if (currentPlayingCard && currentPlayingCard !== card) {
                    audioPlayer.pause();
                    clearTimeout(durationTimer);
                    // Reset UI of previously playing card
                    const prevPlayBtn = currentPlayingCard.querySelector('.play-btn');
                    if (prevPlayBtn) {
                        prevPlayBtn.classList.remove('playing');
                        prevPlayBtn.innerHTML = '<i class="ri-play-circle-fill"></i>';
                    }
                }
                
                // Play new audio
                audioPlayer.src = audioSrc;
                audioPlayer.play().catch(e => console.error("Audio play failed:", e));
                currentPlayingCard = card;

                // Set timer based on active duration
                const activeDurationBtn = card.querySelector('.duration-btn.active');
                if (activeDurationBtn) {
                    setDuration(activeDurationBtn.dataset.duration);
                }
            }
        });

        // Handle Duration Buttons
        durationButtons.forEach(button => {
            button.addEventListener('click', () => {
                durationButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');

                if (currentPlayingCard === card && !audioPlayer.paused) {
                    setDuration(button.dataset.duration);
                }
            });
        });
    });

    // Update UI based on audio player state
    audioPlayer.onplay = () => {
        if (currentPlayingCard) {
            const playBtn = currentPlayingCard.querySelector('.play-btn');
            playBtn.classList.add('playing');
            playBtn.innerHTML = '<i class="ri-pause-circle-fill"></i>';
        }
    };

    audioPlayer.onpause = () => {
        if (currentPlayingCard) {
            const playBtn = currentPlayingCard.querySelector('.play-btn');
            playBtn.classList.remove('playing');
            playBtn.innerHTML = '<i class="ri-play-circle-fill"></i>';
            // Don't reset currentPlayingCard here, to allow resume
        }
        clearTimeout(durationTimer);
    };

    audioPlayer.onended = () => {
        if (currentPlayingCard) {
            const playBtn = currentPlayingCard.querySelector('.play-btn');
            playBtn.classList.remove('playing');
            playBtn.innerHTML = '<i class="ri-play-circle-fill"></i>';
            currentPlayingCard = null;
        }
        clearTimeout(durationTimer);
    };

    function setDuration(durationMinutes) {
        clearTimeout(durationTimer);
        if (durationMinutes && durationMinutes !== 'free') {
            const durationMs = parseInt(durationMinutes) * 60 * 1000;
            durationTimer = setTimeout(() => {
                audioPlayer.pause();
            }, durationMs);
        }
    }

    // Stop audio when leaving the page
    window.addEventListener('beforeunload', () => {
        if (!audioPlayer.paused) {
            audioPlayer.pause();
        }
    });
});
