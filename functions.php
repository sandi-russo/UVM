<?php
/**
 * UVM Theme functions and definitions
 */

// Definizioni globali
define( 'UVM_VERSION', '2.0.0' );
define( 'SWIPER_VERSION', '11.1.4' );

/**
 * Setup del tema
 */
function uvm_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'comment-form', 'comment-list', 'gallery', 'caption' ] );
    add_theme_support( 'custom-logo', [
            'height'      => 0,
            'width'       => 0,
            'flex-height' => true,
            'flex-width'  => true,
    ] );

    register_nav_menus( [
            'primary' => 'Menu Principale Header',
            'footer'  => 'Menu Footer',
    ] );
}

add_action( 'after_setup_theme', 'uvm_setup' );

/**
 * Caricamento script e style
 */
function uvm_scripts() {
    // Carica gli stili
    wp_enqueue_style( 'uvm-style', get_stylesheet_uri(), [], UVM_VERSION );
    wp_enqueue_style( 'swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@' . SWIPER_VERSION . '/swiper-bundle.min.css', [], SWIPER_VERSION );

    // Carica la libreria Swiper
    wp_enqueue_script( 'swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@' . SWIPER_VERSION . '/swiper-bundle.min.js', [], SWIPER_VERSION, true );

    // Carica lo script principale (dipende da Swiper)
    wp_enqueue_script(
            'uvm-main-script', // NOME UNICO 1
            get_template_directory_uri() . '/assets/js/script.js',
            [ 'swiper-js' ], // Dipendenza corretta
            UVM_VERSION,
            true
    );

    // Carica lo script del player Spotify (nessuna dipendenza)
    wp_enqueue_script(
            'uvm-spotify-player', // NOME UNICO 2
            get_template_directory_uri() . '/assets/js/spotify-player.js',
            [], // Nessuna dipendenza (o ['uvm-main-script'] se deve caricare dopo)
            UVM_VERSION,
            true
    );

    // Rimuovi stili non necessari
//    wp_dequeue_style( 'wp-block-library' );
//    wp_dequeue_style( 'wp-block-library-theme' );
}

add_action( 'wp_enqueue_scripts', 'uvm_scripts' );

/**
 * Pulizia head
 */
function uvm_cleanup_head() {
    remove_action( 'wp_head', 'wp_generator' );
    remove_action( 'wp_head', 'rsd_link' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
}

add_action( 'init', 'uvm_cleanup_head' );

/**
 * Determina il layout in base al tipo di pagina
 */
function uvm_get_layout_template() {
    if ( is_single() ) {
        return 'with-sidebar'; // MODIFICATO
    } elseif ( is_front_page() || is_archive() || is_home() ) {
        return 'with-sidebar';
    } else {
        return 'full-width';
    }
}

/**
 * Rimuove gli attributi dal tag <img> del logo personalizzato.
 */
function uvm_remove_logo_attributes( $html ) {
    return preg_replace( '/(width|height)="\d*"\s/', "", $html );
}

add_filter( 'get_custom_logo', 'uvm_remove_logo_attributes' );

/**
 * Dimensioni immagini ottimizzate
 */
add_image_size( 'uvm_hero', 1200, 600, true );
add_image_size( 'uvm_card', 400, 250, true );
add_image_size( 'uvm_thumb', 150, 150, true );

/**
 * Personalizza la lunghezza dell'estratto (excerpt).
 */
function uvm_custom_excerpt_length( $length ) {
    return 25;
}

add_filter( 'excerpt_length', 'uvm_custom_excerpt_length', 999 );

/**
 * Personalizza i tre puntini alla fine dell'estratto.
 */
function uvm_custom_excerpt_more( $more ) {
    return '...';
}

add_filter( 'excerpt_more', 'uvm_custom_excerpt_more' );

/**
 * Recupera il codice SVG per un'icona specifica dalla cartella /assets/icons/.
 */
function uvm_get_svg_icon( $icon_name ) {
    $file_path = get_template_directory() . '/assets/icons/' . $icon_name . '.svg';
    if ( file_exists( $file_path ) ) {
        return file_get_contents( $file_path );
    }

    return ''; // Ritorna una stringa vuota se l'icona non esiste
}

/**
 * Walker personalizzato per il menu mobile
 */
class UVM_Mobile_Nav_Walker extends Walker_Nav_Menu {
    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $output .= "<li class='" . implode( " ", $item->classes ) . "'>";

        // Logica di controllo migliorata e più affidabile
        $has_children = in_array('menu-item-has-children', $item->classes);

        if ( $has_children ) {
            $output .= '<div class="menu-item-wrapper">';
        }

        $output .= '<a href="' . $item->url . '">';
        $output .= $item->title; // Il titolo del menu
        $output .= '</a>';

        if ( $has_children ) {
            $output .= '<button class="submenu-toggle" aria-expanded="false"><svg class="arrow-down" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg></button>';
            $output .= '</div>';
        }
    }

    function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= '</li>';
    }
}


