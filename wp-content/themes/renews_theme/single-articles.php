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

//$postTax = get_object_taxonomies($post);
$termsArg = array(
	'orderby' => 'menu_order',
	'order' => 'ASC'
);
$agenda_terms = wp_get_post_terms($postId,'agenda',$termsArg);
$hashtag_terms = wp_get_post_terms($postId,'value_hashtag',$termsArg);
$series_terms = wp_get_post_terms($postId,'series',$termsArg);
$keyword_terms = wp_get_post_terms($postId,'keyword',$termsArg);



//SNSシェア
if(!empty($hashtag_terms)):
foreach($hashtag_terms as $t_v)://value_hashtag
$tag_name = $t_v->name;
endforeach;
endif;

//元となるテキスト
if($tag_name){
	$text = 'Renews | 『'.get_the_title().'』 #'.$tag_name.'';
}else{
	$text = 'Renews | 『'.get_the_title().'』';
}


//URLエンコード処理
$encoded = rawurlencode( $text ) ;
$encodedURL = json_encode(get_permalink());

//現在のユーザー
$user = wp_get_current_user();
$uid = $user->ID;

//フォローチェック
$follow_post = get_user_meta($uid,'article_follow');
$follow_check = in_array($postId, $follow_post);

global $uid;
global $postId;

		?>

<section class="sec sec_article_detail">

	<div id="sideFixShare">
		<div class="fixBlock">
			<div class="circle-btn likebox">
				<a href="javascript:void(0);">
					<?php if(function_exists('wp_ulike_comments')) wp_ulike('get'); ?>
				</a>
			</div>
			<span class="baloon right">いいね！</span>
		</div>

		<div id="clip_fixBlock" class="fixBlock" data-post_id="<?php echo $postId; ?>">
			<?php if( is_user_logged_in() ): ?>
			<div class="circle-btn clipboxWrap">
				<a href="javascript:void(0);" class="clipbox postStockBtn<?php if($follow_check == 'true'){echo ' stock';} ?>" data-uid="<?php echo $uid; ?>" data-post_id="<?php echo $postId; ?>">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19.247 21.544">
						<path id="icon_clip" data-name="icon_clip" d="M130.213,80.089l-7.223,7.153a2.27,2.27,0,0,0,3.194,3.226l8.158-8.079a4.2,4.2,0,1,0-5.906-5.963l-8.43,8.349a6.127,6.127,0,0,0,8.623,8.707l7.531-7.459" transform="translate(-117.441 -74.461)" fill="transparent" stroke="#b0ad9e" stroke-miterlimit="10" stroke-width="1.5"/>
					</svg>
				</a>
			</div>
			<span class="baloon right">記事をクリップ</span>
			<?php else: ?>
			<div class="circle-btn login_baloon">
				<a href="#modalLoginWrap" class="clipbox popup-modal">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19.247 21.544">
						<path id="icon_clip" data-name="icon_clip" d="M130.213,80.089l-7.223,7.153a2.27,2.27,0,0,0,3.194,3.226l8.158-8.079a4.2,4.2,0,1,0-5.906-5.963l-8.43,8.349a6.127,6.127,0,0,0,8.623,8.707l7.531-7.459" transform="translate(-117.441 -74.461)" fill="none" stroke="#b0ad9e" stroke-miterlimit="10" stroke-width="1.5"/>
					</svg>
				</a>
			</div>
			<span class="baloon right for_pc"><a class="popup-modal" href="#modalLoginWrap">ログイン</a>が必要です</span>
			<span class="baloon top for_sp"><a class="popup-modal" href="#modalLoginWrap">ログイン</a>が必要です</span>
			<?php endif; ?>
		</div>

		<div class="fixBlock for_pc">
			<div class="sharebox head_article_detail flex">
				<div class="circle-btn">
					<a id="shareButton" href="javascript:void(0);">
						<svg class="share" xmlns="http://www.w3.org/2000/svg" width="20.141" height="23.102" viewBox="0 0 20.141 23.102">
							<g id="icon_share" data-name="icon_share" transform="translate(20879.605 73.545)">
								<line id="line_1" class="shareParts" data-name="line_1" x2="6.342" y2="4.123" transform="translate(-20872.693 -60.282)" fill="none" stroke="#b0ad9e" stroke-miterlimit="10" stroke-width="1.5"></line>
								<circle id="circle_1" class="shareParts" data-name="circle_1" cx="3.021" cy="3.021" r="3.021" transform="translate(-20866.256 -72.795)" fill="none" stroke="#b0ad9e" stroke-miterlimit="10" stroke-width="1.5"></circle>
								<circle id="circle_2" class="shareParts" data-name="circle_2" cx="3.021" cy="3.021" r="3.021" transform="translate(-20866.256 -57.235)" fill="none" stroke="#b0ad9e" stroke-miterlimit="10" stroke-width="1.5"></circle>
								<circle id="circle_3" class="shareParts" data-name="circle_3" cx="3.021" cy="3.021" r="3.021" transform="translate(-20878.855 -65.015)" fill="none" stroke="#b0ad9e" stroke-miterlimit="10" stroke-width="1.5"></circle>
								<path id="Fill_1" class="shareParts" data-name="Fill 1" d="M154.485,86.4l6.343-4.119" transform="translate(-21027.191 -150.248)" fill="none" stroke="#b0ad9e" stroke-miterlimit="10" stroke-width="1.5"></path>
							</g>
						</svg>
						<svg class="close" style="width:24px;height:24px" viewBox="0 0 24 24">
							<path d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z" />
						</svg>
					</a>
				</div>
				<span class="baloon right">記事をシェア</span>

				<!-- sharebtns▼ -->
				<div class="share-btn circle-btn twitter">
					<a href="https://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php echo $encoded; ?>" class="share_popup" target="_blank">
						<img src="<?php echo get_template_directory_uri(); ?>/images/icons/circle_twitter.svg" alt="twitter" />
					</a>
				</div>
				<div class="share-btn circle-btn facebook">
					<a href="https://www.facebook.com/sharer/sharer.php?u=<?php rawurlencode(the_permalink()); ?>" class="share_popup" target="_blank">
						<img src="<?php echo get_template_directory_uri(); ?>/images/icons/circle_fb.svg" alt="facebook" />
					</a>
				</div>
				<div class="share-btn circle-btn line">
					<a href="https://line.naver.jp/R/msg/text/?<?php echo $encoded; ?> <?php rawurlencode(the_permalink()); ?>" class="share_popup" target="_blank">
						<img src="<?php echo get_template_directory_uri(); ?>/images/icons/circle_line.svg" alt="line" />
					</a>
				</div>
				<div class="share-btn circle-btn hatena">
					<a href="https://b.hatena.ne.jp/add?mode=confirm&url=<?php rawurlencode(the_permalink()); ?>&title=<?php echo $encoded; ?>" class="share_popup for_pc" target="_blank" rel="nofollow">
						<img src="<?php echo get_template_directory_uri(); ?>/images/icons/circle_hatena.svg" alt="hatena" />
					</a>
					<a href="https://b.hatena.ne.jp/entry/<?php rawurlencode(the_permalink()); ?>" data-hatena-bookmark-initialized="1" data-hatena-bookmark-title="<?php echo $encoded; ?>" data-hatena-bookmark-layout="simple" class="share_popup  for_sp" target="_blank">
						<img src="<?php echo get_template_directory_uri(); ?>/images/icons/circle_hatena.png" alt="hatena" />
					</a>
				</div>

				<div class="share-btn circle-btn copy">
					<span class="baloon top">
						<span class="baloon_urlCopy_before">URLをコピー</span>
						<span class="baloon_urlCopy_after hide">コピーしました</span>
					</span>
					<button name="button" type="submit" onclick="copyToClipboard(target)">
						<span class="copyBtnIcon"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/circle_copy_off.svg" alt="copy" /></span>
