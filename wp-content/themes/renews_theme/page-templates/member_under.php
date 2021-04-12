<?php
/**
 * Template Name: マイページ下層
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
 ?>

	<div id="my">
		<section class="sec sec_my">
			<div class="inner_base">

				<h1 class="title_lower_l1 eng">
					<?php the_title(); ?>
				</h1>


				<div class="profileArea">
					<?php the_content(); ?>
				</div>

			</div>
		</section>
		
	</div>



	
	<?php endwhile; endif; ?>

<?php get_footer(); ?>