<!DOCTYPE html>
<html lang="ja">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">

	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="format-detection" content="telephone=no" />
	<meta name="google-site-verification" content="7qFPILv6reNCvyqyb9HtIPHlkP_VZI4cUdR9O6do6iY" />

	<?php
	//ログインしてなければログインページにリダイレクト
	//if (is_user_logged_in()){
	//} else {
	//wp_redirect('/wp-login.php');
	//}

	$http = is_ssl() ? 'https' : 'http' . '';
	$url = $http .'://'. $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
	$keys = parse_url($url); //パース処理
	$path = explode("/", $keys['path']); //分割処理

	$slug_user = '';
	$slug_member_under = '';
	$userPage_data = '';
	$userRoles = '';

	if(!empty($path) && is_array($path)){
		$slug_user = $path[1];
		if($slug_user == '-'){
			$slug_member_under = $path[2];
			$userPage_data = get_user_by('slug',$slug_member_under);
			if(!empty($userPage_data)){
				$userRoles = $userPage_data->roles[0];
			}
		}
	}
	if($slug_user = '-'):
	if($userRoles == 'um_member'):
	?>
	<meta name="robots" content="noindex, follow" />
	<?php endif;endif; ?>


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

	<!-- Title of Home -->
	<?php if(is_home() || is_front_page() || is_page('index2')): ?>
	<title><?php bloginfo("name"); ?></title>
	<?php else: ?>
	<title><?php wp_title(); ?></title>
	<?php endif; ?>

	<!-- All Head -->
	<?php wp_head(); ?>
	<!-- jquery -->
	<script src="//code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<!-- animation -->
	<!--<link href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css" rel="stylesheet" media="all" />
	<script src="//cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>-->
	<!-- UIkit CSS -->
	<!--<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/uikit@3.2.3/dist/css/uikit.min.css"  media="all"/>-->
	<!-- UIkit JS -->
	<!--<script src="//cdn.jsdelivr.net/npm/uikit@3.2.3/dist/js/uikit.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/uikit@3.2.3/dist/js/uikit-icons.min.js"></script>-->
	<!-- base -->
	<link href="<?php echo get_template_directory_uri(); ?>/css/reset.min.css" rel="stylesheet" media="all" />
	<link href="<?php echo get_template_directory_uri(); ?>/css/all.min.css" rel="stylesheet"  media="all" />
	<script src="<?php echo get_template_directory_uri(); ?>/js/function.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/common.js"></script>
	<link href="<?php echo get_template_directory_uri(); ?>/css/magnific-popup.css" rel="stylesheet" media="all" />
	<script src="<?php echo get_template_directory_uri(); ?>/js/libs/jquery.magnific-popup.min.js"></script>

	<!-- Fonts -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/yakuhanjp@3.4.1/dist/css/yakuhanmp-noto.min.css" media="print" onload="this.media='all'">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+JP:300,400,500,700&display=swap" media="print" onload="this.media='all'" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;500;600;700&display=swap" media="print" onload="this.media='all'" />

	<!-- Head For TOP Page -->
	<?php if(is_home() || is_front_page()|| is_page('index2')): ?>
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/top.min.css" rel="stylesheet" media="all" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
	<!--<script src="<?php //echo get_template_directory_uri(); ?>/js/loading.js"></script>-->
	<script src="<?php echo get_template_directory_uri(); ?>/js/libs/slick.min.js"></script>
	<link href="<?php echo get_template_directory_uri(); ?>/css/slick.css" rel="stylesheet" media="all" />
	<script src="<?php echo get_template_directory_uri(); ?>/js/top.js"></script>
	<?php else: ?>
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/lower1.min.css" rel="stylesheet" media="all" />
	<?php endif; ?>

	<!-- Head For Article Page -->
	<?php if(is_singular('articles')||is_post_type_archive('articles')): ?>
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/article.min.css" rel="stylesheet" media="all" />
	<link href="<?php echo get_template_directory_uri(); ?>/css/single.css" rel="stylesheet"  media="all" />
	<link href="<?php echo get_template_directory_uri(); ?>/css/single-articles.css" rel="stylesheet" media="all" />
	<!-- FontAwesome -->
	<script src="https://kit.fontawesome.com/05117f24ac.js" crossorigin="anonymous"></script>
	<?php endif; ?>

	<?php if(is_main_site() && is_singular('articles')): ?>
	<script src="<?php echo get_template_directory_uri(); ?>/js/article.js"></script>
	<script type="text/javascript" src='<?php bloginfo('url'); ?>/wp-includes/js/comment-reply.min.js'></script>
	<link href="<?php echo get_template_directory_uri(); ?>/css/comments.css" rel="stylesheet" media="all" />
	<script src="<?php echo get_template_directory_uri(); ?>/js/comments.js"></script>
	<?php endif; ?>
	<?php if(is_main_site() && is_post_type_archive('articles')): //無限スクロール ?>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/scrollOption.js"></script>
	<?php endif; ?>
	<!-- Head For Agenda Page -->
	<?php if(is_page('agenda')||is_tax(array('agenda'))): ?>
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/agenda.min.css" rel="stylesheet" media="all" />
	<?php endif; ?>
	<!-- Head For About Page -->
	<?php if(is_page('about')): ?>
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/about.min.css" rel="stylesheet" media="all" />
	<script src="<?php echo get_template_directory_uri(); ?>/js/about.js"></script>
	<?php endif; ?>
	<!-- Head For series Page -->
	<?php if(is_page('series')||is_tax(array('series','value_hashtag'))||is_search()): ?>
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/agenda.min.css" rel="stylesheet" media="all" />
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/column.min.css" rel="stylesheet" media="all" />
	<?php endif; ?>
	<!-- Head For Keyword Page -->
	<?php if(is_page('keyword')||is_tax(array('keyword'))): ?>
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/keyword.min.css" rel="stylesheet" media="all" />
	<?php endif; ?>
	<!-- Head For Various Pages -->
	<?php if(is_page_template(array('page-templates/member.php','page-templates/member_under.php','page-templates/profile.php','page-templates/follow.php','page-templates/bookmark.php','page-templates/notifications.php')) || is_page(array('bookmark','register','login','password-reset')) || (!empty($_GET['um_action']) && $_GET['um_action'] == 'edit') || (!empty($_GET['profiletab']) && $_GET['profiletab'] == 'following')): ?>
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/my.min.css" rel="stylesheet" media="all" />
	<link href="<?php echo get_template_directory_uri(); ?>/css/mypage.css" rel="stylesheet" media="all" />
	<?php endif; ?>
	<?php if((!empty($_GET['um_action']) && $_GET['um_action'] == 'edit') || is_page_template('page-templates/notifications.php') || ($slug_member_under == 'password') || is_page_template('page-templates/follow.php')):?>
	<script src="<?php echo get_template_directory_uri(); ?>/js/mypage.js"></script>
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
	<?php if(is_page('policy')): ?>
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/privacy.min.css" rel="stylesheet" media="all" />
	<?php endif; ?>
	<?php if(is_404()): ?>
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/error.min.css" rel="stylesheet" media="all" />
	<?php endif; ?>
	<script src="<?php echo get_template_directory_uri(); ?>/js/libs/imgLiquid-min.js"></script>

	<!-- SNS Share -->
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
	<!-- hatena -->
	<script type="text/javascript" src="https://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async">
		{lang: "ja"}
	</script>

	<!-- add.css -->
	<link href="<?php echo get_template_directory_uri(); ?>/css/add.css" rel="stylesheet" media="all" />
	<link href="<?php echo get_template_directory_uri(); ?>/css/renew.css" rel="stylesheet" media="all" />

	<!-- add rss -->
	<link rel="alternate" type="application/rss+xml" href="https://stg2.renews.jp/feed/" title="renews フィード" />
