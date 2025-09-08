<?php
/*
 * ViteでビルドしたCSSとJSを読み込む
 * */
class ThemeAssets
{
    private static $manifest = null;

    private static function get_manifest()
    {
        if (self::$manifest === null) {
            $manifest_path =
                get_template_directory() . "/dist/.vite/manifest.json";
            if (file_exists($manifest_path)) {
                self::$manifest = json_decode(
                    file_get_contents($manifest_path),
                    true,
                );
            } else {
                self::$manifest = [];
            }
        }
        return self::$manifest;
    }

    public static function enqueue_assets()
    {
        $manifest = self::get_manifest();

        // CSSの読み込み
        if (isset($manifest["src/css/main.css"])) {
            $css_file = $manifest["src/css/main.css"]["file"];
            wp_enqueue_style(
                "theme-style",
                get_template_directory_uri() . "/dist/" . $css_file,
                [],
                null, // バージョン指定なし（ハッシュがあるため）
            );
        }

        // JSの読み込み
        if (isset($manifest["src/js/main.js"])) {
            $js_file = $manifest["src/js/main.js"]["file"];
            wp_enqueue_script(
                "theme-script",
                get_template_directory_uri() . "/dist/" . $js_file,
                [],
                null,
                true,
            );
        }
    }

    // 開発環境用の処理
    public static function enqueue_dev_assets()
    {
        if (defined("WP_ENVIRONMENT_TYPE") && WP_ENVIRONMENT_TYPE === "local") {
            // Vite dev serverから読み込み
            wp_enqueue_script(
                "vite-client",
                "http://localhost:5173/@vite/client",
                [],
                null,
                true, // footerに配置
            );

            // 開発環境のJavaScript読み込み
            wp_enqueue_script(
                "theme-script-dev",
                "http://localhost:5173/src/js/main.js",
                ["vite-client"],
                null,
                true,
            );

            wp_enqueue_style(
                "theme-style-dev",
                "http://localhost:5173/src/css/main.css",
                [],
                null,
            );
        }
    }
}

// スクリプトにmodule属性を追加
function add_module_to_script($tag, $handle, $src) {
    if (in_array($handle, ['theme-script', 'theme-script-dev', 'vite-client'])) {
        $tag = str_replace('<script ', '<script type="module" ', $tag);
    }
    return $tag;
}
add_filter('script_loader_tag', 'add_module_to_script', 10, 3);

// フック
add_action("wp_enqueue_scripts", function () {
    if (defined("WP_ENVIRONMENT_TYPE") && WP_ENVIRONMENT_TYPE === "local") {
        ThemeAssets::enqueue_dev_assets();
    } else {
        ThemeAssets::enqueue_assets();
    }
});


function exclude_styles()
{
    wp_dequeue_style("wp-block-library");
}
add_action("wp_print_styles", "exclude_styles", 100);
