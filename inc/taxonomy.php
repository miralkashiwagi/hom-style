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
        "default_term" => ['name' => 'uncategorized'],
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
        "default_term" => ['name' => 'uncategorized'],
    ];
    register_taxonomy( "category_style", [ "post" ], $args );
}
add_action( 'init', 'register_my_taxes_category_style' );




function unregister_taxonomy_post_tag(){
    register_taxonomy('post_tag', array());
    register_taxonomy('category', array());
}
add_action('init', 'unregister_taxonomy_post_tag');