<?php
/**
 * The default template for displaying post meta.
 *
 * @package WooVina WordPress theme
 */

// Exit if accessed directly
if(! defined('ABSPATH')) {
	exit;
}

if('post' == get_post_type()) { ?>

	<div class="blog-entry-comments clr">
		<i class="icon-bubble"></i><?php comments_popup_link(esc_html__('0 Comments', 'woovina'), esc_html__('1 Comment',  'woovina'), esc_html__('% Comments', 'woovina'), 'comments-link'); ?>
	</div>
	
<?php } ?>