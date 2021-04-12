<?php get_header(); ?>


<div class="banner-body">
	<div class="floating-banner">
	    <a href="https://stg2.renews.jp/recruit/">
		    <img class="pc" src="https://stg2.renews.jp/wp-content/uploads/2021/02/recruit-floating-banner-pc.png" alt="PC用のフローティングバナー">
		    <img class="sp" src="https://stg2.renews.jp/wp-content/uploads/2021/02/recruit-floating-banner-sp.png" alt="スマホ用のフローティングバナー">
		    <p class="close"><a href="javascript:void(0)"><span>閉じる</span><i aria-hidden="true" class="fa fa-times"></i></a></p>
	    </a>
	</div>
</div>


<section class="sec sec_mv">
	<?php
	$posts = get_field('top_mv_option','option');
	if( $posts ):
	?>

	<div class="slide_wrap">
		<div class="content_mv_wrap">
			<?php foreach( $posts as $val ):

			// アイキャッチ
			$thumbnail_id = get_post_thumbnail_id($val);
			$imageUrl = '';
			if($thumbnail_id){
				$image = wp_get_attachment_image_src($thumbnail_id,'full');
				$imageUrl = $image[0];
			}else{
				$imageUrl = get_template_directory_uri().'/images/icon/noimg.jpg';
			}

			//ユーザー
			//$user_name = get_the_author_meta( 'display_name', $val->post_author );
			//$renews_id = get_the_author_meta( 'user_login', $val->post_author );


			$title = get_the_title( $val );

			$termsArg = array(
				'orderby' => 'menu_order',
				'order' => 'ASC'
			);

			$agenda_terms = wp_get_post_terms($val,'agenda',$termsArg);
			$hashtag_terms = wp_get_post_terms($val,'value_hashtag',$termsArg);
			$series_terms = wp_get_post_terms($val,'series',$termsArg);
			//コメント
			$comments = wp_count_comments( $val );
			?>
			<div class="slide">
				<div class="content_mv">
					<div class="article_main_img imgLiquidFill">
						<a href="<?php echo get_permalink( $val ); ?>">
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

						<a href="<?php echo get_permalink( $val ); ?>">
							<h2 class="title_large">
								<?php echo $title; ?>
							</h2>
						</a>


						<div class="top_tags">
							<?php if(!empty($hashtag_terms)): ?>
							<?php foreach($hashtag_terms as $t_v)://value_hashtag
							$tag_link = get_category_link($t_v->term_id);
							$tag_name = $t_v->name;

							//SNSシェアテキスト
							if($tag_name){
								$text = 'Renews | 『'.$title.'』 #'.$tag_name.'';
							}else{
								$text = 'Renews | 『'.$title.'』';
							}

							//URLエンコード処理
							$encoded = rawurlencode( $text ) ;
							$encodedURL = json_encode(get_permalink());

							?>
							<a href="https://twitter.com/share?url=<?php echo get_permalink( $val ); ?>&text=<?php echo $encoded; ?>" class="share_popup tag_value border_value"><?php echo $tag_name; ?></a>
							<?php endforeach; ?>
							<?php endif; ?>
							<br>
							<?php if(!empty($agenda_terms)): ?>
							<?php
							$postId = $val;
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


							<?php
							//著者情報
							$rows = get_field('author_select',$val); // すべてのrow（内容・行）をいったん取得する
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

							<?php
							//現在のユーザー
							$user = wp_get_current_user();
							$uid = $user->ID;

							//フォローチェック
							$follow_post = get_user_meta($uid,'article_follow');
							$follow_check = in_array($val, $follow_post);

							//ストックしている人数
							$args = array(
								'meta_key'     => 'article_follow',
								'meta_value'   => $val
							);
							$all_user_stockPost = get_users( $args );
							$stockNum = count($all_user_stockPost);
							?>


							<div class="wrap_social color_black flex">
								<div class="socialbox likebox"><?php if(function_exists('wp_ulike_comments')) echo wp_ulike( 'put', array("id" => $val) ); ?></div>
								<a class="socialbox commentbox flexSocialbox" href="<?php echo get_permalink( $val ); ?>?move=commentsAreaWrap">
									<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 42 41.3" style="enable-background:new 0 0 42 41.3;" xml:space="preserve">
										<path fill="none" stroke="#b0ad9e" stroke-width="1.5" class="icon_comm" data-name="icon_comm" d="M28.1,31.9c-1.4,0-2.8-0.2-4.2-0.7s-2.2-1.9-2-3.4v-0.2h-7.5c-2.2,0-4.1-1.8-4.1-4.1V15c0-2.2,1.8-4.1,4.1-4.1 l0,0h14.4c2.2,0,4.1,1.8,4.1,4.1v8.6c0,2.2-1.8,4.1-4.1,4.1h-1.7V28c0,1,0.6,2,1.5,2.6l2.2,1.4L28.1,31.9L28.1,31.9z"/>
									</svg>
									<span class="commCount"><?php echo $comments->total_comments; ?></span>
								</a>
							</div>
					</div>
				</div><!-- /.content_mv -->
			</div>
			<?php endforeach; ?>
		</div><!-- /.content_mv_wrap -->
		<div class="arrows"></div>
	</div>
	<?php endif; ?>


	<?php
	//ブログIDが「2」の子サイト
	switch_to_blog(2);
	?>
	<?php
	$posts = get_field('top_info','option');
	if( $posts ):
	?>
	<div class="news">
		<?php foreach( $posts as $val ): ?>
		<span style="margin:0px 20px;">
			<a href="<?php echo get_permalink( $val->ID ); ?>"><?php echo get_the_title( $val->ID ); ?></a>
		</span>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>
	<?php restore_current_blog(); ?>

	<div class="inner_base">
		<?php
		$posts = get_field('top_article_option','option');
		if( $posts ):
		?>
		<div class="content_article">
			<div class="wrap_article_middle flex colum2">
				<?php foreach( $posts as $val ):
				$postId = $val;
				// アイキャッチ
				$thumbnail_id = get_post_thumbnail_id($val);
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


				$title = get_the_title( $val );
				// タイトル
