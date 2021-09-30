<?php
//固定ページにブログを投稿するショートコードを作成
$paged = get_query_var('paged', 1);
$sticky = get_option( 'sticky_posts' );
$query = new WP_Query(
    array(
        'paged' => $paged,
        'posts_per_page' => 6, //表示件数
        // 'post__not_in' => $sticky, //固定表示を無視する場合
        'post_type' => 'post', //カテゴリーの指定
        //'post_type' => array('post',`post2`), //カテゴリーの指定が複数
    )
);
?>
<?php if ( $query->have_posts() ) : ?>
 <?php while ( $query->have_posts() ) : $query->the_post();?>
  <div class="item post grid-sizer col-md-6 col-lg-4" style="position: absolute; left: 33.3333%; top: 0px;">
  	<div class="box bg-white shadow p-30">
  		<figure class="main mb-30 overlay overlay1 rounded"><a href="<?php the_permalink() ?>"><?php if(has_post_thumbnail()) { the_post_thumbnail(); } ?></a>
  	      <figcaption>
  	        <h5 class="text-uppercase from-top mb-0">Read More</h5>
  	      </figcaption>
  	    </figure>
  		<div class="meta mb-10 flexbox"><span class="category"><?php the_category('   '); ?></span><span class="date"><?php the_time("Y/m/d") ?></span></div>
  		<hr>
  		<div class="article-content">
  			<header class="entry-header">
  				<h2 class="post-title"><a href="<?php the_permalink() ?>"><?php echo wp_trim_words( get_the_title(), 40, '...' ); ?></a></h2>
  			</header>
  		</div><!-- article-container -->
  	</div><!-- box -->
  </div>
  <?php endwhile; ?>
  <?php else : ?>
  <p>現在表示する記事はありません</p>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
