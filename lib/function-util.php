<?php
/**
 * 独自の便利関数をここに書いていく
 */
 
/**
 * テーマのファイルパスを取得します。
 * @param  string $path テーマディレクトリ内でのパス
 * @return string /wp-content/themes/spice-base/img/dir/hoge.jpg
 * @example <?php echo spice_get_img_url('dir/hoge.jpg'); ?>
 */
function spice_get_img_url($path) {
  return get_template_directory_uri(). "/img/{$path}";
}

// 親テーマのテーマフォルダのパスを取得するショートコード
function gettmplurl($atts, $content = null) {
  return get_template_directory_uri();
}
add_shortcode('tmplurl', 'gettmplurl');
    
// メディアフォルダのパスを取得するショートコード
function getmediaurl($atts, $content = null) {
  $wp_upload_dir = wp_upload_dir();
  return $wp_upload_dir['baseurl'];
}
add_shortcode('mediaurl', 'getmediaurl');

// wysiwygテキストエディタのボタン削除（メニューページ内）
function remove_html_editor_buttons( $qt_init) {
  global $pagenow;
  if($pagenow === 'nav-menus.php') {
    $qt_init['buttons'] = ',';
  }
    return $qt_init;
}
add_filter( 'quicktags_settings', 'remove_html_editor_buttons' );
  
  
// プラグインのデフォルトcssをオフに
add_action( 'wp_enqueue_scripts', 'denqueue_my_scripts', 11 );
function denqueue_my_scripts() {
  $remove_styles = array( 'mw-wp-form' );

  foreach( $remove_styles as $target ) {
      if( wp_style_is($target) ) {
          wp_deregister_style($target);
      }
  }
}