<?php get_header(); ?>
<?php
$post_type = get_query_var('post_type');
?>
<?php
$pageItemNum = 15;

$paged = get_query_var('paged');
parse_str( $query_string, $args );
$addArgs = array(
	'paged' => $paged,
	'posts_per_page' => $pageItemNum,
	'order' => 'DESC',
	'orderby' => 'date'
);
$args = array_merge($args,$addArgs);
$wp_query = new WP_Query($args);


$archivePageName = single_term_title( '', false );

//現在のユーザー
$user = wp_get_current_user();
$uid = $user->ID;

//説明文取得
$termSlug = get_query_var('series');
$term = get_term_by('slug', $termSlug, 'series');
$termDescription = $term->description;

$taxonomy_id = $term->term_id;
//フォローチェック
$follow_taxonomy = get_user_meta($uid,'series_follow');
$follow_check = in_array($taxonomy_id, $follow_taxonomy);

$url = get_category_link($taxonomy_id);


//シリーズイメージ画像
$series_img_id = get_field('series_img','series_'.$term->term_id);
$series_url = '';
if($series_img_id){
	$image = wp_get_attachment_image_src($series_img_id,'full');
	$series_url = $image[0];
}else{
	$series_url = get_template_directory_uri().'/images/icon/noimg.jpg';
}
//SNSシェア
//元となるテキスト
$text = 'Renews | 『'.$term->name.'』';
//URLエンコード処理
$encoded = rawurlencode( $text ) ;
$encodedURL = json_encode(get_the_permalink());
$url = ''.home_url().'/series/'.$term->slug.'/';

if(empty($archivePageName)){ $archivePageName = '投稿'; }

?>
<?php if($wp_query->have_posts()): ?>

