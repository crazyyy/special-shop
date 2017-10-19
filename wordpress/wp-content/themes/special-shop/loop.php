<ul>
  <?php if (have_posts()): while (have_posts()) : the_post(); ?>

    <?php
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
    ?>
  <?php endwhile; endif; ?>
</ul><!-- productlist-container -->
