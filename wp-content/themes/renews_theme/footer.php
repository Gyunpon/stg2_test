<?php if(!is_page('about')): ?>
</article>
</div>
<?php endif; ?>
<!-- /.conatiner -->
</main>

<footer id="footer">
	<div class="inner_footer">
		<!--
		<div class="logo_footer">
			<a href="<?php echo home_url(); ?>/">
				<svg
						 version="1.1"
						 id="Layer_1"
						 xmlns="http://www.w3.org/2000/svg"
						 xmlns:xlink="http://www.w3.org/1999/xlink"
						 width="109px"
						 height="26px"
						 viewBox="0 0 109 26"
						 version="1.1"
						 style="enable-background:new 0 0 108.1 22;"
						 xml:space="preserve"
						 >
					<title>logo RENEWS</title>
					<style type="text/css">
						.st0 {
							fill: #2c76a4;
						}
					</style>
					<g>
						<polygon class="st0" points="58,22 58,8 75,8 75,10 60,10 60,14 75,14 75,16 60,16 60,20 75,20 75,22" />
						<polygon class="st0" points="22,14 22,0 39,0 39,2 24,2 24,6 39,6 39,8 24,8 24,12 39,12 39,14" />
						<polygon class="st0" points="52.9,18 44,7.2 44,18 42,18 42,4 44.1,4 53,14.8 53,4 55,4 55,18" />
						<polygon class="st0" points="89.6,18 86.1,7.4 82.7,18 80.7,18 76.1,4 78.2,4 81.7,14.6 85.2,4 87.1,4 90.6,14.6 94.1,4 96.1,4 91.5,18" />
						<path class="st0" d="M103.4,18.1c-2,0-4-0.8-5.6-2.3l-0.2-0.2l1.3-1.5l0.2,0.2c1.2,1.1,2.8,1.7,4.3,1.7c0.6,0,1.1-0.1,1.6-0.3 c0.8-0.3,1.2-0.9,1.2-1.6c0-1.3-1-1.7-3.3-2.3c-1.9-0.5-4.6-1.2-4.6-4c0-1.5,0.8-2.8,2.2-3.4c0.7-0.3,1.5-0.5,2.4-0.5 c1.7,0,3.5,0.6,4.8,1.7l0.2,0.2l-1.3,1.5l-0.2-0.2c-1-0.8-2.2-1.3-3.5-1.3c-0.6,0-1.2,0.1-1.6,0.3c-0.7,0.3-1.1,0.9-1.1,1.6 c0,1.1,0.8,1.5,3.1,2.1c2,0.5,4.8,1.2,4.8,4.2c0,1.5-0.9,2.8-2.3,3.5C105.1,17.9,104.3,18.1,103.4,18.1z" />
						<path class="st0" d="M14.5,11.8c2.6-0.7,4.5-3,4.5-5.8c0-3.3-2.7-6-6-6H0v12v6h2v-6h10.1l4.7,6h2.5L14.5,11.8z M2,10V2h11 c2.2,0,4,1.8,4,4s-1.8,4-4,4H2z" />
					</g>
				</svg>
			</a>
		</div>
		-->
		<!-- /.logo_footer -->


		<!--
		<div class="wrap_sitemap flex for_pc">
			<ul class="sitemap flex">
				<li class="item_sitemap">
					<a href="<?php echo home_url(); ?>/info/" class="target_sitemap">
						????????????
					</a>
				</li>
				<?php if( !is_user_logged_in() ) : ?>

				<li class="item_sitemap">
					<a href="<?php echo home_url(); ?>/register/" class="target_sitemap">
						??????????????????
					</a>
				</li>

				<?php endif; ?>
				<li class="item_sitemap">
					<a href="<?php echo home_url(); ?>/info/policy/" class="target_sitemap">
						??????????????????????????????
					</a>
				</li>
				<li class="item_sitemap">
					<a href="<?php echo home_url(); ?>/info/terms/" class="target_sitemap">
						????????????
					</a>
				</li>
				<li class="item_sitemap">
					<a href="<?php echo home_url(); ?>/info/contact/" class="target_sitemap">
						?????????????????????????????????
					</a>
				</li>
				<li class="item_sitemap">
					<a href="<?php echo home_url(); ?>/about/?move=company" class="target_sitemap">
						????????????
					</a>
				</li>
				<?php if(is_user_logged_in()): ?>
				<li class="item_sitemap">
					<a href="<?php echo home_url(); ?>/logout/" class="target_sitemap">
						???????????????
					</a>
				</li>
				<?php endif; ?>
			</ul>
		</div>
		-->
		<!-- /.wrap_sitemap -->

		<!--
		<div class="wrap_sitemap flex for_sp">
			<ul class="sitemap flex">
				<li class="item_sitemap">
					<a href="<?php echo home_url(); ?>/info/" class="target_sitemap">
						????????????
					</a>
				</li>
				<?php if( !is_user_logged_in() ) : ?>

				<li class="item_sitemap">
					<a href="<?php echo home_url(); ?>/register/" class="target_sitemap">
						??????????????????
					</a>
				</li>

				<?php endif; ?>
				<li class="item_sitemap">
					<a href="<?php echo home_url(); ?>/info/policy/" class="target_sitemap">
						??????????????????????????????
					</a>
				</li>
			</ul>
			<ul class="sitemap flex">
				<li class="item_sitemap">
					<a href="<?php echo home_url(); ?>/info/terms/" class="target_sitemap">
						????????????
					</a>
				</li>
				<li class="item_sitemap">
					<a href="<?php echo home_url(); ?>/info/contact/" class="target_sitemap">
						?????????????????????????????????
					</a>
				</li>
				<li class="item_sitemap for_sp">
					<a href="<?php echo home_url(); ?>/about/" class="target_sitemap">
						?????????????????????
					</a>
				</li>
			</ul>
		</div>
		-->
		<!-- /.wrap_sitemap -->

		<!--
		<div class="footer_bottom flex">
			<div class="clearfix for_pc">
				<?php
				//????????????????????????
				$text = 'Renews | ';
				$siteURL = rawurlencode(home_url());
				//URL?????????????????????
				$encoded = rawurlencode( $text ) ;
				?>

				<div class="btn_share flex">
					<div class="share-btn twitter">
						<a href="//twitter.com/share?url=<?php echo home_url(); ?>&text=<?php echo $encoded; ?>" class="share_popup" target="_blank">
							<img src="<?php echo get_template_directory_uri(); ?>/images/icons/foot_tw.svg" alt="twitter" />
						</a>
					</div>
					<div class="share-btn facebook">
						<a href="//www.facebook.com/sharer/sharer.php?u=<?php echo $siteURL; ?>" class="share_popup" target="_blank">
							<img src="<?php echo get_template_directory_uri(); ?>/images/icons/foot_fb.svg" alt="facebook" />
						</a>
					</div>
					<div class="share-btn hatena">
						<a href="https://b.hatena.ne.jp/add?mode=confirm&url=<?php echo $siteURL; ?>&title=<?php echo $encoded; ?>" class="for_pc share_popup" target="_blank" rel="nofollow">
							<img src="<?php echo get_template_directory_uri(); ?>/images/icons/foot_hatena.svg" alt="hatena" />
						</a>
						<a href="https://b.hatena.ne.jp/entry/<?php echo $siteURL; ?>" data-hatena-bookmark-initialized="1" data-hatena-bookmark-title="<?php echo $encoded; ?>" data-hatena-bookmark-layout="simple" class="for_sp share_popup" target="_blank">
							<img src="<?php echo get_template_directory_uri(); ?>/images/icons/foot_hatena.svg" alt="hatena" />
						</a>
					</div>
				</div><!-- /.btn_share -->
			</div>


			<a href="<?php echo home_url(); ?>/">
						<svg
								 version="1.1"
								 id="Layer_1"
								 xmlns="http://www.w3.org/2000/svg"
								 xmlns:xlink="http://www.w3.org/1999/xlink"
								 width="109px"
								 height="26px"
								 viewBox="0 0 109 26"
								 version="1.1"
								 style="enable-background:new 0 0 108.1 22;"
								 xml:space="preserve"
								 >
							<title>Renews ???????????????</title>
							<style type="text/css">
								.st0 {
									fill: #2c76a4;
								}
							</style>
							<g>
								<polygon class="st0" points="58,22 58,8 75,8 75,10 60,10 60,14 75,14 75,16 60,16 60,20 75,20 75,22 	" />
								<polygon class="st0" points="22,14 22,0 39,0 39,2 24,2 24,6 39,6 39,8 24,8 24,12 39,12 39,14 	" />
								<polygon class="st0" points="52.9,18 44,7.2 44,18 42,18 42,4 44.1,4 53,14.8 53,4 55,4 55,18 	" />
								<polygon class="st0" points="89.6,18 86.1,7.4 82.7,18 80.7,18 76.1,4 78.2,4 81.7,14.6 85.2,4 87.1,4 90.6,14.6 94.1,4 96.1,4  91.5,18 	" />
								<path class="st0" d="M103.4,18.1c-2,0-4-0.8-5.6-2.3l-0.2-0.2l1.3-1.5l0.2,0.2c1.2,1.1,2.8,1.7,4.3,1.7c0.6,0,1.1-0.1,1.6-0.3 c0.8-0.3,1.2-0.9,1.2-1.6c0-1.3-1-1.7-3.3-2.3c-1.9-0.5-4.6-1.2-4.6-4c0-1.5,0.8-2.8,2.2-3.4c0.7-0.3,1.5-0.5,2.4-0.5 c1.7,0,3.5,0.6,4.8,1.7l0.2,0.2l-1.3,1.5l-0.2-0.2c-1-0.8-2.2-1.3-3.5-1.3c-0.6,0-1.2,0.1-1.6,0.3c-0.7,0.3-1.1,0.9-1.1,1.6 c0,1.1,0.8,1.5,3.1,2.1c2,0.5,4.8,1.2,4.8,4.2c0,1.5-0.9,2.8-2.3,3.5C105.1,17.9,104.3,18.1,103.4,18.1z" />
								<path class="st0" d="M14.5,11.8c2.6-0.7,4.5-3,4.5-5.8c0-3.3-2.7-6-6-6H0v12v6h2v-6h10.1l4.7,6h2.5L14.5,11.8z M2,10V2h11 c2.2,0,4,1.8,4,4s-1.8,4-4,4H2z" />
							</g>
						</svg>
					</a>

			<p class="text_copyright">
				&copy; Renews inc. 2021
			</p>
		</div>
	</div>

