<?php

/**
 * Search Page
 * 検索結果ページ
 */
?>
<?php get_header(); ?>
<?php
$post_type = get_query_var('post_type');
?>
<div id="agenda_detail">
		<?php
		global $archivePageNum;
		$pageItemNum = 60;

// 		$paged = get_query_var('paged');
// 		query_posts($query_string . '&posts_per_page=' . $pageItemNum . '&paged=' . $paged);

		parse_str( $query_string, $args );
		$addArgs = array(
			'paged' => $paged,
			'posts_per_page' => $pageItemNum,
			'order' => 'DESC',
			'orderby' => 'date',
			'post_type' => 'articles'
		);
		$args = array_merge($args,$addArgs);
		$wp_query = new WP_Query($args);

		?>
		<?php if (have_posts()) : ?>
			<section class="sec sec_hashtag_detail">
				<div class="content_article">
					<div class="inner_base">
						<h2 class="title_thin">
							<span class="title_thin_img white">
								<h2>「<?php the_search_query(); ?>」の検索結果</h2>
							</span>
						</h2>

						<div class="wrap_article_middle grid articleListStyle">
							<?php while (have_posts()) : the_post(); ?>
							<?php $postId = $post->ID;
							// アイキャッチ
							$thumbnail_id = get_post_thumbnail_id();
							$imageUrl = '';
							if ($thumbnail_id) {
								$image = wp_get_attachment_image_src($thumbnail_id, 'large');
								$imageUrl = $image[0];
							} else {
								$imageUrl = get_template_directory_uri() . '/images/icon/noimg.jpg';
							}

							//著者
							//著者情報
							$rows = get_field('author_select'); // すべてのrow（内容・行）をいったん取得する
							$first_row = $rows[0]; // 1行目だけを$first_rowに格納しますよ～
							$first_row_item = $first_row['author']; // get the sub field value 
							if (!($first_row_item)) {
								$user_name = get_the_author_meta('display_name', $post->post_author);
								$renews_id = get_the_author_meta('user_login', $post->post_author);
								$user_avatar = get_avatar(get_the_author_meta('ID'), 64);
							} else {
								$user_name = $first_row_item['display_name'];
								$renews_id = $first_row_item['user_nicename'];
								$user_avatar = $first_row_item['user_avatar'];
							}
							//コメント
							$comments = wp_count_comments($post->ID);

							// タイトル
							$title = mb_strimwidth($post->post_title, 0, 66, "...", "UTF-8");
							$series_terms = get_the_terms($post->ID, 'series');
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
									<a href="<?php echo $series_link; ?>" class="search_series_name_link">
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
												<span class="commCount"><?php echo $comments->total_comments; ?></span>
											</a>
										</div>
									</div>
								</div>
							</div>
							<?php endwhile; ?>

						</div><!-- /.content_article -->
					</div>
				</div>
			</section>




			<?php
			$max_page = $wp_query->max_num_pages;
			if ($max_page != 1) :
			?>
				<div class="pagerArea inner_base">
					<?php global $wp_rewrite;
					$paginate_base = get_pagenum_link(1);
					if (strpos($paginate_base, '?') || !$wp_rewrite->using_permalinks()) {
						$paginate_format = '';
						$paginate_base = add_query_arg('paged', '%#%');
					} else {
						$paginate_format = (substr($paginate_base, -1, 1) == '/' ? '' : '/') . user_trailingslashit('page/%#%/', 'paged');
						$paginate_base .= '%_%';
					}
					echo paginate_links(array(
						'base' => $paginate_base,
						'format' => $paginate_format,
						'total' => $wp_query->max_num_pages,
						'end_size' => 1,
						'mid_size' => 1,
						'current' => ($paged ? $paged : 1),
					));
					?>
				</div>
				<!--pagerArea-->
			<?php endif; ?>

		<?php else : /* else have_posts */ ?>
			<div id="notFound" class="articleNotFound">
				<div class="inner_base">
					<div class="search_not_large">「<?php the_search_query(); ?>」と一致する記事は見つかりません。</div>
					<div class="search_not_small">別のキーワードでお探しください。</div>
				</div>
			</div>
			<!--notfound-->
		<?php endif;/* end have_posts */ ?>
</div>
<?php get_footer(); ?>