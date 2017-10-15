<?
// Add Reviews Post Type
add_action( 'init', 'post_type_review' );
function post_type_review() {
  $labels = array(
    'name'=> 'Отзывы',
    'singular_name' => 'Отзыв',
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
    'description' => 'Отзывы',
    'public' => true,
    'exclude_from_search' => true,
    'show_ui' => true,
    'menu_position' => 17,
    // https://developer.wordpress.org/resource/dashicons/
    'menu_icon' => 'dashicons-star-half',
    'capability_type' => 'post',
    'hierarchical' => false,
    'supports' => array('title','editor','thumbnail'),
    'rewrite' => array( 'slug' => 'reviews' ),
    'show_in_rest' => true
  );
  register_post_type( 'reviews' , $args );
}

?>
