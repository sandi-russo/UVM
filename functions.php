<?php
/**
 * UVM functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package UVM
 */

if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

/* TAILWIND CSS*/
function cg_your_theme_scripts()
{
    wp_enqueue_style('output', get_template_directory_uri() . '/dist/output.css', array());
}
add_action('wp_enqueue_scripts', 'cg_your_theme_scripts');

/**
 * INCLUDO IL FILE PER IL JS
 *
 */
function enqueue_custom_js()
{
    // Registra lo script custom.js
    wp_register_script('custom-js', get_template_directory_uri() . '/assets/js/custom.js', array(), null, true);
    // Fa l'enqueue dello script custom.js
    wp_enqueue_script('custom-js');
}

// Usa l'hook wp_enqueue_scripts per fare l'enqueue dello script
add_action('wp_enqueue_scripts', 'enqueue_custom_js');


























/**
 * SPOTIFY SDK
 */
function enqueue_spotify_sdk()
{
    wp_enqueue_script('spotify-sdk', 'https://sdk.scdn.co/spotify-player.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_spotify_sdk');


/**
 * DATA E ORA ULTIMA MODIFICA
 */
function get_last_modified_post_date_time()
{
    // Esegue una query per ottenere l'ultimo post modificato
    $recent = new WP_Query([
        'post_type' => 'any',
        'posts_per_page' => 1,
        'orderby' => 'modified',
        'order' => 'DESC',
    ]);

    // Verifica se ci sono post da visualizzare
    if ($recent->have_posts()) {
        $recent->the_post();
        $last_modified = get_the_modified_time("d/m/Y " . json_decode('"\u2022"') . " H:i");
        wp_reset_postdata(); // Ripristina i dati del post
        return $last_modified;
    }

    // Se non ci sono post, restituisce una stringa vuota o un messaggio personalizzato
    return '';
}

/**
 * Visualizzo le categorie nell'index
 */
function get_main_categories()
{
    $args = array(
        'parent' => 0, // Prende solo le categorie principali
        'exclude' => array(get_cat_ID('senza categoria'), get_cat_ID('evidenza'), get_cat_ID('Redazione UniVersoMe')),
        'hide_empty' => false // Mostra anche categorie senza post
    );

    return get_categories($args);
}


/**
 * VISUALIZZO LE CATEGORIE E LE LORO SOTTOCATEGORIE DESKTOP
 */
function display_categories_with_subcategories()
{
    $args = array(
        'parent' => 0, // Prende solo le categorie principali
        'exclude' => array(get_cat_ID('senza categoria'), get_cat_ID('evidenza'), get_cat_ID('Redazione UniVersoMe')), // Esclude la categoria "senza categoria" e "evidenza"
        'hide_empty' => false // Mostra anche categorie senza post
    );

    $categories = get_categories($args);
    echo '<ul class="main-menu">';

    foreach ($categories as $category) {
        $subcategories = get_categories(array(
            'parent' => $category->term_id,
            'hide_empty' => false
        ));
        $has_subcategories = !empty($subcategories);

        echo '<li class="category-item relative">';
        echo '<a href="' . get_category_link($category->term_id) . '" class="flex items-center">' . $category->name;

        if ($has_subcategories) {
            echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ml-1 w-4 h-4"><path fill="currentColor" d="M10.103 12.778L16.81 6.08a.69.69 0 0 1 .99.012a.726.726 0 0 1-.012 1.012l-7.203 7.193a.69.69 0 0 1-.985-.006L2.205 6.72a.727.727 0 0 1 0-1.01a.69.69 0 0 1 .99 0z"/></svg>';
        }

        echo '</a>';

        if ($has_subcategories) {
            echo '<ul class="subcategory-menu absolute left-0  bg-white shadow-lg rounded-md hidden">';
            foreach ($subcategories as $subcategory) {
                echo '<li><a href="' . get_category_link($subcategory->term_id) . '" class="block text-sm">' . $subcategory->name . '</a></li>';
            }
            echo '</ul>';
        }

        echo '</li>';
    }

    // Aggiungi il link alla pagina "chi-siamo" alla fine
    echo '<li class="category-item">';
    echo '<a href="' . get_permalink(get_page_by_path('chi-siamo')) . '" class="flex items-center">Chi Siamo</a>';
    echo '</li>';

    echo '</ul>';
}



/**
 * VISUALIZZO LE CATEGORIE E LE LORO SOTTOCATEGORIE DESKTOP
 */
function display_mobile_categories()
{
    $args = array(
        'parent' => 0, // Prende solo le categorie principali
        'exclude' => array(get_cat_ID('senza categoria'), get_cat_ID('evidenza'), get_cat_ID('Redazione UniVersoMe')), // Esclude le categorie "senza categoria" e "evidenza"
        'hide_empty' => false // Mostra anche categorie senza post
    );

    $categories = get_categories($args);
    echo '<ul class="mobile-menu">';

    foreach ($categories as $category) {
        // Estrai le sottocategorie
        $subcategories = get_categories(array(
            'parent' => $category->term_id,
            'hide_empty' => false
        ));
        $has_subcategories = !empty($subcategories);

        echo '<li class="menu-item">';

        // Contenitore per l'elemento padre e la freccia
        echo '<div class="menu-item-content">';

        // Link della categoria principale
        echo '<a href="' . get_category_link($category->term_id) . '" class="menu-link">' . $category->name . '</a>';

        // Icona della freccia (per aprire/chiudere il sottomenu)
        if ($has_subcategories) {
            echo '<span class="arrow-icon" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill="currentColor" d="M10.103 12.778L16.81 6.08a.69.69 0 0 1 .99.012a.726.726 0 0 1-.012 1.012l-7.203 7.193a.69.69 0 0 1-.985-.006L2.205 6.72a.727.727 0 0 1 0-1.01a.69.69 0 0 1 .99 0z"/></svg></span>';
        }

        echo '</div>'; // Chiusura del contenitore menu-item-content

        // Sottomenu
        if ($has_subcategories) {
            echo '<ul class="submenu hidden">';
            foreach ($subcategories as $subcategory) {
                echo '<li><a href="' . get_category_link($subcategory->term_id) . '" class="submenu-link">' . $subcategory->name . '</a></li>';
            }
            echo '</ul>';
        }

        echo '</li>';
    }

    // Aggiungi il link alla pagina "chi-siamo" alla fine del menu, mantenendo lo stesso stile
    echo '<li class="menu-item">';
    echo '<div class="menu-item-content">';
    echo '<a href="' . get_permalink(get_page_by_path('chi-siamo')) . '" class="menu-link">Chi Siamo</a>';
    echo '</div>';
    echo '</li>';

    echo '</ul>';
}


/**
 * RICERCA AJAX
 */
function live_search()
{
    $search_query = isset($_GET['query']) ? esc_attr($_GET['query']) : '';

    $query = new WP_Query(array(
        's' => $search_query,
        'posts_per_page' => 5,
    ));

    if ($query->have_posts()):
        while ($query->have_posts()):
            $query->the_post(); ?>
            <div class="search-card">
                <?php if (has_post_thumbnail()): ?>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('medium', ['class' => 'search-card-image']); ?>
                    </a>
                <?php endif; ?>
                <h3 class="search-card-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>
            </div>
        <?php endwhile;
    else:
        echo '<p>Nessun risultato trovato.</p>';
    endif;

    wp_die();
}
add_action('wp_ajax_nopriv_live_search', 'live_search');
add_action('wp_ajax_live_search', 'live_search');

/**
 * FOOTER MENU MOBILE
 * @return void
 */
function footer_menu_mobile()
{
    // Contenuto HTML del footer mobile
    $html = '
    <div class="mobile-menu-footer">
        <p>Sei un giornalista?</p>
        <a href="/area-accesso">
            <button
                class="text-white bg-[#787878] hover:bg-[#f28b0c] font-semibold rounded-md text-sm px-6 py-3 block w-full mt-3"
                style="border: none;">Accedi</button>
        </a>
    </div>
    ';

    // Stampa l'HTML
    echo $html;
}

/**
 * ULTIMA MODIFICA POST
 */
function get_last_modified_date()
{
    // Esegue una query per ottenere l'ultimo post modificato
    $recent = new WP_Query([
        'post_type' => 'any',
        'posts_per_page' => 1,
        'orderby' => 'modified',
        'order' => 'DESC',
    ]);

    // Verifica se ci sono post
    if ($recent->have_posts()) {
        // Imposta i dati del post corrente
        $recent->the_post();
        // Ottiene la data dell'ultima modifica nel formato desiderato
        $modified_date = get_the_modified_time("d/m/Y " . json_decode('"\u2022"') . " H:i");
    } else {
        // Se non ci sono post, restituisce un messaggio di errore o una stringa vuota
        $modified_date = 'No posts found';
    }

    // Ripristina i dati del post
    wp_reset_postdata();

    // Restituisce la data dell'ultima modifica
    return $modified_date;
}

/**
 * RICERCA GENERALE
 */
function general_search()
{
    ?>
    <!-- Form di ricerca mobile (nascosto di default) -->
    <div class="mobile-search-overlay" id="mobile-search-overlay"></div>
    <div class="hidden md:hidden" id="mobile-search">

        <!-- Header ricerca -->
        <div class="mobile-search-header">
            <span class="close-search" id="close-search">&times;</span>
            <div class="mobile-logo">
                <a href="<?php echo home_url(); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/LOGO.png" alt="Logo">
                </a>
            </div>
        </div>

        <!-- Risultati di ricerca -->
        <div class="mobile-search-content">
            <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>"
                class="flex items-center bg-[#e2e2e2] rounded-full overflow-hidden">
                <input type="text" id="live-search" name="s" placeholder="Cerca..." autocomplete="off"
                    class="search-field" />
            </form>
            <span class="search-hint">Inserisci almeno 3 caratteri.</span>
            <div id="search-results"></div> <!-- Rimosso il loop PHP qui per far spazio alla ricerca AJAX -->
        </div>

        <!-- Footer ricerca -->
        <?php footer_menu_mobile(); ?>
    </div>
    <?php
}
add_action('wp_footer', 'general_search'); // Assicurati che questa funzione sia aggiunta al footer
// Registra le azioni AJAX per utenti loggati e non loggati
add_action('wp_ajax_live_search', 'handle_live_search');
add_action('wp_ajax_nopriv_live_search', 'handle_live_search');


// Funzione per registrare l'endpoint REST API
function register_custom_search_endpoint()
{
    register_rest_route('custom/v1', '/search/', array(
        'methods' => 'GET',
        'callback' => 'handle_custom_search',
        'permission_callback' => '__return_true', // Rende l'endpoint pubblico
    ));
}
add_action('rest_api_init', 'register_custom_search_endpoint');

// Funzione che gestisce la ricerca
function handle_custom_search(WP_REST_Request $request)
{
    $query = sanitize_text_field($request->get_param('query'));

    $args = array(
        's' => $query,
        'post_status' => 'publish',
        'posts_per_page' => 5,
    );

    $search_query = new WP_Query($args);

    $results = array();

    if ($search_query->have_posts()) {
        while ($search_query->have_posts()) {
            $search_query->the_post();
            $results[] = array(
                'title' => get_the_title(),
                'link' => get_permalink(),
                'image' => has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'medium') : '',
            );
        }
    } else {
        $results[] = array('message' => 'Nessun risultato trovato.');
    }

    return rest_ensure_response($results);
}