// --- CAMPI PROFILO AUTORE (BLOCCO UNICO E CORRETTO) ---
/**
 * Aggiunge i nuovi campi social, Unità e Ruolo al profilo utente.
 */
function uvm_add_custom_user_profile_fields( $user ) {
    ?>
    <h3><?php _e( 'Profili Social (Opzionali)', 'universome' ); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="linkedin">Profilo LinkedIn</label></th>
            <td>
                <?php // CORREZIONE: usa 'linkedin' ?>
                <input type="url" id="linkedin" name="linkedin"
                       value="<?php echo esc_attr( get_user_meta( $user->ID, 'linkedin', true ) ); ?>"
                       class="regular-text"/>
                <p class="description">Inserisci l'URL completo del tuo profilo LinkedIn.</p>
            </td>
        </tr>
        <tr>
            <th><label for="instagram">Username Instagram</label></th>
            <td>
                <?php // CORREZIONE: usa 'instagram' ?>
                <input type="text" id="instagram" name="instagram"
                       value="<?php echo esc_attr( get_user_meta( $user->ID, 'instagram', true ) ); ?>"
                       class="regular-text"/>
                <p class="description">Inserisci solo lo username (es. <strong>nomeutente</strong>, senza @).</p>
            </td>
        </tr>
        <tr>
            <th><label for="threads">Username Threads</label></th>
            <td>
                <?php // CORREZIONE: usa 'threads' ?>
                <input type="text" id="threads" name="threads"
                       value="<?php echo esc_attr( get_user_meta( $user->ID, 'threads', true ) ); ?>"
                       class="regular-text"/>
                <p class="description">Inserisci solo lo username (es. <strong>nomeutente</strong>, senza @).</p>
            </td>
        </tr>
    </table>

    <hr>

    <h3><?php _e( 'Informazioni Redazione (Obbligatorie)', 'universome' ); ?></h3>
    <table class="form-table">
        <?php // Questi erano già corretti ?>
        <tr>
            <th><label for="unit"><?php _e("Unità di appartenenza", "universome"); ?></label></th>
            <td>
                <?php $unit = esc_attr(get_the_author_meta('unit', $user->ID)); ?>
                <select name="unit" id="unit">
                    <option value="">Seleziona un'unità</option>
                    <option value="giornale" <?php selected($unit, 'giornale'); ?>>Giornale</option>
                    <option value="radio" <?php selected($unit, 'radio'); ?>>Radio</option>
                    <option value="creativa_grafica" <?php selected($unit, 'creativa_grafica'); ?>>Creativa / Grafica</option>
                    <option value="social" <?php selected($unit, 'social'); ?>>Social</option>
                    <option value="informatica" <?php selected($unit, 'informatica'); ?>>Informatica</option>
                </select>
                <br />
                <span class="description"><?php _e("Seleziona l'unità di appartenenza."); ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="ruolo_uvm"><?php _e("Ruolo UVM", "universome"); ?></label></th>
            <td>
                <?php $ruolo_uvm = esc_attr(get_the_author_meta('ruolo_uvm', $user->ID)); ?>
                <select name="ruolo_uvm" id="ruolo_uvm">
                    <option value="">Seleziona un ruolo</option>
                    <option value="membro" <?php selected($ruolo_uvm, 'membro'); ?>>Membro</option>
                    <option value="caposervizio" <?php selected($ruolo_uvm, 'caposervizio'); ?>>Caposervizio</option>
                    <option value="redattore" <?php selected($ruolo_uvm, 'redattore'); ?>>Redattore</option>
                    <option value="responsabile_unit" <?php selected($ruolo_uvm, 'responsabile_unit'); ?>>Responsabile UNIT</option>
                    <option value="coordinatrice_uvm" <?php selected($ruolo_uvm, 'coordinatrice_uvm'); ?>>Coordinatrice UVM</option>
                </select>
                <br />
                <span class="description"><?php _e("Seleziona il tuo ruolo UVM."); ?></span>
            </td>
        </tr>
    </table>
    <?php
}
add_action( 'show_user_profile', 'uvm_add_custom_user_profile_fields' );
add_action( 'edit_user_profile', 'uvm_add_custom_user_profile_fields' );

