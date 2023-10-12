<?php
/**
 * Outputs page article
 *
 * @package WooVina WordPress theme
 */

// Exit if accessed directly
if(! defined('ABSPATH')) {
    exit;
} ?>

<div class="entry clr"<?php woovina_schema_markup('entry_content'); ?>>
	<?php do_action('woovina_before_page_entry'); ?>
	<?php the_content();

	wp_link_pages(array(
		'before' => '<div class="page-links">' . __('Pages:', 'woovina'),
		'after'  => '</div>',
	)); ?>
	<?php do_action('woovina_after_page_entry'); ?>
</div>