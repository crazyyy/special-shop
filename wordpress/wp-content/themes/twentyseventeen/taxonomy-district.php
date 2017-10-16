<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="wrap">

	<?php if ( have_posts() ) : ?>
		<header class="page-header">

			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
		</header><!-- .page-header -->
	<?php endif; ?>


  <?php
    // List of subcategory districs
    $term = get_queried_object();
    $term_id = $term->term_id;
    $taxonomy_name = $term->taxonomy;

    $termchildren = get_term_children( $term_id, $taxonomy_name );

    echo '<ul class="productnav">';
    foreach ( $termchildren as $child ) {
        $term = get_term_by( 'id', $child, $taxonomy_name );
        echo '<li class="productnav--item"><a href="' . get_term_link( $term, $taxonomy_name ) . '">' . $term->name . '</a></li>';
    }
    echo '</ul>';

  ?>


	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

    <div class="product-container">


		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>



        <article id="post-<?php the_ID(); ?>" <?php post_class('product-container--item'); ?>>




<?php if( have_rows('products') ): ?>
	<ul class="slides">
!#!)($)!$()$*!($@#())
	<?php while( have_rows('products') ): the_row();
		// vars
		$content = get_sub_field('product_price');
		?>
		<li class="slide">
&!&!&#!&#!&#
		    <?php echo $content; ?>
		</li>
	<?php endwhile; ?>
	</ul>
<?php endif; ?>


<?php
  $rows = get_field('products');

echo '<pre>';
          var_dump($rows);
echo '</pre>';

echo get_the_id();

  $first_element = false;
  $price = 0;
  $count = 0;

  if ($rows) { foreach($rows as $row) {
    $count =+ 1;

  }}
  // check all products in current product page
  if ($rows) { foreach($rows as $row) {
    // get only firs ACTIVE product
    if ($first_element == false ) {
      // end check if this product has a label ACTIVE
        if ( $row['product_status']['value'] == 'active') {
          // after use first active element - close the loop
          $first_element = true;
          // get the wallet bumber from ACF field
          $wallet = $row['product_wallet'][0];

          $price = $row['product_price'];



        } else { /* no more ACTIVE elements */ }
    } else { /* first element on screen or nothing to show */ }
  }}

?>



<?php
echo '!!!!!!';
// check if the repeater field has rows of data
if( have_rows('products') ):

echo '!!!!!!';
 	// loop through the rows of data
    while ( have_rows('products') ) : the_row();


        // display a sub field value
        the_sub_field('product_price');

    endwhile;


endif;

?>






          <h1 class="product-container--title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
          <span class="product-container--price"><?php echo $price; ?>р.</span>
          <span class="product-container--count">В наличии: <span><?php echo $count; ?></span></span>
          <a href="<?php the_permalink(); ?>" class="product-container--buy">Купить</a>
        </article><!-- #post-## -->

			<? endwhile; 	endif; ?>

    </div><!-- /.product-container -->


		<?
			the_posts_pagination( array(
				'prev_text' => twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'twentyseventeen' ) . '</span>',
				'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'twentyseventeen' ) . '</span>' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyseventeen' ) . ' </span>',
			) );

?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
