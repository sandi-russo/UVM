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
$author_id = get_post_field('post_author', $post_id);
$author_name = get_the_author_meta('display_name', $author_id);
$author_avatar = get_avatar_url($author_id, array('size' => 80));
$author_posts_url = get_author_posts_url($author_id);
$post_date = get_the_date();
$category = get_the_category();
$tags = get_the_tags();
?>

<!-- Immagine in evidenza con titolo -->
<div class="post_top w-full relative mb-8">
	<div class="relative overflow-hidden shadow-lg">
		<?php if (has_post_thumbnail()): ?>
			<?php the_post_thumbnail('full', array('class' => 'post_img')); ?>
		<?php else: ?>
			<div class="w-full h-96 bg-gray-300"></div>
		<?php endif; ?>
		<div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-10">
			<h1 class="post_title text-white text-4xl font-bold"><?php the_title(); ?></h1>
		</div>
	</div>
</div>

<div class="site_container">
	<main id="primary" class="site-main">
		<!-- Informazioni Autore e Post -->
		<div class="author-info rounded-lg p-6 mb-6 flex items-center justify-between">
			<img src="<?php echo esc_url($author_avatar); ?>" alt="<?php echo esc_attr($author_name); ?>"
				class="author-avatar rounded-full w-20 h-20 mr-4">
			<div class="author-details flex-grow">
				<a href="<?php echo esc_url($author_posts_url); ?>" class="author-name text-xl font-bold text-black">
					<?php echo esc_html($author_name); ?>
				</a>
				<div class="post-date text-gray-600">
					<?php echo esc_html($post_date); ?>
				</div>
			</div>

			<div class="post-social-icons flex-shrink-0">
				<a href="https://www.instagram.com/tuo_profilo_instagram" target="_blank">
					<svg class="icon social-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
						viewBox="0 0 24 24">
						<path fill="currentColor"
							d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4zm9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8A1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5a5 5 0 0 1-5 5a5 5 0 0 1-5-5a5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3" />
					</svg>
				</a>
				<a href="https://www.linkedin.com/in/tuo_profilo_linkedin" target="_blank">
					<svg class="icon social-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
						viewBox="0 0 16 16">
						<path fill="currentColor"
							d="M9.294 6.928L14.357 1h-1.2L8.762 6.147L5.25 1H1.2l5.31 7.784L1.2 15h1.2l4.642-5.436L10.751 15h4.05zM7.651 8.852l-.538-.775L2.832 1.91h1.843l3.454 4.977l.538.775l4.491 6.47h-1.843z" />
					</svg>
				</a>
			</div>
		</div>

		<!-- Categoria e Tag -->
		<div class="category-tags-wrapper flex flex-wrap gap-2 justify-center mb-2">
			<?php if (!empty($category)): ?>
				<div class="category-label bg-blue-100 text-blue-600 px-2 py-1 rounded">
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
			<div class="site_container mx-auto flex">
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

						<!-- Pulsante di condivisione -->
						<div class="share-button mt-8">
							<button onclick="shareArticle()"
								class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
								Condividi Articolo
							</button>
						</div>
					</article>
				</div>

				<!-- Barra Laterale -->
				<div class="sidebar w-1/4 px-5 rounded-r-lg bg-white shadow-lg">
					<h2 class="sidebar-title text-black text-2xl font-bold mb-4">Articoli Suggeriti</h2>
					<div class="sidebar-content">
						<?php
						$args = array(
							'post_type' => 'post',
							'posts_per_page' => 4,
							'post__not_in' => array(get_the_ID()),
						);
						$query = new WP_Query($args);
						if ($query->have_posts()):
							while ($query->have_posts()):
								$query->the_post();
								?>
								<div class="bg-white shadow-md rounded-lg overflow-hidden mb-4">
									<a href="<?php the_permalink(); ?>" class="flex flex-col">
										<?php if (has_post_thumbnail()): ?>
											<?php the_post_thumbnail('medium', array('class' => 'side_img w-full object-cover')); ?>
										<?php else: ?>
											<div class="w-full h-40 bg-gray-200 flex items-center justify-center">
												<p class="text-gray-500">Immagine non disponibile</p>
											</div>
										<?php endif; ?>
										<div class="p-4">
											<h3 class="side_text text-lg font-semibold text-gray-900"><?php the_title(); ?></h3>
										</div>
									</a>
								</div>
								<?php
							endwhile;
							wp_reset_postdata();
						endif;
						?>
					</div>
				</div>

			</div>
		<?php endwhile; ?>

	</main>
</div>

<?php
get_sidebar();
get_footer();
