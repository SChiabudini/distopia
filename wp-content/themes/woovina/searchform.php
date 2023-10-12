<?php
/**
 * The template for displaying search forms.
 *
 * @package WooVina WordPress theme
 */

// Exit if accessed directly
if(! defined('ABSPATH')) {
	exit;
}

// Post type
$post_type = get_theme_mod('woovina_menu_search_source', 'any'); ?>

<form method="get" class="searchform" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
	
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
	
	<input type="text" class="field" name="s" id="s" placeholder="<?php esc_html_e('Search', 'woovina'); ?>">
	<?php if('any' != $post_type) { ?>
		<input type="hidden" name="post_type" value="<?php echo esc_attr($post_type); ?>">
	<?php } ?>
</form>