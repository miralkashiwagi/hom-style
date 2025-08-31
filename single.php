<?php
get_header();
if (have_posts()) : while (have_posts()) : the_post();?>

<h2 class="font-bold text-3xl text-primary">
    <?php the_title(); ?>
</h2>
    <?php if (has_post_thumbnail()) :?>
        <?php the_post_thumbnail();?>
    <?php endif;?>
<?php the_content();?>
<?php endwhile; endif;
get_footer();