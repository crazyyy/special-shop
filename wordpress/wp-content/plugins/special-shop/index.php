<?php
/**
 * Plugin Name: Special Shop
 * Version: 2017.10.06
 * Description: Small shop plugin
 * Author: saitobaza.ru
 * Author URI: https://saitobaza.ru
 * Plugin URI: https://saitobaza.ru
 * Text Domain: Special Shop
 * Domain Path: /languages
 * License: GPLv3
 * License URI: http://www.gnu.org/licenses/gpl-3.0
*/

require 'modules/loadassets.php';

// include ACF and hide it from admin area
require 'acf/acf.php';
// add_filter('acf/settings/show_admin', '__return_false');

require 'modules/products.php';
require 'modules/payments.php';
require 'modules/regions.php';

require 'modules/reviews.php';

require 'ajax.php';

// clear the permalinks after the post type has been registered
register_activation_hook( __FILE__, 'specshop_plugin_install' );
function specshop_plugin_install()
{
    flush_rewrite_rules();
}

// check if needed pages exists and create it if necessary
register_activation_hook( __FILE__, 'specshop_insert_page' );
function specshop_insert_page(){

  if(!is_page('products')) {
    $check_page = array(
      'post_type' => 'page',
      'post_name' => 'products',
      'post_title' => 'Товары',
      'post_status' => 'publish',
    );
    wp_insert_post($check_page);
  }

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

// replace the_content on product single pages
add_filter('the_content', 'specshop_products_content');
function specshop_products_content( $content )
{
  if ( is_singular( 'products' ) ) {
    include dirname( __FILE__ ) . '/content/products.php';
  } else {
    return $content;
  }
}

// modify query on products taxonomy (archive) page
add_filter('pre_get_posts', 'specshop_products_loop');
function specshop_products_loop( $query )
{
  if ( is_tax( 'district' ) ) {
    $query->set( 'post_type', array( 'products' ) );
    $query->set( 'posts_per_page', 50 );
  }
}

// replace the_content on reviews page
add_filter('the_content', 'specshop_reviews_loop_content');
function specshop_reviews_loop_content( $content )
{
  if ( is_page( 'reviews' ) ) {
    include dirname( __FILE__ ) . '/content/page-reviews.php';
  }
}

// replace the_content on check payment page
add_filter('the_content', 'specshop_pagecheck_content');
function specshop_pagecheck_content( $content )
{
  if ( is_page( 'check' ) ) {
    include dirname( __FILE__ ) . '/content/page-check.php';
  }
}

// replace the_content on product list page
add_filter('the_content', 'specshop_productlist_content');
function specshop_productlist_content( $content )
{
  if ( is_page( 'products' ) ) {
    include dirname( __FILE__ ) . '/content/page-productlist.php';
  }
}

?>
