<?php
/**
 * The left sidebar containing the widget area.
 *
 * @package WooVina WordPress theme
 */ ?>

<?php do_action('woovina_before_sidebar'); ?>

<aside id="left-sidebar" class="sidebar-container widget-area sidebar-secondary"<?php woovina_schema_markup('sidebar'); ?>>

	<?php do_action('woovina_before_sidebar_inner'); ?>

	<div id="left-sidebar-inner" class="clr">

		<?php
		if($sidebar = woovina_get_second_sidebar()) {
			dynamic_sidebar($sidebar);
		} ?>

	</div><!-- #sidebar-inner -->

	<?php do_action('woovina_after_sidebar_inner'); ?>

</aside><!-- #sidebar -->

<?php do_action('woovina_after_sidebar'); ?>