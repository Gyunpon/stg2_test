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

//ユーザー
//$user_name = get_the_author_meta( 'display_name', $post->post_author );
//$renews_id = get_the_author_meta( 'user_login', $post->post_author );

//イラストレーター illust
$illustby = get_field('illustrator');
$illustratorName = $illustby['illustrator_name'];
$illustratorPhotoId = $illustby['illustrator_photo'];
$illust_iconCheck = $illustby['icon_check'];
if($illustratorPhotoId){
	$illustInfo = wp_get_attachment_image_src( $illustratorPhotoId , 'square-thumbnails' );
	$illustIcon = $illustInfo[0];
}

//カメラマン photo
$photoby = get_field('photographer');
$photographerName = $photoby['photographer_name'];
$photographerPhotoId = $photoby['photographer_photo'];
$photo_iconCheck = $photoby['icon_check'];
if($photographerPhotoId){
	$photoInfo = wp_get_attachment_image_src( $photographerPhotoId , 'square-thumbnails' );
	$photoIcon = $photoInfo[0];
}

$postTax = get_object_taxonomies($post);
$series_terms = get_the_terms($postId,'series');

//SNSシェア
//元となるテキスト
$text = 'RENEWS | 『'.get_the_title().'』';
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
					$taxonomy_name = 'series'; // タクソノミーのスラッグ名を入れる
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

				
					<?php if(!empty($postTax)): ?>
					<div class="top_tags">
						<?php foreach($postTax as $taxName): ?>
						<?php
						$postTerms = get_the_terms($postId, $taxName);
						if(!empty($postTerms)):
						?>
						<?php foreach($postTerms as $t):
						if(!($t->taxonomy == 'series')):
						$tag_link = get_category_link($t->term_id);
						?>
						<?php if($t->taxonomy == 'agenda'): ?>
						<a href="<?php echo $tag_link; ?>" class="border_green slider_green color_green hover_white">
							<p>#<?php echo $t->name; ?></p>
						</a>
						<?php else: ?>
						<a href="<?php echo $tag_link; ?>" class="border_blue slider_blue color_blue hover_white">
							<p>#<?php echo $t->name; ?></p>
						</a>
						<?php endif; ?>
						<?php
						endif;
						endforeach; ?>
						<?php endif; ?>
						<?php endforeach; ?>
					</div><!-- top_tags -->
					<?php endif; ?>
				
				
					<div class="flex wrap_label_article_mv cf">
						<?php if(have_rows('author_select')): ?>
						<?php while(have_rows('author_select')): the_row();
						$user_data = get_sub_field('author');
						$author_iconCheck = get_sub_field('icon_check');
						
						if(!($user_data)){
							$user_name = get_the_author_meta( 'display_name', $post->post_author );
							$renews_id = get_the_author_meta( 'user_login', $post->post_author );
							$user_avatar = get_avatar( get_the_author_meta( 'ID' ), 64 );
						}else{
							$user_name = $user_data['display_name'];
							$renews_id = $user_data['user_nicename'];
							$user_avatar = $user_data['user_avatar'];
						}
						
						?>
						<div class="wrap_avatar flex">
							<?php if($author_iconCheck): ?>
							<div class="textbox_avatar">
								<?php echo $user_avatar; ?>
							</div>
							<?php endif; ?>
							<p class="title_avatar story eng">
								<span class="black"><?php echo $user_name; ?></span>
								<br>
								<span>@<?php echo $renews_id; ?></span>
							</p>
						</div>
						<?php endwhile; ?>
						<?php endif; ?>

					
						<?php if(have_rows('editor_select')): ?>
						<?php while(have_rows('editor_select')): the_row();
						$editor_data = get_sub_field('editor');
						$editor_iconCheck = get_sub_field('icon_check');
						?>
						<div class="wrap_avatar flex">
							<?php if($editor_iconCheck): ?>
							<div class="textbox_avatar">
								<?php echo $editor_data['user_avatar']; ?>
							</div>
							<?php endif; ?>
							<p class="title_avatar edited eng">
								<span class="black"><?php echo $editor_data['display_name']; ?></span>
								<br>
								<span>@<?php echo $editor_data['user_nicename']; ?></span>
							</p>
						</div>
						<?php endwhile; ?>
						<?php endif; ?>

						<?php if($illustratorName): ?>
						<div class="wrap_avatar flex">
							<?php if($illust_iconCheck): ?>
							<div class="textbox_avatar">
								<img src="<?php echo $illustIcon; ?>" alt="アバター" />
							</div>
							<?php endif; ?>
							<p class="title_avatar illustrated eng">
								<span class="black"><?php echo $illustratorName; ?></span>
								<br>
							</p>
						</div>
						<?php endif; ?>
						
						
						<?php if($photographerName): ?>
						<div class="wrap_avatar flex">
							<?php if($photo_iconCheck): ?>
							<div class="textbox_avatar">
								<img src="<?php echo $photoIcon; ?>" alt="アバター" />
							</div>
							<?php endif; ?>
							<p class="title_avatar photo eng">
								<span class="black"><?php echo $photographerName; ?></span>
								<br>
							</p>
						</div>
						<?php endif; ?>
					</div>
					<div class="wrap_social color_black flex">
						<div class="socialbox datebox"><?php echo get_the_time('Y.m.d'); ?></div>
						<div class="socialbox likebox"><?php if(function_exists('wp_ulike_comments')) wp_ulike('get'); ?></div>
						<a class="socialbox commentbox" href="#commentsAreaWrap"><?php comments_number( '0', '1', '%' ); ?></a>
					</div>
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
					<div class="btn_share head">
						<div class="share-btn twitter">
							<a href="https://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php echo $encoded; ?>" class="share_popup" target="_blank">
								<img src="<?php echo get_template_directory_uri(); ?>/images/icons/twitter.svg" alt="twitter" />
							</a>
						</div>
						<div class="share-btn facebook">
							<a href="https://www.facebook.com/sharer/sharer.php?u=<?php rawurlencode(the_permalink()); ?>" class="share_popup" target="_blank">
								<img src="<?php echo get_template_directory_uri(); ?>/images/icons/fb.svg" alt="facebook" />
							</a>
						</div>
