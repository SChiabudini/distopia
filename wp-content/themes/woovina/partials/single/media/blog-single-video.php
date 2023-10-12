<?php
/**
 * Blog single video format media
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
}

// Get post video
$video = woovina_get_post_video_html();

// Display video if one exists and it's not a password protected post
if($video && ! post_password_required()) : ?>

	<div id="post-media" class="thumbnail clr">

		<div class="blog-post-video">

			<?php echo wp_kses_post($video); ?>

		</div><!-- .blog-post-video -->

	</div><!-- #post-media -->

<?php
// Else display post thumbnail
else : ?>

	<?php get_template_part('partials/single/media/blog-single'); ?>

<?php endif; ?>