<?php
/**
 * The template for displaying 404 pages (Not Found).
 */
get_header();
get_sidebar(); ?>
	<div id="articles" class="articles" role="main">
		<!-- 404 TITLE -->
		<section class="post meta-title">
			<div class="kingdom-entry-body">
				<h2 class="kingdom-entry-title"><?php _e( 'Nothing Found', 'kingdom' ); ?></h2>
			</div>
		</section><!-- .post.meta-title -->
		<section id="post-0" class="post error404 no-results not-found">
			<div class="kingdom-entry-body">
				<h2 class="kingdom-entry-title">
					<?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'kingdom' ); ?>
				</h2>
				<article class="kingdom-entry-content">
					<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'kingdom' ); ?></p>
					<?php get_search_form(); ?>
				</article><!-- .kingdom-entry-content -->
			</div><!-- .kingdom-entry-body -->
		</section><!-- .no-results -->
		<div class="clear"></div>
	</div><!-- #articles -->
	<div class="clear"></div>
<?php get_footer();
