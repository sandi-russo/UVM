<?php
/**
 * The template for displaying the homepage.
 */

get_header();

if ( is_front_page() ) {
	echo '<div class="container hero-slider-wrapper">';
	get_template_part('template-parts/components/hero-slider');
	echo '</div>';
}
?>

	<div class="main-content-area container layout-with-sidebar">
		<main class="main-content">

			<section class="posts-section" style="--category-color: var(--primary);">
				<h2 class="section-title">
					<a href="<?php echo esc_url( home_url( '/blog' ) ); ?>">Ultime Notizie</a>
				</h2>
				<div class="article-grid">
					<?php
					$latest_posts_args = [ 'post_type' => 'post', 'posts_per_page' => 4 ];
					$latest_posts_query = new WP_Query($latest_posts_args);
					$post_counter = 0;

					if ($latest_posts_query->have_posts()) :
						while ($latest_posts_query->have_posts()) : $latest_posts_query->the_post();
							$post_counter++;
							$card_classes = ($post_counter === 1) ? 'card-post--hero' : '';
							set_query_var('card_classes', $card_classes);
							get_template_part('template-parts/components/card-post');
						endwhile;
					endif;
					wp_reset_postdata();
					?>
				</div>
			</section>

			<?php
			$excluded_categories = ['evidenza', 'ipse dixit', 'redazione universome'];
			$categories = get_categories(['parent' => 0, 'hide_empty' => true]);

			foreach ($categories as $category) :
				if (in_array(strtolower($category->name), $excluded_categories)) { continue; }

				$category_color = get_field('category_color', 'category_' . $category->term_id);
				$section_style = $category_color ? 'style="--category-color: ' . esc_attr($category_color) . ';"' : '';
				?>
				<section class="posts-section" <?php echo $section_style; ?>>
					<h2 class="section-title">
						<a href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
							<?php echo esc_html($category->name); ?>
						</a>
					</h2>
					<div class="article-grid">
						<?php
						$category_args = [ 'post_type' => 'post', 'posts_per_page' => 3, 'cat' => $category->term_id ];
						$category_query = new WP_Query($category_args);

						if ($category_query->have_posts()) :
							while ($category_query->have_posts()) : $category_query->the_post();
								get_template_part('template-parts/components/card-post');
							endwhile;
						endif;
						wp_reset_postdata();
						?>
					</div>
				</section>
			<?php endforeach; ?>

		</main>
		<?php get_sidebar(); ?>
	</div>

<?php
get_footer();