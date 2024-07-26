<?php
/**
 * The template for displaying the home page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package UNIVERSOME
 */


get_header();
?>




<main id="primary" class="site-main flex mx-[120px]">
    <!-- Sezione degli Articoli -->
    <div class="flex-1 overflow-y-auto pr-4">
        <?php
        $categories = get_categories();
        foreach ($categories as $category) :
        ?>
            <section class="category-section mb-8">
                <h1 class="text-2xl font-bold mb-4"><?php echo esc_html($category->name); ?></h1>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <?php
                    $category_posts = new WP_Query(array(
                        'cat' => $category->term_id,
                        'posts_per_page' => 4
                    ));

                    if ($category_posts->have_posts()) :
                        $first_post = true;
                        while ($category_posts->have_posts()) : $category_posts->the_post();
                            if ($first_post) :
                                $first_post = false;
                    ?>
                                <div class="md:col-span-2 bg-white shadow-[0_4px_12px_-5px_rgba(0,0,0,0.4)] w-full rounded-lg overflow-hidden mx-auto font-[sans-serif] mt-4 relative">
                                    <div class="max-h-[256px] overflow-hidden">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('full', array('class' => 'w-full h-full object-cover')); ?>
                                        <?php else : ?>
                                            <img src="https://readymadeui.com/Imagination.webp" class="w-full h-full object-cover" />
                                        <?php endif; ?>
                                    </div>
                                    <div class="p-6">
                                        <h3 class="text-gray-800 text-xl font-bold"><?php the_title(); ?></h3>
                                        <p class="mt-4 text-sm text-gray-500 leading-relaxed">
                                            <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                                        </p>
                                        <a href="<?php the_permalink(); ?>" class="mt-6 inline-block px-5 py-2.5 rounded-lg text-white text-sm tracking-wider border-none outline-none bg-blue-600 hover:bg-blue-700 active:bg-blue-600">
                                            <?php esc_html_e('Leggi', 'universome'); ?>
                                        </a>
                                    </div>
                                    <div class="absolute bottom-4 right-4 flex items-center space-x-2">
                                        <?php echo get_avatar(get_the_author_meta('ID'), 32); ?>
                                        <div class="text-sm text-gray-500">
                                            <p><?php echo get_the_author(); ?></p>
                                            <p><?php echo get_the_date(); ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="bg-white shadow-[0_4px_12px_-5px_rgba(0,0,0,0.4)] w-full rounded-lg overflow-hidden mx-auto font-[sans-serif] mt-4">
                                    <div class="max-h-[256px] overflow-hidden">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('full', array('class' => 'w-full h-full object-cover')); ?>
                                        <?php else : ?>
                                            <img src="https://readymadeui.com/Imagination.webp" class="w-full h-full object-cover" />
                                        <?php endif; ?>
                                    </div>
                                    <div class="p-6">
                                        <h3 class="text-gray-800 text-xl font-bold"><?php the_title(); ?></h3>
                                        <a href="<?php the_permalink(); ?>" class="mt-6 inline-block px-5 py-2.5 rounded-lg text-white text-sm tracking-wider border-none outline-none bg-blue-600 hover:bg-blue-700 active:bg-blue-600">
                                            <?php esc_html_e('View', 'universome'); ?>
                                        </a>
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
                    <?php esc_html_e('View more', 'universome'); ?>
                </a>
            </section>
        <?php
        endforeach;
        ?>
    </div><!-- .flex-1 -->

    <!-- Barra Laterale Fissa -->
    <div class="w-full md:w-1/3 lg:w-1/4 flex-shrink-0 sticky top-0 self-start p-4 bg-gray-100 min-h-screen overflow-hidden">
        <h2 class="text-xl font-bold mb-4">Embedded Content</h2>
        <div class="mb-4">
            <iframe width="100%" height="200" src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <!-- Aggiungi altri contenuti embedded qui -->
    </div><!-- .w-full -->
</main><!-- #main -->

<?php
get_sidebar();
get_footer();
?>
