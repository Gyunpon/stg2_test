<?php
// JS・CSSファイルを読み込む
function add_files() {

	//開発中はここの値をtrueに
	$debugMode = false;
	$timeStamp = date("YmdHis");
	
	//バージョンの数字
	

	// WordPress提供のjquery.jsを読み込まない
	wp_deregister_script('jquery');
	wp_deregister_script('common');
	wp_deregister_script('anime');
	wp_deregister_script('uikit');
	wp_deregister_script('uikit-icons');
	wp_deregister_script('fontawesome');
	//wp_deregister_script('under');
	
	// jQueryの読み込み
	wp_enqueue_script( 'jquery', '//code.jquery.com/jquery-2.2.4.min.js', "","", false );
	

	wp_enqueue_style( 'animate', '//cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css', "", $timeStamp );
	wp_enqueue_script( 'anime', '//cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js', "","", false );
	
	wp_enqueue_style( 'uikit', '//cdn.jsdelivr.net/npm/uikit@3.2.3/dist/css/uikit.min.css', "", $timeStamp );
	
	wp_enqueue_script( 'uikit', '//cdn.jsdelivr.net/npm/uikit@3.2.3/dist/js/uikit.min.js', "","", false );
	wp_enqueue_script( 'uikit-icons', '//cdn.jsdelivr.net/npm/uikit@3.2.3/dist/js/uikit-icons.min.js', "","", false );
	
	wp_enqueue_script( 'fontawesome', '//kit.fontawesome.com/55b5b4c129.js', "","", false );
	
	wp_enqueue_style( 'reset', get_template_directory_uri() . '/css/reset.min.css', "", $timeStamp );
	wp_enqueue_style( 'all', get_template_directory_uri() . '/css/all.min.css', "", $timeStamp );
	wp_enqueue_script( 'common', get_template_directory_uri() . '/js/common.js', array( 'jquery' ), $timeStamp,$debugMode );
	
	if(is_home() || is_front_page()){
		wp_enqueue_style( 'top', get_template_directory_uri() . '/css/pages/top.min.css', "", $timeStamp );
	}
	
	wp_enqueue_script( 'imgLiquid', get_template_directory_uri() . '/js/lib/imgLiquid-min.js', array( 'jquery' ), $timeStamp,$debugMode );


}
add_action('wp_enqueue_scripts', 'add_files');
?>