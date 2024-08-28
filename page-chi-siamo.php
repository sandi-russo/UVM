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
                    <h2 class="titolo-pagina">IL NOSTRO TEAM</h2>
                    <p class="descrizione-pagina">Tutta la famiglia UniVersoMe</p>
                </div>

                <?php
                // Recupera tutti gli utenti
                $users = get_users();

                // Crea un array per raggruppare gli utenti per unità
                $units = [
                    'giornale' => [],
                    'radio' => [],
                    'creativa_grafica' => [],
                    'social' => [],
                    'informatica' => [],
                    'membro' => []
                ];

                foreach ($users as $user) {
                    $unit = get_the_author_meta('unit', $user->ID);
                    $ruolo_uvm = get_the_author_meta('ruolo_uvm', $user->ID);

                    if ($unit) {
                        if (isset($units[$unit])) {
                            $units[$unit][] = $user;
                        } else {
                            $units['membro'][] = $user;
                        }
                    } else {
                        $units['membro'][] = $user;
                    }
                }

                // Definisci i domini dei social media
                $social_domains = [
                    'instagram' => 'https://instagram.com/',
                    'threads' => 'https://www.threads.net/',
                    'linkedin' => 'https://linkedin.com/in/'
                ];

                // Per ogni unità, mostra gli utenti
                foreach ($units as $unit => $users) {
                    if (!empty($users)) {
                        echo '<div class="chi-siamo-unit-section">';
                        echo '<div class="chi-siamo-unit-title">' . strtoupper(esc_html($unit)) . '</div>';
                        echo '<div class="chi-siamo-grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-4 justify-center">';

                        foreach ($users as $user) {
                            // Controlla se esiste un avatar personalizzato
                            $custom_avatar = get_user_meta($user->ID, 'custom_avatar', true);

                            if ($custom_avatar) {
                                // Se esiste, usa l'avatar personalizzato
                                $avatar = $custom_avatar;
                            } else {
                                // Altrimenti, usa l'avatar predefinito di WordPress
                                $avatar = get_avatar_url($user->ID);
                            }

                            // Ottieni il nome completo, la biografia, l'email e il ruolo UVM dell'utente
                            $full_name = ucwords(esc_html($user->first_name . ' ' . $user->last_name));
                            $biography = esc_html(get_the_author_meta('description', $user->ID));
                            $email = esc_html($user->user_email);
                            $ruolo_uvm = ucwords(str_replace('_', ' ', esc_html(get_the_author_meta('ruolo_uvm', $user->ID))));

                            // Ottieni i nomi utenti dei social media
                            $instagram_username = esc_html(get_the_author_meta('instagram', $user->ID));
                            $threads_username = esc_html(get_the_author_meta('threads', $user->ID));
                            $linkedin_username = esc_html(get_the_author_meta('linkedin', $user->ID));

                            // Costruisci gli URL dei social media
                            $instagram_url = $instagram_username ? $social_domains['instagram'] . $instagram_username : '';
                            $threads_url = $threads_username ? $social_domains['threads'] . $threads_username : '';
                            $linkedin_url = $linkedin_username ? $social_domains['linkedin'] . $linkedin_username : '';

                            // Costruisci l'URL della pagina degli articoli dell'autore
                            $author_posts_url = get_author_posts_url($user->ID);

                            // Mostra le informazioni dell'utente
                            echo '<div class="chi-siamo-card">';
                            echo '<img src="' . esc_url($avatar) . '" class="chi-siamo-avatar" />';
                            echo '<h4 class="chi-siamo-name"><a href="' . esc_url($author_posts_url) . '" class="text-xl font-bold text-black">' . esc_html($full_name) . '</a></h4>';
                            echo '<p class="chi-siamo-role">' . esc_html($ruolo_uvm) . '</p>';
                            echo '<p class="chi-siamo-email"><a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a></p>';

                            // Aggiungi le icone social
                            echo '<div class="chi-siamo-social-icons">';
                            if ($instagram_url) {
                                echo '<a href="' . esc_url($instagram_url) . '" target="_blank" class="chi-siamo-social-icon">';
                                echo '<svg class="chi-siamo-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4zm9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8A1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5a5 5 0 0 1-5 5a5 5 0 0 1-5-5a5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3" />
                                </svg>';
                                echo '</a>';
                            }
                            if ($threads_url) {
                                echo '<a href="' . esc_url($threads_url) . '" target="_blank" class="chi-siamo-social-icon">';
                                echo '<svg class="chi-siamo-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 8.505c-1.577-5.867-7-5.5-7-5.5s-7.5-.5-7.5 8.995s7.5 8.996 7.5 8.996s4.458.296 6.5-3.918c.667-1.858.5-5.573-6-5.573c0 0-3 0-3 2.5c0 .976 1 2 2.5 2s3.171-1.027 3.5-3c1-6-4.5-6.5-6-4" color="currentColor"/></svg>';
                                echo '</a>';
                            }
                            if ($linkedin_url) {
                                echo '<a href="' . esc_url($linkedin_url) . '" target="_blank" class="chi-siamo-social-icon">';
                                echo '<svg class="chi-siamo-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M5 1.25a2.75 2.75 0 1 0 0 5.5a2.75 2.75 0 0 0 0-5.5M3.75 4a1.25 1.25 0 1 1 2.5 0a1.25 1.25 0 0 1-2.5 0m-1.5 4A.75.75 0 0 1 3 7.25h4a.75.75 0 0 1 .75.75v13a.75.75 0 0 1-.75.75H3a.75.75 0 0 1-.75-.75zm1.5.75v11.5h2.5V8.75zM9.25 8a.75.75 0 0 1 .75-.75h4a.75.75 0 0 1 .75.75v.434l.435-.187a7.8 7.8 0 0 1 2.358-.595C20.318 7.4 22.75 9.58 22.75 12.38V21a.75.75 0 0 1-.75.75h-4a.75.75 0 0 1-.75-.75v-7a1.25 1.25 0 0 0-2.5 0v7a.75.75 0 0 1-.75.75h-4a.75.75 0 0 1-.75-.75zm1.5.75v11.5h2.5V14a2.75 2.75 0 1 1 5.5 0v6.25h2.5v-7.87c0-1.904-1.661-3.408-3.57-3.234a6.3 6.3 0 0 0-1.904.48l-1.48.635a.75.75 0 0 1-1.046-.69V8.75z" clip-rule="evenodd"/></svg>';
                                echo '</a>';
                            }
                            echo '</div>'; // chi-siamo-social-icons
                
                            echo '</div>'; // chi-siamo-card
                        }

                        echo '</div>'; // .grid
                        echo '</div>'; // chi-siamo-unit-section
                    }
                }
                ?>

            </div>




            <!-- CONTACT FORM -->

            <div class="form-container">
                <!-- Header del form, con il titolo e la descrizione -->
                <div class="form-header">
                    <h2>CONTATTACI</h2>
                    <p>Hai qualche idea o vuoi contribuire alla crescita del progetto?</p>
                </div>
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
                                        <label><input type="checkbox" name="role" value="Creativa / Grafica">Creativa /
                                            Grafica</label>
                                        <label><input type="checkbox" name="role" value="Social">Social</label>
                                        <label><input type="checkbox" name="role"
                                                value="Informatica">Informatica</label>
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