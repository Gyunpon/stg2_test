<?php
/**
 * Template Name: マイページ・メニュー
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
<?php
//現在のアカウント
$login_userBase = wp_get_current_user();

		$login_user_id = $login_userBase->user_nicename;
		$login_user_name = $login_userBase->display_name;

$user_avatar = get_avatar( $login_userBase->get('ID'), 190 );


$follow_url = ''. home_url() .'/follow/';
 ?>
 
<?php 
$user = wp_get_current_user();
$user_roles = $user->roles[0];

$http = is_ssl() ? 'https' : 'http' . '';
$url = $http .'://'. $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$keys = parse_url($url); //パース処理
$path = explode("/", $keys['path']); //分割処理
$slug_member = $path[1];
$slug_member_under = $path[2];
?>

 

	<div id="my">

		<section class="sec sec_my <?php if($user_roles == 'um_member'){echo ' memberProfPage';} ?>">
			<?php
			if($slug_member_under == 'delete'):
			elseif($slug_member == 'member' && $slug_member_under == ''):
			else:
			get_template_part('inc/mypageHead');
			endif;
			?>
		
			<div class="mypageContent">
				<div class="inner_base">

					<?php if($slug_member == 'member' && $slug_member_under == ''): ?>
					<div class="userProfAreaWrap">
						<!--				<p class="alreadyRegistTxt">あなたのアカウントはすでに登録済みです。</p>-->
						<?php 
						$login_user = wp_get_current_user();
						$current_uid = $login_user->ID;
						$user_info = get_userdata($current_uid);
						$user_id = $user_info->ID;
						?>
						<div class="userIconWrap">
							<div class="userIcon"><?php echo get_avatar($user_id, 190); ?></div>
							<div class="userName"><?php echo $login_user->display_name; ?> @<?php echo $login_user->user_login; ?></div>
						</div>

						<div class="wrap_btn">
							<a href="<?php echo home_url(); ?>/notifications/" class="btn_base color_blue">
								<span class="text_btn">マイページへ</span>
							</a>
						</div>
					</div><!-- userProfAreaWrap -->
			<?php endif; ?>
			
			
			
				<?php if(!empty($slug_member_under)): ?>
				
					<?php if($slug_member_under == 'webnotifications'): //通知設定 ?>
					<div class="mypageTitleBlock">
						<div class="pageIcon"><img src="<?php echo get_template_directory_uri(); ?>/images/my/notice.jpg" alt="" /></div>
						<div class="mypageTitleArea">
							<h2 class="mypageTitle">通知設定</h2>
							<div class="pageCatch">
								<p>サイト上で受信する通知を選択ください</p>
							</div>
						</div>
					</div><!-- mypageTitleBlock -->
					<?php endif; ?>
				
				<?php if($slug_member_under == 'password'): //パスワード変更 ?>
				<div class="mypageTitleBlock">
					<div class="pageIcon"><img src="<?php echo get_template_directory_uri(); ?>/images/my/password.jpg" alt="" /></div>
					<div class="mypageTitleArea">
						<h2 class="mypageTitle">パスワード変更</h2>
						<div class="pageCatch">
							<p>現在のパスワードを変更できます</p>
						</div>
					</div>
				</div><!-- mypageTitleBlock -->
				<?php endif; ?>
				
					<?php if(($slug_member == 'member') && ($slug_member_under == 'notifications')): //メール通知 ?>
					<div class="mypageTitleBlock">
						<div class="pageIcon"><img src="<?php echo get_template_directory_uri(); ?>/images/my/notifications.jpg" alt="" /></div>
						<div class="mypageTitleArea">
							<h2 class="mypageTitle">メール通知</h2>
							<div class="pageCatch">
								<p>メール受信する通知を選択ください</p>
							</div>
						</div>
					</div><!-- mypageTitleBlock -->
					<?php endif; ?>
				
				
				<div class="profileAreaWrap">
				<div class="profileArea">
					<?php if($slug_member_under == 'delete'): //退会ページ ?>
					<h1 class="deleteTitle">退会する</h1>
					<?php 
					$uid = $user->ID;
					$userName = $user->display_name;
					?>
					<div class="userBlock">
						<p class="userIcon"><?php echo get_avatar($uid, 190); ?></p>
						<p class="userName"><?php echo $userName; ?></p>
					</div>
					<?php endif; ?>
					
					<?php echo do_shortcode( '[ultimatemember_account]' ); ?>
					</div><!-- profileArea -->
				</div><!-- profileAreaWrap -->
				

				<?php endif; ?>
		
			</div>
			</div><!-- mypageContent -->
			
		</section>
	
		
	</div>



	
	<?php endwhile; endif; ?>

<?php get_footer(); ?>