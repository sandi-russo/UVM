<?php
/**
 * The template for displaying the home page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package UNIVERSOME
 */

get_header();

// Recupera le categorie salvate dalla navbar
$main_categories = get_main_categories();
?>

<main id="primary" class="custom-background">
    <!-- Swiper Carousel -->
    <div class="carosello">
        <div class="swiper-container news-carousel">
            <div class="swiper-wrapper">
                <?php
                $args = array(
                    'category_name' => 'Evidenza',
                    'posts_per_page' => 20,
                );
                $query = new WP_Query($args);
                if ($query->have_posts()):
                    while ($query->have_posts()):
                        $query->the_post();
                        $post_url = get_permalink();
                        ?>
                        <div class="swiper-slide">
                            <div>
                                <a href="<?php echo esc_url($post_url); ?>">
                                    <?php if (has_post_thumbnail()): ?>
                                        <?php the_post_thumbnail('full', array('class' => 'post_img')); ?>
                                    <?php else: ?>
                                    <?php endif; ?>
                                    <div class="carosello-titolo">
                                        <p class="title">
                                            <?php the_title(); ?>
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>

    <!-- <iframe class="radiovisibility radiouvm" src="https://radiouvm.unime.it/public/universome/embed?theme=dark"
        frameborder="0"></iframe> -->

    <div class="mobile_card">
        <div class="mobile_card_grid">
            <div class="mobile_card_image_container">
                <img src="default_image.jpg" alt="Copertina Album" id="album-art_mobile" class="mobile_card-image">
            </div>
            <div class="mobile_card_content">
                <div id="episode-title-azuracast_mobile" class="mobile_card-title">Caricamento...</div>
                <div class="mobile_card-text" id="artist-name_mobile">Caricamento...</div>
                <button type="button" title="Play" aria-label="Play" class="radio-control-play-button"
                    id="play-button-mobile">
                    <svg class="play-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                        height="24">
                        <path fill="currentColor"
                            d="M18.54 9L8.88 3.46a3.42 3.42 0 0 0-5.13 3v11.12A3.42 3.42 0 0 0 7.17 21a3.43 3.43 0 0 0 1.71-.46L18.54 15a3.42 3.42 0 0 0 0-5.92Zm-1 4.19l-9.66 5.62a1.44 1.44 0 0 1-1.42 0a1.42 1.42 0 0 1-.71-1.23V6.42a1.42 1.42 0 0 1 .71-1.23A1.5 1.5 0 0 1 7.17 5a1.54 1.54 0 0 1 .71.19l9.66 5.58a1.42 1.42 0 0 1 0 2.46Z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!--<div class="latest-episode">
            <img src="default_image.jpg" alt="Copertina Album" id="album-art" class="mobile_card-image">
            <div class="info">
                <div class="scroll-container episode-title" id="episode-title-azuracast" class="mobile_card-title">Caricamento...</div>
                <div class="artist-name" id="artist-name">Caricamento...</div>
            </div>
            <button type="button" title="Play" aria-label="Play" class="radio-control-play-button" id="play-button">
                 Icona di Play 
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
        </div>-->

    <!-- Pulsante Radio UVM  -->
    <div class="radio-uvm-button-container">
        <a href="/radio" class="radio-uvm-button">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="radio-uvm-icon">
                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    color="currentColor">
                    <path d="M7 9.5a2.5 2.5 0 1 1-5 0a2.5 2.5 0 0 1 5 0m0 0V2c.333.5.6 2.6 3 3" />
                    <circle cx="10.5" cy="19.5" r="2.5" />
                    <circle cx="20" cy="18" r="2" />
                    <path
                        d="M13 19.5V11c0-.91 0-1.365.247-1.648c.246-.282.747-.35 1.748-.487c3.014-.411 5.206-1.667 6.375-2.436c.28-.184.42-.276.525-.22s.105.223.105.554v11.163" />
                    <path d="M13 13c4.8 0 8-2.333 9-3" />
                </g>
            </svg>
            <span>Ascolta Radio UVM</span>
        </a>
    </div>
    <!-- Wrapper per centralizzare il contenuto -->
    <div class="site_container site_home">

        <!-- Sezione degli Articoli con angoli stondati a destra e shadow -->
        <div class="articoli">
            <?php

            // Sezione Ultime Notizie
            $latest_posts = new WP_Query(array(
                'posts_per_page' => 4,
                'orderby' => 'date',
                'order' => 'DESC'
            ));

            if ($latest_posts->have_posts()):
                ?>
                <section class="category-section latest-news">
                    <div class="category-section-title">
                        <div>
                            <div>
                                <div class="category_name latest-news">
                                    Recenti
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid-home grid-home-2x2">
                        <?php
                        while ($latest_posts->have_posts()):
                            $latest_posts->the_post();
                            ?>
                            <div class="card-home-other">
                                <a href="<?php the_permalink(); ?>">
                                    <?php if (has_post_thumbnail()): ?>
                                        <?php the_post_thumbnail('medium_large', array('class' => 'card_img')); ?>
                                    <?php else: ?>
                                        <div class="card_img_not_available">
                                            <p>Immagine non disponibile</p>
                                        </div>
                                    <?php endif; ?>

                                    <div class="card_background">
                                        <h3 class="card_title">
                                            <?php the_title(); ?>
                                        </h3>
                                </a>
                                <p class="card_description">
                                    <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                                </p>
                                <div class="card_info_author">
                                    <div class="card_author">
                                        <?php
                                        $author_id = get_the_author_meta('ID');
                                        $author_posts_url = get_author_posts_url($author_id);
                                        ?>

                                        <a href="<?php echo esc_url($author_posts_url); ?>" class="card_author-link">
                                            <p class="card_author"><?php echo get_author_full_name_uppercase($author_id); ?></p>
                                        </a>

                                        <p class="card_author"><?php echo get_the_date(); ?></p>
                                    </div>

                                    <div class="card_author-space">
                                        <a href="<?php echo esc_url($author_posts_url); ?>" class="card_author-avatar-link">
                                            <?php echo get_avatar($author_id, 24, '', '', array('class' => 'card_author_avatar')); ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>
            </div>
            </section>
            <?php
            endif;


            foreach ($main_categories as $category):
                // Verifica se la categoria esiste e ha l'ID
                if (isset($category->term_id)):
                    // Query per ottenere i post della categoria
                    $category_posts = new WP_Query(
                        array(
                            'cat' => $category->term_id,
                            'posts_per_page' => 4 // Changed to 4 to fill a 2x2 grid
                        )
                    );

                    // Mostra la sezione solo se ci sono post
                    if ($category_posts->have_posts()):
                        ?>
                    <section class="category-section">
                        <!-- Intestazione Categoria con Stile Specifico -->
                        <div class="category-section-title">
                            <div>
                                <div>
                                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                                        <div class="category_name <?php echo esc_attr($category->slug); ?>">
                                            <?php echo esc_html($category->name); ?>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="grid-home grid-home-2x2"> <!-- Added grid-home-2x2 class -->
                            <?php
                            while ($category_posts->have_posts()):
                                $category_posts->the_post();
                                ?>
                                <!-- ALL CARDS ARE NOW card-home-other -->
                                <div class="card-home-other">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php if (has_post_thumbnail()): ?>
                                            <?php the_post_thumbnail('medium_large', array('class' => 'card_img')); ?>
                                        <?php else: ?>
                                            <div class="card_img_not_available">
                                                <p>Immagine non disponibile</p>
                                            </div>
                                        <?php endif; ?>

                                        <div class="card_background">
                                            <h3 class="card_title">
                                                <?php the_title(); ?>
                                            </h3>
                                    </a>
                                    <p class="card_description">
                                        <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                                    </p>
                                    <div class="card_info_author">
                                        <div class="card_author">
                                            <?php
                                            // Recupera l'ID dell'autore
                                            $author_id = get_the_author_meta('ID');

                                            // Recupera il nome e il cognome dell'autore
                                            $first_name = get_the_author_meta('first_name', $author_id);
                                            $last_name = get_the_author_meta('last_name', $author_id);
                                            $display_name = trim($first_name . ' ' . $last_name);

                                            // Usa il nome utente come fallback
                                            if (empty($display_name)) {
                                                $display_name = get_the_author_meta('user_login', $author_id);
                                            }

                                            // Ottieni l'URL della pagina dell'autore
                                            $author_posts_url = get_author_posts_url($author_id);
                                            ?>

                                            <!-- Nome dell'autore cliccabile che reindirizza alla pagina dell'autore -->
                                            <a href="<?php echo esc_url($author_posts_url); ?>" class="card_author-link">
                                                <p class="card_author"><?php echo get_author_full_name_uppercase($author_id); ?></p>
                                            </a>

                                            <!-- Data del post -->
                                            <p class="card_author"><?php echo get_the_date(); ?></p>
                                        </div>

                                        <div class="card_author-space">
                                            <!-- Avatar dell'autore cliccabile che reindirizza alla pagina dell'autore -->
                                            <a href="<?php echo esc_url($author_posts_url); ?>" class="card_author-avatar-link">
                                                <?php echo get_avatar($author_id, 24, '', '', array('class' => 'card_author_avatar')); ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                            ?>
                </div>

                <!-- Pulsante Categorie -->
                <div class="more-category-button">
                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                        <?php esc_html_e('Vedi tutto', 'universome'); ?>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="category-svg">
                            <path
                                d="M8 6.82v10.36c0 .79.87 1.27 1.54.84l8.14-5.18a1 1 0 0 0 0-1.69L9.54 5.98A.998.998 0 0 0 8 6.82" />
                        </svg>
                    </a>
                </div>
                </section>
                <?php
                    endif; // Fine del controllo se ci sono post
                endif; // Fine del controllo se la categoria ha un ID
            endforeach;
            ?>
    </div> <!-- .flex-1 -->

    <!-- Barra Laterale Fissa con angoli stondati a destra -->
    <div class="sidebar">
        <h2 class="sidebar-title">Ascolta Radio UVM</h2>
        <div class="sidebar-content">
            <div class="swiper radio-sidebar">
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <div class="embedded-container">
                            <!-- SPOTIFY -->
                            <?php echo spotify_embedded(); ?>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="embedded-container">
                            <!-- RADIO UVM -->
                            <?php echo radio_embedded(); ?>
                        </div>
                    </div>
                </div>
                <!--<div class="radio-sidebar-next swiper-button-next"></div>-->
                <!-- <div class="radio-sidebar-prev swiper-button-prev"></div>-->
                <div class="swiper-pagination"></div>
            </div>



        </div><!-- .sidebar-content -->


        <!-- Pulsante per ascoltare la radio -->
        <!-- Pulsante allineato a destra -->
        <div class="sidebar-button-container">
            <a href="/radio" class="sidebar-button">
                <?php esc_html_e('Ascoltaci!', 'universome'); ?>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="category-svg">
                    <path
                        d="M8 6.82v10.36c0 .79.87 1.27 1.54.84l8.14-5.18a1 1 0 0 0 0-1.69L9.54 5.98A.998.998 0 0 0 8 6.82" />
                </svg>
            </a>
        </div>

    </div><!-- .sidebar -->
    </div><!-- .w-full max-w-[1400px] -->

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
?>