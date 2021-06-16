<?php
/**
 * Template Name: リニュアー詳細
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

<section class="sec sec_renewer_detail">
	<div class="inner_base">

		<?php if($_GET['profiletab'] == 'following'): ?>
		<h1 class="title_lower_l1 eng">
			フォローリニュアー
		</h1>
		<?php endif; ?>

<?php 
	$http = is_ssl() ? 'https' : 'http' . '';
		$url = $http .'://'. $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
		$keys = parse_url($url); //パース処理
		$path = explode("/", $keys['path']); //分割処理
		$user_name = $path[2];

		if(($_GET['um_action'] == 'edit') || ($_GET['profiletab'] == 'following')){
			echo do_shortcode( '[ultimatemember form_id="11"]' );
		}
		 ?>



		<?php
	$users = get_users(
	array(
		'orderby' => 'ID',
		'order' => 'ASC',
		//		'role' => 'member',
	)
	);?>
		<?php foreach($users as $user):
		$uid = $user->ID;
		$all_uid = $user->user_nicename;
		
		if($user_name == $all_uid):
		$current_uid = $uid;
		$current_user = get_user_meta($current_uid);
//		var_dump($current_user);

		$profile_photo = $current_user['um_member_directory_data'][0];
		if(strpos($profile_photo,'profile_photo";b:0') !== false){
			//画像なし
			$profileImgUrl = ''. home_url().'/wp-content/plugins/ultimate-member/assets/img/default_avatar.jpg';
		}elseif(strpos($profile_photo,'profile_photo";b:1') !== false){
			//画像あり
			$profileImgUrl = ''. home_url().'/wp-content/uploads/ultimatemember/'. $uid.'/profile_photo.jpg';
		}
		
		$editBtn = $login_user;

		$url = $user->user_url;

		$last_name = $current_user['last_name'][0];
		$first_name = $current_user['first_name'][0];
		$user_login = $current_user['um_user_profile_url_slug_user_login'][0];
		$description = $current_user['description'][0];
		$position = $current_user['position'][0];
		//SNS
		$tw_link = $current_user['twitter'][0];
		$fb_link = $current_user['facebook'][0];
		$insta_link = $current_user['instagram'][0];
		endif; endforeach;
		?>

		<?php if(($_GET['um_action'] != 'edit') && ($_GET['profiletab'] != 'following')): ?>
		<div class="head_content_renewer flex">

			<div class="avatar_renewer_main">
				<img src="<?php echo $profileImgUrl; ?>" alt="" />
			</div>

			<div class="flex wrap_text_renewer_head">
				<div class="wrap_text_renewer">
					<h3 class="name_renewer bold large">
						<?php if($first_name){echo ''.$last_name.' '.$first_name.'';} ?> @<?php echo $user_login; ?>
						<?php if($position){echo '<span class="category_renewer">'.$position.'</span>';} ?>
					</h3>

					<?php if($description): ?>
					<div class="wrap_text_renewer_intro">
						<p class="text_renewer large">
							<?php echo $description; ?>
						</p>
					</div>
					<?php endif; ?>
				</div>

				<ul class="social flex renewer_social">
					<span class="btn_contact">Contact</span>
					<?php if($tw_link): ?>
					<li class="social_button">
						<a href="<?php echo $tw_link; ?>" target="_blank" rel="noopener">
<!--						<a href="//twitter.com/<?php echo $tw_link; ?>" target="_blank" rel="noopener">-->
							<i class="fab fa-twitter"></i>
						</a>
					</li>
					<?php endif ?>
					<?php if($fb_link): ?>
					<li class="social_button">
						<a href="<?php echo $fb_link; ?>" target="_blank" rel="noopener">
<!--						<a href="//www.facebook.com/<?php echo $fb_link; ?>" target="_blank" rel="noopener">-->
							<i class="fab fa-facebook-f"></i>
						</a>
					</li>
					<?php endif ?>
					<?php if($insta_link): ?>
					<li class="social_button">
						<a href="<?php echo $insta_link; ?>" target="_blank" rel="noopener">
<!--						<a href="//www.instagram.com/<?php echo $insta_link; ?>" target="_blank" rel="noopener">-->
							<i class="fab fa-instagram"></i>
						</a>
					</li>
					<?php endif ?>
					<?php if($url): ?>
					<a href="<?php echo $url; ?>" target="_blank" rel="noopener" class="socail_link"><?php echo $url; ?></a>
					<?php endif ?>
				</ul>

				<!--フォローボタン
<div class="wrap_bottom_renewer_head">
<div class="wrap_switch">
<span class="switch-button" id="switch1">
<i class="switch"></i>
</span>
</div>
</div>
-->
				<?php if($login_user == $current_uid): ?>
			<div class="editBtn"><a href="<?php echo home_url(); ?>/user/<?php echo $user_login; ?>/?um_action=edit">プロフィールを編集する</a></div>
<?php endif; ?>
			</div>
		</div>

		
		<?php
		$wp_query = new WP_Query();

		$args = array(
			'post_type' => 'articles',
			'posts_per_page' => "-1",
			'post_status' => 'publish',
			'orderby' => 'date',
			'order' => 'DESC',
			//'author_name' => $user_name,
		);

		$wp_query->query($args);
		
		
		if($wp_query->have_posts()):
		?>
		<div class="content_renewer">
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

				
				//著者情報
				$rows = get_field('author_select',$post->ID );
				$first_row = $rows[0];
				$first_row_item = $first_row['author'];
				if(!($first_row_item)){
					$user_name = get_the_author_meta( 'display_name', $post->post_author );
					$renews_id = get_the_author_meta( 'user_login', $post->post_author );
					$user_avatar = get_avatar( get_the_author_meta( 'ID' ), 64 );
				}else{
					$user_name = $first_row_item['display_name'];
					$author_id = $first_row_item['ID'];
					$renews_id = $first_row_item['user_nicename'];
					$user_avatar = $first_row_item['user_avatar'];
				}
				//コメント
				$comments = wp_count_comments( $postId );
				
				
				// タイトル
				$title = mb_strimwidth( $post->post_title, 0, 66, "...", "UTF-8" );
				$series_terms = get_the_terms($post->ID, 'series');
				if($current_uid == $author_id):
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
				</div>
				
				<?php endif; endwhile; ?>
			</div><!-- /.content_article -->
		</div>

		<?php endif; wp_reset_query(); ?>
		
		<?php endif; //?um_action=editじゃなかったら ?>
		
	</div>
</section>



	
	<?php endwhile; endif; ?>

<?php get_footer(); ?>