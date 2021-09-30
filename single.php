<?php get_header() ?>

<div id="main">
  <main role="main">
    <section class="singleContent">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <p><?php the_content(); ?></p>
      <?php endwhile; else : ?>
      <?php endif; ?>
    </section>
    <?php get_template_part('elements/contact'); ?>
  </main>
  <!-- /main -->
</div>
<!-- /#main -->
<?php get_sidebar(); ?>
<?php get_footer() ?>
