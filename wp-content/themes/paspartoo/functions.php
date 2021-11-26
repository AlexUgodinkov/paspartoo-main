<?php
/**
@package nightnday

 */ 
add_filter('the_generator', '__return_empty_string');
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
add_filter( 'tiny_mce_plugins', 'disable_wp_emojis_in_tinymce' );
//add_filter('show_admin_bar', '__return_false');
 
 
 
//remove_action('wp_head', 'wp_generator');
//remove_action('wp_head', 'wlwmanifest_link');
//remove_action('wp_head', 'rsd_link');
//remove_action( 'wp_head',      'rest_output_link_wp_head'              );
//remove_action( 'wp_head',      'wp_oembed_add_discovery_links'         );
add_theme_support( 'post-thumbnails' );
remove_action( "wp_head", "rel_canonical" );
add_filter( 'get_canonical_url', 'remove_comment_page_canonical_url', 10, 2 );
function remove_comment_page_canonical_url( $canonical_url, $post ){

	 

	return '';
}



define( 'INSPIRY_FRAMEWORK', get_template_directory() . '/framework/' );


function disable_wp_emojis_in_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}


function at_remove_dup_canonical_link() {
return false;
}
add_filter( 'wpseo_canonical', 'at_remove_dup_canonical_link' );


function load_theme_styles() {
	
    wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), 'null', 'all');
    wp_register_style( 'fontawesome', get_template_directory_uri() . '/css/fontawesome.min.css', array(), 'null', 'all');
    wp_register_style( 'slick', get_template_directory_uri() . '/css/slick.css', array(), 'null', 'all');
    wp_register_style( 'slick', get_template_directory_uri() . '/css/flickity.css', array(), 'null', 'all');
    wp_register_style( 'fancybox', get_template_directory_uri() . '/css/jquery.fancybox.min.css', array(), 'null', 'all');
	wp_register_style( 'style', get_template_directory_uri() . '/style.css', array(), time(), 'all');
    wp_enqueue_style( 'bootstrap' );
    wp_enqueue_style( 'fontawesome' );
    wp_enqueue_style( 'flickity' );
    wp_enqueue_style( 'slick' );
    wp_enqueue_style( 'fancybox' );
    wp_enqueue_style( 'style' );
	$js_directory_uri = get_template_directory_uri() . '/js/';

    wp_register_script('jscrollpane',$js_directory_uri . 'jscrollpane.js',array( 'jquery' ),'null');
    wp_register_script('slick',$js_directory_uri . 'slick.js',array( 'jquery' ),'null');
    wp_register_script('flickity',$js_directory_uri . 'flickity.min.js',array( 'jquery' ),'null');
    wp_register_script('fancybox',$js_directory_uri . 'jquery.fancybox.min.js',array( 'jquery' ),'null');
    wp_register_script('script',$js_directory_uri . 'scripts.js',array( 'jquery' ),'null');
    wp_register_script('jqmin',$js_directory_uri . 'jquery.min.js',array( 'jquery' ),'null');
    wp_enqueue_script( 'jscrollpane' );
    wp_enqueue_script( 'slick' );
    wp_enqueue_script( 'flickity' );
    wp_enqueue_script( 'fancybox' );
	wp_enqueue_script( 'script' );
}		
add_action( 'wp_enqueue_scripts', 'load_theme_styles' ,100);

function menu_setup(){ 
	register_nav_menus( array('header_menu'   => 'Header Menu') );
    register_nav_menus( array('footer_menu'   => 'Footer Menu') );
    register_nav_menus( array('services_menu'   => 'Services Menu') );
    register_nav_menus( array('services_block'   => 'Services Block') );
    register_nav_menus( array('mobile_menu'   => 'Mobile Menu') );
    register_nav_menus( array('footer2_menu'   => 'Footer 2 Menu') );
    register_nav_menus( array('footer3_menu'   => 'Footer 3 Menu') );
    register_nav_menus( array('footer4_menu'   => 'Footer 4 Menu') );
}
add_action('after_setup_theme', 'menu_setup');

