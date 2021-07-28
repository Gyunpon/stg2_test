<!DOCTYPE html>
<html lang="ja">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="format-detection" content="telephone=no" />
	
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-169936877-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', 'UA-169936877-1');
	</script>
	
	
	<!-- favicon -->
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon/favicon.ico" />
	<!-- apple-touch-icon -->
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon/apple-touch-icon.png" />
	
	<link rel="author" href="https://www.hatena.ne.jp/panda07/" />
	
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
<!--	<script src="//kit.fontawesome.com/55b5b4c129.js" crossorigin="anonymous"></script>-->
	<!-- base -->
	<link href="<?php echo get_template_directory_uri(); ?>/css/reset.min.css" rel="stylesheet" media="all" />
	<link href="<?php echo get_template_directory_uri(); ?>/css/all.min.css" rel="stylesheet" media="all" />
	<script src="<?php echo get_template_directory_uri(); ?>/js/function.js?date=20190401"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/common.js"></script>

	<link href="<?php echo get_template_directory_uri(); ?>/css/magnific-popup.css" rel="stylesheet" media="all" />
	<script src="<?php echo get_template_directory_uri(); ?>/js/libs/jquery.magnific-popup.min.js"></script>


	<!-- add -->
	<link href="//fonts.googleapis.com/css?family=Noto+Sans+JP:100,300,400,500,700&display=swap" rel="stylesheet">	
	<?php if(is_home() || is_front_page()): ?>
<!--	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/top.min.css" rel="stylesheet" media="all" />-->
	
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/libs/slick.min.js"></script>
	
	<link href="<?php echo get_template_directory_uri(); ?>/css/slick.css" rel="stylesheet" media="all" />
	<script src="<?php echo get_template_directory_uri(); ?>/js/top.js"></script>
	<?php else: ?>
	<?php endif; ?>

	<script src="https://www.google.com/recaptcha/api.js?render=6LfQE_YUAAAAAE0yo7a_spXYH3MliOmIRVAtC0kv"></script>
	<!--
	<script>
		grecaptcha.ready(function () {
			grecaptcha.execute('6LfQE_YUAAAAAE0yo7a_spXYH3MliOmIRVAtC0kv', { action: 'contact' }).then(function (token) {
				var recaptchaResponse = document.getElementById('mw_wp_form_token');
				recaptchaResponse.value = token;
			});
		});
	</script>
-->


	<?php if(is_page('policy')): ?>
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/privacy.min.css" rel="stylesheet" media="all" />
	<?php endif; ?>
	
	<?php if(is_404()): ?>
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/error.min.css" rel="stylesheet" media="all" />
	<?php endif; ?>
	
	<?php if(!is_front_page() && !is_archive() && !is_tag() && !is_single()): ?>
	<script src="<?php echo get_template_directory_uri(); ?>/js/about.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/contact.js"></script>
	<?php endif ; ?>

	<!-- info -->
	<?php if(is_front_page()||is_archive()||is_tag()): ?>
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/article.min.css" rel="stylesheet" media="all" />
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/top.min.css" rel="stylesheet" media="all" />
	<?php else: ?>
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/lower1.min.css" rel="stylesheet" media="all" />
	<?php endif ; ?>

	
	
	
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/privacy.min.css" rel="stylesheet" media="all" />
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/contact.min.css" rel="stylesheet" media="all" />

	

	<?php if(is_single()): ?>
