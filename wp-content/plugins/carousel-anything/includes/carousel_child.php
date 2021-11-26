<?php
if (class_exists('WPBakeryShortCodesContainer')) {
	class WPBakeryShortCode_vc_carousel_child extends WPBakeryShortCodesContainer {

		protected function content( $atts, $content = null ) {

			extract( shortcode_atts( array(
			), $atts ) );
			?>
			
			<div class="item">
				<?php echo do_shortcode( $content ); ?>
			</div>

	<?php
		}
	}
}

if ( function_exists( "vc_map" ) ) {
	vc_map( array(
		"base" 			=> "vc_carousel_child",
		"name" 			=> __( 'Add Any Content', 'wdo-carousel' ),
		"as_child" 		=> array('only' => 'vc_carousel_parent'),
		'as_parent'         => array(''),
		"show_settings_on_create" => false,
		'allowed_container_element' => 'vc_row',
		'js_view'                   => 'VcColumnView',
		"description" 	=> __('Add any content in slide.', ''),

		"icon" => plugin_dir_url( __FILE__ ).'../icons/carousel-child-copy.png',
	) );
}
?>