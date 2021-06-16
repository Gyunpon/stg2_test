<?php
/**
 * Template Name: シリーズ一覧
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
?>
	<?php if(have_posts()): while (have_posts()): the_post(); ?>


<section class="sec sec_column">
	<div class="inner_base">
		<h2 class="title_thin">
			<span class="title_thin_img white">
				<h2>シリーズ</h2>
			</span>
		</h2>
		<p class="title_thin_subtitle">「シリーズ（連載コラム）」をまとめました。長期のシリーズと、短期集中で取り組む「特集」があります。</p>

		<div class="content_column column2 flex between">
			<?php
			$taxonomy_name = 'series'; // タクソノミーのスラッグ名を入れる
			$post_type = 'articles'; // カスタム投稿のスラッグ名を入れる
			$args = array(
				'order' => 'DESC',
				'orderby' => 'menu_order',
				'hierarchical' => false,
				'posts_per_page' => -1,
			);
			$taxonomys = get_terms( $taxonomy_name, $args);
			//$taxonomys = get_field('top_series_option','option');

			if(!is_wp_error($taxonomys) && count($taxonomys)):
			foreach($taxonomys as $taxonomy):
			$url = get_term_link($taxonomy->slug, $taxonomy_name);
			$count_all = get_term_by( 'slug', $taxonomy->slug, $taxonomy_name);
			$count_num = $count_all->count;
			$tax_posts = get_posts( array(
				'post_type' => $post_type,
				'posts_per_page' => 2, // 表示させたい記事数
				'tax_query' => array(
					array(
						'taxonomy' => $taxonomy_name,
						'terms' => array( $taxonomy->slug ),
						'field' => 'slug',
						'include_children' => true,
						'operator' => 'IN'
					)
				)
			));
			if( $tax_posts ) {
			?>
			<div class="column">
				<div class="inner_column">
					<?php
				//アジェンダイメージ画像
				$series_img_id = get_field('series_img','series_'.$taxonomy->term_id);
				$series_url = '';
				if($series_img_id){
					$image = wp_get_attachment_image_src($series_img_id,'full');
					$series_url = $image[0];
				}else{
					$series_url = get_template_directory_uri().'/images/icon/noimg.jpg';
				}
				

				//SNSシェア
				//元となるテキスト
				$text = 'RENEWS | 『'.$taxonomy->name.'』';
				//URLエンコード処理
				$encoded = rawurlencode( $text ) ;
					?>
					<a href="<?php echo $url; ?>">
					<img src="<?php echo $series_url; ?>" alt="<?php echo esc_html($taxonomy->name); ?>イメージ" class="series_thumb" />
					</a>
					<div class="list_column">
						<h2 class="title_column">
							<?php echo esc_html($taxonomy->name); ?>
						</h2>
						<div class="btn_share">
							<div class="share-btn twitter">
								<a href="https://twitter.com/share?url=<?php echo $url; ?>&text=<?php echo $encoded; ?>" class="share_popup" target="_blank">
									<img src="<?php echo get_template_directory_uri(); ?>/images/icons/twitter.svg" alt="twitter" />
								</a>
							</div>
							<div class="share-btn facebook">
								<a href="https://www.facebook.com/sharer/sharer.php?u=<?php rawurlencode($url); ?>" class="share_popup" target="_blank">
									<img src="<?php echo get_template_directory_uri(); ?>/images/icons/fb.svg" alt="facebook" />
								</a>
							</div>
							<div class="share-btn line">
								<a href="https://social-plugins.line.me/lineit/share?url=<?php rawurlencode($url); ?>" class="share_popup" target="_blank">
									<img src="<?php echo get_template_directory_uri(); ?>/images/icons/line.svg" alt="line" />
								</a>
							</div>
							<div class="share-btn hatena">
								<a href="http://b.hatena.ne.jp/add?mode=confirm&url=<?php rawurlencode($url); ?>&title=<?php echo $encoded; ?>" class="share_popup" target="_blank" rel="nofollow">
									<img src="<?php echo get_template_directory_uri(); ?>/images/icons/hatena.svg" alt="hatena" />
								</a>
							</div>
						</div><!-- /.btn_share -->
						
						<div class="item_column_wrap">
						<?php foreach($tax_posts as $tax_post):
				
				//著者情報
				$rows = get_field('author_select',$tax_post->ID );
				$first_row = $rows[0];
				$first_row_item = $first_row['author'];
				if(!($first_row_item)){
					$user_name = get_the_author_meta( 'display_name', $tax_post->post_author );
					$renews_id = get_the_author_meta( 'user_login', $tax_post->post_author );
					$user_avatar = get_avatar( get_the_author_meta( 'ID' ), 64 );
				}else{
					$user_name = $first_row_item['display_name'];
					$renews_id = $first_row_item['user_nicename'];
					$user_avatar = $first_row_item['user_avatar'];
				}
				
				// アイキャッチ
				$thumbnail_id = get_post_thumbnail_id($tax_post->ID);
				$imageUrl = '';
				if($thumbnail_id){
					$image = wp_get_attachment_image_src($thumbnail_id,'full');
					$imageUrl = $image[0];
				}else{
					$imageUrl = get_template_directory_uri().'/images/icon/noimg.jpg';
				}

				$title = mb_strimwidth( get_the_title($tax_post->ID), 0, 47, "...", "UTF-8" );
				$comments = wp_count_comments( $tax_post->ID );
						?>

						<div class="item_column">
							<div class="wrap_text_column">
								<a href="<?php echo get_permalink($tax_post->ID); ?>" class="target_column flex">
									<p class="text_column color_blue">
										<?php echo $title; ?>
									</p>
								</a>
								<div class="target_column flex">
									<p class="title_avatar eng">
										<span class="black"><?php echo $user_name; ?></span>
										<span>@<?php echo $renews_id; ?></span>
									</p>
									<div class="wrap_social color_rightgreen flex">
										<div class="socialbox likebox"><?php if(function_exists('wp_ulike_comments')) echo wp_ulike( 'put', array("id" => $tax_post->ID) ); ?></div>
										<a class="socialbox commentbox" href="<?php echo get_permalink($tax_post->ID); ?>?move=commentsAreaWrap"><?php echo $comments->total_comments; ?></a>
									</div>
								</div>
							</div>
						</div>
						<?php endforeach; wp_reset_postdata(); ?>

						<div class="see_more">
							<a href="<?php echo $url; ?>">
								すべてを見る（全<?php echo $count_num ?>本）→
							</a>
						</div>

						</div><!-- item_column_wrap -->
					</div>
				</div>
			</div><!-- /.column -->
			<?php
			}
			endforeach;
			endif;
			?>



		</div>
		<!-- /.content_column -->

	</div>
</section>


	<?php endwhile; endif; ?>


<?php get_footer(); ?>