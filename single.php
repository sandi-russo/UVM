<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package UNIVERSOME
 */

get_header();
?>

<?php
$author_id = get_post_field('post_author', get_the_ID());

// Ottieni nome e cognome dell'autore
$first_name = get_the_author_meta('first_name', $author_id);
$last_name = get_the_author_meta('last_name', $author_id);

// Combina il nome e il cognome
$author_name = $first_name . ' ' . $last_name;

// Applica la formattazione corretta: prima lettera maiuscola e il resto minuscolo
$author_name = ucwords(strtolower($author_name));

// Controlla se esiste un avatar personalizzato
$custom_avatar = get_user_meta($author_id, 'custom_avatar', true);

if ($custom_avatar) {
    // Se esiste, usa l'avatar personalizzato
    $author_avatar = $custom_avatar;
} else {
    // Altrimenti, usa l'avatar predefinito di WordPress
    $author_avatar = get_avatar_url($author_id, array('size' => 80));
}

$author_posts_url = get_author_posts_url($author_id);
$post_date = get_the_date();
$category = get_the_category();
$tags = get_the_tags();

// Recupera i dati dei campi social dell'autore
$instagram = get_the_author_meta('instagram', $author_id);
$threads = get_the_author_meta('threads', $author_id);
$linkedin = get_the_author_meta('linkedin', $author_id);

// Definisci gli URL di base per i social network
$full_instagram_url = !empty($instagram) ? 'https://www.instagram.com/' . esc_attr($instagram) : '';
$full_threads_url = !empty($threads) ? 'https://www.threads.net/' . esc_attr($threads) : '';
$full_linkedin_url = !empty($linkedin) ? 'https://www.linkedin.com/in/' . esc_attr($linkedin) : '';
?>

<main>
    <!-- Immagine in evidenza con titolo -->
    <div class="post_top">
        <div class="post_top_space">
            <?php if (has_post_thumbnail()): ?>
                <!-- Se l'immagine in evidenza esiste, mostra l'immagine -->
                <?php the_post_thumbnail('full', array('class' => 'post_img')); ?>
            <?php else: ?>
                <!-- Se l'immagine in evidenza non esiste, mostra il messaggio -->
                <div class="post_img_not_available">
                    <p>Immagine non disponibile</p>
                </div>
            <?php endif; ?>
            <div class="carosello-titolo">
                <h1 class="title"><?php the_title(); ?></h1>
            </div>
        </div>
    </div>

    <div class="site_container">

        <!-- Informazioni Autore e Post -->
        <div class="author-info">
            <!-- Avatar dell'autore -->
            <img src="<?php echo esc_url($author_avatar); ?>" alt="<?php echo esc_attr($author_name); ?>"
                class="author-avatar">

            <!-- Dettagli dell'autore -->
            <div class="author-details">
                <a href="<?php echo esc_url($author_posts_url); ?>" class="author-name">
                    <?php echo esc_html($author_name); ?>
                </a>
                <div class="post-date">
                    <?php echo esc_html($post_date); ?>
                </div>
            </div>

            <!-- Icone Social -->
            <?php if ($full_instagram_url || $full_threads_url || $full_linkedin_url): ?>
                <div class="post-social-icons">
                    <?php if ($full_instagram_url): ?>
                        <a href="<?php echo esc_url($full_instagram_url); ?>" target="_blank" title="Instagram">
                            <!-- icona Instagram -->
                        </a>
                    <?php endif; ?>
                    <?php if ($full_threads_url): ?>
                        <a href="<?php echo esc_url($full_threads_url); ?>" target="_blank" title="threads">
                            <!-- icona threads -->
                        </a>
                    <?php endif; ?>
                    <?php if ($full_linkedin_url): ?>
                        <a href="<?php echo esc_url($full_linkedin_url); ?>" target="_blank" title="LinkedIn">
                            <!-- icona LinkedIn -->
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>





        <!-- Categoria e Tag -->
        <div class="category-tags-wrapper">
            <?php if (!empty($category)): ?>
                <div class="category-label">
                    <?php echo esc_html($category[0]->name); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($tags)): ?>
                <?php foreach ($tags as $index => $tag): ?>
                    <?php if ($index < 5): ?>
                        <span class="tag-label bg-green-100 text-green-600 px-2 py-1 rounded">
                            <?php echo esc_html($tag->name); ?>
                        </span>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <?php while (have_posts()):
            the_post(); ?>
            <!-- Wrapper per centralizzare il contenuto -->
            <div class="mx-auto flex">
                <!-- Sezione dell'Articolo -->
                <div class="articolo flex-1 overflow-y-auto pr-4 px-5 bg-white rounded-l-lg shadow-lg">
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>

                        <?php if (get_edit_post_link()): ?>
                            <footer class="entry-footer mt-4">
                                <?php
                                edit_post_link(
                                    sprintf(
                                        wp_kses(
                                            /* translators: %s: Name of current post. Only visible to screen readers */
                                            __('Edit <span class="screen-reader-text">%s</span>', 'universome'),
                                            array(
                                                'span' => array(
                                                    'class' => array(),
                                                ),
                                            )
                                        ),
                                        wp_kses_post(get_the_title())
                                    ),
                                    '<span class="edit-link">',
                                    '</span>'
                                );
                                ?>
                            </footer>
                        <?php endif; ?>
                    </article>
                </div>

                <!-- Barra Laterale -->
                <div class="single_sidebar">
                    <h2 class="single_sidebar-title">Articoli Suggeriti</h2>
                    <div class="sidebar-content">
                        <?php
                        $args = array(
                            'post_type' => 'post',
                            'posts_per_page' => 4,
                            'orderby' => 'rand',
                            'meta_query' => array(
                                array(
                                    'key' => '_thumbnail_id',
                                    'compare' => 'EXISTS'
                                ),
                            )
                        );
                        $query = new WP_Query($args);

                        if ($query->have_posts()):
                            while ($query->have_posts()):
                                $query->the_post();
                                ?>
                                <div class="sidebar-card">
                                    <a href="<?php the_permalink(); ?>" class="sidebar-card-link">
                                        <div class="sidebar-card-thumbnail">
                                            <?php the_post_thumbnail('thumbnail'); ?>
                                        </div>
                                        <h3 class="sidebar-card-title"><?php the_title(); ?></h3>
                                    </a>
                                </div>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        else:
                            echo '<p>Nessun articolo trovato con immagine in evidenza.</p>';
                        endif;
                        ?>
                    </div>
                </div>




            </div>
        <?php endwhile; ?>

        <!-- Pulsante di condivisione fisso su mobile -->
        <button onclick="shareArticle()" class="fixed-share-button">
            Condividi Articolo
        </button>
</main>
</div>

<?php
get_sidebar();
get_footer();
?>