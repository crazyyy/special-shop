<?php
/**
 * kingdom functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 */

/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 580;
}

/**
 * Sets up theme defaults and registers the various WordPress features
 */
function kingdom_setup() {
	/*
	 * Translations can be added to the /languages/ directory.
	 */
	load_theme_textdomain( 'kingdom', get_template_directory() . '/languages' );

	/* This theme styles the visual editor with editor-style.css to match the theme style. */
	add_editor_style();

	/* Adds RSS feed links to <head> for posts and comments. */
	add_theme_support( 'automatic-feed-links' );

	/* This theme uses post thumbnails */
	add_theme_support( 'post-thumbnails' );
	/* Register a new image size */
	add_image_size( 'kingdom_slide', 880, 336, true );

	/* This theme supports a variety of post formats. */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );

	/* This theme uses wp_nav_menu() in one location. */
	register_nav_menu( 'primary', __( 'Primary Menu', 'kingdom' ) );
	/*
	 * This theme supports custom background color and image, and here
	 * we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => '3b8bda',
	) );

	/*
	 * This theme supports custom background color and image, and here
	 * we also set up the default background color.
	 */
	add_theme_support( 'custom-header', array(
		'width'              => 940,
		'height'             => 220,
		'uploads'            => true,
		'default-text-color'  => 'ffffff',
		'admin-head-callback' => 'kingdom_admin_header_style',
		'wp-head-callback'    => 'kingdom_header_style',
	) );

	add_theme_support( 'title-tag' );
}

/**
 * Registers our main widget area and the front page widget areas.
 */
function kingdom_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Primary Widget Area', 'kingdom' ),
		'id'            => 'primary-widget-area',
		'description'   => __( 'The primary widget area', 'kingdom' ),
		'before_widget' => '<aside id="%1$s" class="widget-container %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function kingdom_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) ) {
		$args['show_home'] = true;
	}

	return $args;
}

/**
 * Enqueues scripts and styles.
 */
function kingdom_scripts_styles() {
	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/*
	 * Loads library for styling the form elements.
	 */
	wp_enqueue_script( 'kingdom-formstyler', get_template_directory_uri() . '/js/jquery.formstyler.min.js', array( 'jquery' ) );

	/*
	 * Loads script for slider.
	 */
	if ( is_front_page() ) {
		wp_enqueue_script( 'kingdom-slider', get_template_directory_uri() . '/js/slider.js', array( 'jquery' ) );
	}

	/*
	 * Loads our main script.
	 */
	wp_enqueue_script( 'kingdom-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery', 'kingdom-formstyler' ) );

	/*
	 * Loads script IE.
	 */
		wp_enqueue_script( 'kingdom-ie7-script', get_template_directory_uri() . '/js/ie7.js', array( 'jquery' ) );
	wp_script_add_data( 'kingdom-ie7-script', 'conditional', 'lt IE 9' );
	wp_enqueue_script( 'kingdom-html5-script', get_template_directory_uri() . '/js/html5.js', array( 'jquery' ) );
	wp_script_add_data( 'kingdom-html5-script', 'conditional', 'lt IE 9' );

	/*
	 * Loads our main stylesheet.
	 */
	wp_enqueue_style( 'kingdom-style', get_stylesheet_uri() );

	/*
	 * Loads slider stylesheet.
	 */
	if ( is_front_page() ) {
		wp_enqueue_style( 'kingdom-slider-style', get_template_directory_uri() . '/css/slider.css', array( 'kingdom-style' ) );
	}

	/*
	 * Loads stylesheet IE.
	 */
	wp_enqueue_style( 'kingdom-ie7-style', get_stylesheet_directory_uri() . '/css/ie7.css', array( 'kingdom-style' ) );
	wp_style_add_data( 'kingdom-ie7-style', 'conditional', 'IE 7' );
	wp_enqueue_style( 'kingdom-ie8-style', get_stylesheet_directory_uri() . '/css/ie8.css', array( 'kingdom-style' ) );
	wp_style_add_data( 'kingdom-ie8-style', 'conditional', 'IE 8' );
	wp_enqueue_style( 'kingdom-ie9-style', get_stylesheet_directory_uri() . '/css/ie9.css', array() );
	wp_style_add_data( 'kingdom-ie9-style', 'conditional', 'IE 9' );
}

/** Slider functions */
/** Adds metabox to the main column on the Post and Page edit screens. */
function kingdom_add_custom_box() {
	$screens = array( 'post', 'page' );
	foreach ( $screens as $screen ) {
		add_meta_box(
			'slider-section',
			'Slider Settings',
			'kingdom_slider_custom_box',
			$screen
		);
	}
}

/** When the post is saved, saves our custom data. */
function kingdom_slider_save_postdata( $post_id ) {
	//We need to verify this came from the our screen and with proper authorization,
	//because save_post can be triggered at other times.
	//
	// Check if our nonce is set.
	if ( ! isset( $_POST['kingdom_slider_custom_box_nonce'] ) ) {
		return $post_id;
	}
	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	// OK, its safe for us to save the data now.
	// Update the meta field in the database.
	update_post_meta( $post_id, 'kingdom_add_to_slider', $_POST['kingdom_add_to_slider'] );
	// Update kingdom_slide_description field in the database.
	update_post_meta( $post_id, 'kingdom_slide_description', sanitize_text_field( $_POST['kingdom_slide_description'] ) );
}

