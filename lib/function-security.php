<?php
/**
 * セキュリティ系の処理
 */
// wordpressバージョン情報の削除
remove_action( 'wp_head', 'wp_generator' );
// xmlrpc削除
//add_filter( 'xmlrpc_enabled', '__return_false' );
// ピンバックヘッダの削除
// add_filter( 'wp_headers', function ( $headers ) {
//     unset( $headers['X-Pingback'] );
//     return $headers;
// });