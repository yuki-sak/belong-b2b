<?php

// カスタム投稿タイプのリンク生成時処理
// エラーとなる場合は適宜削除
add_filter('post_type_link', function($post_link, $id = 0, $leavename) {
    global $wp_rewrite;
    $post = get_post($id);
    if (is_wp_error($post))
        return $post;
    $newlink = $wp_rewrite->get_extra_permastruct($post->post_type);
    $newlink = str_replace('%'.$post->post_type.'_postname%', $post->post_name, $newlink);
    $newlink = str_replace('%'.$post->post_type.'_id%', $post->ID, $newlink);
    $newlink = home_url(user_trailingslashit($newlink));
    return $newlink;
}, 1, 3);

// ユーザJS・CSS入力欄追加
add_action('add_meta_boxes', function() {
    add_meta_box('static_script', 'ページ用JS/CSS',  function() {
        $post_id = get_the_ID();
        wp_nonce_field(wp_create_nonce(__FILE__), 'my_nonce');
        echo '<p><label>JS：<textarea name="user_script" style="width: 100%;" rows="7" />'. esc_html(get_post_meta($post_id, 'user_script', true)).'</textarea></label>';
        echo '<p><label>CSS：<textarea name="user_style"  style="width: 100%;" rows="7" />'. esc_html(get_post_meta($post_id, 'user_style', true)).'</textarea></label>';
    }, get_post_types(), 'normal', 'high');
});
add_action('save_post', function($post_id) {
    $my_nonce = isset($_POST['my_nonce']) ? $_POST['my_nonce'] : null;
    if(
    !wp_verify_nonce($my_nonce, wp_create_nonce(__FILE__))
    || (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
    || !current_user_can('edit_post', $post_id)
    ) {
        return $post_id;
    }
    isset($_POST['user_script']) && update_post_meta($post_id, 'user_script', $_POST['user_script']);
    isset($_POST['user_style']) && update_post_meta($post_id, 'user_style', $_POST['user_style']);
});
add_action('wp_footer', function() {
    global $post;
    if(!empty($post)) {
        $script = get_post_meta($post->ID, 'user_script', true);
        if(!empty($script)) {
            echo $script;
        }
    }
}, 99);
add_action('wp_head', function() {
    global $post;
    if(!empty($post)) {
        $style = get_post_meta($post->ID, 'user_style', true);
        if(!empty($style)) {
            echo $style;
        }
    }
}, 99);
// 投稿以外はpタグ,brタグを無効化
add_filter('the_content', function($content) {
    global $post;
    $post_type = get_post_type( $post->ID );
    if (!in_array($post_type, array('post'))) {
        remove_filter('the_content', 'wpautop');
        remove_filter('the_excerpt', 'wpautop');
    }
    return $content;
}, 9);

function my_remove_menus() {
remove_menu_page('edit.php');
}
add_action('admin_menu', 'my_remove_menus');
