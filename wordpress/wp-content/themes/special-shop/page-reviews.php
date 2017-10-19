<?php get_header(); ?>

    <section class="reviews pager">

        <div class="wraper">

            <h1>Отзывы наших покупателей</h1>
            <!-- <a href="https://arma24.biz/reviews/add" class="button">Добавить отзыв</a> -->
            <?php
              echo '<ul class="all-reviews">';
                $temp = $wp_query;
                $wp_query= null;
                query_posts('post_type=reviews&showposts=30');
                while (have_posts()) : the_post();

                  $rating_arr = get_field('rating');
                  $rating = intval($rating_arr['value']);
                  $star = '';
                  for ($i = 0; $i < $rating; $i++) {
                    $star = $star.'<li class="review-rating-item"></li>';
                  }

                  echo
                  '
                    <li class="review">
                        <div class="review-header">
                            <div class="left">
                                <div class="review-name">'. get_the_title() .'</div>
                                <div class="review-date">'. get_the_date() .'</div>
                            </div>
                            <div class="right">
                                <ul class="review-rating review-rating-5 list-inline">
                                    '. $star .'
                                </ul>
                            </div>
                        </div>

                        <div class="review-main">'
                          . get_the_content() .
                        '</div>
                    </li>


                    <li class="review">
                      <h6 class="all-reviews--username"></h6></li>';

                endwhile;
              $wp_query = null;
              $wp_query = $temp;
              echo '</ul><!-- all-reviews -->';

              $reviews_page = get_page_by_path('reviews');
              $reviews_page_id = $reviews_page -> ID;
              $form_field = get_field('form', $reviews_page_id);

              echo '<div class="page-content">'. get_post_field('post_content', $reviews_page_id) .'</div><!-- /.page-content -->';
              echo '<div class="add-review">'. do_shortcode($form_field) .'</div><!-- /.add-review -->';
            ?>

        </div>
    </section>

<?php get_footer(); ?>
