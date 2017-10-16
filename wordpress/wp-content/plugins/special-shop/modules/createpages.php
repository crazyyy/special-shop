<?php

register_activation_hook( __FILE__, 'specshop_insert_page' );
function specshop_insert_page(){

  if(!is_page('check')) {
    $check_page = array(
      'post_type' => 'page',
      'post_name' => 'check',
      'post_title' => 'Проверить заказ',
      'post_status' => 'publish',
    );
    wp_insert_post($check_page);
  }

  if(!is_page('reviews')) {
    $reviews_page = array(
      'post_type' => 'page',
      'post_name' => 'reviews',
      'post_title' => 'Отзывы',
      'post_status' => 'publish',
    );
    wp_insert_post($reviews_page);
  }

}


?>
