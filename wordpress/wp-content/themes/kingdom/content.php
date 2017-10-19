<?php
/**
 * The default template for displaying content.
 */ ?>
<!-- content -->
<h2 class="kingdom-entry-title">
	<?php if ( is_singular() ) {
		the_title();
	} else { ?>
		<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'kingdom' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
	<?php } ?>
</h2><!-- .kingdom-entry-title -->
<?php if ( ! is_page() ) { ?>
	<div class="kingdom-entry-meta">
		<span class="meta-prep meta-prep-author"><?php _e( 'Posted on', 'kingdom' ); ?></span>
		<?php if ( is_singular() ) { ?>
			<a href="<?php echo esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ); ?>" title="<?php the_title_attribute(); ?>"><?php echo get_the_date(); ?></a>
		<?php } else { ?>
			<a rel="bookmark" title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><span class="kingdom-entry-date"><?php echo get_the_date(); ?></span></a>
		<?php }
		if ( has_category() ) { ?>
			<span class="kingdom-meta-sep"><?php _e( 'in', 'kingdom' ); ?></span>
			<span class="kingdom-cat-list"><?php the_category( ', ' ); ?></span>
		<?php } ?>
	</div><!-- .kingdom-entry-meta -->
<?php } ?>
<article class="kingdom-entry-content">
	<?php /* image for the post format */
	if ( wp_attachment_is_image( $post->ID ) ) { ?>
		<nav id="kingdom-image-navigation" class="navigation" role="navigation">
			<span class="kingdom-previous-image"><?php previous_image_link( false, __( '&larr; Previous', 'kingdom' ) ); ?></span>
			<span class="kingdom-next-image"><?php next_image_link( false, __( 'Next &rarr;', 'kingdom' ) ); ?></span>
			<div class="clear"></div>
		</nav><!-- #kingdom-image-navigation -->
		<?php
		/**
		 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
		 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
		 */
		$attachments = array_values( get_children( array(
			'post_parent'    => $post->post_parent,
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => 'ASC',
			'orderby'        => 'menu_order ID',
		) ) );
		foreach ( $attachments as $k => $attachment ) {
			if ( $attachment->ID == $post->ID ) {
				break;
			}
		}
		$k ++;
		/* If there is more than 1 attachment in a gallery */
		if ( 1 < count( $attachments ) ) {
			if ( isset( $attachments[ $k ] ) ) { /* get the URL of the next image attachment */
				$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
			} else /* or get the URL of the first image attachment */ {
				$next_attachment_url = get_attachment_link( $attachments[0]->ID );
			}
		} else {
			/* or, if there's only 1 image, get the URL of the image */
			$next_attachment_url = wp_get_attachment_url();
		} ?>
		<div class="attachment_img">
			<a href="<?php echo esc_url( $next_attachment_url ); ?>#articles" rel="attachment">
				<?php echo wp_get_attachment_image( $post->ID, 'full' ); ?>
			</a>
		</div><!-- .attachment_img -->
		<?php the_excerpt(); ?>
		<small class="kingdom-top-link">
			<a href="<?php echo get_permalink( $post->post_parent ); ?>"><?php _e( '[Back to the Gallery]', 'kingdom' ); ?></a>
		</small>
	<?php } else {
		the_content();
	} ?>
</article><!-- .kingdom-entry-content -->
<!-- navigation links for post -->
<div class="kingdom-post-nav-link"><?php wp_link_pages(); ?> </div>
<?php if ( has_tag() ) { ?>
	<div class="kingdom-entry-utility"><span class="tag-links"><?php the_tags( '' ); ?></span></div>
<?php }