<!--
						<div class="share-btn instagram">
							<a href="https://b.hatena.ne.jp/entry/renews.jp" target="_blank">
								<img src="<?php echo get_template_directory_uri(); ?>/images/icons/instagram.svg" alt="instagram" />
							</a>
						</div>
-->
						<div class="share-btn line">
							<a href="https://social-plugins.line.me/lineit/share?url=<?php rawurlencode(the_permalink()); ?>" class="share_popup" target="_blank">
								<img src="<?php echo get_template_directory_uri(); ?>/images/icons/line.svg" alt="line" />
							</a>
						</div>
						<div class="share-btn hatena">
							<a href="http://b.hatena.ne.jp/add?mode=confirm&url=<?php rawurlencode(the_permalink()); ?>&title=<?php echo $encoded; ?>" class="share_popup" target="_blank" rel="nofollow">
								<img src="<?php echo get_template_directory_uri(); ?>/images/icons/hatena.svg" alt="hatena" />
							</a>
						</div>
					</div><!-- /.btn_share -->
				</div><!-- /.head_article_detail -->

				<div class="inner_article_detail cf">
				<!-- 抜粋 -->
				<?php
					$excerpt = get_the_excerpt();
					if($excerpt != ''): ?>
					<div class="embed excerpt title_component mb-50">
						<div class="reference"><?php echo $excerpt; ?></div>
					</div>
					<hr />
				<?php endif; ?>
				
				<!-- 本文エリア -->
					<div class="singleText">
						<?php the_content(); ?>
					</div>
					
					
					<div class="singleRenewerBlockWrap">
						<div class="singleRenewerBlock">
							<?php if(have_rows('author_select')): ?>
							<?php while(have_rows('author_select')): the_row();
							$user_data = get_sub_field('author');

								$user_name = $user_data['display_name'];
								$renews_id = $user_data['user_nicename'];
								$user_avatar = $user_data['user_avatar'];
							$user_description = $user_data['user_description'];
							?>
							<div class="renewerIntroParts">
								<dl>
									<dt><div class="userIcon"><?php echo $user_avatar; ?></div></dt>
									<dd>
										<p class="renewerName"><?php echo $user_name; ?> <span>@<?php echo $renews_id; ?></span></p>
										<?php if($user_description): ?>
										<div class="introText">
											<?php echo $user_description; ?>
										</div>
										<?php endif; ?>
									</dd>
								</dl>
							</div>
							<?php endwhile; ?>
							<?php else: ?>
<?php 
							$user_name = get_the_author_meta( 'display_name', $post->post_author );
							$renews_id = get_the_author_meta( 'user_login', $post->post_author );
							$user_avatar = get_avatar( get_the_author_meta( 'ID' ), 64 );
							$user_description = get_the_author_meta( 'description', $post->post_author );
							?>
							<div class="renewerIntroParts">
								<dl>
									<dt><div class="userIcon"><?php echo $user_avatar; ?></div></dt>
									<dd>
										<p class="renewerName"><?php echo $user_name; ?> <span>@<?php echo $renews_id; ?></span></p>
										<?php if($user_description): ?>
										<div class="introText">
											<?php echo $user_description; ?>
										</div>
										<?php endif; ?>
									</dd>
								</dl>
							</div>
							<?php endif; ?>
						</div>
					</div>
					
					
					<div class="clearfix">
					<div class="btn_share last">
						<div class="share-btn twitter">
							<a href="https://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php echo $encoded; ?>" class="share_popup" target="_blank">
								<img src="<?php echo get_template_directory_uri(); ?>/images/icons/twitter.svg" alt="twitter" />
							</a>
						</div>
						<div class="share-btn facebook">
							<a href="https://www.facebook.com/sharer/sharer.php?u=<?php rawurlencode(the_permalink()); ?>" class="share_popup" target="_blank">
								<img src="<?php echo get_template_directory_uri(); ?>/images/icons/fb.svg" alt="facebook" />
							</a>
						</div>
						<!--