function add_file_types_to_uploads($file_types){
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );
    return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');

require_once( INSPIRY_FRAMEWORK . 'admin/admin-functions.php' );
require_once( INSPIRY_FRAMEWORK . 'admin/admin-interface.php' );
require_once( INSPIRY_FRAMEWORK . 'admin/theme-settings.php' );

class Main_Submenu_Class extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $classes 	 = array('sub-menu', 'list-unstyled', 'child-navigation');
        $class_names = implode( ' ', $classes );
        $output .= "\n" . '<ul class="' . $class_names . '">' . "\n";
    }

    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) )
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
        global $wp_query;

        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names_arr = array();
        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

        $class_names =  join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names_arr[] = esc_attr( $class_names );
        $class_names_arr[]='menu-item-id-'.$item->ID;
        if ( $args->has_children ) $class_names_arr[] = 'has-child';

        $class_names = ' class="'. implode(' ', $class_names_arr) . '"';
        $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
        $attributes='';
        if ($item->url!='#')
        {
            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
            $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
            $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
            $attributes .= ! empty( $item->url ) ? ' href="' . $item->url .'"' : '';
        }

        $item_output = $args->before;
        $item_output .='<div class="parent">';
        $item_output .='<a'. $attributes .' title="'.$item->title.'">';
        $item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
        $item_output .= $args->link_after;
        $item_output .= '</a>';
        if ( $args->has_children ) $item_output .='<span data-id="'. $item->ID . '"><i class="fas fa-chevron-left"></i></span>';
        $item_output .='</div>';

        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

function phone_to_moblink($text)
{
$text=str_replace(' ','',$text);
$text=str_replace('-','',$text);
$text=str_replace('(','',$text);
$text=str_replace(')','',$text);
return $text;

}
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function inspiry_theme_sidebars() {
    register_sidebar( array('name' => __( 'Footer 1', 'themename' ),'id' => 'footer_one','description' => __( 'Footer One', 'themename' ),'before_widget' => '<div class="footer_one">','after_widget' => '</div>','before_title' => '<h6>','after_title' => '</h6>' ));
    register_sidebar( array('name' => __( 'Footer 2', 'themename' ),'id' => 'footer_two','description' => __( 'Footer Two', 'themename' ),'before_widget' => '<div class="footer_two">','after_widget' => '</div>','before_title' => '<h6>','after_title' => '</h6>' ));
    register_sidebar( array('name' => __( 'Footer 3', 'themename' ),'id' => 'footer_three','description' => __( 'Footer Three', 'themename' ),'before_widget' => '<div class="footer_three">','after_widget' => '</div>','before_title' => '<h6>','after_title' => '</h6>' ));
    register_sidebar( array('name' => __( 'Footer 4', 'themename' ),'id' => 'footer_four','description' => __( 'Footer Four', 'themename' ),'before_widget' => '<div class="footer_four">','after_widget' => '</div>','before_title' => '<h6>','after_title' => '</h6>' ));
    register_sidebar( array('name' => __( 'Apply Form', 'themename' ),'id' => 'apply_form','description' => __( 'Apply Form', 'themename' ),'before_widget' => '','after_widget' => '','before_title' => '','after_title' => '' ));
    register_sidebar( array('name' => __( 'Download popup tips', 'themename' ),'id' => 'popup_tips','description' => __( 'Download popup tips', 'themename' ),'before_widget' => '','after_widget' => '','before_title' => '','after_title' => '' ));

}
add_action( 'widgets_init', 'inspiry_theme_sidebars' );

function vc_before_init_actions() {
    vc_set_shortcodes_templates_dir( get_template_directory() . '/vc_templates' );
}
add_action( 'vc_before_init', 'vc_before_init_actions' );

