<?php
/**
 * The template for displaying category pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#category
 *
 * @package UNIVERSOME
 */

get_header();
?>

<div class="other_site_container">
    <main id="primary" class="site-main">

        <?php
        // Imposta la query per mostrare 9 post per pagina
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 9, // Mostra 9 post per pagina
            'paged' => $paged,
            'cat' => get_queried_object_id()
        );
        $category_query = new WP_Query($args);
        ?>

        <?php if ($category_query->have_posts()): ?>

            <header class="page-header">
                <h1 class="page-title">
                    <?php
                    /* translators: %s: category name. */
                    printf(esc_html__('%s', 'universome'), '<span class="page-element-info">' . single_cat_title('', false) . '</span>');
                    ?>
                </h1>
            </header><!-- .page-header -->

            <div class="page-grid">
                <?php
                /* Start the Loop */
                while ($category_query->have_posts()):
                    $category_query->the_post();
                    ?>
                    <article class="page-cards">
                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('thumbnail', ['class' => 'card_img']); ?>
                            <?php else: ?>
                                <div class="card_img_not_available">
                                    <p>Immagine non disponibile</p>
                                </div>
                            <?php endif; ?>
                        </a>
                        <div class="card_background">
                            <h2 class="card_title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            <p class="card_description">
                                <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                            </p>
                            <div class="card_info_author">
                                <div class="card_author">
                                    <?php
                                    // Recupera il nome e il cognome dell'autore
                                    $first_name = get_the_author_meta('first_name');
                                    $last_name = get_the_author_meta('last_name');
                                    $display_name = trim($first_name . ' ' . $last_name);

                                    // Usa il nome utente come fallback
                                    if (empty($display_name)) {
                                        $display_name = get_the_author_meta('user_login');
                                    }
                                    ?>
                                    <p class="card_author"><?php echo esc_html($display_name); ?></p>
                                    <p class="card_author"><?php echo get_the_date(); ?></p>
                                </div>
                                <div class="card_author-space">
                                    <?php echo get_avatar(get_the_author_meta('ID'), 24, '', '', array('class' => 'card_author_avatar')); ?>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>

                <?php wp_reset_postdata(); ?>
            </div>

            <!-- Paginazione -->
            <div class="paginazione">
                <div>
                    <?php
                    // Pulsante Indietro
                    $prev_link = get_previous_posts_link(
                        '<span class="paginazione-cambio">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4 fill-current"><path fill="currentColor" d="M448 440a16 16 0 0 1-12.61-6.15c-22.86-29.27-44.07-51.86-73.32-67C335 352.88 301 345.59 256 344.23V424a16 16 0 0 1-27 11.57l-176-168a16 16 0 0 1 0-23.14l176-168A16 16 0 0 1 256 88v80.36c74.14 3.41 129.38 30.91 164.35 81.87C449.32 292.44 464 350.9 464 424a16 16 0 0 1-16 16"/></svg>
                <span class="ml-2">Pagina Precedente</span>
            </span>'
                    );
                    echo $prev_link;
                    ?>
                </div>
                <div>
                    <?php
                    // Pulsante Avanti
                    $next_link = get_next_posts_link(
                        '<span class="paginazione-cambio">
                <span class="mr-2">Pagina Successiva</span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4 fill-current"><path fill="currentColor" d="M48 399.26C48 335.19 62.44 284 90.91 247c34.38-44.67 88.68-68.77 161.56-71.75V72L464 252L252.47 432V329.35c-44.25 1.19-77.66 7.58-104.27 19.84c-28.75 13.25-49.6 33.05-72.08 58.7L48 440Z"/></svg>
            </span>'
                    );
                    echo $next_link;
                    ?>
                </div>
            </div>
        <?php else: ?>
            <div class="page-no-results">
                <?php get_template_part('template-parts/content', 'none'); ?>
            </div>

        <?php endif; ?>

    </main><!-- #main -->
</div>

<?php
get_sidebar();
get_footer();
