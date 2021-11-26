<?php get_header();?>
<?php
$client_name=get_field('client_name');
$client_site_url=get_field('client_site_url');
$year=get_field('year'); 
$text=get_field('text');
$title=get_field('title');
?>
<div class="portfolio_content_header ">
<div class="container">
<div class="row">
<div class="col-12">
<h1><?php if ($title=='') {the_title();} else print $title;?></h1>
</div>
</div>
<div class="row dann">
<?php
if ($client_name!='') {
	print '<div class="col-auto name"><b>'.__('Client','themename').':</b> ';
	if ($client_site_url!='') print '<a href="'.$client_site_url.'" target="_blank">';
	print $client_name;
	if ($client_site_url!='') print '</a>';
	print '</div>';
}
if ($year!='') {
	print '<div class="col-auto year"><b>'.__('Year','themename').':</b> '; 
	print $year; 
	print '</div>';
}
print '<div class="col cat">';
$terms = get_the_terms(get_the_ID(), 'portfolio-category' );
if (is_array($terms)) {
	print '<b>'.__('Category','themename').':&nbsp;</b>';
	$i=1;
	$txt='';
	foreach ($terms as $term) {
		$span=', ';
		if ($i==1) $span='';
		$txt.= ''.$span.'<a href="'.get_term_link($term->term_id).'">'.$term->name.'</a>';
		$i++;
	}
	print $txt;
}
print '</div>';
if ($client_site_url!='') {
	print '<div class="col-auto portfolio_buts"><a href="'.$client_site_url.'" target="_blank">'.__('visit the website','themename').'</a></div>';
}
?>
</div>
<?php 
if ($text!='') { ?>
<div class="row">
<div class="col-12 "><div class="text">
<?php print $text;?>
</div></div>
</div>
<?php } ?>
</div>
</div>
<div class="portfolio_content">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php the_content();?>
<?php endwhile; endif; ?>
</div>
<div class="portfolio_projects">
<div class="container">
<h2><?php _e('Recent Projects','themename');?></h2>
</div>
<div class="portfolio_projects_slider">
<?php
$meta_query=array();
$meta_query[] = array(
					'key' => 'no-index',
					'value' => 0,
					'type' => 'NUMERIC',
					'compare' => '='
				);
$args = array( 'post_type' => 'portfolio', 'posts_per_page' => -1, 'orderby' => 'menu_order','order'=> 'ASC','post__not_in'=>array(get_the_ID()),'meta_query'=>$meta_query );

    $loop = new WP_Query( $args );
    if ( $loop->have_posts() ) : ?>
        
            <?php
            while ( $loop->have_posts() ) : $loop->the_post();
                $post=get_post();
                $category = '';
                $link = get_field('link');
				$terms = get_the_terms($post->ID, 'portfolio-category' );
				if (is_array($terms)) {
					if (isset($terms[0]->name))  $category = $terms[0]->name;
				}
				$noindex=(int)get_field('no-index',get_the_ID());
				$ni='';
				if ($noindex==1) { $ni=' rel="nofollow" '; }
                ?>
                <div class="item">
                    <?php
                    $related_img=get_the_post_thumbnail_url( $post->ID, 'large' );
                    ?>
					<?php if ($noindex==1) { print '<noindex>'; } ?>
                    <a href="<?php echo the_permalink($post->ID);?>" title="<?php the_title();?>"  <?php print $ni;?>>
                        <div class="stick">
                            <?php if ( $category!='' ) { ?>
                                <div class="category"><h5 class="color-white"><?php echo $category; ?></h5></div>
                            <?php } ?>
                            <div class="title"><h4 class="color-white"><?php the_title();?></h4></div>
                            <div class="stick_bg" style="background-image: url('<?php echo $related_img;?>')"></div>
                        </div>
                    </a>
					<?php if ($noindex==1) { print '</noindex>'; } ?>
                </div>
            <?php
            endwhile; ?> 
    <?php endif;
    wp_reset_query();
	?>
</div>
</div>


<div class="portfolio_form">
<div class="container">
<h2><?php _e('Ready to get started?','themename');?></h2>
<?php print do_shortcode('[contact-form-7 id="2266" title="Contact Portfolio"]');?>
</div>
</div>
<?php get_footer(); ?>