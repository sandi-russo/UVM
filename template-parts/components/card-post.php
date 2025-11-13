<?php
/**
 * Template part for displaying a post card.
 * (v1.1 - Aggiunto placeholder per immagini mancanti)
 */
$card_classes = get_query_var('card_classes', '');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('card-post ' . $card_classes); ?>>
    <a href="<?php the_permalink(); ?>" class="card-post__link">

        <?php if (has_post_thumbnail()) : ?>

            <div class="card-post__image-wrapper">
                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'uvm_card'); ?>" alt="<?php the_title_attribute(); ?>" class="card-post__image">
            </div>

        <?php else : // --- INIZIO MODIFICA: Placeholder per immagine mancante --- ?>

            <div class="card-post__image-wrapper card-post__image-placeholder">
                <span class="card-post__placeholder-text">
                    Nessuna immagine disponibile
                </span>
            </div>

        <?php endif; // --- FINE MODIFICA --- ?>


        <div class="card-post__content">
            <h3 class="card-post__title"><?php the_title(); ?></h3>
            <div class="card-post__excerpt">
                <?php the_excerpt(); ?>
            </div>
            <div class="card-post__meta">
                <div class="card-post__author">
                    <?php echo get_avatar(get_the_author_meta('ID'), 24); ?>
                    <span><?php echo strtoupper(get_the_author()); ?></span>
                </div>
                <time class="card-post__date" datetime="<?php echo get_the_date('c'); ?>">
                    <?php echo get_the_date('d/m/y'); ?>
                </time>
            </div>
        </div>

    </a>
</article>