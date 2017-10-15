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

          $wallets = get_sub_field('product_wallet');
          $wallet = $wallets[0];

          var_dump($wallets);

          echo '<div class="product-container">';
          echo '<span class="product-container--headline">Вы приобретаете:</span> ';
          echo '<span class="product-container--title">'. get_the_title() .'</span>';
          echo '<span class="product-container--price">Стоимость: <span class="product-container--hightlight">' . $row['product_id'] . '</span></span>';
          echo '<span class="product-container--description">Для приобретения выбраного товара, оплатите '. $row['product_price'] .' рублей на **** кошелек: ***</span>';
          echo '<span class="product-container--title">Коментарий к платежу: '. $row['product_id'] .'</span>';
          echo '<span class="product-container--title"> Внимание! Обязательно укажите этот коментарий при оплате, иначе оплата не будет засчитана в автоматическом режиме.</span>';
          echo '<span class="product-container--title">Заказ №'. get_the_ID() .'</span>';
          echo '<span class="product-container--title">Это номер вашего заказа, запомните его. По номеру заказа и коментарию вы сможете узнать статус заказа (получить адрес) в любой момент и с любого устройства на странице проверки заказа</span>';
          echo '<hr />';
          echo '<span class="product-container--checktext">После оплаты нажмите кнопку, что бы получить адрес</span>';
          echo '<a class="product-container--checkbtn" href="/check">Проверить оплату</a>';
          echo '</div>';


        } else { /* no more ACTIVE elements */ }

    } else { /* first element on screen or nothing to show */ }

  }}


/*
product_id
product_price
product_wallet
*/

?>
