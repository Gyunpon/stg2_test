<?php get_header(); ?>


<section class="sec sec_error">
	<div class="inner_base ">

		<!--
		<div class="logo_header">
			<a href="<?php echo home_url(); ?>/">
				<svg
						 version="1.1"
						 id="Layer_1"
						 xmlns="http://www.w3.org/2000/svg"
						 xmlns:xlink="http://www.w3.org/1999/xlink"
						 width="109px"
						 height="26px"
						 viewBox="0 0 109 26"
						 version="1.1"
						 style="enable-background:new 0 0 108.1 22;"
						 xml:space="preserve"
						 >
					<title>logo RENEWS</title>
					<style type="text/css">
						.st0 {
							fill: #2c76a4;
						}
					</style>
					<g>
						<polygon class="st0" points="58,22 58,8 75,8 75,10 60,10 60,14 75,14 75,16 60,16 60,20 75,20 75,22 	" />
						<polygon class="st0" points="22,14 22,0 39,0 39,2 24,2 24,6 39,6 39,8 24,8 24,12 39,12 39,14 	" />
						<polygon class="st0" points="52.9,18 44,7.2 44,18 42,18 42,4 44.1,4 53,14.8 53,4 55,4 55,18 	" />
						<polygon class="st0" points="89.6,18 86.1,7.4 82.7,18 80.7,18 76.1,4 78.2,4 81.7,14.6 85.2,4 87.1,4 90.6,14.6 94.1,4 96.1,4  91.5,18 	" />
						<path class="st0" d="M103.4,18.1c-2,0-4-0.8-5.6-2.3l-0.2-0.2l1.3-1.5l0.2,0.2c1.2,1.1,2.8,1.7,4.3,1.7c0.6,0,1.1-0.1,1.6-0.3 c0.8-0.3,1.2-0.9,1.2-1.6c0-1.3-1-1.7-3.3-2.3c-1.9-0.5-4.6-1.2-4.6-4c0-1.5,0.8-2.8,2.2-3.4c0.7-0.3,1.5-0.5,2.4-0.5 c1.7,0,3.5,0.6,4.8,1.7l0.2,0.2l-1.3,1.5l-0.2-0.2c-1-0.8-2.2-1.3-3.5-1.3c-0.6,0-1.2,0.1-1.6,0.3c-0.7,0.3-1.1,0.9-1.1,1.6 c0,1.1,0.8,1.5,3.1,2.1c2,0.5,4.8,1.2,4.8,4.2c0,1.5-0.9,2.8-2.3,3.5C105.1,17.9,104.3,18.1,103.4,18.1z" />
						<path class="st0" d="M14.5,11.8c2.6-0.7,4.5-3,4.5-5.8c0-3.3-2.7-6-6-6H0v12v6h2v-6h10.1l4.7,6h2.5L14.5,11.8z M2,10V2h11 c2.2,0,4,1.8,4,4s-1.8,4-4,4H2z" />
					</g>
				</svg>
			</a>
		</div>
	-->


		<div class="mv_error">
			<span class="error_text">404</span>

			<h1 class="text_middle color_blue">
				ページが見つかりません
			</h1>

			<a href="<?php echo home_url(); ?>/" class="btn_base color_blue reverse">
				<span class="text_btn">
					ホームページに戻ります
				</span>
			</a>
		</div>

	</div>
</section>

<section id="article" class="sec sec_article">
	<div class="inner_base">
		<h2 class="title_thin">
			<span class="title_thin_img beige">
				<h2>新着記事</h2>
			</span>
		</h2>
		<p class="title_thin_subtitle mb-50">すべてのコンテンツを新着順に表示します。</p>


		<div class="content_article">
			<div class="wrap_article_middle grid articleListStyle">
				<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>
				<?php
				$postId = $post->ID;

				// image
				$thumbnailId = get_post_thumbnail_id();
				$imageUrl = '';
				if($thumbnailId){
					$thumbnailInfo = wp_get_attachment_image_src( $thumbnailId , 'large' );
					$imageUrl = $thumbnailInfo[0];
				}else{
					global $noImage_thumbnail;
					$imageUrl = $noImage_thumbnail;
				}
				// タイトル
				$title = mb_strimwidth( $post->post_title, 0, 66, "...", "UTF-8" );
				// 日付
				$date = get_the_time('Y.m.d');

				//ユーザー
				//				$user_name = get_the_author_meta( 'display_name', $post->post_author );
				//				$renews_id = get_the_author_meta( 'user_login', $post->post_author );

				// カテゴリー
				$postTax = get_object_taxonomies($post);

				$termsArg = array(
					'orderby' => 'menu_order',
					'order' => 'ASC'
				);
				$series_terms = wp_get_post_terms($postId,'series',$termsArg);

				?>
				<div class="article_middle">
					<div class="wrap_img">
						<div class="article_middle_img imgLiquidFill">
							<a href="<?php the_permalink(); ?>">
								<img src="<?php echo $imageUrl; ?>" alt="<?php echo $title; ?> サムネイル" />
							</a>
						</div>
					</div>

					<div class="textbox middle left_bottom">
						<?php if(!empty($series_terms)): ?>
						<?php foreach($series_terms as $ct):
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
							<h2 class="title_middle artcle_small_title">
								<?php echo $title; ?>
							</h2>
						</a>
						<div class="card-bottom">
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
								<a class="socialbox flexSocialbox commentbox" href="<?php the_permalink(); ?>?move=commentsAreaWrap">
									<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 42 41.3" style="enable-background:new 0 0 42 41.3;" xml:space="preserve">
										<path fill="none" stroke="#b0ad9e" stroke-width="1.5" class="icon_comm" data-name="icon_comm" d="M28.1,31.9c-1.4,0-2.8-0.2-4.2-0.7s-2.2-1.9-2-3.4v-0.2h-7.5c-2.2,0-4.1-1.8-4.1-4.1V15c0-2.2,1.8-4.1,4.1-4.1 l0,0h14.4c2.2,0,4.1,1.8,4.1,4.1v8.6c0,2.2-1.8,4.1-4.1,4.1h-1.7V28c0,1,0.6,2,1.5,2.6l2.2,1.4L28.1,31.9L28.1,31.9z"/>
									</svg>
									<span class="commCount"><?php comments_number( '0', '1', '%' ); ?></span>
								</a>
							</div>
						</div>
					</div>
				</div>
				<?php endwhile;?>
			</div><!-- /.wrap_article_middle -->
		</div><!-- /.content_article -->


	</div>


	<?php
	$max_page = $wp_query->max_num_pages;
	if($max_page != 1):
	?>

	<div class="pagerArea inner_base">
		<?php global $wp_rewrite;
		$paginate_base = get_pagenum_link(1);
		if (strpos($paginate_base, '?') || ! $wp_rewrite->using_permalinks()) {
			$paginate_format = '';
			$paginate_base = add_query_arg('paged', '%#%');
		} else {
			$paginate_format = (substr($paginate_base, -1 ,1) == '/' ? '' : '/') . user_trailingslashit('page/%#%/', 'paged');
			$paginate_base .= '%_%';
		}
		echo paginate_links( array(
			'base' => $paginate_base,
			'format' => $paginate_format,
			'total' => $wp_query->max_num_pages,
			'end_size' => 1,
			'mid_size' => 1,
			'current' => ($paged ? $paged : 1),
		));
		?>
	</div>

	<?php endif; ?>

</section>


<?php get_footer(); ?>