//				if (ua_smt() == true) {
//				//スマホの場合の処理
//				$title = mb_strimlen( $title_base, 0, 22, "...", "UTF-8" );
//				} else {
//				//それ以外の場合の処理
//				$title = mb_strimlen( $title_base, 0, 36, "...", "UTF-8" );
//				}


				$agenda_terms = get_the_terms($val,'agenda');
				$hashtag_terms = get_the_terms($val,'value_hashtag');
				$series_terms = get_the_terms($val,'series');
				//コメント
				$comments = wp_count_comments( $val );
				?>

				<div class="article_middle">
					<div class="wrap_img">
						<div class="article_middle_img imgLiquidFill">
							<a href="<?php echo get_permalink( $val ); ?>">
								<img src="<?php echo $imageUrl; ?>" alt="" />
							</a>
						</div>
					</div>


					<div class="textbox middle left_bottom">
						<?php if(!empty($series_terms)): ?>
						<?php foreach($series_terms as $ct):
						//$series_type = get_field('series_type','series_'.$ct->term_id)[0];
						$series_link = get_category_link($ct->term_id);
						?>
						<a href="<?php echo $series_link; ?>">
							<span class="series_name">
								<?php echo $ct->name; ?>
							</span>
						</a>
						<?php endforeach; ?>
						<?php endif; ?>


						<a href="<?php echo get_permalink( $val ); ?>">
							<h2 class="title_middle"><?php echo $title; ?></h2>
						</a>


						<div class="top_tags">
							<?php if(!empty($hashtag_terms)): ?>
							<?php foreach($hashtag_terms as $t_v)://value_hashtag
							$tag_link = get_category_link($t_v->term_id);
							$tag_name = $t_v->name;


							if($tag_name){
								$text = 'Renews | 『'.$title.'』 #'.$tag_name.'';
							}else{
								$text = 'Renews | 『'.$title.'』';
							}

							//URLエンコード処理
							$encoded = rawurlencode( $text ) ;
							$encodedURL = json_encode(get_permalink());
							?>

							<a href="https://twitter.com/share?url=<?php echo get_permalink( $val ); ?>&text=<?php echo $encoded; ?>" class="share_popup tag_value border_value"><?php echo $tag_name; ?></a>

							<?php endforeach; ?>
							<?php endif; ?>

							<br>

							<?php if(!empty($agenda_terms)): ?>
							<?php
							$postId = $val;
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



						<div class="card-bottom">

						<div class="infobox">
							<?php
							//著者情報
							$rows = get_field('author_select',$val ); // すべてのrow（内容・行）をいったん取得する
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
						</div>

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
							<div class="socialbox likebox"><?php if(function_exists('wp_ulike_comments')) echo wp_ulike( 'put', array("id" => $postId) ); ?></div>
							<a class="socialbox flexSocialbox commentbox" href="<?php echo get_permalink( $val ); ?>?move=commentsAreaWrap">
								<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 42 41.3" style="enable-background:new 0 0 42 41.3;" xml:space="preserve">
									<path fill="none" stroke="#b0ad9e" stroke-width="1.5" class="icon_comm" data-name="icon_comm" d="M28.1,31.9c-1.4,0-2.8-0.2-4.2-0.7s-2.2-1.9-2-3.4v-0.2h-7.5c-2.2,0-4.1-1.8-4.1-4.1V15c0-2.2,1.8-4.1,4.1-4.1 l0,0h14.4c2.2,0,4.1,1.8,4.1,4.1v8.6c0,2.2-1.8,4.1-4.1,4.1h-1.7V28c0,1,0.6,2,1.5,2.6l2.2,1.4L28.1,31.9L28.1,31.9z"/>
								</svg>
								<span class="commCount"><?php echo $comments->total_comments; ?></span>
							</a>
						</div>

						</div><!-- card-bottom -->

					</div>
				</div>

				<?php endforeach; ?>
			</div><!-- /.wrap_article_middle -->

			<div class="wrap_btn column3 clearfix">
				<a href="<?php echo home_url(); ?>/article/" class="btn_base color_blue">
					<span class="text_btn">すべての新着記事</span>
				</a>
			</div>

		</div><!-- /.content_article -->

		<?php endif; ?>

	</div>
