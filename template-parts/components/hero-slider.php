<?php
/**
 * Template Part for Hero Slider (Single Slide, Fade Effect)
 */

$args = [
        'post_type'      => 'post',
        'posts_per_page' => 5, // Carica 5 post da mostrare a rotazione
        'category_name'  => 'evidenza',
        'orderby'        => 'date',
        'order'          => 'DESC',
];

$slider_query = new WP_Query( $args );

if ( $slider_query->have_posts() ) :
    ?>
    <section class="hero-slider-section">

        <div class="swiper hero-slider">
            <div class="swiper-wrapper">
                <?php while ( $slider_query->have_posts() ) : $slider_query->the_post(); ?>
                    <div class="swiper-slide">
                        <a href="<?php the_permalink(); ?>" class="slide-link">
                            <div class="slide-background"
                                 style="background-image: url('<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' ); ?>');"></div>
                            <div class="slide-overlay"></div>
                            <div class="slide-content">
                                <?php
                                $categories = get_the_category();
                                if ( ! empty( $categories ) ) {
                                    $category = $categories[0];

                                    // Leggi il colore da ACF
                                    $category_color = '';
                                    if ( function_exists( 'get_field' ) ) {
                                        $category_color = get_field( 'category_color', 'category_' . $category->term_id );
                                    }
                                    $style = $category_color ? 'style="background-color: ' . esc_attr( $category_color ) . ';"' : '';

                                    echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" class="slide-category" ' . $style . '>' . esc_html( $category->name ) . '</a>';
                                }
                                ?>
                                <h2 class="slide-title"><?php the_title(); ?></h2>
                            </div>
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>

    </section>
    <?php
    wp_reset_postdata();
endif;
?>