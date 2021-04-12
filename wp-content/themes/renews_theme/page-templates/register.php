<?php
/**
 * Template Name: 新規登録
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
	




<section class="sec sec_join <?php if(is_user_logged_in() || $_GET['message'] == 'checkmail'){echo 'alreadyRegist';} ?>">
	<?php if(is_user_logged_in()): ?>
	
	<!-- <?php echo do_shortcode( '[ultimatemember form_id="9"]' ); ?> -->
	
	<div class="mypageContent">
		<div class="inner_base">
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
		</div>
	</div>
	
	
	<?php else: ?>
	
	<div class="mypageHead shadow">
		<div class="inner_base">
			<div class="roundTitleWrap">
				<h1 class="roundTitle">メンバー登録</h1>
			</div>
			<div class="text_read">
				すでにアカウントをお持ちですか？<br class="for_sp" /><span class="text_link underline"><a class="popup-modal" href="#modalLoginWrap">ログインする</a></span>
			</div>
		</div>
	</div><!-- mypageHead -->


	<div class="inner_base">
		<?php echo do_shortcode( '[ultimatemember form_id="9"]' ); ?>
	</div>
	
	<?php endif; ?>
</section>
	
	
	<?php endwhile; endif; ?>

<?php get_footer(); ?>