<?php get_header(); ?>
<div class="single underContents">
	<div class="inner">
		<?php if(have_posts()):while(have_posts()):the_post(); ?>
		<?php
		$postId = $post->ID;
			
		// image
		$thumbnailId = get_post_thumbnail_id();
		$imageUrl = '';
		if($thumbnailId){
			$thumbnailInfo = wp_get_attachment_image_src( $thumbnailId , 'full' );
			$imageUrl = $thumbnailInfo[0];
		}else{
			global $noImage_mainImg;
			$imageUrl = $noImage_mainImg;
		}
		
		?>
		<h2><?php the_title(); ?></h2>
		<div class="photo"><img src="<?php echo $imageUrl; ?>" alt="" /></div>
		<div class="text singleText">
			<?php the_content(); ?>
		</div>
		<?php endwhile;endif; ?>
	</div>
</div><!--single-->
<?php get_footer(); ?>