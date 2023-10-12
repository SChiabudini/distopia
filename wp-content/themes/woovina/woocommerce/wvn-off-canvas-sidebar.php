<?php
/**
 * Off Canvas sidebar template.
 *
 * @package WooVina WordPress theme
 */

if(! defined('ABSPATH')) {
	exit; // Exit if accessed directly
} ?>

<div id="woovina-off-canvas-sidebar-wrap">
	<div class="woovina-off-canvas-sidebar">
		<?php dynamic_sidebar('wvn_off_canvas_sidebar'); ?>
	</div>
	<div class="woovina-off-canvas-overlay"></div>
</div>