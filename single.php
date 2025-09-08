<?php
get_header();
if (have_posts()):
    while (have_posts()):
        the_post(); ?>

        <div class="aspect-[348/482] rounded-md overflow-hidden">
            <img src="<?php echo wp_get_attachment_image_url( get_lzb_meta("main-image")['id'], "large");?>" alt="" class="w-full h-full object-cover">
        </div>
<h2 class="text-primary text-3xl font-bold">
    <?php the_title(); ?>
</h2>
    <?php if (has_post_thumbnail()): ?>
        <?php the_post_thumbnail(); ?>
    <?php endif; ?>
<?php the_content(); ?>
<?php
    endwhile;
endif;
get_footer();
