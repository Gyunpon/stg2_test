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

<?php 
$http = is_ssl() ? 'https' : 'http' . '';
$url = $http .'://'. $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$keys = parse_url($url); //パース処理
$path = explode("/", $keys['path']); //分割処理
$user_name = $path[2];
$page_userdata = get_user_by('slug',$user_name);
//var_dump($user_name);

$profshow_uid = $page_userdata->ID;
$profshow_all_roles = $page_userdata->roles;
$profshow_flg = '';
//権限にリニュアーが含まれていたらリダイレクトしない
if(in_array("um_renewer", $profshow_all_roles)){
	$profshow_flg = 'true';
}elseif(in_array("um_member", $profshow_all_roles)){
	$profshow_flg = 'false';
}else{
	$profshow_flg = 'false';
}

$user = wp_get_current_user();
$user_roles = $user->roles[0];
?>

<section class="sec sec_renewer_detail <?php if($_GET['um_action'] == 'edit'){echo 'profEditPage';} if($user_roles == 'um_member'){echo ' memberProfPage';} if($login_user == $profshow_uid){echo ' myProfPage';} ?>">

	<?php 
	if(is_user_logged_in()):
	if(!empty($_GET['um_action']) && $_GET['um_action'] == 'edit'):
	?>
	<?php get_template_part('inc/mypageHead'); ?>
	<?php echo do_shortcode( '[ultimatemember form_id="11"]' ); ?>
	<?php endif; endif; ?>


	<div class="inner_base">
		<?php 
		if($profshow_flg == 'true'){
			echo do_shortcode( '[ultimatemember form_id="11"]' );
		}elseif($profshow_flg == 'false'){
			if(is_user_logged_in()){
				echo do_shortcode( '[ultimatemember form_id="11"]' );
			}
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
		//		var_dump($current_uid);



		$author = $current_uid;
		$author_img = get_avatar($author);
		$author_img = str_replace('-190x190', '', $author_img);
		$imgtag= '/<img.*?src=(["\'])(.+?)\1.*?>/i';
		if(preg_match($imgtag, $author_img, $imgurl)){
			$authorimg = $imgurl[2];
		}
		$profile_photo = $current_user['um_member_directory_data'][0];
		if(strpos($profile_photo,'profile_photo";b:0') !== false){
			//画像なし
			$profileImgUrl = ''. home_url().'/wp-content/plugins/ultimate-member/assets/img/default_avatar.jpg';
		}elseif(strpos($profile_photo,'profile_photo";b:1') !== false){
			//画像あり
			$profileImgUrl = $authorimg;
		}

		$editBtn = $login_user;
		$user_id ='';
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

		<?php if(empty($_GET['um_action']) || $_GET['um_action'] != 'edit'): ?>
		<?php 
		$user_info = get_userdata($current_uid);
		$user_id = $user_info->ID;
		$user_name = $user_info->user_login;
		$user_roles = $user_info->roles;
		if(in_array("um_member", $user_roles)):
		?>
		<?php if ($login_user == $current_uid): ?>



		<div class="profEditTxtWrap">
			<div class="userInfo">
				<div class="userIcon"><?php echo get_avatar($user_id, 190); ?></div>
				<div class="userName">@<?php echo $user_name; ?></div>
			</div>

			<div class="profileUpdateField">
				<p><?php echo $user_info->display_name; ?></p>
			</div>

			<?php
			$refererURLBase = $_SERVER['HTTP_REFERER']; //前のページ
			$refererURLParse = parse_url($refererURLBase); //パース処理
			$refererPath = explode("/", $refererURLParse['query']); //分割処理
			$refererURL = $refererPath[0];

			if($refererURL == 'um_action=edit'):
			?>
			<div class="profEditTxt">プロフィールを更新しました</div>
			<a href="<?php echo home_url(); ?>/notifications/" class="btn_base color_blue">
				<span class="text_btn">マイページへ戻る</span>
			</a>
			<?php else: ?>
			<div class="profEditTxt">アカウントを登録しました</div>
			<a href="<?php echo home_url(); ?>/notifications/" class="btn_base color_blue">
				<span class="text_btn">マイページへ移動</span>
			</a>
			<?php endif; ?>
		</div>
		<?php endif; ?>
		<?php else: ?>

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

				<?php if(empty($tw_link) && empty($fb_link) && empty($insta_link) && empty($url)): ?>
				<?php else: ?>
				<ul class="social flex renewer_social">
					<span class="btn_contact">Contact</span>
					<?php if($tw_link): ?>
					<li class="social_button">
						<?php if(strpos($tw_link,'http') !== false):?>
						<a href="<?php echo $tw_link; ?>" target="_blank" rel="noopener">
							<?php else: ?>
							<a href="//twitter.com/<?php echo $tw_link; ?>/" target="_blank" rel="noopener">
								<?php endif; ?>
								<!--							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30"><path id="icon_tw" data-name="icon_tw" d="M15,30a15,15,0,1,1,10.61-4.39A14.93,14.93,0,0,1,15,30ZM5.5,21.69h0a11.52,11.52,0,0,0,6.19,1.81,11.64,11.64,0,0,0,4.93-1,10.87,10.87,0,0,0,3.6-2.7,11.86,11.86,0,0,0,3-7.75c0-.16,0-.32,0-.53a7.84,7.84,0,0,0,2-2.09,7.77,7.77,0,0,1-2.32.64A4,4,0,0,0,24.64,7.8a8.1,8.1,0,0,1-2.57,1,4,4,0,0,0-6.88,3.68A11.53,11.53,0,0,1,6.86,8.24a4,4,0,0,0,1.25,5.39,4,4,0,0,1-1.82-.5v0a4,4,0,0,0,3.23,4,3.77,3.77,0,0,1-1.06.15,4.9,4.9,0,0,1-.76-.08A4,4,0,0,0,11.47,20a8,8,0,0,1-5,1.73A6.18,6.18,0,0,1,5.5,21.69Z" style="fill:#fff"/></svg>-->
								<img src="<?php echo get_template_directory_uri(); ?>/images/icons/rn_tw.svg" alt="twitter" />
							</a>
							</li>
						<?php endif ?>
						<?php if($fb_link): ?>
						<?php if(strpos($fb_link,'http') !== false):?>
						<a href="<?php echo $fb_link; ?>" target="_blank" rel="noopener">
							<?php else: ?>
							<a href="//www.facebook.com/<?php echo $fb_link; ?>/" target="_blank" rel="noopener">
								<?php endif; ?>
								<li class="social_button">
									<img src="<?php echo get_template_directory_uri(); ?>/images/icons/rn_fb.svg" alt="facebook" />
							</a>
							</li>
						<?php endif ?>
						<?php if($insta_link): ?>
					<li class="social_button">
						<?php if(strpos($insta_link,'http') !== false):?>
						<a href="<?php echo $insta_link; ?>" target="_blank" rel="noopener">
							<?php else: ?>
							<a href="//www.instagram.com/<?php echo $insta_link; ?>/" target="_blank" rel="noopener">
								<?php endif; ?>
								<img src="<?php echo get_template_directory_uri(); ?>/images/icons/rn_insta.svg" alt="instagram" />
							</a>
							</li>
						<?php endif ?>
						<?php if($url): ?>
					<li><a href="<?php echo $url; ?>" target="_blank" rel="noopener" class="socail_link"><?php echo $url; ?></a></li>
					<?php endif ?>
				</ul>
				<?php endif; ?>

				<div class="wrap_bottom_renewer_head">

					<!--
<div class="wrap_switch">
<span class="switch-button">
<i class="switch"></i>
</span>
</div>

<div class="wrap_switch">
<?php if( is_user_logged_in() ) : ?>
<span class="switch-button openg <?php if($follow_check == 'true'){echo ' open';} ?>" data-taxonomy="agenda_follow" data-uid="<?php echo $uid; ?>" data-taxonomy_id="<?php echo $taxonomy_id; ?>">
<i class="switch"></i>
</span>
<?php else: ?>
<a href="<?php echo home_url(); ?>/login/" class="noLoginFollowBtn">
<i class="switch"></i>
</a>
<?php endif; ?>
</div>
</div>
-->



				</div><!-- wrap_bottom_renewer_head -->

				<?php if($login_user == $current_uid): ?>
				<div class="editBtn"><a href="<?php echo home_url(); ?>/user/<?php echo $user_login; ?>/?um_action=edit">プロフィールを編集する</a></div>
				<?php endif; ?>

			</div><!-- wrap_text_renewer_head -->
		</div><!-- head_content_renewer -->
		<?php endif; ?>


	</div><!-- inner_base -->


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
	$pageNum = 15;
	?>

	<input type="hidden" id="postType" name="postType" value="<?php echo $post_type; ?>" />
	<input type="hidden" id="paged" name="paged" value="<?php echo $nowPaged; ?>" />
	<input type="hidden" id="pagedGetName" name="pagedGetName" value="<?php echo $pagerGetName; ?>" />
	<input type="hidden" id="postPerPage" name="postPerPage" value="<?php echo $pageNum; ?>" />


	<?php
	$profile_id = um_profile_id();
	$userArticle_query = new WP_Query();
	
	$args = array(
		'post_type' => $post_type,
		'posts_per_page' => $pageNum,
		'paged' => $nowPaged,
		'post_status' => 'publish',
		'orderby' => 'date',
		'order' => 'DESC',
		'author' => $profile_id
	);
	$userArticle_query->query($args);
	
	if($userArticle_query->have_posts()):
	?>
	<div class="content_renewer">
		<div class="inner_base">
			<div class="wrap_article_middle grid articleListStyle">
				<?php while($userArticle_query->have_posts()) : $userArticle_query->the_post(); ?>
				<?php
//				preDump($post->ID);
				
				$postId = $post->ID;
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


				$user_name = '';
				$author_id = '';
				$renews_id = '';
				$user_avatar = '';

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
//				if($current_uid == $author_id):
				?>
				<div class="article_middle">
					<div class="wrap_img">
						<div class="article_middle_img imgLiquidFill">
							<a href="<?php the_permalink(); ?>">
								<img src="<?php echo $imageUrl; ?>" alt="<?php echo $title; ?> サムネイル" />
							</a>
						</div>
					</div>

					<div class="textbox middle left_bottom">
						<?php if(!empty($series_terms)): ?>
						<?php foreach($series_terms as $ct):
						$series_link = get_category_link($ct->term_id);
						?>
						<a href="<?php echo $series_link; ?>">
							<span class="series_name">
								<?php echo $ct->name; ?>
							</span>
						</a>
						<?php endforeach; ?>
						<?php endif; ?>

						<a href="<?php the_permalink(); ?>">
							<h2 class="title_middle artcle_small_title">
								<?php echo $title; ?>
							</h2>
						</a>
						<div class="card-bottom">
							<?php
							//著者情報
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
							?>
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
								<div class="socialbox likebox"><?php if(function_exists('wp_ulike_comments')) echo wp_ulike( 'put', array("id" => $postId) ); ?></div>
								<a class="socialbox commentbox flexSocialbox" href="<?php the_permalink(); ?>?move=commentsAreaWrap">
									<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 42 41.3" style="enable-background:new 0 0 42 41.3;" xml:space="preserve">
										<path fill="none" stroke="#b0ad9e" stroke-width="1.5" class="icon_comm" data-name="icon_comm" d="M28.1,31.9c-1.4,0-2.8-0.2-4.2-0.7s-2.2-1.9-2-3.4v-0.2h-7.5c-2.2,0-4.1-1.8-4.1-4.1V15c0-2.2,1.8-4.1,4.1-4.1 l0,0h14.4c2.2,0,4.1,1.8,4.1,4.1v8.6c0,2.2-1.8,4.1-4.1,4.1h-1.7V28c0,1,0.6,2,1.5,2.6l2.2,1.4L28.1,31.9L28.1,31.9z"/>
									</svg>
									<span class="commCount"><?php echo $comments->total_comments; ?></span>
								</a>
							</div>
						</div>
					</div>
				</div>

				<?php /*endif;*/ endwhile; ?>
			</div><!-- /.content_article -->


		</div><!-- inner_base -->
	</div>
	
	
	
	<?php
	$max_page = ceil($userArticle_query->found_posts / $pageNum);
	
	if($max_page != 1):
	$paginate_base = preg_replace('/(\?|&)pg=[0-9]{1,4}/i','',get_pagenum_link(1));
	?>
	<div class="pagerArea inner_base">
		<?php
		echo paginate_links( array(
			'base' => $paginate_base.'%_%',
			'format' => '?pg=%#%',
			'total' => $max_page,
			'end_size' => 1,
			'mid_size' => 2,
			'current' => ($nowPaged ? $nowPaged : 1),
		));
		?>
	</div><!--pagerArea-->

	<?php endif; ?>
	
	
	<?php endif; wp_reset_postdata(); ?>

	<?php endif; //?um_action=editじゃなかったら ?>

</section>



<?php endwhile; endif; ?>

<?php get_footer(); ?>