/**
 * Template for comments and pingbacks.
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function kingdom_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
			/* Display trackbacks differently than normal comments. */ ?>
			<li class="post pingback">
			<p><?php _e( 'Pingback', 'kingdom' ); ?>: <?php comment_author_link(); ?><?php edit_comment_link( __( '[Edit]', 'kingdom' ), '<span class="edit-link">', '</span>' ); ?></p></li>
			<?php break;
		default :
			/* Proceed with normal comments. */ ?>
			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<div id="comment-<?php comment_ID(); ?>">
				<div class="comment-author">
					<?php echo get_avatar( $comment, $size = '64' );
					printf( '<cite class="fn">%s</cite> <span class="says">' . __( 'says', 'kingdom' ) . ':</span>', get_comment_author_link() ); ?>
				</div><!-- .comment-author -->
				<?php if ( '0' == $comment->comment_approved ) { ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'kingdom' ); ?></em>
					<br />
				<?php } ?>
				<div class="comment-meta commentmetadata">
					<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf( '%1$s ' . __( 'at', 'kingdom' ) . ' %2$s', get_comment_date(), get_comment_time() ); ?></a><?php edit_comment_link( __( '[Edit]', 'kingdom' ), '  ', '' ); ?>
				</div>
				<?php comment_text(); ?>
				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array(
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
					) ) ); ?>
				</div><!-- .reply -->
			</div></li>
			<?php break;
	endswitch;
}

/**
 * Styles the header text displayed on the blog.
 *
 * get_header_textcolor() options: 444 is default, hide text (returns 'blank'), or any hex value.
 */
function kingdom_header_style() {
	$text_color = get_header_textcolor();

	/* If no custom options for text are set, let's bail */
	if ( get_theme_support( 'custom-header', 'default-text-color' ) == $text_color ) {
		return;
	}

	/* If we get this far, we have custom styles. */ ?>
	<style type="text/css">
		.kingdom-site-title a {
			color: # <?php echo $text_color; ?> !important;
		}
	</style>
<?php }

/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 */
function kingdom_admin_header_style() { ?>
	<style type="text/css">
		.wrap h3, .wrap tr {
			display: none;
		}

		.wrap form table.form-table, .wrap form h3, .wrap form tr.displaying-header-text {
			display: block;
		}
	</style>
<?php }

/*
 * Display Thumbnail
 */
function kingdom_thumbnail_display( $post_id ) {
	$thumbnail = get_the_post_thumbnail( $post_id );
	if ( $thumbnail ) { ?>
		<div class="kingdom_thumbnails">
			<a href="<?php the_permalink(); ?>"><?php echo $thumbnail; ?></a>
			<?php /*condition for caption */
			$tmp = get_post( get_post_thumbnail_id( $post_id ) );
			if ( '' !== trim( $tmp->post_excerpt ) ) { ?>
				<p class="img_text"><?php echo $tmp->post_excerpt; ?></p>
			<?php } ?>
		</div><!-- .kingdom_thumbnails -->
	<?php }
}

/**
 * Adds slider to the frontpage */
function kingdom_get_slider() {
	if ( have_posts() ) {
		$query = new WP_Query( array(
			'posts_per_page'      => - 1,
			'post_type'           => 'any',
			'meta_key'            => 'kingdom_add_to_slider',
			'meta_value'          => 'on',
			'ignore_sticky_posts' => 1,
		) );
		// The Loop
		if ( $query->have_posts() ) { ?>
			<div id="slider-wrap">
				<div id="slider">
					<?php while ( $query->have_posts() ) {
						$query->next_post();
						$p = $query->post; ?>
						<div id="slide-<?php echo $query->current_post ?>" class="slide">
							<a href="<?php echo get_permalink( $p->ID ) ?>" target="_blank">&nbsp;</a>
							<?php echo get_the_post_thumbnail( $p->ID, 'kingdom_slide' ); ?>
							<div class="slider_text">
								<h1><?php echo $p->post_title ?></h1>
								<?php echo get_post_meta( $p->ID, 'kingdom_slide_description', true ) ?>
							</div>
						</div><!-- .slide -->
					<?php } // End while.
					wp_reset_postdata(); // restore the global $post variable ?>
				</div>
			</div>
		<?php } // End if.
	}
} // END slider

/** Prints the box content. */
function kingdom_slider_custom_box( $post ) {
	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'kingdom_slider_custom_box', 'kingdom_slider_custom_box_nonce' );
	// Use get_post_meta() to retrieve an existing value
	// from the database and use the value for the form.
	$edited_post_id = $post->ID;
	$value          = get_post_meta( $edited_post_id, 'kingdom_slide_description', true ); ?>
	<input type="text" id="kingdom_slide_description" name="kingdom_slide_description" value="<?php echo esc_attr( $value ) ?>" maxlength="105" size="85">
	<?php $value = get_post_meta( $edited_post_id, 'kingdom_add_to_slider', true ); ?>
	<input type="checkbox" id="kingdom_add_to_slider" name="kingdom_add_to_slider"<?php if ( 'on' == $value ) echo 'checked '; ?>>
	<label for="kingdom_add_to_slider">
		<?php _e( ' Check if you want featured image of this post to be shown in the slider. You can add text description as well.', 'kingdom' ) ?>
		<br>
	</label>
<?php }

add_action( 'after_setup_theme', 'kingdom_setup' );
add_action( 'widgets_init', 'kingdom_widgets_init' );
add_filter( 'wp_page_menu_args', 'kingdom_page_menu_args' );
add_action( 'wp_enqueue_scripts', 'kingdom_scripts_styles' );
add_action( 'add_meta_boxes', 'kingdom_add_custom_box' );
add_action( 'save_post', 'kingdom_slider_save_postdata' );
add_action( 'kingdom_thumbnail_display', 'kingdom_thumbnail_display' );
add_action( 'kingdom_get_slider', 'kingdom_get_slider' );
