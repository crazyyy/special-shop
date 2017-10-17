<?php
  // load ACF fields for taxonomy page
  add_action( 'wp_ajax_load_acf_fields', 'load_acf_fields' );
  function load_acf_fields() {
    global $wpdb;
    $post_id = intval( $_POST['postid'] );

    $first_element = false;
    $price = 0;
    $count = 0;

    $rows = get_field('products', $post_id);
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

    $obj = (object) [
      'price' => $price,
      'count' => $count,
    ];

    echo json_encode($obj);
    wp_die();
  }

?>
