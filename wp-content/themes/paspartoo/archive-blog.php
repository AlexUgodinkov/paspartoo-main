<?php  get_header(); ?>
 <?php 
$thumb_url=wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');

?> 
<div class="header_block">
<div class="background_footer"></div>
<div class="background"></div>
<div class="image"  data-parallax="scroll" data-position="top" data-bleed="0" 
 data-image-src="<?php print $thumb_url[0];?>" ></div>
</div> 
<div class="container page_block">
	<div class="row">
		<div class="col-12">
			<div class="page_block_background ">
			<h1 class="text_center small h1_black"><?php echo get_the_title( get_option('page_for_posts', true) );?></h1>
			<div class="page_content row">
			<?php if ( have_posts() ) :  ?>
			<?php
			while ( have_posts() ) : 
				the_post(); 
				$img='';
				$image_id = get_post_thumbnail_id(get_the_ID());   
				$urls=wp_get_attachment_image_src($image_id,'medium'); 
				if (isset($urls[0])) {  $img=$urls[0];} 
				?>
		<div class="col-12 col-lg-4 col-md-6 col-sm-12">
			<div class="stick">
			<?php if ($img!='') { ?><a href="<?php the_permalink(get_the_ID());?>" class="image" style="background-image:url(<?php print $img;?>)"></a><?php } ?>	
			<div class="inform">	 
			<a href="<?php the_permalink(get_the_ID());?>" class="title h4"><?php the_title(); ?></a>	
			<?php the_excerpt();  ?>
			<div class="related_button">
				<?php $button_text = get_field('button_text'); ?>
				<a href='<?php the_permalink(get_the_ID());?>'><?php echo $button_text;?></a>
			</div>
			</div>
			</div>		
		</div>
	<?php endwhile; ?>	
<?php endif;?> 
			</div>

			<div class="col-12">
<?php the_posts_pagination( array('prev_text' => '<i class="fas fa-angle-left"></i>','next_text' => '<i class="fas fa-angle-right"></i>','before_page_number' => '','screen_reader_text' =>'') ); ?>				
</div>
			
			</div>
		</div>
	</div>
</div>		
<?php get_footer(); ?>  