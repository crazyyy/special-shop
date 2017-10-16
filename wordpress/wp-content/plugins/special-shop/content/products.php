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
            <div class="product-container">
              <span class="product-container--headline">Вы приобретаете: <span class="product-container--title">'. get_the_title() .'</span></span>
              <span class="product-container--price">Стоимость: <span class="product-container--hightlight">' . $row['product_id'] . '</span> рублей</span>
              <span class="product-container--description">Для приобретения выбраного товара, оплатите <span class="product-container--description-pr">'. $row['product_price'] .'</span> рублей на QIWI кошелек: <span class="product-container--description-wall">'. $wallet -> post_title .'</span></span>
              <span class="product-container--comment">Коментарий к платежу: <span>'. $row['product_id'] .'</span></span>
              <span class="product-container--description-after"> Внимание! Обязательно укажите этот коментарий при оплате, иначе оплата не будет засчитана в автоматическом режиме.</span>
              <span class="product-container--id">Заказ № <span>'. get_the_ID() .'</span></span>
              <span class="product-container--description-after">Это номер вашего заказа, запомните его. По номеру заказа и коментарию вы сможете узнать статус заказа (получить адрес) в любой момент и с любого устройства на странице проверки заказа</span>
              <hr />
              <span class="product-container--checktext">После оплаты нажмите кнопку, что бы получить адрес</span>
              <a class="product-container--checkbtn" href="/check">Проверить оплату</a>
            </div>
          ';

        } else { /* no more ACTIVE elements */ }

    } else { /* first element on screen or nothing to show */ }

  }}

?>
