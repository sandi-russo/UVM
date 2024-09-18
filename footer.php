<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.

 *
 * @package UNIVERSOME
 */

?>

<footer id="colophon" class="site-footer">
    <!-- Sezione immagine -->
    <div class="footer-img">
        <a href="https://universome.unime.it/">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/LOGO.png" alt="Logo UVM">
        </a>
    </div>

    <!-- Sezione colonne -->
    <div class="footer-grid">
        <!-- Colonna 1 -->
        <div>
            <h4 class="footer-title-cat">Informazioni</h4>
            <p class="footer-text-cat">Testata multiforme degli studenti UniMe. <br> UniVersoMe è una testata
                giornalistica registrata presso il Tribunale di Messina n.11 del 2015.</p>
            <ul class="footer-list">
                <!-- Lista contatti -->
                <li class="footer-info">
                    <div class="footer-icon">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 16" fill='#007bff'>
                            <path fill="currentColor"
                                d="M7.5 7a2.5 2.5 0 0 1 0-5a2.5 2.5 0 0 1 0 5m0-4C6.67 3 6 3.67 6 4.5S6.67 6 7.5 6S9 5.33 9 4.5S8.33 3 7.5 3" />
                            <path fill="currentColor"
                                d="M13.5 11c-.28 0-.5-.22-.5-.5s.22-.5.5-.5s.5-.22.5-.5A2.5 2.5 0 0 0 11.5 7h-1c-.28 0-.5-.22-.5-.5s.22-.5.5-.5c.83 0 1.5-.67 1.5-1.5S11.33 3 10.5 3c-.28 0-.5-.22-.5-.5s.22-.5.5-.5A2.5 2.5 0 0 1 13 4.5c0 .62-.22 1.18-.6 1.62c1.49.4 2.6 1.76 2.6 3.38c0 .83-.67 1.5-1.5 1.5m-12 0C.67 11 0 10.33 0 9.5c0-1.62 1.1-2.98 2.6-3.38c-.37-.44-.6-1-.6-1.62A2.5 2.5 0 0 1 4.5 2c.28 0 .5.22.5.5s-.22.5-.5.5C3.67 3 3 3.67 3 4.5S3.67 6 4.5 6c.28 0 .5.22.5.5s-.22.5-.5.5h-1A2.5 2.5 0 0 0 1 9.5c0 .28.22.5.5.5s.5.22.5.5s-.22.5-.5.5m9 3h-6c-.83 0-1.5-.67-1.5-1.5v-1C3 9.57 4.57 8 6.5 8h2c1.93 0 3.5 1.57 3.5 3.5v1c0 .83-.67 1.5-1.5 1.5m-4-5A2.5 2.5 0 0 0 4 11.5v1c0 .28.22.5.5.5h6c.28 0 .5-.22.5-.5v-1A2.5 2.5 0 0 0 8.5 9z" />
                        </svg>
                    </div>
                    <p class="footer-info-type">
                        <small class="block">Coordinatrice Progetto</small>
                        <strong class="footer-info-name">Giulia Cavallaro</strong>
                        <br>
                        <em>giulia.cavallaro@unime.it</em>
                    </p>
                </li>
                <li class="footer-info">
                    <div class="footer-icon">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M5 5h13a3 3 0 0 1 3 3v9a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V8a3 3 0 0 1 3-3m0 1c-.5 0-.94.17-1.28.47l7.78 5.03l7.78-5.03C18.94 6.17 18.5 6 18 6zm6.5 6.71L3.13 7.28C3.05 7.5 3 7.75 3 8v9a2 2 0 0 0 2 2h13a2 2 0 0 0 2-2V8c0-.25-.05-.5-.13-.72z" />
                        </svg>
                    </div>
                    <p class="footer-info-type">
                        <small class="block">Direttore Responsabile</small>
                        <strong class="footer-info-name">Antonio Tavilla</strong>
                        <br>
                        <em>atavilla@unime.it</em>
                        </>
                </li>
                <li class="footer-info">
                    <div class="footer-icon">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5" color="currentColor">
                                <path
                                    d="M22 10v-.783c0-1.94 0-2.909-.586-3.512c-.586-.602-1.528-.602-3.414-.602h-2.079c-.917 0-.925-.002-1.75-.415L10.84 3.021c-1.391-.696-2.087-1.044-2.828-1.02S6.6 2.418 5.253 3.204l-1.227.716c-.989.577-1.483.866-1.754 1.346C2 5.746 2 6.33 2 7.499v8.217c0 1.535 0 2.303.342 2.73c.228.285.547.476.9.54c.53.095 1.18-.284 2.478-1.042c.882-.515 1.73-1.05 2.785-.905c.884.122 1.705.68 2.495 1.075M8 2v15m7-12v4.5" />
                                <path
                                    d="M18.308 21.684A1.18 1.18 0 0 1 17.5 22c-.302 0-.591-.113-.808-.317c-1.986-1.87-4.646-3.96-3.349-6.993C14.045 13.05 15.73 12 17.5 12s3.456 1.05 4.157 2.69c1.296 3.03-1.358 5.13-3.349 6.993M17.5 16.5h.009" />
                            </g>
                        </svg>
                    </div>
                    <p class="footer-info-type">
                        <small class="block">Piazza Pugliatti, 1</small>
                        <strong class="footer-info-name">Messina</strong>
                        </>
                </li>
            </ul>
        </div>

        <!-- Colonna 2 -->
        <div class="footer-col2">
            <h4 class="footer-title-cat">Giornalista?</h4>
            <p class="footer-text-cat">Premi qui sotto per accedere.</p>
            <a href="/area-accesso">
                <button class="footer-button" style="border: none;">Accedi</button>
            </a>

            <div>
                <h4 class="footer-title-cat">Vuoi unirti al progetto?</h4>
                <p class="footer-text-cat">Premi qui sotto per contattarci.</p>
                <a href="/contattaci/">
                    <button class="footer-button">Contattaci</button>
                </a>
            </div>

            <!-- Icone Social -->
            <div>
                <h4 class="footer-title-cat">Social Network</h4>
                <p class="footer-text-cat">Seguici per rimanere sempre aggiornato!</p>
                <ul class="footer-div-icon">
                    <!-- Facebook -->
                    <li class="footer-icon">
                        <a class="icon-link" href="https://www.facebook.com/UniVersoMessina" target="_blank">
                            <svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M8 6a6 6 0 0 1 6-6h5v6.5h-4v2h4.247L17.802 15H15v9H8v-9H4.25V8.5H8zm6-4a4 4 0 0 0-4 4v4.5H6.25V13H10v9h3v-9h3.198l.555-2.5H13v-4a2 2 0 0 1 2-2h2V2z" />
                            </svg>
                        </a>
                    </li>
                    <!-- Instagram -->
                    <li class="footer-icon">
                        <a class="icon-link" href="https://www.instagram.com/uvm_universome" target="_blank">
                            <svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4zm9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8A1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5a5 5 0 0 1-5 5a5 5 0 0 1-5-5a5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3" />
                            </svg>
                        </a>
                    </li>
                    <!-- YOUTUBE -->
                    <li class="footer-icon">
                        <a href="https://www.youtube.com/@UniVersoMe-UniMe" target="_blank">
                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <g fill="none">
                                    <path
                                        d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                                    <path fill="currentColor"
                                        d="M12 4c.855 0 1.732.022 2.582.058l1.004.048l.961.057l.9.061l.822.064a3.8 3.8 0 0 1 3.494 3.423l.04.425l.075.91c.07.943.122 1.971.122 2.954s-.052 2.011-.122 2.954l-.075.91l-.04.425a3.8 3.8 0 0 1-3.495 3.423l-.82.063l-.9.062l-.962.057l-1.004.048A62 62 0 0 1 12 20a62 62 0 0 1-2.582-.058l-1.004-.048l-.961-.057l-.9-.062l-.822-.063a3.8 3.8 0 0 1-3.494-3.423l-.04-.425l-.075-.91A41 41 0 0 1 2 12c0-.983.052-2.011.122-2.954l.075-.91l.04-.425A3.8 3.8 0 0 1 5.73 4.288l.821-.064l.9-.061l.962-.057l1.004-.048A62 62 0 0 1 12 4m0 2c-.825 0-1.674.022-2.5.056l-.978.047l-.939.055l-.882.06l-.808.063a1.8 1.8 0 0 0-1.666 1.623C4.11 9.113 4 10.618 4 12s.11 2.887.227 4.096c.085.872.777 1.55 1.666 1.623l.808.062l.882.06l.939.056l.978.047c.826.034 1.675.056 2.5.056s1.674-.022 2.5-.056l.978-.047l.939-.055l.882-.06l.808-.063a1.8 1.8 0 0 0 1.666-1.623C19.89 14.887 20 13.382 20 12s-.11-2.887-.227-4.096a1.8 1.8 0 0 0-1.666-1.623l-.808-.062l-.882-.06l-.939-.056l-.978-.047A61 61 0 0 0 12 6m-2 3.575a.6.6 0 0 1 .819-.559l.081.04l4.2 2.424a.6.6 0 0 1 .085.98l-.085.06l-4.2 2.425a.6.6 0 0 1-.894-.43l-.006-.09z" />
                                </g>
                            </svg>
                        </a>
                    </li>
                    <!-- Spotify -->
                    <li class="footer-icon">
                        <a class="icon-link" href="https://open.spotify.com/show/1J8nrLau2QtjbMjFodeotT"
                            target="_blank">
                            <svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.5">
                                    <path d="M7 15s4.5-1 9 1m-9.5-4s6-1.5 11 1.5M6 9c3-.5 8-1 13 2" />
                                    <path
                                        d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10" />
                                </g>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>


    </div>

    <!-- Link Footer -->
    <div class="footer-other-info">
        <ul>
            <li>
                <a href='/privacy-policy'>Privacy Policy</a>
            </li>
        </ul>
    </div>


    <!-- Copyright Footer -->
    <div class="footer-other-info" style="border-top: 1px solid #828282; margin-top: 4px; padding-top: 4px;">
        <p>Codice Licenza SIAE n. 6195/I/8746</p>
    </div>
    <div class="footer-other-info">
        <p>© <?php echo date("Y"); ?>
            <a href="https://universome.unime.it/">UniVersoMe™</a>. Tutti i diritti sono
            riservati.
        </p>
    </div>
</footer>

<!-- Pulsante per tornare in cima -->
<div class="fixed-back-to-top" onclick="scrollToTop()">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
        <path fill="currentColor" stroke="currentColor" stroke-linejoin="round" stroke-width="4"
            d="m12 29l12-12l12 12z" />
    </svg>
</div>


</div><!-- #page -->
<?php wp_footer(); ?>

</body>

</html>