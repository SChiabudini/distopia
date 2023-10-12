<?php
/**
 * Site header search header replace
 *
 * @package WooVina WordPress theme
 */

// Exit if accessed directly
if(! defined('ABSPATH')) {
	exit;
}

// Post type
$post_type = get_theme_mod('woovina_menu_search_source', 'any'); ?>

<div id="searchform-header-replace" class="header-searchform-wrap clr">
	<form method="get" action="<?php echo esc_url(home_url('/')); ?>" class="header-searchform">
		
		<?php
			if('product' == $post_type) {
				wp_dropdown_categories(array(
					'show_option_all'	=> esc_attr__('Select category', 'woovina'),
					'taxonomy'			=> 'product_cat',
					'orderby'			=> 'name',
					'name'				=> 'product_cat',
					'selected'			=> isset($_GET['product_cat']) ? $_GET['product_cat'] : false,
					'value_field'		=> 'slug',
				));
			}
		?>
		
		<input type="search" name="s" autocomplete="off" value="" placeholder="<?php echo esc_html_e('Type then hit enter to search...', 'woovina'); ?>" />
		<?php if('any' != $post_type) { ?>
			<input type="hidden" name="post_type" value="<?php echo esc_attr($post_type); ?>">
		<?php } ?>
	</form>
	<span id="searchform-header-replace-close" class="icon-close"></span>
</div><!-- #searchform-header-replace -->