<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package WooVina WordPress theme
 */

// Retunr if full width or full screen
if(in_array(woovina_post_layout(), array('full-screen', 'full-width'))) {
	return;
} ?>

<?php do_action('woovina_before_sidebar'); ?>

<aside id="right-sidebar" class="sidebar-container widget-area sidebar-primary"<?php woovina_schema_markup('sidebar'); ?>>

	<?php do_action('woovina_before_sidebar_inner'); ?>

	<div id="right-sidebar-inner" class="clr">

		<?php
		if($sidebar = woovina_get_sidebar()) {
			dynamic_sidebar($sidebar);
		} ?>

	</div><!-- #sidebar-inner -->

	<?php do_action('woovina_after_sidebar_inner'); ?>

</aside><!-- #right-sidebar -->

<?php do_action('woovina_after_sidebar'); ?>