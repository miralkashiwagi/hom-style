<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div>
    <header>
        <div id="logo">
            <div>
                <?php
                if ( is_front_page() || is_home() || is_front_page() && is_home() ) { echo '<h1>'; }
                echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>';
                if ( is_front_page() || is_home() || is_front_page() && is_home() ) { echo '</h1>'; }
                ?>
            </div>
        </div>
        <button type="button" class="js-drawer-toggle" aria-expanded="false" aria-controls="drawer">
            メニュー開閉
        </button>
        <dialog id="drawer" class="js-drawer-dialog">
            <nav aria-label="メインメニュー">
                <?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
                <div id="search"><?php get_search_form(); ?></div>
            </nav>
        </dialog>
    </header>
    <div>
        <main>