function wp_breadcrumbs() {
    $text['home'] = 'Home';
    $text['category'] = '%s';
    $text['search'] = 'Search results for: "%s"';
    $text['tag'] = 'Posts with tag: "%s"';
    $text['author'] = 'Статьи автора %s';
    $text['404'] = '404 Error';
    $text['page'] = 'Page: %s';
    $text['cpage'] = 'Comments %s';

    $wrap_before = '<div class="breadcrumbs_style" itemscope itemtype="http://schema.org/BreadcrumbList">';
    $wrap_after = '</div><!-- .breadcrumbs -->';
    $sep = '<span class="breadcrumbs__separator"> / </span>';
    $before = '<span class="breadcrumbs__current">';
    $after = '</span>';
    $show_on_home = 0;
    $show_home_link = 1;
    $show_current = 1;
    $show_last_sep = 1;

    global $post;
    $home_url = home_url('/');
    $link = '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
    $link .= '<a class="breadcrumbs__link" href="%1$s" itemprop="item"><span itemprop="name">%2$s</span></a>';
    $link .= '<meta itemprop="position" content="%3$s" />';
    $link .= '</span>';
    $parent_id = ( $post ) ? $post->post_parent : '';
    $home_link = sprintf( $link, $home_url, $text['home'], 1 );

    if ( is_home() || is_front_page() ) {

        if ( $show_on_home ) echo $wrap_before . $home_link . $wrap_after;

    } else {

        $position = 0;

        echo $wrap_before;

        if ( $show_home_link ) {
            $position += 1;
            echo $home_link;
        }

        if ( is_category() ) {
            $parents = get_ancestors( get_query_var('cat'), 'category' );
            foreach ( array_reverse( $parents ) as $cat ) {
                $position += 1;
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
            }
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                $cat = get_query_var('cat');
                echo $sep . sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_current ) {
                    if ( $position >= 1 ) echo $sep;
                    echo $before . sprintf( $text['category'], single_cat_title( '', false ) ) . $after;
                } elseif ( $show_last_sep ) echo $sep;
            }

        } elseif ( is_search() ) {
            if ( $show_home_link && $show_current || ! $show_current && $show_last_sep ) echo $sep;
            if ( $show_current ) echo $before . sprintf( $text['search'], get_search_query() ) . $after;

        } elseif ( is_year() ) {
            if ( $show_home_link && $show_current ) echo $sep;
            if ( $show_current ) echo $before . get_the_time('Y') . $after;
            elseif ( $show_home_link && $show_last_sep ) echo $sep;

        } elseif ( is_month() ) {
            if ( $show_home_link ) echo $sep;
            $position += 1;
            echo sprintf( $link, get_year_link( get_the_time('Y') ), get_the_time('Y'), $position );
            if ( $show_current ) echo $sep . $before . get_the_time('F') . $after;
            elseif ( $show_last_sep ) echo $sep;

        } elseif ( is_day() ) {
            if ( $show_home_link ) echo $sep;
            $position += 1;
            echo sprintf( $link, get_year_link( get_the_time('Y') ), get_the_time('Y'), $position ) . $sep;
            $position += 1;
            echo sprintf( $link, get_month_link( get_the_time('Y'), get_the_time('m') ), get_the_time('F'), $position );
            if ( $show_current ) echo $sep . $before . get_the_time('d') . $after;
            elseif ( $show_last_sep ) echo $sep;

        } elseif ( is_single() && ! is_attachment() ) {
            if ( get_post_type() != 'post' ) {
                $position += 1;
                $post_type = get_post_type_object( get_post_type() );
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->labels->name, $position );
                if ( $show_current ) echo $sep . $before . get_the_title() . $after;
                elseif ( $show_last_sep ) echo $sep;
            } else {
                $cat = get_the_category(); $catID = $cat[0]->cat_ID;
                $parents = get_ancestors( $catID, 'category' );
                $parents = array_reverse( $parents );
                $parents[] = $catID;
                foreach ( $parents as $cat ) {
                    $position += 1;
                    if ( $position > 1 ) echo $sep;
                    echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
                }
                if ( get_query_var( 'cpage' ) ) {
                    $position += 1;
                    echo $sep . sprintf( $link, get_permalink(), get_the_title(), $position );
                    echo $sep . $before . sprintf( $text['cpage'], get_query_var( 'cpage' ) ) . $after;
                } else {
                    if ( $show_current ) echo $sep . $before . get_the_title() . $after;
                    elseif ( $show_last_sep ) echo $sep;
                }
            }

        } elseif ( is_post_type_archive() ) {
            $post_type = get_post_type_object( get_post_type() );
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->label, $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_home_link && $show_current ) echo $sep;
                if ( $show_current ) echo $before . $post_type->label . $after;
                elseif ( $show_home_link && $show_last_sep ) echo $sep;
            }

        } elseif ( is_attachment() ) {
            $parent = get_post( $parent_id );
            $cat = get_the_category( $parent->ID ); $catID = $cat[0]->cat_ID;
            $parents = get_ancestors( $catID, 'category' );
            $parents = array_reverse( $parents );
            $parents[] = $catID;
            foreach ( $parents as $cat ) {
                $position += 1;
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
            }
            $position += 1;
            echo $sep . sprintf( $link, get_permalink( $parent ), $parent->post_title, $position );
            if ( $show_current ) echo $sep . $before . get_the_title() . $after;
            elseif ( $show_last_sep ) echo $sep;

        } elseif ( is_page() && ! $parent_id ) {
            if ( $show_home_link && $show_current ) echo $sep;
            if ( $show_current ) echo $before . get_the_title() . $after;
            elseif ( $show_home_link && $show_last_sep ) echo $sep;

        } elseif ( is_page() && $parent_id ) {
            $parents = get_post_ancestors( get_the_ID() );
            foreach ( array_reverse( $parents ) as $pageID ) {
                $position += 1;
                if ( $position > 1 ) echo $sep;
                echo sprintf( $link, get_page_link( $pageID ), get_the_title( $pageID ), $position );
            }
            if ( $show_current ) echo $sep . $before . get_the_title() . $after;
            elseif ( $show_last_sep ) echo $sep;

        } elseif ( is_tag() ) {
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                $tagID = get_query_var( 'tag_id' );
                echo $sep . sprintf( $link, get_tag_link( $tagID ), single_tag_title( '', false ), $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_home_link && $show_current ) echo $sep;
                if ( $show_current ) echo $before . sprintf( $text['tag'], single_tag_title( '', false ) ) . $after;
                elseif ( $show_home_link && $show_last_sep ) echo $sep;
            }

        } elseif ( is_author() ) {
            $author = get_userdata( get_query_var( 'author' ) );
            if ( get_query_var( 'paged' ) ) {
                $position += 1;
                echo $sep . sprintf( $link, get_author_posts_url( $author->ID ), sprintf( $text['author'], $author->display_name ), $position );
                echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
            } else {
                if ( $show_home_link && $show_current ) echo $sep;
                if ( $show_current ) echo $before . sprintf( $text['author'], $author->display_name ) . $after;
                elseif ( $show_home_link && $show_last_sep ) echo $sep;
            }

        } elseif ( is_404() ) {
            if ( $show_home_link && $show_current ) echo $sep;
            if ( $show_current ) echo $before . $text['404'] . $after;
            elseif ( $show_last_sep ) echo $sep;

        } elseif ( has_post_format() && ! is_singular() ) {
            if ( $show_home_link && $show_current ) echo $sep;
            echo get_post_format_string( get_post_format() );
        }

        echo $wrap_after;

    }
}

