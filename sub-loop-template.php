<!-- カスタム投稿タイプ Products の投稿を表示する場合 -->
<?php
  $args = array(
    'post_type' => 'Products', // 投稿タイプのスラッグを指定
    'post_type' => array('information','Products'), // 投稿タイプを複数指定
    'post_status' => 'publish', // 公開済の投稿を指定
    'posts_per_page' => 5 , // 投稿件数の指定 -1指定で全件表示となる
    'post__not_in' => array( 11,22,33,44,55 ), // 特定の記事を除く
    'post__not_in' => array($post->ID), // 現在表示している記事を除く
    'order' => 'ASC', // 昇順（最低から最高へ） DESCで降順


    // カスタム分類（タクソノミー） Products-cat のターム item1 別に絞り込む
    'tax_query' => array(
     array(
       'taxonomy' => 'Products-cat', // タクソノミースラッグを指定
       'field' => 'slug',
       'terms' => 'item1', // タームスラッグを指定
       'operator' => 'NOT IN', // 指定したタームを除外する
       )
     )
  );
  $the_query = new WP_Query($args); if($the_query->have_posts()):
?>
<?php while ($the_query->have_posts()): $the_query->the_post(); ?>
  <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php echo get_the_date(); ?>
  <?php the_permalink(); ?>
  <?php echo get_the_title(); ?>
  <?php the_content(); ?>
  </div>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>
<?php else: ?>
<!-- 投稿が無い場合の処理 -->
<?php endif; ?>



<!-- 表示している投稿と同じタームに分類されている投稿をランダムに表示する方法 -->
<!-- ただし、複数タームを選んでいる場合はできない -->
<?php
  $terms = get_the_terms($post->ID,'products-cat');
  foreach( $terms as $term ) {
    $term_slug = $term->slug; // 現在表示している投稿に属しているタームを取得
  }
  $args = array(
  'post_type' => 'Products', // カスタム投稿タイプ Products
  'post__not_in' => array($post->ID), // 現在表示している投稿を除外
  'posts_per_page' => 9, // 表示件数9件
  'orderby' =>  'rand', // ランダム
  'tax_query' => array( // タクソノミーの指定
    array(
      'taxonomy' => 'products-cat',
      'field' => 'slug',
      'terms' => $term_slug, // 取得したタームを指定
    ))
  ); $the_query = new WP_Query($args); if($the_query->have_posts()): ?>
<?php while ($the_query->have_posts()): $the_query->the_post(); ?>
<?php echo get_the_date(); ?>
<?php the_permalink(); ?>
<?php echo get_the_title(); ?>
<?php the_content(); ?>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>
<?php else: ?>
<!-- 投稿が無い場合の処理 -->
<?php endif; ?>



<!-- 投稿一覧に年の見出しを付ける方法 -->
<!-- 例えば、投稿タイプのスラッグが news の場合、投稿一覧に年毎の見出しを表示するには、次のコードを追加します。 -->
<?php
  $post_year = false; // 年の比較用変数の初期化
  // サブループの準備
  $args = array(
    'post_type' => 'news', // 投稿タイプのスラッグを指定
    'post_status' => 'publish', // 公開済の投稿を指定
    'posts_per_page' => -1, // 投稿件数の指定
    'order' => 'DESC', // 降順でソート
    'orderby'=>'date' // 日付で並べる
  );
  $the_query = new WP_Query($args); if($the_query->have_posts()):
?>
<?php while ($the_query->have_posts()): $the_query->the_post(); ?>
<?php // 年を表示、続く投稿が同一年なら表示をスルー
  if ( $post_year != get_post_time('Y') ) { // 比較の値と投稿年が異なる場合に年を表示
    echo '<h2>'.get_post_time('Y年').'</h2>'; //投稿の年を表示
  }
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php echo get_the_date(); ?>
<?php the_permalink(); ?>
<?php echo get_the_title(); ?>
<?php the_content(); ?>
</div>
<?php
  $post_year = get_post_time('Y'); // 年月の比較用の変数に今の投稿の年月を代入
  endwhile;
?>
<?php wp_reset_postdata(); ?>
<?php else: ?>
<!-- 投稿が無い場合の処理 -->
<?php endif; ?>



<!-- ページャー付きのサブループ -->
<?php
   $paged = get_query_var('paged') ? get_query_var('paged') : 1;
   $args = array(
     'posts_per_page' => 12,
     'paged' => $paged, //ページャーを作る場合に必要
     'post_type' => 'post',
     'tax_query' => array(
       array(
         'taxonomy' => 'taxonomy01',
         'field' => 'slug',
         'terms' => 'term02'
       )
     )
   );
   $the_query = new WP_Query( $args );
   $max_num_pages = $the_query->max_num_pages;
   if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
?>

〜 ループさせるコンテンツ 〜

<?php endwhile; ?>
<?php
   if (function_exists('pagination')) {
     $GLOBALS['wp_query']->max_num_pages = $the_query->max_num_pages;
     $max_num_pages = $the_query->max_num_pages;
     pagination($max_num_pages);
   }
?>
<?php wp_reset_postdata(); ?>
<?php else: ?>
<p>まだ投稿がありません</p>
<?php endif; ?>





<!-- サブループでページャーを表示 -->
<?php
  $paged = get_query_var('paged') ? get_query_var('paged') : 1;
  $args = array(
    'post_type' => array('post'),
    'post_status' => array('publish'),
    'order'=>'desc',
    'orderby'=>'post_date',
    'paged' => $paged,
    'posts_per_page' => 10
  );

  $query = new WP_Query($args);

  if ( $query->have_posts() ) :
  while ( $query->have_posts() ) : $query->the_post();

  //ここにループ内の処理

  endwhile;
  endif;
  wp_reset_postdata();

  $big = 999999999;

  echo paginate_links(array(
    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
    'show_all' => true,
    'type' => 'list',
    'format' => '?paged=%#%',
    'current' => max(1, get_query_var('paged')),
    'total' => $query->max_num_pages,
    'prev_text' => '前へ',
    'next_text' => '次へ',
  ));
?>


<!-- lib -->
<a href="<?php the_permalink() ?>"><!-- 記事ごとのリンク -->
<?php if(has_post_thumbnail()) { the_post_thumbnail(); } ?><!-- サムネイルがある場合のサムネイル表示 -->
<?php the_category('   '); ?><!-- カテゴリーの表示と表現の仕方 -->
<?php the_time("Y/m/d") ?><!-- 投稿日の表示と表現方法 -->
<?php echo wp_trim_words( get_the_title(), 40, '...' ); ?><!-- タイトルの取得と文字数制限、文字数制限を超えた場合の処理 -->
<?php the_content(); ?> <!-- 本文表示 -->