<!--
						<svg xmlns="http://www.w3.org/2000/svg" width="17.525" height="20.73" viewBox="0 0 17.525 20.73">
							<g class="icon_copy" data-name="copy1" transform="translate(-422.488 -622.46)">
								<rect class="icon_copy_stroke" data-name="copy5" width="13.126" height="16.411" rx="1" transform="translate(426.137 626.029)" fill="#fff" stroke="#b0ad9e" stroke-miterlimit="10" stroke-width="1.5"/>
								<path class="icon_copy_stroke" data-name="copy2" d="M423.238,637.646v-13.4a1.038,1.038,0,0,1,1.038-1.038h10.831" fill="none" stroke="#b0ad9e" stroke-linecap="round" stroke-miterlimit="10" stroke-width="1.5"/>
								<g class="icon_copy" data-name="copy3" transform="translate(428.371 628.259)">
									<path class="icon_copy_fill" data-name="copy4" d="M437.632,630.924a2.915,2.915,0,0,0-4.923-1.5l-2.212,2.213a2.914,2.914,0,0,0,0,4.12h0a2.916,2.916,0,0,0,4.123,0l.167-.167a.888.888,0,0,0-.712-.991.934.934,0,0,0-.287,0l-.167.168a1.538,1.538,0,0,1-.5.333,1.51,1.51,0,0,1-1.963-.831,1.525,1.525,0,0,1-.082-.853,1.505,1.505,0,0,1,.414-.777l2.217-2.213a1.457,1.457,0,0,1,.5-.334,1.5,1.5,0,0,1,1.644,2.44,3.511,3.511,0,0,1,.547.449,3.4,3.4,0,0,1,.449.55,2.891,2.891,0,0,0,.626-.949A2.921,2.921,0,0,0,437.632,630.924Z" transform="translate(-428.78 -628.565)" fill="#b0ad9e"/>
									<path class="icon_copy_fill" data-name="copy5" d="M436.066,632.923a2.915,2.915,0,0,0-4.121,0l-.168.167a.913.913,0,0,0,.059.452.888.888,0,0,0,.94.546l.168-.168a1.474,1.474,0,0,1,.5-.334,1.525,1.525,0,0,1,.853-.083,1.52,1.52,0,0,1,1.11.916,1.525,1.525,0,0,1,.083.853,1.5,1.5,0,0,1-.413.777l-2.213,2.212a1.488,1.488,0,0,1-.5.334,1.526,1.526,0,0,1-.853.082,1.5,1.5,0,0,1-.79-2.523,3.521,3.521,0,0,1-.547-.449h0a3.506,3.506,0,0,1-.448-.547,2.914,2.914,0,0,0,4.136,4.106l2.212-2.212a2.914,2.914,0,0,0,0-4.12l0,0Z" transform="translate(-428.887 -628.073)" fill="#b0ad9e"/>
								</g>
							</g>
						</svg>
-->
					</button>
				</div>
				<!-- sharebtns -->
			</div>
		</div>

		<div class="fixBlock for_sp">
			<div class="circle-btn websharebox">
				<button id="share_1">
					<svg xmlns="http://www.w3.org/2000/svg" width="13" height="3" viewBox="0 0 13 3">
						<circle cx="1.5" cy="1.5" r="1.5" fill="#b0ad9e"/>
						<circle cx="1.5" cy="1.5" r="1.5" transform="translate(5)" fill="#b0ad9e"/>
						<circle cx="1.5" cy="1.5" r="1.5" transform="translate(10)" fill="#b0ad9e"/>
					</svg>
				</button>
			</div>
		</div>

	</div><!-- sideFixShares -->

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

				<div>
					<?php
