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

<main id="primary" class="site-main">
    <!-- Swiper Carousel -->
    <div class="w-full relative">
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
                            <div class="relative overflow-hidden shadow-lg">
                                <a href="<?php echo esc_url($post_url); ?>">
                                    <?php if (has_post_thumbnail()): ?>
                                        <?php the_post_thumbnail('large', array('class' => 'post_img')); ?>
                                    <?php else: ?>
                                        <div class="w-full h-64 bg-gray-300"></div>
                                    <?php endif; ?>
                                    <div
                                        class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-10">
                                        <p class="title text-white">
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

    <!-- Wrapper per centralizzare il contenuto -->
    <div class="site_main site_container mx-auto flex">
        <!-- Sezione degli Articoli con angoli stondati a destra e shadow -->
        <div class="articoli flex-1 overflow-y-auto pr-4 px-5 bg-white">
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
                        <section class="category-section mb-8">
                            <!-- Intestazione Categoria con Stile Specifico -->
                            <div class="bg-white my-4">
                                <div class="max-w-7xl mx-auto">
                                    <div class="text-center">
                                        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                                            <h2
                                                class="category_name text-3xl font-extrabold text-[#333] inline-block relative after:absolute after:w-4/6 after:h-1 after:left-0 after:right-0 after:-bottom-4 after:mx-auto after:bg-pink-400 after:rounded-full">
                                                <?php echo esc_html($category->name); ?>
                                            </h2>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <?php
                                $first_post = true;
                                while ($category_posts->have_posts()):
                                    $category_posts->the_post();
                                    if ($first_post):
                                        $first_post = false;
                                        ?>
                                        <!-- PRIMA CARDS -->
                                        <div
                                            class="cards-border bg-white shadow-[0_4px_12px_-5px_rgba(0,0,0,0.4)] w-full rounded-lg overflow-hidden mx-auto font-[sans-serif] mt-4 relative md:col-span-2 min-h-[300px] max-h-[600px] flex flex-col">
                                            <a href="<?php the_permalink(); ?>">
                                                <div class="flex-1">
                                                    <?php if (has_post_thumbnail()): ?>
                                                        <?php the_post_thumbnail('full', array('class' => 'card_img w-full h-[300px] object-cover')); ?>
                                                    <?php else: ?>
                                                        <div class="w-full h-[200px] bg-gray-200 flex items-center justify-center">
                                                            <p class="text-gray-500">Immagine non disponibile</p>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="p-6 bg-[#eeeeee] flex flex-col justify-between flex-1">
                                                    <h3 class="card_title text-gray-900 text-xl font-bold">
                                                        <?php the_title(); ?>
                                                    </h3>
                                            </a>
                                            <p class="card_description mt-4 text-sm text-gray-500 leading-relaxed">
                                                <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                                            </p>
                                            <div class="flex items-center justify-between mt-6">
                                                <div class="flex-1 flex flex-col text-sm text-gray-500 text-right">
                                                    <?php
                                                    $first_name = get_the_author_meta('first_name');
                                                    $last_name = get_the_author_meta('last_name');
                                                    $display_name = trim($first_name . ' ' . $last_name);
                                                    if (empty($display_name)) {
                                                        $display_name = get_the_author_meta('user_login');
                                                    }
                                                    ?>
                                                    <p class="card_author"><?php echo esc_html($display_name); ?></p>
                                                    <p class="card_author"><?php echo get_the_date(); ?></p>
                                                </div>
                                                <div class="ml-4">
                                                    <?php echo get_avatar(get_the_author_meta('ID'), 24, '', '', array('class' => 'rounded-full')); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <!-- ALTRE CARDS -->
                                    <div
                                        class="cards-border bg-white shadow-[0_4px_12px_-5px_rgba(0,0,0,0.4)] w-full rounded-lg overflow-hidden mx-auto font-[sans-serif] mt-4 relative min-h-[300px] max-h-[600px] flex flex-col">
                                        <a href="<?php the_permalink(); ?>">
                                            <div class="flex-1">
                                                <?php if (has_post_thumbnail()): ?>
                                                    <?php the_post_thumbnail('full', array('class' => 'card_img w-full h-[300px] object-cover')); ?>
                                                <?php else: ?>
                                                    <div class="w-full h-[200px] bg-gray-200 flex items-center justify-center">
                                                        <p class="text-gray-500">Immagine non disponibile</p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="p-6 bg-[#eeeeee] flex flex-col justify-between flex-1">
                                                <h3 class="card_title text-gray-900 text-xl font-bold">
                                                    <?php the_title(); ?>
                                                </h3>
                                        </a>
                                        <p class="card_description mt-4 text-sm text-gray-500 leading-relaxed">
                                            <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                                        </p>
                                        <div class="flex items-center justify-between mt-6">
                                            <div class="card_author flex-1 flex flex-col text-sm text-gray-500 text-right">
                                                <?php
                                                $first_name = get_the_author_meta('first_name');
                                                $last_name = get_the_author_meta('last_name');
                                                $display_name = trim($first_name . ' ' . $last_name);
                                                if (empty($display_name)) {
                                                    $display_name = get_the_author_meta('user_login');
                                                }
                                                ?>
                                                <p class="card_author"><?php echo esc_html($display_name); ?></p>
                                                <p class="card_author"><?php echo get_the_date(); ?></p>
                                            </div>
                                            <div class="ml-4">
                                                <?php echo get_avatar(get_the_author_meta('ID'), 24, '', '', array('class' => 'rounded-full')); ?>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
                <div class="flex justify-end mt-4">
                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>"
                        class="text-gray-900 bg-[#eeeeee] focus:outline-none font-medium rounded-full text-sm px-5 py-2.5 text-center flex items-center">
                        <?php esc_html_e('Vedi tutto', 'universome'); ?>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-4 h-4 ml-2 fill-current">
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
    <div class="sidebar rounded-r-lg">
        <h2 class="sidebar-title">Ascolta Radio UVM</h2>
        <div class="sidebar-content">
            <?php /*echo youtube_embedded(); */ ?>

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
                                <path fill="currentColor"
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
        </div><!-- .sidebar-content -->
        <!-- Pulsante allineato a destra -->
        <a href="/radio"
            class="sidebar-button text-gray-900 bg-[#e2e2e2] focus:outline-none font-medium rounded-full text-sm text-center flex items-center">
            <?php esc_html_e('Ascoltaci!', 'universome'); ?>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-4 h-4 ml-2 fill-current">
                <path
                    d="M8 6.82v10.36c0 .79.87 1.27 1.54.84l8.14-5.18a1 1 0 0 0 0-1.69L9.54 5.98A.998.998 0 0 0 8 6.82" />
            </svg>
        </a>
    </div><!-- .sidebar -->



    </div><!-- .w-full max-w-[1400px] -->
</main><!-- #main -->

<?php
get_sidebar();
get_footer();
?>