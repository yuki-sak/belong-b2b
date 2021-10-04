<?php get_header() ?>

<?php
  remove_filter('the_content','wpautop');
  if(have_posts()):
    while(have_posts()):
      the_post();
      the_content();
    endwhile;
  endif;
?>
<?php get_footer() ?>