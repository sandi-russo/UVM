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











function update_all_usernames() {
    global $wpdb;

    // Ottieni tutti gli utenti
    $users = get_users();
    
    // Array per tenere traccia dei nomi utente già utilizzati
    $used_usernames = array();
    
    foreach ($users as $user) {
        $first_name = get_user_meta($user->ID, 'first_name', true);
        $last_name = get_user_meta($user->ID, 'last_name', true);
        
        // Se nome o cognome sono vuoti, salta questo utente
        if (empty($first_name) || empty($last_name)) {
            continue;
        }
        
        // Rimuovi gli spazi e converti in minuscolo
        $first_name = strtolower(str_replace(' ', '', $first_name));
        $last_name = strtolower(str_replace(' ', '', $last_name));
        
        // Crea il nuovo nome utente base
        $new_username = sanitize_user($first_name . '.' . $last_name);
        
        // Gestisci gli omonimi
        $final_username = $new_username;
        $counter = 1;
        while (username_exists($final_username) && $final_username !== $user->user_login) {
            $final_username = $new_username . $counter;
            $counter++;
        }
        
        // Aggiorna il nome utente
        if ($user->user_login !== $final_username) {
            $wpdb->update(
                $wpdb->users,
                array('user_login' => $final_username),
                array('ID' => $user->ID)
            );
            
            // Aggiorna anche user_nicename per coerenza
            wp_update_user(array(
                'ID' => $user->ID,
                'user_nicename' => $final_username
            ));
            
            // Log dell'aggiornamento (opzionale)
            error_log("Aggiornato nome utente per l'utente ID {$user->ID} da {$user->user_login} a {$final_username}");
        }
    }
}

// Aggancia la funzione all'azione di login
add_action('wp_login', 'update_all_usernames');

// Funzione per aggiornare un singolo utente (utile per i nuovi registrati)
function update_single_username($user_id) {
    $user = get_user_by('ID', $user_id);
    if ($user) {
        update_all_usernames();
    }
}

// Aggancia la funzione alla creazione di un nuovo utente
add_action('user_register', 'update_single_username');

























/**
 * YOAST REMOVE PROFILE
 */
add_filter('user_contactmethods', 'yoast_seo_admin_user_remove_social', 99);

function yoast_seo_admin_user_remove_social($contactmethods)
{
    unset($contactmethods['facebook']);
    unset($contactmethods['instagram']);
    unset($contactmethods['linkedin']);
    unset($contactmethods['myspace']);
    unset($contactmethods['pinterest']);
    unset($contactmethods['soundcloud']);
    unset($contactmethods['tumblr']);
    unset($contactmethods['twitter']);
    unset($contactmethods['youtube']);
    unset($contactmethods['wikipedia']);
    unset($contactmethods['mastodon']); // Premium feature

    //Do not remove the lines below
    return $contactmethods;
}


/**
 *  USER NAME AND SURNAME IN UPPERCASE
 */
function get_author_full_name_uppercase($author_id)
{
    $first_name = mb_strtoupper(get_the_author_meta('first_name', $author_id));
    $last_name = mb_strtoupper(get_the_author_meta('last_name', $author_id));
    return $first_name . ' ' . $last_name;
}


/** 
 * Modifica il form di login
 */

function custom_login_form()
{
    add_action('login_footer', 'add_custom_login_script');
}
add_action('login_init', 'custom_login_form');