</section>



<section class="sec sec_agenda">
	<div class="inner_base">

		<div class="title_thin">
			<span class="title_thin_img white">
				<a href="<?php echo home_url(); ?>/agenda/"><h2>アジェンダ</h2></a>
			</span>
		</div>

		<div class="agenda_slick">
			<ul class="slider_agenda">
				<?php
				$taxonomy_name = 'agenda'; // タクソノミーのスラッグ名を入れる
				$post_type = 'articles'; // カスタム投稿のスラッグ名を入れる
				$taxonomys = get_field('top_agenda_option','option');

				if(!is_wp_error($taxonomys) && count($taxonomys)):
				foreach($taxonomys as $taxonomy):
				$url = get_term_link($taxonomy->slug, $taxonomy_name);


				$args = array(
					'tax_query' => array(
						array(
							'taxonomy' => $taxonomy_name,
							'terms' => array( $taxonomy->slug ),
							'field' => 'slug'
						)
					),
					'post_type' => $post_type,
					'posts_per_page' => 2,
					'post_status' => 'publish',
					'order' => 'DESC',
					'orderby' => 'date'
				);
				$the_query = new WP_Query( $args );
				if($the_query->have_posts()):
				?>

				<li class="agenda">
					<div class="agenda_slide">
						<div class="wrap_title_agenda bg_lightblue">
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
								<h2 class="title_agenda"><?php echo esc_html($taxonomy->name); ?></h2>
							</a>
						</div>

						<ul class="list_agenda">
							<?php while($the_query->have_posts()): $the_query->the_post(); ?>
							<?php
							// アイキャッチ
							$thumbnail_id = get_post_thumbnail_id($tax_post->ID);
							$imageUrl = '';
							if($thumbnail_id){
								$image = wp_get_attachment_image_src($thumbnail_id,'large');
								$imageUrl = $image[0];
							}else{
								$imageUrl = get_template_directory_uri().'/images/icon/noimg.jpg';
							}
							$title = get_the_title($tax_post->ID);
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
								<div class="target_agenda flex">
									<div class="wrap_thumbs_agenda_wrap">
										<div class="wrap_thumbs_agenda imgLiquidFill">
											<a href="<?php echo get_permalink($tax_post->ID); ?>">
												<img src="<?php echo $imageUrl; ?>" alt="アイキャッチ" />
											</a>
										</div>
									</div>
									<div class="wrap_text_agenda">
										<a href="<?php echo get_permalink($tax_post->ID); ?>">
											<p class="text_agenda lineClampWrap lineClamp_2">
												<span><?php echo $title; ?></span>
											</p>
										</a>
										<a href="<?php echo home_url(); ?>/user/<?php echo $renews_id; ?>/">
											<p class="title_avatar">
												<span class="black"><?php echo $user_name; ?></span>
												<span>@<?php echo $renews_id; ?></span>
											</p>
										</a>
									</div>
								</div>
							</li>
							<?php endwhile; ?>
							<li class="see_more"><a href="<?php echo $url; ?>">「<?php echo esc_html($taxonomy->name); ?>」の記事一覧へ</a></li>
						</ul>
					</div><!-- agenda_slide -->
				</li><!-- /.agenda -->


				<?php endif; wp_reset_postdata(); ?>
				<?php
				endforeach;
				endif;
				?>
			</ul>
		</div>

		<div class="clearfix">
			<div class="wrap_btn column3">
				<a href="<?php echo home_url(); ?>/agenda/" class="btn_base color_blue">
					<span class="text_btn">
					すべてのアジェンダ
					</span>
				</a>
			</div>
		</div>

	</div>
