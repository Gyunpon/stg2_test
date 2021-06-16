<?php get_header(); ?>
<?php
$post_type = get_query_var('post_type');
?>
<?php
global $archivePageNum;
$pageItemNum = $archivePageNum;

$paged = get_query_var('paged');
query_posts($query_string . '&posts_per_page='.$pageItemNum.'&paged=' . $paged);

$archivePageName = single_term_title( '', false );

if(empty($archivePageName)){ $archivePageName = '投稿'; }

?>
<div id="agenda_detail">

	<div class="inner_base">
	<section class="sec sec_hashtag_detail">
			<div class="head_content">
				<p class="text_intro_head_content color_green">
					「#<?php echo $archivePageName; ?>」というタグが付いた記事を集めました。
				</p>
			</div>
	</section>
	

	<?php if(have_posts()): ?>
		<section class="sec_column_detail">
		<div class="content_article">
		<div class="wrap_article_middle flex colum3">
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
			
			//著者
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

			// タイトル
			$title = mb_strimwidth( $post->post_title, 0, 66, "...", "UTF-8" );
			$series_terms = get_the_terms($post->ID, 'series');
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
			</div><!-- /.article_middle -->

			<?php endwhile; ?>
		</div><!-- /.content_article -->
		</div>
		</section>
	
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
	

	<?php else: /* else have_posts */ ?>
	<div id="notFound" class="articleNotFound">
		<div class="inner_base">
		<h1>お探しの<?php echo $archivePageName; ?>に関する記事は見つかりませんでした。</h1>
		<p>
			申し訳ございません。<br />
			<?php echo $archivePageName; ?>に関する記事は見つかりませんでした。
		</p>
		</div>
	</div><!--notfound-->
	<?php endif;/* end have_posts */ ?>
	
	</div>
</div>

<?php get_footer(); ?>