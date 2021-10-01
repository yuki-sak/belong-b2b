<?php
add_theme_support( 'post-thumbnails' );
// Util関数
include 'lib/function-util.php';
// ナビ設定
include 'lib/function-nav.php';
// セキュリティ対策
include 'lib/function-security.php';
// 静的リソースの読み込み
include 'lib/function-assets.php';
// ページネーション周りの処理
include 'lib/function-pagination.php';
// ショートコード設定
include 'lib/function-shortcode.php';
// emoji無効化
include 'lib/function-disabled-emoji.php';
// 投稿設定
include 'lib/function-postsetting.php';
// カスタム投稿タイプ introduction(サンプル)
include 'lib/posttype-content.php';
include 'lib/posttype-leasing.php';

/*
* 固定ページでwordpress-loopをincludeする
*/
function Include_my_php($params = array()) {
    extract(shortcode_atts(array(
        'file' => 'default'
    ), $params));
    ob_start();
    include(get_theme_root() . '/' . get_template() . "/$file.php");
    return ob_get_clean();
}
add_shortcode('myphp', 'Include_my_php');


// To Delete tags
remove_action( 'wp_head', 'feed_links', 2 ); //サイト全体のフィード
remove_action( 'wp_head', 'feed_links_extra', 3 ); //その他のフィード
remove_action( 'wp_head', 'rsd_link' ); //Really Simple Discoveryリンク
remove_action( 'wp_head', 'wlwmanifest_link' ); //Windows Live Writerリンク
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); //前後の記事リンク
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 ); //ショートリンク
// remove_action( 'wp_head', 'rel_canonical' ); //canonical属性
remove_action( 'wp_head', 'wp_generator' ); //WPバージョン



/* ======================================================================
 高速化
====================================================================== */

function replace_jquery() {
    if (!is_admin()) {
      // comment out the next two lines to load the local copy of jQuery
      wp_deregister_script('jquery');
    }
  }
  add_action('init', 'replace_jquery');
  function move_scripts() {
    remove_action('wp_head', 'wp_print_scripts');
    remove_action('wp_head', 'wp_print_head_scripts', 9);
    remove_action('wp_head', 'wp_enqueue_scripts', 1);
    add_action('wp_footer', 'wp_print_scripts', 5);
    add_action('wp_footer', 'wp_print_head_scripts', 5);
    add_action('wp_footer', 'wp_enqueue_scripts', 5);
  }
  remove_action('wp_head','rest_output_link_wp_head');
  remove_action('wp_head','wp_oembed_add_discovery_links');
  remove_action('wp_head','wp_oembed_add_host_js');
  add_action( 'wp_enqueue_scripts', 'move_scripts' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'wp_print_styles', 'print_emoji_styles', 10 );
  
  add_filter( 'wp_resource_hints', 'remove_dns_prefetch', 10, 2 );
  function remove_dns_prefetch( $hints, $relation_type ) {
      if ( 'dns-prefetch' === $relation_type ) {
          return array_diff( wp_dependencies_unique_hosts(), $hints );
      }
      return $hints;
  }
/* ======================================================================
 wp block library cssを削除
 （Gutenbergを使用する場合はコメントアウトすること）
====================================================================== */

add_action('wp_enqueue_scripts', 'remove_block_library_style');
function remove_block_library_style() {
  wp_dequeue_style('wp-block-library');
  wp_dequeue_style('wp-block-library-theme');
}

// 定数定義
define('TEMP_DIR', esc_url( get_template_directory_uri() ));

// imgディレクトリまでのパスを取得
function img_path() {
  echo TEMP_DIR.'/assets/img';
}


/**
 * 送信完了後に完了ページへ遷移
 */
function my_mwform_after_send( $Data )
{
    $form_key = $Data->get_form_key();
    if ( $form_key === 'mw-wp-form-61' ) {
        //問い合わせフォーム
        wp_redirect('/lp/complete/');
        exit;
    }
}
add_action( 'mwform_after_send_mw-wp-form-123', 'my_mwform_after_send' );

// 親テーマのテーマフォルダのパスを取得するショートコード
function getimgurl($atts, $content = null) {
  return get_template_directory_uri().'/assets/img';
}
add_shortcode('imgurl', 'getimgurl');