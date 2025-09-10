<?php

/**
 * Taxonomy related functions
 */


function register_my_taxes_category_color() {

    /**
     * Taxonomy: 色カテゴリー.
     */

    $labels = [
        "name" => esc_html( "色カテゴリー"),
        "singular_name" => esc_html( "色カテゴリー"),
    ];


    $args = [
        "label" => esc_html( "色カテゴリー"),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => [ 'slug' => 'category/color', 'with_front' => false, ],
        "show_admin_column" => true,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "category_color",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "rest_namespace" => "wp/v2",
        "show_in_quick_edit" => true,
        "sort" => true,
        "show_in_graphql" => false,
        "default_term" => false,
    ];
    register_taxonomy( "category_color", [ "post" ], $args );
}
add_action( 'init', 'register_my_taxes_category_color' );



function register_my_taxes_category_style() {

    /**
     * Taxonomy: スタイルカテゴリー.
     */

    $labels = [
        "name" => esc_html( "スタイルカテゴリー"),
        "singular_name" => esc_html( "スタイルカテゴリー"),
    ];


    $args = [
        "label" => esc_html( "スタイルカテゴリー"),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => [ 'slug' => 'category/style', 'with_front' => false, ],
        "show_admin_column" => true,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "category_style",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "rest_namespace" => "wp/v2",
        "show_in_quick_edit" => true,
        "sort" => true,
        "show_in_graphql" => false,
        "default_term" => false,
    ];
    register_taxonomy( "category_style", [ "post" ], $args );
}
add_action( 'init', 'register_my_taxes_category_style' );

add_action( 'add_meta_boxes', function() {
    add_meta_box(
        'category_stylediv',          // ID
        'スタイルカテゴリー',           // タイトル
        'post_categories_meta_box',   // 階層型タクソノミー用のコールバック
        'post',                       // 投稿タイプ
        'normal',                     // 表示位置（本文下）
        'default',                    // 優先度
        [ 'taxonomy' => 'category_style' ] // ← これを指定しないと表示されない！
    );
    add_meta_box(
        'category_colordiv',          // ID
        '色カテゴリー',           // タイトル
        'post_categories_meta_box',   // 階層型タクソノミー用のコールバック
        'post',                       // 投稿タイプ
        'normal',                     // 表示位置（本文下）
        'default',                    // 優先度
        [ 'taxonomy' => 'category_color' ] // ← これを指定しないと表示されない！
    );
});
add_action( 'enqueue_block_editor_assets', function() {
    wp_enqueue_script(
        'hide-category-style-panel',
        get_theme_file_uri() . '/assets/js/editor.js',
        [ 'wp-data', 'wp-edit-post' ],
        false,
        true
    );
});
add_action( 'admin_enqueue_scripts', function( $hook ) {
    if ( $hook === 'post.php' || $hook === 'post-new.php' ) {
        wp_enqueue_script( 'post' ); // 投稿画面用スクリプト
        wp_enqueue_script( 'postbox' );
        wp_enqueue_script( 'wp-lists' );
    }
});

function unregister_taxonomy_post_tag(){
    register_taxonomy('post_tag', array());
    register_taxonomy('category', array());
}
add_action('init', 'unregister_taxonomy_post_tag');