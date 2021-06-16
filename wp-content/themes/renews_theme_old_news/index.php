<?php get_header(); ?>


<section class="sec sec_mv">
	<div class="inner_base">
		<?php
		$wp_query = new WP_Query();

		$args = array(
			'post_type' => 'post',
			'posts_per_page' => "-1",
			'post_status' => 'publish',
			'orderby' => 'date',
			'order' => 'DESC'
		);

		$wp_query->query($args);
		if($wp_query->have_posts()):
		?>
		<div class="content_article">
			<div class="wrap_article_middle flex colum2">
		<?php while($wp_query->have_posts()) : $wp_query->the_post(); ?>
		<?php $postId = $post->ID;
		// アイキャッチ
		$thumbnail_id = get_post_thumbnail_id();
		$imageUrl = '';
		if($thumbnail_id){
			$image = wp_get_attachment_image_src($thumbnail_id,'large');
			$imageUrl = $image[0];
		}else{
			$imageUrl = get_template_directory_uri().'/images/icon/noimg.jpg';
		}
		// タイトル
		$title = mb_strimwidth( $post->post_title, 0, 66, "...", "UTF-8" );

		$series_terms = get_the_terms($post->ID, 'category');
		?>
				<div class="article_middle">
					<div class="wrap_img">
						<div class="article_middle_img imgLiquidFill">
							<img src="<?php echo $imageUrl; ?>" alt="" />
						</div>
					</div>

					<div class="textbox middle left_bottom">
						<?php if(!empty($series_terms)): ?>
						<?php foreach($series_terms as $ct):
//						$series_type = get_field('series_type','series_'.$ct->term_id)[0];
						?>
						<p class="series_name">
							<?php echo $ct->name; ?>
						</p>
						<?php endforeach; ?>
						<?php endif; ?>
					
						<a href="<?php the_permalink(); ?>">
							<h2 class="title_middle"><?php echo $title; ?></h2>
						</a>
					</div>
				</div><!-- /.article_middle -->
		<?php endwhile; ?>
			</div><!-- /.wrap_article_middle -->
		</div><!-- /.content_article -->
		<?php endif; wp_reset_query(); ?>
		
	</div>
</section>


<?php get_footer(); ?>