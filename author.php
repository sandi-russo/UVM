<?php
/**
 * The template for displaying Author archive pages
 */

get_header();

// Recupera i dati dell'autore della pagina corrente
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
$author_id = $curauth->ID;
?>

	<div class="main-content-area container layout-with-sidebar">

		<main class="main-content">

			<?php // --- INIZIO SCHEDA AUTORE --- ?>
			<section class="author-box-archive">

				<?php // Avatar (usa una dimensione grande) ?>
				<div class="author-box-archive__avatar">
					<?php echo get_avatar( $author_id, 120 ); ?>
				</div>

				<div class="author-box-archive__info">
					<span class="author-box-archive__label">Autore</span>
					<h1 class="author-box-archive__name"><?php echo esc_html($curauth->display_name); ?></h1>

					<?php // Biografia (da Utenti > Profilo > Informazioni biografiche) ?>
					<?php if ( $curauth->description ) : ?>
						<p class="author-box-archive__bio"><?php echo esc_html($curauth->description); ?></p>
					<?php endif; ?>

					<?php // Social (logica copiata da single.php) ?>
					<div class="author-socials">
						<?php
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
			</section>
			<?php // --- FINE SCHEDA AUTORE --- ?>


			<?php // --- INIZIO LISTA ARTICOLI --- ?>
			<h2 class="section-title" style="margin-top: var(--space-lg);">
				Tutti gli articoli di <?php echo esc_html($curauth->first_name); ?>
			</h2>

			<?php if ( have_posts() ) : ?>

				<div class="article-grid">
					<?php
					// Il Loop
					while ( have_posts() ) :
						the_post();
						get_template_part('template-parts/components/card-post');
					endwhile;
					?>
				</div>

				<?php
				// Navigazione Paginata (Numerata)
				the_posts_pagination( array(
					'mid_size'  => 2, // Quanti numeri mostrare ai lati del corrente
					'prev_text' => '<span>&laquo;</span>', // Freccia sinistra
					'next_text' => '<span>&raquo;</span>', // Freccia destra
				) );
				?>

			<?php else : ?>
				<p>Questo autore non ha ancora pubblicato articoli.</p>
			<?php endif; ?>
			<?php // --- FINE LISTA ARTICOLI --- ?>

		</main>

		<?php get_sidebar(); ?>

	</div>

<?php
get_footer();
?>