<?php
/**
 * UNIVERSOME functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package UNIVERSOME
 */

if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

/* Header title */
function custom_title($title) {
    // Prepend "UVM | " to every title
    return 'UVM | ' . $title;
}

if (version_compare($GLOBALS['wp_version'], '4.4', '<')) {
    // For versions before 4.4
    add_filter('wp_title', 'custom_title');
} else {
    // For WordPress 4.4 and newer
    add_filter('pre_get_document_title', 'custom_title');
}



/*  Post per pagina */
function set_author_posts_per_page($query) {
    if (!is_admin() && $query->is_main_query() && is_author()) {
        $query->set('posts_per_page', 9); // Mostra 9 post per pagina
    }
}
add_action('pre_get_posts', 'set_author_posts_per_page');


/* Post prima lettera */
function post_first_letter($content = '')
{
    $pattern = '/<p( .*)?( class="(.*)")??( .*)?>((<[^>]*>|\s)*)(("|“|‘|‘|“|\')?[A-Z])/U';
    $replacement = '<p><span title="$7" class="post-first-letter">$7</span>';
    $content = preg_replace($pattern, $replacement, $content, 1);
    return $content;
}

add_filter('the_content', 'post_first_letter');



/* Ultima modifica */
function get_last_modified_date()
{
    global $wpdb;
    $last_modified = $wpdb->get_var("
        SELECT post_modified
        FROM $wpdb->posts
        WHERE post_status = 'publish'
        ORDER BY post_modified DESC
        LIMIT 1
    ");
    return $last_modified ? date('d/m/Y, H:i', strtotime($last_modified)) : '';
}


/**
 * Enqueue scripts and styles.
 */
function cg_your_theme_scripts()
{
    wp_enqueue_style('output', get_template_directory_uri() . '/dist/output.css', array());
}
add_action('wp_enqueue_scripts', 'cg_your_theme_scripts');

function enqueue_swiper()
{
    wp_enqueue_style('swiper-css', 'https://unpkg.com/swiper/swiper-bundle.min.css');
    wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_swiper');

/*
Ottengo la data attuale e mi estrapolo l'anno
*/
function get_current_year()
{
    return date("Y");
}


/*
Richiamo e sfrutto lo styling
*/
add_action('wp_enqueue_scripts', 'enqueue_parent_styles');

function enqueue_parent_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/src/style.css');
}

/* Includo il file 'custom.js' */
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
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function universome_theme_setup()
{
    // Aggiungi supporto per i blocchi
    add_theme_support('post-thumbnails');
    add_theme_support('editor-styles');
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('editor-color-palette', array(
        array(
            'name' => __('Primary', 'universome'),
            'slug' => 'primary',
            'color' => '#0073aa',
        ),
        // Aggiungi altri colori qui
    )
    );
    add_theme_support('editor-font-sizes', array(
        array(
            'name' => __('Small', 'universome'),
            'size' => 12,
            'slug' => 'small'
        ),
        array(
            'name' => __('Normal', 'universome'),
            'size' => 16,
            'slug' => 'normal'
        ),
        // Aggiungi altre dimensioni di font qui
    )
    );
}
add_action('after_setup_theme', 'universome_theme_setup');


function universome_editor_styles()
{
    add_editor_style('style.css');
}
add_action('admin_init', 'universome_editor_styles');





















/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function universome_content_width()
{
    $GLOBALS['content_width'] = apply_filters('universome_content_width', 640);
}
add_action('after_setup_theme', 'universome_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function universome_widgets_init()
{
    register_sidebar(
        array(
            'name' => esc_html__('Sidebar', 'universome'),
            'id' => 'sidebar-1',
            'description' => esc_html__('Add widgets here.', 'universome'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );
}
add_action('widgets_init', 'universome_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function universome_scripts()
{
    wp_enqueue_style('universome-style', get_stylesheet_uri(), array(), _S_VERSION);
    wp_style_add_data('universome-style', 'rtl', 'replace');

    wp_enqueue_script('universome-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'universome_scripts');

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

