<footer id="footer">
    Test
    <div class="container-fluid footer_line">
        <div class="row h-100">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <?php
                    $theme_socialurl =  get_option('theme_socialurl');
                    $social='';
                    if (is_array($theme_socialurl)) {
                        $social.='<ul>';
                        foreach ($theme_socialurl as $key=>$block)
                        {
                            $ico='<i class="'.$block['class'].'"></i>';
                            if ($block['ico']!='') $ico='<img src="'.$block['ico'].'" >';
                            $social.='<li><a href="'.$block['url'].'" target="_blank">'.$ico.'</a></li>';
                        }
                        $social.='</ul>';
                    }
                    ?>
                    <div class="col-auto social">
                        <?php print $social;?>
                    </div>
                    <div class="col text-center">
                        <?php
                        $theme_footerlogo = get_option('theme_footerlogo');
                        if ( ! empty( $theme_footerlogo ) ) { ?>
                            <a href="<?php print  get_home_url();?>"><img class="footer_logo" alt="<?php print  wp_title();?>" src="<?php print  $theme_footerlogo;?>"></a>
                        <?php   }  ?>
                    </div>
                    <div class="col-auto social">
                        <?php $theme_contacts =  get_option('theme_phones');
                        if (is_array($theme_contacts)) {
                            print '<ul>';
                            foreach ($theme_contacts as $key=>$block)
                            {
                                $phone = $block['phone'];
                                print '<li>';
                                print '<a href="'.$phone.'">';
                                print '<i class="'.$block['short'].'"></i>';
                                print '</a>';
                                print '</li>';
                            }
                            print '</ul>';
                        }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid footer_block">
        <div class="row h-100">
            <div class="container h-100">
                <div class="row subrow">
                    <div class="col-md-4 contacts">
                        <div class="phone">
                            <?php
                            $theme_phone = get_option('theme_phone');
                            if ( $theme_phone != '' ) {?>
                                <a href="tel:<?php  echo phone_to_moblink($theme_phone); ?>" target="_blank"><?php echo $theme_phone; ?></a>
                            <?php }  ?>
                        </div>
                        <div class="social">
                            <?php $theme_contacts =  get_option('theme_phones');
                            if (is_array($theme_contacts)) {
                                print '<ul>';
                                foreach ($theme_contacts as $key=>$block)
                                {
                                    $phone = $block['phone'];
                                    print '<li>';
                                    print '<a href="'.$phone.'" class="phone" target="_blank">';
                                    print '<i class="'.$block['short'].'"></i>';
                                    print '</a>';
                                    print '</li>';
                                }
                                print '</ul>';
                            }?>
                        </div>
                        <?php $theme_address =  get_option('theme_address');
                        $theme_map_link =  get_option('theme_map_link');
                        $theme_mail =  get_option('theme_mail');
                        if ($theme_address != '' && $theme_map_link != '' && $theme_mail != '') {
                            print '<table><tbody>';
                                print '<tr class="contact_block">';
                                print '<td class="icon">';
                                print '<i class="fal fa-map-marker-alt"></i>';
                                print '</td>';
                                print '<td><a href="'.$theme_map_link.'" target="_blank"><span class="phone">'.$theme_address.'</span></a></td>';
                                print '</tr>';
                            print '</tbody></table>';
                            print '<table><tbody>';
                                print '<tr class="contact_block">';
                                print '<td class="icon">';
                                print '<i class="far fa-envelope"></i>';
                                print '</td>';
                                print '<td><a href="mailto:'.$theme_mail.'"><span class="phone">'.$theme_mail.'</span></a></td>';
                                print '</tr>';
                            print '</tbody></table>';
                        }?>
                        <?php
                        $theme_socialurl =  get_option('theme_socialurl');
                        $social='';
                        if (is_array($theme_socialurl)) {
                            $social.='<ul>';
                            foreach ($theme_socialurl as $key=>$block)
                            {
                                $ico='<i class="'.$block['class'].'"></i>';
                                if ($block['ico']!='') $ico='<img src="'.$block['ico'].'" >';
                                $social.='<li><a href="'.$block['url'].'" target="_blank">'.$ico.'</a></li>';
                            }
                            $social.='</ul>';
                        }
                        ?>
                        <div class="social">
                            <?php print $social;?>
                        </div>
						<br>
						<script type="text/javascript" src="https://widget.clutch.co/static/js/widget.js"></script> <div class="clutch-widget" data-url="https://widget.clutch.co" data-widget-type="1" data-height="50" data-darkbg="1" data-clutchcompany-id="509185"></div>
                    </div>
                    <div class="col-md-2">
                        <?php dynamic_sidebar('[footer_one]');?>
                    </div>
                    <div class="col-md-3">
                        <?php dynamic_sidebar('[footer_two]');?>
                    </div>
                    <div class="col-md-3">
                        <?php dynamic_sidebar('[footer_three]');?>
                        <?php dynamic_sidebar('[footer_four]');?>
                    </div>
                </div>
                <div class="row line">
                </div>
                <div class="row subblock align-items-center">
                    <div class="col">
                        <?php
                            wp_nav_menu( array( 'theme_location' => 'footer_menu' ) );
                        ?>
                    </div>
                    <div class="col-auto">
                        Copyright © 2017-<?php echo date('Y'); ?>. Paspartoo llc. All rights reserved.
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="bg" id="bgf"></div>
<div id="appform_show" style="display:None">
    <div class="content_appform_show_over "><div class="content_appform_show contact_page wpb_animate_when_almost_visible fadeInUp wpb_start_animation animated"  ><div class="content_appform_show_close"><i class="fal fa-times"></i></div><?php dynamic_sidebar( 'apply_form' );?></div></div>
    <div class="bg_appform_show wpb_animate_when_almost_visible wpb_start_animation animated fadeIn" ></div>
</div>
<!-- <script src="https://cdn.jsdelivr.net/npm/simple-parallax-js@4.2.1/dist/simpleParallax.min.js"></script> -->
<script>
    var ajax_web_url = '<?php echo admin_url('admin-ajax.php', 'relative') ?>';
</script>
<?php wp_footer(); ?>
</body>
</html>
