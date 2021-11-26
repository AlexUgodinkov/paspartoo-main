<?php
/*
Element Description: VC Services Blocks
*/
 
// Element Class 
class vcServicesBlocks extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_servicesblocks_mapping' ) );
        add_shortcode( 'vc_servicesblocks', array( $this, 'vc_servicesblocks_html' ) );
    }
     
    // Element Mapping
    public function vc_servicesblocks_mapping() {
         
       if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
    }
         
    // Map the block with vc_map()

$params= array(
		 
		 
		 )
	 ;
	
	
    vc_map( 
  
        array(
            'name' => __('Services Blocks', 'themename'),
            'base' => 'vc_servicesblocks',
            'description' => __('Services Blocks', 'themename'),  					
            'icon' => get_template_directory_uri().'/image/vc-icon.png',            
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
                    'description' => __( 'Service Title', 'themename' ), 
                ),  
                  
                array( 
                    'type' => 'textarea',
                    'holder' => 'div',
                    'class' => 'text-class',
                    'heading' => __( 'Text', 'themename' ),
                    'param_name' => 'text',
                    'value' => '',
                    'description' => __( 'Service Text', 'themename' )
                ),                   
                  array( 
					'type' => 'vc_link',
					'heading' => __( 'URL (Link)', 'themename' ),
					'param_name' => 'link',
					'description' => __( 'Add link to button.', 'themename' ),		 
				)   
            ))) ;                                    
        
    } 
     
     
    // Element HTML
    public function vc_servicesblocks_html( $atts ) {
         
     
     // Params extraction
    extract(
        shortcode_atts(
            array(
                'title'   => '',
                'text' => '',
				'image'   => '',
                'link' => ''
            ), 
            $atts
        )
    );
	$links=explode('|',$link);
	$links_arr=array();
	foreach ($links as $key=>$block)
	{
		$s=explode(':',$block);
		if (isset($s[0]) AND isset($s[1]))
		{
			$links_arr[$s[0]]=urldecode($s[1]);
		}
	}
	$url='';
	$titles='';
	$target='';
	$rel='';
	if ($links_arr['url']!='') $url=$links_arr['url'];
	if ($links_arr['title']!='') $titles=' title="'.$links_arr['title'].'" ';
	if ($links_arr['target']!='') $target=' target="'.$links_arr['target'].'" ';
	if ($links_arr['rel']!='') $rel=' rel="'.$links_arr['rel'].'" '; 
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
	<div class="col-lg-4 col-md-4 col-sm-6"> 
    <div class="services_blocks"> 
		<a href="'.$url.'" '.$titles.$target.$rel.'  class="image">'.$show_image.'</a>
		<div class="content">
        <h2><a href="'.$url.'" '.$title.$target.$rel.'>' . $title . '</a></h2>
        <div class="text">' . $text . '</div>		
		</div>
		<div class="more"><a href="'.$url.'" '.$titles.$target.$rel.'>' .__('Read more','themename') . '</a></div>
    </div></div>';      
	
    return $html;
         
    } 
     
} // End Element Class
 
// Element Class Init
new vcServicesBlocks();  