<!DOCTYPE html>
<html lang="ja">

<!----- HEAD ----->
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
	<!--<script src="//code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
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
	<!-- Fonts
	<link rel="preload" as="font" href="../fonts/noto-sans-jp-v28-latin_japanese-regular.woff2" crossorigin>
	<link rel="preload" as="font" href="../fonts/noto-sans-jp-v28-latin_japanese-500.woff2" crossorigin>
	<link rel="preload" as="font" href="../fonts/noto-sans-jp-v28-latin_japanese-700.woff2" crossorigin>
	<link rel="preload" as="font" href="../fonts/shippori-mincho-v4-latin_japanese-500.woff2" crossorigin>
	<link rel="preload" as="font" href="../fonts/shippori-mincho-v4-latin_japanese-600.woff2" crossorigin>
	-->
	<!--<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@400;500;600;700&display=swap" media="print" onload="this.media='all'" />-->


	<!-- Head For TOP Page -->
	<?php if(is_home() || is_front_page()|| is_page('index2')): ?>
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/top.min.css" rel="stylesheet" media="all" />
	<script src="<?php echo get_template_directory_uri(); ?>/js/libs/slick.min.js"></script>
	<link href="<?php echo get_template_directory_uri(); ?>/css/slick.css" rel="stylesheet" media="all" />
	<script src="<?php echo get_template_directory_uri(); ?>/js/top.js"></script>
	<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>-->
	<!--<script src="<?php //echo get_template_directory_uri(); ?>/js/loading.js"></script>-->
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
	<link href="<?php echo get_template_directory_uri(); ?>/css/comments.css" rel="stylesheet" media="all" />
	<script src="<?php echo get_template_directory_uri(); ?>/js/comments.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/article.js"></script>
	<script type="text/javascript" src='<?php bloginfo('url'); ?>/wp-includes/js/comment-reply.min.js'></script>
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
	<?php //if(is_page('donation')||is_404()): ?>
	<!--<link href="<?php //echo get_template_directory_uri(); ?>/css/pages/donation.min.css" rel="stylesheet" media="all" />
	<?php //endif; ?>-->
	<script src="<?php echo get_template_directory_uri(); ?>/js/libs/imgLiquid-min.js"></script>

	<!-- add.css -->
	<link href="<?php echo get_template_directory_uri(); ?>/css/add.css" rel="stylesheet" media="all" />
	<link href="<?php echo get_template_directory_uri(); ?>/css/renew.css" rel="stylesheet" media="all" />
</head>
<!----- END OF HEAD ----->