<div class="share-btn instagram">
<a href="https://b.hatena.ne.jp/entry/renews.jp" target="_blank">
<img src="<?php echo get_template_directory_uri(); ?>/images/icons/instagram.svg" alt="instagram" />
</a>
</div>
-->
						<div class="share-btn line">
							<a href="https://social-plugins.line.me/lineit/share?url=<?php rawurlencode(the_permalink()); ?>" class="share_popup" target="_blank">
								<img src="<?php echo get_template_directory_uri(); ?>/images/icons/line.svg" alt="line" />
							</a>
						</div>
						<div class="share-btn hatena">
							<a href="http://b.hatena.ne.jp/add?mode=confirm&url=<?php rawurlencode(the_permalink()); ?>&title=<?php echo $encoded; ?>" class="share_popup" target="_blank" rel="nofollow">
								<img src="<?php echo get_template_directory_uri(); ?>/images/icons/hatena.svg" alt="hatena" />
							</a>
						</div>
					</div><!-- /.btn_share -->
					</div><!-- clearfix -->
				</div><!-- inner_article_detail -->
			</div><!-- /.article_detail -->
		</div><!-- /.inner_base -->
	</div><!-- /.content_article_detail -->
</section>


<section id="commentsAreaWrap" class="sec sec_comment">
	<div class="content_article_detail">
		<div class="inner_base">
			<div class="article_detail">
				<div class="inner_article_detail">

					<?php comments_template( '', true ); ?>

				</div>
			</div>
		</div>
	</div>
</section>
	
		
		<?php endwhile;endif; ?>



<!-- 関連記事 -->
<?php
$posts = get_field('article_relation');
if( $posts ):
?>
<div class="content_article">
	<div class="inner_base">
	<div class="wrap_article_middle flex colum3">
	<?php foreach( $posts as $val ):

	// アイキャッチ
	$thumbnail_id = get_post_thumbnail_id($val->ID);
	$imageUrl = '';
	if($thumbnail_id){
		$image = wp_get_attachment_image_src($thumbnail_id,'large');
		$imageUrl = $image[0];
	}else{
		$imageUrl = get_template_directory_uri().'/images/icon/noimg.jpg';
	}
		//タイトル
		$title_base = get_the_title( $val->ID );
		$title = mb_strimwidth( $title_base, 0, 66, "...", "UTF-8" );
		$series_terms = get_the_terms($val->ID,'series');
		//コメント
		$comments = wp_count_comments( $val->ID );
	?>
<div class="article_middle">
	<div class="article_middle_img imgLiquidFill">
		<a href="<?php the_permalink($val->ID); ?>">
		<img src="<?php echo $imageUrl; ?>" alt="<?php echo $title; ?> サムネイル" />
		</a>
	</div>

	<div class="textbox middle left_bottom">
		<?php if(!empty($series_terms)): ?>
		<?php foreach($series_terms as $ct):
//		$series_type = get_field('series_type','series_'.$ct->term_id)[0];
		?>
		<span class="series_name">
			<?php echo $ct->name; ?>
		</span>
		<?php endforeach; ?>
		<?php endif; ?>
		<a href="<?php the_permalink($val->ID); ?>">
			<h2 class="title_middle">
				<?php echo $title; ?>
			</h2>
		</a>
		
		<?php 
		if(!($first_row_item)){
			$user_name = get_the_author_meta( 'display_name', $post->post_author );
			$renews_id = get_the_author_meta( 'user_login', $post->post_author );
			$user_avatar = get_avatar( get_the_author_meta( 'ID' ), 64 );
		}else{
			$user_name = $first_row_item['display_name'];
			$renews_id = $first_row_item['user_nicename'];
			$user_avatar = $first_row_item['user_avatar'];
		}
		?>
		
		<a href="<?php echo home_url(); ?>/user/<?php echo $renews_id; ?>/">
			<div class="wrap_avatar flex">
				<div class="textbox_avatar">
					<?php echo $user_avatar; ?>
				</div>
				<p class="title_avatar eng">
					<span class="black"><?php echo $user_name; ?></span>
					<span>@<?php echo $renews_id; ?></span>
				</p>
			</div>
		</a>

		<div class="wrap_social color_black flex">
			<div class="socialbox likebox"><?php if(function_exists('wp_ulike_comments')) echo wp_ulike( 'put', array("id" => $val->ID) ); ?></div>
			<a class="socialbox commentbox" href="#commentsAreaWrap"><?php echo $comments->total_comments; ?></a>
		</div>
	</div>
</div><!-- /.article_middle -->
	<?php endforeach; ?>
	</div><!-- /.wrap_article_middle -->
	</div><!-- /.inner_base -->
</div><!-- /.content_article -->
<?php endif; ?>


<?php get_footer(); ?>