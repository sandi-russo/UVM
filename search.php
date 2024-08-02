<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package UNIVERSOME
 */

get_header();
?>

<div class="site_container min-h-screen py-8 px-4 sm:px-6 lg:px-8">
	<main id="primary" class="site-main mx-auto max-w-4xl">

		<?php if (have_posts()): ?>

			<header class="page-header mb-8">
				<h1 class="page-title text-3xl font-bold text-gray-900">
					<?php
					/* translators: %s: search query. */
					printf(esc_html__('Hai cercato: %s', 'universome'), '<span class="text-[#ff8800]">' . get_search_query() . '</span>');
					?>
				</h1>
			</header><!-- .page-header -->

			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
				<?php
				/* Start the Loop */
				while (have_posts()):
					the_post();
					?>
					<article class="bg-white shadow-md rounded-lg overflow-hidden flex flex-col min-h-[300px] max-h-[600px] mx-auto flex">
						<a href="<?php the_permalink(); ?>">
							<?php if (has_post_thumbnail()): ?>
								<div class="relative">
									<?php the_post_thumbnail('large', ['class' => 'card_img w-full h-48 object-cover']); ?>
									<div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-50"></div>
								</div>
							<?php else: ?>
								<div class="w-full h-48 bg-gray-200 flex items-center justify-center">
									<p class="text-gray-500">Immagine non disponibile</p>
								</div>
							<?php endif; ?>
						</a>
						<div class="p-6 bg-[#e2e2e2] flex flex-col flex-1">
							<h2 class="card_title text-xl font-bold mb-2">
								<a href="<?php the_permalink(); ?>" class="text-gray-900">
									<?php the_title(); ?>
								</a>
							</h2>
							<p class="card_description text-gray-600 mb-4 flex-1 min-h-[50px]">
								<?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
							</p>
							<div class="flex items-center justify-between mt-6">
								<div class="flex-1 flex flex-col text-sm text-gray-500 text-right">
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
									<p class="card_author"><?php echo esc_html($display_name); ?></p>
									<p class="card_author"><?php echo get_the_date(); ?></p>
								</div>
								<div class="ml-4">
									<?php echo get_avatar(get_the_author_meta('ID'), 24, '', '', array('class' => 'rounded-full')); ?>
								</div>
							</div>

						</div>
					</article>
					<?php
				endwhile;

				the_posts_navigation([
					'prev_text' => __('Pagina Precedente', 'universome'),
					'next_text' => __('Pagina Successiva', 'universome'),
					'screen_reader_text' => __('Posts navigation', 'universome'),
				]);
				?>
			</div>

		<?php else: ?>

			<div class="no-results text-center text-gray-600">
				<?php get_template_part('template-parts/content', 'none'); ?>
			</div>

		<?php endif; ?>

	</main><!-- #main -->
</div>

<?php
get_sidebar();
get_footer();
