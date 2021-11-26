<?php 
class WDO_Carousel_Class {

	function __construct() {
		add_action( 'init', array($this, 'wdo_carousel_init' ));
		add_action( "admin_enqueue_scripts", array( $this, "custom_param_styles" ) );
		add_action( 'init', array( $this, 'check_if_vc_is_install' ) );
	}

		
	function wdo_carousel_init() {

		include 'includes/carousel_parent.php';
		include 'includes/carousel_child.php';
		include 'includes/carousel_video.php';
		include 'includes/carousel_posts.php';
		include 'includes/carousel_testimonials.php';
		include 'includes/carousel_image_over_image.php';
	}

	function custom_param_styles() {
		echo '<style type="text/css">
				.wdo_items_to_show.vc_shortcode-param {
					background: #E6E6E6;
					padding-bottom: 10px;
				}
				.wdo_items_to_show.wdo_margin_bottom{
					margin-bottom: 15px;
				}
				.wdo_items_to_show.wdo_margin_top{
					margin-top: 15px;
				}
			</style>';
	}

	function check_if_vc_is_install(){
        if ( ! defined( 'WPB_VC_VERSION' ) ) {
            // Display notice that Visual Compser is required
            add_action('admin_notices', array( $this, 'showVcVersionNotice' ));
            return;
        }			
	}

	function showVcVersionNotice() { 
	    $plugin_name = 'Carousel Anything';
        echo '
        <div class="updated">
          <p>'.sprintf(__('<strong>%s</strong> requires <strong><a href="http://codecanyon.net/item/visual-composer-page-builder-for-wordpress/242431?ref=labibahmed" target="_blank">Visual Composer</a></strong> plugin to be installed and activated on your site.', 'wdo-carousel'), $plugin_name).'</p>
        </div>';
	}

}
?>