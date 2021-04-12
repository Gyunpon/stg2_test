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
	
<section class="sec sec_login">
	<div class="inner_base">

		<h1 class="title_lower_l1">
			ログインする
		</h1>

		<p class="text_read color_gray text_desc_login">
			または<span class="text_link underline"><a href="<?php echo home_url(); ?>/register/">アカウントを作成</a></span>
		</p>

		<?php echo do_shortcode( '[ultimatemember form_id="10"]' ) ?>


	</div>
</section>


	<?php endwhile; endif; ?>

<?php get_footer(); ?>