<?php
/**
 * Template Name: シリーズ一覧
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
// アーカイブ設定
// --------------------------------------------
// ページャーGET値
$pagerGetName = 'pg';
// タクソノミー
$taxonomy_name = 'series';
// ポストタイプ
$post_type = 'articles';
// 現在ページ
$nowPaged = (!empty($_GET[$pagerGetName]))? $_GET[$pagerGetName] : 1;
// 1ページの表示件数（タクソノミー）
$pageNum_tax = 10;
// タクソノミーごとの記事表示件数
$pageNum_article = 2;

?>

<input type="hidden" id="postType" name="postType" value="<?php echo $post_type; ?>" />
<input type="hidden" id="taxonomy" name="taxonomy" value="<?php echo $taxonomy_name; ?>" />
<input type="hidden" id="paged" name="paged" value="<?php echo $nowPaged; ?>" />
<input type="hidden" id="pagedGetName" name="pagedGetName" value="<?php echo $pagerGetName; ?>" />
<input type="hidden" id="postPerPage" name="postPerPage" value="<?php echo $pageNum_tax; ?>" />
<input type="hidden" id="postPerPage_article" name="postPerPage_article" value="<?php echo $pageNum_article; ?>" />

<section id="page_series" class="sec sec_column">
	<div class="inner_base">
		<h2 class="title_thin">
			<span class="title_thin_img white">
				<h2>シリーズ</h2>
			</span>
		</h2>
		<p class="title_thin_subtitle">「シリーズ（連載コラム）」をまとめました。</p>
		<p class="title_thin_subtitle_s mb-50">短期で取り組む完結型の集中連載は「特集」としてまとめていきます。</p>

		<div id="seriesArchive">
			<?php get_template_part('inc/layout_series_taxArchive'); ?>
		</div><!-- seriesArchive -->

		<div id="seriesArchivePager">
			<?php get_template_part('inc/layout_page_taxArchive_pager'); ?>
		</div><!-- seriesArchivePager -->

	</div>
</section>


<?php endwhile; endif; ?>


<?php get_footer(); ?>