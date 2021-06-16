<?php
/**
 * Template Name: パスワードリセット
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
	
<section class="sec sec_login">
	<div class="mypageHead shadow">
		<div class="inner_base">
			<div class="roundTitleWrap">
				<h1 class="roundTitle">パスワードリセット</h1>
			</div>
		</div>
	</div><!-- mypageHead -->
	
	<div class="mypageContent">
		<div class="inner_base">
			<div class="resetText">
				<?php if($_GET['updated'] == 'checkemail'): ?>
				パスワードを再設定するためのURLをメールアドレスにお送りしました。<br />
				パスワードの再設定を行ってください。
				<?php elseif($_GET['act'] == 'reset_password'): ?>
				新しいパスワードを設定してください。
				<?php else: ?>
				パスワードをリセットするには以下に<br />
				リニューズIDまたはメールアドレスを入力してください。<br />
				パスワードを設定するためのURLをお送りします。
				<?php endif; ?>
			</div>
			<?php echo do_shortcode( '[ultimatemember_password]' ) ?>

		</div>
	</div><!-- mypageContent -->

</section>


	<?php endwhile; endif; ?>

<?php get_footer(); ?>