function add_custom_login_script()
{
    ?>
    <style>
        /* Stile per il pulsante di accesso */
        #show-admin-login {
            display: inline-block;
            padding: 5px 10px;
            /* Riduce il padding per un pulsante più piccolo */
            background-color: red;
            /* Colore rosso per il pulsante */
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 12px;
            /* Dimensione del font più piccola */
            cursor: pointer;
            text-decoration: none;
        }

        #show-admin-login:hover {
            background-color: darkred;
            /* Colore rosso scuro al passaggio del mouse */
        }

        /* Centrare il pulsante all'interno del contenitore */
        #admin-login-container {
            text-align: center;
            /* Centra il contenuto all'interno del contenitore */
            margin-top: 20px;
            /* Aggiungi uno spazio sopra il contenitore */
        }

        /* Allineare il contenitore al centro del modulo di login */
        #loginform {
            position: relative;
            /* Per gestire il posizionamento del contenitore */
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var loginForm = document.getElementById('loginform');
            var userLoginWrap = document.getElementById('user_login').parentNode; // Wrapper del campo username
            var userPassWrap = document.getElementById('user_pass').parentNode; // Wrapper del campo password
            var userPass = document.getElementById('user_pass'); // Campo password
            var submitButton = document.getElementById('wp-submit');
            var passwordLabel = document.querySelector('label[for="user_pass"]'); // Etichetta della password

            // Creare e inserire il contenitore per il pulsante
            var adminLoginContainer = document.createElement('div');
            adminLoginContainer.id = 'admin-login-container';
            loginForm.parentNode.insertBefore(adminLoginContainer, loginForm);

            // Creare e inserire il nuovo pulsante
            var showLoginButton = document.createElement('button');
            showLoginButton.type = 'button';
            showLoginButton.id = 'show-admin-login';
            showLoginButton.textContent = 'Accedi con le credenziali (solo amministratori)';
            adminLoginContainer.appendChild(showLoginButton);

            // Nascondere inizialmente i campi di login e disabilitare il campo della password
            if (userLoginWrap && userPassWrap && submitButton && userPass && passwordLabel) {
                userLoginWrap.style.display = 'none';
                userPassWrap.style.display = 'none';
                submitButton.style.display = 'none';
                userPass.disabled = true;
                passwordLabel.style.display = 'none'; // Nascondere l'etichetta della password
            }

            showLoginButton.addEventListener('click', function () {
                if (userLoginWrap.style.display === 'none') {
                    userLoginWrap.style.display = 'block';
                    userPassWrap.style.display = 'block';
                    submitButton.style.display = 'block';
                    userPass.disabled = false; // Abilitare il campo della password
                    passwordLabel.style.display = 'block'; // Mostrare l'etichetta della password
                    this.textContent = 'Nascondi form di login';
                } else {
                    userLoginWrap.style.display = 'none';
                    userPassWrap.style.display = 'none';
                    submitButton.style.display = 'none';
                    userPass.disabled = true; // Disabilitare il campo della password
                    passwordLabel.style.display = 'none'; // Nascondere l'etichetta della password
                    this.textContent = 'Accedi con le credenziali (solo amministratori)';
                }
            });
        });
    </script>
    <?php
}

// La funzione che hai già aggiunto per limitare l'accesso
// La funzione che limita l'accesso
function restrict_login_for_non_admins($user, $username, $password)
{
    // Verifica se l'utente ha i ruoli di amministratore o redazione (personalizzato)
    if (isset($user->roles) && is_array($user->roles) && (in_array('administrator', $user->roles) || in_array('redazione', $user->roles))) {
        return $user;
    }

    // Se l'utente non ha il ruolo appropriato, viene restituito un errore
    return new WP_Error('no_login', __('L\'accesso tramite username e password è riservato solo agli amministratori e alla redazione. Si prega di usare il login tramite UNIME.'));
}
add_filter('authenticate', 'restrict_login_for_non_admins', 30, 3);




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
        'parent' => 0,
        'exclude' => array(get_cat_ID('senza categoria'), get_cat_ID('evidenza'), get_cat_ID('Redazione UniVersoMe')),
        'hide_empty' => false
    );

    $categories = get_categories($args);
    echo '<ul class="main-menu">';

    // Verifica se la pagina corrente è "home"
    /* $is_active_home = is_front_page() ? 'active' : '';

     echo '<li class="category-item ' . $is_active_home . '">';
     echo '<a href="' . home_url() . '" class="category-link">Home</a>';
     echo '</li>';*/

    foreach ($categories as $category) {
        $subcategories = get_categories(array(
            'parent' => $category->term_id,
            'hide_empty' => false
        ));
        $has_subcategories = !empty($subcategories);

        // Verifica se la categoria è quella corrente o se una delle sue sottocategorie è attiva
        $is_active = is_category($category->term_id) || (is_category() && in_array(get_query_var('cat'), wp_list_pluck($subcategories, 'term_id'))) ? 'active' : '';

        echo '<li class="category-item ' . $is_active . '">';
        echo '<a href="' . get_category_link($category->term_id) . '" class="category-link">' . $category->name;

        if ($has_subcategories) {
            echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="category-icon"><path fill="currentColor" d="M10.103 12.778L16.81 6.08a.69.69 0 0 1 .99.012a.726.726 0 0 1-.012 1.012l-7.203 7.193a.69.69 0 0 1-.985-.006L2.205 6.72a.727.727 0 0 1 0-1.01a.69.69 0 0 1 .99 0z"/></svg>';
        }

        echo '</a>';

        if ($has_subcategories) {
            echo '<ul class="subcategory-menu">';
            foreach ($subcategories as $subcategory) {
                // Verifica se la sottocategoria è quella corrente
                $is_active_sub = is_category($subcategory->term_id) ? 'active' : '';
                echo '<li><a href="' . get_category_link($subcategory->term_id) . '" class="subcategory-link ' . $is_active_sub . '">' . $subcategory->name . '</a></li>';
            }
            echo '</ul>';
        }

        echo '</li>';
    }

    // Verifica se la pagina corrente è "chi-siamo"
    /*$is_active_chi_siamo = is_page('chi-siamo') ? 'active' : '';

    echo '<li class="category-item ' . $is_active_chi_siamo . '">';
    echo '<a href="' . get_permalink(get_page_by_path('chi-siamo')) . '" class="category-link">Chi Siamo</a>';
    echo '</li>';*/

    echo '</ul>';
}




