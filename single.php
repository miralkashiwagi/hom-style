<?php
get_header();
if (have_posts()):
    while (have_posts()):
        the_post(); ?>

        <div class="relative">
            <div class="aspect-square rounded-xl overflow-hidden">
                <img src="<?php echo wp_get_attachment_image_url(get_lzb_meta("main-image")['id'], "full"); ?>" alt=""
                     class="w-full h-full object-cover">
            </div>
            <div class="absolute bottom-0 right-0 rounded-tl-md rounded-br-xl flex gap-xs items-baseline grow justify-end-safe text-black bg-gray-bg px-xs pt-xs pb-2xs">
                <h3 class="font-en text-xs">Author</h3>
                <p class="text-md leading-none">
                    <?php the_author_posts_link(); ?>
                </p>
            </div>
        </div>
        <hgroup class="flex gap-sm items-baseline mt-sm mb-xl leading-heading">
            <p class="font-en text-lg">Outfit</p>
            <h2 class="text-xl">
                <?php the_title(); ?>
            </h2>
        </hgroup>
        <?php if (has_post_thumbnail()): ?>
        <?php the_post_thumbnail(); ?>
    <?php endif; ?>
        <?php the_content(); ?>


        <h3 class="font-en text-lg mt-xl mb-2xs">Tag</h3>
        <div class="flex flex-wrap gap-2xs items-end justify-between">
            <?php
            $tax_colors = get_the_terms(get_the_ID(), "category_color");
            $tax_styles = get_the_terms(get_the_ID(), "category_style");
            ?>
            <?php /* どちらのタグも無ければ、タグ未設定ですを出す */
            if (empty($tax_colors) && empty($tax_styles)) {
                echo "<p class='text-sm text-gray-text'>タグは未設定です</p>";
            }
            ?>
            <ul class="flex flex-wrap gap-sm text-sm text-gray-text">
                <?php if (!empty($tax_colors)): ?>
                    <?php foreach ($tax_colors as $tax_color): ?>
                        <li>
                            <a href="<?php echo get_term_link($tax_color->term_id); ?>"
                               class="block rounded-full bg-gray-bg px-md py-sm"><?php echo $tax_color->name; ?></a>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php if (!empty($tax_styles)): ?>
                    <?php foreach ($tax_styles as $tax_style): ?>
                        <li>
                            <a href="<?php echo get_term_link($tax_style->term_id); ?>"
                               class="block rounded-full bg-gray-bg px-md py-sm"><?php echo $tax_style->name; ?></a>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>

        </div>

        <div class="mt-3xl text-center">
            <a href="<?php echo get_post_type_archive_link("post") ?>"
               class="text-sm inline-flex gap-sm items-center rounded-full py-sm pl-md pr-xl bg-gray-bg">
                <span class="font-icon text-md">chevron_left</span>
                一覧に戻る
            </a>
        </div>
    <?php
    endwhile;
endif;
get_footer();