//					$postId = $post->ID;
//					$taxonomy = 'agenda';
//
//					$primaryTerm = get_post_meta( $postId, '_yoast_wpseo_primary_'.$taxonomy, true );
//					if($primaryTerm){
//						// Yoast SEO カテゴリー「メインにする」設定をされている場合
//
//						$terms = get_term($primaryTerm, $taxonomy);
//						if(!empty($terms)){
//							$termName = $terms->name;
//							$termSlug = $terms->slug;
//						}
//					}else{
//						// Yoast SEO カテゴリー「メインにする」設定をされていない場合
//						// 選択タームの一番上を表示
//
//						$terms = get_the_terms($postId, array($taxonomy));
//						if(!empty($terms)){
//							$termName = $terms[0]->name;
//							$termSlug = $terms[0]->slug;
//						}
//					}

					?>
				</div>



					<div class="top_tags">
						<?php if(!empty($hashtag_terms)): ?>
						<?php foreach($hashtag_terms as $t_v)://value_hashtag
						$tag_link = get_category_link($t_v->term_id);
						$tag_name = $t_v->name;
						?>
							<a href="https://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php echo $encoded; ?>" target="_blank" class="share_popup tag_value border_value">#<?php echo $tag_name; ?></a>
						<?php endforeach; ?>
						<?php endif; ?>


						<?php if(!empty($agenda_terms)): ?>
								<?php
								$postId = $post->ID;
								$taxonomy = 'agenda';

								$primaryTerm = get_post_meta( $postId, '_yoast_wpseo_primary_'.$taxonomy, true );

								if($primaryTerm){
									// Yoast SEO カテゴリー「メインにする」設定をされている場合

									$terms = get_term($primaryTerm, $taxonomy);
									if(!empty($terms)){
										$primary_termName = $terms->name;
										$primary_termSlug = $terms->slug;
										$primary_termLink = get_category_link($terms->term_id);
									}
								}else{
									// Yoast SEO カテゴリー「メインにする」設定をされていない場合
									// 選択タームの一番上を表示

									$terms = get_the_terms($postId, array($taxonomy));
									if(!empty($terms)){
										$primary_termName = $terms[0]->name;
										$primary_termSlug = $terms[0]->slug;
										$primary_termLink = get_category_link($terms[0]->term_id);
									}
								}
								?>
						<a href="<?php echo $primary_termLink; ?>" class="tag_agenda border_agenda primary_tag"><?php echo $primary_termName; ?></a>

								<?php foreach($agenda_terms as $t_a)://agenda
								$tag_a_id = $t_a->term_id;
								$tag_link = get_category_link($t_a->term_id);
								$tag_name = $t_a->name;
								?>
								<?php if($primaryTerm != $tag_a_id): ?>
								<a href="<?php echo $tag_link; ?>" class="tag_agenda border_agenda"><?php echo $tag_name; ?></a>
								<?php endif; ?>
								<?php endforeach; ?>
						<?php endif; ?>


					</div>


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
						<a href="<?php echo home_url(); ?>/user/<?php echo $renews_id; ?>/">
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
						</a>
						<?php endwhile; ?>
						<?php endif; ?>


						<?php if(have_rows('editor_select')): ?>
						<?php while(have_rows('editor_select')): the_row();
						$editor_data = get_sub_field('editor');
						$editor_iconCheck = get_sub_field('icon_check');
						?>
						<a href="<?php echo home_url(); ?>/user/<?php echo $editor_data['user_nicename']; ?>/">
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
						</a>
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

					<?php

					//ストックしている人数
