<?php
/*
Element Description: VC Services Blocks
*/

// Element Class
class vcTestimonialsBlocks extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_testimonialsblocks_mapping' ) );
        add_shortcode( 'vc_testimonialsblocks', array( $this, 'vc_testimonialsblocks_html' ) );
    }

    // Element Mapping
    public function vc_testimonialsblocks_mapping() {

        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()

        $params= array(


        )
        ;


        vc_map(

            array(
                'name' => __('Testimonials', 'themename'),
                'base' => 'vc_testimonialsblocks',
                'description' => __('Testimonials Blocks', 'themename'),
                'icon' => get_template_directory_uri().'/image/vc-testimonials.png',
                'params' => array(
                    array(
                        'type' => 'dropdown',
                        'heading' => __( 'Image source', 'js_composer' ),
                        'param_name' => 'source',
                        'value' => array(
                            __( 'Media library', 'js_composer' ) => 'media_library'
                        ),
                        'std' => 'media_library',
                        'description' => __( 'Select image source.', 'js_composer' ),
                    ),

                    array(
                        'type' => 'attach_image',
                        'heading' => __( 'Image', 'js_composer' ),
                        'param_name' => 'image',
                        'value' => '',
                        'description' => __( 'Select image from media library.', 'js_composer' ),
                        'dependency' => array(
                            'element' => 'source',
                            'value' => 'media_library',
                        ),
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'hidden',
                        'param_name' => 'img_link_large',
                    )
                ,
                    array(

                        'type' => 'textfield',
                        'holder' => 'h3',
                        'class' => 'title-class',
                        'heading' => __( 'Title', 'themename' ),
                        'param_name' => 'title',
                        'value' => '',
                        'description' => __( 'Testimonial Title', 'themename' ),
                    ),

                    array(
                        'type' => 'textarea',
                        'holder' => 'div',
                        'class' => 'text-class',
                        'heading' => __( 'Text', 'themename' ),
                        'param_name' => 'text',
                        'value' => '',
                        'description' => __( 'Testimonial Text', 'themename' )
                    )
                ))) ;

    }


    // Element HTML
    public function vc_testimonialsblocks_html( $atts ) {


        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'title'   => '',
                    'text' => '',
                    'image'   => ''
                ),
                $atts
            )
        );
        $image=(int)$image;
        $show_image='';
        if ($image>0)
        {
            $s=wp_get_attachment_image_src( $image,'full' );
            if (isset($s[0]))
            {
                $show_image='<img src="'.$s[0].'">';
            }
        }
        $html = '
	<div class="item"> <div class="ins"> <div class="row align-items-center"><div class="item_blocks">
	<div class="text">' . $text . '</div>
	<div class="title">' . $title . '</div>
	<div class="bg">'.$show_image.'</div>
	</div></div></div></div>';

        return $html;

    }

} // End Element Class

// Element Class Init
new vcTestimonialsBlocks();