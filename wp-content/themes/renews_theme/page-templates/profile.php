<?php
/**
 * Template Name: プロフィール変更
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
$user_id = $login_user->ID;
$user_login = $login_user->user_login;

?>
	<?php if(have_posts()): while (have_posts()): the_post(); ?>


<section class="sec sec_my">
	<div class="inner_base">

		<div class="profileEditTitleWrap">
			<h2 class="profileEditTitle">プロフィール変更</h2>
			<p>すべて任意でご登録いただけます</p>
		</div>

		<div id="profEditFrameWrap">
			<iframe id="profEditFrame" src="<?php echo home_url(); ?>/user/<?php echo $user_login; ?>/?um_action=edit">
			</iframe>
		</div><!-- profEditFrameWrap -->
		
		<div class="wrap_btn mypageBackBtn clearfix">
			<a href="<?php echo home_url(); ?>/member/" class="btn_base color_blue">
				<span class="text_btn">マイページへ戻る</span>
			</a>
		</div>

	</div>
</section>



	
	<?php endwhile; endif; ?>

<?php get_footer(); ?>