//					$args = array(
//						'meta_key'     => 'article_follow',
//						'meta_value'   => $postId
//					);
//					$all_user_stockPost = get_users( $args );
//					$stockNum = count($all_user_stockPost);
					?>
					<div class="wrap_social color_black flex">
						<div class ="socialbox datebox"><span class="baloon top"><?php echo get_the_time('H:i'); ?></span><?php echo get_the_time('Y.m.d'); ?></div>
						<div class="socialbox likebox">
							<span class="baloon top">いいね！</span>
							<?php if(function_exists('wp_ulike_comments')) wp_ulike('get'); ?>
						</div>
						<a class="socialbox commentbox flexSocialbox" href="#commentsAreaWrap">
							<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 42 41.3" style="enable-background:new 0 0 42 41.3;" xml:space="preserve">
								<path fill="none" stroke="#b0ad9e" stroke-width="1.5" class="icon_comm" data-name="icon_comm" d="M28.1,31.9c-1.4,0-2.8-0.2-4.2-0.7s-2.2-1.9-2-3.4v-0.2h-7.5c-2.2,0-4.1-1.8-4.1-4.1V15c0-2.2,1.8-4.1,4.1-4.1 l0,0h14.4c2.2,0,4.1,1.8,4.1,4.1v8.6c0,2.2-1.8,4.1-4.1,4.1h-1.7V28c0,1,0.6,2,1.5,2.6l2.2,1.4L28.1,31.9L28.1,31.9z"/>
							</svg>
							<span class="baloon top">コメントを見る</span>
							<span class="commCount"><?php comments_number( '0', '1', '%' ); ?></span>
						</a>
						<?php if( is_user_logged_in() ): ?>
						<a href="javascript:void(0);" class="socialbox clipbox flexSocialbox postStockBtn<?php if($follow_check == 'true'){echo ' stock';} ?>" data-uid="<?php echo $uid; ?>" data-post_id="<?php echo $postId; ?>">
							<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 42 41.3" style="enable-background:new 0 0 42 41.3;" xml:space="preserve">
								<path id="icon_clip" data-name="icon_clip" fill="#B0AD9E" d="M19,31.8c-1.7,0-3.4-0.7-4.7-2c-2.6-2.6-2.6-6.8,0-9.4l8.1-8.1c0.1-0.1,0.2-0.2,0.3-0.3 c0.9-0.9,2.2-1.3,3.4-1.2c1.3,0.1,2.5,0.6,3.3,1.6c0.9,0.9,1.3,2.2,1.2,3.4s-0.6,2.5-1.6,3.3L21.3,27c-1.2,1.1-2.9,1.1-4.1,0 c-0.6-0.5-0.9-1.3-0.9-2.1s0.3-1.5,0.8-2.1l7-6.9l1,1l-7,6.9c-0.3,0.3-0.4,0.6-0.4,1c0,0.4,0.2,0.8,0.4,1c0.6,0.6,1.5,0.6,2.1,0 l7.9-7.8c0.7-0.6,1.1-1.4,1.1-2.3c0-0.9-0.3-1.7-0.9-2.4c-0.6-0.7-1.4-1-2.3-1.1c-0.9,0-1.7,0.3-2.4,0.9c-0.1,0.1-0.1,0.1-0.2,0.2 l-8.2,8.1c-1,1-1.5,2.3-1.5,3.7c0,1.4,0.5,2.7,1.5,3.7s2.3,1.5,3.7,1.5c1.4,0,2.7-0.5,3.7-1.5l7.3-7.2l1,1l-7.3,7.2 C22.4,31.2,20.7,31.8,19,31.8z"/>
							</svg>
							<span class="baloon top">記事をクリップ</span>
							<span class="stock_on stockTxt">記事をクリップ</span>
							<span class="stock_off stockTxt">クリップを解除</span>
						</a>
						<?php else: ?>
						<span class="for_pc align-center">
							<span class="socialbox clipbox flexSocialbox">
								<a class="popup-modal" href="#modalLoginWrap">
									<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 42 41.3" style="enable-background:new 0 0 42 41.3;" xml:space="preserve">
										<path id="icon_clip" data-name="icon_clip" fill="#B0AD9E" d="M19,31.8c-1.7,0-3.4-0.7-4.7-2c-2.6-2.6-2.6-6.8,0-9.4l8.1-8.1c0.1-0.1,0.2-0.2,0.3-0.3 c0.9-0.9,2.2-1.3,3.4-1.2c1.3,0.1,2.5,0.6,3.3,1.6c0.9,0.9,1.3,2.2,1.2,3.4s-0.6,2.5-1.6,3.3L21.3,27c-1.2,1.1-2.9,1.1-4.1,0 c-0.6-0.5-0.9-1.3-0.9-2.1s0.3-1.5,0.8-2.1l7-6.9l1,1l-7,6.9c-0.3,0.3-0.4,0.6-0.4,1c0,0.4,0.2,0.8,0.4,1c0.6,0.6,1.5,0.6,2.1,0 l7.9-7.8c0.7-0.6,1.1-1.4,1.1-2.3c0-0.9-0.3-1.7-0.9-2.4c-0.6-0.7-1.4-1-2.3-1.1c-0.9,0-1.7,0.3-2.4,0.9c-0.1,0.1-0.1,0.1-0.2,0.2 l-8.2,8.1c-1,1-1.5,2.3-1.5,3.7c0,1.4,0.5,2.7,1.5,3.7s2.3,1.5,3.7,1.5c1.4,0,2.7-0.5,3.7-1.5l7.3-7.2l1,1l-7.3,7.2 C22.4,31.2,20.7,31.8,19,31.8z"/>
									</svg>
							</a>
								<span class="baloon top for_pc"><a class="popup-modal" href="#modalLoginWrap">ログイン</a>が必要です</span>
								<a class="popup-modal stock_on stockTxt" href="#modalLoginWrap">記事をクリップ</a>
							</span>
						</span>
						<span class="for_sp align-center">
							<a href="#modalLoginWrap" class="socialbox clipbox flexSocialbox popup-modal">
								<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 42 41.3" style="enable-background:new 0 0 42 41.3;" xml:space="preserve">
									<path id="icon_clip" data-name="icon_clip" fill="#B0AD9E" d="M19,31.8c-1.7,0-3.4-0.7-4.7-2c-2.6-2.6-2.6-6.8,0-9.4l8.1-8.1c0.1-0.1,0.2-0.2,0.3-0.3 c0.9-0.9,2.2-1.3,3.4-1.2c1.3,0.1,2.5,0.6,3.3,1.6c0.9,0.9,1.3,2.2,1.2,3.4s-0.6,2.5-1.6,3.3L21.3,27c-1.2,1.1-2.9,1.1-4.1,0 c-0.6-0.5-0.9-1.3-0.9-2.1s0.3-1.5,0.8-2.1l7-6.9l1,1l-7,6.9c-0.3,0.3-0.4,0.6-0.4,1c0,0.4,0.2,0.8,0.4,1c0.6,0.6,1.5,0.6,2.1,0 l7.9-7.8c0.7-0.6,1.1-1.4,1.1-2.3c0-0.9-0.3-1.7-0.9-2.4c-0.6-0.7-1.4-1-2.3-1.1c-0.9,0-1.7,0.3-2.4,0.9c-0.1,0.1-0.1,0.1-0.2,0.2 l-8.2,8.1c-1,1-1.5,2.3-1.5,3.7c0,1.4,0.5,2.7,1.5,3.7s2.3,1.5,3.7,1.5c1.4,0,2.7-0.5,3.7-1.5l7.3-7.2l1,1l-7.3,7.2 C22.4,31.2,20.7,31.8,19,31.8z"/>
								</svg>
								<span class="stock_on stockTxt">記事をクリップ</span>
							</a>
						</span>
						<?php endif; ?>
					</div><!-- wrap_social -->
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
						<div class="share-btn circle-btn twitter">
							<a href="https://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php echo $encoded; ?>" class="share_popup" target="_blank">
								<img src="<?php echo get_template_directory_uri(); ?>/images/icons/circle_twitter.svg" alt="twitter" />
							</a>
						</div>
						<div class="share-btn circle-btn facebook">
							<a href="https://www.facebook.com/sharer/sharer.php?u=<?php rawurlencode(the_permalink()); ?>" class="share_popup" target="_blank">
								<img src="<?php echo get_template_directory_uri(); ?>/images/icons/circle_fb.svg" alt="facebook" />
							</a>
						</div>
						<div class="share-btn circle-btn line">
							<a href="https://line.naver.jp/R/msg/text/?<?php echo $encoded; ?> <?php rawurlencode(the_permalink()); ?>" class="share_popup" target="_blank">
								<img src="<?php echo get_template_directory_uri(); ?>/images/icons/circle_line.svg" alt="line" />
							</a>
						</div>
						<div class="share-btn circle-btn hatena for_pc">
							<a href="https://b.hatena.ne.jp/add?mode=confirm&url=<?php rawurlencode(the_permalink()); ?>&title=<?php echo $encoded; ?>" class="share_popup" target="_blank" rel="nofollow">
								<img src="<?php echo get_template_directory_uri(); ?>/images/icons/circle_hatena.svg" alt="hatena" />
							</a>
						</div>
						<div class="share-btn circle-btn hatena for_sp">
							<a href="https://b.hatena.ne.jp/entry/<?php rawurlencode(the_permalink()); ?>" data-hatena-bookmark-initialized="1" data-hatena-bookmark-title="<?php echo $encoded; ?>" data-hatena-bookmark-layout="simple" class="share_popup" target="_blank">
								<img src="<?php echo get_template_directory_uri(); ?>/images/icons/circle_hatena.svg" alt="hatena" />
							</a>
						</div>
						<div class="share-btn circle-btn copy for_pc">
							<span class="baloon top">
								<span class="baloon_urlCopy_before">URLをコピー</span>
								<span class="baloon_urlCopy_after hide">コピーしました</span>
							</span>
							<button name="button" type="submit" onclick="copyToClipboard(target)">
								<span class="copyBtnIcon"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/circle_copy_off.svg" alt="copy" /></span>