<div id="series_detail">
	<section class="sec sec_column_detail">
		<div class="column-highlighted">
			<div class="inner_column_thumb for_sp">
				<?php if($series_img_id): ?>
				<img class="series_thumb_trim" src="<?php echo $series_url; ?>" alt="<?php echo $archivePageName; ?> シリーズサムネイル" />
				<?php endif; ?>
			</div>

			<div class="seriesShareAreaWrap for_pc">
				<?php if($series_img_id): ?>
				<img class="series_thumb" src="<?php echo $series_url; ?>" alt="<?php echo $archivePageName; ?> シリーズサムネイル" />
				<?php endif; ?>
				<div class="seriesShareArea">
					<div class="btn_share head">
						<div class="share-btn circle-btn twitter">
							<a href="https://twitter.com/share?url=<?php echo $url; ?>&text=<?php echo $encoded; ?>" class="share_popup" target="_blank">
								<img src="<?php echo get_template_directory_uri(); ?>/images/icons/circle_twitter.png" alt="twitter" />
							</a>
						</div>
						<div class="share-btn circle-btn facebook">
							<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode($url); ?>" class="share_popup" target="_blank">
								<img src="<?php echo get_template_directory_uri(); ?>/images/icons/circle_fb.png" alt="facebook" />
							</a>
						</div>
						<div class="share-btn circle-btn line">
							<a href="https://line.naver.jp/R/msg/text/?<?php echo $encoded; ?> <?php echo rawurlencode($url); ?>" class="share_popup" target="_blank">
								<img src="<?php echo get_template_directory_uri(); ?>/images/icons/circle_line.png" alt="line" />
							</a>
						</div>
						<div class="share-btn circle-btn hatena">
							<a href="https://b.hatena.ne.jp/add?mode=confirm&url=<?php echo rawurlencode($url); ?>&title=<?php echo $encoded; ?>" class="share_popup" target="_blank" rel="nofollow">
								<img src="<?php echo get_template_directory_uri(); ?>/images/icons/circle_hatena.png" alt="hatena" />
							</a>
						</div>
					</div><!-- /.btn_share -->
				</div>
			</div><!-- seriesShareAreaWrap -->
			<div class="column-text-wrapper">

				<div>
					<div class="for_sp">
						<div class="btn_share head">
							<div class="share-btn circle-btn twitter">
								<a href="https://twitter.com/share?url=<?php echo $url; ?>&text=<?php echo $encoded; ?>" class="share_popup" target="_blank">
									<img src="<?php echo get_template_directory_uri(); ?>/images/icons/circle_twitter.png" alt="twitter" />
								</a>
							</div>
							<div class="share-btn circle-btn facebook">
								<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode($url); ?>" class="share_popup" target="_blank">
									<img src="<?php echo get_template_directory_uri(); ?>/images/icons/circle_fb.png" alt="facebook" />
								</a>
							</div>
							<div class="share-btn circle-btn line">
								<a href="https://line.naver.jp/R/msg/text/?<?php echo $encoded; ?> <?php echo rawurlencode($url); ?>" class="share_popup" target="_blank">
									<img src="<?php echo get_template_directory_uri(); ?>/images/icons/circle_line.png" alt="line" />
								</a>
							</div>
							<div class="share-btn circle-btn hatena">
								<a href="https://b.hatena.ne.jp/entry/<?php echo rawurlencode($url); ?>" data-hatena-bookmark-initialized="1" data-hatena-bookmark-title="<?php echo $encoded; ?>" data-hatena-bookmark-layout="simple" class="share_popup" target="_blank">
									<img src="<?php echo get_template_directory_uri(); ?>/images/icons/circle_hatena.png" alt="hatena" />
								</a>

							</div>
						</div><!-- /.btn_share -->
					</div>

					<?php if($termDescription):
					//	$termDescription = strip_tags($termDescription);
					?>
					<div class="folder">
						<?php echo $termDescription; ?>
					</div>
					<div class="see-more">
						<span>もっと見る</span>
					</div>
					<?php endif; ?>
					<div class="wrap_switch">
						<?php if( is_user_logged_in() ) : //ログインしてるユーザー ?>
						<span class="articleFollow switch-button openg <?php if($follow_check == 'true'){echo ' open';} ?>" data-taxonomy="series_follow" data-uid="<?php echo $uid; ?>" data-taxonomy_id="<?php echo $taxonomy_id; ?>">
							<i class="switch"></i>
						</span>
						<?php else: ?>
						<a href="#modalLoginWrap" class="popup-modal noLoginFollowBtn">
							<i class="switch"></i>
						</a>
						<?php endif; ?>
					</div>
				</div>
			</div>

		</div>

		<div class="content_mv">
			<div class="wrap_article_middle flex colum2">
				<!-- 1件目 -->
				<?php
				// 中2個と小コンポーネント用↓
				//$loopcount_1 = 0;
				//$loopcount_2 = 0;

				// 全部小コンポーネント用↓
				$loopcount_1 = 3;
				$loopcount_2 = 3;
				?>
				<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>
				<?php
				$loopcount_1++;

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


				//現在のユーザー
				$user = wp_get_current_user();
				$uid = $user->ID;

				//フォローチェック
				$post_follow_post = get_user_meta($uid,'article_follow');
				$post_follow_check = in_array($post->ID, $post_follow_post);

				//ストックしている人数
				$args = array(
					'meta_key'     => 'article_follow',
					'meta_value'   => $post->ID
				);
				$all_user_stockPost = get_users( $args );
				$stockNum = count($all_user_stockPost);


				//コメント
				$comments = wp_count_comments( $post->ID );
				$title =get_the_title($post->ID);
				//		$title = mb_strimwidth( get_the_title($post->ID), 0, 47, "...", "UTF-8" );


				//現在のユーザー
				$user = wp_get_current_user();
				$uid = $user->ID;

				//フォローチェック
				$follow_post = get_user_meta($uid,'article_follow');
				$follow_check = in_array($post->ID, $follow_post);

				//ストックしている人数
				$args = array(
					'meta_key'     => 'article_follow',
					'meta_value'   => $post->ID
				);
				$all_user_stockPost = get_users( $args );
				$stockNum = count($all_user_stockPost);

				// カテゴリー
				$postTax = get_object_taxonomies($post);


				$termsArg = array(
					'orderby' => 'menu_order',
					'order' => 'ASC'
				);
				$agenda_terms = wp_get_post_terms($post->ID,'agenda',$termsArg);
				$hashtag_terms = wp_get_post_terms($post->ID,'value_hashtag',$termsArg);
				$series_terms = wp_get_post_terms($post->ID,'series',$termsArg);
				?>
				<?php if ($loopcount_1 <= 2): //2件 ?>

				<!-- 5/21 一部変更 黒澤 -->

				<?php require 'small_comp.php'; ?>

				<!-- 5/21 一部変更 黒澤 ここまで -->

				<?php endif; ?>
				<?php endwhile; ?>
			</div><!-- /.wrap_article_middle -->
		</div><!-- /.content_mv -->


		<!-- 3件目以降 -->
		<div class="content_article">
			<div class="inner_base">
				<div class="wrap_article_middle grid articleListStyle">
					<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>
					<?php
					$loopcount_2++;

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

					$title =get_the_title($post->ID);
					//					$title = mb_strimwidth( get_the_title($tax_post->ID), 0, 47, "...", "UTF-8" );

					// カテゴリー
					$postTax = get_object_taxonomies($post);
					$series_terms = get_the_terms($post->ID,'series');
					?>
					<?php if ($loopcount_2 > 2): //3件目 ?>

					<!-- 5/21 一部変更 黒澤 -->

					<?php require 'small_comp.php'; ?>

					<!-- 5/21 一部変更 黒澤 ここまで -->

					<?php endif; ?>
					<?php endwhile; ?>
				</div>
			</div><!-- inner_base -->
		</div>




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
<?php endif; wp_reset_postdata();/* end have_posts */ ?>
<?php get_footer(); ?>
