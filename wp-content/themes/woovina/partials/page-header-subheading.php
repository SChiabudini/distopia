<?php
/**
 * The template for displaying the page subheading
 *
 * @package WooVina WordPress theme
 */

// Exit if accessed directly
if(! defined('ABSPATH')) {
	exit;
}

// Display subheading if there is one
if($subheading = woovina_get_page_subheading()) : ?>

	<div class="clr page-subheading">
		<?php echo woovina_shortcode($subheading); ?>
	</div><!-- .page-subheading -->

<?php endif; ?>