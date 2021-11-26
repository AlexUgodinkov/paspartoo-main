<?php 
  get_header(); 
 $cat = get_term_by('name', single_cat_title('',false), 'portfolio-category');  
  $pages = get_pages(array('meta_key' => '_wp_page_template', 'meta_value' => 'template-portfolio.php'));
$id=0;$title='';
if (isset($pages[0]->ID)) {$id=$pages[0]->ID;$title=$pages[0]->post_title;} 
  ?> 
  
<link rel="stylesheet" type="text/css" href="<?php echo get_site_url(); ?>/wp-content/themes/paspartoo/css/animate.min.css">
    <div class="page_for_posts">
    <div class="container page_header">
        <div class="row">
            <div class="col-12  breadcrumbs padding-42  text-center ">
			
			
			<div class="breadcrumbs_style" itemscope="" itemtype="http://schema.org/BreadcrumbList">
			<span itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
			<a class="breadcrumbs__link" href="<?php print get_home_url();?>" itemprop="item"><span itemprop="name">Home</span></a>
			<meta itemprop="position" content="1"></span><span class="breadcrumbs__separator"> / </span>
			<a class="breadcrumbs__link" href="<?php  echo get_permalink( $id);?>" itemprop="item"><span itemprop="name"><?php print $title;?></span></a>
			<meta itemprop="position" content="1"></span><span class="breadcrumbs__separator"> / </span>
			<span class="breadcrumbs__current"><?php print $cat->name;  ?></span>
			</div>
			
			
               
            </div>
            <div class="col-12 text-center color-blue page_title padding-42">
                <h1><?php print $cat->name;  ?>
            </h1>
            </div>
        </div>
    </div>
    <div class="container padding-110-bottom">
 <div class="row categories">
            <div class="col-12">
                <?php $args = array('taxonomy' => 'portfolio-category' );
                $terms = get_terms( $args );?>
                <div class="row row justify-content-center  padding-42 padding-42-bottom portfolio_cats">
                    <div class="cat_but "><a href="<?php echo get_permalink( $id); ?>">All</a></div>
                    <?php
                    foreach ($terms as $termses) :
                        $class="";
                        if ($termses->term_id==$cat->term_id) $class=' current ';
                        print '<div class="cat_but '.$class.'"><a href="'.get_term_link($termses->term_id).'">'.$termses->name.'</a></div>';
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
<div class="row news_homepage">
        <?php
		$meta_query=array();
		$meta_query[] = array(
					'key' => 'no-index',
					'value' => 0,
					'type' => 'NUMERIC',
					'compare' => '='
				);
				
        $args = array( 'post_type' => 'portfolio', 'posts_per_page' => -1, 'orderby' => 'menu_order','order'=> 'ASC','meta_query'=>$meta_query,'tax_query' => array(
                array(
                    'taxonomy' => 'portfolio-category',
                    'field'    => 'id',
                    'terms'    => $cat->term_id
                )
            )  );

    $loop = new WP_Query( $args );
    if ( $loop->have_posts() ) : 
	  while ( $loop->have_posts() ) : $loop->the_post();
                $post=get_post();
                $category = '';
                $link = get_field('link');
				$terms = get_the_terms($post->ID, 'portfolio-category' );
				if (is_array($terms)) {
					if (isset($terms[0]->name))  $category = $terms[0]->name;
				} 
            ?>
            <div class="col-md-4 padding-42">
                <?php
                $related_img=get_the_post_thumbnail_url( $post->ID, 'large' );
				$noindex=(int)get_field('no-index',get_the_ID());
				$ni='';
				if ($noindex==1) { $ni=' rel="nofollow" '; }
                ?>
				<?php if ($noindex==1) { print '<noindex>'; } ?>
                <a href="<?php  echo the_permalink($post->ID);?>" title="<?php the_title();?>" <?php print $ni;?>>
                    <div class="stick pictured">
                        <?php if ( $category!='' ) { ?>
                                <div class="category"><h5 class="color-white"><?php echo $category; ?></h5></div>
                            <?php } ?>
                        <div class="title"><h3><?php the_title();?></h3></div>
                        <div class="stick_bg" style="background-image: url('<?php echo $related_img;?>')"></div>
                         
                    </div>
                </a>
				<?php if ($noindex==1) { print '</noindex>'; } ?>
            </div>
        <?php
       endwhile; ?> 
    <?php endif;
    wp_reset_query(); ?>
    </div>
</div>	
</div>	
  
<?php get_footer('noform'); ?>