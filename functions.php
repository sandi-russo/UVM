<?php
/**
 * UNIVERSOME functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package UNIVERSOME
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}



/**
 * Enqueue scripts and styles.
 */
function cg_your_theme_scripts() {
	wp_enqueue_style( 'output', get_template_directory_uri() . '/dist/output.css', array());


       // Enqueue Swiper CSS
       wp_enqueue_style('swiper-css', get_template_directory_uri() . '/node_modules/swiper/swiper-bundle.min.css');

       // Enqueue Swiper JS
       wp_enqueue_script('swiper-js', get_template_directory_uri() . '/node_modules/swiper/swiper-bundle.min.js', array(), null, true);
   
       // Enqueue custom script to initialize Swiper
       wp_enqueue_script('custom-swiper-init', get_template_directory_uri() . '/assets/js/custom.js', array('swiper-js'), null, true);
}
add_action( 'wp_enqueue_scripts', 'cg_your_theme_scripts' );

/*
Ottengo la data attuale e mi estrapolo l'anno
*/
function get_current_year() {
    return date("Y");
}


/*
Richiamo e sfrutto lo styling
*/
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
wp_enqueue_style( 'parent-style', get_template_directory_uri().'/src/style.css' );
}

/* Includo il file 'custom.js' */
function enqueue_custom_scripts() {
    wp_enqueue_script(
        'custom-js', // Handle del file
        get_template_directory_uri() . '/assets/js/custom.js', // URL del file JS
        array(), // Dipendenze
        null, // Versione
        true // Carica il file JS nel footer
    );
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');





/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function universome_theme_setup() {
    // Aggiungi supporto per i blocchi
    add_theme_support('post-thumbnails');
    add_theme_support( 'editor-styles' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'editor-color-palette', array(
        array(
            'name'  => __( 'Primary', 'universome' ),
            'slug'  => 'primary',
            'color' => '#0073aa',
        ),
        // Aggiungi altri colori qui
    ));
    add_theme_support( 'editor-font-sizes', array(
        array(
            'name' => __( 'Small', 'universome' ),
            'size' => 12,
            'slug' => 'small'
        ),
        array(
            'name' => __( 'Normal', 'universome' ),
            'size' => 16,
            'slug' => 'normal'
        ),
        // Aggiungi altre dimensioni di font qui
    ));
}
add_action( 'after_setup_theme', 'universome_theme_setup' );


function universome_editor_styles() {
    add_editor_style( 'style.css' );
}
add_action( 'admin_init', 'universome_editor_styles' );





















/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function universome_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'universome_content_width', 640 );
}
add_action( 'after_setup_theme', 'universome_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function universome_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'universome' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'universome' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'universome_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function universome_scripts() {
	wp_enqueue_style( 'universome-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'universome-style', 'rtl', 'replace' );

	wp_enqueue_script( 'universome-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'universome_scripts' );

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
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

