<?php
/**
 * サンプル
 * 投稿タイプ：content
 * 使用する場合は事例に応じてcontentの文字列を置換する
 */
add_action('init', function() {
    // 投稿権限
    $capabilities = array(
        'read_posts' => 'read_content',
        // 自分の投稿を編集する権限
        'edit_posts' => 'edit_content',
        // 他のユーザーの投稿を編集する権限
        'edit_others_posts' => 'edit_others_content',
        // 投稿を公開する権限
        'publish_posts' => 'publish_content',
        // プライベート投稿を閲覧する権限
        'read_private_posts' => 'read_private_content',
        // 自分の投稿を削除する権限
        'delete_posts' => 'delete_content',
        // プライベート投稿を削除する権限
        'delete_private_posts' => 'delete_private_content',
        // 公開済み投稿を削除する権限
        'delete_published_posts' => 'delete_published_content',
        // 他のユーザーの投稿を削除する権限
        'delete_others_posts' => 'delete_others_content',
        // プライベート投稿を編集する権限
        'edit_private_posts' => 'edit_private_content',
        // 公開済みの投稿を編集する権限
        'edit_published_posts' => 'edit_published_content',
    );
    // カスタム投稿タイプ設定
    register_post_type('content', array(
        // 管理画面上での表示
        'labels' => array(
            'name' => 'お役立ちコンテンツ',
            'singular_name' => 'お役立ちコンテンツ',
            'all_items' => 'お役立ちコンテンツ一覧',
            'edit_item' => 'お役立ちコンテンツの編集',
            'add_new_item' => 'お役立ちコンテンツを追加',
            'view_item' => 'お役立ちコンテンツを表示',
        ),
        'public' => true,
        'menu_position' => 4,
        'show_ui' => true,
        'publicly_queryable' => true,
        'rewrite' => array('slug' => 'content', 'with_front' => true),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'has_archive' => true,
        'capability_type' => 'content',
        'capabilities'    => $capabilities,
        'can_export' => true,
    ));
    // 権限の付与
    $role = get_role('administrator');
    foreach($capabilities as $cap) {
        $role->add_cap($cap);
    }
    // パーマリンク設定
    global $wp_rewrite;
    $wp_rewrite->add_rewrite_tag('%content_id%', '([^/]+)','post_type=content&p=');
    $wp_rewrite->add_permastruct('content', '/content/post/post-%content_id%', false);
});
/**
 * カスタムフィールド
 * 特殊な情報を保存したい場合は以下を追加
 * 以下サンプルでは「お役立ちコンテンツ」という項目を投稿から入力できるようにしている
 */
add_action('add_meta_boxes', function() {
    add_meta_box('content_info', 'お役立ちコンテンツ情報',  function() {
        $post_id = get_the_ID();
        wp_nonce_field(wp_create_nonce(__FILE__), 'my_nonce');
        echo '<p><label>所在地：<input type="text" name="content_address" size="60" value="'. esc_html(get_post_meta($post_id, 'content_address', true)).'" /></label>';
    }, 'content', 'normal', 'high');
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
    if($_POST['post_type'] === 'content'){
        isset($_POST['content_address']) && update_post_meta($post_id, 'content_address', $_POST['content_address']);
    }
});
