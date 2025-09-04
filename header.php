<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="<?php echo get_theme_file_uri(); ?>/assets/images/favicon.ico" sizes="48x48"
          type="image/x-icon">
    <link rel="icon" href="<?php echo get_theme_file_uri(); ?>/assets/images/favicon.svg" sizes="any"
          type="image/svg+xml">
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

    // トップページ以外で、かつアイキャッチがある場合のみサムネイル画像を使用
    if (!is_front_page() && !is_home() && has_post_thumbnail()) {
        $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), "large");
        if ($thumbnail_url) {
            $og_image = $thumbnail_url;
        }
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap"  rel="preload" as="style">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap"  rel="stylesheet" media="print" onload="this.media='all'">
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="bg-gray-bg leading-[1.5]">
    <header class="js-drawer-header bg-white sticky top-0 z-50">
        <div class="flex justify-between items-center px-lg py-xl ">
            <h1 class="nonexistent-class">
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
                       group-aria-[expanded=true]:before:top-0 group-aria-[expanded=true]:before:rotate-45
                       after:absolute after:top-[7px] after:block after:h-full after:w-full after:rounded-md after:bg-black after:transition-all after:duration-300 after:ease-in-out after:content-['']
                       group-aria-[expanded=true]:after:top-0 group-aria-[expanded=true]:after:-rotate-45">
            <span class="sr-only">
              メニューを開閉する
            </span>
          </span>
            </button>
        </div>
    </header>
    <dialog id="drawer" class="js-drawer-dialog w-full h-full max-w-full max-h-full bg-white">
        <nav aria-label="メインメニュー">
            <?php wp_nav_menu([
                    "theme_location" => "main-menu",
                    "link_before" => "<span>",
                    "link_after" => "</span>",
            ]); ?>
            <div id="search"><?php get_search_form(); ?></div>
        </nav>
    </dialog>
    <div class="">
        <main  class="max-w-[400px] mx-auto bg-white px-[26px] py-xl">