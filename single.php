<?php
get_header();
if (have_posts()):
    while (have_posts()):
        the_post(); ?>

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
