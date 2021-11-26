<!DOCTYPE HTML>
<html  lang="en">
<head >   
<title><?php wp_title(); ?></title>
<meta http-equiv="Content-Type" content="text/html;">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php
wp_head();
$favicon = get_option( 'theme_favicon' );

?> 
<link rel="icon" href="<?php print $favicon;?>" type="image/x-icon" />
<link rel="shortcut icon" href="<?php print $favicon;?>" type="image/x-icon" />  
</head>
	<body>
        <div id="wptime-plugin-preloader"></div>
		<header id="header">
			<div class="container-fluid header_line">
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
                                    <img src="<?php print  $theme_sitelogo;?>">
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