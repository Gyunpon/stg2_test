<?php

/**
 * Search Page
 * 検索結果ページ
 */
?>
<?php get_header(); ?>
<?php
$post_type = get_query_var('post_type');
?>

<?php
global $archivePageNum;
$pageItemNum = 60;
//$paged = get_query_var('paged');
//query_posts($query_string . '&posts_per_page=' . $pageItemNum . '&paged=' . $paged);
parse_str( $query_string, $args );
$addArgs = array(
	'paged' => $paged,
	'posts_per_page' => $pageItemNum,
	'order' => 'DESC',
	'orderby' => 'date',
	'post_type' => 'articles'
);
$args = array_merge($args,$addArgs);
$wp_query = new WP_Query($args);
?>

<?php if (have_posts()) : ?>

<section id="search_keyword" class="sec sec_search">
	<div class="inner_base">
		<div class="sec_title">
			<div class="main_title">Search</div>
			<h1 class="main_title_jp">「<span class="search_que"><?php the_search_query(); ?></span>」の検索結果</h1>
		</div>

		<div class="content_article">
			<div class="wrap_article_middle grid articleListStyle">
				<?php while (have_posts()) : the_post(); ?>
				<!-- 5/21 一部変更 黒澤 -->
				<?php require 'small_comp.php'; ?>
				<!-- 5/21 一部変更 黒澤 ここまで -->
				<?php endwhile; ?>
			</div>
		</div><!-- /.content_article -->
	</div><!-- /.inner_base-->

	<?php
	$max_page = $wp_query->max_num_pages;
	if ($max_page != 1) :
	?>

	<div class="pagerArea inner_base">
		<?php global $wp_rewrite;
		$paginate_base = get_pagenum_link(1);
		if (strpos($paginate_base, '?') || !$wp_rewrite->using_permalinks()) {
			$paginate_format = '';
			$paginate_base = add_query_arg('paged', '%#%');
		} else {
			$paginate_format = (substr($paginate_base, -1, 1) == '/' ? '' : '/') . user_trailingslashit('page/%#%/', 'paged');
			$paginate_base .= '%_%';
		}
		echo paginate_links(array(
			'base' => $paginate_base,
			'format' => $paginate_format,
			'total' => $wp_query->max_num_pages,
			'end_size' => 1,
			'mid_size' => 1,
			'current' => ($paged ? $paged : 1),
		));
		?>
	</div><!--pagerArea-->

	<?php endif; ?>
</section>

<?php else : /* else have_posts */ ?>
	<div id="notFound" class="articleNotFound">
		<div class="inner_base">
			<div class="search_not_large">「<?php the_search_query(); ?>」と一致する記事は見つかりません。</div>
				<div class="search_not_small">別のキーワードでお探しください。</div>
			</div>
		</div><!--notfound-->
<?php endif;/* end have_posts */ ?>
<?php get_footer(); ?>