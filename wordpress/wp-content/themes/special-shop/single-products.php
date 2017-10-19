<?php get_header(); ?>

  <?php if (have_posts()): while (have_posts()) : the_post(); ?>
    <section class="buy pager">
      <div class="wraper">

        <?php
          $rows = get_field('products');

          $first_element = false;

          // check all products in current product page
          if ($rows) { foreach($rows as $row) {

            // get only firs ACTIVE product
            if ($first_element == false ) {

              // end check if this product has a label ACTIVE
                if ( $row['product_status']['value'] == 'active') {

                  // after use first active element - close the loop
                  $first_element = true;

                  // get the wallet bumber from ACF field
                  $wallet = $row['product_wallet'][0];

                  echo '

                  <p>Вы приобретаете</p>
                  <p><span class="light">'. get_the_title() .'</span></p>
                  <p>Стоимость <span class="light bg">500 руб.</span></p>
                  <p>Для приобретения выбранного товара, оплатите <span style="color:red">'. $row['product_price'] .' рублей</span> на QIWI кошелек: <span class="product-container--description-wall">'. $wallet -> post_title .'</span></p>


                  <p><span class="light">Заказ: '. get_the_ID() .'</span></p>
                  <p><span class="light">Коментарий к платежу: '. $row['product_id'] .'</span></p>

                  <p>Это номер вашего заказа, запомните его. По номеру заказа и коду ваучера вы сможете узнать статус заказа (получить адрес) в любой момент и с любого устройства на странице <a href="/check">проверка заказа</a></p>

                  <hr>

                  ';
                } else { /* no more ACTIVE elements */ }
            } else { /* first element on screen or nothing to show */ }
          }}
        ?>

        <a class="button button-check" href="/check">Проверить оплату</a>

      </div>
    </section>
  <?php endwhile; endif; ?>
<?php get_footer(); ?>
