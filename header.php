<!DOCTYPE html>
<html lang="ja" class="[scrollbar-gutter:stable]">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="<?php echo get_theme_file_uri(); ?>/assets/images/favicon.ico" sizes="48x48"
          type="image/x-icon">
    <link rel="icon" href="<?php echo get_theme_file_uri(); ?>/assets/images/favicon.svg" sizes="any"
          type="image/svg+xml">
    <link rel="apple-touch-icon" href="<?php echo get_theme_file_uri(); ?>/assets/images/apple-touch-icon.png">
    <meta name="viewport" content="width=device-width">
    <?php
    // OGP設定
    $site_title = get_bloginfo("name");
    $page_title = wp_get_document_title();
    $canonical_url =
            is_front_page() || is_home() ? home_url("/") : wp_get_canonical_url();

    // og:type の判定
    $og_type = is_front_page() || is_home() ? "website" : "article";

    // og:description の生成
    if ((is_single() || is_page()) && !is_front_page() && !is_home()) {
        // 個別投稿・固定ページ（トップページではない）
        $page_name = get_the_title();
        $og_description =
                $site_title . "の「" . $page_name . "」のページです。";
    } else {
        // トップページまたはその他のページ
        $og_description = get_bloginfo("description");
    }

    // og:image の設定
    $og_image = get_theme_file_uri() . "/assets/images/ogp.png"; // デフォルト画像

    // 記事ページで　wp_get_attachment_image_url(get_lzb_meta("main-image")['id'], "full")　が取得できれば og_image上書き
    if (is_single() && get_lzb_meta("main-image")['id']) {
        $og_image = wp_get_attachment_image_url(get_lzb_meta("main-image")['id'], "full");
    }
    ?>
    <meta property="og:url" content="<?php echo esc_url($canonical_url); ?>">
    <meta property="og:type" content="<?php echo esc_attr($og_type); ?>">
    <meta property="og:title" content="<?php echo esc_attr($page_title); ?>">
    <meta property="og:description" content="<?php echo esc_attr(
            $og_description,
    ); ?>">
    <meta property="og:site_name" content="<?php echo esc_attr(
            $site_title,
    ); ?>">
    <meta property="og:image" content="<?php echo esc_url($og_image); ?>">
    <?php wp_head(); ?>
    <meta name="description" content="<?php echo esc_attr($og_description); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap"
          rel="preload" as="style">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap"
          rel="stylesheet" media="print" onload="this.media='all'">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="preload" as="style">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" media="print"
          onload="this.media='all'">
</head>
<body <?php body_class("bg-gray-bg  has-open:overflow-hidden"); ?>>
<?php wp_body_open(); ?>
<div class="bg-gray-bg leading-heading">
    <header class="js-drawer-header bg-white sticky top-0 z-50">
        <div class="flex justify-between items-center px-lg py-xl max-w-[400px] mx-auto">
            <h1 class="">
                <a href="<?php echo home_url(); ?>">
                    <img src="<?php echo get_theme_file_uri(); ?>/assets/images/logo.svg" alt="Hom Style" width="166"
                         height="33">
                </a>
            </h1>
            <button type="button"
                    class="js-drawer-toggle group relative inline-block h-[44px] w-[64px] cursor-pointer appearance-none rounded-md border-[2px] border-black bg-transparent"
                    aria-expanded="false" aria-controls="drawer">
              <span class="absolute inset-0 m-auto h-[2px] w-[32px] rounded-md bg-black transition-all duration-300 ease-in-out
                           group-aria-[expanded=true]:bg-transparent
                           before:absolute before:-top-[7px] before:block before:h-full before:w-full before:rounded-md before:bg-black before:transition-all before:duration-300 before:ease-in-out before:content-['']
                           group-aria-[expanded=true]:before:top-0 group-aria-[expanded=true]:before:rotate-25 starting:group-aria-[expanded=true]:before:-rotate-0
                           after:absolute after:top-[7px] after:block after:h-full after:w-full after:rounded-md after:bg-black after:transition-all after:duration-300 after:ease-in-out after:content-['']
                           group-aria-[expanded=true]:after:top-0 group-aria-[expanded=true]:after:-rotate-25 starting:group-aria-[expanded=true]:after:-rotate-0">
                <span class="sr-only">
                  メニューを開閉する
                </span>
              </span>
            </button>
        </div>
    </header>
    <dialog id="drawer" class="js-drawer-dialog w-full overflow-hidden h-full max-w-full max-h-full bg-gray-bg group transition-discrete [transition-property:display,opacity] duration-200 opacity-0 open:opacity-100 starting:open:opacity-0 backdrop:bg-transparent z-50">
        <nav aria-label="メインメニュー" class="max-w-[400px] overflow-auto h-[calc(100%-92px)] mx-auto px-[26px] pt-xl pb-3xl bg-white group-open:translate-0 starting:group-open:-translate-y-2 transition-transform duration-200">
            <?php wp_nav_menu([
                    "theme_location" => "main-menu",
                    "link_before" => "<span>",
                    "link_after" => "</span>",
            ]); ?>
            <div class="">
                <h3 class="font-en text-xl mb-2xs">Text Search</h3>
                <form action="<?php echo home_url()?>">
                    <div class="grid grid-cols-[1fr_auto] items-center gap-2xs w-full rounded-full border-[1px] border-black">
                        <input type="search" name="s" value="<?php echo get_search_query()?>" class="px-md py-sm rounded-l-full">
                        <button type="submit" class="h-[46px] w-[46px] font-icon">search</button>
                    </div>
                </form>
            </div>
            <div class="mt-xl">
                <h3 class="font-en text-xl mb-2xs">Color</h3>
                <?php $color_terms = get_terms("category_color"); ?>
                <?php if (!empty($color_terms)): ?>
                    <ul class="flex flex-wrap gap-sm">
                        <?php foreach ($color_terms as $color_term): ?>
                            <li>
                                <a href="<?php echo get_term_link($color_term->term_id); ?>"
                                   class="block rounded-full bg-gray-bg px-md min-w-[56px] text-center py-sm"><?php echo $color_term->name; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
            <div class="mt-xl">
                <h3 class="font-en text-xl mb-2xs">Style</h3>
                <?php $style_terms = get_terms("category_style"); ?>
                <?php if (!empty($style_terms)): ?>
                    <ul class="flex flex-wrap gap-sm">
                        <?php foreach ($style_terms as $style_term): ?>
                            <li>
                                <a href="<?php echo get_term_link($style_term->term_id); ?>"
                                   class="block rounded-full bg-gray-bg px-md min-w-[56px] text-center py-sm"><?php echo $style_term->name; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
            <div class="mt-xl">
                <h3 class="font-en text-xl mb-2xs">Author</h3>
                <?php //投稿を持っているユーザーの一覧
                    $author_ids = get_users(
                            [
                                    "has_published_posts" => true
                            ]
                    );
                ?>
                <?php if (!empty($author_ids)): ?>
                    <ul class="flex flex-wrap gap-sm">
                        <?php foreach ($author_ids as $author_id): ?>
                            <li>
                                <a href="<?php echo get_author_posts_url($author_id->ID); ?>"
                                   class="block rounded-full bg-gray-bg px-md py-sm"><?php echo $author_id->display_name; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </nav>
    </dialog>
    <div class="">
        <main class="max-w-[400px] mx-auto bg-white px-[26px] py-xl">