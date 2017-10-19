<?php get_header(); ?>
  <section class="index">
    <div class="products">
      <h1 class="cat-title inner-title"><?php the_category(', '); ?></h1>

      <?php get_template_part('loop'); ?>

    </div>
  </section>
<?php get_footer(); ?>
