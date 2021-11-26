<?php
if (class_exists('WPBakeryShortCode')) {
	class WPBakeryShortCode_vc_carousel_video extends WPBakeryShortCode {

		protected function content( $atts, $content = null ) {

			extract( shortcode_atts( array(
				'wdo_video_url' =>	'',
			), $atts ) );
			?>
			<div class="item-video">
			  <a class="owl-video" href="<?php echo $wdo_video_url; ?>"></a> 
			</div>

	<?php
		}
	}
}

if ( function_exists( "vc_map" ) ) {
	vc_map( array(
		"base" 			=> "vc_carousel_video",
		"name" 			=> __( 'Add Video Slide', 'wdo-carousel' ),
		"as_child" 		=> array('only' => 'vc_carousel_parent'),
		"description" 	=> __('Add video slide to carousel.', 'wdo-carousel'),
		"icon" => plugin_dir_url( __FILE__ ).'../icons/admin-video-icon2.png',
		'params' => array(
			array(
				"type"             => "textfield",
				"heading"          => __( "Video URL", "wdo-carousel" ),
				"description"	=>	__('Give complete url for YouTube/Vimeo/Vzaar videos', 'wdo-carousel'),
				"param_name"       => "wdo_video_url",
				"value"            => "",
			),
		)
	) );
}
?>