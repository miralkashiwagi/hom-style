<?php
class ThemeAssets {
    private static $manifest = null;

    private static function get_manifest() {
        if (self::$manifest === null) {
            $manifest_path = get_template_directory() . '/dist/.vite/manifest.json';
            if (file_exists($manifest_path)) {
                self::$manifest = json_decode(file_get_contents($manifest_path), true);
            } else {
                self::$manifest = [];
            }
        }
        return self::$manifest;
    }

    public static function enqueue_assets() {
        $manifest = self::get_manifest();

        // CSSの読み込み
        if (isset($manifest['src/css/main.css'])) {
            $css_file = $manifest['src/css/main.css']['file'];
            wp_enqueue_style(
                'theme-style',
                get_template_directory_uri() . '/dist/' . $css_file,
                [],
                null // バージョン指定なし（ハッシュがあるため）
            );
        }

        // JSの読み込み
        if (isset($manifest['src/js/main.js'])) {
            $js_file = $manifest['src/js/main.js']['file'];
            wp_enqueue_script(
                'theme-script',
                get_template_directory_uri() . '/dist/' . $js_file,
                [],
                null,
                true
            );
        }
    }

    // 開発環境用の処理
    public static function enqueue_dev_assets() {
        if (defined('WP_ENVIRONMENT_TYPE') && WP_ENVIRONMENT_TYPE === 'local') {
            // Vite dev serverから読み込み
            wp_enqueue_script(
                'vite-client',
                'http://localhost:5173/@vite/client',
                [],
                null,
                false
            );

            wp_enqueue_style(
                'theme-style-dev',
                'http://localhost:5173/src/css/main.css',
                [],
                null
            );
        }
    }
}

// フック
add_action('wp_enqueue_scripts', function() {
    if (defined('WP_ENVIRONMENT_TYPE') && WP_ENVIRONMENT_TYPE === 'local') {
        ThemeAssets::enqueue_dev_assets();
    } else {
        ThemeAssets::enqueue_assets();
    }
});

function add_post_thumbnail_support() {
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'add_post_thumbnail_support');


// より安全なフック処理
add_action('save_post', 'handle_save_post_thumbnail', 5);

function handle_save_post_thumbnail($post_id) {
    // 引数の数に関係なく、最初の引数（post_id）のみを使用

    // 投稿が存在するかチェック
    $post = get_post($post_id);
    if (!$post) {
        return;
    }

    // ユーザーの権限チェック（管理画面からのリクエストの場合のみ）
    if (is_admin() && !current_user_can('edit_post', $post_id)) {
        return;
    }

    // スケジューリングを使用して処理を遅延実行
    if (!wp_next_scheduled('set_thumbnail_delayed', array($post_id))) {
        wp_schedule_single_event(time() + 1, 'set_thumbnail_delayed', array($post_id));
    }
}

// カスタムイベントのハンドラー
add_action('set_thumbnail_delayed', 'set_thumbnail_by_meta');

function set_thumbnail_by_meta($post_id) {
    // 投稿が存在するかチェック
    $post = get_post($post_id);
    if (!$post) {
        return;
    }

    // Lazy Blocksのメタデータを取得
    $image_data = get_lzb_meta('main-image', $post_id);
    // メタデータの存在確認
    if (is_array($image_data) && isset($image_data["id"])) {
        $image_id = $image_data["id"];
        if ($image_id && is_numeric($image_id)) {
            $result = set_post_thumbnail($post_id, $image_id);
        }
    }
}

