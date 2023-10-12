<?php
/**
 * After Container template.
 *
 * @package WooVina WordPress theme
 */

if(! defined('ABSPATH')) {
	exit; // Exit if accessed directly
} ?>

<?php do_action('woovina_before_content_wrap'); ?>

<div id="content-wrap" class="container clr">

	<?php do_action('woovina_before_primary'); ?>

	<div id="primary" class="content-area clr">

		<?php do_action('woovina_before_content'); ?>

		<div id="content" class="clr site-content">

			<?php do_action('woovina_before_content_inner'); ?>

			<article class="entry-content entry clr">