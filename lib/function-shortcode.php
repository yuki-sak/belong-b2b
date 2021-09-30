<?php
/**
 * ショートコード管理
 * 投稿ページや固定ページ上でwordpressの関数を使用する
 */

/**
 * テーマディレクトリのパス
 * @example <img src="[themedir]/img/hoge.jpg" alt="hoge">
 */
add_shortcode('themedir', function() {
    return get_template_directory_uri();
});
/**
 * サイトのURL
 * @example <a href="[wpurl]">トップへもどる</a>
 */
add_shortcode('wpurl', function() {
    return site_url();
});
