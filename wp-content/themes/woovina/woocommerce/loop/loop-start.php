<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     9999
 */

global $product, $woocommerce_loop;
 
// Classes
$wrap_classes = array('products', 'woovina-row', 'clr');

// List/grid style
if((woovina_is_woo_shop() || woovina_is_woo_tax())
	&& get_theme_mod('woovina_woo_grid_list', true)
	&& 'list' == get_theme_mod('woovina_woo_catalog_view', 'grid')) {
	$wrap_classes[] = 'list';
} else {
	$desktop_columns = $woocommerce_loop['columns'];	
	$wrap_classes[] = 'grid';
	$wrap_classes[] = 'desktop-' . $desktop_columns . '-col';	
}

// Responsive columns
$tablet_columns    = get_theme_mod('woovina_woocommerce_tablet_shop_columns');
$mobile_columns    = get_theme_mod('woovina_woocommerce_mobile_shop_columns');

if(! empty($tablet_columns)) {
	$wrap_classes[] = 'tablet-col';
	$wrap_classes[] = 'tablet-' . $tablet_columns . '-col';
}
if(! empty($mobile_columns)) {
	$wrap_classes[] = 'mobile-col';
	$wrap_classes[] = 'mobile-' . $mobile_columns . '-col';
}

// If infinite scroll
if('infinite_scroll' == get_theme_mod('woovina_woo_pagination_style', 'standard')) {
	$wrap_classes[] = 'infinite-scroll-wrap';
}

$wrap_classes = implode(' ', $wrap_classes); ?>

<ul class="<?php echo esc_attr($wrap_classes); ?>">