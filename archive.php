<?php
/**
 * The template for displaying archive pages (Category, Tag, Date, etc.)
 */

get_header();
?>

	<div class="main-content-area container layout-with-sidebar">

		<main class="main-content">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<?php
					// Mostra il titolo pulito (es. "Nome Categoria" invece di "Categoria: Nome Categoria")
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					?>
				</header>

				<div class="article-grid">
					<?php
					// Inizia il Loop
					while ( have_posts() ) :
						the_post();
						get_template_part('template-parts/components/card-post');
					endwhile;
					?>
				</div>

				<?php
				// Paginazione Numerata
				the_posts_pagination( array(
					'mid_size'  => 2,
					'prev_text' => '<span>&laquo;</span>',
					'next_text' => '<span>&raquo;</span>',
				) );
				?>

			<?php else : // Se non ci sono risultati ?>

				<header class="page-header">
					<h1 class="page-title">Nessun articolo trovato</h1>
				</header>

				<section class="no-results-content">
					<p>Spiacenti, nessun articolo è stato trovato in questo archivio.</p>

					<?php // Riusiamo lo stesso stile del form 404/overlay ?>
					<div class="no-results-search">
						<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="search-form">
							<input type="search" placeholder="Cosa stai cercando?" name="s" autocomplete="off">
							<button type="submit" aria-label="Esegui ricerca">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<circle cx="11" cy="11" r="8"></circle>
									<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
								</svg>
							</button>
						</form>
					</div>
				</section>

			<?php endif; ?>

		</main>

		<?php get_sidebar(); ?>

	</div>

<?php
get_footer();
?>