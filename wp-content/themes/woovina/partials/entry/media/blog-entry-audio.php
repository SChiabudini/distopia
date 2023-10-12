<?php
/**
 * Blog entry audio format media
 *
 * @package WooVina WordPress theme
 */

// Exit if accessed directly
if(! defined('ABSPATH')) {
	exit;
}

// Return if WooVina Extra is not active
if(! WOOVINA_EXTRA_ACTIVE) {
	return;
} ?>

<?php $audio = woovina_get_post_audio_html(); ?>

<?php if($audio) : ?>
	
	<div class="thumbnail"><?php echo wp_kses_post($audio); ?></div>

<?php
// Else display post thumbnail
else : ?>

	<?php get_template_part('partials/entry/media/blog-entry'); ?>

<?php endif; ?>