/**
 * CAROUSEL SWIPER
 */
function enqueue_swiper()
{
    wp_enqueue_style('swiper-css', 'https://unpkg.com/swiper/swiper-bundle.min.css');
    wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_swiper');



/**
 * CAMPI PERSONALIZZATI
 */
function custom_user_profile_fields($user)
{
    if (is_object($user)) {
        $instagram = esc_attr(get_the_author_meta('instagram', $user->ID));
        $threads = esc_attr(get_the_author_meta('threads', $user->ID));
        $linkedin = esc_attr(get_the_author_meta('linkedin', $user->ID));
        $unit = esc_attr(get_the_author_meta('unit', $user->ID));
        $ruolo_uvm = esc_attr(get_the_author_meta('ruolo_uvm', $user->ID));
    } else {
        $instagram = null;
        $threads = null;
        $linkedin = null;
        $unit = null;
        $ruolo_uvm = null;
    }
    ?>
    <h3>Informazioni social</h3>
    <table class="form-table">
        <!-- Instagram -->
        <tr>
            <th><label for="instagram"><?php _e("Instagram", "my_domain"); ?></label></th>
            <td>
                <input type="text" class="regular-text" name="instagram" value="<?php echo esc_attr($instagram); ?>"
                    id="instagram" /><br />
                <span class="description"><?php _e("Inserisci il tuo profilo Instagram."); ?></span>
            </td>
        </tr>

        <!-- threads -->
        <tr>
            <th><label for="threads"><?php _e("Threads", "my_domain"); ?></label></th>
            <td>
                <input type="text" class="regular-text" name="threads" value="<?php echo esc_attr($threads); ?>"
                    id="threads" /><br />
                <span class="description"><?php _e("Inserisci il tuo profilo threads."); ?></span>
            </td>
        </tr>

        <!-- LinkedIn -->
        <tr>
            <th><label for="linkedin"><?php _e("LinkedIn", "my_domain"); ?></label></th>
            <td>
                <input type="text" class="regular-text" name="linkedin" value="<?php echo esc_attr($linkedin); ?>"
                    id="linkedin" /><br />
                <span class="description"><?php _e("Inserisci il tuo profilo LinkedIn."); ?></span>
            </td>
        </tr>

        <!-- Unit -->
        <tr>
            <th><label for="unit"><?php _e("Unità di appartenenza", "my_domain"); ?></label></th>
            <td>
                <select name="unit" id="unit">
                    <option value="">Seleziona un'unità</option>
                    <option value="giornale" <?php selected($unit, 'giornale'); ?>>Giornale</option>
                    <option value="radio" <?php selected($unit, 'radio'); ?>>Radio</option>
                    <option value="creativa_grafica" <?php selected($unit, 'creativa_grafica'); ?>>Creativa / Grafica
                    </option>
                    <option value="social" <?php selected($unit, 'social'); ?>>Social</option>
                    <option value="informatica" <?php selected($unit, 'informatica'); ?>>Informatica</option>
                </select>
                <br />
                <span class="description"><?php _e("Seleziona l'unità di appartenenza."); ?></span>
                <?php if (empty($unit)): ?>
                    <p class="required-field"><?php _e("Questo campo è obbligatorio"); ?></p>
                <?php endif; ?>
            </td>
        </tr>

        <!-- Ruolo UVM -->
        <tr>
            <th><label for="ruolo_uvm"><?php _e("Ruolo UVM", "my_domain"); ?></label></th>
            <td>
                <select name="ruolo_uvm" id="ruolo_uvm">
                    <option value="">Seleziona un ruolo</option>
                    <option value="caposervizio" <?php selected($ruolo_uvm, 'caposervizio'); ?>>Caposervizio</option>
                    <option value="redattore" <?php selected($ruolo_uvm, 'redattore'); ?>>Redattore</option>
                    <option value="responsabile_unit" <?php selected($ruolo_uvm, 'responsabile_unit'); ?>>Responsabile UNIT
                    </option>
                    <option value="coordinatrice_uvm" <?php selected($ruolo_uvm, 'coordinatrice_uvm'); ?>>Coordinatrice UVM
                    </option>
                </select>
                <br />
                <span class="description"><?php _e("Seleziona il tuo ruolo UVM."); ?></span>
                <?php if (empty($ruolo_uvm)): ?>
                    <p class="required-field"><?php _e("Questo campo è obbligatorio"); ?></p>
                <?php endif; ?>
            </td>
        </tr>
    </table>

    <?php
}
add_action('show_user_profile', 'custom_user_profile_fields');
add_action('edit_user_profile', 'custom_user_profile_fields');
add_action("user_new_form", "custom_user_profile_fields");

function save_custom_user_profile_fields($user_id)
{
    // Assicurati che l'utente possa modificare il profilo
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }

    // Salva i campi personalizzati
    update_user_meta($user_id, 'instagram', sanitize_text_field($_POST['instagram']));
    update_user_meta($user_id, 'threads', sanitize_text_field($_POST['threads']));
    update_user_meta($user_id, 'linkedin', sanitize_text_field($_POST['linkedin']));
    update_user_meta($user_id, 'unit', sanitize_text_field($_POST['unit']));
    update_user_meta($user_id, 'ruolo_uvm', sanitize_text_field($_POST['ruolo_uvm']));
}
add_action('personal_options_update', 'save_custom_user_profile_fields');
add_action('edit_user_profile_update', 'save_custom_user_profile_fields');



