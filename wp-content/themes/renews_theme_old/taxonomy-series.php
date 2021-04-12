<?php get_header(); ?>
<?php
$post_type = get_query_var('post_type');
?>
<div id="agenda_detail" class="archive underContents <?php echo $post_type.'_archive'; ?>">
	<div class="inner">
		<?php
		global $archivePageNum;
		$pageItemNum = $archivePageNum;

		$paged = get_query_var('paged');
		query_posts($query_string . '&posts_per_page='.$pageItemNum.'&paged=' . $paged);
		
		$archivePageName = single_term_title( '', false );
	
		
		//説明文取得
		$termSlug = get_query_var('series');
		$term = get_term_by('slug', $termSlug, 'series');
		$termDescription = $term->description;
		
		//シリーズイメージ画像
		$series_img_id = get_field('series_img','series_'.$term->term_id);
		$series_url = '';
		if($series_img_id){
			$image = wp_get_attachment_image_src($series_img_id,'full');
			$series_url = $image[0];
		}else{
			$series_url = get_template_directory_uri().'/images/icon/noimg.jpg';
		}
		
		
		if(empty($archivePageName)){ $archivePageName = '投稿'; }
		
		?>
		<?php if(have_posts()): ?>

		<section class="sec sec_column_detail">

			<div class="column-highlighted">
				<?php if($series_img_id): ?>
				<img class="series_thumb" src="<?php echo $series_url; ?>" alt="<?php echo $archivePageName; ?> シリーズサムネイル" />
						 <?php endif; ?>
				<div class="column-text-wrapper">
					<?php if($termDescription): ?>
					<?php echo $termDescription; ?>
					<?php endif; ?>
					
					<div class="wrap_switch">
						<span class="switch-button openg">
							<i class="switch"></i>
						</span>
					</div>
				</div>
			</div>
			
			

			<div class="inner_base">
				<div class="content_article">
					<div class="wrap_article_middle flex colum3">

			<?php while (have_posts()): the_post(); ?>
			<?php
			$postId = $post->ID;

			// image
			$thumbnailId = get_post_thumbnail_id();
			$imageUrl = '';
			if($thumbnailId){
				$thumbnailInfo = wp_get_attachment_image_src( $thumbnailId , 'middle' );
				$imageUrl = $thumbnailInfo[0];
			}else{
				global $noImage_thumbnail;
				$imageUrl = $noImage_thumbnail;
			}
						
						//ユーザー
//						$user_name = get_the_author_meta( 'display_name', $post->post_author );
//						$renews_id = get_the_author_meta( 'user_login', $post->post_author );
						//著者情報
						$rows = get_field('author_select',$post->ID );
						$first_row = $rows[0];
						$first_row_item = $first_row['author'];
						if(!($first_row_item)){
							$user_name = get_the_author_meta( 'display_name', $post->post_author );
							$renews_id = get_the_author_meta( 'user_login', $post->post_author );
							$user_avatar = get_avatar( get_the_author_meta( 'ID' ), 64 );
						}else{
							$user_name = $first_row_item['display_name'];
							$renews_id = $first_row_item['user_nicename'];
							$user_avatar = $first_row_item['user_avatar'];
						}

			// 日付
			$date = get_the_time('Y.m.d');
						$comments = wp_count_comments( $postId );
						$title = mb_strimwidth( get_the_title($postId), 0, 47, "...", "UTF-8" );

			// カテゴリー
			$postTax = get_object_taxonomies($post);
						$series_terms = get_the_terms($post->ID,'series');
			?>
						<div class="article_middle">
							<div class="article_middle_img imgLiquidFill">
								<a href="<?php the_permalink(); ?>">
								<img src="<?php echo $imageUrl; ?>" alt="アジェンダサムネイル" />
								</a>
							</div>

							<div class="textbox middle left_bottom">
								<?php if(!empty($series_terms)): ?>
								<?php foreach($series_terms as $ct):
								$series_link = get_category_link($ct->term_id);
								?>
								<div class="series_area">
									<a href="<?php echo $series_link; ?>">
										<span class="series_name">
											<?php echo $ct->name; ?>
										</span>
									</a>
								</div>
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

										<div class="wrap_social color_black flex">
											<div class="socialbox likebox"><?php if(function_exists('wp_ulike_comments')) echo wp_ulike( 'put', array("id" => $post->ID) ); ?></div>
											<a class="socialbox commentbox" href="<?php the_permalink(); ?>?move=commentsAreaWrap"><?php echo $comments->total_comments; ?></a>
										</div>
									</div>
								</div>
								
							</div>
						</div>

			<?php endwhile;?>
					</div><!-- /.wrap_article_middle -->
				</div><!-- /.content_article -->
			</div><!-- /.inner_base -->

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
					'mid_size' => 2,
					'current' => ($paged ? $paged : 1),
				));
				?>
			</div><!--pagerArea-->
			<?php endif; ?>
		
		
		</section>



		<?php else: /* else have_posts */ ?>
		<div id="notFound" class="articleNotFound">
			<h1>お探しの<?php echo $archivePageName; ?>に関する記事は見つかりませんでした。</h1>
			<p>
				申し訳ございません。<br />
				<?php echo $archivePageName; ?>に関する記事は見つかりませんでした。
			</p>
		</div><!--notfound-->
		<?php endif;/* end have_posts */ ?>
	</div>
</div><!--archive-->
<?php get_footer(); ?>