<?php

  echo '
    <div class="check-form">
      <form action="#">
        <label for="order-number">Номер заказа</label>
        <input type="text" name="order-number" id="order-number" value="">
        <label for="order-comment">Коментарий к платежу</label>
        <input type="text" name="order-comment" id="order-comment" value="">
        <p>После оплаты нажмите на кнопку, что бы получить адрес</p>
        <button class="check-form--btn">Проверить оплату</button>
      </form>
    </div><!-- /.check-form -->
  ';

  echo '
    <div class="check-status">
    </div><!-- /.check-status -->
  ';
?>
