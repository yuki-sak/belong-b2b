<?php
/**
 * サンプル
 * 投稿タイプ：leasing
 * 使用する場合は事例に応じてleasingの文字列を置換する
 */
add_action('init', function() {
    // 投稿権限
    $capabilities = array(
        'read_posts' => 'read_leasing',
        // 自分の投稿を編集する権限
        'edit_posts' => 'edit_leasing',
        // 他のユーザーの投稿を編集する権限
        'edit_others_posts' => 'edit_others_leasing',
        // 投稿を公開する権限
        'publish_posts' => 'publish_leasing',
        // プライベート投稿を閲覧する権限
        'read_private_posts' => 'read_private_leasing',
        // 自分の投稿を削除する権限
        'delete_posts' => 'delete_leasing',
        // プライベート投稿を削除する権限
        'delete_private_posts' => 'delete_private_leasing',
        // 公開済み投稿を削除する権限
        'delete_published_posts' => 'delete_published_leasing',
        // 他のユーザーの投稿を削除する権限
        'delete_others_posts' => 'delete_others_leasing',
        // プライベート投稿を編集する権限
        'edit_private_posts' => 'edit_private_leasing',
        // 公開済みの投稿を編集する権限
        'edit_published_posts' => 'edit_published_leasing',
    );
    // カスタム投稿タイプ設定
    register_post_type('leasing', array(
        // 管理画面上での表示
        'labels' => array(
            'name' => 'リースプラン',
            'singular_name' => 'リースプラン',
            'all_items' => 'リースプラン一覧',
            'edit_item' => 'リースプランの編集',
            'add_new_item' => 'リースプランを追加',
            'view_item' => 'リースプランを表示',
        ),
        'public' => true,
        'menu_position' => 4,
        'show_ui' => true,
        'publicly_queryable' => true,
        'rewrite' => array('slug' => 'leasing', 'with_front' => true),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'has_archive' => true,
        'capability_type' => 'leasing',
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
    $wp_rewrite->add_rewrite_tag('%leasing_id%', '([^/]+)','post_type=leasing&p=');
    $wp_rewrite->add_permastruct('leasing', '/leasing/post/post-%leasing_id%', false);
});
/**
 * カスタムフィールド
 * 特殊な情報を保存したい場合は以下を追加
 * 以下サンプルでは「リースプラン」という項目を投稿から入力できるようにしている
 */
add_action('add_meta_boxes', function() {
    add_meta_box('leasing_info', 'リースプラン情報',  function() {
        $post_id = get_the_ID();
        wp_nonce_field(wp_create_nonce(__FILE__), 'my_nonce');
        echo '<p><label>所在地：<input type="text" name="leasing_address" size="60" value="'. esc_html(get_post_meta($post_id, 'leasing_address', true)).'" /></label>';
    }, 'leasing', 'normal', 'high');
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
    if($_POST['post_type'] === 'leasing'){
        isset($_POST['leasing_address']) && update_post_meta($post_id, 'leasing_address', $_POST['leasing_address']);
    }
});
