<?php
/**
 * Header Logo
 *
 * @package WooVina WordPress theme
 */

// Exit if accessed directly
if(! defined('ABSPATH')) {
	exit;
}

// Vars
$retina_logo 		= woovina_header_retina_logo_setting();
$full_screen_logo 	= get_theme_mod('woovina_full_screen_header_logo');
$responsive_logo 	= get_theme_mod('woovina_responsive_logo'); ?>

<?php do_action('woovina_before_logo'); ?>

<div id="site-logo" class="<?php echo esc_attr(woovina_header_logo_classes()); ?>"<?php woovina_schema_markup('logo'); ?>>

	<?php do_action('woovina_before_logo_inner'); ?>

	<div id="site-logo-inner" class="clr">

		<?php
		// Custom site-wide image logo
		if(function_exists('the_custom_logo') && has_custom_logo()) {

			do_action('woovina_before_logo_img');

			// Add srcset attr
			if($retina_logo) {
				add_filter('wp_get_attachment_image_attributes', 'woovina_header_retina_logo', 10, 3);
			}

			// Default logo
			the_custom_logo();

			// Remove filter to only add the srcset attr to the logo
			if($retina_logo) {
				remove_filter('wp_get_attachment_image_attributes', 'woovina_header_retina_logo', 10);
			}

			// Full screen logo
			if($full_screen_logo) {
				woovina_custom_full_screen_logo();
			}

			// Responsive logo
			if($responsive_logo) {
				woovina_custom_responsive_logo();
			}

			do_action('woovina_after_logo_img');

		} else { ?>

			<a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="site-title site-logo-text"><?php echo esc_html(get_bloginfo('name')); ?></a>

		<?php } ?>

	</div><!-- #site-logo-inner -->

	<?php do_action('woovina_after_logo_inner'); ?>

	<?php
	// Site description
	if('top' == woovina_header_style()
		&& '' != get_bloginfo('description')) { ?>
		<div id="site-description"><h2><?php echo bloginfo('description'); ?></h2></div>
	<?php } ?>

</div><!-- #site-logo -->

<?php do_action('woovina_after_logo'); ?>