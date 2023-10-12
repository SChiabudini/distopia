<?php
/**
 * Search for the full screen mobile style.
 *
 * @package WooVina WordPress theme
 */

// Exit if accessed directly
if(! defined('ABSPATH')) {
	exit;
}

if('fullscreen' != woovina_mobile_menu_style()) {
	return;
}

// Post type
$post_type = get_theme_mod('woovina_menu_search_source', 'any'); ?>

<div id="mobile-search" class="clr">
	<form method="get" action="<?php echo esc_url(home_url('/')); ?>" class="header-searchform">
		<input type="search" name="s" value="" autocomplete="off" />
		<?php
		// If the headerSearchForm script is not disable
		if(WOOVINA_EXTRA_ACTIVE
			&& class_exists('WooVina_Extra_Scripts_Panel')
			&& WooVina_Extra_Scripts_Panel::get_setting('we_headerSearchForm_script')) { ?>
			<label><?php esc_html_e('Type your search', 'woovina'); ?><span><i></i><i></i><i></i></span></label>
		<?php
		} ?>
		<?php if('any' != $post_type) { ?>
			<input type="hidden" name="post_type" value="<?php echo esc_attr($post_type); ?>">
		<?php } ?>
	</form>
</div>