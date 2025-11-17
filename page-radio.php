<?php
/**
 * Il template per la visualizzazione della pagina "Radio"
 * (v6 - Layout Invertito, Orario Inizio/Fine, Immagine Verticale)
 */

get_header();
?>

<?php // Layout-full-width per rimuovere la sidebar ?>
    <div class="main-content-area container layout-full-width">
        <main class="main-content">

            <?php // --- 1. Contenuto della Pagina (ORA SOPRA) --- ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('static-page-container'); ?>>
                    <header class="page-header">
                        <h1 class="page-title"><?php the_title(); ?></h1>
                    </header>
                    <div class="entry-content">
                        <?php the_content(); // Qui va il testo della pagina Radio, palinsesto ecc. ?>
                    </div>
                </article>
            <?php endwhile; ?>


            <?php
            // --- 2. Query per lo Swiper (ORA SOTTO) ---
            $args = array(
                    'post_type'      => 'programma_radio',
                    'posts_per_page' => 10,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
            );
            $slider_query = new WP_Query($args);

            if ($slider_query->have_posts()) :
                ?>
                <section class="radio-slider-section">

                    <h2 class="section-title" style="text-align: center;">I Nostri Programmi</h2>

                    <div class="swiper radio-program-slider">
                        <div class="swiper-wrapper">
                            <?php while ($slider_query->have_posts()) : $slider_query->the_post(); ?>

                                <?php
                                // --- Lettura campi ACF (con Inizio e Fine) ---
                                $speaker = get_field('radio_speaker');

                                // Logica Giorni (Checkbox)
                                $giorni_keys = get_field('radio_giorno');
                                $giorni_labels = [];
                                if ( !empty($giorni_keys) && is_array($giorni_keys) ) {
                                    $choices = get_field_object('radio_giorno')['choices'];
                                    foreach ($giorni_keys as $key) {
                                        if ( isset($choices[$key]) ) {
                                            $giorni_labels[] = $choices[$key];
                                        }
                                    }
                                }
                                $giorni_string = implode(', ', $giorni_labels);

                                // Logica Orario (Inizio - Fine)
                                $orario_inizio = get_field('radio_orario_inizio');
                                $orario_fine = get_field('radio_orario_fine');
                                $orario_string = '';
                                if ($orario_inizio) {
                                    $orario_string = $orario_inizio;
                                    if ($orario_fine) {
                                        $orario_string .= ' - ' . $orario_fine; // Es: "14:00 - 15:00"
                                    }
                                }
                                ?>

                                <div class="swiper-slide">
                                    <a href="<?php the_permalink(); ?>" class="slide-link">

                                        <?php // --- MODIFICA: Usa la nuova immagine verticale --- ?>
                                        <div class="slide-background" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'uvm_radio_slider'); ?>');"></div>
                                        <div class="slide-overlay"></div>

                                        <div class="slide-content">

                                        <span class="slide-category" style="background-color: var(--primary);">
                                            <?php
                                            // Stampa "Lunedì • 14:00 - 15:00"
                                            if ($giorni_string) echo esc_html($giorni_string);
                                            if ($giorni_string && $orario_string) echo ' &bull; ';
                                            if ($orario_string) echo esc_html($orario_string);
                                            ?>
                                        </span>

                                            <h2 class="slide-title"><?php the_title(); ?></h2>

                                            <?php if ($speaker) : ?>
                                                <span class="radio-slide-speaker">
                                                Con: <?php echo esc_html($speaker); ?>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                </div>
                            <?php endwhile; ?>
                        </div>

                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-pagination"></div>
                    </div>

                </section>
                <?php
                wp_reset_postdata();
            endif;
            ?>

        </main>

        <?php // NESSUNA SIDEBAR ?>

    </div>

<?php
get_footer();
?>