<!----- BODY ----->
<body <?php if(is_page('series')){echo 'id="column"';}elseif(is_tax('series')){echo 'id="ajenda_detail"';}elseif(is_page_template('page-templates/renewers_detail.php')){echo 'id="renewer_detail"';} if(!empty($_GET['um_action']) && $_GET['um_action'] == 'edit'){echo ' class="profEditBody"';} if(!is_page(array('login','register','contact'))){echo ' class="grecaptchaHide"';} ?>>

	<!-- For Top Page -->
	<div class="wrapper <?php if(is_home() || is_front_page()|| is_page('index2')){echo 'topPage';} if(!is_user_logged_in()){echo ' noLogin';} if(is_page('password-reset')){echo ' passwordReset';} ?> " id="wrap">
		<?php //if(!($_GET['um_action'] == 'edit')): ?>


		<!----- HEADER ----->
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
					<a class="popup-modal" href="#modalLoginWrap"><svg version="1.1" id="login" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"viewBox="0 0 11 10" style="enable-background:new 0 0 11 10;" xml:space="preserve"><style type="text/css">.st0_login{opacity:0.497;fill:#2C76A4;enable-background:new  ;}.st1_login{fill:#4E4E4E;}</style><g><path class="st0_login" d="M10,10H4.4c-0.6,0-1-0.4-1-1V2.6c0-0.6,0.4-1,1-1H10c0.6,0,1,0.4,1,1V9C11,9.6,10.5,10,10,10z"/><g><g><path class="st1_login" d="M0,6.5V9c0,0.6,0.4,1,1,1h7c0.6,0,1-0.4,1-1V1c0-0.6-0.4-1-1-1H1C0.4,0,0,0.4,0,1v2.5h1V1h7v8H1V6.5H0z"/></g><polygon class="st1" points="4.2,7.4 7.2,5 4.2,2.6 4.2,4.4 4.2,4.5 0,4.5 0,5.5 4.2,5.5 4.2,5.6 		"/></g></g></svg>ログイン</a>
				</div>
				<div class="sign_up none_login">
					<a href="<?php echo home_url(); ?>/register/"><svg version="1.1" id="register" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 9.4 10" style="enable-background:new 0 0 9.4 10;" xml:space="preserve"><style type="text/css">.st0_register{opacity:0.6;fill:#FA6400;}.st1_register{fill:#4E4E4E;}</style><g><path id="パス_818_4_" class="st0_register" d="M2.9,10c0-1.8,1.5-3.3,3.3-3.3S9.4,8.2,9.4,10 M6.1,6.3c-1.3,0-2.4-1.1-2.4-2.4c0-1.3,1.1-2.4,2.4-2.4c1.3,0,2.4,1.1,2.4,2.4c0,0,0,0,0,0C8.6,5.2,7.5,6.3,6.1,6.3z"/><path class="st1_register" d="M3.8,7.2C5,7.2,6,7.9,6.4,9H1.2C1.6,7.9,2.6,7.2,3.8,7.2 M3.8,6.2C1.7,6.2,0,7.9,0,10h7.6C7.6,7.9,5.9,6.2,3.8,6.2L3.8,6.2z"/><path id="パス_818_3_" class="st1_register" d="M3.8,5.7C2.2,5.7,1,4.4,1,2.9C0.9,1.3,2.2,0,3.8,0c1.6,0,2.9,1.3,2.9,2.9c0,0,0,0,0,0C6.7,4.4,5.4,5.7,3.8,5.7z M3.8,4.8c1.1,0,1.9-0.9,1.9-1.9C5.7,1.8,4.9,1,3.8,1S1.9,1.8,1.9,2.9c0,0,0,0,0,0C1.9,3.9,2.8,4.8,3.8,4.8L3.8,4.8L3.8,4.8z"/></g></svg><span>新規登録</span></a>
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
							<?php if( is_user_logged_in() ) : ?>
							<div class="inner_menu_top_none">
							</div>
							<?php else: ?>
							<div class="inner_menu_top">
								<div class="inner_menu_sign">
									<!--
									<div class="inner_menu_signIn">
										<p>すでに会員の方は</p>
										<button type="button"><a class="popup-modal" href="#modalLoginWrap"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="17" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M4 15h2v5h12V4H6v5H4V3a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6zm6-4V8l5 4-5 4v-3H2v-2h8z"/></svg><span>ログイン</span></a></button>
									</div>
									-->
									<div class="inner_menu_signUp">
										<div class="register_desc">
											<svg version="1.1" id="register" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 9.4 10" style="enable-background:new 0 0 9.4 10;" xml:space="preserve"><style type="text/css">.st0_register{opacity:0.6;fill:#FA6400;}.st1_register{fill:#4E4E4E;}</style><g><path id="パス_818_4_" class="st0_register" d="M2.9,10c0-1.8,1.5-3.3,3.3-3.3S9.4,8.2,9.4,10 M6.1,6.3c-1.3,0-2.4-1.1-2.4-2.4c0-1.3,1.1-2.4,2.4-2.4c1.3,0,2.4,1.1,2.4,2.4c0,0,0,0,0,0C8.6,5.2,7.5,6.3,6.1,6.3z"/><path class="st1_register" d="M3.8,7.2C5,7.2,6,7.9,6.4,9H1.2C1.6,7.9,2.6,7.2,3.8,7.2 M3.8,6.2C1.7,6.2,0,7.9,0,10h7.6C7.6,7.9,5.9,6.2,3.8,6.2L3.8,6.2z"/><path id="パス_818_3_" class="st1_register" d="M3.8,5.7C2.2,5.7,1,4.4,1,2.9C0.9,1.3,2.2,0,3.8,0c1.6,0,2.9,1.3,2.9,2.9c0,0,0,0,0,0C6.7,4.4,5.4,5.7,3.8,5.7z M3.8,4.8c1.1,0,1.9-0.9,1.9-1.9C5.7,1.8,4.9,1,3.8,1S1.9,1.8,1.9,2.9c0,0,0,0,0,0C1.9,3.9,2.8,4.8,3.8,4.8L3.8,4.8L3.8,4.8z"/></g></svg><p>メンバー登録</p>
										</div>
										<a href="<?php echo home_url(); ?>/register/"><p class="register_link">カンタン無料登録！こちらから</p></a>
									</div>
								</div>
							</div>
							<?php endif; ?>

							<div class="inner_menu_block">
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

							<div class="inner_menu_block inner_menu_top">
								<div class="item_menu">
									<a href="<?php echo home_url(); ?>/article/">新着</a>
								</div>
								<div class="item_menu">
									<a href="<?php echo home_url(); ?>/agenda/">アジェンダ</a>
								</div>
								<div class="item_menu">
									<a href="<?php echo home_url(); ?>/series/">シリーズ</a>
								</div>
								<div class="item_menu">
									<a href="<?php echo home_url(); ?>/renewers/">リニュアー</a>
								</div>
							</div>
							<div class="inner_menu_block inner_menu_bottom">
								<div class="item_menu">
									<a href="<?php echo home_url(); ?>/info/">お知らせ</a>
								</div>
								<div class="item_menu">
									<a href="<?php echo home_url(); ?>/about/">リニューズとは</a>
								</div>
								<?php if( is_user_logged_in() ) : ?>
								<div class="item_menu">
									<a href="<?php echo home_url(); ?>/logout/">ログアウト</a>
								</div>
								<?php endif; ?>
								<div class="item_menu">
									<a href="<?php echo home_url(); ?>/info/contact/"><svg version="1.1" id="information" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"y="0px" viewBox="0 0 17 17"style="enable-background:new 0 0 17 17;" xml:space="preserve"><style type="text/css">.st0_fukidashi{fill:#C2DDEE;}.st1_fukidashi{fill:#2C76A4;}.st2_fukidashi{opacity:0.1;enable-background:new  ;}</style><g><circle class="st0_fukidashi" cx="8.5" cy="8.5" r="8.5"/><g><path id="パス_150" class="st1_fukidashi" d="M12.1,4.7C10,2.9,7,2.9,5,4.7C3.2,6,3,8.5,4.4,10.3c0.1,0.2,0.3,0.3,0.4,0.5c0.8,0.7,1.8,1.2,2.8,1.3v1.2c0,0.2,0.1,0.3,0.3,0.4c0.2,0.1,0.3,0,0.5-0.1l3.3-2.4l0,0c0.6-0.4,1-0.9,1.4-1.5c0.3-0.6,0.4-1.2,0.4-1.8C13.5,6.6,13,5.4,12.1,4.7z M12.3,9.2c-0.3,0.5-0.7,0.9-1.1,1.2l0,0l-2.6,1.9v-0.7c0-0.2-0.2-0.4-0.4-0.4c-1-0.1-1.9-0.5-2.7-1.1C4.1,9,4,6.9,5.2,5.6c0.1-0.1,0.2-0.3,0.4-0.4c1.7-1.4,4.1-1.4,5.8,0c0.8,0.6,1.2,1.6,1.2,2.5C12.6,8.3,12.5,8.8,12.3,9.2L12.3,9.2z"/><path id="パス_151" class="st1_fukidashi" d="M6.1,7.1c-0.4,0-0.6,0.3-0.6,0.6c0,0.4,0.3,0.6,0.6,0.6c0.4,0,0.6-0.3,0.6-0.6l0,0C6.8,7.4,6.5,7.1,6.1,7.1C6.1,7.1,6.1,7.1,6.1,7.1z"/><path id="パス_152" class="st1_fukidashi" d="M8.5,7.1c-0.4,0-0.6,0.3-0.6,0.6c0,0.4,0.3,0.6,0.6,0.6c0.4,0,0.6-0.3,0.6-0.6l0,0C9.1,7.4,8.9,7.1,8.5,7.1C8.5,7.1,8.5,7.1,8.5,7.1z"/><path id="パス_153" class="st1_fukidashi" d="M10.9,7.1c-0.4,0-0.6,0.3-0.6,0.6c0,0.4,0.3,0.6,0.6,0.6c0.4,0,0.6-0.3,0.6-0.6l0,0C11.5,7.4,11.2,7.1,10.9,7.1C10.9,7.1,10.9,7.1,10.9,7.1z"/></g><path class="st2_fukidashi" d="M8.5,1.7c3.7,0,6.8,3.1,6.8,6.8s-3.1,6.8-6.8,6.8s-6.8-3.1-6.8-6.8S4.8,1.7,8.5,1.7 M8.5,0C3.8,0,0,3.8,0,8.5S3.8,17,8.5,17c4.7,0,8.5-3.8,8.5-8.5S13.2,0,8.5,0L8.5,0z"/></g></svg>情報提供／お問い合わせ</a>
								</div>

							</div>

							<div class="inner_mail">
								<div class="mail_desc">
									<?xml version="1.0" encoding="utf-8"?>
									<svg version="1.1" id="mail" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"viewBox="0 0 60 50" style="enable-background:new 0 0 60 50;" xml:space="preserve"><style type="text/css">.st0_magazine{fill:#E3E3E3;}.st1_magazine{fill:#E6F4FF;}.st2_magazine{fill:#4E4E4E;}.st3_magazine{fill:#FFFFFF;}.st4_magazine{fill:none;stroke:#2C76A4;stroke-width:1.5;stroke-miterlimit:10;}.st5_magazine{fill:#FA6400;}.st6_magazine{enable-background:new  ;}.st7_magazine{fill:#2C76A4;}</style><path class="st0_magazine" d="M-59.2,71.4l-23.5,19.2v26c0,1.1,0.9,2,2,2h43c1.1,0,2-0.9,2-2v-26L-59.2,71.4L-59.2,71.4z"/><path class="st1_magazine" d="M51.4,20.1H0.8v28.2c0,1.2,1,2.1,2.1,2.1h46.4c1.2,0,2.1-1,2.1-2.1V20.1L51.4,20.1z"/><path class="st2_magazine" d="M0.8,20.1v28.2c0,1.2,1,2.1,2.1,2.1h0h46.3h0c1.2,0,2.1-1,2.1-2.1V20.1H0.8z M2.4,21.7h47.4v26.6c0,0.2-0.1,0.3-0.2,0.4L26.1,25.3L2.7,48.8c-0.1-0.1-0.2-0.2-0.2-0.4V21.7z M4.8,48.9l21.3-21.3l21.3,21.3H4.8z"/><path class="st1_magazine" d="M-59.3,109.4l-23.3-18.2v25.5c0,1.1,0.9,1.9,2,1.9h43.1c1.1,0,2-0.9,2-1.9V91.2L-59.3,109.4z"/><g id="パス_783" transform="translate(907.289 -1869.869)"><path class="st0_magazine" d="M-881.3,1908.8l-23.9-18.6l23.9-19.2l23.9,19.2L-881.3,1908.8z"/><path class="st2_magazine" d="M-881.3,1907.8l22.6-17.6l-22.6-18.2l-22.6,18.2L-881.3,1907.8 M-881.3,1909.8l-25.2-19.6l25.2-20.3l25.2,20.3L-881.3,1909.8z"/></g><g id="パス_784" transform="translate(906.891 -1870.177)"><path class="st3_magazine" d="M-880.9,1909.3l-16.8-13.2v-19.3h33.6v19.3L-880.9,1909.3z"/><path class="st2_magazine" d="M-896.9,1877.7v18.1l16,12.5l16-12.5v-18.1H-896.9 M-898.5,1876.1h35.2v20.4l-17.6,13.8l-17.6-13.8V1876.1z"/></g><g id="グループ_5066" transform="translate(12.688 13.177)"><line id="線_256" class="st4_magazine" x1="1.6" y1="0.9" x2="25" y2="0.9"/><line id="線_257" class="st4" x1="1.6" y1="7" x2="25" y2="7"/><line id="線_258" class="st4_magazine" x1="1.6" y1="13" x2="25" y2="13"/></g><g id="グループ_5098" transform="translate(41.249 33.865)"><g id="グループ_5069" transform="translate(0 3.966)"><ellipse id="楕円形_274" class="st5_magazine" cx="8.9" cy="-1.3" rx="6.3" ry="6.3"/><g class="st6_magazine"><path class="st3_magazine" d="M8.8,1H11v0.9H6.9L9-0.7C9.3-1,9.4-1.2,9.6-1.4s0.2-0.3,0.3-0.5c0.1-0.2,0.2-0.5,0.2-0.7c0-0.3-0.1-0.5-0.3-0.7C9.6-3.4,9.4-3.5,9.1-3.5c-0.6,0-1,0.4-1.1,1.1H7.1C7.3-3.7,7.9-4.3,9-4.3c0.6,0,1,0.2,1.4,0.5C10.8-3.5,11-3,11-2.5c0,0.3-0.1,0.7-0.3,1c-0.1,0.2-0.2,0.4-0.4,0.6C10.2-0.7,10-0.5,9.7-0.2L8.8,1z"/></g></g><g id="グループ_5070" transform="translate(10.277) rotate(43)"><rect id="長方形_2298" x="0.4" y="-6.8" transform="matrix(-2.421709e-02 0.9997 -0.9997 -2.421709e-02 -4.6868 -7.7673)" class="st2_magazine" width="2" height="1.4"/><rect id="長方形_2299" x="-2.4" y="-6" transform="matrix(-0.724 0.6898 -0.6898 -0.724 -6.4177 -7.3033)" class="st2_magazine" width="1.4" height="2"/><rect id="長方形_2303" x="3.6" y="-5.5" transform="matrix(-0.724 0.6898 -0.6898 -0.724 4.5963 -11.4039)" class="st2" width="2" height="1.4"/></g></g><path class="st2_magazine" d="M-59.2,71.4l-23.5,19.2v26c0,1.1,0.9,2,2,2h43c1.1,0,2-0.9,2-2v-26L-59.2,71.4z M-66.2,102.4l-14.5-11.5l21.5-17.6l21.5,17.6l-14.9,11.4l-1.2,0.9l-5.7,4.4l-5.5-4.4L-66.2,102.4z M-81.2,92.4l13.9,11L-81.2,116V92.4z M-80.9,117.8l14.8-13.4l6.6,5.2l6.9-5.3l14.9,13.5H-80.9z M-51.4,103.4l14.3-11v23.9L-51.4,103.4z"/><g><path class="st3_magazine" d="M-59.2,108.8L-75,96.4V78.3h31.6v18.1L-59.2,108.8z"/><path class="st2_magazine" d="M-44.4,79.5V96l-15,11.5L-73.9,96V79.5H-44.4 M-42.9,78h-32.5v18.8l16,12.7l16.5-12.7V78L-42.9,78z"/></g><g id="グループ_5066_1_" transform="translate(12.688 13.177)"><rect x="-83" y="70.1" class="st7" width="22" height="1.5"/><rect x="-83" y="75.8" class="st7_magazine" width="22" height="1.5"/><rect x="-83" y="81.4" class="st7_magazine" width="22" height="1.5"/></g></svg>
									<div class="mail_text">
										<p class="mail_title">Mail magazine</p>
										<p class="mail_sub"><span class="mail_strong">最新記事情報やニューズレターを</span><br>いち早くお知らせします！</p>
									</div>
								</div>
								<form>
									<div class="mail_container">
										<div class="mail_input">
											<input type="email" name="" value="" placeholder="E-mail adress">
										</div>
										<button type="submit"><span class="mail_button_item">go!</span></button>
									</div>
								</form>
							</div>

							<div class="inner_menu_bottom flex">
								<div class="follow">
