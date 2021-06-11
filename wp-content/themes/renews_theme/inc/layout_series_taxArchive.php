<div class="content_column column2 wrap flex between">
	<?php
	global $wpdb;
	global $pagerGetName, $taxonomy_name, $post_type, $nowPaged, $pageNum_tax, $pageNum_article;

	$nowTaxPostNum = ($pageNum_tax * ($nowPaged - 1));
	$getTaxPostNum = $pageNum_tax;

	$taxSql = "SELECT *
    FROM ".$wpdb->prefix."term_taxonomy AS tt
    LEFT JOIN ".$wpdb->prefix."terms AS t
    ON t.term_id = tt.term_id
    WHERE tt.taxonomy = '".$taxonomy_name."' AND tt.count > 0
    ORDER BY t.term_order ASC
    LIMIT ".$nowTaxPostNum.", ".$getTaxPostNum."";

	$taxSqlResult = $wpdb->get_results($wpdb->prepare($taxSql));
//	preDump($taxSqlResult);

	if(!empty($taxSqlResult)):
	foreach($taxSqlResult as $r):
	$taxonomy = get_term($r->term_id,$taxonomy_name);
	if(!empty($taxonomy)):
	$url = get_term_link($taxonomy->slug, $taxonomy_name);
	$count_all = get_term_by( 'slug', $taxonomy->slug, $taxonomy_name);
	$count_num = $count_all->count;

	$queryArgs = array(
		'tax_query' => array(
			array(
				'taxonomy' => $taxonomy_name,
				'terms' => array( $taxonomy->slug ),
				'field' => 'slug'
			)
		),
		'post_type' => $post_type,
		'posts_per_page' => $pageNum_article,
		'post_status' => 'publish',
		'order' => 'DESC',
		'orderby' => 'date'
	);
	$the_query = new WP_Query($queryArgs);
	if($the_query->have_posts()):
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
			$text = 'Renews | 『'.$taxonomy->name.'』';
			//URLエンコード処理
			$encoded = rawurlencode( $text ) ;
			?>

			<div class="inner_column_thumb">
				<a href="<?php echo $url; ?>">
					<img src="<?php echo $series_url; ?>" alt="<?php echo esc_html($taxonomy->name); ?>イメージ" class="series_thumb_trim" />
				</a>
			</div>


			<div class="list_column">
				<div class="item_column_wrap">
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<?php
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

					$title = get_the_title($tax_post->ID);
					$comments = wp_count_comments( $tax_post->ID );

					//現在のユーザー
					$user = wp_get_current_user();
					$uid = $user->ID;

					//フォローチェック
					$follow_post = get_user_meta($uid,'article_follow');
					$follow_check = in_array($tax_post->ID, $follow_post);

					//ストックしている人数
					$args = array(
						'meta_key'     => 'article_follow',
						'meta_value'   => $tax_post->ID
					);
					$all_user_stockPost = get_users( $args );
					$stockNum = count($all_user_stockPost);
					?>
					<div class="item_column">
						<div class="wrap_thumbs_columm imgLiquidFill">
							<a href="<?php echo get_permalink($tax_post->ID); ?>">
								<img src="<?php echo $imageUrl; ?>" alt="アジェンダサムネイル" width="100" />
							</a>
						</div>
						<div class="wrap_text_column">
							<a href="<?php echo get_permalink($tax_post->ID); ?>" class="target_column flex">
								<p class="text_column lineClampWrap lineClamp_2">
									<span><?php echo $title; ?></span>
								</p>
							</a>
							<!--
							<div class="target_column flex">
								<a href="<?php echo home_url(); ?>/user/<?php echo $renews_id; ?>/">
									<p class="title_avatar eng">
										<span class="black"><?php echo $user_name; ?></span>
										<span>@<?php echo $renews_id; ?></span>
									</p>
								</a>
							</div>
							-->
						</div>
					</div>
					<?php endwhile; ?>

					<div class="see_more">
						<a href="<?php echo $url; ?>">
							「<?php echo esc_html($taxonomy->name); ?>」の記事一覧へ
							<!-- 矢印SVG -->
							<svg version="1.1" id="arrow" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
				 y="0px" viewBox="0 0 38 4" style="enable-background:new 0 0 38 4;" xml:space="preserve">
								<polygon class="st0" points="38,4 0,4 0,3.6 36.3,3.6 30.9,0.4 31.2,0 "/>
							</svg>
						</a>
						<!--（現在<span class="series_count"><?php echo $count_num ?></span>本）-->
					</div><!-- see_more -->

				</div><!-- item_column_wrap -->
			</div>
		</div>
	</div><!-- /.column -->
	<?php endif; wp_reset_postdata(); ?>

	<?php endif; endforeach; endif; ?>
</div>
