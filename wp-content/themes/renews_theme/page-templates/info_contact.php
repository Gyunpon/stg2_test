<?php
/**
 *Template Name: 情報提供／お問い合わせ
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
<div id="contents" class="<?php echo $pageSlug; ?> under">
	<?php if(have_posts()): while (have_posts()): the_post(); ?>
	<?php the_content(); ?>
	<?php endwhile; endif; ?>
</div><!--contents-->

<?php 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// Build POST request:
	$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
	$recaptcha_secret = '6LfQE_YUAAAAAJtWMxtsvkxtWBTKRU3qOaapIC_q'; // シークレットキー
	$recaptcha_response = $_POST['recaptcha_response'];

	// Make and decode POST request:
	$recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
	$recaptcha = json_decode($recaptcha);

	// Take action based on the score returned:
	if ($recaptcha->score >= 0.5) {
		// Verified - send email
	} else {
		// Not verified - show form error
	}

}
?>


<?php get_footer(); ?>