/**
 * Salva i dati dei campi personalizzati.
 */
function uvm_save_custom_user_profile_fields( $user_id ) {
    if ( ! current_user_can( 'edit_user', $user_id ) ) {
        return false;
    }

    // Campi Social (CORRETTI CON I VECCHI ID)
    if ( isset( $_POST['linkedin'] ) ) {
        update_user_meta( $user_id, 'linkedin', esc_url_raw( $_POST['linkedin'] ) );
    }
    if ( isset( $_POST['instagram'] ) ) {
        update_user_meta( $user_id, 'instagram', sanitize_text_field( $_POST['instagram'] ) );
    }
    if ( isset( $_POST['threads'] ) ) {
        update_user_meta( $user_id, 'threads', sanitize_text_field( $_POST['threads'] ) );
    }

    // Campi Unità e Ruolo (Questi erano già corretti)
    if ( isset( $_POST['unit'] ) ) {
        update_user_meta( $user_id, 'unit', sanitize_text_field( $_POST['unit'] ) );
    }
    if ( isset( $_POST['ruolo_uvm'] ) ) {
        update_user_meta( $user_id, 'ruolo_uvm', sanitize_text_field( $_POST['ruolo_uvm'] ) );
    }
}
add_action( 'personal_options_update', 'uvm_save_custom_user_profile_fields' );
add_action( 'edit_user_profile_update', 'uvm_save_custom_user_profile_fields' );


// --- SISTEMA DI AVATAR PERSONALIZZATO ---

/**
 * Nasconde la sezione Avatar predefinita di WordPress per evitare confusione.
 */
function uvm_hide_default_avatar_section() {
    echo '<style>
        .user-profile-picture,
        .user-profile-picture + .form-table {
            display: none !important;
        }
    </style>';
}
add_action('admin_head-profile.php', 'uvm_hide_default_avatar_section');
add_action('admin_head-user-edit.php', 'uvm_hide_default_avatar_section');

/**
 * Aggiunge il campo di upload per l'avatar personalizzato.
 */
function uvm_add_custom_avatar_field($user) {
    ?>
    <h2><?php _e('Avatar personalizzato', 'universome'); ?></h2>
    <table class="form-table">
        <tr>
            <th><label for="custom_avatar"><?php _e('Il tuo avatar', 'universome'); ?></label></th>
            <td>
                <?php
                $custom_avatar = get_user_meta($user->ID, 'custom_avatar', true);
                if ($custom_avatar) {
                    echo '<img src="' . esc_url($custom_avatar) . '" style="max-width: 150px; height: auto; border-radius: 50%;" /><br /><br />';
                }
                ?>
                <input type="file" name="custom_avatar" id="custom_avatar" accept="image/*" />
                <p class="description">
                    <?php _e('Carica un\'immagine per usarla come avatar personalizzato. L\'immagine ideale dovrebbe essere quadrata (es. 300x300 pixel). Premi "Aggiorna profilo" per salvare.', 'universome'); ?>
                </p>
            </td>
        </tr>
    </table>
    <?php
}
add_action('show_user_profile', 'uvm_add_custom_avatar_field');
add_action('edit_user_profile', 'uvm_add_custom_avatar_field');

