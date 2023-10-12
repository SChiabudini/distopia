<?php
/**
 * Mobile nav template part.
 *
 * @package WooVina WordPress theme
 */

// Exit if accessed directly
if(! defined('ABSPATH')) {
	exit;
}

// Menu Location
$menu_location 	= apply_filters('woovina_mobile_menu_location', 'mobile_menu');
$menu_locations = get_nav_menu_locations();
$menu_object 	= (isset($menu_locations[$menu_location]) ? wp_get_nav_menu_object($menu_locations[$menu_location]) : null);
$menu_name 		= (isset($menu_object->name) ? $menu_object->name : '');

// Menu arguments
$menu_args = array(
	'theme_location' => $menu_location,
	'container'      => false,
	'fallback_cb'    => false,
);

// Categories menu arguments
$categories_localtion = apply_filters('woovina_mobile_categories_location', 'mobile_categories');
$categories_locations = get_nav_menu_locations();
$categories_object 	  = (isset($categories_locations[$categories_localtion]) ? wp_get_nav_menu_object($categories_locations[$categories_localtion]) : null);
$categories_name 	  = (isset($categories_object->name) ? $categories_object->name : '');

// Categories arguments
$categories_args = array(
	'theme_location' => 'mobile_categories',
	'container'      => false,
	'fallback_cb'    => false,
	'menu_class'	 => 'mobile-menu dropdown-menu',
);

// If sidebar mobile menu style
if('sidebar' == woovina_mobile_menu_style()) {
	$menu_args['menu_class']  = 'mobile-menu dropdown-menu';
}

// Display menu if defined
if(has_nav_menu($menu_location) && has_nav_menu($categories_localtion) && 'sidebar' == woovina_mobile_menu_style()) : ?>

	<div id="mobile-nav" class="navigation clr">
		
		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#sidr-id-mobile-mainmenu"><?php echo esc_html($menu_name); ?></a></li>
			<li><a data-toggle="tab" href="#sidr-id-mobile-categories"><?php echo esc_html($categories_name); ?></a></li>
		</ul>
		
		<div class="tab-content">
			<div id="mobile-mainmenu" class="tab-pane active">
				<?php wp_nav_menu($menu_args); ?>
			</div>
			
			<div id="mobile-categories" class="tab-pane">
				<?php wp_nav_menu($categories_args); ?>
			</div>
		</div>
		
	</div>

<?php else: ?>

	<div id="mobile-nav" class="navigation clr">
		<?php wp_nav_menu($menu_args); ?>
	</div>
	
<?php endif; ?>