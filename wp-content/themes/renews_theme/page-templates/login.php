<?php
/**
 * Template Name: ログイン
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
	
<section class="sec sec_login <?php if(is_user_logged_in()){echo 'alreadyRegist';} ?> <?php if(is_user_logged_in() && $_GET['updated'] == 'password_changed'){echo 'password_changed_wrap';} ?>">
	<?php if(is_user_logged_in() && $_GET['updated'] == 'password_changed'): //ログインしてるかつURL ?>
	
	
	
	<div class="mypageContent <?php if(is_user_logged_in() && $_GET['updated'] == 'password_changed'){echo 'password_changed';} ?>">
		<div class="inner_base">
			<?php if(is_user_logged_in() && $_GET['updated'] == 'password_changed'): ?>
			<div class="userProfAreaWrap">
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
			<?php else: ?>
			<?php echo do_shortcode( '[ultimatemember form_id="10"]' ); ?>
			<?php endif; ?>
		</div>
	</div>
	<?php elseif(is_user_logged_in()):　//ログインしてる ?>
	
	<div class="mypageContent">
		<div class="inner_base">
			<div class="userProfAreaWrap">
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
		</div>
	</div>
	
	
	<?php else: ?>
	<div class="mypageHead shadow">
		<div class="roundTitleWrap">
			<h1 class="roundTitle">ログイン</h1>
		</div>
		<div class="text_read">
			アカウントをお持ちでない方は<a href="<?php echo home_url(); ?>/register/">メンバー登録</a>
		</div>
	</div><!-- modalLoginHead -->
	
	<div class="mypageContent <?php if(is_user_logged_in() && $_GET['updated'] == 'password_changed'){echo 'password_changed';} ?>">
		<div class="inner_base">
			<?php if(is_user_logged_in() && $_GET['updated'] == 'password_changed'): ?>
			<div class="userProfAreaWrap">
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
			<?php else: ?>
			<?php echo do_shortcode( '[ultimatemember form_id="10"]' ); ?>
			<?php endif; ?>
		</div>
	</div>
	<?php endif ?>


</section>


	<?php endwhile; endif; ?>

<?php get_footer(); ?>