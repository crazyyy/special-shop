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

  // check payment
  add_action( 'wp_ajax_check_payment', 'check_payment' );
  function check_payment (){
    global $wpdb;

    $order_nubmer =  $_POST['orderNubmer'] ;
    $order_comment =  $_POST['orderComment'] ;

    // remove this
    $obj = (object) [
      'orderNubmer' => $order_nubmer,
      'orderComment' => $order_comment
    ];

    // find ACF subfield
    $acf_subfield_id_query = $wpdb->get_results($wpdb->prepare(
      "
        SELECT *
        FROM {$wpdb->prefix}postmeta
        WHERE post_id = %s
        AND meta_value = %s",
        $order_nubmer, // post_id
        $order_comment // meta_value: 'type_3' for example
    ));
    $acf_subfield_id = str_replace("product_id", "product_", $acf_subfield_id_query[0] -> meta_key);

    // find wallet post ID
    $acf_wallet_post_id_query = $wpdb->get_results($wpdb->prepare(
      "
        SELECT *
        FROM {$wpdb->prefix}postmeta
        WHERE post_id = %s
        AND meta_key = %s",
        $order_nubmer, // post_id
        $acf_subfield_id.'wallet' // meta_value: 'type_3' for example
    ));
    $wallet_post_id = $acf_wallet_post_id_query[0] -> meta_value;
    preg_match("/\"(.*?)\"/", $wallet_post_id, $matches);
    $wallet_post_id = $matches[1];

    // find wallet number
    $wordpress_wallet_number_query = $wpdb->get_results($wpdb->prepare(
      "
        SELECT *
        FROM {$wpdb->prefix}posts
        WHERE ID = %s",
        $wallet_post_id // post_id
    ));
    $wallet_number = $wordpress_wallet_number_query[0] -> post_title;
    $wallet_post_id = $wordpress_wallet_number_query[0] -> ID;

    $wordpress_wallet_token_query = $wpdb->get_results($wpdb->prepare(
      "
        SELECT *
        FROM {$wpdb->prefix}postmeta
        WHERE post_id = %s
        AND meta_key = %s",
        $wallet_post_id, // post_id
        'token' // meta_value: 'type_3' for example
    ));
    $wallet_token = $wordpress_wallet_token_query[0] -> meta_value;

    // find minimum price for this product
    $wordpress_product_price_query = $wpdb->get_results($wpdb->prepare(
      "
        SELECT *
        FROM {$wpdb->prefix}postmeta
        WHERE post_id = %s
        AND meta_key = %s",
        $order_nubmer, // post_id
        $acf_subfield_id.'price' // meta_value: 'type_3' for example
    ));
    $product_price = $wordpress_product_price_query[0] -> meta_value;

    // check payments
    $http_header_token = 'Authorization: Bearer '.$wallet_token;
    $ch = curl_init('https://edge.qiwi.com/payment-history/v1/persons/'. $wallet_number .'/payments?rows=20');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Accept: application/json',
        'Content-Type: application/json',
        $http_header_token
    ));
    $result_payments = curl_exec($ch);
    $result_payments = json_decode($result_payments);
    $array_result_of_payments = $result_payments -> data;

    // search in last successful payments element with queried payment code
    $succeful_payments = array_filter(
      $array_result_of_payments,
      function ($element) {
        preg_match('/71041214432/' , $element->comment, $output_array);
        switch ( count($output_array) > 0 ) {
          case TRUE:
          $array_good[] = $element;
            break;
          case FALSE:
            // echo 'notfound';
            break;
        }
        return $array_good;
      }
    );

    // check if we have one+ payments with code
    if ( count($succeful_payments) == 0 ) {
      echo 'no payments';
      wp_die();
    }

    // search in succeful payment for transfer with product price
    $succeful_price = array_filter(
      $succeful_payments,
      function($element) {
        $amount = $element -> sum -> amount;
        if ( $amount >= $product_price) {
          $amount_good[] = $element;
        } else {
          // echo 'no good';
        }
        return $amount_good;
      }
    );

    // check if we have
    if ( count($succeful_payments) == 0 ) {
      echo 'amount of payment is less than product price';
      wp_die();
    }

    // search product place
    $acf_product_place_query = $wpdb->get_results($wpdb->prepare(
      "
        SELECT *
        FROM {$wpdb->prefix}postmeta
        WHERE post_id = %s
        AND meta_key = %s",
        $order_nubmer, // post_id
        $acf_subfield_id.'place' // meta_value: 'type_3' for example
    ));
    $product_place = $acf_product_place_query[0] -> meta_value;


    $my_post = get_post($order_nubmer);
    // echo $my_post->post_title;
    echo '<div class="product-descr">'. htmlspecialchars_decode($my_post -> post_content) .'</div>';
    echo '<div class="product-placed">'. $product_place .'</div>';

    wp_die();
  }

?>
