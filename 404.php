<?php
/**
 * The template for displaying 404 pages (Not Found)
 */

get_header();
?>

<?php // Usiamo layout-full-width per assicurarci che non ci sia la sidebar ?>
	<div class="main-content-area container layout-full-width">
		<main class="main-content">

			<section class="error-404-content">

				<span class="error-404-number">404</span>

				<h1 class="error-404-title">Oops! Pagina non trovata.</h1>

				<p class="error-404-description">
					Sembra che tu abbia seguito un link non valido o che la pagina sia stata rimossa.
				</p>

				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn">Torna alla Homepage</a>

				<span class="error-404-or">oppure</span>

				<p class="error-404-search-label">Cerca nel sito:</p>

				<?php // Riusiamo la struttura HTML del tuo search-overlay per coerenza di stile ?>
				<div class="error-404-search">
					<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="search-form">
						<input type="search" placeholder="Cosa stai cercando?" name="s" autocomplete="off">
						<button type="submit" aria-label="Esegui ricerca">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
								<circle cx="11" cy="11" r="8"></circle>
								<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
							</svg>
						</button>
					</form>
				</div>

			</section>

		</main>
	</div>

<?php get_footer(); ?>