</head>
<!-- END OF HEAD -->

	<!-- body ontouchstart=""-->
	<body <?php if(is_page('series')){echo 'id="column"';}elseif(is_tax('series')){echo 'id="ajenda_detail"';}elseif(is_page_template('page-templates/renewers_detail.php')){echo 'id="renewer_detail"';} if(!empty($_GET['um_action']) && $_GET['um_action'] == 'edit'){echo ' class="profEditBody"';} if(!is_page(array('login','register','contact'))){echo ' class="grecaptchaHide"';} ?>>
		<!-- For Top Page -->
		<div class="wrapper <?php if(is_home() || is_front_page()|| is_page('index2')){echo 'topPage';} if(!is_user_logged_in()){echo ' noLogin';} if(is_page('password-reset')){echo ' passwordReset';} ?> " id="wrap">
		<?php //if(!($_GET['um_action'] == 'edit')): ?>
		<header>
			<div class="inner_base flex">

				<!-- For Top Page -->
				<!--<div class="logo_header">-->
				<<?php if(is_home() || is_front_page()|| is_page('index2')){echo 'h1';} else{echo 'div';} ?> class="logo_header">
					<p class="sub_title">世の中を“リニュー”しよう。課題解決にこだわるメディア</p>
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
							<title>Renews リニューズ</title>
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
				<!--</div>-->
				</<?php if(is_home() || is_front_page()|| is_page('index2')){echo 'h1';}else{echo 'div';} ?>>


				<!--

				<nav class="nav_header">
					<ul class="list_nav_header flex">
						<li class="item_nav_header header-article"><a href="<?php echo home_url(); ?>/article/" class="target_nav_header">新着</a></li>
						<li class="item_nav_header header-agenda"><a href="<?php echo home_url(); ?>/agenda/" class="target_nav_header">アジェンダ</a></li>
						<li class="item_nav_header header-series"><a href="<?php echo home_url(); ?>/series/" class="target_nav_header">シリーズ</a></li>
						<li class="item_nav_header header-renewer"><a href="<?php echo home_url(); ?>/renewers/" class="target_nav_header kana">リニュアー</a></li>
						<li class="item_nav_header header-about"><a href="<?php echo home_url(); ?>/about/" class="target_nav_header">リニューズとは</a></li>
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

				//						$follow_url = ''. home_url() .'/follow/';
				?>

				<div class="sign_wrap">
				<?php if( is_user_logged_in() ) : ?>
				<?php if($user_roles != 'um_member'): ?>

				<?php endif; ?>
				<div class="sign_up <?php if(is_page(array('login','register'))){echo 'headLoginBtn';} ?>">
					<div class="user_avatar">
						<a href="<?php echo home_url(); ?>/notifications/">
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
					<a class="popup-modal" href="#modalLoginWrap"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M4 15h2v5h12V4H6v5H4V3a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6zm6-4V8l5 4-5 4v-3H2v-2h8z"/></svg>ログイン</a>
				</div>
				<div class="sign_up">
					<a href="<?php echo home_url(); ?>/register/"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M4 22a8 8 0 1 1 16 0h-2a6 6 0 1 0-12 0H4zm8-9c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6zm0-2c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z"/></svg><span>新規登録</span></a>
				</div>
					<?php endif; ?>
				</div><!-- sign_wrap -->
			</div>


			<nav role="navigation" class="sp_menu">
				<div class="inner_sp_menu">
					<div id="menuToggle">
