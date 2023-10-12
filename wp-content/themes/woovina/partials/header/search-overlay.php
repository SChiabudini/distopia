<?php
/**
 * Site header search overlay
 *
 * @package WooVina WordPress theme
 */

// Exit if accessed directly
if(! defined('ABSPATH')) {
	exit;
}

// Post type
$post_type = get_theme_mod('woovina_menu_search_source', 'any'); ?>

<div id="searchform-overlay" class="header-searchform-wrap clr">
	<div class="container clr">
		<form method="get" action="<?php echo esc_url(home_url('/')); ?>" class="header-searchform">
			<a href="javascript:void(0)" class="search-overlay-close"><span></span></a>
			
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
			
			<input class="searchform-overlay-input" type="search" name="s" autocomplete="off" value="" />
			<label><?php echo esc_html_e('Type your text and hit enter to search', 'woovina'); ?><span><i></i><i></i><i></i></span></label>
			<?php if('any' != $post_type) { ?>
				<input type="hidden" name="post_type" value="<?php echo esc_attr($post_type); ?>">
			<?php } ?>
		</form>
	</div>
</div><!-- #searchform-overlay -->