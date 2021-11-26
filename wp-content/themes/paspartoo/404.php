<?php

get_header();?>
    <link rel="stylesheet" type="text/css" href="<?php echo get_site_url(); ?>/wp-content/themes/paspartoo/css/animate.min.css">
    <div class="container page_header">
        <div class="row">
            <div class="col-12  text-center breadcrumbs padding-26">
                <?php if ( function_exists( 'wp_breadcrumbs' ) ) wp_breadcrumbs(); ?>
            </div>
            <!-- <div class="col-12 text-center color-blue page_title padding-42">
                <h1><?php the_title();?></h1>
            </div> -->
        </div>
    </div>
<?php $the_query = new WP_Query( 'page_id=1055' ); ?>

<?php while ($the_query -> have_posts()) : $the_query -> the_post();  ?>

    <?php the_content(); ?>


<?php endwhile;?>
<?php
get_footer(); ?>