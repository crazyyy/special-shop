
  <?php
    // List of subcategory districs
    $term = get_queried_object();
    $term_id = $term->term_id;
    $taxonomy_name = $term->taxonomy;

    $termchildren = get_term_children( $term_id, $taxonomy_name );

    echo '<ul class="productnav">';
    foreach ( $termchildren as $child ) {
        $term = get_term_by( 'id', $child, $taxonomy_name );
        echo '<li class="productnav--item"><a href="' . get_term_link( $term, $taxonomy_name ) . '">' . $term->name . '</a></li>';
    }
    echo '</ul>';

  ?>
