<?php get_header(); ?>
    <?php if (have_posts()): while (have_posts()) : the_post(); ?>
      <section class="check pager">
          <div class="wraper">
            <h1 class="page-title inner-title"><?php the_title(); ?></h1>
            <?php the_content(); ?>
            <?php edit_post_link(); ?>
          </div>
      </section>
    <?php endwhile; endif; ?>
<?php get_footer(); ?>