<!--
								<svg xmlns="http://www.w3.org/2000/svg" width="17.525" height="20.73" viewBox="0 0 17.525 20.73">
									<g class="icon_copy" data-name="copy1" transform="translate(-422.488 -622.46)">
										<rect class="icon_copy_stroke" data-name="copy5" width="13.126" height="16.411" rx="1" transform="translate(426.137 626.029)" fill="#fff" stroke="#b0ad9e" stroke-miterlimit="10" stroke-width="1.5"/>
										<path class="icon_copy_stroke" data-name="copy2" d="M423.238,637.646v-13.4a1.038,1.038,0,0,1,1.038-1.038h10.831" fill="none" stroke="#b0ad9e" stroke-linecap="round" stroke-miterlimit="10" stroke-width="1.5"/>
										<g class="icon_copy" data-name="copy3" transform="translate(428.371 628.259)">
											<path class="icon_copy_fill" data-name="copy4" d="M437.632,630.924a2.915,2.915,0,0,0-4.923-1.5l-2.212,2.213a2.914,2.914,0,0,0,0,4.12h0a2.916,2.916,0,0,0,4.123,0l.167-.167a.888.888,0,0,0-.712-.991.934.934,0,0,0-.287,0l-.167.168a1.538,1.538,0,0,1-.5.333,1.51,1.51,0,0,1-1.963-.831,1.525,1.525,0,0,1-.082-.853,1.505,1.505,0,0,1,.414-.777l2.217-2.213a1.457,1.457,0,0,1,.5-.334,1.5,1.5,0,0,1,1.644,2.44,3.511,3.511,0,0,1,.547.449,3.4,3.4,0,0,1,.449.55,2.891,2.891,0,0,0,.626-.949A2.921,2.921,0,0,0,437.632,630.924Z" transform="translate(-428.78 -628.565)" fill="#b0ad9e"/>
											<path class="icon_copy_fill" data-name="copy5" d="M436.066,632.923a2.915,2.915,0,0,0-4.121,0l-.168.167a.913.913,0,0,0,.059.452.888.888,0,0,0,.94.546l.168-.168a1.474,1.474,0,0,1,.5-.334,1.525,1.525,0,0,1,.853-.083,1.52,1.52,0,0,1,1.11.916,1.525,1.525,0,0,1,.083.853,1.5,1.5,0,0,1-.413.777l-2.213,2.212a1.488,1.488,0,0,1-.5.334,1.526,1.526,0,0,1-.853.082,1.5,1.5,0,0,1-.79-2.523,3.521,3.521,0,0,1-.547-.449h0a3.506,3.506,0,0,1-.448-.547,2.914,2.914,0,0,0,4.136,4.106l2.212-2.212a2.914,2.914,0,0,0,0-4.12l0,0Z" transform="translate(-428.887 -628.073)" fill="#b0ad9e"/>
										</g>
									</g>
								</svg>
