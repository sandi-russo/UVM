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
$navbar_categories = get_option('navbar_categories', array()); // Imposta un array vuoto come valore predefinito
$category_ids = wp_list_pluck($navbar_categories, 'term_id');

?>

<main id="primary" class="site-main flex justify-center mx-[20px]">
    <!-- Wrapper per centralizzare il contenuto -->
    <div class="w-full max-w-[1200px] flex mx-auto">
        <!-- Sezione degli Articoli -->
        <div class="flex-1 overflow-y-auto pr-4">
            <?php
            foreach ($navbar_categories as $category) :
                // Verifica se la categoria esiste e ha post
                if (in_array($category->term_id, $category_ids)) :
            ?>
                <section class="category-section mb-8">
                    <h1 class="text-2xl font-bold mb-4"><?php echo esc_html($category->name); ?></h1>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <?php
                        // Query per ottenere i post della categoria
                        $category_posts = new WP_Query(array(
                            'cat' => $category->term_id,
                            'posts_per_page' => 3
                        ));

                        if ($category_posts->have_posts()) :
                            $first_post = true;
                            while ($category_posts->have_posts()) : $category_posts->the_post();
                                if ($first_post) :
                                    $first_post = false;
                        ?>
                                    <div class="bg-white shadow-[0_4px_12px_-5px_rgba(0,0,0,0.4)] w-full rounded-lg overflow-hidden mx-auto font-[sans-serif] mt-4 relative md:col-span-2 min-h-[400px] max-h-[600px] flex flex-col">
                                        <div class="flex-1">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <?php the_post_thumbnail('full', array('class' => 'w-full h-[200px] object-cover')); ?>
                                            <?php else : ?>
                                                <div class="w-full h-[200px] bg-gray-200 flex items-center justify-center">
                                                    <p class="text-gray-500">Immagine non disponibile</p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="p-6 bg-[#e2e2e2] flex flex-col justify-between flex-1">
                                            <h3 class="text-gray-800 text-xl font-bold"><?php the_title(); ?></h3>
                                            <p class="mt-4 text-sm text-gray-500 leading-relaxed">
                                                <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                                            </p>
                                            <div class="flex justify-between items-center mt-6">
                                                <a href="<?php the_permalink(); ?>" class="inline-block px-5 py-2.5 rounded-lg text-white text-sm tracking-wider border-none outline-none bg-blue-600">
                                                    <?php esc_html_e('Leggi', 'universome'); ?>
                                                </a>
                                                <div class="flex items-center space-x-2">
                                                    <?php echo get_avatar(get_the_author_meta('ID'), 24, '', '', array('class' => 'rounded-full')); ?>
                                                    <div class="text-sm text-gray-500">
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
                                                        <p><?php echo esc_html($display_name); ?></p>
                                                        <p><?php echo get_the_date(); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class="bg-white shadow-[0_4px_12px_-5px_rgba(0,0,0,0.4)] w-full rounded-lg overflow-hidden mx-auto font-[sans-serif] mt-4 relative min-h-[400px] max-h-[600px] flex flex-col">
                                        <div class="flex-1">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <?php the_post_thumbnail('full', array('class' => 'w-full h-[200px] object-cover')); ?>
                                            <?php else : ?>
                                                <div class="w-full h-[200px] bg-gray-200 flex items-center justify-center">
                                                    <p class="text-gray-500">Immagine non disponibile</p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="p-6 bg-[#e2e2e2] flex flex-col justify-between flex-1">
                                            <h3 class="text-gray-800 text-xl font-bold"><?php the_title(); ?></h3>
                                            <div class="flex justify-between items-center mt-6">
                                                <a href="<?php the_permalink(); ?>" class="inline-block px-5 py-2.5 rounded-lg text-white text-sm tracking-wider border-none outline-none bg-blue-600">
                                                    <?php esc_html_e('Leggi', 'universome'); ?>
                                                </a>
                                                <div class="flex items-center space-x-2">
                                                    <?php echo get_avatar(get_the_author_meta('ID'), 24, '', '', array('class' => 'rounded-full')); ?>
                                                    <div class="text-sm text-gray-500">
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
                                                        <p><?php echo esc_html($display_name); ?></p>
                                                        <p><?php echo get_the_date(); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                        <?php
                            endwhile;
                        else :
                            echo '<p>' . esc_html__('No posts available in this category.', 'universome') . '</p>';
                        endif;
                        wp_reset_postdata();
                        ?>
                    </div>
                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="view-more text-blue-600 hover:underline">
                        <?php esc_html_e('Visualizza tutto', 'universome'); ?>
                    </a>
                </section>
            <?php
                endif;
            endforeach;
            ?>
        </div><!-- .flex-1 -->

<!-- Barra Laterale Fissa -->
<div class="sidebar">
    <h2 class="sidebar-title">Embedded Content</h2>
    <div class="sidebar-content">
        <iframe width="100%" height="200" src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
    <!-- Aggiungi altri contenuti embedded qui -->
</div><!-- .sidebar -->

    </div><!-- .w-full max-w-[1200px] -->
</main><!-- #main -->

<?php
get_sidebar();
get_footer();
?>
