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

                // Crea un array per raggruppare gli utenti per ruolo
                $roles = [];
                foreach ($users as $user) {
                    $user_roles = $user->roles;
                    foreach ($user_roles as $role) {
                        if (!isset($roles[$role])) {
                            $roles[$role] = [];
                        }
                        $roles[$role][] = $user;
                    }
                }

                // Definisci i domini dei social media
                $social_domains = [
                    'instagram' => 'https://instagram.com/',
                    'twitter' => 'https://twitter.com/',
                    'linkedin' => 'https://linkedin.com/in/'
                ];

                // Per ogni ruolo, mostra gli utenti
                foreach ($roles as $role => $users) {
                    echo '<div class="chi-siamo-role-section">';
                    echo '<div class="chi-siamo-role-title">' . strtoupper(esc_html($role)) . '</div>';
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

                        // Ottieni il nome completo, la biografia e l'email dell'utente
                        $full_name = ucfirst(esc_html($user->first_name . ' ' . $user->last_name));
                        $biography = esc_html(get_the_author_meta('description', $user->ID));
                        $email = esc_html($user->user_email);

                        // Ottieni i nomi utenti dei social media
                        $instagram_username = esc_html(get_the_author_meta('instagram', $user->ID));
                        $twitter_username = esc_html(get_the_author_meta('twitter', $user->ID));
                        $linkedin_username = esc_html(get_the_author_meta('linkedin', $user->ID));

                        // Costruisci gli URL dei social media
                        $instagram_url = $instagram_username ? $social_domains['instagram'] . $instagram_username : '';
                        $twitter_url = $twitter_username ? $social_domains['twitter'] . $twitter_username : '';
                        $linkedin_url = $linkedin_username ? $social_domains['linkedin'] . $linkedin_username : '';

                        // Costruisci l'URL della pagina degli articoli dell'autore
                        $author_posts_url = get_author_posts_url($user->ID);

                        // Mostra le informazioni dell'utente
                        echo '<div class="chi-siamo-card">';
                        echo '<img src="' . esc_url($avatar) . '" class="chi-siamo-avatar" />';
                        echo '<h4 class="chi-siamo-name"><a href="' . esc_url($author_posts_url) . '" class="text-xl font-bold text-black">' . esc_html($full_name) . '</a></h4>';
                        echo '<p class="chi-siamo-biography">' . esc_html($biography) . '</p>';
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
                        if ($twitter_url) {
                            echo '<a href="' . esc_url($twitter_url) . '" target="_blank" class="chi-siamo-social-icon">';
                            echo '<svg class="chi-siamo-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                                <path fill="currentColor" d="M9.294 6.928L14.357 1h-1.2L8.762 6.147L5.25 1H1.2l5.31 7.784L1.2 15h1.2l4.642-5.436L10.751 15h4.05zM7.651 8.852l-.538-.775L2.832 1.91h1.843l3.454 4.977l.538.775l4.491 6.47h-1.843z" />
                            </svg>';
                            echo '</a>';
                        }
                        if ($linkedin_url) {
                            echo '<a href="' . esc_url($linkedin_url) . '" target="_blank" class="chi-siamo-social-icon">';
                            echo '<svg class="chi-siamo-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                                    <path d="M7 15s4.5-1 9 1m-9.5-4s6-1.5 11 1.5M6 9c3-.5 8-1 13 2" />
                                    <path d="M12 22.5a10.5 10.5 0 1 0 0-21a10.5 10.5 0 0 0 0 21Z" />
                                </g>
                            </svg>';
                            echo '</a>';
                        }
                        echo '</div>'; // chi-siamo-social-icons

                        echo '</div>'; // chi-siamo-card
                    }

                    echo '</div>'; // .grid
                    echo '</div>'; // chi-siamo-role-section
                }
                ?>

            </div>
        </header>
    </main>
</div>

<?php get_footer(); ?>
