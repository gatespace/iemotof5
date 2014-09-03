<?php
/**
 * The sidebar containing the main widget areas.
 *
 * @package Iemoto Foundation 5
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area large-4 medium-4 small-12 columns" role="complementary">
	<?php do_action( 'iemotof5_before_secondary' ); ?>
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
	<?php do_action( 'iemotof5_after_secondary' ); ?>
</div><!-- #secondary -->
