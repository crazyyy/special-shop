<?php

  echo '<ul class="all-reviews">';
    $temp = $wp_query;
    $wp_query= null;
    query_posts('post_type=reviews&showposts=30');
    while (have_posts()) : the_post();

      echo '
        <li>
          <h6 class="all-reviews--username">'. get_the_title() .'</h6>'
          . get_the_content() .
        '</li>';

    endwhile;
  $wp_query = null;
  $wp_query = $temp;
  echo '</ul><!-- all-reviews -->';

  echo '<div class="page-content">'. get_the_content() .'</div><!-- /.page-content -->';
  echo '<div class="add-review">'. get_field('form') .'</div><!-- /.add-review -->';


?>
