<?php
/**
 * The Header for our theme.
 *
 * @package WooVina WordPress theme
 */ ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?><?php woovina_schema_markup('html'); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	
	<?php wp_body_open(); ?>
	
	<?php do_action('woovina_before_outer_wrap'); ?>

	<div id="outer-wrap" class="site clr">

		<?php do_action('woovina_before_wrap'); ?>

		<div id="wrap" class="clr">

			<?php
			// Elementor `header` location
			if(! function_exists('elementor_theme_do_location') || ! elementor_theme_do_location('header')) { ?>
			
				<?php do_action('woovina_top_bar'); ?>

				<?php do_action('woovina_header'); ?>

			<?php } ?>

			<?php do_action('woovina_before_main'); ?>
			
			<main id="main" class="site-main clr"<?php woovina_schema_markup('main'); ?>>

				<?php do_action('woovina_page_header'); ?>