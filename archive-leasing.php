<?php
/**
 * 一覧(サンプル)
 */
?>
<?php get_header(); ?>
<div class="section">
  <div class="section_wrapper clearfix">
    <div class="column one column_blog">
      <div class="blog_wrapper isotope_wrapper">
        <div class="posts_group lm_wrapper classic">

        <?php while(have_posts()): the_post(); ?>
          <div id="post-<?php the_ID(); ?>" class="post-<?php the_ID(); ?> post type-post status-publish format-standard has-post-thumbnail hentry category-motion category-photography category-uncategorized tag-eclipse tag-grid tag-mysql post-item isotope-item clearfix author-admin">
            <div class="image_frame post-photo-wrapper scale-with-grid">
              <div class="image_wrapper">
                <a href="<?php the_permalink() ?>">
                  <div class="mask"></div>
                  <img width="576" height="450" src="<?php the_post_thumbnail_url()?>" class="scale-with-grid wp-post-image" alt="<?php the_title(); ?>">
                </a>
              </div>
            </div>
            <div class="post-desc-wrapper">
              <div class="post-desc">
                <div class="post-title">
                  <h3 class="entry-title">
                    <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                  </h3>
                </div>
                <div class="post-excerpt">
                  <span class="big"><?php the_excerpt(); ?></span>
                </div>
                <div class="post-footer">
                  <div class="post-links">
                    <a href="<?php the_permalink() ?>" class="post-more">詳しく見る</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php endwhile; ?>
          <?php echo spice_pagination(); // ページング ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>
