<?php
/**
 * The sidebar containing the main widget area.
 * On mobile, it transforms into an accordion.
 */
?>

<aside class="sidebar">

    <button class="sidebar-toggle" aria-expanded="false" aria-controls="sidebar-content">

        <span class="sidebar-toggle-label">
            <svg class="sidebar-toggle-icon-main" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                 stroke-linejoin="round"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"></path><path
                        d="M19 10v2a7 7 0 0 1-14 0v-2"></path><line x1="12" y1="19" x2="12" y2="23"></line><line x1="8"
                                                                                                                 y1="23"
                                                                                                                 x2="16"
                                                                                                                 y2="23"></line></svg>

            <h3 class="sidebar-toggle-title">Radio UVM</h3>
        </span>

        <svg class="sidebar-toggle-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="6 9 12 15 18 9"></polyline>
        </svg>
    </button>

    <div class="sidebar-content" id="sidebar-content">

        <div class="spotify-player-card">

            <div class="spotify-player__header">
                <img src="" alt="Cover episodio" id="episode-cover" class="spotify-player__image"
                     style="background-color: var(--secondary); aspect-ratio: 1 / 1;">
                <div class="spotify-player__info">
                    <div class="scroll-container">
                        <h4 class="spotify-player__title" id="episode-title">Caricamento episodio...</h4>
                    </div>
                    <span class="spotify-player__date" id="episode-date"></span>
                    <a href="#" id="spotify-link" target="_blank" rel="noopener noreferrer"
                       class="spotify-player__button">
                        <?php echo uvm_get_svg_icon( 'spotify' ); ?>
                        Ascolta su Spotify
                    </a>
                </div>
            </div>

            <div class="spotify-player__controls">
                <button id="play-pause-btn" class="spotify-player__play" aria-label="Play/Pausa">
                    <svg class="play-icon" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M18.54 9L8.88 3.46a3.42 3.42 0 0 0-5.13 3v11.12A3.42 3.42 0 0 0 7.17 21a3.43 3.43 0 0 0 1.71-.46L18.54 15a3.42 3.42 0 0 0 0-5.92Zm-1 4.19l-9.66 5.62a1.44 1.44 0 0 1-1.42 0a1.42 1.42 0 0 1-.71-1.23V6.42a1.42 1.42 0 0 1 .71-1.23A1.5 1.5 0 0 1 7.17 5a1.54 1.54 0 0 1 .71.19l9.66 5.58a1.42 1.42 0 0 1 0 2.46Z"/>
                    </svg>
                </button>
                <div class="spotify-player__progress-bar">
                    <span id="current-time">0:00</span>
                    <input type="range" id="progress-slider" value="0" max="100" class="spotify-player__slider">
                    <span id="duration">0:30</span>
                </div>
            </div>

        </div>

        <?php // --- INIZIO BLOCCO AGGIUNTO --- ?>
        <a href="<?php echo esc_url( home_url( '/radio' ) ); // Link alla tua futura pagina radio ?>" class="radio-cta-button">
            <?php echo uvm_get_svg_icon( 'radio-waves' ); ?>
            <span>Vai alla diretta Radio</span>
        </a>
        <?php // --- FINE BLOCCO AGGIUNTO --- ?>

    </div>
</aside>