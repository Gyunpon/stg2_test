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
$hashtag_terms = get_the_tags();

//SNSシェア
//元となるテキスト
$text = 'Renews | 『'.get_the_title().'』';
//URLエンコード処理
$encoded = rawurlencode( $text ) ;
$encodedURL = json_encode(get_permalink());


		?>



<section class="sec sec_article_detail info_detail">

	<div id="sideFixShare">
		<div class="snsShare fixBlock for_pc">
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
					<a href="https://b.hatena.ne.jp/entry/<?php rawurlencode(the_permalink()); ?>" data-hatena-bookmark-initialized="1" data-hatena-bookmark-title="<?php echo $encoded; ?>" data-hatena-bookmark-layout="simple" class="share_popup for_sp" target="_blank">
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
				<div class="textbox large big">
					<?php if(!empty($series_terms)): ?>
					<?php foreach($series_terms as $ct):
					$taxonomy_name = 'category'; // タクソノミーのスラッグ名を入れる
					//					$series_type = get_field('series_type','series_'.$ct->term_id)[0];
					$url = get_term_link($ct->slug, $taxonomy_name);
					?>
					<a href="<?php echo $url; ?>" class="series_name">
						<span class="series_text">
							お知らせ＞<?php echo $ct->name; ?>
						</span>
					</a>
					<?php endforeach; ?>
					<?php endif; ?>

					<h1 class="title_big">
						<?php the_title(); ?>
					</h1>

					<div class="top_tags">
						<?php if(!empty($hashtag_terms)): ?>
						<?php foreach($hashtag_terms as $t_v)://value_hashtag
						$tag_link = get_category_link($t_v->term_id);
						$tag_name = $t_v->name;
						?>
						<a href="<?php echo $tag_link; ?>" class="border_blue slider_blue color_blue hover_white"><p>#<?php echo $tag_name; ?></p></a>
						<?php endforeach; ?>
						<?php endif; ?>
					</div>


					<div class="flex wrap_label_article_mv cf">
						<?php if(have_rows('author_select_info')): ?>
						<?php while(have_rows('author_select_info')): the_row();
						$user_data = get_sub_field('author_info');
						$author_iconCheck = get_sub_field('icon_check');

						if(!($user_data)){
							$user_name = get_the_author_meta( 'display_name', $post->post_author );
							$renews_id = get_the_author_meta( 'user_login', $post->post_author );
							$user_avatar = get_avatar( $post->post_author, 64 );
						}else{
							$user_name = $user_data['display_name'];
							$renews_id = $user_data['user_nicename'];
							$user_avatar = $user_data['user_avatar'];
						}

						?>
						<a href="<?php echo network_home_url(); ?>user/<?php echo $renews_id; ?>/">
							<div class="wrap_avatar flex">
								<?php if($author_iconCheck): ?>
								<div class="textbox_avatar">
									<?php echo $user_avatar; ?>
								</div>
								<?php endif; ?>
								<p class="title_avatar eng">
									<span class="black"><?php echo $user_name; ?></span>
									<br>
									<span>@<?php echo $renews_id; ?></span>
								</p>
							</div>
						</a>
						<?php endwhile; ?>
						<?php endif; ?>
					</div>
					<div class="wrap_social color_black flex">
						<div class="socialbox datebox"><span class="baloon top"><?php echo get_the_time('H:i'); ?></span><?php echo get_the_time('Y.m.d'); ?></div>
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
					<div class="singleText">

						<?php the_content(); ?>
					</div>


					<div class="head_article_detail flex">

						<!--
						<div class="btn_share head last">
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
								<a href="https://social-plugins.line.me/lineit/share?url=<?php rawurlencode(the_permalink()); ?>" class="share_popup" target="_blank">
									<img src="<?php echo get_template_directory_uri(); ?>/images/icons/circle_line.svg" alt="line" />
								</a>
							</div>
							<div class="share-btn circle-btn hatena">
								<a href="http://b.hatena.ne.jp/add?mode=confirm&url=<?php rawurlencode(the_permalink()); ?>&title=<?php echo $encoded; ?>" class="share_popup" target="_blank" rel="nofollow">
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

						</div>--><!-- /.btn_share -->
					</div><!-- /.head_article_detail -->


				</div><!-- inner_article_detail -->
			</div><!-- /.article_detail -->
		</div><!-- /.inner_base -->
	</div><!-- /.content_article_detail -->



	<!-- 関連記事 -->
	<?php
	$posts = get_field('kanren');
	if( $posts ):
	?>
	<div class="content_article kanrenLink">
		<div class="inner_base">
			<h2 class="sec_title">
				<span class="main_title">Recommend</span>
				<span class="main_title_jp">おすすめの記事</span>
			</h2>

			<div class="wrap_article_middle flex colum2">
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
				$series_terms = get_the_terms($val->ID,'category');
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
						<?php foreach($series_terms as $ct):
						//		$series_type = get_field('series_type','series_'.$ct->term_id)[0];
						?>
						<span class="series_name">
							お知らせ＞<?php echo $ct->name; ?>
						</span>
						<?php endforeach; ?>
						<?php endif; ?>
						<a href="<?php the_permalink($val->ID); ?>">
							<h2 class="title_middle">
								<?php echo $title; ?>
							</h2>
						</a>


						<?php
						$rows = get_field('author_select_info',$val->ID ); // すべてのrow（内容・行）をいったん取得する
						$first_row = $rows[0]; // 1行目だけを$first_rowに格納しますよ～
						$first_row_item = $first_row['author_info']; // get the sub field value
						if(!($first_row_item)){
							$user_name = get_the_author_meta( 'display_name', $val->post_author );
							$renews_id = get_the_author_meta( 'user_login', $val->post_author );
							$user_avatar = get_avatar( get_the_author_meta( 'ID' ), 64 );
						}else{
							$user_name = $first_row_item['display_name'];
							$renews_id = $first_row_item['user_nicename'];
							$user_avatar = $first_row_item['user_avatar'];
						}
						?>
						<div class="card-bottom">
							<div class="infobox">
								<a href="<?php echo network_home_url(); ?>user/<?php echo $renews_id; ?>/">
									<div class="wrap_avatar flex">
										<div class="textbox_avatar">
											<?php echo $user_avatar; ?>
										</div>
										<p class="title_avatar eng">
											<span class="black"><?php echo $user_name; ?></span>
	<!--										<span>@<?php echo $renews_id; ?></span>-->
										</p>
									</div>
								</a>
								<div class="wrap_social color_black flex">
									<div class="socialbox datebox"><?php echo get_the_time('Y.m.d'); ?></div>
								</div>
							</div>
						</div>

					</div>
				</div><!-- /.article_middle -->
				<?php endforeach; ?>
			</div><!-- /.wrap_article_middle -->
		</div><!-- /.inner_base -->
	</div><!-- /.content_article -->

	<?php endif; ?>
</section>


		<?php endwhile;endif; ?>





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
