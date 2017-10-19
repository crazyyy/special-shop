<?php
/**
 * The template for displaying Comments.
 */

if ( post_password_required() ) {
	return;
}

if ( have_comments() || comments_open() ) { ?>
	<div class="wrap-comments">
		<?php if ( have_comments() ) { ?>
			<h3><?php _e( 'Comments', 'kingdom' ); ?></h3>
			<ul class="commentlist">
				<!-- main comments function -->
				<?php wp_list_comments( array( 'callback' => 'kingdom_comment' ) ); ?>
			</ul><!-- .commentlist -->
			<?php if ( 1 < get_comment_pages_count() && get_option( 'page_comments' ) ) { ?>
				<!-- comments navigation links -->
				<nav id="kingdom-comment-nav-below">
					<div class="kingdom-nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'kingdom' ) ); ?></div>
					<div class="kingdom-nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'kingdom' ) ); ?></div>
					<div class="clear"></div>
				</nav><!--.kingdom-comment-nav-below -->
			<?php }
		}
		if ( ! comments_open() ) { ?>
			<h3 class="comments_closed"><?php _e( 'Comments are closed.', 'kingdom' ); ?></h3>
		<?php } else {
			/* comment form */
			comment_form();
		} ?>
	</div><!-- .wrap-comments -->
<?php }