</section>



<section class="sec sec_column">
	<div class="inner_base">
		<div class="title_thin">
			<span class="title_thin_img white">
				<a href="<?php echo home_url(); ?>/series/"><h2>シリーズ</h2></a>
			</span>
		</div>


		<div class="content_column column2 flex between">
			<?php
			$taxonomy_name = 'series'; // タクソノミーのスラッグ名を入れる
			$post_type = 'articles'; // カスタム投稿のスラッグ名を入れる
			$taxonomys = get_field('top_series_option','option');

			if(!is_wp_error($taxonomys) && count($taxonomys)):
			foreach($taxonomys as $taxonomy):
			$url = get_term_link($taxonomy->slug, $taxonomy_name);
			$count_all = get_term_by( 'slug', $taxonomy->slug, $taxonomy_name);
			$count_num = $count_all->count;

			$args = array(
				'tax_query' => array(
					array(
						'taxonomy' => $taxonomy_name,
						'terms' => array( $taxonomy->slug ),
						'field' => 'slug'
					)
				),
				'post_type' => $post_type,
				'posts_per_page' => 2,
				'post_status' => 'publish',
				'order' => 'DESC',
				'orderby' => 'date'
			);
			$the_query = new WP_Query( $args );
			if($the_query->have_posts()):
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
					<div class="inner_column_thumb">
						<a href="<?php echo $url; ?>">
							<img src="<?php echo $series_url; ?>" alt="<?php echo esc_html($taxonomy->name); ?>" class="series_thumb_trim" />
						</a>
					</div>
					<div class="list_column">
						<?php while($the_query->have_posts()): $the_query->the_post(); ?>
						<?php
						// アイキャッチ
						$thumbnail_id = get_post_thumbnail_id($tax_post->ID);
						$imageUrl = '';
						if($thumbnail_id){
							$image = wp_get_attachment_image_src($thumbnail_id,'full');
							$imageUrl = $image[0];
						}else{
							$imageUrl = get_template_directory_uri().'/images/icon/noimg.jpg';
						}
						$title = get_the_title($tax_post->ID);
						$comments = wp_count_comments( $tax_post->ID );

						//現在のユーザー
						$user = wp_get_current_user();
						$uid = $user->ID;

						//フォローチェック
						$follow_post = get_user_meta($uid,'article_follow');
						$follow_check = in_array($tax_post->ID, $follow_post);

						//ストックしている人数
						$args = array(
							'meta_key'     => 'article_follow',
							'meta_value'   => $tax_post->ID
						);
						$all_user_stockPost = get_users( $args );
						$stockNum = count($all_user_stockPost);
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
									<p class="text_column lineClampWrap lineClamp_1">
										<span><?php echo $title; ?></span>
									</p>
								</a>
								<div class="target_column flex">
									<a href="<?php echo home_url(); ?>/user/<?php echo $renews_id; ?>/">
										<p class="title_avatar">
											<span class="black"><?php echo $user_name; ?></span>
											<span>@<?php echo $renews_id; ?></span>
										</p>
									</a>
								</div>
							</div>
						</div>
						<?php endwhile; ?>
						<div class="see_more">
							<a href="<?php echo $url; ?>">
								「<?php echo esc_html($taxonomy->name); ?>」の記事一覧へ
							</a>
							（現在<span class="series_count"><?php echo $count_num ?></span>本）
						</div><!-- see_more -->
					</div>
				</div>
			</div><!-- /.column -->
			<?php endif; wp_reset_postdata(); ?>

			<?php
			endforeach;
			endif;
			?>
		</div><!-- /.content_column -->

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

