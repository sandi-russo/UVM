<?php
/**
 * The template for displaying all single posts (Layout Categoria in Hero)
 */

get_header();
?>

	<div class="main-content-area container layout-with-sidebar">

		<?php get_sidebar(); // Caricato per primo per l'ordine corretto su mobile ?>

		<main class="main-content">
			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('single-post-container'); ?>>

					<?php
					// 1. BLOCCO IMMAGINE STILE SLIDER (con Categoria e Titolo)
					$featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
					?>
					<div class="single-post-hero">

						<?php if ( $featured_img_url ) : ?>
							<div class="slide-background" style="background-image: url('<?php echo esc_url($featured_img_url); ?>');"></div>
						<?php endif; ?>

						<div class="slide-overlay"></div>

						<div class="slide-content">
							<?php
							// Categoria con colore
							$categories = get_the_category();
							if ( ! empty( $categories ) ) {
								$category = $categories[0];
								$category_color = get_field('category_color', 'category_' . $category->term_id);
								$style = $category_color ? 'style="background-color: ' . esc_attr($category_color) . ';"' : '';

								echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" class="slide-category" ' . $style . '>' . esc_html( $category->name ) . '</a>';
							}
							?>

							<h1 class="slide-title"><?php the_title(); ?></h1>
						</div>
					</div>

					<?php // 2. BLOCCO META (Autore e Tags) ?>
					<div class="single-post-meta">

						<div class="meta-top-row">
							<div class="meta-author">
								<?php echo get_avatar( get_the_author_meta('ID'), 80 ); // <-- Dimensione avatar aumentata a 80 ?>

								<div class="author-info">
									<span class="author-name"><?php echo get_the_author_meta('display_name'); ?></span>

									<div class="author-socials">
										<?php
										$author_id = get_the_author_meta('ID');
										$linkedin_url = get_user_meta( $author_id, 'linkedin_url', true );
										$instagram_username = get_user_meta( $author_id, 'instagram_username', true );
										$threads_username = get_user_meta( $author_id, 'threads_username', true );

										if ( ! empty( $linkedin_url ) ) : ?>
											<a href="<?php echo esc_url($linkedin_url); ?>" target="_blank" rel="noopener noreferrer" aria-label="Profilo LinkedIn"><?php echo uvm_get_svg_icon('linkedin'); ?></a>
										<?php endif;

										if ( ! empty( $instagram_username ) ) : ?>
											<a href="https://instagram.com/<?php echo esc_attr($instagram_username); ?>" target="_blank" rel="noopener noreferrer" aria-label="Profilo Instagram"><?php echo uvm_get_svg_icon('instagram'); ?></a>
										<?php endif;

										if ( ! empty( $threads_username ) ) : ?>
											<a href="https://threads.net/@<?php echo esc_attr($threads_username); ?>" target="_blank" rel="noopener noreferrer" aria-label="Profilo Threads"><?php echo uvm_get_svg_icon('threads'); ?></a>
										<?php endif; ?>
									</div>

								</div>
							</div>

							<span class="post-date"><?php echo get_the_date('d/m/y'); ?></span>
						</div>


						<?php
						// Tags (Sotto e centrati)
						$tags = get_the_tags();
						if ( $tags ) {
							echo '<div class="meta-tags">';
							$count = 0;
							foreach( $tags as $tag ) {
								if ( $count >= 4 ) break;
								echo '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" rel="tag">' . esc_html( $tag->name ) . '</a>';
								$count++;
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