function show_blog_on_homepage() {
    $args = array( 'post_type' => 'post', 'posts_per_page' => 6, 'order'=> 'DESC' );
    $loop = new WP_Query( $args );
    if ( $loop->have_posts() ) : ?>
            <div class="row news_homepage">
            <?php
            $position = 0;
            while ( $loop->have_posts() ) : $loop->the_post();
            $position++;
                $post=get_post();
                $url = get_permalink( $post->ID );
               // $date = get_field('date');
             //   $id_of_program = get_field('name_of_program');
               // $program_url = get_permalink($id_of_program);
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
    <?php endif;
    wp_reset_query();
}

add_shortcode( 'blog_on_homepage', 'show_blog_on_homepage' );

function create_post_type() {

    $post_type_labels = array(
        'name' => __( 'Homepage Behance Slider', 'themename' ),
        'singular_name' => __( 'Behance Slider', 'themename' ),
        'add_new' => __( 'Add New', 'themename' ),
        'add_new_item' => __( 'Add New', 'themename' ),
        'edit_item' => __( 'Edit', 'themename' ),
        'new_item' => __( 'New', 'themename' ),
        'view_item' => __( 'View', 'themename' ),
        'search_items' => __( 'Search', 'themename' ),
        'not_found' => __( 'No found', 'themename' ),
        'not_found_in_trash' => __( 'No found in Trash', 'themename' ),
        'parent_item_colon' => '',
    );

    $post_type_args = array(
        'labels' => apply_filters( 'inspiry_property_post_type_labels', $post_type_labels ),
        'public' => true,
        'publicly_queryable' => false,
        'show_ui' => true,
        'query_var' => true,
        'has_archive' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_icon' => 'dashicons-format-gallery',
        'menu_position' => 5,
        'supports' => array( 'title', 'thumbnail','editor',  'page-attributes'  ),
        'rewrite' => array(
            'slug' => apply_filters( 'inspiry_property_slug',  'be-slider' ),
            'with_front' => false
        ),
    );
    register_post_type( 'be-slider', $post_type_args );

        $team_member_labels = array(
        'name' => __( 'Our team', 'themename' ),
        'singular_name' => __( 'Our team', 'themename' ),
        'add_new' => __( 'Add New ', 'themename' ),
        'add_new_item' => __( 'Add New', 'themename' ),
        'edit_item' => __( 'Edit', 'themename' ),
        'new_item' => __( 'New', 'themename' ),
        'view_item' => __( 'View', 'themename' ),
        'search_items' => __( 'Search', 'themename' ),
        'not_found' => __( 'No found', 'themename' ),
        'not_found_in_trash' => __( 'No found in Trash', 'themename' ),
        'parent_item_colon' => '',
    );

    $team_member_args = array(
        'labels' => apply_filters( 'inspiry_property_post_type_labels', $team_member_labels ),
        'public' => true,
        'publicly_queryable' => false,
        'show_ui' => true,
        'query_var' => true,
        'has_archive' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_icon' => 'dashicons-admin-users',
        'menu_position' => 6,
        'supports' => array( 'title', 'thumbnail', 'page-attributes'  ),
        'rewrite' => array(
            'slug' => apply_filters( 'inspiry_property_slug',  'team-members' ),
            'with_front' => false
        ),
    );
    register_post_type( 'team-members', $team_member_args );
	
	$team_member_labels = array(
        'name' => __( 'Portfolio', 'themename' ),
        'singular_name' => __( 'Portfolio', 'themename' ) 
    );

    $team_member_args = array(
        'labels' => apply_filters( 'inspiry_property_post_type_labels', $team_member_labels ),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'has_archive' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'menu_icon' => 'dashicons-media-spreadsheet',
        'menu_position' => 6,
        'supports' => array( 'title', 'thumbnail', 'editor','page-attributes'  ),
        'rewrite' => array(
            'slug' => apply_filters( 'inspiry_property_slug',  'portfolio' ) 
        ),
    );
    register_post_type( 'portfolio', $team_member_args );
	$feature_labels = array(
			'name' => __( 'Category portfolio', 'themename' ),
			'singular_name' => __( 'Category portfolio', 'themename' ) 
		);

		register_taxonomy(
			'portfolio-category',
			array( 'portfolio' ),
			array(
				'hierarchical' => true,
				'labels' => apply_filters( 'inspiry_property_feature_labels', $feature_labels ),
				'show_ui' => true,
				'query_var' => true,
				'rewrite' => array(
					'slug' => apply_filters( 'inspiry_property_feature_slug',  'portfolio-category'  ),
				),
			)
		);

}
add_action( 'init', 'create_post_type' );

