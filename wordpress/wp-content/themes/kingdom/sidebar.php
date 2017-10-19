<?php
/**
 * The sidebar containing the main widget area.
 *
 * If no active widgets in sidebar, let's create few default.
 */
?>
<div id="sidebar" class="sidebar">
	<?php if ( is_active_sidebar( 'primary-widget-area' ) ) {
		dynamic_sidebar( 'primary-widget-area' );
	} else {
		$args = array(
			'before_widget' => '<aside class="widget-container %s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		);
		/* default widgets */
		the_widget( 'WP_Widget_Search', false, $args );
		the_widget( 'WP_Widget_Recent_Posts', false, $args );
		the_widget( 'WP_Widget_Recent_Comments', false, $args );
		the_widget( 'WP_Widget_Archives', false, $args );
		the_widget( 'WP_Widget_Categories', false, $args );
	} ?>
</div>
