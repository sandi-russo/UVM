<?php
/**
 * Template Name: Team Page
 */

get_header(); ?>

<div class="chi-siamo-container">
    <main id="primary" class="chi-siamo-main">
        <header class="chi-siamo-header">
            <div class="chi-siamo-header-container">
                <div class="chi-siamo-intro">
                    <h2 class="titolo-pagina">CONTATTACI</h2>
                    <p class="descrizione-pagina">Hai qualche idea o vuoi contribuire alla crescita del progetto?</p>
                </div>
            <!-- CONTACT FORM -->

            <div class="form-container">
                <!-- Header del form, con il titolo e la descrizione -->
                <!-- Corpo del form -->
                <div class="form-body">
                    <div class="form-content">
                        <form>
                            <div class="form-grid">
                                <!-- NOME -->
                                <div class="input-container full-width">
                                    <input type="text" placeholder="Nome" class="input-field" />
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="input-icon">
                                        <g fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="4">
                                            <circle cx="24" cy="11" r="7" />
                                            <path d="M4 41c0-8.837 8.059-16 18-16m9 17l10-10l-4-4l-10 10v4z" />
                                        </g>
                                    </svg>
                                </div>
                                <!-- COGNOME -->
                                <div class="input-container full-width">
                                    <input type="text" placeholder="Cognome" class="input-field" />
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="input-icon">
                                        <g fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="4">
                                            <circle cx="24" cy="11" r="7" />
                                            <path d="M4 41c0-8.837 8.059-16 18-16m9 17l10-10l-4-4l-10 10v4z" />
                                        </g>
                                    </svg>
                                </div>
                                <!-- NUMERO DI TELEFONO -->
                                <div class="input-container full-width">
                                    <input type="number" placeholder="Numero di telefono" class="input-field" />
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="input-icon">
                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="1.5"
                                            d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.04 12.04 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5z" />
                                    </svg>
                                </div>
                                <!-- EMAIL -->
                                <div class="input-container full-width">
                                    <input type="email" placeholder="Email" class="input-field" />
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="input-icon">
                                        <path fill="currentColor"
                                            d="M15.5 4A2.5 2.5 0 0 1 18 6.5v8a2.5 2.5 0 0 1-2.5 2.5h-11A2.5 2.5 0 0 1 2 14.5v-8A2.5 2.5 0 0 1 4.5 4zM17 7.961l-6.746 3.97a.5.5 0 0 1-.426.038l-.082-.038L3 7.963V14.5A1.5 1.5 0 0 0 4.5 16h11a1.5 1.5 0 0 0 1.5-1.5zM15.5 5h-11A1.5 1.5 0 0 0 3 6.5v.302l7 4.118l7-4.12v-.3A1.5 1.5 0 0 0 15.5 5" />
                                    </svg>
                                </div>
                                <!-- MESSAGGIO -->
                                <div class="input-container full-width">
                                    <textarea placeholder="Scrivi la tua idea" class="input-field"></textarea>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="input-icon">
                                        <path fill="currentColor"
                                            d="M11 24h10v2H11zm2 4h6v2h-6zm3-26A10 10 0 0 0 6 12a9.19 9.19 0 0 0 3.46 7.62c1 .93 1.54 1.46 1.54 2.38h2c0-1.84-1.11-2.87-2.19-3.86A7.2 7.2 0 0 1 8 12a8 8 0 0 1 16 0a7.2 7.2 0 0 1-2.82 6.14c-1.07 1-2.18 2-2.18 3.86h2c0-.92.53-1.45 1.54-2.39A9.18 9.18 0 0 0 26 12A10 10 0 0 0 16 2" />
                                    </svg>
                                </div>
                                <!-- SELEZIONE RUOLO CON CHECKBOX -->
                                <div class="role-selection full-width">
                                    <label>Che ruolo ti interessa?</label>
                                    <div class="checkbox-group">
                                        <label><input type="checkbox" name="role" value="Giornale">Giornale</label>
                                        <label><input type="checkbox" name="role" value="Radio">Radio</label>
                                        <label><input type="checkbox" name="role" value="Creativa / Grafica">Creativa / Grafica</label>
                                        <label><input type="checkbox" name="role" value="Social">Social</label>
                                        <label><input type="checkbox" name="role" value="Informatica">Informatica</label>
                                    </div>
                                </div>
                                <!-- BOTTONE INVIA -->
                                <div class="button-container full-width">
                                    <button type="submit" class="submit-button">Invia</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>







        </header>
    </main>
</div>

<?php get_footer(); ?>