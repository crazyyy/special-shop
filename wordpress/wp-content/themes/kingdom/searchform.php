<?php
/**
 * The template for displaying searchform.
 */
?>
<form method="get" class="searchform formsearch" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" class="field" name="s" placeholder="<?php esc_attr_e( 'Enter search keyword', 'kingdom' ); ?>" value="<?php echo get_search_query(); ?>" />
	<input type="submit" class="submit" name="submit" value="" />
</form>
