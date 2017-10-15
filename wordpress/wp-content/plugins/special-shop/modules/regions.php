<?php
// hook into the init action and call create_book_taxonomies when it fires
add_action('init', 'taxonomies_district', 0);
function taxonomies_district()
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name'              => 'Регионы',
    'singular_name'     => 'Регион',
    'search_items'      => 'Поиск',
    'all_items'         => 'Все',
    'parent_item'       => 'Родитель',
    'parent_item_colon' => 'Родитель',
    'edit_item'         => 'Редактировать',
    'update_item'       => 'Обновить',
    'add_new_item'      => 'Добавить',
    'new_item_name'     => 'Добавить',
    'menu_name'         => 'Регионы',
  );
  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'district' ),
  );

 register_taxonomy( 'district', array( 'products' ), $args );
}

?>
