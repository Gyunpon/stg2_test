<?php
/**
 * Template Name: リニュアー一覧
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
	
<div id="renewer">
	


<section class="sec sec_renewer">
	<div class="inner_base">
		<h2 class="title_thin">
			<span class="title_thin_img beige">
				<h2>リニュアー</h2>
			</span>
		</h2>
		<p class="title_thin_subtitle">コンテンツを支える専門家集団「Renewer（リニュアー）」の一覧です。</p>
		<p class="title_thin_subtitle_s mb-50">新規登録順に随時、追加していきます。</p>


		<?php echo do_shortcode( '[ultimatemember form_id="22"]' ) ?>
	</div>
</section>
	
	
</div><!-- renewer -->
	
	<?php endwhile; endif; ?>

<?php get_footer(); ?>