function show_portfolio_on_homepage() { 
    $args = array( 'post_type' => 'portfolio', 'posts_per_page' => -1, 'orderby' => 'menu_order','order'=> 'ASC' );
    $loop = new WP_Query( $args );
    if ( $loop->have_posts() ) : ?>
        <div class="row slider_sticks portfolio_sticks">
            <?php
            $position = 0;
            while ( $loop->have_posts() ) : $loop->the_post();
                $post=get_post();
                $url = get_permalink( $post->ID );
                $category = '';
                $link = get_field('link');
                $homa_page = get_field('homa_page');
				$terms = get_the_terms($post->ID, 'portfolio-category' );
				if (is_array($terms)) {
					if (isset($terms[0]->name))  $category = $terms[0]->name;
				}
	
	if($homa_page == TRUE){
	
                ?>
                <div class="col-auto padding-68">
                    <?php
                    $related_img=get_the_post_thumbnail_url( $post->ID, 'large' );
                    ?>
                    <a href="<?php echo $url ;?>" title="<?php the_title();?>">
                        <div class="stick">
                            <?php if ( $category!='' ) { ?>
                                <div class="category"><h5 class="color-white"><?php echo $category; ?></h5></div>
                            <?php } ?>
                            <div class="title"><h4 class="color-white"><?php the_title();?></h4></div>
                                <div class="stick_bg" style="background-image: url('<?php echo $related_img;?>')"></div>
                        </div>
                    </a>
                </div>
            <?php
		}
            endwhile; ?>
        </div>
    <?php endif;
    wp_reset_query();
}

