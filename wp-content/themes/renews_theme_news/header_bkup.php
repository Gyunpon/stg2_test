<!DOCTYPE html>
<html lang="ja">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="format-detection" content="telephone=no" />
	
	
	<!-- favicon -->
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon/favicon.ico" />
	<!-- apple-touch-icon -->
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon/apple-touch-icon.png" />
	
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
	<script src="<?php echo get_template_directory_uri(); ?>/js/function.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/common.js"></script>
	

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
	<script>
		grecaptcha.ready(function () {
			grecaptcha.execute('6LfQE_YUAAAAAE0yo7a_spXYH3MliOmIRVAtC0kv', { action: 'contact' }).then(function (token) {
				var recaptchaResponse = document.getElementById('mw_wp_form_token');
				recaptchaResponse.value = token;
			});
		});
	</script>


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
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/top.min.css" rel="stylesheet" media="all" />
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/article.min.css" rel="stylesheet" media="all" />
	<link href="<?php echo get_template_directory_uri(); ?>/css/single.css" rel="stylesheet" media="all" />
	<link href="<?php echo get_template_directory_uri(); ?>/css/single-articles.css" rel="stylesheet" media="all" />
	<?php endif ; ?>
	

	<link href="<?php echo get_template_directory_uri(); ?>/css/information.css" rel="stylesheet" media="all" />

	<link href="<?php echo get_template_directory_uri(); ?>/css/add.css" rel="stylesheet" media="all" />

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
								<polygon class="st0" points="58,22 58,8 75,8 75,10 60,10 60,14 75,14 75,16 60,16 60,20 75,20 75,22 	" />
								<polygon class="st0" points="22,14 22,0 39,0 39,2 24,2 24,6 39,6 39,8 24,8 24,12 39,12 39,14 	" />
								<polygon class="st0" points="52.9,18 44,7.2 44,18 42,18 42,4 44.1,4 53,14.8 53,4 55,4 55,18 	" />
								<polygon class="st0" points="89.6,18 86.1,7.4 82.7,18 80.7,18 76.1,4 78.2,4 81.7,14.6 85.2,4 87.1,4 90.6,14.6 94.1,4 96.1,4  91.5,18 	" />
								<path class="st0" d="M103.4,18.1c-2,0-4-0.8-5.6-2.3l-0.2-0.2l1.3-1.5l0.2,0.2c1.2,1.1,2.8,1.7,4.3,1.7c0.6,0,1.1-0.1,1.6-0.3 c0.8-0.3,1.2-0.9,1.2-1.6c0-1.3-1-1.7-3.3-2.3c-1.9-0.5-4.6-1.2-4.6-4c0-1.5,0.8-2.8,2.2-3.4c0.7-0.3,1.5-0.5,2.4-0.5 c1.7,0,3.5,0.6,4.8,1.7l0.2,0.2l-1.3,1.5l-0.2-0.2c-1-0.8-2.2-1.3-3.5-1.3c-0.6,0-1.2,0.1-1.6,0.3c-0.7,0.3-1.1,0.9-1.1,1.6 c0,1.1,0.8,1.5,3.1,2.1c2,0.5,4.8,1.2,4.8,4.2c0,1.5-0.9,2.8-2.3,3.5C105.1,17.9,104.3,18.1,103.4,18.1z" />
								<path class="st0" d="M14.5,11.8c2.6-0.7,4.5-3,4.5-5.8c0-3.3-2.7-6-6-6H0v12v6h2v-6h10.1l4.7,6h2.5L14.5,11.8z M2,10V2h11 c2.2,0,4,1.8,4,4s-1.8,4-4,4H2z" />
							</g>
						</svg>
					</a>
				</div>


				<nav class="nav_header">
					<ul class="list_nav_header flex">
						<li class="item_nav_header header-article"><a href="<?php echo network_home_url(); ?>article/" class="target_nav_header">新着</a></li>
						<li class="item_nav_header header-agenda"><a href="<?php echo network_home_url(); ?>agenda/" class="target_nav_header">アジェンダ</a></li>
						<li class="item_nav_header header-series"><a href="<?php echo network_home_url(); ?>series/" class="target_nav_header">シリーズ</a></li>
						<li class="item_nav_header header-renewer"><a href="<?php echo network_home_url(); ?>renewers/" class="target_nav_header kana">リニュアー</a></li>
						<li class="item_nav_header header-about"><a href="<?php echo network_home_url(); ?>about/" class="target_nav_header">リニューズとは</a></li>
					</ul>
				</nav>

				<div id="headerShareLinkBtn"><a href="#headerShareLink" uk-toggle><img src="<?php echo get_template_directory_uri(); ?>/images/icons/share.svg" alt="" /></a></div>

				<div id="headerShareLink" class="uk-flex-top" uk-modal>
					<div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
						<?php 
						//元となるテキスト
						$text = 'RENEWS | ';
						$siteURL = rawurlencode(network_home_url());
						//URLエンコード処理
						$encoded = rawurlencode( $text ) ;
						?>
						<button class="uk-modal-close-default" type="button" uk-close></button>
						<p class="shareBtnTitle"><img src="<?php echo get_template_directory_uri(); ?>/images/about/about.png" alt="RENEWS" /><span>をシェアする</span></p>
						<ul class="shareBtnList">
							<li><a href="//twitter.com/share?url=<?php echo network_home_url(); ?>&text=<?php echo $encoded; ?>" class="shareBtn twitter share_popup" target="_blank"><i class="fab fa-twitter"></i><span>Twitter</span></a></li>
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
								<form role="search" method="get" id="searchform_sp" class="search-form" action="<?php echo network_home_url( '/' ); ?>">
									<input type="text" placeholder="検索する" name="s" id="search_sp" autocomplete="off">
									<button id="searchsubmit_sp" class="search__btn"></button>
								</form>
							</div>

						</div>
					</div>

					<div class="search-box for_pc">
						<form role="search" method="get" id="searchform" class="search-form" action="<?php echo network_home_url( '/' ); ?>">
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
						$user_roles = $user->roles[0];

						//現在のアカウント
						$login_userBase = wp_get_current_user();

						$login_user_id = $login_userBase->user_nicename;
						$login_user_name = $login_userBase->display_name;

						//						$follow_url = ''. home_url() .'/follow/';
						?>
						<a href="<?php echo network_home_url(); ?>member/">
							<span class="uk-badge badge_btn_sp_menu"><?php echo do_shortcode('[ultimatemember_notification_count]'); ?></span>
							<div class="userIcon"><?php echo get_avatar($user->get('ID'), 64); ?></div>
						</a>
					</div>

					<?php else: ?>
					<a href="<?php echo network_home_url(); ?>login/">ログイン</a>
					<?php endif; ?>
				</div>

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

								//ユーザーごとリンク
								?>
								<div class="flex list_mypage">
									<a href="<?php echo network_home_url(); ?>member/">マイページ</a>
									<div class="user_avatar">
										<a href="<?php echo network_home_url(); ?>member/">
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
									<?php 
									//元となるテキスト
									$text = 'RENEWS | ';
									$siteURL = rawurlencode(home_url());
									//URLエンコード処理
									$encoded = rawurlencode( $text ) ;
									?>
									<ul class="social flex">
										<li class="social_button">
											<a href="//twitter.com/share?url=<?php echo home_url(); ?>&text=<?php echo $encoded; ?>" target="_blank">
												<i class="um-faicon-twitter"></i>
											</a>
										</li>
										<li class="social_button">
											<a href="//www.facebook.com/sharer/sharer.php?u=<?php echo $siteURL; ?>" target="_blank">
												<i class="um-faicon-facebook-square"></i>
											</a>
										</li>
										<li class="social_button">
											<a href="//social-plugins.line.me/lineit/share?url=<?php echo $siteURL; ?>" target="_blank">
												<img src="<?php echo get_template_directory_uri(); ?>/images/icons/line_wh.svg" alt="LINE" />
											</a>
										</li>
										<li class="social_button">
											<a href="http://b.hatena.ne.jp/add?mode=confirm&url=<?php echo $siteURL; ?>&title=<?php echo $encoded; ?>" target="_blank">
												<img src="<?php echo get_template_directory_uri(); ?>/images/icons/hatena_wh.svg" alt="hatena" />
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