/**
 * Permette l'upload di file nel form del profilo (necessario per l'avatar).
 */
function uvm_add_enctype_to_profile_form() {
    echo ' enctype="multipart/form-data"';
}
add_action('user_edit_form_tag', 'uvm_add_enctype_to_profile_form');

/**
 * Salva l'avatar personalizzato quando il profilo viene aggiornato.
 */
function uvm_save_custom_avatar($user_id) {
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }

    if (isset($_FILES['custom_avatar']) && $_FILES['custom_avatar']['size'] > 0) {
        // Carica i file necessari per media_handle_upload
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');

        // Carica l'immagine
        $attachment_id = media_handle_upload('custom_avatar', 0);

        if (is_wp_error($attachment_id)) {
            // Gestione errore (opzionale: potresti aggiungere un admin_notice)
            return;
        }

        // Ottieni l'URL dell'immagine caricata
        $attachment_url = wp_get_attachment_url($attachment_id);

        // Salva l'URL nel meta utente
        update_user_meta($user_id, 'custom_avatar', $attachment_url);
    }
}
add_action('personal_options_update', 'uvm_save_custom_avatar');
add_action('edit_user_profile_update', 'uvm_save_custom_avatar');

/**
 * Filtra get_avatar() per usare il nostro avatar personalizzato se esiste.
 */
function uvm_use_custom_avatar($avatar, $id_or_email, $size, $default, $alt) {
    $user = false;

    if (is_numeric($id_or_email)) {
        $id = (int) $id_or_email;
        $user = get_user_by('id', $id);
    } elseif (is_object($id_or_email)) {
        if (!empty($id_or_email->user_id)) {
            $id = (int) $id_or_email->user_id;
            $user = get_user_by('id', $id);
        }
    } else {
        $user = get_user_by('email', $id_or_email);
    }

    if ($user && is_object($user)) {
        $custom_avatar = get_user_meta($user->ID, 'custom_avatar', true);
        if ($custom_avatar) {
            // Se esiste un avatar personalizzato, sovrascrivi l'HTML di default
            $avatar = "<img alt='{$alt}' src='{$custom_avatar}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' style='border-radius: 50%; object-fit: cover;' />";
        }
    }

    return $avatar;
}
add_filter('get_avatar', 'uvm_use_custom_avatar', 10, 5);

// --- ENDPOINT API SPOTIFY ---
/**
 * Crea un endpoint REST API per recuperare l'ultimo episodio di Spotify.
 */
add_action( 'rest_api_init', 'uvm_register_spotify_route' );

function uvm_register_spotify_route() {
    register_rest_route( 'universome/v1', '/latest-episode', [
            'methods'             => 'GET',
            'callback'            => 'uvm_get_spotify_data',
            'permission_callback' => '__return_true'
    ] );
}

/**
 * La funzione callback che contatta l'API di Spotify dal server.
 */
function uvm_get_spotify_data() {
    $clientId     = 'badf08cb27534405ae65a9c5feffb686';
    $clientSecret = 'dd0dfa1d8be64b6983b5e8edbde5581b';
    $showId       = '5J3Ai6sP7r89LG6d8HaAOe';

    $token = get_transient( 'spotify_access_token' );

    if ( false === $token ) {
        $response = wp_remote_post( 'https://accounts.spotify.com/api/token', [
                'method'  => 'POST',
                'headers' => [
                        'Content-Type'  => 'application/x-www-form-urlencoded',
                        'Authorization' => 'Basic ' . base64_encode( $clientId . ':' . $clientSecret )
                ],
                'body'    => 'grant_type=client_credentials'
        ] );

        if ( is_wp_error( $response ) ) {
            return new WP_Error( 'token_error', 'Impossibile contattare Spotify per il token.', [ 'status' => 500 ] );
        }

        $body = json_decode( wp_remote_retrieve_body( $response ), true );

        if ( empty( $body['access_token'] ) ) {
            return new WP_Error( 'token_invalid', 'Token di accesso non valido.', [ 'status' => 500 ] );
        }

        $token = $body['access_token'];
        set_transient( 'spotify_access_token', $token, 50 * 60 );
    }

    $episode_response = wp_remote_get( "https://api.spotify.com/v1/shows/{$showId}/episodes?limit=1&market=IT", [
            'method'  => 'GET',
            'headers' => [
                    'Authorization' => 'Bearer ' . $token
            ]
    ] );

    if ( is_wp_error( $episode_response ) ) {
        return new WP_Error( 'episode_error', 'Impossibile ottenere l\'episodio.', [ 'status' => 500 ] );
    }

    $episode_data = json_decode( wp_remote_retrieve_body( $episode_response ), true );

    if ( empty( $episode_data['items'] ) ) {
        return new WP_Error( 'no_episodes', 'Nessun episodio trovato.', [ 'status' => 404 ] );
    }

    return new WP_REST_Response( $episode_data['items'][0], 200 );
}

