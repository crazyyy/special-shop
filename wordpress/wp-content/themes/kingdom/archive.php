<?php
/**
 * The template for displaying Archive pages.
 */

get_header();
/* sidebar */
get_sidebar(); ?>
<!-- posts -->
<div id="articles" class="articles" role="main">
	<!-- archives title -->
	<section class="post meta-title">
		<div class="kingdom-entry-body">
			<h2 class="kingdom-entry-title">
				<?php the_archive_title(); ?>
			</h2>
		</div>
	</section>
	<?php $post_counter = 0;
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post(); ?>
			<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<!-- thumbnail -->
				<?php $post_id = get_the_ID();
				$format        = get_post_format( $post_id );
				if ( false === strstr( 'aside image link status quote', $format ) ) {
					do_action( 'kingdom_thumbnail_display', $post_id );
				} ?>
				<div class="kingdom-entry-body">
					<?php get_template_part( 'content', $format );
					if ( $post_counter > 0 ) { ?>
						<small class="kingdom-top-link"><a href="#page"><?php _e( '[Top]', 'kingdom' ); ?></a></small>
					<?php }
					$post_counter ++; ?>
					<div class="clear"></div>
				</div><!-- .kingdom-entry-body -->
			</section><!-- #post -->
		<?php } ?>
		<!-- navigation links for posts -->
		<nav id="kingdom-posts-nav-below">
			<div class="kingdom-nav-previous"><?php next_posts_link( __( '&larr; Older Posts', 'kingdom' ) ); ?></div>
			<div class="kingdom-nav-next"><?php previous_posts_link( __( 'Newer Posts &rarr;', 'kingdom' ) ); ?></div>
			<div class="clear"></div>
		</nav><!-- #kingdom-posts-nav-below -->
	<?php } else { ?>
		<!-- nothing found -->
		<section class="post no-results not-found">
			<div class="kingdom-entry-body">
				<h2 class="kingdom-entry-title">
					<?php _e( 'Nothing Found', 'kingdom' ); ?>
				</h2><!-- .kingdom-entry-title -->
				<article class="kingdom-entry-content">
					<p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'kingdom' ); ?></p>
					<?php get_search_form(); ?>
				</article><!-- .kingdom-entry-content -->
			</div><!-- .kingdom-entry-body -->
		</section><!-- .no-results -->
	<?php } ?>
</div><!-- #articles -->
<div class="clear"></div>
<?php get_footer();