/*
VERIFICO SE L'UTENTE HA INSERITO DESCRIZIONE, AVATAR E UNITÀ/RUOLO
*/

function check_user_profile_completion()
{
    $current_user = wp_get_current_user();
    $custom_avatar = get_user_meta($current_user->ID, 'custom_avatar', true);
    $unit = get_user_meta($current_user->ID, 'unit', true);
    $ruolo_uvm = get_user_meta($current_user->ID, 'ruolo_uvm', true);

    // Aggiungiamo un log per debug
    error_log("Debug: User ID: " . $current_user->ID);
    error_log("Debug: Custom Avatar: " . $custom_avatar);
    error_log("Debug: Unit: " . $unit);
    error_log("Debug: Ruolo UVM: " . $ruolo_uvm);

    if (empty($custom_avatar) || empty($unit) || empty($ruolo_uvm)) {
        return false;
    }
    return true;
}

/**
 * ESEGUO IL REDIRECT SULLA PAGINA DEL PROFILO
 */
function redirect_to_profile_page()
{
    if (is_admin() && !check_user_profile_completion() && !isset($_GET['page']) && $_SERVER['PHP_SELF'] != '/wp-admin/profile.php') {
        wp_redirect(admin_url('profile.php'));
        exit;
    }
}
add_action('admin_init', 'redirect_to_profile_page');