</footer>

</div>
<!-- /.wrapper -->



<!-- ?????????????????????????????? -->
<?php
// if(!empty($_GET['act']) && $_GET['act'] != 'reset_password'):
?>
<div id="modalLoginWrap" class="mfp-hide">
	<div id="modalLogin">
		<div id="modalLoginHead" class="mypageHead shadow">
			<p class="modalClose popup-modal-dismiss"><a href="javascript:void(0);">??</a></p>
			<div class="roundTitleWrap">
				<h1 class="roundTitle">????????????</h1>
			</div>
<!--
			<div class="text_read">
				??????????????????????????????????????????<a href="<?php echo home_url(); ?>/register/">??????????????????</a>
			</div>
-->
		</div><!-- modalLoginHead -->
		<div id="modalLoginContent">
			<?php echo do_shortcode( '[ultimatemember form_id="10"]' ); ?>
		</div><!-- modalLoginInner -->
	</div><!-- modalLogin -->
</div><!-- modalLoginWrap -->
<?php
// 	endif;
?>


<!-- ???????????????????????? -->
<!-- <?php //if(is_home() || is_front_page()): ?>
<?php //if ($_SERVER['REMOTE_ADDR'] == "115.179.101.53"): ?>
	<div id="loaderWrap">
		<div id="loader-bg">
			<div class="inner_loader">
				<div id="loader">
					<div class="spinner">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="109px" height="26px" viewBox="0 0 109 26" version="1.1" >
							<title>logo RENEWS</title>
							<g>
							<polygon class="st0" points="58,22 58,8 75,8 75,10 60,10 60,14 75,14 75,16 60,16 60,20 75,20 75,22 	" />
							<polygon class="st0" points="22,14 22,0 39,0 39,2 24,2 24,6 39,6 39,8 24,8 24,12 39,12 39,14 	" />
							<polygon class="st0" points="52.9,18 44,7.2 44,18 42,18 42,4 44.1,4 53,14.8 53,4 55,4 55,18 	" />
							<polygon class="st0" points="89.6,18 86.1,7.4 82.7,18 80.7,18 76.1,4 78.2,4 81.7,14.6 85.2,4 87.1,4 90.6,14.6 94.1,4 96.1,4  91.5,18 	" />
							<path class="st0" d="M103.4,18.1c-2,0-4-0.8-5.6-2.3l-0.2-0.2l1.3-1.5l0.2,0.2c1.2,1.1,2.8,1.7,4.3,1.7c0.6,0,1.1-0.1,1.6-0.3 c0.8-0.3,1.2-0.9,1.2-1.6c0-1.3-1-1.7-3.3-2.3c-1.9-0.5-4.6-1.2-4.6-4c0-1.5,0.8-2.8,2.2-3.4c0.7-0.3,1.5-0.5,2.4-0.5 c1.7,0,3.5,0.6,4.8,1.7l0.2,0.2l-1.3,1.5l-0.2-0.2c-1-0.8-2.2-1.3-3.5-1.3c-0.6,0-1.2,0.1-1.6,0.3c-0.7,0.3-1.1,0.9-1.1,1.6 c0,1.1,0.8,1.5,3.1,2.1c2,0.5,4.8,1.2,4.8,4.2c0,1.5-0.9,2.8-2.3,3.5C105.1,17.9,104.3,18.1,103.4,18.1z" />
							<path class="st0" d="M14.5,11.8c2.6-0.7,4.5-3,4.5-5.8c0-3.3-2.7-6-6-6H0v12v6h2v-6h10.1l4.7,6h2.5L14.5,11.8z M2,10V2h11 c2.2,0,4,1.8,4,4s-1.8,4-4,4H2z" />
							</g>
						</svg>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php //endif; ?>
<?php //endif; ?> -->

	<?php wp_footer(); ?>

<!----- lazy load ----->
<!--
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/yakuhanjp@3.4.1/dist/css/yakuhanmp-noto.min.css" media="all" />
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP:300,400,500,700&display=swap" rel="stylesheet" media="all" />
<link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;500;600;700&display=swap" rel="stylesheet" media="all" />


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/yakuhanjp@3.4.1/dist/css/yakuhanmp-noto.min.css" media="print" onload="this.media='all'">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+JP:300,400,500,700&display=swap" media="print" onload="this.media='all'" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;500;600;700&display=swap" media="print" onload="this.media='all'" />
-->

</body>
</html>
