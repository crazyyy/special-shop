<?php
// Add Products Post Type
add_action( 'init', 'post_type_walets' );
function post_type_walets() {
  $labels = array(
    'name'=> 'Кошельки',
    'singular_name' => 'Кошельки',
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
    'description' => 'Кошельки',
    'public' => true,
    'exclude_from_search' => true,
    'show_ui' => true,
    'menu_position' => 16,
    // https://developer.wordpress.org/resource/dashicons/
    'menu_icon' => 'dashicons-feedback',
    'capability_type' => 'post',
    'hierarchical' => false,
    'supports' => array('title'),
    'rewrite' => array( 'slug' => 'walets' ),
    'show_in_rest' => true
  );
  register_post_type( 'walets', $args );
}

add_action('init', 'taxonomies_paymethods', 0);
function taxonomies_paymethods()
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name'              => 'Плат. системы',
    'singular_name'     => 'Плат. системы',
    'search_items'      => 'Поиск',
    'all_items'         => 'Все',
    'parent_item'       => 'Родитель',
    'parent_item_colon' => 'Родитель',
    'edit_item'         => 'Редактировать',
    'update_item'       => 'Обновить',
    'add_new_item'      => 'Добавить',
    'new_item_name'     => 'Добавить',
    'menu_name'         => 'Плат. системы',
  );
  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'paymethods' ),
  );

 register_taxonomy( 'paymethods', array( 'walets' ), $args );
}

?>
