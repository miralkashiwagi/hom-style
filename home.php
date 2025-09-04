<?php
get_header();
if (have_posts()):?>

    <?php get_template_part('template-parts/list');?>

<?php
endif;
get_footer();