/**
 * MESSAGGIO DI AVVISO
 */
function show_profile_completion_notice()
{
    if (!check_user_profile_completion()) {
        $class = 'notice notice-warning';
        $current_user = wp_get_current_user();
        $custom_avatar = get_user_meta($current_user->ID, 'custom_avatar', true);
        $unit = get_user_meta($current_user->ID, 'unit', true);
        $ruolo_uvm = get_user_meta($current_user->ID, 'ruolo_uvm', true);

        if (empty($custom_avatar) && empty($unit) && empty($ruolo_uvm)) {
            $message = __('Per favore, completa il tuo profilo aggiungendo un avatar personalizzato, la tua unità di appartenenza e il tuo ruolo UVM.', 'textdomain');
        } elseif (empty($custom_avatar)) {
            $message = __('Per favore, completa il tuo profilo aggiungendo un avatar personalizzato.', 'textdomain');
        } elseif (empty($unit)) {
            $message = __('Per favore, completa il tuo profilo selezionando la tua unità di appartenenza.', 'textdomain');
        } elseif (empty($ruolo_uvm)) {
            $message = __('Per favore, completa il tuo profilo selezionando il tuo ruolo UVM.', 'textdomain');
        }

        printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
    }
}
add_action('admin_notices', 'show_profile_completion_notice');

