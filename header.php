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
						<div class="update-info">
							<span class="desktop-update-label">Ultimo aggiornamento: </span>
							<span class="desktop-update-time">
								<?php echo get_last_modified_date(); ?>
							</span>
						</div>

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
						<div class="mobile-navbar-logo" id="logo">
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
					</div>
				</div>

			</div>

			<!-- Riga inferiore della navbar -->
			<div id="navbar-bottom" class="navbar-bottom">
				<div class="container">
					<div class="navbar-logo">
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