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

function tailwind_posts_pagination() {
    $pages = paginate_links( array(
        'type' => 'array', // リンクを配列として取得
        'prev_text' => 'chevron_left',
        'next_text' => 'chevron_right',
    ) );

    if ( is_array( $pages ) ) {
        // nextボタンとprevボタンの存在をチェック
        $has_next = false;
        $has_prev = false;
        foreach ( $pages as $page ) {
            if ( strpos( $page, 'class="next page-numbers"' ) !== false ) {
                $has_next = true;
            }
            if ( strpos( $page, 'class="prev page-numbers"' ) !== false ) {
                $has_prev = true;
            }
        }

        $modified_pages = array();

        foreach ( $pages as $page ) {
            // prevボタンのclass属性を書き換え（非活性状態）
            $modified_page = str_replace(
                'class="prev page-numbers"',
                'class="w-full h-[44px] grid place-items-center border-[2px] border-gray-bg bg-gray-bg text-black rounded-full font-icon"',
                $page
            );

            // nextボタンのclass属性を書き換え
            $modified_page = str_replace(
                'class="next page-numbers"',
                'class="w-full h-[44px] grid place-items-center border-[2px] border-gray-bg bg-gray-bg text-black rounded-full font-icon"',
                $modified_page
            );

            // 通常のページリンクのclass属性を書き換え
            $modified_page = str_replace(
                'class="page-numbers"',
                'class="w-[44px] h-[44px] grid place-items-center border-[2px] border-gray-bg bg-gray-bg text-black font-en rounded-full hover:border-gray-text transition-colors"',
                $modified_page
            );

            // currentページのclass属性を書き換え
            $modified_page = str_replace(
                'class="page-numbers current"',
                'class="w-[44px] h-[44px] grid place-items-center border-[2px] border-gray-text bg-transparent text-black font-en rounded-full"',
                $modified_page
            );

            // dotsのclass属性を書き換え
            $modified_page = str_replace(
                'class="page-numbers dots"',
                'class="w-[44px] h-[44px] grid place-items-center text-black"',
                $modified_page
            );

            $modified_pages[] = $modified_page;
        }

        // nextが存在するが、prevが存在しない場合は非活性なprevボタンを追加
        if ( $has_next && !$has_prev ) {
            $disabled_prev = '<span class="opacity-40 w-full h-[44px] grid place-items-center border-[2px] border-gray-bg bg-gray-bg text-black rounded-full font-icon">chevron_left</span>';
            array_unshift( $modified_pages, $disabled_prev );
        }
        //prevが存在するが、nextが存在しない場合は非活性なnextボタンを追加
        if ( !$has_next && $has_prev ) {
            $disabled_next = '<span class="opacity-40 w-full h-[44px] grid place-items-center border-[2px] border-gray-bg bg-gray-bg text-black rounded-full font-icon">chevron_right</span>';
            array_push( $modified_pages, $disabled_next );
        }

        if ( ! empty( $modified_pages ) ) {
            echo '<nav aria-label="ページネーション" class="pt-3xl">';
            echo '<ul class="flex items-center justify-center gap-xs flex-wrap">';
            foreach ( $modified_pages as $page ) {
                if( strpos( $page, 'chevron_left' ) !== false ){

                    echo '<li class="order-1 w-[calc(50%-6px)] mb-md">' . $page . '</li>';
                    continue;
                }
                if( strpos( $page, 'chevron_right' ) !== false ){

                    echo '<li class="order-2 w-[calc(50%-6px)] mb-md">' . $page . '</li>';
                    continue;
                }
                echo '<li class="order-3">' . $page . '</li>';
            }
            echo '</ul>';
            echo '</nav>';
        }
    }
}