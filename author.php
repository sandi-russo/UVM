<?php
/**
 * The template for displaying author pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#author
 *
 * @package UNIVERSOME
 */

get_header();
?>

<main class="custom-background">
<div class="other_site_container">


    <?php
    // Ottieni le informazioni dell'autore
    $author_id = get_queried_object_id();

    // Ottieni nome e cognome dell'autore
    $author_first_name = get_the_author_meta('first_name', $author_id);
    $author_last_name = get_the_author_meta('last_name', $author_id);

    // Concatena nome e cognome e applica la formattazione (tutto minuscolo e prime lettere maiuscole)
    $author_name = ucwords(strtolower($author_first_name . ' ' . $author_last_name));

    // $author_bio = get_the_author_meta('description', $author_id);
    $author_avatar = get_avatar($author_id, 96, '', '', array('class' => 'rounded-full'));

    // Imposta la query per mostrare 9 post per pagina
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 9, // Mostra 9 post per pagina
        'paged' => $paged,
        'author' => $author_id
    );
    $author_query = new WP_Query($args);
    ?>

    <?php if ($author_query->have_posts()): ?>

        <header class="page-header">
            <div class="page-author-avatar">
                <?php echo $author_avatar; ?>
                <h1 class="page-title">
                    <?php printf(esc_html__('Articoli di %s', 'universome'), '<span class="page-element-info">' . esc_html($author_name) . '</span>'); ?>
                </h1>
            </div>
        </header><!-- .page-header -->

        <div class="page-grid">
            <?php
            /* Start the Loop */
            while ($author_query->have_posts()):
                $author_query->the_post();
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
                                <p><?php echo get_the_date(); ?></p>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>

        <!-- Paginazione -->
        <div class="paginazione">
            <div>
                <?php
                // Pulsante Indietro
                previous_posts_link(
                    '<span class="paginazione-cambio">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="category-svg"><path fill="currentColor" d="M448 440a16 16 0 0 1-12.61-6.15c-22.86-29.27-44.07-51.86-73.32-67C335 352.88 301 345.59 256 344.23V424a16 16 0 0 1-27 11.57l-176-168a16 16 0 0 1 0-23.14l176-168A16 16 0 0 1 256 88v80.36c74.14 3.41 129.38 30.91 164.35 81.87C449.32 292.44 464 350.9 464 424a16 16 0 0 1-16 16"/></svg>
                            <span>Pagina Precedente</span>
                        </span>'
                );
                ?>
            </div>
            <div>
                <?php
                // Pulsante Avanti
                next_posts_link(
                    '<span class="paginazione-cambio">
                            <span>Pagina Successiva</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="category-svg"><path fill="currentColor" d="M48 399.26C48 335.19 62.44 284 90.91 247c34.38-44.67 88.68-68.77 161.56-71.75V72L464 252L252.47 432V329.35c-44.25 1.19-77.66 7.58-104.27 19.84c-28.75 13.25-49.6 33.05-72.08 58.7L48 440Z"/></svg>
                        </span>',
                    $author_query->max_num_pages
                );
                ?>
            </div>
        </div>
    <?php else: ?>
        <div class="page-no-results">
            <?php get_template_part('template-parts/content', 'none'); ?>
        </div>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>

</div>
</main><!-- #main -->

<?php
get_sidebar();
get_footer();
?>