<!--						<p class="uk-badge badge_btn_sp_menu">1</p>-->

						<input type="checkbox" class="triger_btn_sp">

						<span class="ic_menu"></span>
						<span class="ic_menu"></span>
						<span class="ic_menu"></span>

						<section id="menu">

							<div class="inner_menu_header_sp">
							</div>

							<div class="inner_menu_sp">

								<?php if( is_user_logged_in() ) : ?>
								<div class="inner_menu_sp_top_none">
								</div>
								<?php else: ?>
								<div class="inner_menu_sp_top">
									<div class="inner_menu_sp_sign">
										<div class="inner_menu_sp_signIn">
											<p>すでに会員の方は</p>
											<button type="button"><a class="popup-modal" href="#modalLoginWrap"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M4 15h2v5h12V4H6v5H4V3a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6zm6-4V8l5 4-5 4v-3H2v-2h8z"/></svg><span>ログイン</span></a></button>
										</div>
										<div class="inner_menu_sp_signUp">
											<p>カンタン無料登録！</p>
											<button type="button"><a href="<?php echo home_url(); ?>/register/"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M4 22a8 8 0 1 1 16 0h-2a6 6 0 1 0-12 0H4zm8-9c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6zm0-2c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z"/></svg><span>新規登録</span></a></button>
										</div>
									</div>
								</div>
								<?php endif; ?>


								<div class="inner_menu_sp_block">
									<div class="search__box">
										<div class="search-box">
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
								</div>


								<div class="inner_menu_sp_scroll">
									<div class="inner_menu_sp_block">
										<div class="item_menu_sp">
											<a href="<?php echo home_url(); ?>/article/">新着</a>
										</div>
										<div class="item_menu_sp">
											<a href="<?php echo home_url(); ?>/agenda/">アジェンダ</a>
										</div>
										<div class="item_menu_sp">
											<a href="<?php echo home_url(); ?>/series/">シリーズ</a>
										</div>
										<div class="item_menu_sp">
											<a href="<?php echo home_url(); ?>/renewers/">リニュアー</a>
										</div>
										<div class="item_menu_sp">
											<a href="<?php echo home_url(); ?>/info/">お知らせ</a>
										</div>
										<div class="item_menu_sp">
											<a href="<?php echo home_url(); ?>/about/">リニューズとは</a>
										</div>
										<?php if( is_user_logged_in() ) : ?>
										<div class="item_menu_sp">
											<a href="<?php echo home_url(); ?>/logout/">ログアウト</a>
										</div>
										<?php endif; ?>
										<div class="item_menu_sp">
											<a href="<?php echo home_url(); ?>/info/contact/">情報提供／お問い合わせ</a>
										</div>
									</div>
										<!--
										<div class="item_menu_sp">
											<a href="<?php echo home_url(); ?>/info/policy/">プライバシーポリシー</a>
										</div>
										<div class="item_menu_sp">
											<a href="<?php echo home_url(); ?>/info/terms/">利用規約</a>
										</div>
										-->
										<!--
										<div class="item_menu_sp">
											<a href="<?php echo home_url(); ?>/about/?move=company">会社概要</a>
										</div>
										-->


								</div><!-- inner_menu_sp_scroll -->

									<div class="footer_bottom flex">

										<div class="follow">
											<button type="button"><a href="" title="">Follow me!</a></button>
										</div>

										<?php
										//元となるテキスト
										$text = 'Renews | ';
										$siteURL = rawurlencode(home_url());
										//URLエンコード処理
										$encoded = rawurlencode( $text ) ;
										?>

										<div class="clearfix">
											<div class="btn_share flex">
												<div class="share-btn twitter">
													<a href="//twitter.com/share?url=<?php echo home_url(); ?>&text=<?php echo $encoded; ?>" class="share_popup" target="_blank">
														<!-- <img src="<?php echo get_template_directory_uri(); ?>/images/icons/foot_tw.svg" alt="twitter" /> -->
														<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M22.162 5.656a8.384 8.384 0 0 1-2.402.658A4.196 4.196 0 0 0 21.6 4c-.82.488-1.719.83-2.656 1.015a4.182 4.182 0 0 0-7.126 3.814 11.874 11.874 0 0 1-8.62-4.37 4.168 4.168 0 0 0-.566 2.103c0 1.45.738 2.731 1.86 3.481a4.168 4.168 0 0 1-1.894-.523v.052a4.185 4.185 0 0 0 3.355 4.101 4.21 4.21 0 0 1-1.89.072A4.185 4.185 0 0 0 7.97 16.65a8.394 8.394 0 0 1-6.191 1.732 11.83 11.83 0 0 0 6.41 1.88c7.693 0 11.9-6.373 11.9-11.9 0-.18-.005-.362-.013-.54a8.496 8.496 0 0 0 2.087-2.165z"/></svg>
													</a>
												</div>
												<div class="share-btn facebook">
													<a href="//www.facebook.com/sharer/sharer.php?u=<?php echo $siteURL; ?>" class="share_popup" target="_blank">
														<!-- <img src="<?php echo get_template_directory_uri(); ?>/images/icons/foot_fb.svg" alt="facebook" /> -->
														<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 2C6.477 2 2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.879V14.89h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.989C18.343 21.129 22 16.99 22 12c0-5.523-4.477-10-10-10z"/></svg>
													</a>
												</div>
												<div class="share-btn insta">
													<a href="" class="for_pc share_popup" target="_blank">
														<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6zm0-2a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm6.5-.25a1.25 1.25 0 0 1-2.5 0 1.25 1.25 0 0 1 2.5 0zM12 4c-2.474 0-2.878.007-4.029.058-.784.037-1.31.142-1.798.332-.434.168-.747.369-1.08.703a2.89 2.89 0 0 0-.704 1.08c-.19.49-.295 1.015-.331 1.798C4.006 9.075 4 9.461 4 12c0 2.474.007 2.878.058 4.029.037.783.142 1.31.331 1.797.17.435.37.748.702 1.08.337.336.65.537 1.08.703.494.191 1.02.297 1.8.333C9.075 19.994 9.461 20 12 20c2.474 0 2.878-.007 4.029-.058.782-.037 1.309-.142 1.797-.331.433-.169.748-.37 1.08-.702.337-.337.538-.65.704-1.08.19-.493.296-1.02.332-1.8.052-1.104.058-1.49.058-4.029 0-2.474-.007-2.878-.058-4.029-.037-.782-.142-1.31-.332-1.798a2.911 2.911 0 0 0-.703-1.08 2.884 2.884 0 0 0-1.08-.704c-.49-.19-1.016-.295-1.798-.331C14.925 4.006 14.539 4 12 4zm0-2c2.717 0 3.056.01 4.122.06 1.065.05 1.79.217 2.428.465.66.254 1.216.598 1.772 1.153a4.908 4.908 0 0 1 1.153 1.772c.247.637.415 1.363.465 2.428.047 1.066.06 1.405.06 4.122 0 2.717-.01 3.056-.06 4.122-.05 1.065-.218 1.79-.465 2.428a4.883 4.883 0 0 1-1.153 1.772 4.915 4.915 0 0 1-1.772 1.153c-.637.247-1.363.415-2.428.465-1.066.047-1.405.06-4.122.06-2.717 0-3.056-.01-4.122-.06-1.065-.05-1.79-.218-2.428-.465a4.89 4.89 0 0 1-1.772-1.153 4.904 4.904 0 0 1-1.153-1.772c-.248-.637-.415-1.363-.465-2.428C2.013 15.056 2 14.717 2 12c0-2.717.01-3.056.06-4.122.05-1.066.217-1.79.465-2.428a4.88 4.88 0 0 1 1.153-1.772A4.897 4.897 0 0 1 5.45 2.525c.638-.248 1.362-.415 2.428-.465C8.944 2.013 9.283 2 12 2z"/></svg>
													</a>
												</div>
												<div class="share-btn line">
													<a href="" class="for_pc share_popup" target="_blank">
														<?xml version="1.0" encoding="utf-8"?>
														<!-- Generator: Adobe Illustrator 24.3.0, SVG Export Plug-In . SVG Version: 6.00 Build 0) -->
														<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
															 viewBox="0 0 25 25" style="enable-background:new 0 0 25 25;" xml:space="preserve">
														<style type="text/css">
															.st0{fill:#FFFFFF;}
														</style>
														<g id="BG">
														</g>
														<g id="LINE_LOGO_1_">
															<g>
																<circle cx="12.5" cy="12.5" r="12.5"/>
																<g>
																	<g>
																		<g>
																			<path class="st0" d="M20.8,11.8C20.8,8,17.1,5,12.5,5c-4.6,0-8.3,3-8.3,6.8c0,3.3,3,6.2,7,6.7c0.3,0.1,0.6,0.2,0.7,0.4
																				c0.1,0.2,0.1,0.5,0,0.8c0,0-0.1,0.6-0.1,0.7c0,0.2-0.2,0.8,0.7,0.4c0.9-0.4,4.8-2.8,6.6-4.8h0C20.3,14.6,20.8,13.3,20.8,11.8z"
																				/>
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
															</g>
														</g>
														</svg>
													</a>
												</div>
											</div><!-- /.btn_share -->
										</div>

										<div class="footer_link">
											<a href="<?php echo home_url(); ?>/info/policy/">プライバシーポリシー</a>
											<a href="<?php echo home_url(); ?>/info/terms/">利用規約</a>
											<a href="<?php echo home_url(); ?>/about/?move=company">会社概要</a>
										</div>

										<!--
										<p class="text_copyright">
											&copy; Renews inc. 2020
										</p>
										-->
									</div><!-- footer_bottom -->


							</div>

						</section>


					</div>
				</div>
			</nav>
		</header>

			<div id="navOverlay"></div>
		<?php //endif; ?>
		<main class="main <?php if($_GET['um_action'] == 'edit'){echo 'profEditWrap';} ?>">
		<?php if(!is_page('about')): ?>
			<div class="wrap_content">
				<article class="content">
				<?php endif; ?>
