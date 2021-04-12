<?php get_header(); ?>
<?php
$post_type = get_query_var('post_type');
?>
<?php
global $archivePageNum;
$pageItemNum = $archivePageNum;

$paged = get_query_var('paged');
query_posts($query_string . '&posts_per_page=' . $pageItemNum . '&paged=' . $paged);

$archivePageName = single_term_title('', false);

if (empty($archivePageName)) {
	$archivePageName = '投稿';
}

?>
<div id="agenda_detail">

	<div class="inner_base">
		<section class="sec sec_hashtag_detail">
			<h2 class="title_thin">
				<span class="title_thin_img white">
					<h2>バリューハッシュタグ</h2>
				</span>
			</h2>
			<p class="title_thin_subtitle">「<?php echo $archivePageName; ?>」というタグが付いた記事を集めました。</p>
		</section>


		<?php if (have_posts()) : ?>
			<section class="sec_column_detail">
				<div class="content_article">
					<div class="wrap_article_middle grid articleListStyle">
						<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
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
											<img src="<?php echo $imageUrl; ?>" alt="アジェンダサムネイル" />
										</a>
									</div>
								</div>

								<div class="textbox middle left_bottom">
									<?php if (!empty($series_terms)) : ?>
										<?php foreach ($series_terms as $ct) :
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
										<h2 class="title_middle">
											<?php echo $title; ?>
										</h2>
									</a>
									<div class="card-bottom">
										<div class="subinfo">
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
											$follow_post = get_user_meta($uid, 'article_follow');
											$follow_check = in_array($postId, $follow_post);

											//ストックしている人数
											$args = array(
												'meta_key'     => 'article_follow',
												'meta_value'   => $postId
											);
											$all_user_stockPost = get_users($args);
											$stockNum = count($all_user_stockPost);
											?>

											<div class="wrap_social color_black flex">
												<div class="socialbox likebox"><?php if(function_exists('wp_ulike_comments')) echo wp_ulike( 'put', array("id" => $postId) ); ?></div>
												<a class="socialbox commentbox" href="<?php the_permalink(); ?>?move=commentsAreaWrap">
													<svg xmlns="http://www.w3.org/2000/svg" width="21.9" height="20.579" viewBox="0 0 21.9 20.579">
														<g transform="translate(-236.237 -78.004)">
															<path d="M240.187,78.754a3.2,3.2,0,0,0-3.2,3.2v8.4a3.2,3.2,0,0,0,3.2,3.2h8v1a2.351,2.351,0,0,0,1.5,2.5,11.311,11.311,0,0,0,3.909.665,3.956,3.956,0,0,1-1.81-3.162v-1h2.4a3.2,3.2,0,0,0,3.2-3.2v-8.4a3.2,3.2,0,0,0-3.2-3.2h-14" fill="none" stroke="#b0ad9e" stroke-miterlimit="10" stroke-width="1.5" class="icon_comm" data-name="icon_comm"/>
														</g>
													</svg>
												<?php echo $comments->total_comments; ?>
												</a>
											</div>
										</div>
									</div>

								</div>
							</div><!-- /.article_middle -->

						<?php endwhile; ?>
					</div><!-- /.content_article -->
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
						'mid_size' => 2,
						'current' => ($paged ? $paged : 1),
					));
					?>
				</div>
				<!--pagerArea-->
			<?php endif; ?>


		<?php else : /* else have_posts */ ?>
			<div id="notFound" class="articleNotFound">
				<div class="inner_base">
					<h1>お探しの<?php echo $archivePageName; ?>に関する記事は見つかりませんでした。</h1>
					<p>
						申し訳ございません。<br />
						<?php echo $archivePageName; ?>に関する記事は見つかりませんでした。
					</p>
				</div>
			</div>
			<!--notfound-->
		<?php endif;/* end have_posts */ ?>

	</div>
</div>

<?php get_footer(); ?>
