<?php
/**
 * The template for displaying 500 pages in PWA.
 *
 * @package WooVina WordPress theme
 * @since   4.7.5
 */

pwa_get_header( 'pwa' );

do_action( 'woovina_do_server_error' );

pwa_get_footer( 'pwa' );