/**
 * NASCONDO SEZIONE AVATAR PREDEFINITA DI WP
 */
function hide_default_avatar_section()
{
    echo '<style>
        .user-profile-picture,
        .user-profile-picture + .form-table {
            display: none !important;
        }
    </style>';
}
add_action('admin_head-profile.php', 'hide_default_avatar_section');
add_action('admin_head-user-edit.php', 'hide_default_avatar_section');

/**
 * AGGIUNGO CAMPO AVATAR PERSONALIZZATO
 */
function add_custom_avatar_field($user)
{
    ?>
    <h2><?php _e('Avatar personalizzato', 'textdomain'); ?></h2>
    <table class="form-table">
        <tr>
            <th><label for="custom_avatar"><?php _e('Il tuo avatar', 'textdomain'); ?></label></th>
            <td>
                <?php
                $custom_avatar = get_user_meta($user->ID, 'custom_avatar', true);
                if ($custom_avatar) {
                    echo '<img src="' . esc_url($custom_avatar) . '" style="max-width: 150px; height: auto; border-radius: 50%;" /><br /><br />';
                }
                ?>
                <input type="file" name="custom_avatar" id="custom_avatar" accept="image/*" />
                <p class="description">
                    <?php _e('Carica un\'immagine per usarla come avatar personalizzato. L\'immagine ideale dovrebbe essere quadrata e di almeno 150x150 pixel. Dopo, premi su "Aggiorna profilo"', 'textdomain'); ?>
                </p>
            </td>
        </tr>
    </table>
    <?php
}
add_action('show_user_profile', 'add_custom_avatar_field');
add_action('edit_user_profile', 'add_custom_avatar_field');

