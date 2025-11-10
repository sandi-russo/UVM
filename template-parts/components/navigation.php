<?php
/**
 * Header Navigation Component (v4.1 - Dropdown Submenus Commented & Corrected Overlays)
 */
?>

<header class="site-header">
    <div class="top-banner">
        <div class="container">
            <span class="banner-text">
                Ultima modifica:
                <?php
                $recent_posts = wp_get_recent_posts( [ 'numberposts' => 1 ] );
                if ( ! empty( $recent_posts ) ) {
                    $post_date = get_the_time( 'j F Y', $recent_posts[0]['ID'] );
                    $post_time = get_the_time( 'H:i', $recent_posts[0]['ID'] );
                    echo $post_date . ' - ' . $post_time;
                } else {
                    echo "Nessun articolo recente";
                }
                ?>
            </span>
        </div>
    </div>
</header>

<nav class="main-navigation">
    <div class="container nav-container">

        <button class="mobile-toggle" aria-label="Apri menu">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </button>

        <div class="nav-logo">
            <?php
            $logo_svg_path = get_template_directory() . '/assets/images/logo.svg';
            $logo_svg_uri  = get_template_directory_uri() . '/assets/images/logo.svg';

            if ( file_exists( $logo_svg_path ) ) {
                echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="custom-logo-link">';
                echo '<img src="' . esc_url( $logo_svg_uri ) . '" alt="' . get_bloginfo( 'name' ) . '">';
                echo '</a>';
            } elseif ( has_custom_logo() ) {
                the_custom_logo();
            } else {
                echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="logo-text">' . get_bloginfo( 'name' ) . '</a>';
            }
            ?>
        </div>

        <div class="nav-menu-wrapper">
            <?php
            $excluded_categories = [ 'evidenza', 'ipse dixit', 'redazione universome' ];
            $categories          = get_categories( [ 'parent' => 0, 'hide_empty' => true ] );
            if ( $categories ) :
                ?>
                <ul class="nav-menu">
                    <?php
                    foreach ( $categories as $category ) :
                        if ( in_array( strtolower( $category->name ), $excluded_categories ) ) {
                            continue;
                        }

                        /* --- INIZIO LOGICA SOTTOMENU COMMENTATA ---
                        $child_categories = get_categories( [ 'parent' => $category->term_id, 'hide_empty' => true ] );
                        $has_children     = ! empty( $child_categories );
                        $li_class         = $has_children ? ' class="menu-item-has-children"' : '';
                        --- FINE LOGICA SOTTOMENU COMMENTATA --- */
                        ?>

                        <li<?php /* echo $li_class; */ ?>> <?php // Rimuoviamo la classe dal <li> ?>
                            <a href="<?php echo get_category_link( $category->term_id ); ?>">
                                <?php echo esc_html( $category->name ); ?>

                                <?php /* --- INIZIO FRECCIA COMMENTATA ---
                                <?php if ( $has_children ) : ?>
                                    <svg class="arrow-down" width="12" height="12" viewBox="0 0 24 24" fill="none"
                                         stroke="currentColor" stroke-width="2">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                <?php endif; ?>
                                --- FINE FRECCIA COMMENTATA --- */ ?>
                            </a>

                            <?php /* --- INIZIO SOTTOMENU COMMENTATO ---
                            <?php if ( $has_children ) : ?>
                                <ul class="sub-menu">
                                    <?php foreach ( $child_categories as $child ) : ?>
                                        <li>
                                            <a href="<?php echo get_category_link( $child->term_id ); ?>">
                                                <span><?php echo esc_html( $child->name ); ?></span>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                            --- FINE SOTTOMENU COMMENTATO --- */ ?>
                        </li>

                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>

        <button class="search-toggle" aria-label="Apri ricerca">
            <span class="search-toggle-text">Cerca</span>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"/>
                <path d="m21 21-4.3-4.3"/>
            </svg>
        </button>

    </div>
</nav>


<div class="search-overlay">
    <div class="search-container">
        <header class="overlay-header">
            <div class="overlay-logo">
                <?php
                $logo_svg_uri = get_template_directory_uri() . '/assets/images/logo.svg';
                echo '<img src="' . esc_url( $logo_svg_uri ) . '" alt="' . get_bloginfo( 'name' ) . '">';
                ?>
            </div>
            <button class="search-close" aria-label="Chiudi ricerca">&times;</button>
        </header>
        <div class="overlay-content">
            <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="search-form">
                <input type="search" placeholder="Cosa stai cercando?" name="s" autocomplete="off">
                <button type="submit" aria-label="Esegui ricerca">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </button>
            </form>
            <div class="live-results"></div>
        </div>
        <footer class="overlay-footer">
            <a href="<?php echo esc_url( admin_url() ); ?>" class="admin-link">Accesso</a>
        </footer>
    </div>
</div>

<div class="mobile-nav-overlay">
    <div class="mobile-nav-panel">
        <header class="overlay-header">
            <div class="overlay-logo">
                <?php
                $logo_svg_uri = get_template_directory_uri() . '/assets/images/logo.svg';
                echo '<img src="' . esc_url( $logo_svg_uri ) . '" alt="' . get_bloginfo( 'name' ) . '">';
                ?>
            </div>
            <button class="mobile-nav-close" aria-label="Chiudi menu">&times;</button>
        </header>
        <div class="overlay-content">
            <nav class="mobile-menu">
                <?php
                // Menu mobile semplificato (solo categorie principali)
                $excluded_categories = [ 'evidenza', 'ipse dixit', 'redazione universome' ];
                $categories          = get_categories( [ 'parent' => 0, 'hide_empty' => true ] );
                if ( $categories ) :
                    echo '<ul class="mobile-menu-list">';
                    foreach ( $categories as $category ) :
                        if ( in_array( strtolower( $category->name ), $excluded_categories ) ) {
                            continue;
                        }
                        echo '<li><a href="' . get_category_link( $category->term_id ) . '">' . esc_html( $category->name ) . '</a></li>';
                    endforeach;
                    echo '</ul>';
                endif;
                ?>
            </nav>
        </div>
        <footer class="overlay-footer">
            <a href="<?php echo esc_url( admin_url() ); ?>" class="admin-link">Accesso</a>
        </footer>
    </div>
</div>