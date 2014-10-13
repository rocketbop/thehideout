<?php
/**
 * The sidebar containing the main widget area for the home page.
 *
 * @package Hideout
 */

if ( ! is_active_sidebar( 'sidebar-home' ) ) {
	return;
}
?>

<div id="sidebar" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-home' ); ?>
</div><!-- #secondary -->
