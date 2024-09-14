<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<title>
		<?php
		if (is_front_page()) {
			echo 'UVM | Home';
		} elseif (is_single()) {
			echo 'UVM | ' . get_the_title();
		} elseif (is_page()) {
			echo 'UVM | ' . get_the_title();
		} elseif (is_category()) {
			echo 'UVM | Categoria: ' . single_cat_title('', false);
		} elseif (is_search()) {
			echo 'UVM | Ricerca: ' . get_search_query();
		} elseif (is_author()) {
			// Ottieni l'ID dell'autore corrente
			$author_id = get_queried_object_id();
			// Ottieni il nome dell'autore
			$author_name = get_the_author_meta('display_name', $author_id);
			echo 'UVM | ' . esc_html($author_name);
		} else {
			echo 'UVM | ' . get_bloginfo('name');
		}
		?>
	</title>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php wp_body_open(); ?>
	<div id="page" class="site main">
		<a class="skip-link screen-reader-text"
			href="#primary"><?php esc_html_e('Skip to content', 'universome'); ?></a>

		<header class="header">
			<div class="sticky-header">
				<!-- Ultima modifica su telefono -->
				<div class="mobile-last-modified">
					<span class="update-label">Ultimo aggiornamentoooooooooooo: </span>
					<span class="update-time">
						<?php echo get_last_modified_date(); ?>
					</span>
				</div>

				<!-- Riga superiore della navbar -->
				<div class="navbar-top">
					<div class="container">
						<!-- Mobile menu -->
						<button id="mobile-menu-button">
							<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
								xmlns="http://www.w3.org/2000/svg">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M4 6h16M4 12h16M4 18h16"></path>
							</svg>
						</button>
						<div class="navbar-bg"></div>
						<!-- Logo -->
						<div class="navbar-logo" id="logo">
							<a href="<?php echo home_url(); ?>">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/LOGO.png" alt="Logo">
							</a>
						</div>
						<button id="mobile-search-button">
							<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
								xmlns="http://www.w3.org/2000/svg">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M21 21l-4.35-4.35m2.65-5.65a7 7 0 1 1-14 0a7 7 0 0 1 14 0z"></path>
							</svg>
						</button>

						<!-- Contenitore per i nav-element -->
						<div class="nav-pill">
							<!-- Data e ora -->
							<div class="nav-element">
								<div class="nav-element-text">
									<?php echo "Data " . json_decode('"\u2022"') . " Ora" ?>
								</div>
								<div class="nav-element-subtext" id="current-date-time">
									<?php echo date('d/m/Y'); ?>
								</div>
							</div>
							<!-- Ultimo aggiornamento -->
							<div class="nav-element">
								<div class="nav-element-text">
									<?php echo "Ultimo Aggiornamento" ?>
								</div>
								<div class="nav-element-subtext" id="last-modified">
									<?php echo get_last_modified_date(); ?>
								</div>
							</div>

							<div class="nav-element" id="weather-element">
								<div class="nav-element-text">
									Meteo Messina
								</div>
								<div class="nav-element-subtext" id="weather-info">
									Caricamento...
								</div>
							</div>
						</div>

						<!-- Icone social -->
						<div class="social-icons">
							<!-- FACEBOOK -->
							<a href="https://www.facebook.com/UniVersoMessina" target="_blank">
								<svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
									viewBox="0 0 24 24">
									<path fill="currentColor"
										d="M8 6a6 6 0 0 1 6-6h5v6.5h-4v2h4.247L17.802 15H15v9H8v-9H4.25V8.5H8zm6-4a4 4 0 0 0-4 4v4.5H6.25V13H10v9h3v-9h3.198l.555-2.5H13v-4a2 2 0 0 1 2-2h2V2z" />
								</svg>
							</a>
							<!-- INSTAGRAM -->
							<a href="https://www.instagram.com/uvm_universome" target="_blank">
								<svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
									viewBox="0 0 24 24">
									<path fill="currentColor"
										d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4zm9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8A1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5a5 5 0 0 1-5 5a5 5 0 0 1-5-5a5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3" />
								</svg>
							</a>
							<!-- YOUTUBE -->
							<a href="https://www.youtube.com/@UniVersoMe-UniMe" target="_blank">
								<svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
									<g fill="none">
										<path
											d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
										<path fill="currentColor"
											d="M12 4c.855 0 1.732.022 2.582.058l1.004.048l.961.057l.9.061l.822.064a3.8 3.8 0 0 1 3.494 3.423l.04.425l.075.91c.07.943.122 1.971.122 2.954s-.052 2.011-.122 2.954l-.075.91l-.04.425a3.8 3.8 0 0 1-3.495 3.423l-.82.063l-.9.062l-.962.057l-1.004.048A62 62 0 0 1 12 20a62 62 0 0 1-2.582-.058l-1.004-.048l-.961-.057l-.9-.062l-.822-.063a3.8 3.8 0 0 1-3.494-3.423l-.04-.425l-.075-.91A41 41 0 0 1 2 12c0-.983.052-2.011.122-2.954l.075-.91l.04-.425A3.8 3.8 0 0 1 5.73 4.288l.821-.064l.9-.061l.962-.057l1.004-.048A62 62 0 0 1 12 4m0 2c-.825 0-1.674.022-2.5.056l-.978.047l-.939.055l-.882.06l-.808.063a1.8 1.8 0 0 0-1.666 1.623C4.11 9.113 4 10.618 4 12s.11 2.887.227 4.096c.085.872.777 1.55 1.666 1.623l.808.062l.882.06l.939.056l.978.047c.826.034 1.675.056 2.5.056s1.674-.022 2.5-.056l.978-.047l.939-.055l.882-.06l.808-.063a1.8 1.8 0 0 0 1.666-1.623C19.89 14.887 20 13.382 20 12s-.11-2.887-.227-4.096a1.8 1.8 0 0 0-1.666-1.623l-.808-.062l-.882-.06l-.939-.056l-.978-.047A61 61 0 0 0 12 6m-2 3.575a.6.6 0 0 1 .819-.559l.081.04l4.2 2.424a.6.6 0 0 1 .085.98l-.085.06l-4.2 2.425a.6.6 0 0 1-.894-.43l-.006-.09z" />
									</g>
								</svg>
							</a>
							<!-- SPOTIFY -->
							<a href="https://open.spotify.com/show/1J8nrLau2QtjbMjFodeotT" target="_blank">
								<svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
									viewBox="0 0 24 24">
									<g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
										stroke-width="1.5">
										<path d="M7 15s4.5-1 9 1m-9.5-4s6-1.5 11 1.5M6 9c3-.5 8-1 13 2" />
										<path d="M12 22.5a10.5 10.5 0 1 0 0-21a10.5 10.5 0 0 0 0 21Z" />
									</g>
								</svg>
							</a>
						</div>
					</div>
				</div>
			</div>

			<!-- Riga inferiore della navbar -->
			<div id="navbar-bottom" class="navbar-bottom">
				<div class="container">
					<div class="sticky-logo" style="display: none;">
						<a href="<?php echo home_url(); ?>">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/LOGO.png" alt="Logo">
						</a>
					</div>
					<nav class="categories-nav">
						<?php display_categories_with_subcategories(); ?>
					</nav>
					<!-- Icona di ricerca -->
					<button id="search-button">
						<span class="search-text">Cerca</span>
						<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
							xmlns="http://www.w3.org/2000/svg">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="M21 21l-4.35-4.35m2.65-5.65a7 7 0 1 1-14 0a7 7 0 0 1 14 0z"></path>
						</svg>
					</button>
				</div>
			</div>

			<!-- NAVBAR MOBILE -->
			<!-- Menu Mobile -->
			<div id="mobile-menu-overlay" class="mobile-menu-overlay"></div>
			<div id="mobile-menu" class="hidden">
				<!-- Header hamburger menu -->
				<div class="mobile-menu-header">
					<div class="mobile-logo">
						<a href="<?php echo home_url(); ?>">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/LOGO.png" alt="Logo">
						</a>
					</div>
					<span class="close-menu" id="close-menu">&times;</span>
				</div>

				<!-- Contenuto hamburger menu -->
				<div class="mobile-menu-content">
					<div class="mobile-menu-categories">
						<?php display_mobile_categories() ?>
					</div>
				</div>
				<!-- Footer hamburger menu -->
				<?php footer_menu_mobile() ?>
			</div>

			<!-- Ricerca Mobile -->
			<!-- Form di ricerca mobile (nascosto di default) -->
			<?php general_search(); ?>
		</header>
	</div>
	<?php wp_footer(); // Hook di WordPress per inserire script prima della chiusura del <body> ?>
</body>

</html>