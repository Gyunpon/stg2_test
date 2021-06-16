<!DOCTYPE html>
<html lang="ja">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="format-detection" content="telephone=no" />
	
	<?php if(is_tablet()): ?>
	<meta name="viewport" content="width=1200" />
	<?php else: ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<?php endif; ?>
	
	<?php if(is_home() || is_front_page()): ?>
	<title><?php bloginfo("name"); ?></title>
	<?php else: ?>
	<title><?php wp_title(); ?></title>
	<?php endif; ?>
	
	
	<!-- base -->
	<script src="//code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<!-- animation -->
	<link href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css" rel="stylesheet">
	<script src="//cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
	<!-- UIkit CSS -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/uikit@3.2.3/dist/css/uikit.min.css" />
	<!-- UIkit JS -->
	<script src="//cdn.jsdelivr.net/npm/uikit@3.2.3/dist/js/uikit.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/uikit@3.2.3/dist/js/uikit-icons.min.js"></script>
	<!-- 環境移行時に差し替え -->
	<script src="//kit.fontawesome.com/55b5b4c129.js" crossorigin="anonymous"></script>
	<!-- base -->
	<link href="<?php echo get_template_directory_uri(); ?>/css/reset.min.css" rel="stylesheet" media="all" />
	<link href="<?php echo get_template_directory_uri(); ?>/css/all.min.css" rel="stylesheet" media="all" />
	<script src="<?php echo get_template_directory_uri(); ?>/js/function.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/common.js"></script>
	

	<!-- add -->
	<link href="//fonts.googleapis.com/css?family=Noto+Sans+JP:400,500,700&display=swap" rel="stylesheet"> 
	
	<?php if(is_home() || is_front_page()): ?>
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/top.min.css" rel="stylesheet" media="all" />
	
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/libs/slick.min.js"></script>
	
	<link href="<?php echo get_template_directory_uri(); ?>/css/slick.css" rel="stylesheet" media="all" />
	<script src="<?php echo get_template_directory_uri(); ?>/js/top.js"></script>
	<?php else: ?>
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/lower1.min.css" rel="stylesheet" media="all" />
	<?php endif; ?>
	
	<?php if(is_singular('articles')||is_post_type_archive('articles')): ?>
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/article.min.css" rel="stylesheet" media="all" />
	<?php endif; ?>
	<?php if(is_singular('articles')): ?>
	<script type="text/javascript" src='<?php bloginfo('url'); ?>/wp-includes/js/comment-reply.min.js'></script>
	<link href="<?php echo get_template_directory_uri(); ?>/css/comments.css" rel="stylesheet" media="all" />
	<script src="<?php echo get_template_directory_uri(); ?>/js/comments.js"></script>
	<?php endif; ?>
	
	<?php if(is_page('agenda')||is_tax('agenda')): ?>
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/agenda.min.css" rel="stylesheet" media="all" />
	<?php endif; ?>
	
	<?php if(is_page('series')||is_tax('series')): ?>
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/agenda.min.css" rel="stylesheet" media="all" />
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/column.min.css" rel="stylesheet" media="all" />
	<?php endif; ?>
	
	<?php if(is_page('donation')||is_404()): ?>
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/donation.min.css" rel="stylesheet" media="all" />
	<?php endif; ?>
	
	<?php if(is_page(array('register','login','password-reset'))): ?>
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/join.min.css" rel="stylesheet" media="all" />
	<?php endif; ?>
	<?php if(is_page('renewers')||is_page_template('page-templates/renewers_detail.php')): ?>
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/renewer.min.css" rel="stylesheet" media="all" />
	<?php endif; ?>
	<?php if(is_page('privacypolicy')): ?>
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/privacy.min.css" rel="stylesheet" media="all" />
	<?php endif; ?>
	
	<?php if(is_404()): ?>
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/error.min.css" rel="stylesheet" media="all" />
	<?php endif; ?>
	
	<link href="<?php echo get_template_directory_uri(); ?>/css/add.css" rel="stylesheet" media="all" />
	
	<!-- info -->
	<link href="<?php echo get_template_directory_uri(); ?>/css/information.css" rel="stylesheet" media="all" />
	
	<script src="<?php echo get_template_directory_uri(); ?>/js/libs/imgLiquid-min.js"></script>
	
	
	<!-- SNSシェアボタン -->
	<!-- TW -->
	<script>
		window.twttr=(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],t=window.twttr||{};if(d.getElementById(id))return;js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);t._e=[];t.ready=function(f){t._e.push(f);};return t;}(document,"script","twitter-wjs"));
	</script>
	<!-- FB -->
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.0";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
	<!-- LINE -->
	<!-- INSTA -->
	<!-- hatena -->
	<script type="text/javascript" src="https://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async">
		{lang: "ja"}
	</script>
	
	<?php wp_head(); ?>
	