/**
 * VISUALIZZO LE CATEGORIE E LE LORO SOTTOCATEGORIE DESKTOP
 */
function display_mobile_categories()
{
    $args = array(
        'parent' => 0,
        'exclude' => array(get_cat_ID('senza categoria'), get_cat_ID('evidenza'), get_cat_ID('Redazione UniVersoMe')),
        'hide_empty' => false
    );

    $categories = get_categories($args);
    echo '<ul class="mobile-menu">';

    // Aggiungi il link per tornare alla home
    echo '<li class="menu-item">';
    echo '<div class="menu-item-content">';
    echo '<a href="' . home_url() . '" class="menu-link">Home</a>';
    echo '</div>';
    echo '</li>';

    // Aggiungi le categorie
    foreach ($categories as $category) {
        $subcategories = get_categories(array(
            'parent' => $category->term_id,
            'hide_empty' => false
        ));
        $has_subcategories = !empty($subcategories);

        $is_active = is_category($category->term_id) ? 'active' : '';

        echo '<li class="menu-item ' . $is_active . '">';
        echo '<div class="menu-item-content">';
        echo '<a href="' . get_category_link($category->term_id) . '" class="menu-link">' . $category->name . '</a>';

        if ($has_subcategories) {
            echo '<span class="arrow-icon" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill="currentColor" d="M10.103 12.778L16.81 6.08a.69.69 0 0 1 .99.012a.726.726 0 0 1-.012 1.012l-7.203 7.193a.69.69 0 0 1-.985-.006L2.205 6.72a.727.727 0 0 1 0-1.01a.69.69 0 0 1 .99 0z"/></svg></span>';
        }

        echo '</div>';

        if ($has_subcategories) {
            echo '<ul class="submenu hidden">';
            foreach ($subcategories as $subcategory) {
                $is_active_sub = is_category($subcategory->term_id) ? 'active' : '';
                echo '<li><a href="' . get_category_link($subcategory->term_id) . '" class="submenu-link ' . $is_active_sub . '">' . $subcategory->name . '</a></li>';
            }
            echo '</ul>';
        }

        echo '</li>';
    }

    // Elenca tutte le pagine pubblicate
    $pages = get_pages(array('sort_column' => 'post_title', 'sort_order' => 'asc'));
    foreach ($pages as $page) {
        $is_active = is_page($page->ID) ? 'active' : '';

        echo '<li class="menu-item ' . $is_active . '">';
        echo '<div class="menu-item-content">';
        echo '<a href="' . get_permalink($page->ID) . '" class="menu-link">' . esc_html($page->post_title) . '</a>';
        echo '</div>';
        echo '</li>';
    }

    echo '</ul>'; // Fine della lista non ordinata
}



/**
 * Visualizzo tutte le pagine
 */
