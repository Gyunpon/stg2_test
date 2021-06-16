<?php get_header(); ?>

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

$series_terms = get_the_terms($postId,'category');

//SNSシェア
//元となるテキスト
$text = get_the_title();
//URLエンコード処理
$encoded = rawurlencode( $text ) ;


		?>

<section class="sec sec_article_detail">
	
	<div class="inner_base mv">
		<div class="content_article_mv">
			<div class="content_mv_article_detail">
				<div class="article_main_img imgLiquidFill">
					<img src="<?php echo $imageUrl; ?>" alt="メインビジュアルイメージ" />
				</div>
				<div class="textbox large big">

					<?php if(!empty($series_terms)): ?>
					<?php foreach($series_terms as $ct):
					$taxonomy_name = 'category'; // タクソノミーのスラッグ名を入れる
					//					$series_type = get_field('series_type','series_'.$ct->term_id)[0];
					$url = get_term_link($ct->slug, $taxonomy_name);
					?>
					<a href="<?php echo $url; ?>" class="series_name">
						<span class="series_text">
							<?php echo $ct->name; ?>
						</span>
					</a>
					<?php endforeach; ?>
					<?php endif; ?>

					<h1 class="title_big">
						<?php the_title(); ?>
					</h1>

				</div>
			</div>
			<!-- /.content_mv -->
		</div>
		<!-- /.content_article_mv -->
	</div><!-- /.inner_base -->

	<div class="content_article_detail">
		<div class="inner_base">
			<div class="article_detail">
				<div class="head_article_detail flex">
				</div><!-- /.head_article_detail -->

				<div class="inner_article_detail cf">
					<div class="singleText">

						<?php the_content(); ?>
					</div>
										
										
					<div class="pageLinkWrap">
						<div class="prev pagelink"><?php previous_post_link(); ?></div>
						<div class="next pagelink"><?php next_post_link(); ?></div>
					</div>
					
				</div><!-- inner_article_detail -->
			</div><!-- /.article_detail -->
		</div><!-- /.inner_base -->
	</div><!-- /.content_article_detail -->
</section>

		
		<?php endwhile;endif; ?>



<?php get_footer(); ?>