<?php
global $wpdb;
global $pagerGetName, $taxonomy_name, $post_type, $nowPaged, $pageNum_tax, $pageNum_article;

$taxSql = "SELECT * 
    FROM ".$wpdb->prefix."term_taxonomy AS tt 
    LEFT JOIN ".$wpdb->prefix."terms AS t 
    ON t.term_id = tt.term_id 
    WHERE tt.taxonomy = '".$taxonomy_name."' AND tt.count > 0
    ORDER BY t.term_order ASC";

$taxSqlResult = $wpdb->get_results($wpdb->prepare($taxSql));
//preDump($taxSqlResult);


$max_page = ceil(count($taxSqlResult) / $pageNum_tax);
//echo (count($taxSqlResult) / $pageNum_tax).'<br />MAX:'.$max_page;

if($max_page != 1):
$paginate_base = preg_replace('/(\?|&)pg=[0-9]{1,4}/i','',get_pagenum_link(1));
?>
<div class="pagerArea inner_base">
	<?php
	echo paginate_links( array(
		'base' => $paginate_base.'%_%',
		'format' => '?pg=%#%',
		'total' => $max_page,
		'end_size' => 1,
		'mid_size' => 1,
		'current' => ($nowPaged ? $nowPaged : 1),
	));
	?>
</div><!--pagerArea-->

<?php endif; ?>