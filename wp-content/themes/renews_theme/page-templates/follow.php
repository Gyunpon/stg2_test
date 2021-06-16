<?php
/**
 * Template Name: フォロー管理
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


<section class="sec sec_renewer_detail followViewArea">
	<?php get_template_part('inc/mypageHead'); ?>

	<div class="mypageContent">
	<div class="inner_base">

		<div class="mypageTitleBlock">
			<div class="pageIcon"><img src="<?php echo get_template_directory_uri(); ?>/images/my/follow.jpg" alt="フォロー" /></div>
			<div class="mypageTitleArea">
				<h2 class="mypageTitle"><?php the_title(); ?></h2>
				<div class="pageCatch">
					<p>あなたがフォロー中のコンテンツ</p>
				</div>
			</div>
		</div><!-- mypageTitleBlock -->

		<div class="followNavWrap">
			<ul class="followNav">
				<li><a href="#renewer" class="hoverOpacity">リニュアー</a></li>
				<li><a href="#agenda" class="hoverOpacity">アジェンダ</a></li>
				<li><a href="#series" class="hoverOpacity">シリーズ</a></li>
			</ul><!-- followNav -->
		</div><!-- followNavWrap -->

		<div class="followBlockWrap">
		<div id="renewer" class="followBlock">
			<div class="sec_title">
				<h1 class="main_title">Renewer
				<span class="main_title_jp">リニュアー</span>
				</h1>
			</div>

				<?php
				$rows = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."um_followers WHERE user_id2 = ".$login_user."");
				$all_users = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."users");

				if(!empty($rows)):
				?>
				<ul class="followList grid">
				<?php

				foreach ($all_users as $all_user){
					$allUserId = $all_user->ID;
					$allUserIdArray[] = $allUserId;
				}

//				var_dump($follow_renewer);
				foreach ($rows as $row):
				$nowFollowUserId = $row->user_id1;
				$nowFollowUserInfo = get_userdata($nowFollowUserId);
				$renewerId = $nowFollowUserInfo->user_login;
				$nowFollowName = $nowFollowUserInfo->display_name;
				$user_avatar = get_avatar( $nowFollowUserId, 64 );

				//フォローチェック
				$follow_check = in_array($nowFollowUserId, $allUserIdArray);
				?>
				<li data-user_id1="<?php echo $nowFollowUserId; ?>">
					<div class="followListBlock">
						<div class="followTitleArea">
							<a href="<?php echo home_url(); ?>/user/<?php echo $renewerId; ?>/">
								<div class="userInfo">
									<div class="um-followers-user-photo">
										<?php echo $user_avatar; ?>
									</div>
									<div class="um-followers-user-name">
										<?php echo $nowFollowName; ?>
										<span class="renewerID">@<?php echo $renewerId; ?></span>
									</div>
								</div>
							</a>
						</div>
						<div class="followBtnArea">
							<span class="articleFollow followRemoveBtn switch-button openg <?php if($follow_check == 'true'){echo 'open';} ?>" data-user_id2="<?php echo $login_user; ?>" data-user_id1="<?php echo $nowFollowUserId; ?>">
								<i class="switch"></i>
							</span>
						</div>
					</div>
				</li>
				<?php
				endforeach;
				?>
				</ul><!-- following -->
				<?php
				else:
				?>
				<div class="noFollow">
					<p>フォローしているリニュアーはいません。</p>
				</div>
				<?php
				endif;
				?>


			</div><!-- followBlock -->



			<div id="agenda" class="followBlock sec_agenda">
				<div class="sec_title">
					<h1 class="main_title">Agenda
					<span class="main_title_jp">アジェンダ</span>
					</h1>
				</div>

				<?php
				//アジェンダフォロー
				$agenda_list = get_user_meta( $login_user, 'agenda_follow');
				if($agenda_list):
				?>

				<ul class="followList grid">
					<?php
					$taxonomy_name = 'agenda'; // タクソノミーのスラッグ名を入れる
					$post_type = 'articles'; // カスタム投稿のスラッグ名を入れる
					$args = array(
						'order' => 'DESC',
						'orderby' => 'menu_order',
						'hierarchical' => false,
						'include' => $agenda_list,
						'posts_per_page' => -1,
					);
					$taxonomys = get_terms( $taxonomy_name, $args);
					//			$taxonomys = get_field('top_agenda_option','option');

					if(!is_wp_error($taxonomys) && count($taxonomys)):
					foreach($taxonomys as $taxonomy):
					//カテゴリーID
					$taxonomy_id = $taxonomy->term_id;

					//フォローチェック
					$follow_taxonomy = get_user_meta($login_user,'agenda_follow');
					$follow_check = in_array($taxonomy_id, $follow_taxonomy);

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
					<li data-taxonomy_id="<?php echo $taxonomy->term_id; ?>">
						<?php
						//アジェンダイメージ画像
						$agenda_img_id = get_field('agenda_follow_img','agenda_'.$taxonomy->term_id);
						$agenda_url = '';
						if($agenda_img_id){
							$image = wp_get_attachment_image_src($agenda_img_id,'full');
							$agenda_url = $image[0];
						}else{
							$agenda_url = get_template_directory_uri().'/images/icon/noimg.jpg';
						}
						?>
						<div class="followListBlock">
							<div class="followTitleArea">
								<a href="<?php echo $url; ?>">
									<dl>
										<dt class="icon">
											<img src="<?php echo $agenda_url; ?>" alt="<?php echo esc_html($taxonomy->name); ?>イメージ"  />
										</dt>
										<dd class="title_agenda">
											<p><?php echo esc_html($taxonomy->name); ?></p>
										</dd>
									</dl>
								</a>
							</div>
							<div class="followBtnArea">
								<span class="articleFollow switch-button openg <?php if($follow_check == 'true'){echo ' open';} ?>" data-taxonomy="agenda_follow" data-uid="<?php echo $login_user; ?>" data-taxonomy_id="<?php echo $taxonomy_id; ?>">
									<i class="switch"></i>
								</span>
							</div>
						</div>
					</li>

					<?php
					}
					endforeach;
					endif;
					?>
				</ul>
				<?php else: ?>
				<div class="noFollow">
					<p>フォローしているアジェンダはありません。</p>
				</div>
				<?php endif; //フォロー有無 ?>
			</div><!-- followBlock -->


			<div id="series" class="followBlock sec_column">
				<div class="sec_title">
					<h1 class="main_title">Series
					<span class="main_title_jp">シリーズ</span>
					</h1>
				</div>

			<?php
				//シリーズフォロー
				$series_list = get_user_meta( $login_user, 'series_follow');
				if($series_list):
				?>
				<ul class="followList grid">
					<?php
					$taxonomy_name = 'series'; // タクソノミーのスラッグ名を入れる
					$post_type = 'articles'; // カスタム投稿のスラッグ名を入れる
					$args = array(
						'order' => 'DESC',
						'orderby' => 'menu_order',
						'hierarchical' => false,
						'include' => $series_list,
						'posts_per_page' => -1,
					);
					$taxonomys = get_terms( $taxonomy_name, $args);
					//$taxonomys = get_field('top_series_option','option');

					if(!is_wp_error($taxonomys) && count($taxonomys)):
					foreach($taxonomys as $taxonomy):
					$url = get_term_link($taxonomy->slug, $taxonomy_name);
					//カテゴリーID
					$taxonomy_id = $taxonomy->term_id;

					$follow_taxonomy = get_user_meta($login_user,'series_follow');
					$follow_check = in_array($taxonomy_id, $follow_taxonomy);

					$url = get_category_link($taxonomy_id);

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
					<li data-taxonomy_id="<?php echo $taxonomy_id; ?>">
						<?php
						//シリーズダイメージ画像
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
						<div class="followListBlock">
							<div class="followTitleArea">
								<a href="<?php echo $url; ?>">
									<img src="<?php echo $series_url; ?>" alt="<?php echo esc_html($taxonomy->name); ?>イメージ" class="series_thumb_trim" />
								</a>
							</div>
							<div class="followBtnArea">
								<span class="articleFollow switch-button openg <?php if($follow_check == 'true'){echo ' open';} ?>" data-taxonomy="series_follow" data-uid="<?php echo $login_user; ?>" data-taxonomy_id="<?php echo $taxonomy_id; ?>">
									<i class="switch"></i>
								</span>
							</div>
						</div>
					</li>
					<?php
					}
					endforeach;
					endif;
					?>
				</ul>
				<?php else: ?>
				<div class="noFollow">
					<p>フォローしているシリーズはありません。</p>
				</div>
				<?php endif; //フォロー有無 ?>
			</div><!-- followBlock -->

		</div><!-- followBlockWrap -->


	</div>
	</div><!-- mypageContent -->
</section>




	<?php endwhile; endif; ?>

<?php get_footer(); ?>
