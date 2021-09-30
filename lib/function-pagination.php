<?php
/**
 * ページネーション系
 */

if(!function_exists('spice_pagination')):
  /**
   * ページネーションのリンクを作成します。
   * @todo HTML直したい
   * @param  string  $pages 全ページ数
   * @param  integer $range 範囲
   * @return string
   * @example <?php echo spice_pagination(); ?>
   */
  function spice_pagination($pages='', $range=2) {
    //表示するページ数
    $showitems=($range*2)+1;
    //現在のページ値
    global $paged;
    //デフォルトのページ
    if(empty($paged)) $paged = 1;
    if($pages == '')
    {
      global $wp_query;
      $pages = $wp_query->max_num_pages;
      //全ページ数が空の場合は1とする
      if(!$pages)
      {
        $pages=1;
      }
    }
    //全ページが1でない場合はページネーションを表示する
    if(1 != $pages)
    {
      //Prev：現在のページ値が1より大きい場合は表示
      if($paged > 1) echo "<a class=\"previouspostslink\" rel=\"prev\" href='".get_pagenum_link($paged - 1)."'><i class=\"fa fa-chevron-left\" aria-hidden=\"true\"></i></a>\n";
      for ($i=1; $i <= $pages; $i++)
      {
        if(1 != $pages &&(!($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems))
        {
          echo ($paged == $i)? "<a class=\"current\" href='".get_pagenum_link($i)."'>".$i."</a>\n":"<a class=\"page\" href='".get_pagenum_link($i)."'>".$i."</a>\n";
        }
      }

      if ($paged < $pages) echo "<a class=\"nextpostslink\" rel=\"next\" href=\"".get_pagenum_link($paged + 1)."\"><i class=\"fa fa-chevron-right\" aria-hidden=\"true\"></i></a>\n";
    }
  }
endif;