<!--	<script src="<?php echo get_template_directory_uri(); ?>/js/article.js"></script>-->
	
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/top.min.css" rel="stylesheet" media="all" />
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/article.min.css" rel="stylesheet" media="all" />
	<link href="<?php echo get_template_directory_uri(); ?>/css/single.css" rel="stylesheet" media="all" />
	<link href="<?php echo get_template_directory_uri(); ?>/css/single-articles.css" rel="stylesheet" media="all" />
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/article.js"></script>
	<?php endif ; ?>
	

	<link href="<?php echo get_template_directory_uri(); ?>/css/add.css" rel="stylesheet" media="all" />

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

	<body <?php if(is_page('series')){echo 'id="column"';}elseif(is_tax('series')){echo 'id="ajenda_detail"';}elseif(is_page_template('page-templates/renewers_detail.php')){echo 'id="renewer_detail"';} if(!is_page('17')){echo ' class="grecaptchaHide"';} ?>>
		

		<div class="wrapper <?php  if(!is_user_logged_in()){echo ' noLogin';} ?> " id="wrap">
			<header>
				<div class="inner_base flex">

				<!-- For Top Page -->
				<!--<div class="logo_header">-->
				<<?php if(is_home() || is_front_page()|| is_page('index2')){echo 'h1';} else{echo 'div';} ?> class="logo_header">
					<p class="sub_title">世の中を“リニュー”しよう</p>
					<a href="<?php echo network_home_url(); ?>/">
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
							<title>Renews リニューズ</title>
							<style type="text/css">
								.st0_logo {
									fill: #2c76a4;
								}
							</style>
							<g>
								<polygon class="st0_logo" points="58,22 58,8 75,8 75,10 60,10 60,14 75,14 75,16 60,16 60,20 75,20 75,22 	" />
								<polygon class="st0_logo" points="22,14 22,0 39,0 39,2 24,2 24,6 39,6 39,8 24,8 24,12 39,12 39,14 	" />
								<polygon class="st0_logo" points="52.9,18 44,7.2 44,18 42,18 42,4 44.1,4 53,14.8 53,4 55,4 55,18 	" />
								<polygon class="st0_logo" points="89.6,18 86.1,7.4 82.7,18 80.7,18 76.1,4 78.2,4 81.7,14.6 85.2,4 87.1,4 90.6,14.6 94.1,4 96.1,4  91.5,18 	" />
								<path class="st0_logo" d="M103.4,18.1c-2,0-4-0.8-5.6-2.3l-0.2-0.2l1.3-1.5l0.2,0.2c1.2,1.1,2.8,1.7,4.3,1.7c0.6,0,1.1-0.1,1.6-0.3 c0.8-0.3,1.2-0.9,1.2-1.6c0-1.3-1-1.7-3.3-2.3c-1.9-0.5-4.6-1.2-4.6-4c0-1.5,0.8-2.8,2.2-3.4c0.7-0.3,1.5-0.5,2.4-0.5 c1.7,0,3.5,0.6,4.8,1.7l0.2,0.2l-1.3,1.5l-0.2-0.2c-1-0.8-2.2-1.3-3.5-1.3c-0.6,0-1.2,0.1-1.6,0.3c-0.7,0.3-1.1,0.9-1.1,1.6 c0,1.1,0.8,1.5,3.1,2.1c2,0.5,4.8,1.2,4.8,4.2c0,1.5-0.9,2.8-2.3,3.5C105.1,17.9,104.3,18.1,103.4,18.1z" />
								<path class="st0_logo" d="M14.5,11.8c2.6-0.7,4.5-3,4.5-5.8c0-3.3-2.7-6-6-6H0v12v6h2v-6h10.1l4.7,6h2.5L14.5,11.8z M2,10V2h11 c2.2,0,4,1.8,4,4s-1.8,4-4,4H2z" />
							</g>
						</svg>
					</a>
				<!--</div>-->
				</<?php if(is_home() || is_front_page()|| is_page('index2')){echo 'h1';}else{echo 'div';} ?>>


				<!--

				<nav class="nav_header">
					<ul class="list_nav_header flex">
						<li class="item_nav_header header-article"><a href="<?php echo network_home_url(); ?>/article/" class="target_nav_header">新着</a></li>
						<li class="item_nav_header header-agenda"><a href="<?php echo network_home_url(); ?>/agenda/" class="target_nav_header">アジェンダ</a></li>
						<li class="item_nav_header header-series"><a href="<?php echo network_home_url(); ?>/series/" class="target_nav_header">シリーズ</a></li>
						<li class="item_nav_header header-renewer"><a href="<?php echo network_home_url(); ?>/renewers/" class="target_nav_header kana">リニュアー</a></li>
						<li class="item_nav_header header-about"><a href="<?php echo network_home_url(); ?>/about/" class="target_nav_header">リニューズとは</a></li>
					</ul>
				</nav>

				<div class="search__box for_pc">
					<div class="search-box">
						<form role="search" method="get" id="searchform" class="search-form" action="<?php echo home_url( '/' ); ?>">
							<input type="text" placeholder="記事を検索" name="s" id="search" class="searchInput" autocomplete="off">
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

				-->

				<?php
				$user = wp_get_current_user();
				$user_roles = $user->roles[0];

				//現在のアカウント
				$login_userBase = wp_get_current_user();

				$login_user_id = $login_userBase->user_nicename;
				$login_user_name = $login_userBase->display_name;

				//						$follow_url = ''. network_home_url() .'/follow/';
				?>

				<div class="sign_wrap">
				<?php if( is_user_logged_in() ) : ?>
				<?php if($user_roles != 'um_member'): ?>

				<?php endif; ?>
				<div class="sign_up <?php if(is_page(array('login','register'))){echo 'headLoginBtn';} ?>">
					<div class="user_avatar">
						<a href="<?php echo network_home_url(); ?>/notifications/">
							<?php if ($_SERVER['REMOTE_ADDR'] == "115.179.101.53"): ?>
							<?php// echo do_shortcode('[ultimatemember_notification_count]'); ?>
							<?php endif; ?>
							<span id="noticeCount" class="uk-badge badge_btn_sp_menu"><?php echo do_shortcode('[ultimatemember_notification_count]'); ?></span>
							<div class="userIcon"><?php echo get_avatar($user->get('ID'), 64); ?></div>
						</a>
					</div>
				</div>
					<?php else: ?>
				<div class="sign_in">
					<a class="popup-modal" href="#modalLoginWrap"><svg version="1.1" id="login" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"viewBox="0 0 11 10" style="enable-background:new 0 0 11 10;" xml:space="preserve"><style type="text/css">.st0_login{opacity:0.497;fill:#2C76A4;enable-background:new  ;}.st1_login{fill:#4E4E4E;}</style><g><path class="st0_login" d="M10,10H4.4c-0.6,0-1-0.4-1-1V2.6c0-0.6,0.4-1,1-1H10c0.6,0,1,0.4,1,1V9C11,9.6,10.5,10,10,10z"/><g><g><path class="st1_login" d="M0,6.5V9c0,0.6,0.4,1,1,1h7c0.6,0,1-0.4,1-1V1c0-0.6-0.4-1-1-1H1C0.4,0,0,0.4,0,1v2.5h1V1h7v8H1V6.5H0z"/></g><polygon class="st1" points="4.2,7.4 7.2,5 4.2,2.6 4.2,4.4 4.2,4.5 0,4.5 0,5.5 4.2,5.5 4.2,5.6 		"/></g></g></svg>ログイン</a>
				</div>
				<div class="sign_up none_login">
					<a href="<?php echo network_home_url(); ?>/register/"><svg version="1.1" id="register" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 9.4 10" style="enable-background:new 0 0 9.4 10;" xml:space="preserve"><style type="text/css">.st0_register{opacity:0.6;fill:#FA6400;}.st1_register{fill:#4E4E4E;}</style><g><path id="パス_818_4_" class="st0_register" d="M2.9,10c0-1.8,1.5-3.3,3.3-3.3S9.4,8.2,9.4,10 M6.1,6.3c-1.3,0-2.4-1.1-2.4-2.4c0-1.3,1.1-2.4,2.4-2.4c1.3,0,2.4,1.1,2.4,2.4c0,0,0,0,0,0C8.6,5.2,7.5,6.3,6.1,6.3z"/><path class="st1_register" d="M3.8,7.2C5,7.2,6,7.9,6.4,9H1.2C1.6,7.9,2.6,7.2,3.8,7.2 M3.8,6.2C1.7,6.2,0,7.9,0,10h7.6C7.6,7.9,5.9,6.2,3.8,6.2L3.8,6.2z"/><path id="パス_818_3_" class="st1_register" d="M3.8,5.7C2.2,5.7,1,4.4,1,2.9C0.9,1.3,2.2,0,3.8,0c1.6,0,2.9,1.3,2.9,2.9c0,0,0,0,0,0C6.7,4.4,5.4,5.7,3.8,5.7z M3.8,4.8c1.1,0,1.9-0.9,1.9-1.9C5.7,1.8,4.9,1,3.8,1S1.9,1.8,1.9,2.9c0,0,0,0,0,0C1.9,3.9,2.8,4.8,3.8,4.8L3.8,4.8L3.8,4.8z"/></g></svg><span>新規登録</span></a>
				</div>
					<?php endif; ?>
				</div><!-- sign_wrap -->
			</div>

			<nav role="navigation" class="top_menu">
				<!--<div class="inner_menu_sp">-->
				<button class="menu-trigger">
				<!--<div id="menuToggle">-->
					<!--<p class="uk-badge badge_btn_sp_menu">1</p>-->
					<!--<input type="checkbox" class="triger_btn_sp">-->
					<span class="ic_menu"></span>
					<span class="ic_menu"></span>
					<span class="ic_menu"></span>
				</button><!-- menu-trigger -->

				<section id="menu">
					<div class="inner_menu">
						<!--
						<?php //if( is_user_logged_in() ) : ?>
						<div class="inner_menu_top_none">
						</div>
						<?php //else: ?>
						<div class="inner_menu_top">
							<div class="inner_menu_sign">
								<div class="inner_menu_signIn">
									<p>すでに会員の方は</p>
									<button type="button"><a class="popup-modal" href="#modalLoginWrap"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="17" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M4 15h2v5h12V4H6v5H4V3a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6zm6-4V8l5 4-5 4v-3H2v-2h8z"/></svg><span>ログイン</span></a></button>
								</div>
								<div class="inner_menu_signUp">
									<div class="register_desc">
										<svg version="1.1" id="register" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 9.4 10" style="enable-background:new 0 0 9.4 10;" xml:space="preserve"><style type="text/css">.st0_register{opacity:0.6;fill:#FA6400;}.st1_register{fill:#4E4E4E;}</style><g><path id="パス_818_4_" class="st0_register" d="M2.9,10c0-1.8,1.5-3.3,3.3-3.3S9.4,8.2,9.4,10 M6.1,6.3c-1.3,0-2.4-1.1-2.4-2.4c0-1.3,1.1-2.4,2.4-2.4c1.3,0,2.4,1.1,2.4,2.4c0,0,0,0,0,0C8.6,5.2,7.5,6.3,6.1,6.3z"/><path class="st1_register" d="M3.8,7.2C5,7.2,6,7.9,6.4,9H1.2C1.6,7.9,2.6,7.2,3.8,7.2 M3.8,6.2C1.7,6.2,0,7.9,0,10h7.6C7.6,7.9,5.9,6.2,3.8,6.2L3.8,6.2z"/><path id="パス_818_3_" class="st1_register" d="M3.8,5.7C2.2,5.7,1,4.4,1,2.9C0.9,1.3,2.2,0,3.8,0c1.6,0,2.9,1.3,2.9,2.9c0,0,0,0,0,0C6.7,4.4,5.4,5.7,3.8,5.7z M3.8,4.8c1.1,0,1.9-0.9,1.9-1.9C5.7,1.8,4.9,1,3.8,1S1.9,1.8,1.9,2.9c0,0,0,0,0,0C1.9,3.9,2.8,4.8,3.8,4.8L3.8,4.8L3.8,4.8z"/></g></svg><p>メンバー登録</p>
									</div>
									<a href="<?php //echo network_home_url(); ?>/register/"><p class="register_link">カンタン無料登録！こちらから</p></a>
								</div>
							</div>
						</div>
						<?php //endif; ?>
						-->

						<div class="inner_menu_block">
							<div class="search__box">
								<form role="search" method="get" id="searchform_sp" class="search-form" action="<?php echo home_url( '/' ); ?>">
									<input type="text" placeholder="検索する" name="s" id="search_sp" class="searchInput" autocomplete="off">
									<button id="searchsubmit_sp" class="search__btn"></button>
								</form>
								<!--
								<svg class="search-border" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 314 48">
									<path class="border" d="M157.5,41.3H22.5a17.5,17.5,0,1,1,0-35h135"/>
									<path class="border" d="M157.5,41.3h135a17.5,17.5,0,1,0,0-35h-135"/>
								</svg>
								-->
							</div>
						</div>

						<div class="inner_menu_block">
							<div class="item_menu">
								<a href="<?php echo network_home_url(); ?>/article/">新着</a>
							</div>
							<div class="item_menu">
								<a href="<?php echo network_home_url(); ?>/agenda/">アジェンダ</a>
							</div>
							<div class="item_menu">
								<a href="<?php echo network_home_url(); ?>/series/">シリーズ</a>
							</div>
							<div class="item_menu">
								<a href="<?php echo network_home_url(); ?>/renewers/">リニュアー</a>
							</div>
						</div>

						<div class="menu_border"></div>

						<div class="inner_menu_block">
							<div class="item_menu fs_13">
								<a href="<?php echo network_home_url(); ?>/info/">お知らせ</a>
							</div>
							<div class="item_menu fs_13">
								<a href="<?php echo network_home_url(); ?>/about/">Renews(リニューズ)とは</a>
							</div>
							<div class="item_menu fs_13">
								<a href="<?php echo network_home_url(); ?>/info/contact/"><svg version="1.1" id="information" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"y="0px" viewBox="0 0 17 17"style="enable-background:new 0 0 17 17;" xml:space="preserve"><style type="text/css">.st0_fukidashi{fill:#C2DDEE;}.st1_fukidashi{fill:#2C76A4;}.st2_fukidashi{opacity:0.1;enable-background:new  ;}</style><g><circle class="st0_fukidashi" cx="8.5" cy="8.5" r="8.5"/><g><path id="パス_150" class="st1_fukidashi" d="M12.1,4.7C10,2.9,7,2.9,5,4.7C3.2,6,3,8.5,4.4,10.3c0.1,0.2,0.3,0.3,0.4,0.5c0.8,0.7,1.8,1.2,2.8,1.3v1.2c0,0.2,0.1,0.3,0.3,0.4c0.2,0.1,0.3,0,0.5-0.1l3.3-2.4l0,0c0.6-0.4,1-0.9,1.4-1.5c0.3-0.6,0.4-1.2,0.4-1.8C13.5,6.6,13,5.4,12.1,4.7z M12.3,9.2c-0.3,0.5-0.7,0.9-1.1,1.2l0,0l-2.6,1.9v-0.7c0-0.2-0.2-0.4-0.4-0.4c-1-0.1-1.9-0.5-2.7-1.1C4.1,9,4,6.9,5.2,5.6c0.1-0.1,0.2-0.3,0.4-0.4c1.7-1.4,4.1-1.4,5.8,0c0.8,0.6,1.2,1.6,1.2,2.5C12.6,8.3,12.5,8.8,12.3,9.2L12.3,9.2z"/><path id="パス_151" class="st1_fukidashi" d="M6.1,7.1c-0.4,0-0.6,0.3-0.6,0.6c0,0.4,0.3,0.6,0.6,0.6c0.4,0,0.6-0.3,0.6-0.6l0,0C6.8,7.4,6.5,7.1,6.1,7.1C6.1,7.1,6.1,7.1,6.1,7.1z"/><path id="パス_152" class="st1_fukidashi" d="M8.5,7.1c-0.4,0-0.6,0.3-0.6,0.6c0,0.4,0.3,0.6,0.6,0.6c0.4,0,0.6-0.3,0.6-0.6l0,0C9.1,7.4,8.9,7.1,8.5,7.1C8.5,7.1,8.5,7.1,8.5,7.1z"/><path id="パス_153" class="st1_fukidashi" d="M10.9,7.1c-0.4,0-0.6,0.3-0.6,0.6c0,0.4,0.3,0.6,0.6,0.6c0.4,0,0.6-0.3,0.6-0.6l0,0C11.5,7.4,11.2,7.1,10.9,7.1C10.9,7.1,10.9,7.1,10.9,7.1z"/></g><path class="st2_fukidashi" d="M8.5,1.7c3.7,0,6.8,3.1,6.8,6.8s-3.1,6.8-6.8,6.8s-6.8-3.1-6.8-6.8S4.8,1.7,8.5,1.7 M8.5,0C3.8,0,0,3.8,0,8.5S3.8,17,8.5,17c4.7,0,8.5-3.8,8.5-8.5S13.2,0,8.5,0L8.5,0z"/></g></svg>情報提供／お問い合わせ</a>
							</div>
						</div>

						<div class="inner_mail">
							<div class="mail_desc">
								<div class="mail_img">
									<svg version="1.1" id="mailmagazine" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
									 y="0px" viewBox="0 0 60 50" style="enable-background:new 0 0 60 50;" xml:space="preserve">
										<style type="text/css">
										.st0_magazine{fill:#E6F4FF;}
										.st1_magazine{fill:#4E4E4E;}
										.st2_magazine{fill:#E3E3E3;}
										.st3_magazine{fill:#FFFFFF;}
										.st4_magazine{fill:none;stroke:#2C76A4;stroke-width:1.5;stroke-miterlimit:10;}
										.st5_magazine{fill:#FA6400;}
										</style>
										<g>
											<g>
												<g>
													<path class="st0_magazine" d="M3.1,49.2c-1.3,0-2.4-1.1-2.4-2.3V21H51v25.9c0,1.3-1.1,2.3-2.4,2.3H3.1z"/>
													<path class="st1_magazine" d="M50.2,21.7v25.2c0,0.9-0.7,1.6-1.6,1.6H3.1c-0.9,0-1.6-0.7-1.6-1.6V21.7H50.2 M51.7,20.2H0v26.7
													C0,48.6,1.4,50,3.1,50h45.5c1.7,0,3.1-1.4,3.1-3.1V20.2L51.7,20.2z"/>
												</g>
												<g>
													<path class="st1_magazine" d="M25.9,34.6l18.3,13.9H7.6L25.9,34.6 M25.9,32.7L3.1,50h45.5L25.9,32.7L25.9,32.7z"/>
												</g>
												<g>
													<polygon class="st2_magazine" points="1.2,20.2 25.9,1 50.5,20.2 25.9,39.5 			"/>
													<path class="st1_magazine" d="M25.9,1.9l23.4,18.3L25.9,38.5L2.4,20.2L25.9,1.9 M25.9,0L0,20.2l25.9,20.2l25.9-20.2L25.9,0L25.9,0z"/>
												</g>
												<g>
													<polygon class="st3_magazine" points="8.5,25.8 8.5,7.5 43.2,7.5 43.2,25.8 25.9,39.4 			"/>
													<path class="st1_magazine" d="M42.5,8.3v17.2l-16.6,13l-16.6-13V8.3H42.5 M44,6.8H7.8v19.4l18.1,14.1L44,26.2V6.8L44,6.8z"/>
												</g>
												<g id="グループ_5066_1_" transform="translate(12.688 13.177)">
													<line id="線_256_1_" class="st4_magazine" x1="2.3" y1="-0.2" x2="24" y2="-0.2"/>
													<line id="線_257_1_" class="st4_magazine" x1="2.3" y1="6" x2="24" y2="6"/>
													<line id="線_258_1_" class="st4_magazine" x1="2.3" y1="12.3" x2="24" y2="12.3"/>
												</g>
											</g>
											<g>
												<ellipse id="楕円形_274_1_" class="st5_magazine" cx="50.7" cy="36" rx="6.2" ry="6.2"/>
												<path class="st3_magazine" d="M50.5,38.2h2.2V39h-4l2.1-2.5c0.2-0.2,0.4-0.5,0.5-0.6c0.1-0.2,0.2-0.3,0.3-0.5c0.1-0.2,0.2-0.5,0.2-0.6
												c0-0.3-0.1-0.5-0.3-0.7c-0.2-0.2-0.4-0.3-0.7-0.3c-0.6,0-0.9,0.4-1,1.1h-0.9c0.1-1.2,0.8-1.9,1.9-1.9c0.5,0,1,0.2,1.4,0.5
												c0.4,0.3,0.6,0.8,0.6,1.3c0,0.3-0.1,0.6-0.3,0.9c-0.1,0.2-0.2,0.4-0.4,0.6c-0.2,0.2-0.4,0.5-0.6,0.8L50.5,38.2z"/>
											</g>
											<g>
												<g>
													<rect x="53.8" y="27.8" class="st0_magazine" width="1" height="2.1"/>
													<polygon class="st1" points="54.8,27.8 53.8,27.8 53.8,29.8 54.8,29.8 54.8,27.8 			"/>
												</g>
												<g>
													<rect x="57.9" y="32.9" class="st0_magazine" width="2.1" height="1"/>
													<polygon class="st1" points="60,32.9 57.9,32.9 57.9,34 60,34 60,32.9 			"/>
												</g>
												<g>
													<polygon class="st0_magazine" points="57.2,31.3 56.5,30.5 58,29 58.7,29.8 			"/>
													<polygon class="st1_magazine" points="58,29 56.5,30.5 57.2,31.3 58.7,29.8 58,29 			"/>
												</g>
											</g>
										</g>
									</svg>
								</div><!-- /.mail_img -->

								<div class="mail_text">
									<p class="mail_title">Mail magazine</p>
									<p class="mail_sub"><!--<span class="mail_strong">-->オリジナルのニューズレターや最新情報<!--</span>-->をメールでお届けします！</p>
								</div>
							</div><!-- /.mail_desc -->

							<form>
								<div class="mail_container">
									<div class="mail_input">
										<input type="email" name="" value="" placeholder="E-mail adress">
									</div>
									<button type="submit"><span class="mail_button_item">go!</span></button>
								</div>
							</form>
						</div><!-- /.inner_mail -->

						<div class="inner_menu_bottom">
							<!--
							<div class="follow">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/follow.png" alt="">
							</div>
							-->
							<div class="follow">
								<div class="diagonal_left"></div>
								<div class="follow_us">Follow us!</div>
								<div class="diagonal_right"></div>
							</div>

							<?php
								//元となるテキスト
								//$text = 'Renews | ';
								//$siteURL = rawurlencode(network_home_url());
								//URLエンコード処理
								//$encoded = rawurlencode( $text ) ;
							?>

							<div class="btn_share flex">
								<div class="share-btn twitter">
									<a href="//twitter.com/share?url=<?php echo network_home_url(); ?>&text=<?php echo $encoded; ?>" class="share_popup" target="_blank">
										<svg version="1.1" id="Twitter" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
										 viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"><style type="text/css">.st0_twitter{fill:#1DA1F2;}</style><path class="st0_twitter" d="M7.5,21.8c9.1,0,14-7.5,14-14c0-0.2,0-0.4,0-0.6c1-0.7,1.8-1.6,2.5-2.5c-0.9,0.4-1.8,0.7-2.8,0.8
										c1-0.6,1.8-1.6,2.2-2.7c-1,0.6-2,1-3.1,1.2c-0.9-1-2.2-1.6-3.6-1.6c-2.7,0-4.9,2.2-4.9,4.9c0,0.4,0,0.8,0.1,1.1
										C7.7,8.1,4.1,6.1,1.7,3.1C1.2,3.9,1,4.7,1,5.6c0,1.7,0.9,3.2,2.2,4.1C2.4,9.7,1.6,9.5,1,9.1c0,0,0,0,0,0.1c0,2.4,1.7,4.4,4,4.8
										c-0.4,0.1-0.8,0.2-1.3,0.2c-0.3,0-0.6,0-0.9-0.1c0.6,2,2.4,3.4,4.6,3.4c-1.7,1.3-3.8,2.1-6.1,2.1c-0.4,0-0.8,0-1.2-0.1
										C2.2,20.9,4.8,21.8,7.5,21.8"/>
										</svg>
									</a>
								</div>
									
								<div class="share-btn facebook">
									<a href="//www.facebook.com/sharer/sharer.php?u=<?php echo $siteURL; ?>" class="share_popup" target="_blank">
										<svg version="1.1" id="Facebook" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
										 viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
											<style type="text/css">
												.st0_facebook{fill:#1877F2;}
												.st1_facebook{fill:#FFFFFF;}
											</style>
											<g>
												<path class="st0_facebook" d="M24,12c0-6.6-5.4-12-12-12S0,5.4,0,12c0,6,4.4,11,10.1,11.9v-8.4h-3V12h3V9.4c0-3,1.8-4.7,4.5-4.7
												c1.3,0,2.7,0.2,2.7,0.2v3h-1.5c-1.5,0-2,0.9-2,1.9V12h3.3l-0.5,3.5h-2.8v8.4C19.6,23,24,18,24,12z"/>
												<path class="st1_facebook" d="M16.7,15.5l0.5-3.5h-3.3V9.7c0-0.9,0.5-1.9,2-1.9h1.5v-3c0,0-1.4-0.2-2.7-0.2c-2.7,0-4.5,1.7-4.5,4.7V12h-3
												v3.5h3v8.4C10.7,24,11.4,24,12,24s1.3,0,1.9-0.1v-8.4H16.7z"/>
											</g>
										</svg>
									</a>
								</div>

								<div class="share-btn insta">
									<a href="" class="share_popup" target="_blank">
										<img src="<?php echo get_template_directory_uri(); ?>/images/icons/Instagram_Glyph_Gradient_RGB.png" alt="Instagramアイコン">
									</a>
								</div>
								
								<div class="share-btn line">
									<a href="" class="share_popup" target="_blank">
										<?//xml version="1.0" encoding="utf-8" ?>
										<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
											 viewBox="0 0 25 25" style="enable-background:new 0 0 25 25;" xml:space="preserve">
											<style type="text/css">
												.st0{fill:#FFFFFF;}
											</style>
											<g id="BG">
											</g>
											<g id="LINE_LOGO_1_">
												<g><circle cx="12.5" cy="12.5" r="12.5"/>
													<g>
														<path class="st0" d="M20.8,11.8C20.8,8,17.1,5,12.5,5c-4.6,0-8.3,3-8.3,6.8c0,3.3,3,6.2,7,6.7c0.3,0.1,0.6,0.2,0.7,0.4
														c0.1,0.2,0.1,0.5,0,0.8c0,0-0.1,0.6-0.1,0.7c0,0.2-0.2,0.8,0.7,0.4c0.9-0.4,4.8-2.8,6.6-4.8h0C20.3,14.6,20.8,13.3,20.8,11.8z"/>
													</g>
													<g>
														<path d="M18.1,13.9c0.1,0,0.2-0.1,0.2-0.2v-0.6c0-0.1-0.1-0.2-0.2-0.2h-1.6v-0.6h1.6c0.1,0,0.2-0.1,0.2-0.2v-0.6
														c0-0.1-0.1-0.2-0.2-0.2h-1.6v-0.6h1.6c0.1,0,0.2-0.1,0.2-0.2v-0.6c0-0.1-0.1-0.2-0.2-0.2h-2.3h0c-0.1,0-0.2,0.1-0.2,0.2v0v0
														v3.6v0v0c0,0.1,0.1,0.2,0.2,0.2h0H18.1z"/>
														<path d="M9.4,13.9c0.1,0,0.2-0.1,0.2-0.2v-0.6c0-0.1-0.1-0.2-0.2-0.2H7.8v-2.9C7.8,10,7.7,10,7.6,10H7C7,10,6.9,10,6.9,10.1
														v3.6v0v0c0,0.1,0.1,0.2,0.2,0.2h0H9.4z"/>
														<path d="M10.8,10h-0.6C10.1,10,10,10,10,10.1v3.6c0,0.1,0.1,0.2,0.2,0.2h0.6c0.1,0,0.2-0.1,0.2-0.2v-3.6C11,10,10.9,10,10.8,10
														z"/>
														<path d="M14.8,10h-0.6c-0.1,0-0.2,0.1-0.2,0.2v2.2L12.4,10c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0
														c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0
														c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0h-0.6c-0.1,0-0.2,0.1-0.2,0.2v3.6c0,0.1,0.1,0.2,0.2,0.2h0.6
														c0.1,0,0.2-0.1,0.2-0.2v-2.2l1.7,2.3c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0
														c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0h0.6c0.1,0,0.2-0.1,0.2-0.2v-3.6C15,10,14.9,10,14.8,10z"/>
													</g>
												</g>
											</g>
										</svg>
									</a>
								</div>
							</div><!-- /.btn_share -->

							<div class="footer_link">
								<a href="<?php echo network_home_url(); ?>/info/policy/">プライバシーポリシー</a>
								<a href="<?php echo network_home_url(); ?>/info/terms/">利用規約</a>
								<a href="<?php echo network_home_url(); ?>/about/?move=company">会社概要</a>
								<?php if( is_user_logged_in() ) : ?>
								<a href="<?php echo network_home_url(); ?>/logout/">ログアウト</a>
								<?php endif; ?>
							</div>
							<!--
							<p class="text_copyright">
								&copy; Renews inc. 2020
							</p>
							-->
						</div><!-- /.inner_menu_bottom -->
					</div><!-- /.inner_menu -->
				</section>
			</nav>
			</header>

			<div id="navOverlay"></div>
		
		
		
		<main class="main">
			<div class="wrap_content">
				<article class="content">