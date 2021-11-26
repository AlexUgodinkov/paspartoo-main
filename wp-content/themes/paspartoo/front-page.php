<?php get_header('front');

?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="page_content">
    <?php the_content();?>
</div>
<?php endwhile; endif; ?>
<?php get_footer('front');