/**
 * SALVA L'AVATAR PERSONALIZZATO
 */
function save_custom_avatar($user_id)
{
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }

    if (isset($_FILES['custom_avatar']) && $_FILES['custom_avatar']['size'] > 0) {
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');

        $attachment_id = media_handle_upload('custom_avatar', 0);

        if (is_wp_error($attachment_id)) {
            error_log('Errore nel caricamento dell\'avatar: ' . $attachment_id->get_error_message());
        } else {
            $attachment_url = wp_get_attachment_url($attachment_id);
            update_user_meta($user_id, 'custom_avatar', $attachment_url);
        }
    }
}
add_action('personal_options_update', 'save_custom_avatar');
add_action('edit_user_profile_update', 'save_custom_avatar');



function add_enctype_to_profile_form()
{
    echo ' enctype="multipart/form-data"';
}
add_action('user_edit_form_tag', 'add_enctype_to_profile_form');

/**
 * DEBUG AVATAR UPLOAD
 */
function debug_avatar_upload($user_id)
{
    error_log('Debug: Tentativo di caricamento avatar per l\'utente ' . $user_id);
    if (isset($_FILES['custom_avatar'])) {
        error_log('Debug: File avatar presente');
        error_log('Debug: Nome file: ' . $_FILES['custom_avatar']['name']);
        error_log('Debug: Dimensione file: ' . $_FILES['custom_avatar']['size']);
        error_log('Debug: Tipo file: ' . $_FILES['custom_avatar']['type']);
    } else {
        error_log('Debug: Nessun file avatar presente');
    }
}
add_action('personal_options_update', 'debug_avatar_upload');
add_action('edit_user_profile_update', 'debug_avatar_upload');

/**
 * DEBUG SUL SALVATAGGIO DEL PROFILO
 */
function debug_profile_save($user_id)
{
    $user_description = get_user_meta($user_id, 'description', true);
    $custom_avatar = get_user_meta($user_id, 'custom_avatar', true);
    $unit = get_user_meta($user_id, 'unit', true);
    $role = get_user_meta($user_id, 'role', true);

    error_log("Debug: Profilo salvato per l'utente " . $user_id);
    error_log("Debug: Descrizione dopo il salvataggio: " . $user_description);
    error_log("Debug: Avatar personalizzato dopo il salvataggio: " . $custom_avatar);
    error_log("Debug: Unità di appartenenza dopo il salvataggio: " . $unit);
    error_log("Debug: Ruolo dopo il salvataggio: " . $role);
}
add_action('profile_update', 'debug_profile_save');

