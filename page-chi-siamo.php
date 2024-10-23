<?php

/**
 * Template Name: Team Page
 */

get_header(); ?>

<!-- Immagine in evidenza con titolo -->
<div class="chi-siamo-banner">
    <div class="chi-siamo-banner-space">
    </div>
    <div class="container-banner">
        <!-- Descrizione UniVersoMe -->
        <div class="chi-siamo-description">
            <!--<h1 class="chi-siamo-title">UNIVERSOME</h1>-->
            <p><b>UNIVERSOME</b> è la piattaforma multimediale ufficiale dell'Università degli Studi di Messina,
                un
                progetto dinamico e in continua evoluzione che offre uno spazio privilegiato per la produzione e la
                diffusione di contenuti giornalistici creati dagli studenti. Si tratta di un ambiente di condivisione e
                crescita, dove i giovani talenti dell'ateneo possono esprimere le proprie idee, affinare le loro
                capacità e
                confrontarsi con il mondo dell'informazione universitaria.</p>
            <p>Ma UniVersoMe non si ferma agli articoli. Il progetto include RadioUVM, la web radio ufficiale
                dell'Università degli Studi di Messina, che arricchisce ulteriormente l'offerta editoriale con programmi
                radiofonici di musica, intrattenimento e approfondimento culturale.</p>
            <p>Vuoi entrare a far parte della redazione o scoprire di più su UniVersoMe? Puoi unirti anche tu, portando
                il
                tuo contributo, le tue passioni e le tue competenze per fare la differenza e crescere insieme al team.
            </p>
            <p>Di seguito trovi l'elenco completo di tutti i partecipanti al progetto, divisi per unità di appartenenza,
                con
                i relativi ruoli ed eventuali collegamenti ai rispettivi social.</p>
        </div>
        <div class="chi-siamo-banner-img">
            <img src="https://t4.ftcdn.net/jpg/03/54/00/91/360_F_354009182_Cc6DzlgU402u1bXAGyvXAbmp5EgYAV9D.jpg">
        </div>
    </div>
</div>

<main class="custom-background">
    <div class="other_site_container">
        <header class="chi-siamo-header">
            <div class="chi-siamo-header-container">
                <div class="chi-siamo-intro">
                    <h2 class="titolo-pagina">IL NOSTRO TEAM</h2>
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
                        // Controlla se l'unità è "creativa_grafica" e mostra un titolo personalizzato
                        if ($unit === 'creativa_grafica') {
                            echo '<div class="chi-siamo-unit-title">FOTOGRAFIA / GRAFICA / CREATIVA</div>';
                        } else {
                            echo '<div class="chi-siamo-unit-title">' . mb_strtoupper(esc_html(str_replace('_', ' ', $unit))) . '</div>';
                        }
                        echo '<div class="chi-siamo-grid">';

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
                            $full_name = mb_strtoupper(esc_html($user->first_name . ' ' . $user->last_name));
                            $biography = esc_html(get_the_author_meta('description', $user->ID));
                            $ruolo_uvm = mb_strtoupper(str_replace('_', ' ', esc_html(get_the_author_meta('ruolo_uvm', $user->ID))));

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
                            ?>
                            <div class="chi-siamo-card">
                                <img src="<?php echo esc_url($avatar); ?>" class="chi-siamo-avatar"
                                    alt="<?php echo esc_attr($full_name); ?>" />
                                <div class="chi-siamo-info">
                                    <p class="chi-siamo-role"><?php echo esc_html($ruolo_uvm); ?></p>
                                    <h4 class="chi-siamo-name"><a
                                            href="<?php echo esc_url($author_posts_url); ?>"><?php echo esc_html($full_name); ?></a>
                                    </h4>
                                    <div class="chi-siamo-social-icons">
                                        <?php if ($instagram_url): ?>
                                            <a href="<?php echo esc_url($instagram_url); ?>" target="_blank"
                                                class="chi-siamo-social-icon">
                                                <svg class="chi-siamo-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4zm9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8A1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5a5 5 0 0 1-5 5a5 5 0 0 1-5-5a5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3" />
                                                </svg>
                                            </a>
                                        <?php endif; ?>
                                        <?php if ($threads_url): ?>
                                            <a href="<?php echo esc_url($threads_url); ?>" target="_blank"
                                                class="chi-siamo-social-icon">
                                                <svg class="chi-siamo-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="1.5"
                                                        d="M19.25 8.505c-1.577-5.867-7-5.5-7-5.5s-7.5-.5-7.5 8.995s7.5 8.996 7.5 8.996s4.458.296 6.5-3.918c.667-1.858.5-5.573-6-5.573c0 0-3 0-3 2.5c0 .976 1 2 2.5 2s3.171-1.027 3.5-3c1-6-4.5-6.5-6-4"
                                                        color="currentColor" />
                                                </svg>
                                            </a>
                                        <?php endif; ?>
                                        <?php if ($linkedin_url): ?>
                                            <a href="<?php echo esc_url($linkedin_url); ?>" target="_blank"
                                                class="chi-siamo-social-icon">
                                                <svg class="chi-siamo-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                    <path fill="currentColor" fill-rule="evenodd"
                                                        d="M5 1.25a2.75 2.75 0 1 0 0 5.5a2.75 2.75 0 0 0 0-5.5M3.75 4a1.25 1.25 0 1 1 2.5 0a1.25 1.25 0 0 1-2.5 0m-1.5 4A.75.75 0 0 1 3 7.25h4a.75.75 0 0 1 .75.75v13a.75.75 0 0 1-.75.75H3a.75.75 0 0 1-.75-.75zm1.5.75v11.5h2.5V8.75zM9.25 8a.75.75 0 0 1 .75-.75h4a.75.75 0 0 1 .75.75v.434l.435-.187a7.8 7.8 0 0 1 2.358-.595C20.318 7.4 22.75 9.58 22.75 12.38V21a.75.75 0 0 1-.75.75h-4a.75.75 0 0 1-.75-.75v-7a1.25 1.25 0 0 0-2.5 0v7a.75.75 0 0 1-.75.75h-4a.75.75 0 0 1-.75-.75zm1.5.75v11.5h2.5V14a2.75 2.75 0 1 1 5.5 0v6.25h2.5v-7.87c0-1.904-1.661-3.408-3.57-3.234a6.3 6.3 0 0 0-1.904.48l-1.48.635a.75.75 0 0 1-1.046-.69V8.75z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }

                        echo '</div>'; // .grid
                        echo '</div>'; // chi-siamo-unit-section
                    }
                }
                ?>
            </div>
        </header>
    </div>
</main>

<?php get_footer(); ?>