function view_all_pages()
{
    // Ottieni tutte le pagine pubblicate
    $pages = get_pages(array('sort_column' => 'post_title', 'sort_order' => 'asc'));

    // Inizio dell'output HTML
    echo '<div class="all-pages">';
    echo '<ul>'; // Inizio della lista non ordinata

    // Aggiungi il link alla homepage
    $is_active_home = is_front_page() ? 'active' : '';
    echo '<li class="category-item ' . $is_active_home . '">';
    echo '<a href="' . home_url() . '" class="category-link">Home</a>';
    echo '</li>';

    // Aggiungi il link alla pagina della radio subito dopo la homepage
    $radio_page = get_page_by_path('radio');
    if ($radio_page) {
        $is_active_radio = is_page($radio_page->ID) ? 'active' : '';
        echo '<li class="category-item ' . $is_active_radio . '">';
        echo '<a href="' . get_permalink($radio_page->ID) . '" class="category-link">' . esc_html($radio_page->post_title) . '</a>';
        echo '</li>';
    }

    // Elenca tutte le altre pagine
    foreach ($pages as $page) {
        // Salta la pagina della radio poiché è già stata aggiunta
        if ($page->post_name == 'radio') {
            continue;
        }

        // Controlla se la pagina corrente è quella visualizzata
        $is_active = is_page($page->ID) ? 'active' : '';

        // Crea un link per ogni pagina con classe attiva se necessario
        echo '<li class="category-item ' . $is_active . '">';
        echo '<a href="' . get_permalink($page->ID) . '" class="category-link">' . esc_html($page->post_title) . '</a>';
        echo '</li>';
    }

    echo '</ul>'; // Fine della lista non ordinata
    echo '</div>';
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
            <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="mobile-search-bar">
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
                <span
                    class="description"><?php _e("Inserisci il tuo profilo Instagram.<br>INSERISCI L'USERNAME, NON IL LINK COMPLETO."); ?></span>
            </td>
        </tr>

        <!-- threads -->
        <tr>
            <th><label for="threads"><?php _e("Threads", "my_domain"); ?></label></th>
            <td>
                <input type="text" class="regular-text" name="threads" value="<?php echo esc_attr($threads); ?>"
                    id="threads" /><br />
                <span
                    class="description"><?php _e("Inserisci il tuo profilo Threads.<br>INSERISCI L'USERNAME, NON IL LINK COMPLETO."); ?></span>
            </td>
        </tr>

        <!-- LinkedIn -->
        <tr>
            <th><label for="linkedin"><?php _e("LinkedIn", "my_domain"); ?></label></th>
            <td>
                <input type="text" class="regular-text" name="linkedin" value="<?php echo esc_attr($linkedin); ?>"
                    id="linkedin" /><br />
                <span
                    class="description"><?php _e("Inserisci il tuo profilo LinkedIn.<br>INSERISCI L'USERNAME, NON IL LINK COMPLETO."); ?></span>
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
                    </option>
                    <option value="membro" <?php selected($ruolo_uvm, 'membro'); ?>>Membro
                    </option>
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

        // Carica l'immagine come allegato
        $attachment_id = media_handle_upload('custom_avatar', 0);

        if (is_wp_error($attachment_id)) {
            error_log('Errore nel caricamento dell\'avatar: ' . $attachment_id->get_error_message());
        } else {
            $attachment_url = wp_get_attachment_url($attachment_id);

            // Ritaglia l'immagine per renderla circolare
            $file_path = get_attached_file($attachment_id);
            $image = wp_get_image_editor($file_path);

            if (!is_wp_error($image)) {
                // Ottieni dimensioni dell'immagine
                $size = $image->get_size();
                $width = $size['width'];
                $height = $size['height'];

                // Calcola il lato minimo per rendere l'immagine quadrata
                $min_size = min($width, $height);
                $x = ($width - $min_size) / 2;
                $y = ($height - $min_size) / 2;

                // Ritaglia l'immagine come quadrata
                $image->crop($x, $y, $min_size, $min_size, 150, 150);

                // Salva l'immagine ritagliata
                $saved = $image->save($file_path);

                if (!is_wp_error($saved)) {
                    // Applica il ritaglio circolare via CSS (aggiungiamo un campo meta)
                    update_user_meta($user_id, 'custom_avatar', $attachment_url);
                } else {
                    error_log('Errore nel salvataggio dell\'immagine ritagliata: ' . $saved->get_error_message());
                }
            } else {
                error_log('Errore nell\'editor di immagini: ' . $image->get_error_message());
            }
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
            $avatar = "<img alt='{$alt}' src='{$custom_avatar}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' style='border-radius: 50%; object-fit: cover;' />";
        }
    }

    return $avatar;
}
add_filter('get_avatar', 'use_custom_avatar', 10, 5);

