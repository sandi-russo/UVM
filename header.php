<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://bing.com/search?q=
 * @package UNIVERSOME
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <title>
        <?php
        // Prepend "UVM | " to every title
        if (is_front_page()) {
            echo 'UVM | Home';
        } elseif (is_single()) {
            echo 'UVM | ' . get_the_title();
        } elseif (is_page()) {
            echo 'UVM | ' . get_the_title();
        } elseif (is_category()) {
            echo 'UVM | Categoria: ' . single_cat_title('', false);
        } elseif (is_search()) {
            echo 'UVM | Ricerca: ' . get_search_query();
        } else {
            echo 'UVM | ' . get_bloginfo('name');
        }
        ?>
    </title>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php wp_body_open(); ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text"
            href="#primary"><?php esc_html_e('Skip to content', 'universome'); ?></a>

        <!-- Header principale -->
        <header class="header w-full z-50">
            <div class="mobile-last-modified">
                <span class="update-label">Ultimo aggiornamento: </span>
                <span class="update-time">
                    <?php
                    $recent = new WP_Query([
                        'post_type' => 'any',
                        'posts_per_page' => 1,
                        'orderby' => 'modified',
                        'order' => 'DESC',
                    ]);

                    if ($recent->have_posts()) {
                        $recent->the_post();
                        echo get_the_modified_time('d/m/Y, H:i');
                    }
                    wp_reset_postdata();
                    ?>
                </span>
            </div>

            <div class="header-top">
                <div class="container mx-auto justify-between items-center">
                    <!-- Logo e menu mobile -->
                    <div class="flex items-center">
                        <button id="mobile-menu-button">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                        <a href="<?php echo home_url(); ?>">
                            <?php if (function_exists('the_custom_logo')): ?>
                                <div class="custom-logo">
                                    <?php the_custom_logo(); ?>
                                </div>
                            <?php endif; ?>
                        </a>
                    </div>

                    <div class="nav-element" id="current-date-time">
                        <?php echo date('d/m/Y'); ?>
                    </div>
                    <div class="nav-element" id="current-time">
                        <?php echo date('H:i'); ?>
                    </div>
                    <div class="nav-element" id="last-modified">
                        <?php
                        $recent = new WP_Query([
                            'post_type' => 'any',
                            'posts_per_page' => 1,
                            'orderby' => 'modified',
                            'order' => 'DESC',
                        ]);

                        if ($recent->have_posts()) {
                            $recent->the_post();
                            echo get_the_modified_time('d/m/Y, H:i');
                        }
                        wp_reset_postdata();
                        ?>
                    </div>

                    <!-- Icone social e ricerca mobile -->
                    <div class="flex items-center">
                        <div class="hidden md:flex">
                            <div class="nav_ico">

                                <a href="https://www.facebook.com/UniVersoMessina">
                                    <svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M8 6a6 6 0 0 1 6-6h5v6.5h-4v2h4.247L17.802 15H15v9H8v-9H4.25V8.5H8zm6-4a4 4 0 0 0-4 4v4.5H6.25V13H10v9h3v-9h3.198l.555-2.5H13v-4a2 2 0 0 1 2-2h2V2z" />
                                    </svg>
                                </a>
                            </div>
                            <div class="nav_ico">
                                <a href="https://www.instagram.com/uvm_universome">
                                    <svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4zm9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8A1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5a5 5 0 0 1-5 5a5 5 0 0 1-5-5a5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3" />
                                    </svg>
                                </a>
                            </div>
                            <div class="nav_ico">
                                <a href="https://twitter.com/universomessina">
                                    <svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 16 16">
                                        <path fill="currentColor"
                                            d="M9.294 6.928L14.357 1h-1.2L8.762 6.147L5.25 1H1.2l5.31 7.784L1.2 15h1.2l4.642-5.436L10.751 15h4.05zM7.651 8.852l-.538-.775L2.832 1.91h1.843l3.454 4.977l.538.775l4.491 6.47h-1.843z" />
                                    </svg>
                                </a>
                            </div>
                            <div class="nav_ico">
                                <a href="https://open.spotify.com/show/1J8nrLau2QtjbMjFodeotT">
                                    <svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <g fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="1.5">
                                            <path d="M7 15s4.5-1 9 1m-9.5-4s6-1.5 11 1.5M6 9c3-.5 8-1 13 2" />
                                            <path d="M12 22.5a10.5 10.5 0 1 0 0-21a10.5 10.5 0 0 0 0 21Z" />
                                        </g>
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <!-- Icona ricerca per mobile -->
                        <button id="mobile-search-button">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-4.35-4.35m2.65-5.65a7 7 0 1 1-14 0a7 7 0 0 1 14 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>



            <!-- Categorie e barra di ricerca -->
            <div class="header-bottom bg-white">
                <div class="container mx-auto px-4 flex justify-between items-center py-4">

                    <!-- Categorie WordPress -->
                    <nav class="flex-grow">
                        <ul class="flex flex-wrap gap-4">
                            <?php
                            $args = array(
                                'parent' => 0, // Prende solo le categorie principali
                                'exclude' => get_cat_ID('senza categoria'), // Esclude la categoria "senza categoria"
                                'hide_empty' => false // Mostra anche categorie senza post
                            );
                            $categories = get_categories($args);
                            foreach ($categories as $category) {
                                $subcategories = get_categories(array('parent' => $category->term_id, 'hide_empty' => false));
                                $has_subcategories = !empty($subcategories);

                                echo '<li class="category-item relative">';
                                echo '<a href="' . get_category_link($category->term_id) . '" class="text-gray-700 hover:text-gray-900 font-semibold flex items-center">' . $category->name;

                                if ($has_subcategories) {
                                    echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ml-1 w-4 h-4"><path fill="currentColor" d="M10.103 12.778L16.81 6.08a.69.69 0 0 1 .99.012a.726.726 0 0 1-.012 1.012l-7.203 7.193a.69.69 0 0 1-.985-.006L2.205 6.72a.727.727 0 0 1 0-1.01a.69.69 0 0 1 .99 0z"/></svg>';
                                }

                                echo '</a>';

                                if ($has_subcategories) {
                                    echo '<ul class="subcategory-menu absolute left-0 mt-2 py-2 bg-white shadow-lg rounded-md hidden">';
                                    foreach ($subcategories as $subcategory) {
                                        echo '<li><a href="' . get_category_link($subcategory->term_id) . '" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">' . $subcategory->name . '</a></li>';
                                    }
                                    echo '</ul>';
                                }

                                echo '</li>';
                            }
                            ?>
                        </ul>
                    </nav>

                    <!-- Barra di ricerca -->
                    <div class="flex w-full max-w-sm justify-center">
                        <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>"
                            class="flex items-center bg-[#e2e2e2] rounded-full overflow-hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" width="16px"
                                class="fill-black ml-4">
                                <path
                                    d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z" />
                            </svg>
                            <input type="search" name="s" placeholder="Cerca..."
                                class="w-full px-4 py-2 bg-[#e2e2e2] placeholder-gray-400 search-input" />
                        </form>
                    </div>
                </div>
            </div>

            <!-- Menu mobile (nascosto di default) -->
            <div class="mobile-menu-overlay" id="mobile-menu-overlay"></div>
            <div class="hidden md:hidden" id="mobile-menu">

                <!-- Header hamburger menu -->
                <div class="mobile-menu-header">
                    <div class="mobile-logo">
                        <?php
                        if (function_exists('the_custom_logo')) {
                            the_custom_logo();
                        }
                        ?>
                    </div>
                    <span class="close-menu" id="close-menu">&times;</span>
                </div>

                <!-- Contenuto hamburger menu -->
                <div class="mobile-menu-content">
                    <div class="mobile-menu-categories">
                        <?php
                        $args = array(
                            'parent' => 0, // Prende solo le categorie principali
                            'exclude' => get_cat_ID('senza categoria'), // Esclude la categoria "senza categoria"
                            'hide_empty' => false // Mostra anche categorie senza post
                        );
                        $categories = get_categories($args);
                        foreach ($categories as $category) {
                            echo '<a href="' . get_category_link($category->term_id) . '"class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">' . $category->name . '</a>';
                        }
                        ?>
                    </div>
                </div>

                <!-- Footer hamburger menu -->
                <div class="mobile-menu-footer">
                    <p>Sei un giornalista?</p>
                    <a href="https:\\universome.unime.it\login">
                        <button
                            class="text-white bg-[#787878] hover:bg-[#f28b0c] font-semibold rounded-md text-sm px-6 py-3 block w-full mt-3"
                            style="border: none;">Accedi</button>
                    </a>
                </div>
            </div>

            <!-- Form di ricerca mobile (nascosto di default) -->
            <div class="mobile-search-overlay" id="mobile-search-overlay"></div>
            <div class="hidden md:hidden" id="mobile-search">

                <!-- Header ricerca -->
                <div class="mobile-search-header">
                    <span class="close-search" id="close-search">&times;</span>
                    <div class="mobile-logo">
                        <?php
                        if (function_exists('the_custom_logo')) {
                            the_custom_logo();
                        }
                        ?>
                    </div>
                </div>

                <!-- Risultati di ricerca -->
                <div class="mobile-search-content">
                    <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>"
                        class="flex items-center bg-[#e2e2e2] rounded-full overflow-hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" width="16px"
                            class="fill-black ml-4">
                            <path
                                d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z" />
                        </svg>
                        <input type="text" id="live-search" name="s" placeholder="Cerca..." autocomplete="off"
                            class="w-full px-4 py-3 bg-[#e2e2e2] text-black placeholder-gray-600 search-input" />
                    </form>
                    <span>Inserisci almeno 3 caratteri.</span>
                    <div id="search-results">
                        <?php
                        if (have_posts()):
                            while (have_posts()):
                                the_post(); ?>
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
                        else: ?>
                            <p><?php _e('Nessun risultato trovato.'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Footer ricerca -->
                <div class="mobile-search-footer">
                    <p>Sei un giornalista?</p>
                    <a href="https:\\universome.unime.it\login">
                        <button
                            class="text-white bg-[#787878] hover:bg-[#f28b0c] font-semibold rounded-md text-sm px-6 py-3 block w-full mt-3"
                            style="border: none;">Accedi</button>
                    </a>
                </div>
            </div>



            <!-- Sticky Header -->
            <div id="sticky-header" class="sticky-header">
                <div class="sticky-header-content site_container">
                    <div class="sticky-logo">
                        <a href="<?php echo home_url(); ?>">
                            <?php if (function_exists('the_custom_logo')): ?>
                                <div class="sticky-custom-logo">
                                    <?php the_custom_logo(); ?>
                                </div>
                            <?php endif; ?>
                        </a>
                    </div>

                    <!-- Categorie Wordpress -->
                    <nav class="sticky-categories">
                        <ul class="flex items-center">
                            <?php
                            $args = array(
                                'parent' => 0,
                                'exclude' => get_cat_ID('senza categoria'),
                                'hide_empty' => false
                            );
                            $categories = get_categories($args);
                            foreach ($categories as $category) {
                                echo '<li class="sticky-category-item"><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>';
                            }
                            ?>
                        </ul>
                    </nav>



                    <!-- Barra di ricerca -->
                    <div class="sticky-search">
                        <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>"
                            class="flex items-center bg-[#e2e2e2] rounded-full overflow-hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" width="16px"
                                class="fill-black ml-4">
                                <path
                                    d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z" />
                            </svg>
                            <input type="search" name="s" placeholder="Cerca..."
                                class="w-full px-4 py-2 bg-[#e2e2e2] placeholder-gray-400 search-input" />
                        </form>
                    </div>
                </div>
            </div>





        </header>



    </div>


    <?php wp_footer(); // Hook di WordPress per inserire script prima della chiusura del <body> ?>
</body>

</html>