-->
							</button>
						</div>

						<div class="share-btn circle-btn share for_sp">
							<button id="share_2">
								<svg xmlns="http://www.w3.org/2000/svg" width="13" height="3" viewBox="0 0 13 3">
									<circle cx="1.5" cy="1.5" r="1.5" fill="#b0ad9e"/>
									<circle cx="1.5" cy="1.5" r="1.5" transform="translate(5)" fill="#b0ad9e"/>
									<circle cx="1.5" cy="1.5" r="1.5" transform="translate(10)" fill="#b0ad9e"/>
								</svg>
							</button>
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

					<?php
					//現在のユーザー
					$user = wp_get_current_user();
					$uid = $user->ID;

					//フォローチェック
					$follow_post = get_user_meta($uid,'article_follow');
					$follow_check = in_array($postId, $follow_post);
					?>
<!--
					<div class="bookmarkBtn">
						<?php if( is_user_logged_in() ) : //ログインしてるユーザー ?>
						<a href="javascript:void(0);" class="postStockBtn bookmarkBtnLink<?php if($follow_check == 'true'){echo ' stock';} ?>" data-uid="<?php echo $uid; ?>" data-post_id="<?php echo $postId; ?>"><span class="stock_on stockTxt">記事をストックする</span><span class="stock_off stockTxt">記事のストックを解除</span></a>
						<div class="wrap_social color_black"><a href="javascript:void(0);" class="socialbox likebox postStockBtn<?php if($follow_check == 'true'){echo ' stock';} ?>" data-uid="<?php echo $uid; ?>" data-post_id="<?php echo $postId; ?>"><?php echo $stockNum; ?></a></div>
					<?php else: ?>
						<a href="<?php echo home_url(); ?>/login/">記事をストックする</a>
						<div class="wrap_social color_black"><a href="<?php echo home_url(); ?>/login/" class="socialbox likebox"><?php echo $stockNum; ?></a></div>
					<?php endif; ?>
					</div>
