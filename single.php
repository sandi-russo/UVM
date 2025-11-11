<?php
/**
 * The template for displaying all single posts
 * (Versione 3: Categoria spostata dall'hero ai meta sottostanti)
 */

get_header();
?>

    <div class="main-content-area container layout-with-sidebar">

        <?php get_sidebar(); // Caricato per primo per l'ordine corretto su mobile ?>

        <main class="main-content">
            <?php while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post-container' ); ?>>

                    <?php
                    // 1. BLOCCO IMMAGINE STILE SLIDER (Senza Categoria)
                    $featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                    ?>
                    <div class="single-post-hero">

                        <?php if ( $featured_img_url ) : ?>
                            <div class="slide-background"
                                 style="background-image: url('<?php echo esc_url( $featured_img_url ); ?>');"></div>
                        <?php endif; ?>

                        <div class="slide-overlay"></div>

                        <div class="slide-content">
                            <?php
                            /*
                             * --- BLOCCO CATEGORIA RIMOSSO ---
                             * È stato spostato sotto, nel blocco .meta-tags
                             */
                            ?>

                            <h1 class="slide-title"><?php the_title(); ?></h1>
                        </div>
                    </div>

                    <?php // 2. BLOCCO META (Autore e Categoria/Tags) ?>
                    <div class="single-post-meta">

                        <div class="meta-top-row">
                            <div class="meta-author">
                                <?php echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?>

                                <div class="author-info">
                                    <span class="author-name"><?php echo get_the_author_meta( 'display_name' ); ?></span>

                                    <div class="author-socials">
                                        <?php
                                        $author_id          = get_the_author_meta( 'ID' );
                                        $linkedin_url       = get_user_meta( $author_id, 'linkedin_url', true );
                                        $instagram_username = get_user_meta( $author_id, 'instagram_username', true );
                                        $threads_username   = get_user_meta( $author_id, 'threads_username', true );

                                        if ( ! empty( $linkedin_url ) ) : ?>
                                            <a href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank"
                                               rel="noopener noreferrer"
                                               aria-label="Profilo LinkedIn"><?php echo uvm_get_svg_icon( 'linkedin' ); ?></a>
                                        <?php endif;

                                        if ( ! empty( $instagram_username ) ) : ?>
                                            <a href="https://instagram.com/<?php echo esc_attr( $instagram_username ); ?>"
                                               target="_blank" rel="noopener noreferrer"
                                               aria-label="Profilo Instagram"><?php echo uvm_get_svg_icon( 'instagram' ); ?></a>
                                        <?php endif;

                                        if ( ! empty( $threads_username ) ) : ?>
                                            <a href="https://threads.net/@<?php echo esc_attr( $threads_username ); ?>"
                                               target="_blank" rel="noopener noreferrer"
                                               aria-label="Profilo Threads"><?php echo uvm_get_svg_icon( 'threads' ); ?></a>
                                        <?php endif; ?>
                                    </div>

                                </div>
                            </div>

                            <span class="post-date"><?php echo get_the_date( 'd/m/y' ); ?></span>
                        </div>


                        <?php
                        /* --- NUOVO BLOCCO CATEGORIA + TAGS --- */
                        $tags       = get_the_tags();
                        $categories = get_the_category(); // Prendiamo le categorie

                        // Mostra il contenitore solo se c'è almeno una categoria o un tag
                        if ( ! empty( $categories ) || ! empty( $tags ) ) {

                            echo '<div class="meta-tags">';

                            // 1. Mostra la "bolla" della Categoria (come da tua richiesta)
                            if ( ! empty( $categories ) ) {
                                $category       = $categories[0];
                                $category_color = '';
                                if ( function_exists( 'get_field' ) ) {
                                    $category_color = get_field( 'category_color', 'category_' . $category->term_id );
                                }
                                // Se non c'è colore, usa --primary.
                                $style = $category_color ? 'style="background-color: ' . esc_attr( $category_color ) . '; border-color: ' . esc_attr( $category_color ) . ';"' : '';

                                echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" class="meta-category-tag" ' . $style . '>' . esc_html( $category->name ) . '</a>';
                            }

                            // 2. Mostra solo i primi 2 Tags
                            if ( $tags ) {
                                $count = 0;
                                foreach ( $tags as $tag ) {
                                    if ( $count >= 2 ) {
                                        break;
                                    } // Limite a 2 tags
                                    // Aggiunta classe specifica per i tag
                                    echo '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" class="meta-tag-item" rel="tag">' . esc_html( $tag->name ) . '</a>';
                                    $count ++;
                                }
                            }

                            echo '</div>';
                        }
                        ?>
                    </div>

                    <?php // 3. CONTENUTO ARTICOLO ?>
                    <div class="single-post-content entry-content">
                        <?php
                        the_content();

                        wp_link_pages( [
                                'before' => '<div class="page-links">' . esc_html__( 'Pagine:', 'universome' ),
                                'after'  => '</div>',
                        ] );
                        ?>
                    </div>

                </article>

            <?php endwhile; // Fine del loop. ?>
        </main>
    </div>

<?php
get_footer();
?>