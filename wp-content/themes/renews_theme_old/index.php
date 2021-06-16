<?php get_header(); ?>


<section class="sec sec_mv">
	<?php
	$posts = get_field('top_mv_option','option');
	if( $posts ):
	?>
	
	<div class="slide_wrap">
		<div class="content_mv_wrap">
			<?php foreach( $posts as $val ):
			// アイキャッチ
			$thumbnail_id = get_post_thumbnail_id($val->ID);
			$imageUrl = '';
			if($thumbnail_id){
				$image = wp_get_attachment_image_src($thumbnail_id,'full');
				$imageUrl = $image[0];
			}else{
				$imageUrl = get_template_directory_uri().'/images/icon/noimg.jpg';
			}

			//ユーザー
//			$user_name = get_the_author_meta( 'display_name', $val->post_author );
//			$renews_id = get_the_author_meta( 'user_login', $val->post_author );


			$title = get_the_title( $val->ID );
			$agenda_terms = get_the_terms($val->ID,'agenda');
			$hashtag_terms = get_the_terms($val->ID,'value_hashtag');
			$series_terms = get_the_terms($val->ID,'series');
			//コメント
			$comments = wp_count_comments( $val->ID );
			?>
			<div class="slide">
				<div class="content_mv">
					<div class="article_main_img imgLiquidFill">
						<a href="<?php echo get_permalink( $val->ID ); ?>">
						<img src="<?php echo $imageUrl; ?>" alt="メインビジュアルイメージ" />
						</a>
					</div>
					<div class="textbox large right_top">
						<?php if(!empty($series_terms)): ?>
						<?php foreach($series_terms as $ct):
						//$series_type = get_field('series_type','series_'.$ct->term_id)[0];
						$series_link = get_category_link($ct->term_id);
						?>
						<a href="<?php echo $series_link; ?>">
							<p class="series_name">
								<?php echo $ct->name; ?>
							</p>
						</a>
						<?php endforeach; ?>
						<?php endif; ?>

						<a href="<?php echo get_permalink( $val->ID ); ?>">
							<h2 class="title_large">
								<?php echo $title; ?>
							</h2>
						</a>


						<div class="top_tags">
							<?php if(!empty($hashtag_terms)): ?>
							<?php foreach($hashtag_terms as $t_v)://value_hashtag
							$tag_link = get_category_link($t_v->term_id);
							$tag_name = $t_v->name;
							?>
							<a href="<?php echo $tag_link; ?>" class="border_blue slider_blue color_blue hover_white"><p>#<?php echo $tag_name; ?></p></a>
							<?php endforeach; ?>
							<?php endif; ?>
						
							<?php if(!empty($agenda_terms)): ?>
							<?php foreach($agenda_terms as $t_a)://agenda
							$tag_link = get_category_link($t_a->term_id);
							$tag_name = $t_a->name;
							?>
							<a href="<?php echo $tag_link; ?>" class="border_green slider_green color_green hover_white"><p>#<?php echo $tag_name; ?></p></a>
							<?php endforeach; ?>
							<?php endif; ?>
						</div>


						<?php
						//著者情報
						$rows = get_field('author_select',$val->ID); // すべてのrow（内容・行）をいったん取得する
						$first_row = $rows[0]; // 1行目だけを$first_rowに格納しますよ～
						$first_row_item = $first_row['author']; // get the sub field value 
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
							<a class="socialbox commentbox" href="<?php echo get_permalink( $val->ID ); ?>?move=commentsAreaWrap"><?php echo $comments->total_comments; ?></a>
						</div>
					</div>
				</div><!-- /.content_mv -->
			</div>
			<?php endforeach; ?>
		</div><!-- /.content_mv_wrap -->
		<div class="arrows"></div>
	</div>
	<?php endif; ?>


	
	<div class="news">
		<span>
			<a href="#">【information呼び出し】文字数決め打ちする</a>
		</span>
		<span>
			<a href="#">リニューズからのお知らせ入る。文字数決め打ちする</a>
		</span>
	</div>

	<div class="inner_base">
		<?php
		$wp_query = new WP_Query();

		$args = array(
			'post_type' => 'articles',
			'posts_per_page' => "4",
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
				
				//ユーザー
//				$user_name = get_the_author_meta( 'display_name', $post->post_author );
//				$renews_id = get_the_author_meta( 'user_login', $post->post_author );

		// タイトル
				if (ua_smt() == true) {
					//スマホの場合の処理
					$title = mb_strimlen( $post->post_title, 0, 22, "...", "UTF-8" );
				} else {
					//それ以外の場合の処理
					$title = mb_strimlen( $post->post_title, 0, 36, "...", "UTF-8" );
				}
				$series_terms = get_the_terms($post->ID, 'series');
		?>
				<div class="article_middle">
					<div class="wrap_img">
						<div class="article_middle_img imgLiquidFill">
							<a href="<?php the_permalink(); ?>">
							<img src="<?php echo $imageUrl; ?>" alt="" />
							</a>
						</div>
					</div>

					<div class="textbox middle left_bottom">
						<?php if(!empty($series_terms)): ?>
						<?php foreach($series_terms as $ct):
						//						$series_type = get_field('series_type','series_'.$ct->term_id)[0];
						$series_link = get_category_link($ct->term_id);
						?>
						<a href="<?php echo $series_link; ?>">
							<span class="series_name">
								<?php echo $ct->name; ?>
							</span>
						</a>
						<?php endforeach; ?>
						<?php endif; ?>
						<a href="<?php the_permalink(); ?>">
							<h2 class="title_middle"><?php echo $title; ?></h2>
						</a>
						<div class="infobox">
							<?php
							//著者情報
							$rows = get_field('author_select' ); // すべてのrow（内容・行）をいったん取得する
							$first_row = $rows[0]; // 1行目だけを$first_rowに格納しますよ～
							$first_row_item = $first_row['author']; // get the sub field value 
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
								<div class="socialbox likebox"><?php if(function_exists('wp_ulike_comments')) wp_ulike('get'); ?></div>
								<a class="socialbox commentbox" href="<?php the_permalink(); ?>?move=commentsAreaWrap"><?php comments_number( '0', '1', '%' ); ?></a>
							</div>
						</div>
					</div>
				</div>
			
		<?php endwhile; ?>
			</div><!-- /.wrap_article_middle -->
			<div class="wrap_btn column3 clearfix">
				<a href="<?php echo home_url(); ?>/article/" class="btn_base color_blue">
					<span class="text_btn">すべての新着記事</span>
				</a>
			</div>
		</div><!-- /.content_article -->
		<?php endif; wp_reset_query(); ?>
		
	</div>
</section>

<section class="sec sec_agenda">
	<div class="inner_base">
		<h2 class="title_thin">
			<span class="title_thin_img white">
				<h2>アジェンダ</h2>
			</span>
		</h2>

		<!-- <div class="content_agenda column3 flex">
</div> -->

		<div uk-slider>
			<ul class="uk-slider-items uk-child-width-1-2 uk-child-width-1-3@s uk-child-width-1-3@m uk-light slider_agenda">
				<?php
				$taxonomy_name = 'agenda'; // タクソノミーのスラッグ名を入れる
				$post_type = 'articles'; // カスタム投稿のスラッグ名を入れる
				$args = array(
					'order' => 'DESC',
					'orderby' => 'menu_order',
					'hierarchical' => false
				);
			//	$taxonomys = get_terms( $taxonomy_name, $args);
				$taxonomys = get_field('top_agenda_option','option');

				if(!is_wp_error($taxonomys) && count($taxonomys)):
				foreach($taxonomys as $taxonomy):
				$url = get_term_link($taxonomy->slug, $taxonomy_name);
				$tax_posts = get_posts( array(
					'post_type' => $post_type,
					'posts_per_page' => 2, // 表示させたい記事数
					'tax_query' => array(
						array(
							'taxonomy' => $taxonomy_name,
							'terms' => array( $taxonomy->slug ),
							'field' => 'slug',
							'include_children' => true,
							'operator' => 'IN'
						)
					)
				));
				if( $tax_posts ) {
				?>
				<li class="agenda uk-transition-toggle" tabindex="0">
					<div class="wrap_title_agenda bg_rightgreen">
						<a href="<?php echo $url; ?>">
						<?php
					//アジェンダイメージ画像
					$agenda_img_id = get_field('agenda_img','agenda_'.$taxonomy->term_id);
					$agenda_url = '';
					if($agenda_img_id){
						$image = wp_get_attachment_image_src($agenda_img_id,'full');
						$agenda_url = $image[0];
					}else{
						$agenda_url = get_template_directory_uri().'/images/icon/noimg.jpg';
					}
							?>
							<img src="<?php echo $agenda_url; ?>" alt="<?php echo esc_html($taxonomy->name); ?>イメージ" class="img_agenda" width="160" />
							<h2 class="title_agenda color_green">#<?php echo esc_html($taxonomy->name); ?></h2>
						</a>
					</div>


					<ul class="list_agenda">
						<?php foreach($tax_posts as $tax_post):
						
					// アイキャッチ
					$thumbnail_id = get_post_thumbnail_id($tax_post->ID);
					$imageUrl = '';
					if($thumbnail_id){
						$image = wp_get_attachment_image_src($thumbnail_id,'large');
						$imageUrl = $image[0];
					}else{
						$imageUrl = get_template_directory_uri().'/images/icon/noimg.jpg';
					}
					
					//ユーザー
//					$user_name = get_the_author_meta( 'display_name', $tax_post->post_author );
//					$renews_id = get_the_author_meta( 'user_login', $tax_post->post_author );
					
					$title = mb_strimlen( get_the_title($tax_post->ID), 0, 29, "...", "UTF-8" );
						?>
						
						<?php
					//著者情報
					$rows = get_field('author_select',$tax_post->ID );
					$first_row = $rows[0];
					$first_row_item = $first_row['author'];
					if(!($first_row_item)){
						$user_name = get_the_author_meta( 'display_name', $tax_post->post_author );
						$renews_id = get_the_author_meta( 'user_login', $tax_post->post_author );
						$user_avatar = get_avatar( get_the_author_meta( 'ID' ), 64 );
					}else{
						$user_name = $first_row_item['display_name'];
						$renews_id = $first_row_item['user_nicename'];
						$user_avatar = $first_row_item['user_avatar'];
					}
						?>


						<li class="item_agenda">
							<a href="<?php echo get_permalink($tax_post->ID); ?>" class="target_agenda flex">
								<div class="wrap_thumbs_agenda_wrap">
									<div class="wrap_thumbs_agenda imgLiquidFill">
										<img src="<?php echo $imageUrl; ?>" alt="アイキャッチ" />
									</div>
								</div>
								<div class="wrap_text_agenda">
									<p class="text_agenda color_black">
										<?php echo $title; ?>
									</p>
									<p class="title_avatar eng">
										<span class="black"><?php echo $user_name; ?></span>
										<span>@<?php echo $renews_id; ?></span>
									</p>
								</div>
							</a>
						</li>
						<?php endforeach; wp_reset_postdata(); ?>
						<li class="see_more"><a href="<?php echo $url; ?>">すべてを見る➝</a></li>
					</ul>
				</li><!-- /.agenda -->
				

				<?php
				}
				endforeach;
				endif;
				?>
			</ul>

			<ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul>
		</div>
		<!-- /ukslider -->
		
		<div class="wrap_btn column3">
			<a href="<?php echo home_url(); ?>/agenda/" class="btn_base color_blue">
				<span class="text_btn">
					すべてのアジェンダ
				</span>
			</a>
		</div>
	</div>
</section>

<section class="sec sec_column">
	<div class="inner_base">
		<h2 class="title_thin">
			<span class="title_thin_img white">
				<h2>シリーズ</h2>
			</span>
		</h2>

		<div class="content_column column2 flex between">
			<?php
			$taxonomy_name = 'series'; // タクソノミーのスラッグ名を入れる
			$post_type = 'articles'; // カスタム投稿のスラッグ名を入れる
			$args = array(
				'order' => 'DESC',
				'orderby' => 'menu_order',
				'hierarchical' => false
			);
			//	$taxonomys = get_terms( $taxonomy_name, $args);
			$taxonomys = get_field('top_series_option','option');

			if(!is_wp_error($taxonomys) && count($taxonomys)):
			foreach($taxonomys as $taxonomy):
			$url = get_term_link($taxonomy->slug, $taxonomy_name);
			$count_all = get_term_by( 'slug', $taxonomy->slug, $taxonomy_name);
			$count_num = $count_all->count;
			$tax_posts = get_posts( array(
				'post_type' => $post_type,
				'posts_per_page' => 2, // 表示させたい記事数
				'tax_query' => array(
					array(
						'taxonomy' => $taxonomy_name,
						'terms' => array( $taxonomy->slug ),
						'field' => 'slug',
						'include_children' => true,
						'operator' => 'IN'
					)
				)
			));
			if( $tax_posts ) {
			?>
			<div class="column">
				<div class="inner_column">
					<?php
				//シリーズイメージ画像
				$series_img_id = get_field('series_img','series_'.$taxonomy->term_id);
				$series_url = '';
				if($series_img_id){
					$image = wp_get_attachment_image_src($series_img_id,'full');
					$series_url = $image[0];
				}else{
					$series_url = get_template_directory_uri().'/images/icon/noimg.jpg';
				}
				
				//SNSシェア
				//元となるテキスト
				$text = 'RENEWS | 『'.$taxonomy->name.'』';
				//URLエンコード処理
				$encoded = rawurlencode( $text ) ;
					?>
					<a href="<?php echo $url; ?>">
					<img src="<?php echo $series_url; ?>" alt="<?php echo esc_html($taxonomy->name); ?>イメージ" class="series_thumb" />
					</a>
					<div class="list_column">
						<h2 class="title_column">
							<?php echo esc_html($taxonomy->name); ?>
						</h2>
						
						<div class="btn_share">
							<div class="share-btn twitter">
								<a href="https://twitter.com/share?url=<?php echo $url; ?>&text=<?php echo $encoded; ?>" class="share_popup" target="_blank">
									<img src="<?php echo get_template_directory_uri(); ?>/images/icons/twitter.svg" alt="twitter" />
								</a>
							</div>
							<div class="share-btn facebook">
								<a href="https://www.facebook.com/sharer/sharer.php?u=<?php rawurlencode($url); ?>" class="share_popup" target="_blank">
									<img src="<?php echo get_template_directory_uri(); ?>/images/icons/fb.svg" alt="facebook" />
								</a>
							</div>
							<div class="share-btn line">
								<a href="https://social-plugins.line.me/lineit/share?url=<?php rawurlencode($url); ?>" class="share_popup" target="_blank">
									<img src="<?php echo get_template_directory_uri(); ?>/images/icons/line.svg" alt="line" />
								</a>
							</div>
							<div class="share-btn hatena">
								<a href="http://b.hatena.ne.jp/add?mode=confirm&url=<?php rawurlencode($url); ?>&title=<?php echo $encoded; ?>" class="share_popup" target="_blank" rel="nofollow">
									<img src="<?php echo get_template_directory_uri(); ?>/images/icons/hatena.svg" alt="hatena" />
								</a>
							</div>
						</div><!-- /.btn_share -->
						
						<div class="item_column_wrap">
						<?php foreach($tax_posts as $tax_post):

				// アイキャッチ
				$thumbnail_id = get_post_thumbnail_id($tax_post->ID);
				$imageUrl = '';
				if($thumbnail_id){
					$image = wp_get_attachment_image_src($thumbnail_id,'full');
					$imageUrl = $image[0];
				}else{
					$imageUrl = get_template_directory_uri().'/images/icon/noimg.jpg';
				}

				//ユーザー
//				$user_name = get_the_author_meta( 'display_name', $tax_post->post_author );
//				$renews_id = get_the_author_meta( 'user_login', $tax_post->post_author );
				
				$title = mb_strimlen( get_the_title($tax_post->ID), 0, 24, "...", "UTF-8" );
				$comments = wp_count_comments( $tax_post->ID );
				
				
						?>
						
						<?php
				//著者情報
				$rows = get_field('author_select',$tax_post->ID ); // すべてのrow（内容・行）をいったん取得する
				$first_row = $rows[0]; // 1行目だけを$first_rowに格納しますよ～
				$first_row_item = $first_row['author']; // get the sub field value 
				if(!($first_row_item)){
					$user_name = get_the_author_meta( 'display_name', $tax_post->post_author );
					$renews_id = get_the_author_meta( 'user_login', $tax_post->post_author );
					$user_avatar = get_avatar( get_the_author_meta( 'ID' ), 64 );
				}else{
					$user_name = $first_row_item['display_name'];
					$renews_id = $first_row_item['user_nicename'];
					$user_avatar = $first_row_item['user_avatar'];
				}
						?>
						<div class="item_column">
							<div class="wrap_text_column">
								<a href="<?php echo get_permalink($tax_post->ID); ?>" class="target_column flex">
									<p class="text_column color_blue">
										<?php echo $title; ?>
									</p>
								</a>
								<div class="target_column flex">
									<p class="title_avatar eng">
										<span class="black"><?php echo $user_name; ?></span>
										<span>@<?php echo $renews_id; ?></span>
									</p>
									<div class="wrap_social color_rightgreen flex">
										<div class="socialbox likebox"><?php if(function_exists('wp_ulike_comments')) echo wp_ulike( 'put', array("id" => $tax_post->ID) ); ?></div>
										<a class="socialbox commentbox" href="<?php echo get_permalink($tax_post->ID); ?>?move=commentsAreaWrap"><?php echo $comments->total_comments; ?></a>
									</div>
								</div>
							</div>
						</div>
						<?php endforeach; wp_reset_postdata(); ?>
						
						<div class="see_more">
							<a href="<?php echo $url; ?>">
								すべてを見る（全<?php echo $count_num ?>本）→
							</a>
						</div><!-- see_more -->
						</div><!-- item_column_wrap -->
					</div>
				</div>
			</div><!-- /.column -->
			<?php
			}
			endforeach;
			endif;
			?>



		</div>
		<!-- /.content_column -->
		
		<div class="clearfix">
			<div class="wrap_btn column3">
				<a href="<?php echo home_url(); ?>/series/" class="btn_base color_blue">
					<span class="text_btn">
						すべてのシリーズ／特集
					</span>
				</a>
			</div>
		</div>

	</div>
</section>

<section class="sec sec_renewer">
	<div class="inner_base">
		<h2 class="title_thin">
			<span class="title_thin_img beige">
				<h2>注目のリニュアー</h2>
			</span>
		</h2>

		<!-- <div class="content_renewer flex between column3">
</div> -->


		<?php echo do_shortcode( '[ultimatemember form_id="149"]' ) ?>


		<div class="wrap_btn column3">
			<a href="<?php echo home_url(); ?>/renewers/" class="btn_base color_beige">
				<span class="text_btn">
					すべてのリニュアー
				</span>
			</a>
		</div>
	</div>
	<!-- /.inner_base -->
</section>

<section class="sec sec_comment">
	<div class="inner_base">
		<h2 class="title_thin">
			<span class="title_thin_img beige">
				<h2>注目のコメント</h2>
			</span>
		</h2>

		<div class="content_commment column2 flex between">
			<div class="comment">
				<div class="head_comment flex">
					<div class="wrap_img_comment imgLiquidFill">
						<img
								 src="<?php echo get_template_directory_uri(); ?>/images/top/img_comment01.png"
								 alt="注目のコメントイメージ"
								 width="200"
								 />
					</div>
					<div class="wrap_title_comment">
						<h2 class="title_comment color_blue">
							家族向けの都市生活または田舎生活
							<p class="title_avatar eng">
								<span class="black">岡田智子</span>
								<span>@Okuda</span>
							</p>
						</h2>
					</div>
				</div>

				<div class="wrap_text_comment">
					<p class="text_comment">
						<small class="sst_comment title_avatar eng">
							<span class="name color_blue">
								<span class="black">岡田智子</span>
								<span>@Okuda</span>
							</span>
							<span class="hours">
								1時間
							</span>
						</small>
						親譲りの無鉄砲で小供の時から損ばかりしている。小学校に居る時分学校の二階から飛び降りて一週間ほど腰を抜かした事がある。なぜそんな無闇をしたと聞く人があるかも知れぬ。別段深い理由でもない。新築の二階から首を出していたら、同級生の一人が冗談に、いくら威張っても、そこから飛び降りる事は出来まい。弱虫やーい。
					</p>
					<hr />
					<a href="#" class="move_to_comment">この記事のコメント欄に移動➝</a>

				</div>
			</div>
			<!-- /.comment -->

			<div class="comment">
				<div class="head_comment flex">
					<div class="wrap_img_comment imgLiquidFill">
						<img
								 src="<?php echo get_template_directory_uri(); ?>/images/top/img_comment01.png"
								 alt="注目のコメントイメージ"
								 width="200"
								 />
					</div>
					<div class="wrap_title_comment">
						<h2 class="title_comment color_blue">
							家族向けの都市生活または田舎生活
							<p class="title_avatar eng">
								<span class="black">岡田智子</span>
								<span>@Okuda</span>
							</p>
						</h2>
					</div>
				</div>

				<div class="wrap_text_comment">
					<p class="text_comment">
						<small class="sst_comment title_avatar eng">
							<span class="name color_blue">
								<span class="black">岡田智子</span>
								<span>@Okuda</span>
							</span>
							<span class="hours">
								1時間
							</span>
						</small>
						親譲りの無鉄砲で小供の時から損ばかりしている。小学校に居る時分学校の二階から飛び降りて一週間ほど腰を抜かした事がある。なぜそんな無闇をしたと聞く人があるかも知れぬ。別段深い理由でもない。新築の二階から首を出していたら、同級生の一人が冗談に、いくら威張っても、そこから飛び降りる事は出来まい。弱虫やーい。
					</p>
					<hr />
					<a href="#" class="move_to_comment">この記事のコメント欄に移動➝</a>

				</div>
			</div>
			<!-- /.comment -->
		</div>
		<!-- /.content_commment -->
	</div>
	<!-- /.inner_base -->
</section>



<?php get_footer(); ?>