-->
						<!--キーワード追加部分 -->
						<div class="keyword_cont">
							<!-- <span class="title_keyword">▼キーワードタグ</span><br/> -->
							<?php if(!empty($keyword_terms)): ?>
							<?php foreach($keyword_terms as $t_k)://value_hashtag
							$tag_link = get_category_link($t_k->term_id);
							$tag_name = $t_k->name;
							?>
									<a href="<?php echo $tag_link; ?>" class="tag_keyword">
										<div class="keyword_each">#<?php echo $tag_name; ?></div>
									</a>
						<?php endforeach; ?>
						<?php endif; ?>
						</div>
						<!-- 追加ここまで -->

					<div class="wrap_social foot_article_detail color_black flex">
						<div class="socialbox likebox">
							<span class="baloon top">いいね！</span>
							<?php if(function_exists('wp_ulike_comments')) wp_ulike('get'); ?>
						</div>
						<a class="socialbox commentbox flexSocialbox" href="#commentsAreaWrap">
							<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 42 41.3" style="enable-background:new 0 0 42 41.3;" xml:space="preserve">
								<path fill="none" stroke="#b0ad9e" stroke-width="1.5" class="icon_comm" data-name="icon_comm" d="M28.1,31.9c-1.4,0-2.8-0.2-4.2-0.7s-2.2-1.9-2-3.4v-0.2h-7.5c-2.2,0-4.1-1.8-4.1-4.1V15c0-2.2,1.8-4.1,4.1-4.1 l0,0h14.4c2.2,0,4.1,1.8,4.1,4.1v8.6c0,2.2-1.8,4.1-4.1,4.1h-1.7V28c0,1,0.6,2,1.5,2.6l2.2,1.4L28.1,31.9L28.1,31.9z"/>
							</svg>
							<span class="baloon top">コメントを見る</span>
							<span class="commCount"><?php comments_number( '0', '1', '%' ); ?></span>
						</a>
						<?php if( is_user_logged_in() ): ?>
						<a href="javascript:void(0);" class="socialbox clipbox flexSocialbox postStockBtn<?php if($follow_check == 'true'){echo ' stock';} ?>" data-uid="<?php echo $uid; ?>" data-post_id="<?php echo $postId; ?>">
							<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 42 41.3" style="enable-background:new 0 0 42 41.3;" xml:space="preserve">
								<path id="icon_clip" data-name="icon_clip" fill="#B0AD9E" d="M19,31.8c-1.7,0-3.4-0.7-4.7-2c-2.6-2.6-2.6-6.8,0-9.4l8.1-8.1c0.1-0.1,0.2-0.2,0.3-0.3 c0.9-0.9,2.2-1.3,3.4-1.2c1.3,0.1,2.5,0.6,3.3,1.6c0.9,0.9,1.3,2.2,1.2,3.4s-0.6,2.5-1.6,3.3L21.3,27c-1.2,1.1-2.9,1.1-4.1,0 c-0.6-0.5-0.9-1.3-0.9-2.1s0.3-1.5,0.8-2.1l7-6.9l1,1l-7,6.9c-0.3,0.3-0.4,0.6-0.4,1c0,0.4,0.2,0.8,0.4,1c0.6,0.6,1.5,0.6,2.1,0 l7.9-7.8c0.7-0.6,1.1-1.4,1.1-2.3c0-0.9-0.3-1.7-0.9-2.4c-0.6-0.7-1.4-1-2.3-1.1c-0.9,0-1.7,0.3-2.4,0.9c-0.1,0.1-0.1,0.1-0.2,0.2 l-8.2,8.1c-1,1-1.5,2.3-1.5,3.7c0,1.4,0.5,2.7,1.5,3.7s2.3,1.5,3.7,1.5c1.4,0,2.7-0.5,3.7-1.5l7.3-7.2l1,1l-7.3,7.2 C22.4,31.2,20.7,31.8,19,31.8z"/>
							</svg>
							<span class="stock_on stockTxt">記事をクリップ</span>
							<span class="stock_off stockTxt">クリップを解除</span>
						</a>
						<?php else: ?>
						<span class="for_pc align-center">
							<span class="socialbox clipbox flexSocialbox">
								<a class="popup-modal" href="#modalLoginWrap">
									<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 42 41.3" style="enable-background:new 0 0 42 41.3;" xml:space="preserve">
										<path id="icon_clip" data-name="icon_clip" fill="#B0AD9E" d="M19,31.8c-1.7,0-3.4-0.7-4.7-2c-2.6-2.6-2.6-6.8,0-9.4l8.1-8.1c0.1-0.1,0.2-0.2,0.3-0.3 c0.9-0.9,2.2-1.3,3.4-1.2c1.3,0.1,2.5,0.6,3.3,1.6c0.9,0.9,1.3,2.2,1.2,3.4s-0.6,2.5-1.6,3.3L21.3,27c-1.2,1.1-2.9,1.1-4.1,0 c-0.6-0.5-0.9-1.3-0.9-2.1s0.3-1.5,0.8-2.1l7-6.9l1,1l-7,6.9c-0.3,0.3-0.4,0.6-0.4,1c0,0.4,0.2,0.8,0.4,1c0.6,0.6,1.5,0.6,2.1,0 l7.9-7.8c0.7-0.6,1.1-1.4,1.1-2.3c0-0.9-0.3-1.7-0.9-2.4c-0.6-0.7-1.4-1-2.3-1.1c-0.9,0-1.7,0.3-2.4,0.9c-0.1,0.1-0.1,0.1-0.2,0.2 l-8.2,8.1c-1,1-1.5,2.3-1.5,3.7c0,1.4,0.5,2.7,1.5,3.7s2.3,1.5,3.7,1.5c1.4,0,2.7-0.5,3.7-1.5l7.3-7.2l1,1l-7.3,7.2 C22.4,31.2,20.7,31.8,19,31.8z"/>
									</svg>
								</a>
								<span class="baloon top for_pc"><a class="popup-modal" href="#modalLoginWrap">ログイン</a>が必要です</span>
								<a class="popup-modal stock_on stockTxt" href="#modalLoginWrap">記事をクリップ</a>
							</span>
						</span>
						<span class="for_sp align-center">
							<a href="#modalLoginWrap" class="socialbox clipbox flexSocialbox popup-modal">
								<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 42 41.3" style="enable-background:new 0 0 42 41.3;" xml:space="preserve">
									<path id="icon_clip" data-name="icon_clip" fill="#B0AD9E" d="M19,31.8c-1.7,0-3.4-0.7-4.7-2c-2.6-2.6-2.6-6.8,0-9.4l8.1-8.1c0.1-0.1,0.2-0.2,0.3-0.3 c0.9-0.9,2.2-1.3,3.4-1.2c1.3,0.1,2.5,0.6,3.3,1.6c0.9,0.9,1.3,2.2,1.2,3.4s-0.6,2.5-1.6,3.3L21.3,27c-1.2,1.1-2.9,1.1-4.1,0 c-0.6-0.5-0.9-1.3-0.9-2.1s0.3-1.5,0.8-2.1l7-6.9l1,1l-7,6.9c-0.3,0.3-0.4,0.6-0.4,1c0,0.4,0.2,0.8,0.4,1c0.6,0.6,1.5,0.6,2.1,0 l7.9-7.8c0.7-0.6,1.1-1.4,1.1-2.3c0-0.9-0.3-1.7-0.9-2.4c-0.6-0.7-1.4-1-2.3-1.1c-0.9,0-1.7,0.3-2.4,0.9c-0.1,0.1-0.1,0.1-0.2,0.2 l-8.2,8.1c-1,1-1.5,2.3-1.5,3.7c0,1.4,0.5,2.7,1.5,3.7s2.3,1.5,3.7,1.5c1.4,0,2.7-0.5,3.7-1.5l7.3-7.2l1,1l-7.3,7.2 C22.4,31.2,20.7,31.8,19,31.8z"/>
								</svg>
								<span class="stock_on stockTxt">記事をクリップ</span>
							</a>
						</span>
						<?php endif; ?>
					</div><!-- wrap_social -->


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
									<dt><div class="userIcon"><a href="<?php echo home_url(); ?>/user/<?php echo $renews_id; ?>/"><?php echo $user_avatar; ?></a></div></dt>
									<dd>
										<p class="renewerName">
											<a href="<?php echo home_url(); ?>/user/<?php echo $renews_id; ?>/">
												<?php echo $user_name; ?> <span>@<?php echo $renews_id; ?></span>
											</a>
										</p>
										<?php if($user_description): ?>
										<div class="lineClamp_3 lineClamp_sp_4 lineClampWrap">
											<div class="introText">
												<?php echo $user_description; ?>
											</div>
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
									<dt><div class="userIcon"><a href="<?php echo home_url(); ?>/user/<?php echo $renews_id; ?>/"><?php echo $user_avatar; ?></a></div></dt>
									<dd>
										<p class="renewerName">
											<a href="<?php echo home_url(); ?>/user/<?php echo $renews_id; ?>/">
										<?php echo $user_name; ?> <span>@<?php echo $renews_id; ?></span>
											</a>
										</p>
										<?php if($user_description): ?>
										<div class="lineClamp_2 lineClamp_sp_4 lineClampWrap">
											<div class="introText">
												<?php echo $user_description; ?>
											</div>
										</div>
										<?php endif; ?>
									</dd>
								</dl>
							</div>
							<?php endif; ?>
						</div>
					</div>

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
$relatedPosts = get_field('article_relation');
if(!empty($relatedPosts)):
?>
<div class="content_article">
	<div class="inner_base">
		<h3 class="title_thin">
			<span class="title_thin_img beige">
				<h3>おすすめの記事</h3>
			</span>
		</h3>
		<div class="wrap_article_middle grid articleListStyle">
	<?php foreach( $relatedPosts as $val ):

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
				<div class="wrap_img">
					<div class="article_middle_img imgLiquidFill">
						<a href="<?php the_permalink($val->ID); ?>">
							<img src="<?php echo $imageUrl; ?>" alt="<?php echo $title; ?> サムネイル" />
						</a>
					</div>
				</div>

				<div class="textbox middle left_bottom">
					<?php if(!empty($series_terms)): ?>
					<?php foreach($series_terms as $ct): ?>
					<?php
					$series_link = get_category_link($ct->term_id);
					?>
					<a href="<?php echo $series_link; ?>">
						<p class="series_name">
							<?php echo $ct->name; ?>
						</p>
					</a>
					<?php endforeach; ?>
					<?php endif; ?>

					<a href="<?php the_permalink($val->ID); ?>">
						<h2 class="title_middle artcle_small_title">
							<?php echo $title; ?>
						</h2>
					</a>
					<?php
					//著者情報
					$rows = get_field('author_select' ,$val->ID); // すべてのrow（内容・行）をいったん取得する
					$first_row = $rows[0]; // 1行目だけを$first_rowに格納しますよ～
					$first_row_item = $first_row['author']; // get the sub field value
					if(!$first_row_item){
						$relationpost = get_post($val->ID);
						$relationauthor = get_userdata($relationpost->post_author);
						$user_name = get_the_author_meta( 'display_name', $relationauthor->ID );
						$renews_id = get_the_author_meta( 'user_login', $relationauthor->ID );
						$user_avatar = get_avatar( $relationauthor->ID, 64 );
					}else{
						$user_name = $first_row_item['display_name'];
						$renews_id = $first_row_item['user_nicename'];
						$user_avatar = $first_row_item['user_avatar'];
					}
					?>
					<div class="card-bottom">
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

						<?php
						//現在のユーザー
						$user = wp_get_current_user();
						$uid = $user->ID;

						//フォローチェック
						$follow_post = get_user_meta($uid,'article_follow');
						$follow_check = in_array($postId, $follow_post);

						//ストックしている人数
						$args = array(
							'meta_key'     => 'article_follow',
							'meta_value'   => $postId
						);
						$all_user_stockPost = get_users( $args );
						$stockNum = count($all_user_stockPost);
						?>
						<div class="wrap_social color_black flex">
							<div class="socialbox likebox"><?php if(function_exists('wp_ulike_comments')) echo wp_ulike( 'put', array("id" => $val->ID) ); ?></div>
							<a class="socialbox flexSocialbox commentbox" href="<?php echo get_permalink($val->ID); ?>?move=commentsAreaWrap">
								<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 42 41.3" style="enable-background:new 0 0 42 41.3;" xml:space="preserve">
									<path fill="none" stroke="#b0ad9e" stroke-width="1.5" class="icon_comm" data-name="icon_comm" d="M28.1,31.9c-1.4,0-2.8-0.2-4.2-0.7s-2.2-1.9-2-3.4v-0.2h-7.5c-2.2,0-4.1-1.8-4.1-4.1V15c0-2.2,1.8-4.1,4.1-4.1 l0,0h14.4c2.2,0,4.1,1.8,4.1,4.1v8.6c0,2.2-1.8,4.1-4.1,4.1h-1.7V28c0,1,0.6,2,1.5,2.6l2.2,1.4L28.1,31.9L28.1,31.9z"/>
								</svg>
								<span class="commCount"><?php echo $comments->total_comments; ?></span>
							</a>
						</div>
					</div>
				</div>
			</div><!-- /.article_middle -->
	<?php endforeach; ?>
	</div><!-- /.wrap_article_middle -->
	</div><!-- /.inner_base -->
