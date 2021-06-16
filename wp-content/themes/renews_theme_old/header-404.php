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
	<script src="<?php echo get_template_directory_uri(); ?>/js/common.js"></script>
	

	<!-- add -->
	<link href="//fonts.googleapis.com/css?family=Noto+Sans+JP:400,500,700&display=swap" rel="stylesheet"> 
	
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/lower1.min.css" rel="stylesheet" media="all" />
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/donation.min.css" rel="stylesheet" media="all" />
	<link href="<?php echo get_template_directory_uri(); ?>/css/pages/error.min.css" rel="stylesheet" media="all" />
	
	<script src="<?php echo get_template_directory_uri(); ?>/js/libs/imgLiquid-min.js"></script>
	
	
	<?php wp_head(); ?>
	
</head>

	<body class="page" id="error">
		

		<div class="wrapper" id="wrap">

			<main class="main">
				<div class="content_error">
					<article class="content">