/**
 * USA L'AVATAR PERSONALIZZATO
 */
function use_custom_avatar($avatar, $id_or_email, $size, $default, $alt)
{
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
            $avatar = "<img alt='{$alt}' src='{$custom_avatar}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
        }
    }

    return $avatar;
}
add_filter('get_avatar', 'use_custom_avatar', 10, 5);

// Applica le modifiche solo nella pagina del profilo


/**
 * YOUTUBE EMBEDDED
 */
function youtube_embedded()
{
    // Dichiara la chiave API di YouTube e l'ID del canale all'interno della funzione
    $apiKey = 'AIzaSyBlnoieZlBGVKeDYrWRksinsG9t6TqLYYA'; // Sostituisci con la tua chiave API
    $channelId = 'UCvrsxLP6lC5TXYiTv1bne7w'; // Sostituisci con l'ID del tuo canale

    // URL per ottenere gli ultimi video del canale
    $apiUrl = "https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId=$channelId&maxResults=1&key=$apiKey";

    // Esegui la richiesta
    $response = file_get_contents($apiUrl);

    // Decodifica la risposta JSON
    $data = json_decode($response);

    // Controlla se ci sono risultati
    if (!empty($data->items)) {
        // Ottieni l'ID dell'ultimo video
        $videoId = $data->items[0]->id->videoId;

        // Genera e restituisci l'iframe di embedding
        return "<iframe class='video-frame' src='https://www.youtube.com/embed/" . $videoId . "' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; fullscreen'></iframe>";
    } else {
        return "Nessun video trovato.";
    }
}




// Funzione per incorporare l'ultimo video di YouTube
function radio_youtube_embedded()
{
    $apiKey = 'AIzaSyBlnoieZlBGVKeDYrWRksinsG9t6TqLYYA'; // Sostituisci con la tua chiave API
    $channelId = 'UCvrsxLP6lC5TXYiTv1bne7w'; // Sostituisci con l'ID del tuo canale

    // URL per ottenere gli ultimi video del canale
    $apiUrl = "https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId=$channelId&maxResults=1&key=$apiKey";

    // Esegui la richiesta
    $response = file_get_contents($apiUrl);

    // Decodifica la risposta JSON
    $data = json_decode($response);

    // Controlla se ci sono risultati
    if (!empty($data->items)) {
        $videoId = $data->items[0]->id->videoId;

        // Genera e restituisci l'iframe con la classe radio-video-frame per l'embed
        return "<iframe class='radio-video-frame' 
                src='https://www.youtube.com/embed/" . $videoId . "' 
                frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' 
                allowfullscreen></iframe>";
    } else {
        return "<p>Nessun video trovato.</p>";
    }
}



/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function uvm_setup()
{
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on UVM, use a find and replace
     * to change 'uvm' to the name of your theme in all the template files.
     */
    load_theme_textdomain('uvm', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support('title-tag');

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'menu-1' => esc_html__('Primary', 'uvm'),
        )
    );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Set up the WordPress core custom background feature.
    add_theme_support(
        'custom-background',
        apply_filters(
            'uvm_custom_background_args',
            array(
                'default-color' => 'ffffff',
                'default-image' => '',
            )
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
        'custom-logo',
        array(
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        )
    );
}
add_action('after_setup_theme', 'uvm_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function uvm_content_width()
{
    $GLOBALS['content_width'] = apply_filters('uvm_content_width', 640);
}
add_action('after_setup_theme', 'uvm_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function uvm_widgets_init()
{
    register_sidebar(
        array(
            'name' => esc_html__('Sidebar', 'uvm'),
            'id' => 'sidebar-1',
            'description' => esc_html__('Add widgets here.', 'uvm'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );
}
add_action('widgets_init', 'uvm_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function uvm_scripts()
{
    wp_enqueue_style('uvm-style', get_stylesheet_uri(), array(), _S_VERSION);
    wp_style_add_data('uvm-style', 'rtl', 'replace');
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'uvm_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}