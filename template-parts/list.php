<?php //タクソノミータームまたはauthorページだったら
if (is_author() || is_tax("category_color") || is_tax("category_style")) {
    //タイトルを取得
    add_filter('get_the_archive_title_prefix', function () {
        return '';
    });
    $title = get_the_archive_title();
    echo "<h2 class='text-md mb-sm font-bold'>" . $title . "のスタイル一覧</h2>";
}
//キーワード検索結果ページだったら
if (is_search()) {
    //キーワードを取得
    echo "<h2 class='text-md mb-sm font-bold'>" . get_search_query() . "の検索結果</h2>";
}

?>


    <div class="grid grid-cols-2 gap-xl">
        <?php
        $post_count = 0; // カウンターを初期化
        while (have_posts()):
            the_post();
            $post_count++; // カウンターをインクリメント

            //投稿日から3日以内の投稿か
            $is_new = false;
            $post_date = get_the_date('Y-m-d');
            $today = wp_date('Y-m-d');
            $diff = date_diff(date_create($post_date), date_create($today));
            if ($diff->format('%R%a') <= 3) {
                $is_new = true;
            }
            ?>
            <a href="<?php the_permalink(); ?>" class="block">
                <div class="relative">
                    <?php if ($is_new): ?>
                        <span class="inline-grid absolute font-en text-xs place-content-center pr-2xs rounded-br-sm bg-white">New</span>
                    <?php endif; ?>
                    <div class="aspect-[348/482] rounded-md overflow-hidden">
                        <img src="<?php echo wp_get_attachment_image_url(get_lzb_meta("main-image")['id'], "medium_large"); ?>"
                             alt="" class="w-full h-full object-cover"<?php echo ($post_count > 4) ? ' loading="lazy"' : 'fetchpriority="high"'; ?>
                        >
                    </div>
                </div>
                <div class="flex flex-col gap-xs">
                    <div class="p-xs pb-0">
                        <p class="text-2xs text-gray-text">
                            <?php the_author(); ?>
                        </p>
                        <p class="text-md">
                            <?php the_title(); ?>
                        </p>
                    </div>
                    <ul class="flex justify-end-safe flex-wrap gap-2xs text-xs text-gray-text">
                        <?php
                        $tax_colors = get_the_terms(get_the_ID(), "category_color");
                        $tax_styles = get_the_terms(get_the_ID(), "category_style");
                        ?>

                        <?php if (!empty($tax_colors)): ?>
                            <?php foreach ($tax_colors as $tax_color): ?>
                                <li>
                                    <span class="block rounded-full bg-gray-bg px-xs py-2xs"><?php echo $tax_color->name; ?></span>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php if (!empty($tax_styles)): ?>
                            <?php foreach ($tax_styles as $tax_style): ?>
                                <li>
                                    <span class="block rounded-full bg-gray-bg px-xs py-2xs"><?php echo $tax_style->name; ?></span>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </a>
        <?php endwhile; ?>
    </div>
<?php tailwind_posts_pagination(); ?>