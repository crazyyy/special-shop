<?
// Add Products Post Type
add_action( 'init', 'post_type_products' );
function post_type_products() {
  $labels = array(
    'name'=> 'Товары',
    'singular_name' => 'Товар',
    'add_new' => 'Добавить',
    'add_new_item' => 'Добавить',
    'edit' => 'Редактировать',
    'edit_item' => 'Редактировать',
    'new-item' => 'Добавить',
    'view' => 'Посмотреть',
    'view_item' => 'Посмотреть',
    'search_items' => 'Поиск',
    'not_found' => 'Не найдено',
    'not_found_in_trash' => 'Не найдено',
    'parent' => 'Родительская',
  );
  $args = array(
    'labels' => $labels,
    'description' => 'Товары',
    'public' => true,
    'exclude_from_search' => true,
    'show_ui' => true,
    'menu_position' => 15,
    // https://developer.wordpress.org/resource/dashicons/
    'menu_icon' => 'dashicons-cart',
    'capability_type' => 'post',
    'hierarchical' => false,
    'supports' => array('title','editor','thumbnail'),
    'rewrite' => array( 'slug' => 'products' ),
    'show_in_rest' => true
  );
  register_post_type( 'products', $args );
}

?>
