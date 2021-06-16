<?php
/**
 * Template Name: 通知
 */
?>
<?php get_header(); ?>

<?php if(have_posts()): while (have_posts()): the_post(); ?>
<?php
//現在のアカウント
$login_userBase = wp_get_current_user();

$login_user_id = $login_userBase->user_nicename;
$login_user_name = $login_userBase->display_name;

// URL
$nowUri = $_SERVER["REQUEST_URI"];

// ページフラグ
$pageFlg = 'memberTop';
if(strpos($nowUri,'password') !== false){
	// パスワードページ
	$pageFlg = 'password';
}elseif(strpos($nowUri,'webnotifications') !== false){
	// サイト内通知ページ
	$pageFlg = 'webnotifications';
}elseif(strpos($nowUri,'notifications') !== false){
	// メール通知ページ
	$pageFlg = 'notifications';
}elseif(strpos($nowUri,'delete') !== false){
	// 退会ページ
	$pageFlg = 'delete';
}
?>
<div id="my">
	<section class="sec sec_my">
		<?php get_template_part('inc/mypageHead'); ?>
		
		<div id="<?php echo $pageFlg; ?>" class="mypageContent">
			<div class="inner_base">
				
				
				
				<?php if($pageFlg == 'memberTop'): ?>
				<div class="mypageTitleBlock">
					<div class="pageIcon"><img src="<?php echo get_template_directory_uri(); ?>/images/my/notice.jpg" alt="通知" /></div>
					<div class="mypageTitleArea">
						<h2 class="mypageTitle"><?php the_title(); ?></h2>
						<div class="pageCatch">
							<p>あなたへの通知が表示されます</p>
						</div>
					</div>
				</div><!-- mypageTitleBlock -->
				<div id="noticeArea" class="profileArea">
					<?php echo do_shortcode( '[ultimatemember_notifications]' ); ?>
				</div>
				<?php else: ?>
				
				<?php if($pageFlg == 'password'): ?>
				<div class="mypageTitleBlock">
					<div class="pageIcon"><img src="<?php echo get_template_directory_uri(); ?>/images/my/password.jpg" alt="パスワード" /></div>
					<div class="mypageTitleArea">
						<h2 class="mypageTitle">パスワード変更</h2>
						<div class="pageCatch">
							<p>現在のパスワードを変更できます</p>
						</div>
					</div>
				</div><!-- mypageTitleBlock -->
				
				<?php elseif($pageFlg == 'webnotifications'): ?>
				<div class="mypageTitleBlock">
					<div class="pageIcon"><img src="<?php echo get_template_directory_uri(); ?>/images/my/notice.jpg" alt="通知設定" /></div>
					<div class="mypageTitleArea">
						<h2 class="mypageTitle">通知設定</h2>
						<div class="pageCatch">
							<p>サイト上で受信する通知を選択ください</p>
						</div>
					</div>
				</div><!-- mypageTitleBlock -->
				
				<?php elseif($pageFlg == 'notifications'): ?>
				<div class="mypageTitleBlock">
					<div class="pageIcon"><img src="<?php echo get_template_directory_uri(); ?>/images/my/notifications.jpg" alt="メール受信設定" /></div>
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
						<?php if($pageFlg == 'delete'): ?>
						<h1 class="deleteTitle">退会する</h1>
						<?php 
						$uid = $login_userBase->ID;
						?>
						<div class="userBlock">
							<p class="userIcon"><?php echo get_avatar($uid, 190); ?></p>
							<p class="userName"><?php echo $login_user_name; ?></p>
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