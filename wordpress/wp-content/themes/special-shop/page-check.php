<?php get_header(); ?>
    <?php if (have_posts()): while (have_posts()) : the_post(); ?>
      <section class="check pager">
          <div class="wraper">
              <h1>Проверка заказа</h1>

              <div class="check-form">
                  <form action="#">
                      <ul>
                          <li>Номер заказа</li>
                          <li><input type="text" class="input" name="order-number" id="order-number"></li>
                      </ul>
                      <ul>
                          <li>Комментарий к платежу</li>
                          <li><input type="text" class="input" name="order-comment" id="order-comment"></li>
                      </ul>

                      <p id="ajaxLoader" style="text-align: center;display: none;"><img src="<?php echo get_template_directory_uri(); ?>/img/square-loader.gif" alt=""></p>

                      <div id="info">
                          После оплаты нажмите кнопку, чтобы получить адрес
                      </div>

                      <button class="button check-form--btn">Проверить оплату</button>
                  </form>
              </div><!-- /.check-form -->

              <div class="check-status">

              </div><!-- /.check-status -->
          </div>
      </section>
    <?php endwhile; endif; ?>
<?php get_footer(); ?>
