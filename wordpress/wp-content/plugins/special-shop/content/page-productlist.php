<?php

  // list top level product districts with link to a child
  $wcatTerms = get_terms('district', array('hide_empty' => 0, 'parent' =>0));
  foreach($wcatTerms as $wcatTerm) :
    echo '
      <ul class="productnav">
        <li class="productnav--item">
          <a href="'. get_term_link( $wcatTerm->slug, $wcatTerm->taxonomy ) .'">'. $wcatTerm->name .'</a>
          <ul class="productnav--childnav">';
            $wsubargs = array(
              'hierarchical' => 1,
              'show_option_none' => '',
              'hide_empty' => 0,
              'parent' => $wcatTerm->term_id,
              'taxonomy' => 'district'
            );
            $wsubcats = get_categories($wsubargs);
            foreach ($wsubcats as $wsc):
              echo '<li><a href="'. get_term_link( $wsc->slug, $wsc->taxonomy ) .'">'. $wsc->name .'</a></li>';
            endforeach;
          echo '
          </ul>
        </li>
      </ul>
    ';
  endforeach;

  // list products
  echo '<div class="productlist-container">';

    $temp = $wp_query;
    $wp_query= null;
    query_posts('post_type=products&showposts=30');

      while (have_posts()) : the_post();

      $rows = get_field('products');
      $first_element = false;
      $price = 0;
      $count = count($rows);

      // check all products in current product page
      if ($rows) { foreach($rows as $row) {
        // get only firs ACTIVE product
        if ($first_element == false ) {
          // end check if this product has a label ACTIVE
            if ( $row['product_status']['value'] == 'active') {
              // after use first active element - close the loop
              $first_element = true;
              $price = $row['product_price'];
            } else { /* no more ACTIVE elements */ }
        } else { /* first element on screen or nothing to show */ }
      }}

      echo '
        <article id="post-'. get_the_ID() .' class="productlist-container--item">
          <h2 class="product-container--title"><a href="'. get_the_permalink() .'">' . get_the_title()  .'</a></h2>
          <span class="product-container--price">'. $price .'р.</span>
          <span class="product-container--count">В наличии: <span>'. $count .'</span></span>
          <a href="'. get_the_permalink() .'>" class="product-container--buy">Купить</a>
        </article>
      ';

    endwhile;

    $wp_query = null;
    $wp_query = $temp;

  echo '</div><!-- productlist-container -->';

?>
