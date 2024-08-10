<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.

 *
 * @package UNIVERSOME
 */

?>

<footer id="colophon" class="site-footer bg-[#222222] py-10 px-10 font-sans tracking-wide">
    <!-- Sezione immagine -->
    <div class="flex justify-center mb-10">
        <a href="https://universome.unime.it/">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/UVM_LOGO.png" alt="Logo UVM"
                class="w-52 h-auto">
        </a>
    </div>

    <!-- Sezione colonne -->
    <div class="grid grid-cols-1 md:grid-cols-2 max-w-screen-xl mx-auto">
        <!-- Colonna 1 -->
        <div>
            <h4 class="text-[#ff8800] font-bold text-lg">Informazioni</h4>
            <p class="text-sm text-white mt-2">Testata multiforme degli studenti UniMe. <br> UniVersoMe è una testata
                giornalistica registrata presso il Tribunale di Messina n.11 del 2015.</p>
            <ul class="mt-6 space-y-6 ml-auto mx-auto">
                <!-- Lista contatti -->
                <li class="flex items-center">
                    <div class="footer-icon">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 16" fill='#007bff'>
                            <path fill="currentColor"
                                d="M7.5 7a2.5 2.5 0 0 1 0-5a2.5 2.5 0 0 1 0 5m0-4C6.67 3 6 3.67 6 4.5S6.67 6 7.5 6S9 5.33 9 4.5S8.33 3 7.5 3" />
                            <path fill="currentColor"
                                d="M13.5 11c-.28 0-.5-.22-.5-.5s.22-.5.5-.5s.5-.22.5-.5A2.5 2.5 0 0 0 11.5 7h-1c-.28 0-.5-.22-.5-.5s.22-.5.5-.5c.83 0 1.5-.67 1.5-1.5S11.33 3 10.5 3c-.28 0-.5-.22-.5-.5s.22-.5.5-.5A2.5 2.5 0 0 1 13 4.5c0 .62-.22 1.18-.6 1.62c1.49.4 2.6 1.76 2.6 3.38c0 .83-.67 1.5-1.5 1.5m-12 0C.67 11 0 10.33 0 9.5c0-1.62 1.1-2.98 2.6-3.38c-.37-.44-.6-1-.6-1.62A2.5 2.5 0 0 1 4.5 2c.28 0 .5.22.5.5s-.22.5-.5.5C3.67 3 3 3.67 3 4.5S3.67 6 4.5 6c.28 0 .5.22.5.5s-.22.5-.5.5h-1A2.5 2.5 0 0 0 1 9.5c0 .28.22.5.5.5s.5.22.5.5s-.22.5-.5.5m9 3h-6c-.83 0-1.5-.67-1.5-1.5v-1C3 9.57 4.57 8 6.5 8h2c1.93 0 3.5 1.57 3.5 3.5v1c0 .83-.67 1.5-1.5 1.5m-4-5A2.5 2.5 0 0 0 4 11.5v1c0 .28.22.5.5.5h6c.28 0 .5-.22.5-.5v-1A2.5 2.5 0 0 0 8.5 9z" />
                        </svg>
                    </div>
                    <p class="text-sm text-white text-sm ml-3">
                        <small class="block">Coordinatore Progetto</small>
                        <strong class="text-[#ff8800] text-sm text-white">Giulia Cavallaro</strong>
                        <br>
                        <em>giulia.cavallaro@unime.it</em>
                    </p>
                </li>
                <li class="flex items-center">
                    <div class="footer-icon">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M5 5h13a3 3 0 0 1 3 3v9a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V8a3 3 0 0 1 3-3m0 1c-.5 0-.94.17-1.28.47l7.78 5.03l7.78-5.03C18.94 6.17 18.5 6 18 6zm6.5 6.71L3.13 7.28C3.05 7.5 3 7.75 3 8v9a2 2 0 0 0 2 2h13a2 2 0 0 0 2-2V8c0-.25-.05-.5-.13-.72z" />
                        </svg>
                    </div>
                    <p class="text-sm text-white text-sm ml-3">
                        <small class="block">Direttore Responsabile</small>
                        <strong class="text-[#ff8800] text-sm text-white">Antonino Tavilla</strong>
                        <br>
                        <em>atavilla@unime.it</em>
                    </>
                </li>
                <li class="flex items-center">
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
                    <p class="text-sm text-white text-sm ml-3">
                        <small class="block">Piazza Pugliatti, 1</small>
                        <strong class="text-[#ff8800] text-sm text-white">Messina</strong>
                    </>
                </li>
            </ul>
        </div>

        <!-- Colonna 2 -->
        <div class="ml-auto mx-auto">
            <h4 class="text-[#ff8800] font-bold text-lg">Giornalista?</h4>
            <p class="text-sm text-white mt-2">Premi qui sotto per accedere.</p>
            <a href="https:\\universome.unime.it\login">
                <button class="text-white bg-[#787878] hover:bg-[#f28b0c] font-semibold rounded-md text-sm px-6 py-3 block w-full mt-3" style="border: none;">Accedi</button>

            </a>
            <!-- Icone Social -->
        <div>
            <h4 class="text-[#ff8800] font-bold text-lg mt-6">Social Network</h4>
            <p class="text-sm text-white mt-2">Seguici per rimanere sempre aggiornato!</p>
            <ul class="flex items-center mt-6 space-x-4 ml-auto mx-auto">
                <!-- Facebook -->
                <li class="footer-icon">
                    <a class="icon-link" href="https://www.facebook.com/UniVersoMessina">
                        <svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M8 6a6 6 0 0 1 6-6h5v6.5h-4v2h4.247L17.802 15H15v9H8v-9H4.25V8.5H8zm6-4a4 4 0 0 0-4 4v4.5H6.25V13H10v9h3v-9h3.198l.555-2.5H13v-4a2 2 0 0 1 2-2h2V2z" />
                        </svg>
                    </a>
                </li>
                <!-- Instagram -->
                <li class="footer-icon">
                    <a class="icon-link" href="https://www.instagram.com/uvm_universome">
                        <svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4zm9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8A1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5a5 5 0 0 1-5 5a5 5 0 0 1-5-5a5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3" />
                        </svg>
                    </a>
                </li>
                <!-- Twitter -->
                <li class="footer-icon">
                    <a class="icon-link" href="https://twitter.com/universomessina">
                        <svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                            <path fill="currentColor"
                                d="M9.294 6.928L14.357 1h-1.2L8.762 6.147L5.25 1H1.2l5.31 7.784L1.2 15h1.2l4.642-5.436L10.751 15h4.05zM7.651 8.852l-.538-.775L2.832 1.91h1.843l3.454 4.977l.538.775l4.491 6.47h-1.843z" />
                        </svg>
                    </a>
                </li>
                <!-- Spotify -->
                <li class="footer-icon">
                    <a class="icon-link" href="https://open.spotify.com/show/1J8nrLau2QtjbMjFodeotT">
                        <svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5">
                                <path d="M7 15s4.5-1 9 1m-9.5-4s6-1.5 11 1.5M6 9c3-.5 8-1 13 2" />
                                <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10" />
                            </g>
                        </svg>
                    </a>
                </li>
            </ul>
        </div>
        </div>

        
    </div>

    <!-- Link Footer -->
    <div class="w-full flex justify-center">
        <ul class="flex gap-4 ml-auto mx-auto">
            <li>
                <a href='/copyright' class='text-white text-sm font-semibold'>Copyright</a>
            </li>
            <li>
                <a href='/privacy-policy' class='text-white text-sm font-semibold'>Politica Privacy</a>
            </li>
        </ul>
    </div>


    <!-- Copyright Footer -->
    <div class="ml-auto mx-auto w-full flex justify-center"  style="border-top: 1px solid #e6e6e6cf; margin-top: 4px; padding-top: 4px;">
        <p class="text-white block">Codice Licenza SIAE n. 6195/I/8746</p>
    </div>
    <div class="ml-auto mx-auto w-full flex justify-center">
        <p class="text-white block">© <?php echo date("Y"); ?>
            <a href="https://universome.unime.it/" class="text-white">UniVersoMe™</a>. Tutti i diritti sono
            riservati.
        </p>
    </div>
</footer>


<div class="fixed-back-to-top" onclick="scrollToTop()">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
        <path fill="currentColor" stroke="currentColor" stroke-linejoin="round" stroke-width="4" d="m12 29l12-12l12 12z"/>
    </svg>
</div>


</div><!-- #page -->
<?php wp_footer(); ?>

</body>

</html>