<?php
/**
 * The Header for our theme.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif;
	wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="site">
	<!-- header -->
	<div class="kingdom-bg-header">
		<header id="masthead" class="site-header" role="banner">
			<!-- site title -->
			<div class="hgroup">
				<h1 class="kingdom-site-title">
					<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</h1>
				<h2 class="kingdom-site-description"><?php bloginfo( 'description' ); ?></h2>
			</div><!-- .hgroup -->
			<!-- site menu -->
			<nav id="access" role="navigation" class="access">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'kingdom_main_menu' ) ); ?>
				<div class="clear"></div>
			</nav><!-- .access -->
			<div class="clear"></div>
			<?php if ( get_header_image() ) { ?>
				<div class="header-image">
					<img src="<?php header_image(); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
				</div>
			<?php } ?>
		</header><!-- #masthead -->
	</div><!-- .kingdom-bg-header -->
	<!-- main -->
	<div class="wrapper_main">