</div><!-- /.content_article -->
<?php endif; ?>



<!-- Web Share API -->
<script type="text/javascript">
	var encodedText = <?php echo json_encode($encoded); ?>;
	var encodedURL = <?php echo $encodedURL; ?>;
	(function(){
		function share() {
			if (navigator.share) {
				navigator.share({
					title: 'RENEWS',
					text: 'RENEWS',
					url: encodedURL,
				})
					.then(() => console.log('Successful share'))
					.catch((error) => console.log('Error sharing', error));
			} else {
				alert('Web Share APIはサポートされていません。');
			}
		}
		document.querySelector('#share_1').addEventListener('click', share);
		document.querySelector('#share_2').addEventListener('click', share);
	})();
</script>


<!-- button copy -->
<input type="hidden" id="target" value="<?php the_permalink(); ?>">
<script>
	function copyToClipboard(element) {
		var text = document.createElement("textarea");
		text.classList.add('hidden');
		text.value = element.value;
		document.body.appendChild(text);
		text.select();
		document.execCommand("copy");
		text.remove();
		$('.baloon_urlCopy_before').addClass('hide');
		$('.baloon_urlCopy_after').removeClass('hide');
		setTimeout(function(){
			$('.baloon_urlCopy_before').removeClass('hide');
			$('.baloon_urlCopy_after').addClass('hide');
		},3000);
	}
</script>


<?php get_footer(); ?>
