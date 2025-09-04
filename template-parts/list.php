<div class="grid grid-cols-2 gap-xl">
    <?php  while (have_posts()):
        the_post();?>
    <a href="<?php the_permalink();?>" class="block">
        <div class="aspect-[348/482] rounded-md overflow-hidden">
            <?php if (has_post_thumbnail()):
                the_post_thumbnail( 'full', array('class' => 'object-cover w-full h-full'));
            endif; ?>
        </div>
        <div class="p-xs pb-0">
            <p class="text-2xs text-gray-text">
                <?php the_author();?>
            </p>
            <p class="text-md">
                <?php the_title();?>
            </p>
        </div>
    </a>
    <?php endwhile; ?>
</div>