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
 * Walker personalizzato per il menu mobile (Opzionale se si usa wp_nav_menu)
 * NOTA: Questo non è attualmente utilizzato dal navigation.php fornito,
 * ma è pronto se si decide di passare a wp_nav_menu per il mobile.
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
// --- CAMPI PROFILO AUTORE ---
/**
 * Aggiunge i nuovi campi social al profilo utente nell'area admin.
 */
function uvm_add_custom_user_profile_fields( $user ) {
    ?>
    <h3><?php _e( 'Profili Social (Opzionali)', 'universome' ); ?></h3>

    <table class="form-table">
        <tr>
            <th><label for="linkedin_url">Profilo LinkedIn</label></th>
            <td>
                <input type="url" id="linkedin_url" name="linkedin_url"
                       value="<?php echo esc_attr( get_user_meta( $user->ID, 'linkedin_url', true ) ); ?>"
                       class="regular-text"/>
                <p class="description">Inserisci l'URL completo del tuo profilo LinkedIn.</p>
            </td>
        </tr>
        <tr>
            <th><label for="instagram_username">Username Instagram</label></th>
            <td>
                <input type="text" id="instagram_username" name="instagram_username"
                       value="<?php echo esc_attr( get_user_meta( $user->ID, 'instagram_username', true ) ); ?>"
                       class="regular-text"/>
                <p class="description">Inserisci solo lo username (es. <strong>nomeutente</strong>, senza @).</p>
            </td>
        </tr>
        <tr>
            <th><label for="threads_username">Username Threads</label></th>
            <td>
                <input type="text" id="threads_username" name="threads_username"
                       value="<?php echo esc_attr( get_user_meta( $user->ID, 'threads_username', true ) ); ?>"
                       class="regular-text"/>
                <p class="description">Inserisci solo lo username (es. <strong>nomeutente</strong>, senza @).</p>
            </td>
        </tr>
    </table>
    <?php
}

add_action( 'show_user_profile', 'uvm_add_custom_user_profile_fields' );
add_action( 'edit_user_profile', 'uvm_add_custom_user_profile_fields' );

/**
 * Salva i dati dei campi social personalizzati quando il profilo viene aggiornato.
 */
function uvm_save_custom_user_profile_fields( $user_id ) {
    if ( ! current_user_can( 'edit_user', $user_id ) ) {
        return false;
    }

    if ( isset( $_POST['linkedin_url'] ) ) {
        update_user_meta( $user_id, 'linkedin_url', esc_url_raw( $_POST['linkedin_url'] ) );
    }
    if ( isset( $_POST['instagram_username'] ) ) {
        update_user_meta( $user_id, 'instagram_username', sanitize_text_field( $_POST['instagram_username'] ) );
    }
    if ( isset( $_POST['threads_username'] ) ) {
        update_user_meta( $user_id, 'threads_username', sanitize_text_field( $_POST['threads_username'] ) );
    }
}

add_action( 'personal_options_update', 'uvm_save_custom_user_profile_fields' );
add_action( 'edit_user_profile_update', 'uvm_save_custom_user_profile_fields' );


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
 * Aggiunge una freccia (SVG) alle voci di menu 'primary' che hanno sottomenu.
 * Questo permette al CSS (::hover) di animare la freccia.
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
// Assicurati che il filtro usi il nome corretto della funzione
add_filter( 'nav_menu_item_title', 'uvm_modify_primary_nav_items', 10, 4 );

?>