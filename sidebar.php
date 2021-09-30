<div class="sidebar sidebar-1 four columns ">
  <div class="widget-area clearfix " style="min-height: 1020px;">
    <?php // カスタム投稿タイプの新着一覧を表示するサンプル?>
    <aside id="widget_mfn_recent_posts-2" class="widget widget_mfn_recent_posts">
      <h3>
        <i class="icon-videocam-line"></i> 導入事例一覧
      </h3>
      <div class="Recent_posts">
        <ul>
      <?php $posts = get_posts('posts_per_page=3&post_type=introduction&post_status=publish'); ?>
      <?php foreach($posts as $post): setup_postdata($post);?>
        <li class="post format-image">
          <a href="<?php the_permalink(); ?>">
            <div class="photo">
              <img width="80" height="80" src="<?php the_post_thumbnail_url('thumbnail')?>" class="scale-with-grid wp-post-image" alt="<?php the_title()?>">
            </div>
            <div class="desc">
              <h6><?php the_title()?></h6>
              <?php if($address = get_post_meta(get_the_ID(), 'introduction_address', true)):?>
              <span class="date"><i class="icon-map"></i><?php echo $address ?></span>
              <?php endif;?>
            </div>
          </a>
      <?php endforeach;wp_reset_postdata();?>

        </ul>
      </div>
    </aside>
    <?php // カテゴリ一覧を表示するサンプル ?>
    <aside id="categories-3" class="widget widget_categories">
      <h3>
        <i class="icon-archive"></i> カテゴリー
      </h3>
      <ul class="category-list">
       <?php
       wp_list_categories(array(
        'show_option_all' => '',
        'orderby' => 'count',
        'order' => 'desc',
        'title_li' => null,
        'taxonomy' => 'category'
       ) );
       ?>
      </ul>
    </aside>
    <?php // 新着の投稿を表示するサンプル?>
    <aside id="widget_mfn_recent_comments-2" class="widget widget_mfn_recent_comments">
      <h3>新着情報</h3>
      <div class="Recent_comments">
        <ul>
      <?php $posts = get_posts('posts_per_page=2&post_type=post&post_status=publish'); ?>
      <?php foreach($posts as $post): setup_postdata($post);?>
        <li>
          <span class="date_label"><?php the_time('Y年m月d日')?></span>
          <p><a href="<?php the_permalink(); ?>"><?php the_title()?></a></p>
      <?php endforeach;wp_reset_postdata();?>
        </ul>
      </div>
    </aside>
  </div>
</div>
