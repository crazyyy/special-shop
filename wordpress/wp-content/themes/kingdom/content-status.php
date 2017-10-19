<?php
/**
 * The template for displaying posts in the Status post format
 */
?>
<div class="entry-header">
	<header>
		<?php echo get_avatar( get_the_author_meta( 'ID' ), $size = '64' ); ?>
		<span class="author"><?php the_author(); ?></span>
	</header>

	<div class="kingdom-entry-meta">
		<?php if ( is_singular() ) {
			echo '<a href="' . esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ) . '" title="' . the_title_attribute( 'echo=0' ) . '">' . get_the_date() . ' ' . __( 'at', 'kingdom' ) . ' ' . get_the_time() . '</a>';
		} else { ?>
			<a rel="bookmark" title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
				<span class="kingdom-entry-date"><?php printf( '%1$s ' . __( 'at', 'kingdom' ) . ' %2$s', get_the_date(), get_the_time() ); ?></span>
			</a>
		<?php } ?>
	</div><!-- .kingdom-entry-meta -->
</div><!-- .entry-header -->
<div class="kingdom-entry-content">
	<?php the_content( __( 'Continue reading', 'kingdom' ) . '<span class="meta-nav">&rarr;</span>' ); ?>
</div><!-- .kingdom-entry-content -->
<!-- navigation links for post -->
<div class="kingdom-post-nav-link"><?php wp_link_pages(); ?> </div>
