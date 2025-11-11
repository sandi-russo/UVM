document.addEventListener('DOMContentLoaded', () => {

    // Selettori per gli elementi del player
    const ui = {
        cover: document.getElementById('episode-cover'),
        title: document.getElementById('episode-title'),
        date: document.getElementById('episode-date'),
        spotifyLink: document.getElementById('spotify-link'),
        playPauseBtn: document.getElementById('play-pause-btn'),
        progressSlider: document.getElementById('progress-slider'),
        currentTime: document.getElementById('current-time'),
        duration: document.getElementById('duration'),
        scrollContainer: document.querySelector('.scroll-container')
    };

    // Verifica che tutti gli elementi esistano prima di procedere
    if (!ui.cover) {
        return; // Player non presente in questa pagina
    }

    // --- VARIABILI ---
    let isPlaying = false;
    const audio = new Audio(); // Questa è l'istanza audio SOLO per Spotify

    // --- ICONE SVG PER IL PULSANTE PLAY/PAUSA ---
    const icons = {
        play: `<svg class="play-icon" viewBox="0 0 24 24" fill="currentColor"><path d="M18.54 9L8.88 3.46a3.42 3.42 0 0 0-5.13 3v11.12A3.42 3.42 0 0 0 7.17 21a3.43 3.43 0 0 0 1.71-.46L18.54 15a3.42 3.42 0 0 0 0-5.92Zm-1 4.19l-9.66 5.62a1.44 1.44 0 0 1-1.42 0a1.42 1.42 0 0 1-.71-1.23V6.42a1.42 1.42 0 0 1 .71-1.23A1.5 1.5 0 0 1 7.17 5a1.54 1.54 0 0 1 .71.19l9.66 5.58a1.42 1.42 0 0 1 0 2.46Z"/></svg>`,
        pause: `<svg class="play-icon" viewBox="0 0 24 24" fill="currentColor"><g fill="currentColor"><rect width="4" height="14" x="6" y="5" rx="1"/><rect width="4" height="14" x="14" y="5" rx="1"/></g></svg>`
    };

    /**
     * Aggiorna la UI con i dati dell'episodio.
     */
    function updateUI(episode) {
        if (!episode) return;

        ui.cover.src = episode.images[0].url;
        ui.title.textContent = episode.name;
        ui.date.textContent = new Date(episode.release_date).toLocaleDateString('it-IT', { day: '2-digit', month: 'long', year: 'numeric' });
        ui.spotifyLink.href = episode.external_urls.spotify;

        // Controlla se l'URL dell'anteprima esiste
        if (episode.audio_preview_url) {
            audio.src = episode.audio_preview_url;
        } else {
            // Disabilita il player se non c'è anteprima
            ui.playPauseBtn.disabled = true;
            ui.progressSlider.disabled = true;
            ui.duration.textContent = "N/D";
            ui.playPauseBtn.style.opacity = '0.5';
            ui.playPauseBtn.style.cursor = 'not-allowed';
            console.warn("Anteprima audio non disponibile per questo episodio.");
        }

        checkTitleOverflow();
    }

    /**
     * Gestisce i controlli audio.
     */
    function setupAudioControls() {
        audio.addEventListener('loadedmetadata', () => {
            ui.progressSlider.max = audio.duration;
            ui.duration.textContent = formatTime(audio.duration);
        });

        audio.addEventListener('timeupdate', () => {
            ui.progressSlider.value = audio.currentTime;
            ui.currentTime.textContent = formatTime(audio.currentTime);
        });

        audio.addEventListener('ended', () => {
            forceState(false); // Forza lo stato di pausa
        });

        ui.progressSlider.addEventListener('input', () => {
            audio.currentTime = ui.progressSlider.value;
        });

        ui.playPauseBtn.addEventListener('click', togglePlayPause);
    }

    /**
     * Logica Play/Pausa (corretta)
     */
    function togglePlayPause() {
        if (ui.playPauseBtn.disabled) return;

        // Invertiamo lo stato
        isPlaying = !isPlaying;

        if (isPlaying) {
            // Se deve suonare, avvialo
            audio.play().catch(err => {
                // Se fallisce (es. autoplay bloccato), resetta lo stato
                console.error("Errore riproduzione:", err);
                forceState(false);
            });
            ui.playPauseBtn.innerHTML = icons.pause;
        } else {
            // Se deve andare in pausa
            audio.pause();
            ui.playPauseBtn.innerHTML = icons.play;
        }
    }

    /**
     * Forza uno stato specifico (play/pausa)
     * Usato per l'evento 'ended'
     */
    function forceState(playing) {
        isPlaying = playing;
        if (playing) {
            audio.play();
            ui.playPauseBtn.innerHTML = icons.pause;
        } else {
            audio.pause();
            ui.playPauseBtn.innerHTML = icons.play;
            ui.progressSlider.value = 0;
            ui.currentTime.textContent = "0:00";
        }
    }

    /**
     * Formatta il tempo da secondi a min:sec.
     */
    function formatTime(seconds) {
        const minutes = Math.floor(seconds / 60);
        const remainingSeconds = Math.floor(seconds % 60);
        return `${minutes}:${remainingSeconds.toString().padStart(2, '0')}`;
    }

    /**
     * Controlla se il titolo è troppo lungo.
     */
    function checkTitleOverflow() {
        ui.title.classList.remove('scroll');
        void ui.title.offsetWidth;

        if (ui.title.scrollWidth > ui.scrollContainer.offsetWidth) {
            const scrollAmount = ui.title.scrollWidth - ui.scrollContainer.offsetWidth;
            ui.scrollContainer.style.setProperty('--scroll-width', `${scrollAmount}px`);
            ui.title.classList.add('scroll');
        }
    }

    /**
     * Funzione principale per inizializzare il player.
     */
    async function initPlayer() {
        try {
            // Chiama il nostro endpoint sicuro in PHP
            const response = await fetch('/wp-json/universome/v1/latest-episode');
            if (!response.ok) throw new Error(`Errore HTTP: ${response.status}`);
            const episode = await response.json();

            if (episode) {
                updateUI(episode);
                setupAudioControls();
            } else {
                ui.title.textContent = 'Episodio non trovato.';
            }
        } catch (error) {
            console.error('Errore nel caricamento del player Spotify:', error);
            ui.title.textContent = 'Errore nel caricamento.';
        }
    }

    // Inizializza il player
    initPlayer();

    window.addEventListener('resize', checkTitleOverflow);
});