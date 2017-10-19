<?php
/**
 * The template for displaying posts in the Link post format
 */
?>
<h3 class="kingdom-entry-title pf-title"><?php _e( 'Link', 'kingdom' ); ?></h3>
<div class="kingdom-entry-content">
	<?php the_content( __( 'Continue reading', 'kingdom' ) . '<span class="meta-nav">&rarr;</span>' ); ?>
</div><!-- .kingdom-entry-content -->
<div class="kingdom-entry-meta">
	<span class="meta-prep meta-prep-author"><?php _e( 'Posted on', 'kingdom' ); ?></span>
	<?php if ( is_singular() ) {
		echo '<a href="' . esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ) . '" title="' . the_title_attribute( 'echo=0' ) . '">' . get_the_date() . '</a>';
	} else { ?>
		<a rel="bookmark" title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><span class="kingdom-entry-date"><?php echo get_the_date(); ?></span></a>
	<?php }
	if ( has_category() ) { ?>
		<span class="kingdom-meta-sep"><?php _e( 'in', 'kingdom' ); ?></span>
		<span class="kingdom-cat-list"><?php the_category( ', ' ); ?></span>
	<?php } ?>
</div><!-- .kingdom-entry-meta -->
<!-- navigation links for post -->
<div class="kingdom-post-nav-link"><?php wp_link_pages(); ?> </div>
