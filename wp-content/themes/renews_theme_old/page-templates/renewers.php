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
		<p class="title_thin_subtitle">Renewsのコンテンツを支える専門家、Renewer（リニュアー）をまとめました。</p>

		<?php echo do_shortcode( '[ultimatemember form_id="22"]' ) ?>
	</div>
</section>
	

<!--
<section class="sec sec_renewer">
	<div class="inner_base">
		<h2 class="title_thin">
			<span class="title_thin_img beige">
				<h2>リニュアー</h2>
			</span>
		</h2>
		
		<ul class="slider_renewer flex">
			<li class="renewer uk-transition-toggle" tabindex="0">
				<a href="./detail/" class="inner_renewer">
					<div class="avatar_renewer_wrapper">
						<div class="avatar_renewer">
							<img
									 src="<?php echo get_template_directory_uri(); ?>/images/common/thumbs/img_renewer02.png"
									 alt="リニュアーアバター"
									 width="100"
									 />
						</div>

						<h3 class="name_renewer bold">
							井上 理
							<span class="handle_name">@osamu</span>
							<span class="category_renewer">
								ジャーナリスト／リニューズ代表取締役
							</span>
						</h3>
					</div>

					<div class="wrap_text_renewer">
						<p class="text_renewer">
							同級生の一人が冗談に、いくら威張っても、そこから飛び降りる事は出来まい。
						</p>
					</div>

					<div class="wrap_switch">
						<span class="switch-button" id="switch1">
							<i class="switch"></i>
						</span>
					</div>
				</a>
			
			</li>

		</ul>
	</div>
</section>
-->
	
	
</div><!-- renewer -->
	
	<?php endwhile; endif; ?>

<?php get_footer(); ?>