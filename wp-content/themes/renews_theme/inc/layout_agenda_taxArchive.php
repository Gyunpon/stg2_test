<ul class="wrap_agenda flex wrap">
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
	<li class="agenda">
		<div class="wrap_title_agenda bg_rightgreen">
			<a href="<?php echo $url; ?>">
				<?php
				//アジェンダイメージ画像
				$agenda_img_id = get_field('agenda_img','agenda_'.$taxonomy->term_id);
				$agenda_url = '';
				if($agenda_img_id){
					$image = wp_get_attachment_image_src($agenda_img_id,'full');
					$agenda_url = $image[0];
				}else{
					$agenda_url = get_template_directory_uri().'/images/icon/noimg.jpg';
				}
				?>
				<img src="<?php echo $agenda_url; ?>" alt="<?php echo esc_html($taxonomy->name); ?>イメージ" class="img_agenda" width="160" />
				<h2 class="title_agenda color_green">
					<?php echo esc_html($taxonomy->name); ?>
				</h2>
			</a>
		</div>

		<ul class="list_agenda">
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
				$image = wp_get_attachment_image_src($thumbnail_id,'medium');
				$imageUrl = $image[0];
			}else{
				$imageUrl = get_template_directory_uri().'/images/icon/noimg.jpg';
			}

			$title = get_the_title($tax_post->ID);

			?>
			<li class="item_agenda">
				<div class="target_agenda flex">
					<div class="wrap_thumbs_agenda imgLiquidFill">
						<a href="<?php echo get_permalink($tax_post->ID); ?>">
							<img src="<?php echo $imageUrl; ?>" alt="アジェンダサムネイル" width="100" />
						</a>
					</div>
					<div class="wrap_text_agenda">
						<a href="<?php echo get_permalink($tax_post->ID); ?>">
							<p class="text_agenda lineClampWrap lineClamp_2">
								<span><?php echo $title; ?></span>
							</p>
						</a>
						<a href="<?php echo home_url(); ?>/user/<?php echo $renews_id; ?>/">
							<p class="title_avatar eng">
								<span class="black"><?php echo $user_name; ?></span>
								<span>@<?php echo $renews_id; ?></span>
							</p>
						</a>
					</div>
				</div>
			</li>
			<?php endwhile; ?>
			<li class="see_more">
				<a href="<?php echo $url; ?>">
					「<?php echo esc_html($taxonomy->name); ?>」の記事一覧へ
				</a>
			</li>
		</ul>
	</li>
	<?php endif; wp_reset_postdata(); ?>

	<?php endif; endforeach; endif; ?>
</ul>
