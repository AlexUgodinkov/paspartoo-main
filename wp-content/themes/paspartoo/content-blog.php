<?php get_header();

?>
    <link rel="stylesheet" type="text/css" href="<?php echo get_site_url(); ?>/wp-content/themes/paspartoo/css/animate.min.css">
    <div class="page_for_posts">
    <div class="container page_header">
        <div class="row">
            <div class="col-12  breadcrumbs padding-42">
                <?php if ( function_exists( 'wp_breadcrumbs' ) ) wp_breadcrumbs(); ?>
            </div>
            <div class="col-12 text-center color-blue page_title padding-42">
                <h1><?php
                // echo get_the_title( get_option('page_for_posts', true) );
                ?>
            Paspartoo web development blog</h1>
            </div>
        </div>
    </div>
    <div class="container padding-110-bottom">
<?php if (have_posts()) :  ?>
        <div class="row categories">
            <div class="col-12">
                <?php $args = array('taxonomy' => 'category' );
                $terms = get_terms( $args );?>
                <div class="row row justify-content-center  padding-42 padding-42-bottom">
                    <div class="cat_but current"><a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">All</a></div>
                    <?php
                    foreach ($terms as $termses) :
                        $class="";
                       // if ($termses->count==0) $class=' class="no_active" ';
                        print '<div class="cat_but"><a href="'.get_term_link($termses->term_id).'">'.$termses->name.'</a></div>';
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
    <div class="row news_homepage">
        <?php
        $position = 0;
        while ( have_posts() ) : the_post();
            $position++;
            $post=get_post();
            $url = get_permalink( $post->ID );
            $categories = get_the_category();
            if ($position % 2 === 0) {
                $class = "pictured";
            } else {
                $class = "simple";
            }
            ?>
            <div class="col-md-4 padding-42">
                <?php
                $related_img=get_the_post_thumbnail_url( $post->ID, 'large' );
                ?>
                <a href="<?php echo $url ;?>" title="<?php the_title();?>">
                    <div class="stick <?php echo $class;?>">
                        <?php if ( ! empty( $categories ) ) { ?>
                            <div class="category"><h5><?php echo esc_html( $categories[0]->name );?></h5></div>
                        <?php } ?>
                        <div class="title"><h3><?php the_title();?></h3></div>
                        <?php if ($class == "pictured") {?>
                            <div class="stick_bg" style="background-image: url('<?php echo $related_img;?>')"></div>
                        <?php }?>
                    </div>
                </a>
            </div>
        <?php
        endwhile; ?>
    </div>
        <div class="row">
            <div class="col-md-12 padding-68">
                <?php
                the_posts_pagination( array(
                    'screen_reader_text' => ' ',
                    'prev_text'          => '<i class="fal fa-angle-left"></i>',
                    'next_text'          => '<i class="fal fa-angle-right"></i>',
                    'end_size'     => 1,
                    'mid_size'     => 3,
                    'after_page_number' => ' ',
                ) );

                ?>
            </div>
        </div>
    </div>
<?php  endif; ?>
    </div>
<?php get_footer(); ?>