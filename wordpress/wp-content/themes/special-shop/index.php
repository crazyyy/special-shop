<?php get_header(); ?>
  <section class="index">
    <div class="products">

      <?php get_template_part('loop'); ?>
      <?php get_template_part('pagination'); ?>

    </div>
  </section>
<?php get_footer(); ?>
