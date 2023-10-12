<?php
/**
 * Blog single quote format
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

<div class="post-quote-wrap">

	<div class="post-quote-content">

		<?php echo wp_kses_post(get_post_meta(get_the_ID(), 'woovina_quote_format', true)); ?>

		<span class="post-quote-icon icon-speech"></span>

	</div>

	<div class="post-quote-author"><?php the_title(); ?></div>
	
</div>