<!-- 2021/03下旬 新規追加 黒澤 -->
<section class="sec sec_keyword">
	<div class="inner_base">
		<div class="title_thin">
			<span class="title_thin_img white">
				<a href="<?php echo home_url(); ?>/keyword/"><h2>注目のキーワード</h2></a>
			</span>
		</div>
<!-- 2021/03下旬 新規追加 黒澤 -->

		<!-- <div class="content_renewer flex between column3"></div> -->
		<div class="keyword_cont">
		<?php
		$taxonomy_name = 'keyword';
		$taxonomys = get_field('top_keyword_option','option');

		if(!is_wp_error($taxonomys) && count($taxonomys)):
		foreach($taxonomys as $taxonomy):
		$url = get_term_link($taxonomy->slug, $taxonomy_name);
		$title = get_the_title($tax_post->ID);
		?>
			<a href="<?php echo $url; ?>">
				<p>#<?php echo esc_html($taxonomy->name); ?></p>
			</a>
		<?php
			endforeach;
			endif;
		?>
		</div>

		<div class="clearfix">
			<div class="wrap_btn column3">
				<a href="<?php echo home_url(); ?>/keyword/" class="btn_base color_blue">
					<span class="text_btn">
						すべてのキーワード
					</span>
				</a>
			</div>
		</div>
	</div>
	<!-- /.inner_base -->
</section>


<section class="sec sec_renewer">
	<div class="inner_base">
		<div class="title_thin">
			<span class="title_thin_img beige">
				<a href="<?php echo home_url(); ?>/renewers/"><h2>注目のリニュアー</h2></a>
			</span>
		</div>

		<!-- <div class="content_renewer flex between column3"></div> -->

		<?php echo do_shortcode( '[ultimatemember form_id="149"]' ) ?>

		<div class="clearfix">
			<div class="wrap_btn column3">
				<a href="<?php echo home_url(); ?>/renewers/" class="btn_base color_beige">
					<span class="text_btn">
						すべてのリニュアー
					</span>
				</a>
			</div>
		</div>
	</div>
	<!-- /.inner_base -->
</section>



