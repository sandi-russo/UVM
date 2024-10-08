<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package UNIVERSOME
 */

get_header();
?>

<div class="site_container">
	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<div class="page-content">
				<section class="sezione-error">
					<div class="contenitore-404">
						<div class="contenuto-404">
							<h1 class="titolo-404">404</h1>
							<p class="sottotitolo-404">Pagina non trovata.</p>
							<p class="messaggio-404">Ci dispiace, ma la pagina che stai cercando, non è disponibile.</p>
							<div class="contenitore-bottone-404">
								<a href="<?php echo esc_url(home_url('/')); ?>" class="bottone-404">
									<?php esc_html_e('Torna alla Home', 'universome'); ?>
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="icona-casa">
										<path fill="currentColor"
											d="M8.998 2.388a1.5 1.5 0 0 1 2.005 0l5.5 4.942A1.5 1.5 0 0 1 17 8.445V15.5a1.5 1.5 0 0 1-1.5 1.5H13a1.5 1.5 0 0 1-1.5-1.5V12a.5.5 0 0 0-.5-.5H9a.5.5 0 0 0-.5.5v3.5A1.5 1.5 0 0 1 7 17H4.5A1.5 1.5 0 0 1 3 15.5V8.445c0-.425.18-.83.498-1.115zm1.336.744a.5.5 0 0 0-.668 0l-5.5 4.942A.5.5 0 0 0 4 8.445V15.5a.5.5 0 0 0 .5.5H7a.5.5 0 0 0 .5-.5V12A1.5 1.5 0 0 1 9 10.5h2a1.5 1.5 0 0 1 1.5 1.5v3.5a.5.5 0 0 0 .5.5h2.5a.5.5 0 0 0 .5-.5V8.445a.5.5 0 0 0-.166-.371z" />
									</svg>
								</a>
							</div>
						</div>
					</div>
				</section>
			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->
</div>

<?php
get_footer();