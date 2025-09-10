<?php
get_header();
if (have_posts()):?>

<?php get_template_part('template-parts/list');?>

<?php
else:
    echo "見つかりませんでした。";
endif;
get_footer();
