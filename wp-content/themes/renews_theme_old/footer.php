<?php if(!is_page('about')): ?>
</article>
</div>
<?php endif; ?>
<!-- /.conatiner -->
</main>

<footer>
	<div class="inner_footer">
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
						<polygon
										 class="st0"
										 points="58,22 58,8 75,8 75,10 60,10 60,14 75,14 75,16 60,16 60,20 75,20 75,22 	"
										 />
						<polygon
										 class="st0"
										 points="22,14 22,0 39,0 39,2 24,2 24,6 39,6 39,8 24,8 24,12 39,12 39,14 	"
										 />
						<polygon
										 class="st0"
										 points="52.9,18 44,7.2 44,18 42,18 42,4 44.1,4 53,14.8 53,4 55,4 55,18 	"
										 />
						<polygon
										 class="st0"
										 points="89.6,18 86.1,7.4 82.7,18 80.7,18 76.1,4 78.2,4 81.7,14.6 85.2,4 87.1,4 90.6,14.6 94.1,4 96.1,4 
														 91.5,18 	"
										 />
						<path
									class="st0"
									d="M103.4,18.1c-2,0-4-0.8-5.6-2.3l-0.2-0.2l1.3-1.5l0.2,0.2c1.2,1.1,2.8,1.7,4.3,1.7c0.6,0,1.1-0.1,1.6-0.3
										 c0.8-0.3,1.2-0.9,1.2-1.6c0-1.3-1-1.7-3.3-2.3c-1.9-0.5-4.6-1.2-4.6-4c0-1.5,0.8-2.8,2.2-3.4c0.7-0.3,1.5-0.5,2.4-0.5
										 c1.7,0,3.5,0.6,4.8,1.7l0.2,0.2l-1.3,1.5l-0.2-0.2c-1-0.8-2.2-1.3-3.5-1.3c-0.6,0-1.2,0.1-1.6,0.3c-0.7,0.3-1.1,0.9-1.1,1.6
										 c0,1.1,0.8,1.5,3.1,2.1c2,0.5,4.8,1.2,4.8,4.2c0,1.5-0.9,2.8-2.3,3.5C105.1,17.9,104.3,18.1,103.4,18.1z"
									/>
						<path
									class="st0"
									d="M14.5,11.8c2.6-0.7,4.5-3,4.5-5.8c0-3.3-2.7-6-6-6H0v12v6h2v-6h10.1l4.7,6h2.5L14.5,11.8z M2,10V2h11
										 c2.2,0,4,1.8,4,4s-1.8,4-4,4H2z"
									/>
					</g>
				</svg>
			</a>
		</div>
		<!-- /.logo_footer -->

		<div class="wrap_sitemap flex">
			<div class="sitemap flex">
				<li class="item_sitemap">
					<a href="<?php echo home_url(); ?>/info/" class="target_sitemap">
						お知らせ
					</a>
				</li>
				<li class="item_sitemap">
					<a href="<?php echo home_url(); ?>/register/" class="target_sitemap">
						メンバー登録
					</a>
				</li>
				<li class="item_sitemap">
					<a href="<?php echo home_url(); ?>/info/policy/" class="target_sitemap">
						プライバシーポリシー
					</a>
				</li>
				<li class="item_sitemap">
					<a href="<?php echo home_url(); ?>/info/terms/" class="target_sitemap">
						利用規約
					</a>
				</li>
				<li class="item_sitemap">
					<a href="<?php echo home_url(); ?>/info/contact/" class="target_sitemap">
						情報提供／お問い合わせ
					</a>
				</li>
				<li class="item_sitemap">
					<a href="<?php echo home_url(); ?>/company/" class="target_sitemap">
						企業概要
					</a>
				</li>
			</div>
		</div>
		<!-- /.wrap_sitemap -->

		<div class="footer_bottom flex">
			<ul class="social flex">
				<?php 
				//元となるテキスト
				$text = 'RENEWS | ';
				$siteURL = rawurlencode(home_url());
				//URLエンコード処理
				$encoded = rawurlencode( $text ) ;
				?>
			
				<div class="share-btn twitter">
					<a href="//twitter.com/share?url=<?php echo home_url(); ?>&text=<?php echo $encoded; ?>" class="share_popup" target="_blank">
						<img src="<?php echo get_template_directory_uri(); ?>/images/icons/twitter.svg" alt="twitter" />
					</a>
				</div>
				<div class="share-btn facebook">
					<a href="//www.facebook.com/sharer/sharer.php?u=<?php echo $siteURL; ?>" class="share_popup" target="_blank">
						<img src="<?php echo get_template_directory_uri(); ?>/images/icons/fb.svg" alt="facebook" />
					</a>
				</div>
				<div class="share-btn line">
					<a href="//social-plugins.line.me/lineit/share?url=<?php echo $siteURL; ?>" class="share_popup" target="_blank">
						<img src="<?php echo get_template_directory_uri(); ?>/images/icons/line.svg" alt="line" />
					</a>
				</div>
				<div class="share-btn hatena">
					<a href="http://b.hatena.ne.jp/add?mode=confirm&url=<?php echo $siteURL; ?>&title=<?php echo $encoded; ?>" class="share_popup" target="_blank">
						<img src="<?php echo get_template_directory_uri(); ?>/images/icons/hatena.svg" alt="hatena" />
					</a>
				</div>
			</ul>

			<p class="text_copyright">
				&copy; Renews inc. 2020
			</p>
		</div>
	</div>

</footer>

</div>
<!-- /.wrapper -->



<?php if(is_home() || is_front_page()): ?>
<!-- ローディング画面 -->
<div id="loaderWrap">
	<div id="loader-bg">
		<div class="inner_loader">
			<div id="loader">
				<div class="spinner">
					<svg
							 xmlns="http://www.w3.org/2000/svg"
							 xmlns:xlink="http://www.w3.org/1999/xlink"
							 width="109px"
							 height="26px"
							 viewBox="0 0 109 26"
							 version="1.1"
							 >
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
				</div><!-- /.spinner -->
			</div><!-- /#loader -->
		</div><!-- /.inner_loader -->
	</div><!-- /#loader-bg -->
</div><!-- loaderWrap -->

<?php endif; ?>

	<?php wp_footer(); ?>
</body>
</html>