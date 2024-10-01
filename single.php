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

<main class="custom-background">
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
        <?php while (have_posts()):
            the_post(); ?>

            <!-- Wrapper per centralizzare il contenuto -->
            <div class="articolo_container">
                <!-- Sezione dell'Articolo -->
                <div class="articolo">

                    <!-- Informazioni Autore e Post -->
                    <div class="author-info">
                        <!-- Avatar dell'autore -->
                        <img src="<?php echo esc_url($author_avatar); ?>" alt="<?php echo esc_attr($author_name); ?>"
                            class="author-avatar">

                        <!-- Dettagli dell'autore -->
                        <div class="author-details">
                            <a href="<?php echo esc_url($author_posts_url); ?>" class="author-name">
                                <?php echo get_author_full_name_uppercase($author_id); ?>
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
                                        <svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4zm9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8A1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5a5 5 0 0 1-5 5a5 5 0 0 1-5-5a5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3" />
                                        </svg>
                                    </a>
                                <?php endif; ?>
                                <?php if ($full_threads_url): ?>
                                    <a href="<?php echo esc_url($full_threads_url); ?>" target="_blank" title="Threads">
                                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M19.25 8.505c-1.577-5.867-7-5.5-7-5.5s-7.5-.5-7.5 8.995s7.5 8.996 7.5 8.996s4.458.296 6.5-3.918c.667-1.858.5-5.573-6-5.573c0 0-3 0-3 2.5c0 .976 1 2 2.5 2s3.171-1.027 3.5-3c1-6-4.5-6.5-6-4"
                                                color="currentColor" />
                                        </svg>
                                    </a>
                                <?php endif; ?>
                                <?php if ($full_linkedin_url): ?>
                                    <a href="<?php echo esc_url($full_linkedin_url); ?>" target="_blank" title="LinkedIn">
                                        <svg class="chi-siamo-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path fill="currentColor" fill-rule="evenodd"
                                                d="M5 1.25a2.75 2.75 0 1 0 0 5.5a2.75 2.75 0 0 0 0-5.5M3.75 4a1.25 1.25 0 1 1 2.5 0a1.25 1.25 0 0 1-2.5 0m-1.5 4A.75.75 0 0 1 3 7.25h4a.75.75 0 0 1 .75.75v13a.75.75 0 0 1-.75.75H3a.75.75 0 0 1-.75-.75zm1.5.75v11.5h2.5V8.75zM9.25 8a.75.75 0 0 1 .75-.75h4a.75.75 0 0 1 .75.75v.434l.435-.187a7.8 7.8 0 0 1 2.358-.595C20.318 7.4 22.75 9.58 22.75 12.38V21a.75.75 0 0 1-.75.75h-4a.75.75 0 0 1-.75-.75v-7a1.25 1.25 0 0 0-2.5 0v7a.75.75 0 0 1-.75.75h-4a.75.75 0 0 1-.75-.75zm1.5.75v11.5h2.5V14a2.75 2.75 0 1 1 5.5 0v6.25h2.5v-7.87c0-1.904-1.661-3.408-3.57-3.234a6.3 6.3 0 0 0-1.904.48l-1.48.635a.75.75 0 0 1-1.046-.69V8.75z"
                                                clip-rule="evenodd" />
                                        </svg>
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
                                    <span class="tag-label">
                                        <?php echo esc_html($tag->name); ?>
                                    </span>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <!-- Contenuto dell'articolo -->
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>

                        <?php if (get_edit_post_link()): ?>
                            <footer class="entry-footer">
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
                                $query->the_post(); ?>
                                <div class="card-home-other">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php if (has_post_thumbnail()): ?>
                                            <img src="<?php echo get_the_post_thumbnail_url(); ?>" class="card_img"
                                                alt="<?php the_title_attribute(); ?>">

                                        <?php else: ?>
                                            <div class="card_img_not_available">
                                                <p>Immagine non disponibile</p>
                                            </div>
                                        <?php endif; ?>
                                        <div class="card_background">
                                            <h3 class="card_title">
                                                <?php the_title(); ?>
                                            </h3>
                                        </div>
                                    </a>
                                </div>
                            <?php endwhile;
                        endif;

                        // Reset Post Data
                        wp_reset_postdata();
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