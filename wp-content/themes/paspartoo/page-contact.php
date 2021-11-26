<?php
/* Template Name: Contact Page */
get_header();?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo get_site_url(); ?>/wp-content/themes/paspartoo/css/animate.min.css">
    <section class="contact_page">
        <div class="container page_header">
            <div class="row">
                <div class="col-12 breadcrumbs padding-26">
                    <?php if ( function_exists( 'wp_breadcrumbs' ) ) wp_breadcrumbs(); ?>
                </div>
                <div class="col-12 color-title page_title padding-42">
                    <h1>Get in touch</h1>
                </div>
            </div>
        </div>
        <div class="container padding-110-bottom">
            <div class="row">
                <div class="col-md-6">
                    <?php echo do_shortcode('[contact-form-7 id="366" title="Contact Page"]');?>
                </div>
                <div class="col-md-6 contacts">
                    <div class="color-title"><h2>Miami, FL</h2></div>
                    <div class="separator"></div>
                    <?php
                    $theme_address =  get_option('theme_address');
                    $theme_map_link =  get_option('theme_map_link');
                    ?>
                    <div class="address">
                        <?php
                        if ($theme_address != '' && $theme_map_link != '') {?>
                            <h5 class="color-blue"><?php echo $theme_address;?></h5>
                            <h5 class="color-orange"><span><a href="<?php echo $theme_map_link;?>"><i class="fas fa-search"></i> Google Map</a></span></h5>
                        <?php } ?>
                    </div>
                    <div class="phone padding-26">
                        <?php
                        $theme_phone = get_option('theme_phone');
                        if ( $theme_phone != '' ) {?>
                            <h5 class="color-orange">Call:</h5>
                            <h5 class="color-blue"><a href="tel:<?php  echo phone_to_moblink($theme_phone); ?>" target="_blank"><?php echo $theme_phone; ?></a></h5>
                        <?php }  ?>
                    </div>
                    <div class="mail block">
                        <?php
                        $theme_mail =  get_option('theme_mail');
                        if ( $theme_mail != '' ) {?>
                            <h5 class="color-orange">Write:</h5>
                            <h5 class="color-blue"><a href="mailto:<?php  echo $theme_mail; ?>" target="_blank"><?php echo $theme_mail; ?></a></h5>
                        <?php }  ?>
                    </div>
                    <div class="social block">
                        <?php
                        $theme_socialurl =  get_option('theme_socialurl');
                        $social='';
                        if (is_array($theme_socialurl)) {
                            $social.='<ul>';
                            foreach ($theme_socialurl as $key=>$block)
                            {
                                $ico='<i class="'.$block['class'].'"></i>';
                                if ($block['ico']!='') $ico='<img src="'.$block['ico'].'" >';
                                $social.='<li class="color-blue"><a href="'.$block['url'].'" target="_blank">'.$ico.'</a></li>';
                            }
                            $social.='</ul>';
                        }
                        ?>
                        <h5 class="color-orange">Follow Us:</h5>
                        <?php print $social;?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section style="display: none">
<?php the_content();?>
    </section>
<?php endwhile; endif; ?>
<?php get_footer();