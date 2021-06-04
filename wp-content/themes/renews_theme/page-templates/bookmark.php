<?php
/**
 * Template Name: ストック記事
 */
?>
<?php get_header(); ?>

<?php
// 固定ページ情報
$page = get_post(get_the_ID());
$pageTitle = $page->post_title;
$pageSlug = $page->post_name;
$pageParent = $page->post_parent;

// 最上位親ページスラッグ取得
if($pageParent != 0){
	$current_id = $page->ID;
	$par_id = get_post($current_id)->post_parent;
	$most_par_id = $current_id;
	while($par_id != 0){
		$par_post = get_post($par_id);
		$most_par_id = $par_post->ID;
		$par_id = $par_post->post_parent;
	}

	$mostParentsPage = get_post($most_par_id);
	$mostParentsPageSlug = $mostParentsPage->post_name;

	$pageSlug .= ' '.$mostParentsPageSlug.'_child';
}


$login_user = wp_get_current_user();
$login_user = $login_user->ID;

?>
<?php if(have_posts()): while (have_posts()): the_post(); ?>


<section id="bookmark" class="sec sec_renewer_detail bookmarkPage">
	<?php get_template_part('inc/mypageHead'); ?>

	<div class="mypageContent">
		<div id="bookmark_top_intro" class="inner_base">

			<div class="mypageTitleBlock">
				<div class="pageIcon"><img src="<?php echo get_template_directory_uri(); ?>/images/my/bookmark.png" alt="" /></div>
				<div class="mypageTitleArea">
					<h2 class="mypageTitle"><?php the_title(); ?></h2>
					<div class="pageCatch">
						<p>あなたがクリップした記事の一覧です</p>
					</div>
				</div>
			</div><!-- mypageTitleBlock -->
		</div>

		<?php
		// アーカイブ設定
		// --------------------------------------------
		// ページャーGET値
		$pagerGetName = 'pg';
		// ポストタイプ
		$post_type = 'articles';
		// 現在ページ
		$nowPaged = (!empty($_GET[$pagerGetName]))? $_GET[$pagerGetName] : 1;
		// 1ページの表示件数
		$pageNum = 60;
		?>

		<input type="hidden" id="postType" name="postType" value="<?php echo $post_type; ?>" />
		<input type="hidden" id="paged" name="paged" value="<?php echo $nowPaged; ?>" />
		<input type="hidden" id="pagedGetName" name="pagedGetName" value="<?php echo $pagerGetName; ?>" />
		<input type="hidden" id="postPerPage" name="postPerPage" value="<?php echo $pageNum; ?>" />


		<?php
		$article_list = get_user_meta( $login_user, 'article_follow');
		if($article_list):
		?>

		<?php
		$wp_query = new WP_Query();

		$args = array(
			'post_type' => $post_type,
			'posts_per_page' => $pageNum,
			'paged' => $nowPaged,
			'post_status' => 'publish',
			'orderby' => 'date',
			'order' => 'DESC',
			'post__in' => $article_list
		);

		$wp_query->query($args);
		if($wp_query->have_posts()):
		?>
		<div id="bookmark_top_contentArticle" class="inner_base">
			<div class="content_article">

				<div class="wrap_article_middle grid">
					<?php while($wp_query->have_posts()) : $wp_query->the_post(); ?>

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
					//					$series_terms = get_the_terms($val->ID,'series');

					$agenda_terms = get_the_terms($val->ID,'agenda');
					$hashtag_terms = get_the_terms($val->ID,'value_hashtag');
					$series_terms = get_the_terms($val->ID,'series');

					?>
					<div class="article_middle" data-post_id="<?php echo $postId; ?>">
						<div class="wrap_img">
							<div class="article_middle_img imgLiquidFill">
								<a href="<?php echo get_permalink( $val ); ?>">
									<img src="<?php echo $imageUrl; ?>" alt="" />
								</a>
							</div>
							<!-- アイコン移動 -->
		          <?php
		          //現在のユーザー
		          $user = wp_get_current_user();
		          $uid = $user->ID;
		          ?>
		          <div class="wrap_social color_black flex">
		            <div class="socialbox likebox"><?php if(function_exists('wp_ulike_comments')) echo wp_ulike( 'put', array("id" => $postId) ); ?></div>
		          </div>
		          <!-- アイコン移動 ここまで -->
						</div>


						<div class="textbox middle left_bottom small_compo">
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


							<a href="<?php echo get_permalink( $val ); ?>" class="mypage_title_link">
								<h2 class="title_middle"><?php echo $title; ?></h2>
							</a>

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
										<!--
										<div class="textbox_avatar">
											<?php echo $user_avatar; ?>
										</div>
										-->
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
								<?php if( is_user_logged_in() ): ?>
								<a href="javascript:void(0);" class="socialbox clipbox flexSocialbox postStockBtn<?php if($follow_check == 'true'){echo ' stock';} ?>" data-uid="<?php echo $uid; ?>" data-post_id="<?php echo $postId; ?>">
									<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 42 41.3" style="enable-background:new 0 0 42 41.3;" xml:space="preserve">
										<path id="icon_clip" data-name="icon_clip" fill="#B0AD9E" d="M19,31.8c-1.7,0-3.4-0.7-4.7-2c-2.6-2.6-2.6-6.8,0-9.4l8.1-8.1c0.1-0.1,0.2-0.2,0.3-0.3 c0.9-0.9,2.2-1.3,3.4-1.2c1.3,0.1,2.5,0.6,3.3,1.6c0.9,0.9,1.3,2.2,1.2,3.4s-0.6,2.5-1.6,3.3L21.3,27c-1.2,1.1-2.9,1.1-4.1,0 c-0.6-0.5-0.9-1.3-0.9-2.1s0.3-1.5,0.8-2.1l7-6.9l1,1l-7,6.9c-0.3,0.3-0.4,0.6-0.4,1c0,0.4,0.2,0.8,0.4,1c0.6,0.6,1.5,0.6,2.1,0 l7.9-7.8c0.7-0.6,1.1-1.4,1.1-2.3c0-0.9-0.3-1.7-0.9-2.4c-0.6-0.7-1.4-1-2.3-1.1c-0.9,0-1.7,0.3-2.4,0.9c-0.1,0.1-0.1,0.1-0.2,0.2 l-8.2,8.1c-1,1-1.5,2.3-1.5,3.7c0,1.4,0.5,2.7,1.5,3.7s2.3,1.5,3.7,1.5c1.4,0,2.7-0.5,3.7-1.5l7.3-7.2l1,1l-7.3,7.2 C22.4,31.2,20.7,31.8,19,31.8z"/>
									</svg>
									<span class="stock_on stockTxt">記事をクリップ</span>
									<span class="stock_off stockTxt">クリップを解除</span>
								</a>
								<?php else: ?>
								<span class="for_pc align-center">
									<span class="socialbox clipbox flexSocialbox">
										<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 42 41.3" style="enable-background:new 0 0 42 41.3;" xml:space="preserve">
											<path id="icon_clip" data-name="icon_clip" fill="#B0AD9E" d="M19,31.8c-1.7,0-3.4-0.7-4.7-2c-2.6-2.6-2.6-6.8,0-9.4l8.1-8.1c0.1-0.1,0.2-0.2,0.3-0.3 c0.9-0.9,2.2-1.3,3.4-1.2c1.3,0.1,2.5,0.6,3.3,1.6c0.9,0.9,1.3,2.2,1.2,3.4s-0.6,2.5-1.6,3.3L21.3,27c-1.2,1.1-2.9,1.1-4.1,0 c-0.6-0.5-0.9-1.3-0.9-2.1s0.3-1.5,0.8-2.1l7-6.9l1,1l-7,6.9c-0.3,0.3-0.4,0.6-0.4,1c0,0.4,0.2,0.8,0.4,1c0.6,0.6,1.5,0.6,2.1,0 l7.9-7.8c0.7-0.6,1.1-1.4,1.1-2.3c0-0.9-0.3-1.7-0.9-2.4c-0.6-0.7-1.4-1-2.3-1.1c-0.9,0-1.7,0.3-2.4,0.9c-0.1,0.1-0.1,0.1-0.2,0.2 l-8.2,8.1c-1,1-1.5,2.3-1.5,3.7c0,1.4,0.5,2.7,1.5,3.7s2.3,1.5,3.7,1.5c1.4,0,2.7-0.5,3.7-1.5l7.3-7.2l1,1l-7.3,7.2 C22.4,31.2,20.7,31.8,19,31.8z"/>
										</svg>
										<span class="baloon top for_pc"><a class="popup-modal" href="#modalLoginWrap">ログイン</a>が必要です</span>
										<span class="stock_on stockTxt">記事をクリップ</span>
									</span>
								</span>
								<span class="for_sp align-center">
									<a href="#modalLoginWrap" class="socialbox clipbox flexSocialbox popup-modal">
										<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 42 41.3" style="enable-background:new 0 0 42 41.3;" xml:space="preserve">
											<path id="icon_clip" data-name="icon_clip" fill="#B0AD9E" d="M19,31.8c-1.7,0-3.4-0.7-4.7-2c-2.6-2.6-2.6-6.8,0-9.4l8.1-8.1c0.1-0.1,0.2-0.2,0.3-0.3 c0.9-0.9,2.2-1.3,3.4-1.2c1.3,0.1,2.5,0.6,3.3,1.6c0.9,0.9,1.3,2.2,1.2,3.4s-0.6,2.5-1.6,3.3L21.3,27c-1.2,1.1-2.9,1.1-4.1,0 c-0.6-0.5-0.9-1.3-0.9-2.1s0.3-1.5,0.8-2.1l7-6.9l1,1l-7,6.9c-0.3,0.3-0.4,0.6-0.4,1c0,0.4,0.2,0.8,0.4,1c0.6,0.6,1.5,0.6,2.1,0 l7.9-7.8c0.7-0.6,1.1-1.4,1.1-2.3c0-0.9-0.3-1.7-0.9-2.4c-0.6-0.7-1.4-1-2.3-1.1c-0.9,0-1.7,0.3-2.4,0.9c-0.1,0.1-0.1,0.1-0.2,0.2 l-8.2,8.1c-1,1-1.5,2.3-1.5,3.7c0,1.4,0.5,2.7,1.5,3.7s2.3,1.5,3.7,1.5c1.4,0,2.7-0.5,3.7-1.5l7.3-7.2l1,1l-7.3,7.2 C22.4,31.2,20.7,31.8,19,31.8z"/>
										</svg>
										<span class="stock_on stockTxt">記事をクリップ</span>
									</a>
								</span>
								<?php endif; ?>
							</div>


						</div>
					</div>


					<?php endwhile; ?>
				</div><!-- /.wrap_article_middle -->



			</div><!-- /.content_article -->
		</div>

		<?php
		$max_page = ceil($wp_query->found_posts / $pageNum);

		if($max_page != 1):
		$paginate_base = preg_replace('/(\?|&)pg=[0-9]{1,4}/i','',get_pagenum_link(1));
		?>
		<div id="bookmark_top_pager">
			<div class="pagerArea inner_base">
				<?php
				echo paginate_links( array(
					'base' => $paginate_base.'%_%',
					'format' => '?pg=%#%',
					'total' => $max_page,
					'end_size' => 1,
					'mid_size' => 1,
					'current' => ($nowPaged ? $nowPaged : 1),
				));
				?>
			</div><!--pagerArea-->
		</div>
		<?php endif; ?>
		<?php endif;wp_reset_query(); ?>







		<?php else: ?>
		<div id="bookmark_top_noFollow" class="inner_base">
			<div class="noFollow">
				<p>クリップしている記事はありません。</p>
			</div>
		</div>
		<?php endif; ?>




	</div><!-- mypageContent -->

</section>




<?php endwhile; endif; ?>

<?php get_footer(); ?>
