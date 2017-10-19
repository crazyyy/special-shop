<?php /* Template Name: Home Page */ get_header(); ?>
<section class="index">
  <!-- Города -->
  <div class="cities">

    <?php

      // list top level product districts with link to a child
      echo '<ul id="cities" class="l_tinynav1">';
        $wcatTerms = get_terms('district', array('hide_empty' => 0, 'parent' =>0));
        foreach($wcatTerms as $wcatTerm) :
          echo '

              <li class="productnav--item">
                <a href="'. get_term_link( $wcatTerm->slug, $wcatTerm->taxonomy ) .'">'. $wcatTerm->name .'</a></li>
                ';
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

          ';
        endforeach;
      echo '</ul>';
    ?>


    <?php

      // list top level product districts with link to a child
      echo '<select id="tinynav1" class="tinynav tinynav1"><option>Выберите город</option>';
        $wcatTerms = get_terms('district', array('hide_empty' => 0, 'parent' =>0));
        foreach($wcatTerms as $wcatTerm) :
          echo '

              <option value="'. get_term_link( $wcatTerm->slug, $wcatTerm->taxonomy ) .'">'. $wcatTerm->name .'</option>
                ';
                  $wsubargs = array(
                    'hierarchical' => 1,
                    'show_option_none' => '',
                    'hide_empty' => 0,
                    'parent' => $wcatTerm->term_id,
                    'taxonomy' => 'district'
                  );
                  $wsubcats = get_categories($wsubargs);
                  foreach ($wsubcats as $wsc):
                    echo '<option value="'. get_term_link( $wsc->slug, $wsc->taxonomy ) .'">'. $wsc->name .'</option>';
                  endforeach;
                echo '

          ';
        endforeach;
      echo '</select>';
    ?>

  </div>
  <!-- / Города -->

  <div class="products">

    <?php
      // list products
      echo '<ul>';

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
            <li id="post-'. get_the_ID() .'" class="product-container--item">
              <div class="wrap">
                <div class="name">' . get_the_title()  .'</div>
                <div class="price"><span class="product-container--price">'. $price .'</span> руб.</div>
                <div class="size product-container--count">В наличии: <span class="bold">Есть</span></div>
                <div class="buy"><a href="'. get_the_permalink() .'">Купить</a></div>
              </div>
            </li>
          ';

        endwhile;

        $wp_query = null;
        $wp_query = $temp;

      echo '</ul><!-- productlist-container -->';

    ?>

  </div>
</section>
<?php get_footer(); ?>
