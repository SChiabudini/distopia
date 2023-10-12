<?php
/**
 * The Header for our theme in PWA.
 *
 * @package WooVina WordPress theme
 * @since   4.7.5
 */

?>
<!DOCTYPE html>
<html class="<?php echo esc_attr( woovina_html_classes() ); ?>" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php woovina_schema_markup( 'html' ); ?>>
