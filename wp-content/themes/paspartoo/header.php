<!DOCTYPE HTML>
<html lang="en">
<head>
<title><?php wp_title(); ?></title>
<meta http-equiv="Content-Type" content="text/html;">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<?php
wp_head();
$favicon = get_option( 'theme_favicon' );
?>
<link rel="icon" href="<?php print $favicon;?>" type="image/x-icon" />
<link rel="shortcut icon" href="<?php print $favicon;?>" type="image/x-icon" />
<?php
$noindex=(int)get_field('no-index',get_the_ID());
if ($noindex==1) {
	print '<meta name="robots" content="noindex, nofollow" />';
}
?> 
</head>
<?php
global $post,$wp_query;
$class="";
if ( is_single() && 'portfolio' == get_post_type() ) {
 $class="portfolio_single"; 
}
?>
	<body class="<?php print $class;?>">
    <?php 
    
    
    $items = wp_get_nav_menu_items('Services Block');
    foreach ($items as $item) {
    // $item->post_parent
    // $item->post_name

        if (is_page($item->object_id)) {
        	echo "<script>fbq('track', 'ViewContent', {content_ids: ['". $item->object_id ."'], content_name: '" . $item->title . "'});</script>";  
            }
    }    
    ?>
   <header id="header">
			<div class="container-fluid header_line header_page">
                <div class="row h-100 align-items-center">
                            <div class="col-auto mob_menu">
                                <button id="hamb_button" class="hamburger hamburger--collapse" type="button"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button>
                            </div>
                            <div class="mobile_menu">
                                <div class="show_mob_menu">
                                    <div class="block">
                                        <?php
                                        if ( has_nav_menu( 'header_menu' ) ) {
                                            wp_nav_menu( array(
                                                'theme_location' 	=> 'header_menu',
                                                'menu_class' 	 	=> 'mobile_menu_links new',
                                                'container'		 	=> '',
                                                'container_class' 	=> '',
                                                'walker' 			=> new Main_Submenu_Class()));
                                        }
                                        ?>
                                        <?php
                                        if ( has_nav_menu( 'mobile_menu' ) ) {
                                            wp_nav_menu( array(
                                                'theme_location' 	=> 'mobile_menu',
                                                'menu_class' 	 	=> 'mobile_menu_links new',
                                                'container'		 	=> '',
                                                'container_class' 	=> '',
                                                'walker' 			=> new Main_Submenu_Class()));
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto logo">
                                <?php
                                $theme_sitelogo = get_option('theme_sitelogo');
                                if ( ! empty( $theme_sitelogo ) ) { ?>
                                    <a href="<?php echo get_site_url();?>"><img src="<?php print  $theme_sitelogo;?>"></a>
                                <?php   }  ?>
                            </div>
                            <div class="col-auto mmenu">
                                <?php wp_nav_menu( array( 'theme_location' => 'services_menu' ) ); ?>
                            </div>
               				<div class="col nav">
								<?php wp_nav_menu( array( 'theme_location' => 'header_menu' ) ); ?>
							</div>
                            <div class="col-auto tel">
                                <?php
                                $theme_phone = get_option('theme_phone');
                                if ( $theme_phone != '' ) {
                                    _e('<span>Let`s Talk: </span>');?>
                                    <a href="tel:<?php  echo phone_to_moblink($theme_phone); ?>"><?php echo $theme_phone; ?></a>
                                <?php }  ?>
                            </div>
                            <div class="col tel_mobile">
                                <?php
                                $theme_phone = get_option('theme_phone');
                                if ( $theme_phone != '' ) {?>
                                <a href="tel:<?php  echo phone_to_moblink($theme_phone); ?>"><button><i class="fas fa-phone"></i></button></a>
                                <?php }  ?>
                            </div>
                            <div class="col-auto quote">
                                <a href="#getaquote"><button class="quote appform">Get a Quote</button></a>
                            </div>
                </div>
            </div>
		</header>