// Add news Post Type
add_action( 'init', 'post_type_author' );
function post_type_author() {
  $labels = array(
    'name'=> 'Authors',
    'singular_name' => 'Authors',
    'add_new' => 'Add',
    'add_new_item' => 'Add',
    'edit' => 'Edit',
    'edit_item' => 'Edit',
    'new-item' => 'Add',
    'view' => 'View',
    'view_item' => 'View',
    'search_items' => 'Search',
    'not_found' => 'Not Found',
    'not_found_in_trash' => 'Not Found',
    'parent' => 'Parent',
  );
  $args = array(
    'labels'             => $labels,
    'description' => 'Author Post Type',
    'public' => true,
    'exclude_from_search' => true,
    'show_ui' => true,
    'menu_position' => 3,
    // https://developer.wordpress.org/resource/dashicons/
    'menu_icon' => 'dashicons-businessman',
    'capability_type' => 'post',
    'hierarchical' => false,
    'supports' => array('title','editor','thumbnail'),
    'rewrite' => array( 'slug' => 'author' ),
    'show_in_rest' => true
  );
  register_post_type( 'author' , $args );
}
// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'taxonomies_category', 0 );
function taxonomies_category() {
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name'              => 'Categories',
    'singular_name'     => 'Category',
    'search_items'      => 'Search',
    'all_items'         => 'All',
    'parent_item'       => 'Parent',
    'parent_item_colon' => 'Parent',
    'edit_item'         => 'Edit',
    'update_item'       => 'Update',
    'add_new_item'      => 'Add',
    'new_item_name'     => 'Add',
    'menu_name'         => 'Categories',
  );
  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'categories' ),
  );
  register_taxonomy( 'categories', array( 'author' ), $args );
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name'                       => 'Tags',
    'singular_name'              => 'Tags',
    'search_items'               => 'Search',
    'popular_items'              => 'Popular',
    'all_items'                  => 'All',
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => 'Edit',
    'update_item'                => 'Update',
    'add_new_item'               => 'Add',
    'new_item_name'              => 'New',
    'separate_items_with_commas' => 'Separate items with comas',
    'add_or_remove_items'        => 'Add or remove',
    'choose_from_most_used'      => 'Choose from the most used',
    'not_found'                  => 'No found.',
    'menu_name'                  => 'Tags',
  );
  $args = array(
    'hierarchical'          => false,
    'labels'                => $labels,
    'show_ui'               => true,
    'show_admin_column'     => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var'             => true,
    'rewrite'               => array( 'slug' => 'tagers' ),
  );
  register_taxonomy( 'tagers', 'author', $args );
}
