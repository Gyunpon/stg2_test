<?php get_header(); ?>
<?php
$post_type = get_query_var('post_type');
?>
<?php
		global $archivePageNum;
//$pageItemNum = $archivePageNum;
$pageItemNum = 15;

$paged = get_query_var('paged');
parse_str( $query_string, $args );
$addArgs = array(
	'paged' => $paged,
	'posts_per_page' => $pageItemNum,
	'order' => 'DESC',
	'orderby' => 'date'
);
$args = array_merge($args,$addArgs);
$wp_query = new WP_Query($args);

$archivePageName = '';
if(is_tag()){
	$archivePageName = single_tag_title( '', false );
}elseif(is_category()){
	$archivePageName = single_cat_title( '', false );
}elseif(is_tax()){
	$archivePageName = single_term_title( '', false );
}else{
	$archivePageName = post_type_archive_title( '', false );
}

if(empty($archivePageName)){ $archivePageName = '投稿'; }

?>
<?php if($wp_query->have_posts()): ?>

<section id="article" class="sec sec_article">
	<div class="inner_base">
		<div class="sec_title">
			<h1 class="main_title">New Articles
			<span class="main_title_jp">新着記事</span>
			</h1>
			<p class="main_title_desc mb-10">すべてのコンテンツを新着順に表示します。</p>
		</div>

		<div class="content_article">
			<div class="wrap_article_middle grid articleListStyle">
				<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>
				<!-- 5/21 変更 黒澤 -->
				<?php require 'small_comp.php'; ?>
				<?php endwhile; ?>
			</div><!-- /.wrap_article_middle -->
		</div><!-- /.content_article -->
	</div><!-- /.inner_base -->

	<?php
	$max_page = $wp_query->max_num_pages;
	if($max_page != 1):
	?>

	<div class="pagerArea inner_base">
		<?php global $wp_rewrite;
		$paginate_base = get_pagenum_link(1);
		if (strpos($paginate_base, '?') || ! $wp_rewrite->using_permalinks()) {
			$paginate_format = '';
			$paginate_base = add_query_arg('paged', '%#%');
		} else {
			$paginate_format = (substr($paginate_base, -1 ,1) == '/' ? '' : '/') . user_trailingslashit('page/%#%/', 'paged');
			$paginate_base .= '%_%';
		}
		echo paginate_links( array(
			'base' => $paginate_base,
			'format' => $paginate_format,
			'total' => $wp_query->max_num_pages,
			'end_size' => 1,
			'mid_size' => 1,
			'current' => ($paged ? $paged : 1),
		));
		?>
	</div>

	<?php endif; ?>

</section>




<?php else: /* else have_posts */ ?>
<div id="notFound" class="articleNotFound">
	<h1>お探しの<?php echo $archivePageName; ?>に関する記事は見つかりませんでした。</h1>
	<p>
		申し訳ございません。<br />
		<?php echo $archivePageName; ?>に関する記事は見つかりませんでした。
	</p>
</div><!--notfound-->
<?php endif; wp_reset_postdata();/* end have_posts */ ?>
<?php get_footer(); ?>
