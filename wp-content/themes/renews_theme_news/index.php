<?php get_header(); ?>

<section id="info" class="sec sec_info">
	<div class="inner_base">
		<div class="sec_title">
			<h1 class="main_title">Information
			<span class="main_title_jp">お知らせ</span>
			</h1>
			<p class="main_title_desc mb-10">Renewsからの「お知らせ」を新着順にご紹介します。</p>
		</div>

		<?php
		$pageNum = 12;
		$paged = get_query_var('paged');

		$wp_query = new WP_Query();
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => $pageNum,
			'paged' => $paged,
			'post_status' => 'publish',
			'orderby' => 'date',
			'order' => 'DESC'
			);
		$wp_query->query($args);
		if($wp_query->have_posts()):
		?>
	
		<div id="info_top_contentArticle" class="content_article">
			<div id="info_top_contentArticleList">
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
						$imageUrl = get_template_directory_uri().'/images/icons/noimg.jpg';
					}
					// タイトル
					$title = mb_strimwidth( $post->post_title, 0, 66, "...", "UTF-8" );
					$series_terms = get_the_terms($post->ID, 'category');
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
							$taxonomy_name = 'category'; // タクソノミーのスラッグ名を入れる
							//$series_type = get_field('series_type','series_'.$ct->term_id)[0];
							$url = get_term_link($ct->slug, $taxonomy_name);
							?>
							<a href="<?php echo $url; ?>" class="series_name">
								<span>
									お知らせ＞<?php echo $ct->name; ?>
								</span>
							</a>
							<?php endforeach; ?>
							<?php endif; ?>


							<a href="<?php the_permalink(); ?>">
								<h2 class="title_middle"><?php echo $title; ?></h2>
							</a>
							<div class="card-bottom">
								<div class="infobox">
									<?php
									//著者情報
									$rows = get_field('author_select_info' ); // すべてのrow（内容・行）をいったん取得する
									$first_row = $rows[0]; // 1行目だけを$first_rowに格納しますよ～
									$first_row_item = $first_row['author_info']; // get the sub field value
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

									<a href="<?php echo network_home_url(); ?>user/<?php echo $renews_id; ?>/">
										<div class="wrap_avatar flex">
											<div class="textbox_avatar">
												<?php echo $user_avatar; ?>
											</div>
											<p class="title_avatar eng">
												<span class="black"><?php echo $user_name; ?></span>
												<!--<span>@<?php echo $renews_id; ?></span>-->
											</p>
										</div>
									</a>
									<div class="wrap_social color_black flex">
										<div class="socialbox datebox"><?php echo get_the_time('Y.m.d'); ?></div>
									</div>
								</div>
							</div><!-- card-bottom -->
						</div>
					</div><!-- /.article_middle -->
					<?php endwhile; ?>
				</div><!-- /.wrap_article_middle -->
			</div><!-- info_top_contentArticleList -->

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
			</div><!-- /.pagerArea-->
			<?php endif; ?>
		</div><!-- /.content_article -->
		<?php endif; wp_reset_query(); ?>
	</div><!-- /.inner_base-->
</section>

<?php get_footer(); ?>
