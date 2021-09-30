<?php
/*
 * Template Name: LP
 */
get_header('lp'); ?>
<?php
  remove_filter('the_content','wpautop');
  if(have_posts()):
    while(have_posts()):
      the_post();
      the_content();
    endwhile;
  endif;
?>

<?php get_footer('lp'); ?>