/**
 * Modifica l'output del titolo delle voci di menu 'primary'.
 */
function uvm_modify_primary_nav_items( $title, $item, $args, $depth ) {

    // Applica le modifiche solo al menu 'primary'
    if ( 'primary' === $args->theme_location ) {

        // Controlla se siamo nel menu mobile (che usa il nostro Walker)
        $is_mobile_menu = ( isset($args->walker) && is_a($args->walker, 'UVM_Mobile_Nav_Walker') );

        // Se NON siamo sul mobile, applica le regole desktop
        if ( !$is_mobile_menu ) {
            // Livello 0 (voci principali) che hanno figli: aggiungi la freccia
            if ( $depth === 0 && in_array( 'menu-item-has-children', $item->classes ) ) {
                $title .= ' <svg class="arrow-down" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>';
            }
            // Livelli > 0 (voci del sottomenu): avvolgi in <span>
            elseif ( $depth > 0 ) {
                $title = '<span>' . $title . '</span>';
            }
        }
    }
    return $title;
}
add_filter( 'nav_menu_item_title', 'uvm_modify_primary_nav_items', 10, 4 );


/**
 * Imposta il numero di articoli per pagina a 9 negli archivi e nella ricerca.
 */
function uvm_limit_archive_posts_per_page( $query ) {

    // Controlla che sia la query principale, non in admin,
    // E che sia o una pagina Archivio (qualsiasi) O una pagina Ricerca.
    if ( ! is_admin() && $query->is_main_query() && ( $query->is_archive() || $query->is_search() ) ) {

        // Imposta il limite a 9 articoli
        $query->set( 'posts_per_page', 9 );
    }
}
add_action( 'pre_get_posts', 'uvm_limit_archive_posts_per_page' );

/**
 * Pulisce i titoli degli archivi rimuovendo i prefissi (es. "Categoria:", "Tag:").
 */
function uvm_custom_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }

    return $title;
}
add_filter( 'get_the_archive_title', 'uvm_custom_archive_title' );

/**
 * Converte la chiave 'ruolo_uvm' (es. 'responsabile_unit') in un nome leggibile.
 */
function uvm_format_role_name( $role_key ) {
    $roles = [
            'membro'            => 'Membro',
            'caposervizio'      => 'Caposervizio',
            'redattore'         => 'Redattore',
            'responsabile_unit' => 'Responsabile UNIT',
            'coordinatrice_uvm' => 'Coordinatrice UVM'
    ];

    // Se la chiave esiste, ritorna il nome leggibile
    if ( isset( $roles[$role_key] ) ) {
        return $roles[$role_key];
    }
    // Altrimenti, crea un fallback pulito
    else if ( !empty($role_key) ) {
        return ucfirst( str_replace( '_', ' ', $role_key ) );
    }
    // Se il campo è vuoto, ritorna 'Membro' come default
    else {
        return 'Membro';
    }
}

/**
 * For_author_name_to_UPPERCASE_everywhere.
 * This filter intercepts the author's display name right before it's shown.
 */
function uvm_uppercase_author_name( $display_name ) {
    // Use mb_strtoupper for multi-byte character safety (like accented letters)
    return mb_strtoupper( $display_name );
}
add_filter( 'get_the_author_display_name', 'uvm_uppercase_author_name' );


?>