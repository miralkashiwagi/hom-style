<?php

// Include functions
require_once get_template_directory() . '/inc/scripts.php';
require_once get_template_directory() . '/inc/taxonomy.php';



function additional_theme_support()
{
//    add_theme_support("post-thumbnails");
    add_theme_support("html5", [
        "search-form",
        "comment-form",
        "comment-list",
        "gallery",
        "caption",
    ]);
    add_theme_support("title-tag");
}
add_action("after_setup_theme", "additional_theme_support");



function slug_auto_setting( $slug, $post_ID, $post_status, $post_type ) {
    // 記事IDからを記事情報を取得
    $post = get_post($post_ID);

    // 初回の記事保存時にのみ、記事のSlugを記事IDに設定
    if ( $post_type == 'post' && $post->post_date_gmt == '0000-00-00 00:00:00' ) {
        $slug = $post_type. "-" .$post_ID;
        return $slug;
    }

    return $slug;
}
add_filter( 'wp_unique_post_slug', 'slug_auto_setting', 10, 4 );


function set_post_default_template( $args, $post_type ) {
    // 投稿タイプが 'post' の場合のみ処理を実行
    if ( 'post' === $post_type ) {
        // デフォルトのブロックテンプレートとして lazyblock/recipe を1つ設定
        $args['template'] = [
            [ 'lazyblock/recipe'],
        ];
        // テンプレートロックを設定
        $args['template_lock'] = 'all'; // 'all' または 'insert'
    }
    return $args;
}

add_filter( 'register_post_type_args', 'set_post_default_template', 20, 2 );


/*
 * 投稿保存時に LazyBlockのmain-imageフィールドで投稿サムネイルを上書きする
 * */
//add_action("save_post", "handle_save_post_thumbnail", 5);
//
//function handle_save_post_thumbnail($post_id)
//{
//    // 引数の数に関係なく、最初の引数（post_id）のみを使用
//
//    // 投稿が存在するかチェック
//    $post = get_post($post_id);
//    if (!$post) {
//        return;
//    }
//
//    // ユーザーの権限チェック（管理画面からのリクエストの場合のみ）
//    if (is_admin() && !current_user_can("edit_post", $post_id)) {
//        return;
//    }
//
//    // スケジューリングを使用して処理を遅延実行
//    if (!wp_next_scheduled("set_thumbnail_delayed", [$post_id])) {
//        wp_schedule_single_event(time() + 1, "set_thumbnail_delayed", [
//            $post_id,
//        ]);
//    }
//}
//
//// カスタムイベントのハンドラー
//add_action("set_thumbnail_delayed", "set_thumbnail_by_meta");
//
//function set_thumbnail_by_meta($post_id)
//{
//    //プラグインの存在確認
//    if (!function_exists("get_lzb_meta")) {
//        return;
//    }
//
//    // 投稿が存在するかチェック
//    $post = get_post($post_id);
//    if (!$post) {
//        return;
//    }
//
//    // Lazy Blocksのメタデータを取得
//    $image_data = get_lzb_meta("main-image", $post_id);
//    // メタデータの存在確認
//    if (is_array($image_data) && isset($image_data["id"])) {
//        $image_id = $image_data["id"];
//        if ($image_id && is_numeric($image_id)) {
//            $result = set_post_thumbnail($post_id, $image_id);
//        }
//    }
//}
