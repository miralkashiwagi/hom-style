<?php
get_header();
if (have_posts()):
    while (have_posts()):
        the_post(); ?>

        <div class="aspect-[348/482] rounded-xl overflow-hidden">
            <img src="<?php echo wp_get_attachment_image_url(get_lzb_meta("main-image")['id'], "large"); ?>" alt=""
                 class="w-full h-full object-cover">
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

            <ul class="flex flex-wrap gap-sm text-sm text-gray-text">
                <?php
                $tax_colors = get_the_terms(get_the_ID(), "category_color");
                $tax_styles = get_the_terms(get_the_ID(), "category_style");
                ?>

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

            <div class="flex gap-sm items-baseline grow justify-end-safe">
                <h3 class="font-en text-sm">Author</h3>
                <p>
                    <?php the_author_posts_link(); ?>
                </p>
            </div>
        </div>

    <div class="mt-3xl">
        <a href="<?php echo get_post_type_archive_link("post")?>">
            一覧に戻る
        </a>
    </div>
    <?php
    endwhile;
endif;
get_footer();
