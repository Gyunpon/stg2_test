<?php get_header(); ?>
<?php
$post_type = get_query_var('post_type');
?>
		<?php
		global $archivePageNum;
		$pageItemNum = $archivePageNum;

		$paged = get_query_var('paged');
		query_posts($query_string . '&posts_per_page='.$pageItemNum.'&paged=' . $paged);

		$archivePageName = '';
		if(is_tag()){
			$archivePageName = single_tag_title( '', false );
		}elseif(is_category()){
			$archivePageName = single_cat_title( '', false );
		}elseif(is_tax()){
			$archivePageName = single_term_title( '', false );
		}else{
			$archivePageName = post_type_archive_title( '', false );
		}
		
		if(empty($archivePageName)){ $archivePageName = '投稿'; }
		
		?>
		<?php if(have_posts()): ?>

<section id="article" class="sec sec_article">
	<div class="inner_base">
		<h2 class="title_thin">
			<span class="title_thin_img beige">
				<h2>新着記事</h2>
			</span>
		</h2>

		
		<div class="content_article">
			<div class="wrap_article_middle grid">
				<?php while (have_posts()): the_post(); ?>
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
				$series_terms = get_the_terms($val->ID,'series');
				?>
				<div class="article_middle">
					<div class="article_middle_img imgLiquidFill">
						<a href="<?php the_permalink(); ?>">
						<img src="<?php echo $imageUrl; ?>" alt="<?php echo $title; ?> サムネイル" />
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
								<div class="socialbox likebox"><?php if(function_exists('wp_ulike_comments')) echo wp_ulike( 'put', array("id" => $postId) ); ?></div>
								<a class="socialbox commentbox" href="<?php the_permalink(); ?>?move=commentsAreaWrap"><?php comments_number( '0', '1', '%' ); ?></a>
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
			'mid_size' => 2,
			'current' => ($paged ? $paged : 1),
		));
		?>
	</div>
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
<?php get_footer(); ?>