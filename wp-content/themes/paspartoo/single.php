<?php get_header();

?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                    <div class="container page_header">
                        <div class="row">
                            <div class="col-12 breadcrumbs padding-26">
                                <?php if ( function_exists( 'wp_breadcrumbs' ) ) wp_breadcrumbs(); ?>
                            </div>
                            <div class="col-12 color-blue page_title padding-42">
                                <h1><?php the_title();?></h1>
                            </div>
                        </div>
                    </div>
    <section class="page_content">
    <?php the_content();?>
    </section>

<?php endwhile; endif; ?>
<?php get_footer(); ?>