add_shortcode( 'portfolio_on_homepage', 'show_portfolio_on_homepage' );

function show_team_on_our_team_page() { 
    $args = array( 'post_type' => 'team-members', 'posts_per_page' => -1, 'orderby' => 'menu_order','order'=> 'ASC' );
    $loop = new WP_Query( $args );
    if ( $loop->have_posts() ) : ?>
        <div class="row ">
            <?php
            $position = 0;
            while ( $loop->have_posts() ) : $loop->the_post();
                $post=get_post();
                //$url = get_permalink( $post->ID );
                $team_member_name = get_field('name_our_team');
                $team_member_job_position = get_field('job_position_our_team');
                ?>
                <div class="col-6 col-md-4 team_cards_section">
                    <?php
                    $related_img=get_the_post_thumbnail_url( $post->ID, 'large' );
                    ?>                
                  <img src="<?php echo $related_img;?>" alt="<?php echo $team_member_name; ?>">
                  <h4><?php echo $team_member_name; ?></h4>
                  <h5><?php echo $team_member_job_position; ?></h5>   
                    
                </div>
            <?php
            endwhile; ?>
        </div>
    <?php endif;
    wp_reset_query();
}

add_shortcode( 'team_on_our_team_page', 'show_team_on_our_team_page' );

function show_portfolio_by_category($atts) {
    $cat_name = $atts['show'];
    $args = array( 'post_type' => 'be-slider', 'posts_per_page' => -1, 'orderby' => 'menu_order','order'=> 'ASC', 'meta_key'=> 'category','meta_value' => $cat_name );

    $loop = new WP_Query( $args );
    if ( $loop->have_posts() ) : ?>
        <div class="row slider_sticks portfolio_sticks cat_sticks">
            <?php
            while ( $loop->have_posts() ) : $loop->the_post();
                $post=get_post();
                $category = get_field('category');
                $link = get_field('link');
                ?>
                <div class="col-auto padding-68">
                    <?php
                    $related_img=get_the_post_thumbnail_url( $post->ID, 'large' );
                    ?>
                    <a href="<?php echo $link ;?>" title="<?php the_title();?>">
                        <div class="stick">
                            <?php if ( $category!='' ) { ?>
                                <div class="category"><h5 class="color-white"><?php echo $category; ?></h5></div>
                            <?php } ?>
                            <div class="title"><h4 class="color-white"><?php the_title();?></h4></div>
                            <div class="stick_bg" style="background-image: url('<?php echo $related_img;?>')"></div>
                        </div>
                    </a>
                </div>
            <?php
            endwhile; ?>
        </div>
    <?php endif;
    wp_reset_query();
}

