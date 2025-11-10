<?php
/**
 * The main template file for the UniVersoMe theme.
 */

get_header();

?>

	<div class="main-content-area container layout-<?php echo esc_attr( uvm_get_layout_template() ); ?>">

		<main class="main-content">

			<header class="page-header">
				<h1 class="page-title">
					<?php
					if ( is_home() && is_front_page() ) {
						echo 'Articoli Recenti';
					} elseif ( is_archive() ) {
						the_archive_title();
					} elseif ( is_search() ) {
						printf( 'Risultati per: %s', '<span>' . get_search_query() . '</span>' );
					} else {
						echo 'Blog';
					}
					?>
				</h1>
			</header>

			<?php
			if ( have_posts() ) :
				echo '<div class="article-grid">'; // Usa la stessa griglia della homepage
				while ( have_posts() ) :
					the_post();
					get_template_part('template-parts/components/card-post');
				endwhile;
				echo '</div>';

				the_posts_navigation();
			else :
				echo '<p>Nessun articolo trovato.</p>';
			endif;
			?>

		</main>

		<?php
		if ( uvm_get_layout_template() === 'with-sidebar' ) {
			get_sidebar();
		}
		?>

	</div>

<?php
get_footer();