/**
 * Spotify
 */
function spotify_embedded()
{
    return '
                <div class="latest-episode">
                <img id="episode-cover" src="" alt="Copertina Episodio" />
                <div class="info">
                    <div class="scroll-container">
                        <span id="episode-title"></span>
                    </div>
                    <p id="podcast-name"></p>
                    <p>Pubblicato il: <span id="episode-date"></span></p>
                    <div class="audio-controls">
                        <button id="play-pause-btn" onclick="togglePlayPause()">
                            <svg class="play-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M18.54 9L8.88 3.46a3.42 3.42 0 0 0-5.13 3v11.12A3.42 3.42 0 0 0 7.17 21a3.43 3.43 0 0 0 1.71-.46L18.54 15a3.42 3.42 0 0 0 0-5.92Zm-1 4.19l-9.66 5.62a1.44 1.44 0 0 1-1.42 0a1.42 1.42 0 0 1-.71-1.23V6.42a1.42 1.42 0 0 1 .71-1.23A1.5 1.5 0 0 1 7.17 5a1.54 1.54 0 0 1 .71.19l9.66 5.58a1.42 1.42 0 0 1 0 2.46Z" />
                            </svg>
                        </button>
                        <input type="range" id="progress-slider" min="0" max="100" value="0">
                        <span id="current-time">0:00</span> / <span id="duration">0:00</span>
                    </div>
                </div>
                <svg class="spotify-logo" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="1.5">
                        <path d="M7 15s4.5-1 9 1m-9.5-4s6-1.5 11 1.5M6 9c3-.5 8-1 13 2" />
                        <path d="M12 22.5a10.5 10.5 0 1 0 0-21a10.5 10.5 0 0 0 0 21Z" />
                    </g>
                </svg>
            </div>
    ';
}

/**
 * Radio
 */
function radio_embedded()
{
    return '
        <div class="latest-episode">
            <img src="default_image.jpg" alt="Copertina Album" id="album-art">
            <div class="info">
                <div class="scroll-container episode-title" id="episode-title-azuracast">Caricamento...</div>
                <div class="artist-name" id="artist-name">Caricamento...</div>
            </div>
            <button type="button" title="Play" aria-label="Play" class="radio-control-play-button" id="play-button">
                <!-- Icona di Play -->
                <svg class="play-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                    <path fill="currentColor"
                        d="M18.54 9L8.88 3.46a3.42 3.42 0 0 0-5.13 3v11.12A3.42 3.42 0 0 0 7.17 21a3.43 3.43 0 0 0 1.71-.46L18.54 15a3.42 3.42 0 0 0 0-5.92Zm-1 4.19l-9.66 5.62a1.44 1.44 0 0 1-1.42 0a1.42 1.42 0 0 1-.71-1.23V6.42a1.42 1.42 0 0 1 .71-1.23A1.5 1.5 0 0 1 7.17 5a1.54 1.54 0 0 1 .71.19l9.66 5.58a1.42 1.42 0 0 1 0 2.46Z" />
                </svg>
            </button>
            <svg class="azuracast-logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="radio-uvm-icon">
                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" color="currentColor">
                    <path d="M7 9.5a2.5 2.5 0 1 1-5 0a2.5 2.5 0 0 1 5 0m0 0V2c.333.5.6 2.6 3 3" />
                    <circle cx="10.5" cy="19.5" r="2.5" />
                    <circle cx="20" cy="18" r="2" />
                    <path d="M13 19.5V11c0-.91 0-1.365.247-1.648c.246-.282.747-.35 1.748-.487c3.014-.411 5.206-1.667 6.375-2.436c.28-.184.42-.276.525-.22s.105.223.105.554v11.163" />
                    <path d="M13 13c4.8 0 8-2.333 9-3" />
                </g>
            </svg>
        </div>
    ';
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