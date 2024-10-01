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

            foreach ($main_categories as $category):
                // Verifica se la categoria esiste e ha l'ID
                if (isset($category->term_id)):
                    // Query per ottenere i post della categoria
                    $category_posts = new WP_Query(
                        array(
                            'cat' => $category->term_id,
                            'posts_per_page' => 3
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

                            <div class="grid-home">
                                <?php
                                $first_post = true;
                                while ($category_posts->have_posts()):
                                    $category_posts->the_post();
                                    if ($first_post):
                                        $first_post = false;
                                        ?>
                                        <!-- PRIMA CARDS -->
                                        <div class="card-home">
                                            <a href="<?php the_permalink(); ?>">
                                                <div>
                                                    <?php if (has_post_thumbnail()): ?>
                                                        <?php the_post_thumbnail('thumbnail', array('class' => 'card_img')); ?>
                                                    <?php else: ?>
                                                        <div class="card_img_not_available">
                                                            <p>Immagine non disponibile</p>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
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
                                                        <p class="card_author"><?php echo esc_html($display_name); ?></p>
                                                    </a>

                                                    <!-- Data del post -->
                                                    <p><?php echo get_the_date(); ?></p>
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
                                <?php else: ?>
                                    <!-- ALTRE CARDS -->
                                    <div class="card-home-other">
                                        <a href="<?php the_permalink(); ?>">

                                            <?php if (has_post_thumbnail()): ?>
                                                <?php the_post_thumbnail('full', array('class' => 'card_img')); ?>
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
                                                    <p class="card_author"><?php echo esc_html($display_name); ?></p>
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
                        <?php endif; ?>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
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
    </div><!-- .flex-1 -->

    <!-- Barra Laterale Fissa con angoli stondati a destra -->
    <div class="sidebar">
        <h2 class="sidebar-title">Ascolta Radio UVM</h2>
        <div class="sidebar-content">

            <!-- SPOTIFY -->
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

            <!-- YouTube -->
            <!-- <?php echo youtube_embedded(); ?> -->

            <!-- Pulsante per ascoltare la radio -->
        </div><!-- .sidebar-content -->
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