</head>

	<body <?php if(is_page('series')){echo 'id="column"';}elseif(is_tax('series')){echo 'id="ajenda_detail"';}elseif(is_page_template('page-templates/renewers_detail.php')){echo 'id="renewer_detail"';} ?>>
		

	<div class="wrapper" id="wrap">
		<header>
			<div class="inner_base flex">
				<div class="logo_header">
					<a href="<?php echo network_home_url(); ?>">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="109px" height="26px" viewBox="0 0 109 26" version="1.1">
							<title>logo RENEWS</title>
							<g id="symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<g transform="translate(-140.000000, -8.000000)" fill="#2C76A4">
									<g transform="translate(140.000000, 0.000000)">
										<g transform="translate(0.000000, 8.000000)">
											<path d="M103.3902,20.1055 C101.4172,20.1055 99.3762,19.2835 97.7912,17.8495 L97.6062,17.6815 L98.9502,16.1985 L99.1352,16.3665 C100.3502,17.4665 101.9012,18.0975 103.3892,18.0975 C103.9852,18.0975 104.5362,17.9935 104.9832,17.7945 C105.7522,17.4525 106.1432,16.9005 106.1432,16.1545 C106.1432,14.8445 105.1452,14.4485 102.8682,13.8555 C100.9232,13.3505 98.2602,12.6585 98.2602,9.8425 C98.2602,8.3165 99.0782,7.0615 100.5022,6.3995 C101.2062,6.0715 102.0412,5.8985 102.9142,5.8985 C104.6342,5.8985 106.3752,6.5345 107.6932,7.6425 L107.8842,7.8035 L106.5972,9.3345 L106.4062,9.1735 C105.4462,8.3655 104.1792,7.9025 102.9332,7.9025 C102.3312,7.9025 101.7832,8.0095 101.3462,8.2125 C100.6162,8.5515 100.2602,9.0845 100.2602,9.8425 C100.2602,10.9265 101.0362,11.3125 103.3692,11.9185 C105.3842,12.4435 108.1432,13.1605 108.1432,16.1545 C108.1432,17.6955 107.2862,18.9595 105.7932,19.6235 C105.0702,19.9435 104.2612,20.1055 103.3902,20.1055" id="Fill-8" />
											<polygon id="Fill-6" points="89.6275 20 86.1435 9.412 82.6635 20 80.7485 20 76.1435 6 78.2225 6 81.7055 16.588 85.1855 6 87.1005 6 90.5835 16.588 94.0635 6 96.1435 6 91.5425 20" />
											<polygon id="Fill-1" points="58 12 58 25.9996 74.999 25.9996 74.999 24.0006 60 24.0006 60 19.9996 74.999 19.9996 74.999 17.9996 60 18 60 14.0006 74.999 14.0006 74.999 12" />
											<polygon id="Fill-3" points="52.9277 20 43.9997 9.164 43.9997 20 41.9997 20 41.9997 6 44.0727 6 52.9997 16.836 52.9997 6 54.9997 6 54.9997 20" />
											<polygon id="Fill-2" points="21.9996 -0.0001 21.9996 13.9999 38.9996 13.9999 38.9996 11.9999 24.0006 11.9999 24.0006 7.9999 38.9996 7.9999 38.9996 5.9999 24.0006 5.9999 24.0006 1.9999 38.9996 1.9999 38.9996 -0.0001" />
											<path d="M12,12 C14.757,12 17,9.757 17,7 C17,4.243 14.757,2 12,2 L2,2 L2,12 L12,12 Z M16.728,20 L12.059,13.997 L2,14 L2,20 L0,20 L0,0 L12,0 C15.859,0 19,3.141 19,7 C19,9.972 17.081,12.639 14.291,13.609 L19.261,20 L16.728,20 Z" id="Fill-4" />
										</g>
									</g>
								</g>
							</g>
						</svg>
					</a>
				</div>


				<nav class="nav_header">
					<ul class="list_nav_header flex">
						<li class="item_nav_header"><a href="<?php echo network_home_url(); ?>article/" class="target_nav_header">新着</a></li>
						<li class="item_nav_header"><a href="<?php echo network_home_url(); ?>agenda/" class="target_nav_header">アジェンダ</a></li>
						<li class="item_nav_header"><a href="<?php echo network_home_url(); ?>series/" class="target_nav_header">シリーズ</a></li>
						<li class="item_nav_header"><a href="<?php echo network_home_url(); ?>renewers/" class="target_nav_header kana">リニュアー</a></li>
						<li class="item_nav_header"><a href="<?php echo network_home_url(); ?>about/" class="target_nav_header">リニューズとは</a></li>
					</ul>
				</nav>


				<div id="headerShareLinkBtn"><a href="#headerShareLink" uk-toggle><img src="<?php echo get_template_directory_uri(); ?>/images/icons/share.svg" alt="" /></a></div>

				<div id="headerShareLink" class="uk-flex-top" uk-modal>
					<div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
						<?php 
						//元となるテキスト
						$text = 'RENEWS | ';
						$siteURL = rawurlencode(home_url());
						//URLエンコード処理
						$encoded = rawurlencode( $text ) ;
						?>
						<button class="uk-modal-close-default" type="button" uk-close></button>
						<p class="shareBtnTitle"><img src="<?php echo get_template_directory_uri(); ?>/images/about/about.png" alt="RENEWS" /><span>をシェアする</span></p>
						<ul class="shareBtnList">
							<li><a href="//twitter.com/share?url=<?php echo home_url(); ?>&text=<?php echo $encoded; ?>" class="shareBtn twitter share_popup" target="_blank"><i class="fab fa-twitter"></i><span>Twitter</span></a></li>
							<li><a href="//www.facebook.com/sharer/sharer.php?u=<?php echo $siteURL; ?>" class="shareBtn facebook share_popup" target="_blank"><i class="fab fa-facebook-square"></i><span>Facebook</span></a></li>
							<li><a href="//social-plugins.line.me/lineit/share?url=<?php echo $siteURL; ?>" class="shareBtn line share_popup" target="_blank"><i class="fab fa-line"></i><span>LINE</span></a></li>
							<li><a href="http://b.hatena.ne.jp/add?mode=confirm&url=<?php echo $siteURL; ?>&title=<?php echo $encoded; ?>" class="shareBtn hatena share_popup" target="_blank" rel="nofollow"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/hatena_wh.svg" alt="" /><span>はてなブックマーク</span></a></li>
						</ul>
					</div>
				</div>
				<div class="search__box">

					<a class="uk-button uk-button-default" href="#modal-center" uk-toggle>
						<img src="<?php echo get_template_directory_uri(); ?>/images/common/icon_search.svg" alt="" width="12">
					</a>

					<div id="modal-center" class="uk-flex-top" uk-modal>
						<div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

							<button class="uk-modal-close-default" type="button" uk-close></button>

							<div class="search-box for_sp">
								<form role="search" method="get" id="searchform_sp" class="search-form" action="<?php echo network_home_url(); ?>">
									<input type="text" placeholder="検索する" name="s" id="search_sp" autocomplete="off">
									<button id="searchsubmit_sp" class="search__btn"></button>
								</form>
							</div>

						</div>
					</div>

					<div class="search-box for_pc">
						<form role="search" method="get" id="searchform" class="search-form" action="<?php echo network_home_url(); ?>">
							<input type="text" placeholder="検索する" name="s" id="search" autocomplete="off">
							<button id="searchsubmit" class="search__btn"></button>
						</form>
						<svg class="search-border" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
								 xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" x="0px" y="0px" viewBox="0 0 671 111"
								 style="enable-background:new 0 0 671 111;" xml:space="preserve">
							<path class="border" d="M335.5,108.5h-280c-29.3,0-53-23.7-53-53v0c0-29.3,23.7-53,53-53h280" />
							<path class="border" d="M335.5,108.5h280c29.3,0,53-23.7,53-53v0c0-29.3-23.7-53-53-53h-280" />
						</svg>
					</div>

				</div>

				<div class="sign_in for_pc">
					<?php if( is_user_logged_in() ) : ?>
					<div class="user_avatar">
						<?php 
						$user = wp_get_current_user();
						//var_dump($user);
						?>
						<a href="<?php echo network_home_url(); ?>account/">
							<span class="uk-badge badge_btn_sp_menu"><?php echo do_shortcode('[ultimatemember_notification_count]'); ?></span>
							<div class="userIcon"><?php echo get_avatar($user->get('ID'), 64); ?></div>
						</a>
					</div>
					<?php else: ?>
					<a href="<?php echo home_url(); ?>/login/">ログイン</a>
					<?php endif; ?>
				</div>


			</div>


			<nav role="navigation" class="sp_menu">
				<div class="inner_sp_menu">
					<div id="menuToggle">
						<p class="uk-badge badge_btn_sp_menu">1</p>

						<input type="checkbox" class="triger_btn_sp">

						<span class="ic_menu"></span>
						<span class="ic_menu"></span>
						<span class="ic_menu"></span>

						<section id="menu">

							<div class="inner_menu_sp">
								<div class="item_menu_sp">
									<a href="<?php echo network_home_url(); ?>article/">新着</a>
								</div>
								<div class="item_menu_sp">
									<a href="<?php echo network_home_url(); ?>agenda/">アジェンダ</a>
								</div>
								<div class="item_menu_sp">
									<a href="<?php echo network_home_url(); ?>series/">シリーズ</a>
								</div>
								<div class="item_menu_sp">
									<a href="<?php echo network_home_url(); ?>renewers/">リニュアー</a>
								</div>
								<div class="item_menu_sp">
									<a href="<?php echo network_home_url(); ?>about/">リニューズとは</a>
								</div>

								<?php if( is_user_logged_in() ) : ?>
								<?php 
								$user = wp_get_current_user();
								?>
								<div class="flex list_mypage">
									<a href="<?php echo network_home_url(); ?>account/">マイページ</a>
									<div class="user_avatar">
										<a href="<?php echo network_home_url(); ?>account/">
											<span class="uk-badge badge_mypage_sp_menu"><?php echo do_shortcode('[ultimatemember_notification_count]'); ?></span>
											<div class="userIcon"><?php echo get_avatar($user->get('ID'), 64); ?></div>
										</a>
									</div>
								</div>
								<div class="item_menu_sp">
									<a href="<?php echo network_home_url(); ?>logout/">ログアウト</a>
								</div>
								<?php else: ?>
								<div class="item_menu_sp">
									<a href="<?php echo network_home_url(); ?>login/">ログイン</a>
								</div>
								<?php endif; ?>
							

								<div class="footer_bottom flex">
									<ul class="social flex">
										<li class="social_button">
											<a href="" target="_blank">
												<i class="fab fa-twitter"></i>
											</a>
										</li>
										<li class="social_button">
											<a href="" target="_blank">
												<i class="fab fa-facebook-f"></i>
											</a>
										</li>
										<li class="social_button">
											<a href="" target="_blank">
												<i class="fab fa-instagram"></i>
											</a>
										</li>
									</ul>

									<p class="text_copyright">
										&copy; Renews inc. 2020
									</p>
								</div>
							</div>

						</section>


					</div>
				</div>
			</nav>
		</header>

		<main class="main">
			<div class="wrap_content">
				<article class="content">