<?php
/* 一時的に「注目のコメント」セクションを非表示
<section class="sec sec_comment">
	<div class="inner_base">
		<div class="title_thin">
			<span class="title_thin_img beige">
				<h2>注目のコメント</h2>
			</span>
		</div>

		<div class="content_commment column2 flex between">
			<?php
			// コメントを取得するための引数
			$get_comments_args = [
				"type"   => "comment",
				"parent"=>0,
				"status" => "approve",
				'meta_key' => 'focus_comment',
				'meta_value' => '1',
				'number'  => '2',
			];
			// コメント一覧を取得して1つずつ出力
			foreach(get_comments($get_comments_args) as $top_comment) :
//			var_dump($top_comment);

			$pick_comm = $top_comment->comment_content;//コメント
			$pick_comm_id = $top_comment->comment_ID;//コメントのID
			$pick_comm_user_id = $top_comment->user_id;//コメントした人

			$comment_user_info = get_user_meta($pick_comm_user_id);
			$comment_renewsID = $comment_user_info['nickname'][0];
			$comment_user_firstname = $comment_user_info['first_name'][0];
			$comment_user_lastname = $comment_user_info['last_name'][0];
			$comment_user_name = $comment_user_lastname.$comment_user_firstname;
			//ユーザー権限
			$user_info = get_userdata($pick_comm_user_id);
			$user_roles = $user_info->roles;
//			var_dump($comment_user_info);

			$pick_post_id = $top_comment->comment_post_ID;//コメントされた記事のID
			$pick_post_url = get_permalink($pick_post_id);
			$pick_post_title = get_the_title($pick_post_id);
			$pick_post_status = get_post_status($pick_post_id);

			// アイキャッチ
			$thumbnail_id = get_post_thumbnail_id($pick_post_id);
			$imageUrl = '';
			if($thumbnail_id){
				$image = wp_get_attachment_image_src($thumbnail_id,'large');
				$imageUrl = $image[0];
			}else{
				$imageUrl = get_template_directory_uri().'/images/icon/noimg.jpg';
			}

			//著者情報
			$rows = get_field('author_select',$pick_post_id ); // すべてのrow（内容・行）をいったん取得する
			$first_row = $rows[0]; // 1行目だけを$first_rowに格納しますよ～
			$first_row_item = $first_row['author']; // get the sub field value
			if(!($first_row_item)){
				$user_name = get_the_author_meta( 'display_name', $top_comment->post_author );
				$renews_id = get_the_author_meta( 'user_login', $top_comment->post_author );
			}else{
				$user_name = $first_row_item['display_name'];
				$renews_id = $first_row_item['user_nicename'];
			}
			$comment_date = $top_comment->comment_date;//コメントした時刻
			$date = new DateTime($comment_date);
			$comment_time = $date->format('U');
			$current_time = current_time('timestamp');//現在時刻

			$human_time_diff = human_time_diff( $comment_time, $current_time ) . '前';
			?>
			<div class="comment">
				<div class="head_comment wrap flex">
					<div class="wrap_img_comment imgLiquidFill">
						<a href="<?php echo $pick_post_url; ?>"></a>
						<img src="<?php echo $imageUrl; ?>" alt="注目のコメントイメージ" width="200" />
					</div>
					<div class="wrap_title_comment">
						<h2 class="title_comment color_blue">
							<a href="<?php echo $pick_post_url; ?>"><?php echo $pick_post_title; ?></a>
							<p class="title_avatar eng">
								<a href="<?php echo home_url(); ?>/user/<?php echo $renews_id; ?>">
									<span class="black"><?php echo $user_name; ?></span>
									<span>@<?php echo $renews_id; ?></span>
								</a>
							</p>
						</h2>
					</div>
				</div>

				<div class="wrap_text_comment">
					<div class="wrap_text_comment_inner">
						<p class="text_comment">
							<small class="sst_comment title_avatar eng">
								<span class="name">
									<?php if(in_array("um_renewer", $user_roles)): ?>
									<a href="<?php echo home_url(); ?>/user/<?php echo $comment_renewsID; ?>">
										<?php if($comment_user_name != $comment_renewsID): ?>
										<span class="black"><?php echo $comment_user_name; ?></span>
										<?php endif; ?>
										<span class="color_blue">@<?php echo $comment_renewsID; ?></span>
									</a>
									<?php else: ?>
									<?php if($comment_user_name != $comment_renewsID): ?>
									<span class="black"><?php echo $comment_user_name; ?></span>
									<?php endif; ?>
									<span class="black">@<?php echo $comment_renewsID; ?></span>
									<?php endif; ?>
								</span>
								<span class="hours">
									<?php echo $human_time_diff; ?>
								</span>
							</small>
							<?php echo $pick_comm; ?>
						</p>
						<div class="move_to_comment_wrap">
							<a href="<?php echo $pick_post_url; ?>?move=commentsAreaWrap" class="move_to_comment">この記事のコメント欄に移動➝</a>
						</div>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
*/
?>


<?php get_footer(); ?>
