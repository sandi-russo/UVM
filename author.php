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

<div class="site_container min-h-screen py-8 px-4 sm:px-6 lg:px-8">
    <main id="primary" class="site-main mx-auto max-w-4xl">

        <?php
        // Ottieni le informazioni dell'autore
        $author_id = get_queried_object_id();
        $author_name = get_the_author_meta('display_name', $author_id);
        $author_bio = get_the_author_meta('description', $author_id);
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

            <header class="page-header mb-8 text-center">
                <div class="flex flex-col items-center">
                    <?php echo $author_avatar; ?>
                    <h1 class="page-title text-3xl font-bold text-gray-900 mt-4">
                        <?php printf(esc_html__('Articoli di %s', 'universome'), '<span class="text-[#ff8800]">' . $author_name . '</span>'); ?>
                    </h1>
                    <?php if ($author_bio): ?>
                        <p class="author-bio text-gray-600 mt-2"><?php echo esc_html($author_bio); ?></p>
                    <?php endif; ?>
                </div>
            </header><!-- .page-header -->

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php
                /* Start the Loop */
                while ($author_query->have_posts()): $author_query->the_post();
                    ?>
                    <article class="bg-white shadow-md rounded-lg overflow-hidden flex flex-col min-h-[300px] max-h-[600px] mx-auto flex">
                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()): ?>
                                <div class="relative">
                                    <?php the_post_thumbnail('large', ['class' => 'card_img w-full h-48 object-cover']); ?>
                                    <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-50"></div>
                                </div>
                            <?php else: ?>
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <p class="text-gray-500">Immagine non disponibile</p>
                                </div>
                            <?php endif; ?>
                        </a>
                        <div class="p-6 bg-[#e2e2e2] flex flex-col flex-1">
                            <h2 class="card_title text-xl font-bold mb-2">
                                <a href="<?php the_permalink(); ?>" class="text-gray-900">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            <p class="card_description text-gray-600 mb-4 flex-1 min-h-[50px]">
                                <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                            </p>
                            <div class="flex items-center justify-between mt-6">
                                <div class="flex-1 flex flex-col text-sm text-gray-500 text-right">
                                    <p class="card_author"><?php echo get_the_date(); ?></p>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>

            </div>

            <!-- Paginazione -->
            <div class="flex justify-between mt-8">
                <div>
                    <?php
                    // Pulsante Indietro
                    previous_posts_link(
                        '<span class="inline-flex items-center text-gray-900 bg-[#eeeeee] focus:outline-none font-medium rounded-full text-sm px-5 py-2.5 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4 fill-current"><path fill="currentColor" d="M448 440a16 16 0 0 1-12.61-6.15c-22.86-29.27-44.07-51.86-73.32-67C335 352.88 301 345.59 256 344.23V424a16 16 0 0 1-27 11.57l-176-168a16 16 0 0 1 0-23.14l176-168A16 16 0 0 1 256 88v80.36c74.14 3.41 129.38 30.91 164.35 81.87C449.32 292.44 464 350.9 464 424a16 16 0 0 1-16 16"/></svg>
                            <span class="ml-2">Pagina Precedente</span>
                        </span>'
                    );
                    ?>
                </div>
                <div>
                    <?php
                    // Pulsante Avanti
                    next_posts_link(
                        '<span class="inline-flex items-center text-gray-900 bg-[#eeeeee] focus:outline-none font-medium rounded-full text-sm px-5 py-2.5 text-center">
                            <span class="mr-2">Pagina Successiva</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4 fill-current"><path fill="currentColor" d="M48 399.26C48 335.19 62.44 284 90.91 247c34.38-44.67 88.68-68.77 161.56-71.75V72L464 252L252.47 432V329.35c-44.25 1.19-77.66 7.58-104.27 19.84c-28.75 13.25-49.6 33.05-72.08 58.7L48 440Z"/></svg>
                        </span>',
                        $author_query->max_num_pages
                    );
                    ?>
                </div>
            </div>

        <?php else: ?>

            <div class="no-results text-center text-gray-600">
                <?php get_template_part('template-parts/content', 'none'); ?>
            </div>

        <?php endif; ?>

        <?php wp_reset_postdata(); ?>

    </main><!-- #main -->
</div>

<?php
get_sidebar();
get_footer();
?>