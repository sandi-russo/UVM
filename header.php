<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package UNIVERSOME
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text"
			href="#primary"><?php esc_html_e('Skip to content', 'universome'); ?></a>

		    <header class="bg-gray-800 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <?php if (function_exists('the_custom_logo')): ?>
                    <div class="custom-logo">
                        <?php the_custom_logo(); ?>
                    </div>
                <?php endif; ?>
                <div id="current-date-time" class="hidden md:block">
                    <?php echo date('d/m/Y'); ?>
                </div>
            </div>
            <nav class="mt-4 md:mt-0">
                <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'flex space-x-4')); ?>
            </nav>
            <div class="mt-4 md:mt-0">
                <?php get_search_form(); ?>
            </div>
        </div>
    </header>
    <div class="container mx-auto mt-4">