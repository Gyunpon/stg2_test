<?php get_header(); ?>
<?php
$post_type = get_query_var('post_type');
?>
		<?php
		global $archivePageNum;
		$pageItemNum = $archivePageNum;

		$paged = get_query_var('paged');
		query_posts($query_string . '&posts_per_page=13&paged=' . $paged);
		
		$archivePageName = single_term_title( '', false );
		
		//説明文取得
		$termSlug = get_query_var('agenda');
		$term = get_term_by('slug', $termSlug, 'agenda');
$termDescription = strip_tags($term->description);

//アジェンダイメージ画像
$agenda_img_id = get_field('agenda_img','agenda_'.$term->term_id);
$agenda_url = '';
if($agenda_img_id){
	$image = wp_get_attachment_image_src($agenda_img_id,'full');
	$agenda_url = $image[0];
}else{
	$agenda_url = get_template_directory_uri().'/images/icon/noimg.jpg';
}

		if(empty($archivePageName)){ $archivePageName = '投稿'; }
		
		?>
		<?php if(have_posts()): ?>

<div id="agenda_detail">
	<section class="sec sec_column_detail agenda_sec">
		<div class="inner_base">
			<div class="head_content">
				<div class="title_head_content_wrapper">
					<img src="<?php echo $agenda_url; ?>" alt="メインビジュアルイメージ" />
					<h2 class="title_head_content color_green">
						#<?php echo $archivePageName; ?>
					</h2>
					<div class="wrap_switch">
						<span class="switch-button openg">
							<i class="switch"></i>
						</span>
					</div>
				</div>
				<p class="text_intro_head_content color_green">
					「#<?php echo $archivePageName; ?>」というタグが付いた記事を集めました。<?php if($termDescription){echo $termDescription;} ?>
				</p>
			</div>
		</div>
		
		<!-- 記事一覧 -->
		<?php $args = array(
	'posts_per_page'   => -1,
	'orderby'          => 'date',
	'order'            => 'DESC',
	'post_type'        => 'articles',
	'tax_query' => array(
		array(
			'taxonomy' => 'agenda',
			'field' => 'slug',
			'terms' => $termSlug
		)
	)
);
		$posts_array = get_posts( $args ); ?>
		
		<!-- 1件目 -->
		<?php foreach ( $posts_array as $post ) : setup_postdata( $post ); $loopcount_1++;
		
		// アイキャッチ
		$thumbnail_id = get_post_thumbnail_id($post->ID);
		$imageUrl = '';
		if($thumbnail_id){
			$image = wp_get_attachment_image_src($thumbnail_id,'full');
			$imageUrl = $image[0];
		}else{
			$imageUrl = get_template_directory_uri().'/images/icon/noimg.jpg';
		}
		
		//著者情報
//		$user_name = get_the_author_meta( 'display_name', $post->post_author );
//		$renews_id = get_the_author_meta( 'user_login', $post->post_author );
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
		
		//コメント
		$comments = wp_count_comments( $post->ID );
		$title = mb_strimwidth( get_the_title($post->ID), 0, 47, "...", "UTF-8" );
		
		// カテゴリー
		$postTax = get_object_taxonomies($post);
		$series_terms = get_the_terms($post->ID,'series');
		?>
		<?php if ($loopcount_1 <= 1): //1件目 ?>
		
		<div class="content_mv">
			<div class="article_main_img imgLiquidFill">
				<a href="<?php the_permalink(); ?>">
				<img src="<?php echo $imageUrl; ?>" alt="アジェンダサムネイル" />
				</a>
			</div>
			<div class="textbox large right_top">
				<?php if(!empty($series_terms)): ?>
				<?php foreach($series_terms as $ct):
				$series_link = get_category_link($ct->term_id);
				?>
				<a href="<?php echo $series_link; ?>">
				<p class="series_name"><?php echo $ct->name; ?></p>
				</a>
				<?php endforeach; ?>
				<?php endif; ?>
			
				
				<a href="<?php the_permalink(); ?>">
					<h2 class="title_large">
						<?php echo $title; ?>
					</h2>
				</a>

				<?php if(!empty($postTax)): ?>
				<div class="top_tags">
					<?php foreach($postTax as $taxName): ?>
					<?php
					$postTerms = get_the_terms($postId, $taxName);
					if(!empty($postTerms)):
					?>
					<?php foreach($postTerms as $t):
					if($t->taxonomy == 'value_hashtag'):
					$tag_link = get_category_link($t->term_id);
					?>
					<a href="<?php echo $tag_link; ?>" class="border_blue slider_blue color_blue hover_white">
						<p>#<?php echo $t->name; ?></p>
					</a>
					<?php
					endif;
					endforeach; ?>
					<?php endif; ?>
					<?php endforeach; ?>
				</div><!-- top_tags -->
				<?php endif; ?>
				

				<div class="wrap_avatar flex">
					<div class="textbox_avatar">
						<?php echo $user_avatar; ?>
					</div>
					<p class="title_avatar eng">
						<span class="black"><?php echo $user_name; ?></span>
						<span>@<?php echo $renews_id; ?></span>
					</p>
				</div>
				<div class="wrap_social color_black flex">
					<div class="socialbox likebox"><?php if(function_exists('wp_ulike_comments')) echo wp_ulike( 'put', array("id" => $post->ID) ); ?></div>
					<a class="socialbox commentbox" href="<?php the_permalink(); ?>?move=commentsAreaWrap"><?php echo $comments->total_comments; ?></a>
				</div>
			</div>
		</div><!-- /.content_mv -->
		
		<?php endif; ?>
		<?php endforeach; wp_reset_postdata(); ?>
		
		<!-- 2件目以降 -->
		<div class="inner_base">
			<div class="content_article">
				<div class="wrap_article_middle flex colum3">
		<?php foreach ( $posts_array as $post ) : setup_postdata( $post ); $loopcount_2++;
					
					// アイキャッチ
					$thumbnail_id = get_post_thumbnail_id($post->ID);
					$imageUrl = '';
					if($thumbnail_id){
						$image = wp_get_attachment_image_src($thumbnail_id,'full');
						$imageUrl = $image[0];
					}else{
						$imageUrl = get_template_directory_uri().'/images/icon/noimg.jpg';
					}

					//著者情報
					//		$user_name = get_the_author_meta( 'display_name', $post->post_author );
					//		$renews_id = get_the_author_meta( 'user_login', $post->post_author );
					$rows = get_field('author_select' ); // すべてのrow（内容・行）をいったん取得する
					$first_row = $rows[0]; // 1行目だけを$first_rowに格納
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
					
					//コメント
					$comments = wp_count_comments( $post->ID );
					
					$title = mb_strimwidth( get_the_title($tax_post->ID), 0, 47, "...", "UTF-8" );
					?>
			<?php if ($loopcount_2 > 1): //2件目 ?>
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

		<?php endif; ?>
		<?php endforeach; wp_reset_postdata(); ?>
				</div>
			</div>
		</div><!-- inner_base -->
		
		
			
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

				// 日付
				$date = get_the_time('Y.m.d');

				// カテゴリー
				$postTax = get_object_taxonomies($post);
				?>
		<?php endwhile;?>



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
</div><!-- ajenda_detail -->

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