add_shortcode( 'portfolio_by_cat', 'show_portfolio_by_category' );


add_filter('manage_posts_columns', 'posts_columns_id', 5);
add_action('manage_posts_custom_column', 'posts_custom_id_columns', 5, 2);
add_filter('manage_pages_columns', 'posts_columns_id', 5);
add_action('manage_pages_custom_column', 'posts_custom_id_columns', 5, 2);

function posts_columns_id($defaults){
    $defaults['wps_post_id'] = __('ID');
    return $defaults;
}
function posts_custom_id_columns($column_name, $id){
    if($column_name === 'wps_post_id'){
        echo $id;
    }
}

add_action( 'wp_footer', 'mycustom_wp_footer' );

function mycustom_wp_footer() {
    ?>
    <script>

        jQuery(function ($) {
            var username;
            $("#appform_show form .wpcf7-submit").on("click", function(){
                username=$(".text-70 input").val();

            })
            jQuery(document).ajaxComplete(function() {

                if (jQuery("#appform_show .wpcf7-mail-sent-ok").length) {
                    $('.content_appform_show').css('animation-name','fadeOutDown');
                    $('.content_appform_show').css('margin-top','17%');
                    setTimeout(
                        function()
                        {
                            $('.content_appform_show').html('<div style="width: 100%; text-align: center"><h2 style="width: 100%">Dear '+ username + ',</h2><h3>thanks for Your request.</h3><h6>We will reply on Your request as soon as possible!</h6>');
                            $('.content_appform_show').css('animation-name','fadeInDown');
                        }, 1000);
                    setTimeout(
                        function()
                        {
                            $('.content_appform_show').css('animation-name','fadeOutDown');
                        }, 7000);
                    setTimeout(
                        function()
                        {
                            $('#appform_show').css('animation-name','fadeOut');
                        }, 7800);
                    setTimeout(
                        function()
                        {
                            jQuery('#appform_show').css('display','none');
                            $('.content_appform_show').css('animation-name','fadeInDown');
                            $('#appform_show').css('animation-name','fadeIn');
                        }, 7900);
                }
            });
        });
    </script>
    <?php
}
 

add_action( 'template_redirect', 'cyb_add_last_modified_header' );
function cyb_add_last_modified_header() { 
	if( is_singular() ) {
            $post_id = get_queried_object_id();
            $LastModified = gmdate("D, d M Y H:i:s \G\M\T", $post_id);
            $LastModified_unix = gmdate("D, d M Y H:i:s \G\M\T", $post_id);
            $IfModifiedSince = false;
            if( $post_id ) {
                if (isset($_ENV['HTTP_IF_MODIFIED_SINCE']))
                    $IfModifiedSince = strtotime(substr($_ENV['HTTP_IF_MODIFIED_SINCE'], 5));  
                if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']))
                    $IfModifiedSince = strtotime(substr($_SERVER['HTTP_IF_MODIFIED_SINCE'], 5));
                if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix) {
                    header($_SERVER['SERVER_PROTOCOL'] . ' 304 Not Modified');
                    exit;
                } 
     header("Last-Modified: " . get_the_modified_time("D, d M Y H:i:s", $post_id) );
                }
        }
}


function portfolio_link_func($attr) {
	global $post;
	$ret='';
	if (isset($attr['text'])) {
		if (isset($post->ID)) {
			$client_site_url=get_field('client_site_url',$post->ID);
			if ($client_site_url!='') {
				$ret.='<div class="portfolio_buts"><a href="'.$client_site_url.'" target="_blank">'.$attr['text'].'</a></div>';
			}
		}
	}
    return $ret;
}

add_shortcode( 'portfolio_link', 'portfolio_link_func' );
