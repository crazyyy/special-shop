<?php
/**
 * The template for displaying the footer.
 */
?>
<div class="clear"></div>
</div><!-- .wrapper_main -->
<!-- footer -->
<div id="site-footer" class="kingdom-bg-footer">
	<footer class="wrapper_footer" role="contentinfo">
		<div id="site-info">
			<span class="foot_date">&copy; <?php echo date_i18n( 'Y' ); ?></span> <?php echo wp_get_theme()->get( 'Name' ); ?>
		</div><!-- #site-info -->
		<div id="site-generator">
			<span><?php _e( 'Powered by', 'kingdom' ); ?></span>
			<a href="<?php echo esc_url( wp_get_theme()->get( 'AuthorURI' ) ); ?>">BestWebLayout</a>
			<span><?php _e( 'and', 'kingdom' ); ?></span>
			<a href="<?php echo esc_url( 'http://wordpress.org/' ); ?>">WordPress</a>
		</div><!-- #site-generator -->
		<div class="clear"></div>
	</footer><!-- .wrapper_footer -->
</div><!-- .kingdom-bg-footer -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
