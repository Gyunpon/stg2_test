<?php 
//現在のアカウント
$login_userBase = wp_get_current_user();

$login_user_id = $login_userBase->user_nicename;
//$login_display_name = $login_userBase->display_name;
//if(empty($login_display_name)){
//	$login_user_name = $login_user_id;
//}else{
//	$login_user_name = $login_display_name;
//}

$uid = $login_userBase->ID;
$user_last_nameBase = get_user_meta($uid,'last_name');
$user_last_name = $user_last_nameBase[0];
$user_first_nameBase = get_user_meta($uid,'first_name');
$user_first_name = $user_first_nameBase[0];

$http = is_ssl() ? 'https' : 'http' . '';
$url = $http .'://'. $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$keys = parse_url($url); //パース処理
$path = explode("/", $keys['path']); //分割処理
$slug_member = $path[1];
$slug_member_under = $path[2];
?>


<div class="mypageHead">
	<div class="inner_base">
		<div class="roundTitleWrap">
			<h1 class="roundTitle">マイページ</h1>
		</div>
		
		<p class="userName"><?php echo $user_last_name; ?><?php echo $user_first_name; ?><?php echo ' @'.$login_user_id.''; ?></p>
		
		<div class="userMenuWrap">
			<ul class="userMenu">
				<li><a href="<?php echo home_url(); ?>/-/<?php echo $login_user_id; ?>/?um_action=edit">プロフィール変更</a></li>
				<li><a href="<?php echo home_url(); ?>/logout/">ログアウト</a></li>
			</ul><!-- userMenu -->
		</div>
	</div>
	
	<div class="mypageTabWrap">
		<?php if(isset($_GET['um_action']) && $_GET['um_action'] == 'edit'): ?>
		<img src="<?php echo get_template_directory_uri(); ?>/images/my/tab/mypage_dt_tab_profile.svg" class="for_pc" alt="" />
		<img src="<?php echo get_template_directory_uri(); ?>/images/my/tab/mypage_mb_tab_profile.svg" class="for_sp" alt="" />
		<?php endif; ?>
		<?php if(is_page_template('page-templates/follow.php')): ?>
		<img src="<?php echo get_template_directory_uri(); ?>/images/my/tab/mypage_dt_tab_follow.svg" class="for_pc" alt="" />
		<img src="<?php echo get_template_directory_uri(); ?>/images/my/tab/mypage_mb_tab_follow.svg" class="for_sp" alt="" />
		<?php endif; ?>
		<?php if(is_page_template('page-templates/bookmark.php')): ?>
		<img src="<?php echo get_template_directory_uri(); ?>/images/my/tab/mypage_dt_tab_bookmark.svg" class="for_pc" alt="" />
		<img src="<?php echo get_template_directory_uri(); ?>/images/my/tab/mypage_mb_tab_bookmark.svg" class="for_sp" alt="" />
		<?php endif; ?>
		<?php if((is_page_template('page-templates/notifications.php') || $slug_member_under == 'webnotifications') && $slug_member_under != 'notifications' && $slug_member_under != 'password'): ?>
		<img src="<?php echo get_template_directory_uri(); ?>/images/my/tab/mypage_dt_tab_notifications.svg" class="for_pc" alt="" />
		<img src="<?php echo get_template_directory_uri(); ?>/images/my/tab/mypage_mb_tab_notifications.svg" class="for_sp" alt="" />
		<?php endif; ?>
		<?php if($slug_member_under == 'password'): ?>
		<img src="<?php echo get_template_directory_uri(); ?>/images/my/tab/mypage_dt_tab_member_password.svg" class="for_pc" alt="" />
		<img src="<?php echo get_template_directory_uri(); ?>/images/my/tab/mypage_mb_tab_member_password.svg" class="for_sp" alt="" />
		<?php endif; ?>
		<?php if(($slug_member == 'member') && ($slug_member_under == 'notifications')): ?>
		<!--<img src="<?php echo get_template_directory_uri(); ?>/images/my/tab/mypage_dt_tab_member_notifications.svg" class="for_pc" alt="" />
		<img src="<?php echo get_template_directory_uri(); ?>/images/my/tab/mypage_mb_tab_member_notifications.svg" class="for_sp" alt="" />-->
		<?php endif; ?>
		
		<ul class="mypageTab">
			<li><a href="<?php echo home_url(); ?>/member/">あなたへの通知</a></li>
			<li><a href="<?php echo home_url(); ?>/member/follow/">フォロー管理</a></li>
			<li><a href="<?php echo home_url(); ?>/member/bookmark/">クリップ記事</a></li>
			<!--<li><a href="<?php echo home_url(); ?>/member/notifications/">メール通知</a></li>-->
			<li><a href="<?php echo home_url(); ?>/member/password/">パスワード変更</a></li>
		</ul><!-- mypageTab -->
	</div><!-- mypageTabWrap -->
</div><!-- mypageHead -->