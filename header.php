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
					<span class="update-label">Ultimo aggiornamento: </span>
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
							<a href="https://www.facebook.com/UniVersoMessina">
								<svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
									viewBox="0 0 24 24">
									<path fill="currentColor"
										d="M8 6a6 6 0 0 1 6-6h5v6.5h-4v2h4.247L17.802 15H15v9H8v-9H4.25V8.5H8zm6-4a4 4 0 0 0-4 4v4.5H6.25V13H10v9h3v-9h3.198l.555-2.5H13v-4a2 2 0 0 1 2-2h2V2z" />
								</svg>
							</a>
							<a href="https://www.instagram.com/uvm_universome">
								<svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
									viewBox="0 0 24 24">
									<path fill="currentColor"
										d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4zm9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8A1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5a5 5 0 0 1-5 5a5 5 0 0 1-5-5a5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3" />
								</svg>
							</a>
							<a href="https://twitter.com/universomessina">
								<svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
									viewBox="0 0 16 16">
									<path fill="currentColor"
										d="M9.294 6.928L14.357 1h-1.2L8.762 6.147L5.25 1H1.2l5.31 7.784L1.2 15h1.2l4.642-5.436L10.751 15h4.05zM7.651 8.852l-.538-.775L2.832 1.91h1.843l3.454 4.977l.538.775l4.491 6.47h-1.843z" />
								</svg>
							</a>
							<a href="https://open.spotify.com/show/1J8nrLau2QtjbMjFodeotT">
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