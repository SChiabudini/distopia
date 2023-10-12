<?php
/**
 * Search Form for The Medium Header Style
 *
 * @package WooVina WordPress theme
 */

// Exit if accessed directly
if(! defined('ABSPATH')) {
	exit;
}

// Post type
$post_type = get_theme_mod('woovina_menu_search_source', 'any'); ?>

<div id="medium-searchform" class="header-searchform-wrap clr">
	<form method="get" action="<?php echo esc_url(home_url('/')); ?>" class="header-searchform">
		<input type="search" name="s" autocomplete="off" value="" />
		<?php
		// If the headerSearchForm script is not disable
		if(WOOVINA_EXTRA_ACTIVE
			&& class_exists('WooVina_Extra_Scripts_Panel')
			&& WooVina_Extra_Scripts_Panel::get_setting('we_headerSearchForm_script')) { ?>
			<label><?php echo esc_html_e('Search...', 'woovina'); ?></label>
		<?php } ?>
		<button class="search-submit"><i class="icon-magnifier"></i></button>
		<div class="search-bg"></div>
		<?php if('any' != $post_type) { ?>
			<input type="hidden" name="post_type" value="<?php echo esc_attr($post_type); ?>">
		<?php } ?>
	</form>
</div><!-- #medium-searchform -->