<?php
/**
 * Template Name: アジェンダ一覧
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
	


<section class="sec sec_agenda">
	<div class="inner_base">
		<h2 class="title_thin">
			<span class="title_thin_img white">
				<h2>アジェンダ</h2>
			</span>
		</h2>

		<p class="title_thin_subtitle">重点的に取り組む領域を「アジェンダ」としてまとめました。</p>

		<ul class="wrap_agenda flex wrap">
			<?php
			$taxonomy_name = 'agenda'; // タクソノミーのスラッグ名を入れる
			$post_type = 'articles'; // カスタム投稿のスラッグ名を入れる
			$args = array(
				'order' => 'DESC',
				'orderby' => 'menu_order',
				'hierarchical' => false,
				'posts_per_page' => -1,
			);
				$taxonomys = get_terms( $taxonomy_name, $args);
//			$taxonomys = get_field('top_agenda_option','option');

			if(!is_wp_error($taxonomys) && count($taxonomys)):
			foreach($taxonomys as $taxonomy):
			$url = get_term_link($taxonomy->slug, $taxonomy_name);
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
							#<?php echo esc_html($taxonomy->name); ?>
						</h2>
					</a>
				</div>

				<ul class="list_agenda">
					<?php foreach($tax_posts as $tax_post):

				//				var_dump($tax_post);

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

				$title = mb_strimwidth( get_the_title($tax_post->ID), 0, 56, "...", "UTF-8" );
					?>
					<li class="item_agenda">
						<a href="<?php echo get_permalink($tax_post->ID); ?>" class="target_agenda flex">
							<div class="wrap_thumbs_agenda imgLiquidFill">
								<img src="<?php echo $imageUrl; ?>" alt="アジェンダサムネイル" width="100" />
							</div>
							<div class="wrap_text_agenda">
								<p class="text_agenda color_black">
									<?php echo $title; ?>
								</p>
								<p class="title_avatar eng">
									<span class="black"><?php echo $user_name; ?></span>
									<span>@<?php echo $renews_id; ?></span>
								</p>
							</div>
						</a>
					</li>
					<?php endforeach; wp_reset_postdata(); ?>
					<li class="see_more">
						<a href="<?php echo $url; ?>">
							すべてを見る➝
						</a>
					</li>
				</ul>
			</li>
			

			<?php
			}
			endforeach;
			endif;
			?>
		</ul>
		
		
		
		
	</div>
</section>
	
	
	<?php endwhile; endif; ?>

<?php get_footer(); ?>