<svg version="1.1" id="follow" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 1040 1040" style="enable-background:new 0 0 1040 1040;" xml:space="preserve">
<style type="text/css">
	.st0_follow{enable-background:new;}
	.st1_follow{fill:#202020;}
</style>
<g class="st0_follow">
	<path class="st1_follow" d="M3080.4,2733.1h-3.7v2.5h3.5v1.5h-3.5v5h-1.6v-10.6h5.3V2733.1z"/>
	<path class="st1_follow" d="M3081.5,2738.8c0-1,0.3-1.8,1-2.5c0.7-0.7,1.5-1,2.5-1c1,0,1.8,0.3,2.5,1c0.7,0.7,1,1.5,1,2.5
		c0,1-0.3,1.8-1,2.5c-0.7,0.7-1.5,1-2.5,1c-1,0-1.8-0.3-2.5-1C3081.8,2740.6,3081.5,2739.8,3081.5,2738.8z M3083.1,2738.8
		c0,0.7,0.2,1.2,0.5,1.6c0.4,0.4,0.8,0.6,1.4,0.6c0.6,0,1.1-0.2,1.4-0.6c0.4-0.4,0.5-0.9,0.5-1.6s-0.2-1.2-0.5-1.6
		c-0.4-0.4-0.8-0.6-1.4-0.6c-0.6,0-1.1,0.2-1.4,0.6C3083.3,2737.7,3083.1,2738.2,3083.1,2738.8z"/>
	<path class="st1_follow" d="M3091.8,2730.6v11.5h-1.5v-11.5H3091.8z"/>
	<path class="st1_follow" d="M3095.3,2730.6v11.5h-1.5v-11.5H3095.3z"/>
	<path class="st1_follow" d="M3096.9,2738.8c0-1,0.3-1.8,1-2.5c0.7-0.7,1.5-1,2.5-1c1,0,1.8,0.3,2.5,1c0.7,0.7,1,1.5,1,2.5
		c0,1-0.3,1.8-1,2.5c-0.7,0.7-1.5,1-2.5,1c-1,0-1.8-0.3-2.5-1C3097.2,2740.6,3096.9,2739.8,3096.9,2738.8z M3098.5,2738.8
		c0,0.7,0.2,1.2,0.5,1.6c0.4,0.4,0.8,0.6,1.4,0.6c0.6,0,1.1-0.2,1.4-0.6c0.4-0.4,0.5-0.9,0.5-1.6s-0.2-1.2-0.5-1.6
		c-0.4-0.4-0.8-0.6-1.4-0.6c-0.6,0-1.1,0.2-1.4,0.6C3098.6,2737.7,3098.5,2738.2,3098.5,2738.8z"/>
	<path class="st1_follow" d="M3106.2,2735.5l1.7,3.8l1.9-4.4l1.9,4.4l1.7-3.8h1.7l-3.5,7.2l-1.9-4.3l-1.9,4.3l-3.5-7.2H3106.2z"/>
	<path class="st1_follow" d="M3122,2735.5v3.8c0,1.1,0.4,1.7,1.3,1.7c0.9,0,1.3-0.6,1.3-1.7v-3.8h1.5v3.9c0,0.5-0.1,1-0.2,1.4
		c-0.1,0.3-0.3,0.7-0.7,0.9c-0.5,0.5-1.2,0.7-2,0.7c-0.8,0-1.5-0.2-2-0.7c-0.3-0.3-0.5-0.6-0.7-0.9c-0.1-0.3-0.2-0.8-0.2-1.4v-3.9
		H3122z"/>
	<path class="st1_follow" d="M3132,2736.6l-1.3,0.7c-0.2-0.4-0.4-0.6-0.7-0.6c-0.1,0-0.3,0-0.4,0.1c-0.1,0.1-0.2,0.2-0.2,0.4
		c0,0.3,0.3,0.5,0.9,0.8c0.8,0.4,1.4,0.7,1.6,1c0.3,0.3,0.4,0.7,0.4,1.2c0,0.6-0.2,1.2-0.7,1.6c-0.5,0.4-1,0.6-1.7,0.6
		c-1.1,0-1.9-0.5-2.4-1.6l1.3-0.6c0.2,0.3,0.3,0.5,0.4,0.6c0.2,0.2,0.4,0.3,0.7,0.3c0.5,0,0.8-0.2,0.8-0.7c0-0.3-0.2-0.5-0.6-0.8
		c-0.2-0.1-0.3-0.2-0.5-0.2c-0.2-0.1-0.3-0.1-0.5-0.2c-0.4-0.2-0.8-0.4-0.9-0.7c-0.2-0.3-0.3-0.6-0.3-1.1c0-0.6,0.2-1.1,0.6-1.4
		c0.4-0.4,0.9-0.6,1.5-0.6C3131,2735.3,3131.6,2735.7,3132,2736.6z"/>
	<path class="st1_follow" d="M3134.2,2741.4c0-0.3,0.1-0.5,0.3-0.7c0.2-0.2,0.4-0.3,0.7-0.3s0.5,0.1,0.7,0.3c0.2,0.2,0.3,0.4,0.3,0.7
		c0,0.3-0.1,0.5-0.3,0.7c-0.2,0.2-0.4,0.3-0.7,0.3c-0.3,0-0.5-0.1-0.7-0.3C3134.3,2741.9,3134.2,2741.6,3134.2,2741.4z
		 M3134.4,2739.8v-8.2h1.5v8.2H3134.4z"/>
</g>
<path class="st1_follow" d="M3060.1,2743.1c-0.3,0-0.6-0.2-0.8-0.4l-6-9c-0.3-0.5-0.2-1.1,0.3-1.4s1.1-0.2,1.4,0.3l6,9
	c0.3,0.5,0.2,1.1-0.3,1.4C3060.5,2743.1,3060.3,2743.1,3060.1,2743.1z"/>
<path class="st1_follow" d="M3151.2,2743.5c-0.2,0-0.4-0.1-0.6-0.2c-0.5-0.3-0.6-0.9-0.3-1.4l6-9c0.3-0.5,0.9-0.6,1.4-0.3
	c0.5,0.3,0.6,0.9,0.3,1.4l-6,9C3151.9,2743.4,3151.5,2743.5,3151.2,2743.5z"/>
</svg>
									<!-- <button type="button"><a href="" title="">Follow me!</a></button> -->
								</div>

								<!-- このコードいる？ -->
								<?php
								//元となるテキスト
								$text = 'Renews | ';
								$siteURL = rawurlencode(home_url());
								//URLエンコード処理
								$encoded = rawurlencode( $text ) ;
								?>

								<div class="btn_share flex">
									<div class="share-btn twitter">
										<a href="//twitter.com/share?url=<?php echo home_url(); ?>&text=<?php echo $encoded; ?>" class="share_popup" target="_blank">
											<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M22.162 5.656a8.384 8.384 0 0 1-2.402.658A4.196 4.196 0 0 0 21.6 4c-.82.488-1.719.83-2.656 1.015a4.182 4.182 0 0 0-7.126 3.814 11.874 11.874 0 0 1-8.62-4.37 4.168 4.168 0 0 0-.566 2.103c0 1.45.738 2.731 1.86 3.481a4.168 4.168 0 0 1-1.894-.523v.052a4.185 4.185 0 0 0 3.355 4.101 4.21 4.21 0 0 1-1.89.072A4.185 4.185 0 0 0 7.97 16.65a8.394 8.394 0 0 1-6.191 1.732 11.83 11.83 0 0 0 6.41 1.88c7.693 0 11.9-6.373 11.9-11.9 0-.18-.005-.362-.013-.54a8.496 8.496 0 0 0 2.087-2.165z"/></svg>
										</a>
									</div>
									<div class="share-btn facebook">
										<a href="//www.facebook.com/sharer/sharer.php?u=<?php echo $siteURL; ?>" class="share_popup" target="_blank">
											<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 2C6.477 2 2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.879V14.89h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.989C18.343 21.129 22 16.99 22 12c0-5.523-4.477-10-10-10z"/></svg>
										</a>
									</div>
									<div class="share-btn insta">
										<a href="" class="share_popup" target="_blank">
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/Instagram_Glyph_Gradient_RGB.png" alt="Instagramアイコン">
										</a>
									</div>
									<div class="share-btn line">
										<a href="" class="share_popup" target="_blank">
											<?//xml version="1.0" encoding="utf-8" ?>
											<!-- Generator: Adobe Illustrator 24.3.0, SVG Export Plug-In . SVG Version: 6.00 Build 0) -->
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
						</div><!-- inner_menu_sp -->
					</section>
				<!--</div>--><!-- menuToggle -->
				<!--</div> inner_sp_menu -->
			</nav>
		</header>
		<!----- END OF HEADER ----->

		<div id="navOverlay"></div>
			<?php //endif; ?>
			<main class="main <?php if($_GET['um_action'] == 'edit'){echo 'profEditWrap';} ?>">
			<?php if(!is_page('about')): ?>
				<div class="wrap_content">
					<article class="content">
					<?php endif; ?>
