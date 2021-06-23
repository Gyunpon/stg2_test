<?php
	$noImage_thumbnail = get_template_directory_uri().'/images/icon/noimg_thumbnail.png';
	$noImage_mainImg = get_template_directory_uri().'/images/icon/noimg_single.png';
	$archivePageNum = 12;

//$http = is_ssl() ? 'https' : 'http' . '';
//$url = $http .'://'. $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
//$keys = parse_url($url); //パース処理
//$path = explode("/", $keys['path']); //分割処理
//$index_user = $path[1];
//$index_renewsid = $path[2];
//$index_userdata = get_user_by('slug',$index_renewsid);
//
//$index_uid = $index_userdata->ID;
//$index_all_roles = $index_userdata->roles;
//$index_flg = '';
////権限にリニュアーが含まれていたら
//if(in_array("um_renewer", $index_all_roles)){
//	$index_flg = 'true';
//}elseif(in_array("um_member", $index_all_roles)){
//	$index_flg = 'false';
//}else{
////	$redirect_flg = 'false';
//}
//
//
////条件分岐
//if($index_user == '-' && $index_flg == 'true'){
//	return 'index,follow';
//}elseif(($index_user == '-' && $index_flg == 'false')){
//	return 'noindex,nofollow';
//}elseif(is_page(array('agenda','series','renewers','about'))){
//	return 'index,follow';
//}else{
//	//			var_dump($redirect_flg);
//	//			var_dump('非ログイン：リニュアー以外');
//}


/*
add_filter( 'wpseo_robots', 'custom_robots' );
function custom_robots($robots) {
	$user = wp_get_current_user();
	$index_roles = $user->roles;
	$index_flg = '';
	//権限にリニュアーが含まれていたらリダイレクトしない
	if(in_array("um_renewer", $index_roles)){
		$index_flg = 'true';
	}elseif(in_array("um_member", $index_roles)){
		$index_flg = 'false';
	}else{
		//$index_flg = 'true';
	}

	$http = is_ssl() ? 'https' : 'http' . '';
	$url = $http .'://'. $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
	$keys = parse_url($url); //パース処理
	$path = explode("/", $keys['path']); //分割処理
	$slug_user = $path[1];
	$slug_member_under = $path[2];
	//	var_dump($user_roles);


	//条件分岐
	if($slug_user == '-' && $index_flg == 'true'){
		return 'index,nofollow';
	}elseif(($slug_user == '-' && $index_flg == 'false')){
		return 'noindex,nofollow';
	}elseif(is_page(array('agenda','series','renewers','about'))){
		return 'index,nofollow';
	}else{
		//			var_dump($redirect_flg);
		//			var_dump('非ログイン：リニュアー以外');
	}
	return $robots;
}
*/

//if(in_array("um_renewer", $redirect_all_roles)){
//	$redirect_flg = 'false';
//}elseif(in_array("um_member", $redirect_all_roles)){
//	$redirect_flg = 'true';
//}else{
//	$redirect_flg = 'false';
//}


if (!is_user_logged_in()){

	//ログインしてなければTOPページにリダイレクト
	$http = is_ssl() ? 'https' : 'http' . '';
	$url = $http .'://'. $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
	$keys = parse_url($url); //パース処理
	$path = explode("/", $keys['path']); //分割処理

	$page_user = $path[1];
	$page_renewsid = $path[2];
	$page_userdata = get_user_by('slug',$page_renewsid);

	if($page_userdata){
		$redirect_uid = $page_userdata->ID;
		$redirect_all_roles = $page_userdata->roles;
	}
	$redirect_flg = '';
	//権限にリニュアーが含まれていたらリダイレクトしない
	if(!empty($redirect_all_roles)){
		if(in_array("um_renewer", $redirect_all_roles)){
			$redirect_flg = 'false'; //リニュアーが含まれていたら
		}else{
			$redirect_flg = 'true'; //含まれていなかったら
		}
	}

	if($page_user == '-' && $redirect_flg == 'false'){
		//			var_dump('非ログイン：リニュアー');
		//			var_dump($redirect_flg);
	}elseif(($page_user == '-' && $redirect_flg == 'true')){
		//			var_dump('非ログイン：メンバー');
		//			var_dump($redirect_flg);
		wp_safe_redirect( home_url(), 301 );
		exit;
	}else{
		//			var_dump($redirect_flg);
		//			var_dump('非ログイン：リニュアー以外');
	}
	//Yoast SEOのcanonical非表示
	if($page_user == '-'){
		add_filter( 'wpseo_canonical', '__return_false' );
	}

}

/*-------------------------------------------------------------------------------*/

// 自動canonical 吐き出し停止
remove_action('wp_head', 'rel_canonical');

// アイキャッチ有効化
add_theme_support('post-thumbnails');

// pタグ自動挿入無効
//if(!is_single()){
	remove_filter('the_content', 'wpautop');
//}

// 管理画面の投稿でカテゴリーを選択して保存すると、階層構造が崩れるのを防ぐ
function lig_wp_category_terms_checklist_no_top( $args, $post_id = null ) {
	$args['checked_ontop'] = false;
	return $args;
}
add_action( 'wp_terms_checklist_args', 'lig_wp_category_terms_checklist_no_top' );

//自動変換を無効化する
remove_filter('the_title', 'wptexturize');
remove_filter('the_content', 'wptexturize');

//「＆」が「#038;」に自動変換されるのを対処
remove_filter('the_title', 'convert_chars');


// add_filter('the_content', 'my_replace_amp');

// カスタムメニュー有効化
//add_theme_support('menus');

// 管理画面 ビジュアルエディタ領域CSS読み込み
add_editor_style('css/editorStyle.css');

/*-------------------------------------------------------------------------------*/
// フィルタの登録、iframeを誰でも使えるようにする！
add_filter('content_save_pre','test_save_pre');

function test_save_pre($content){
	global $allowedposttags;

	// iframeとiframeで使える属性を指定する
	$allowedposttags['iframe'] = array('class' => array () , 'src'=>array() , 'width'=>array(),
	'height'=>array() , 'frameborder' => array() , 'scrolling'=>array(),'marginheight'=>array(),
	'marginwidth'=>array());

	return $content;
}
/*-------------------------------------------------------------------------------*/
/* Webp対応 2021/06/11 */
//* WebP File Upload
function add_file_types_to_uploads( $mimes ) {
	$mimes['webp'] = 'image/webp';
	return $mimes;
}
add_filter( 'upload_mimes', 'add_file_types_to_uploads' );

//* WebP image thumbnail display on media　Library
function webp_is_displayable($result, $path) {
    if ($result === false) {
        $displayable_image_types = array( IMAGETYPE_WEBP );
        $info = @getimagesize( $path );

        if (empty($info)) {
            $result = false;
        } elseif (!in_array($info[2], $displayable_image_types)) {
            $result = false;
        } else {
            $result = true;
        }
    }
    return $result;
}
add_filter('file_is_displayable_image', 'webp_is_displayable', 10, 2);

/*-------------------------------------------------------------------------------*/
/* ビジュアルエディタ禁止 */
function disable_visual_editor_in_page() {
	global $typenow;
	if( $typenow == 'page' ){
		// 固定ページ
		add_filter('user_can_richedit', 'disable_visual_editor_filter');
	}
	if( $typenow == 'mw-wp-form' ){
		// MW WP FORM 設定ページ
		add_filter('user_can_richedit', 'disable_visual_editor_filter');
	}
}
function disable_visual_editor_filter(){
	return false;
}
add_action('load-post.php', 'disable_visual_editor_in_page');
add_action('load-post-new.php', 'disable_visual_editor_in_page');


/*-------------------------------------------------------------------------------*/
/* 設定ファイル include */

// 【管理画面】初期設定
include('setting/adminSetting.php');

// 【管理画面】カスタム投稿一覧にカスタムタクソノミーの欄を追加
include('setting/adminCPTArchiveCustom.php');

// お問い合わせ（MWWPFORM） バリデート
include('setting/formValidata.php');

// オリジナルショートコード
include('setting/shortcode.php');

// サムネイルサイズ追加
include('setting/thumbnails.php');

// ultimate member通知メール追加
//include('setting/umMailCustom.php');

/*-------------------------------------------------------------------------------*/
// 開発用関数

function preDump($d){
	echo '<pre>';
	var_dump($d);
	echo '</pre>';
}

/*-------------------------------------------------------------------------------*/

	// 現在の年月日を取得する
	function getCurrentDate() {
		$dt = new DateTime();
		$dt->setTimeZone(new DateTimeZone('Asia/Tokyo'));

		return $dt->format('Y-m-d');
	}

	// 現在からn日前を取得する
	function getPrevDate($n) {
		return date("Y-m-d H:i:s",strtotime("-".$n." day"));
	}

	// 全n件中j件～k件目を表示」を表示する
	function page_post_count_text($qqq=null) {
		global $wp_query;
		$postPerPage=0;

		$trgQuery = $wp_query;
		if(!empty($qqq)){
			$trgQuery = $qqq;
		}
		$paged = get_query_var( 'paged' ) - 1;
		$ppp   = get_query_var( 'posts_per_page' );
		$count = $total = $trgQuery->post_count;
		$from  = 0;
		if ( 0 < $ppp ) {
			$total = $trgQuery->found_posts;
			if ( 0 < $paged )
				$from  = $paged * $ppp;
		}
		printf(
			'全%1$s件中 %2$s%3$s件目を表示',
			$total,
			( 1 < $count ? ($from + 1 . '件目～') : '' ),
			($from + $count )
		);
	}

	// 親固定ページのスラッグ取得
	function is_parent_slug() {
		global $post;
		if ($post->post_parent) {
			$post_data = get_post($post->post_parent);
			return $post_data->post_name;
		}
	}

	// 最上位親固定ページのスラッグ取得
	function is_mostParent_slug(){
		global $post;
		$current_id = $post->ID;
		$current_post = get_post($current_id);
		$par_id = $current_post->post_parent;
		while($par_id != 0){
			$par_post = get_post($par_id);
			$current_post = $par_post;
			$par_id = $par_post->post_parent;
		}

		return $current_post->post_name;
	}


	/*-------------------------------------------------------------------------------*/

	// タブレット判別
	function is_tablet(){
		/* ユーザーエージェント取得 */
		$ua = $_SERVER['HTTP_USER_AGENT'];
		if (strpos($ua, 'Android') !== false && strpos($ua, 'Mobile') === false){
			return true;
		}elseif (strpos($ua, 'Android') !== false && strpos($ua, 'Mobile') !== false){
			return false;
		}elseif (strpos($ua, 'iPhone') !== false){
			return false;
		}elseif (strpos($ua, 'iPad') !== false){
			return true;
		}elseif (strpos($ua, 'iPod') !== false){
			return false;
		}else{
			return false;
		}
	}


	/*-------------------------------------------------------------------------------*/
	// アーカイブページで現在のカテゴリー・タグ・タームを取得する

	function get_current_term(){
		$id;
		$tax_slug;

		if(is_category()){
			$tax_slug = "category";
			$id = get_query_var('cat');
		}else if(is_tag()){
			$tax_slug = "post_tag";
			$id = get_query_var('tag_id');
		}else if(is_tax()){
			$tax_slug = get_query_var('taxonomy');
			$term_slug = get_query_var('term');
			$term = get_term_by("slug",$term_slug,$tax_slug);
			$id = $term->term_id;
		}

		return get_term($id,$tax_slug);
	}


/*-------------------------------------------------------------------------------*/
// カスタム投稿対応パンくず

//一番下の階層のカテゴリーを返す関数
function get_youngest_cat($categories){
	global $post;
	if(count($categories) == 1 ){
		$youngest = $categories[0];
	}
	else{
		$count = 0;
		foreach($categories as $category){ //それぞれのカテゴリーについて調査
			$children = get_term_children( $category -> term_id, 'category' ); //子カテゴリーの ID を取得
			if($children){ //子カテゴリー（の ID ）が存在すれば
				if ( $count < count($children) ){ //子カテゴリーの数が多いほど、そのカテゴリーは階層が下なのでそれを元に調査するかを判定
					$count = count($children); //$count に子カテゴリーの数を代入
					$lot_children = $children;
					foreach($lot_children as $child){ //それぞれの「子カテゴリー」について調査 $childは子カテゴリーのID
						if( in_category( $child, $post -> ID ) ){ //現在の投稿が「子カテゴリー」のカテゴリーに属するか
							$youngest = get_category($child); //属していればその「子カテゴリー」が一番若い（一番下の階層）
						}
					}
				}
			}
			else{ //子カテゴリーが存在しなければ
				$youngest = $category; //そのカテゴリーが一番若い（一番下の階層）
			}
		}
	}
	return $youngest;
}



//一番下の階層のタクソノミーを返す関数
function get_youngest_tax($taxes, $mytaxonomy){
	global $post;
	if(count($taxes) == 1 ){
		$youngest = $taxes[key($taxes)];
	}
	else{
		$count = 0;
		foreach($taxes as $tax){ //それぞれのタクソノミーについて調査
			$children = get_term_children( $tax -> term_id, $mytaxonomy ); //子タクソノミーの ID を取得
			if($children){ //子カテゴリー（の ID ）が存在すれば
				if ( $count < count($children) ){ //子タクソノミーの数が多いほど、そのタクソノミーは階層が下なのでそれを元に調査するかを判定
					$count = count($children); //$count に子タクソノミーの数を代入
					$lot_children = $children;
					foreach($lot_children as $child){ //それぞれの「子タクソノミー」について調査 $childは子タクソノミーのID
						if( is_object_in_term( $post -> ID, $mytaxonomy ) ){ //現在の投稿が「子タクソノミー」のタクソノミーに属するか
							$youngest = get_term($child, $mytaxonomy); //属していればその「子タクソノミー」が一番若い（一番下の階層）
						}
					}
				}
			}
			else{ //子タクソノミーが存在しなければ
				$youngest = $tax; //そのタクソノミーが一番若い（一番下の階層）
			}
		}
	}
	return $youngest;
}

// 出力関数
function breadcrumb($args = array()){
	global $post;
	$str ='';
	$defaults = array(
		'id' => "breadcrumb",
		'class' => "inner clearfix",
		'home' => "Home",
		'search' => "で検索した結果",
		'tag' => "タグ",
		'author' => "投稿者",
		'notfound' => "404 Not found",
		'separator' => '&nbsp;&gt;&nbsp;'
	);
	$args = wp_parse_args( $args, $defaults );
	extract( $args, EXTR_SKIP );
	if(is_home() || is_front_page()) {
		echo '<div id="'. $id .'" class="' . $class.'" >'.'<ul><li>'. $home .'</li></ul></div>';
	}
	if(!is_home() && !is_front_page() && !is_admin()){//!is_admin は管理ページ以外という条件分岐
		$str.= '<div id="'. $id .'" class="' . $class.'" >';
		$str.= '<ul>';
		$str.= '<li><a href="'. home_url() .'/">'. $home .'</a></li>';
		$str.= '<li>'.$separator.'</li>';
		$my_taxonomy = get_query_var('taxonomy'); //[taxonomy] の値（タクソノミーのスラッグ）
		$cpt = get_query_var('post_type'); //[post_type] の値（投稿タイプ名）
		if($my_taxonomy && is_tax($my_taxonomy)) {//カスタム分類のページ
			$my_tax = get_queried_object(); //print_r($my_tax);
			$post_types = get_taxonomy( $my_taxonomy )->object_type;
			$cpt = $post_types[0]; //カスタム分類名からカスタム投稿名を取得。
			$str.='<li><a href="' .get_post_type_archive_link($cpt).'">'. get_post_type_object($cpt)->label.'</a></li>'; //カスタム投稿のアーカイブへのリンクを出力
			$str.='<li>'.$separator.'</li>';
			if($my_tax -> parent != 0) { //親があればそれらを取得して表示
				$ancestors = array_reverse(get_ancestors( $my_tax -> term_id, $my_tax->taxonomy ));
				foreach($ancestors as $ancestor){
					$str.='<li><a href="'. get_term_link($ancestor, $my_tax->taxonomy) .'">'. get_term($ancestor, $my_tax->taxonomy)->name .'</a></li>';
					$str.='<li>'.$separator.'</li>';
				}
			}
			$str.='<li>'. $my_tax -> name . '</li>';
		}elseif(is_category()) { //カテゴリーのアーカイブページ
			$cat = get_queried_object();
			if($cat -> parent != 0){
				$ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
				foreach($ancestors as $ancestor){
					$str.='<li><a href="'. get_category_link($ancestor) .'">'. get_cat_name($ancestor) .'</a></li>';
					$str.='<li>'.$separator.'</li>';
				}
			}
			$str.='<li>'. $cat -> name . '</li>';
		}elseif(is_post_type_archive()) { //カスタム投稿のアーカイブページ
			$cpt = get_query_var('post_type');
			$str.='<li>'. get_post_type_object($cpt)->label . '</li>';
		}elseif($cpt && is_singular($cpt)){ //カスタム投稿の個別記事ページ
			$taxes = get_object_taxonomies( $cpt );

			$postTerms = (!empty($taxes))? get_the_terms($post->ID, $taxes[0]) : '';

			if(!empty($postTerms) && !empty($taxes)){// カスタム投稿にタクソノミーがあった場合、カテゴリー付きのパンくず出力
				$mytax = $taxes[0];
				$str.='<li><a href="' .get_post_type_archive_link($cpt).'">'. get_post_type_object($cpt)->label.'</a></li>'; //カスタム投稿のアーカイブへのリンクを出力
				$str.='<li>'.$separator.'</li>';
				$taxes = get_the_terms($post->ID, $mytax);
				$tax = get_youngest_tax($taxes, $mytax ); //print_r($tax);
				if($tax -> parent != 0){
					$ancestors = array_reverse(get_ancestors( $tax -> term_id, $mytax ));
					foreach($ancestors as $ancestor){
						$str.='<li><a href="'. get_term_link($ancestor, $mytax).'">'. get_term($ancestor, $mytax)->name . '</a></li>';
						$str.='<li>'.$separator.'</li>';
					}
				}
				$str.='<li><a href="'. get_term_link($tax, $mytax).'">'. $tax -> name . '</a></li>';
				$str.='<li>'.$separator.'</li>';
				$str.= '<li>'. $post -> post_title .'</li>';
			}else{// カスタム投稿にタクソノミーがない場合、アーカイブ＞記事の形で出力
				$cpt = get_query_var('post_type');
				$str.='<li><a href="' .get_post_type_archive_link($cpt).'">'. get_post_type_object($cpt)->label.'</a></li>'; //カスタム投稿のアーカイブへのリンクを出力
				$str.='<li>'.$separator.'</li>';
				$str.= '<li>'. $post -> post_title .'</li>';
			}
		}elseif(is_single()){ //個別記事ページ
			$categories = get_the_category($post->ID);
			$cat = get_youngest_cat($categories);
			if($cat -> parent != 0){
				$ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
				foreach($ancestors as $ancestor){
					$str.='<li><a href="'. get_category_link($ancestor).'">'. get_cat_name($ancestor). '</a></li>';
					$str.='<li>'.$separator.'</li>';
				}
			}
			$str.='<li><a href="'. get_category_link($cat -> term_id). '">'. $cat-> cat_name . '</a></li>';
			$str.='<li>'.$separator.'</li>';
			$str.= '<li>'. $post -> post_title .'</li>';
		} elseif(is_page()){ //固定ページ
			if($post -> post_parent != 0 ){
				$ancestors = array_reverse(get_post_ancestors( $post->ID ));
				foreach($ancestors as $ancestor){
					$str.='<li><a href="'. get_permalink($ancestor).'">'. get_the_title($ancestor) .'</a></li>';
					$str.='<li>'.$separator.'</li>';
				}
			}
			$str.= '<li>'. $post -> post_title .'</li>';
		} elseif(is_date()){ //日付ベースのアーカイブページ
			if(get_query_var('day') != 0){ //年別アーカイブ
				$str.='<li><a href="'. get_year_link(get_query_var('year')). '">' . get_query_var('year'). '年</a></li>';
				$str.='<li>'.$separator.'</li>';
				$str.='<li><a href="'. get_month_link(get_query_var('year'), get_query_var('monthnum')). '">'. get_query_var('monthnum') .'月</a></li>';
				$str.='<li>'.$separator.'</li>';
				$str.='<li>'. get_query_var('day'). '日</li>';
			} elseif(get_query_var('monthnum') != 0){ //月別アーカイブ
				$str.='<li><a href="'. get_year_link(get_query_var('year')) .'">'. get_query_var('year') .'年</a></li>';
				$str.='<li>'.$separator.'</li>';
				$str.='<li>'. get_query_var('monthnum'). '月</li>';
			} else { //年別アーカイブ
				$str.='<li>'. get_query_var('year') .'年</li>';
			}
		} elseif(is_search()) { //検索結果表示ページ
			$str.='<li>「'. get_search_query() .'」'. $search .'</li>';
		} elseif(is_author()){ //投稿者のアーカイブページ
			$str .='<li>'. $author .' : '. get_the_author_meta('display_name', get_query_var('author')).'</li>';
		} elseif(is_tag()){ //タグのアーカイブページ
			$str.='<li>'. $tag .' : '. single_tag_title( '' , false ). '</li>';
		} elseif(is_attachment()){ //添付ファイルページ
			$str.= '<li>'. $post -> post_title .'</li>';
		} elseif(is_404()){ //404 Not Found ページ
			$str.='<li>'.$notfound.'</li>';
		} else{ //その他
			$str.='<li>'. wp_title('', true) .'</li>';
		}
		$str.='</ul>';
		$str.='</div>';
	}
	echo $str;
}

/*-------------------------------------------------------------------------------*/



/* 「投稿」非表示 */
if (is_main_site()) {
	add_action( 'admin_menu', 'remove_menus' );
	function remove_menus(){
		remove_menu_page( 'edit.php' ); //投稿メニュー
	}
}

//オプションページ追加
if( function_exists('acf_add_options_page') ) {

	//TOPページ
	acf_add_options_page(array(
		'page_title' 	=> 'TOPページ表示オプション',
		'menu_title'	=> 'TOPページ表示オプション',
		'menu_slug' 	=> 'top-options',
		'capability'	=> 'edit_posts',
		'parent_slug'	=> '',
		'position'	=> false,
		'redirect'	=> false,
	));

}

// ユーザープロフィールの項目のカスタマイズ
function my_user_meta($wb)
{
	//項目の追加
	$wb['position'] = '役職';

	return $wb;
}
add_filter('user_contactmethods', 'my_user_meta', 10, 1);





/*開発ファイル読み込み*/
get_template_part( 'develop' );


/* comments */
function custom_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	$format = 'Y-m-d H:i:s';

	$comment_time = get_comment_time('U');//コメントが投稿された時間 タイムスタンプ
	$date_comment_time = date($format,$comment_time);//コメントが投稿された時間 日付形式
	$current_time = current_time('timestamp');//今の時間 タイムスタンプ
	$date_current_time = date($format,$current_time);//今の時間 日付形式

	$date_day7_later = date($format, strtotime('+7 day', strtotime($date_comment_time)));//コメントされた時間から1週間後
	if($date_current_time > $date_day7_later){ //「今の日付」が「コメントから7日後」を過ぎたら
		$human_time_diff = date('Y.m.d',$comment_time);
	}else{
		$human_time_diff = human_time_diff( $comment_time, $current_time ) . '前';
	}
?>
<?php
	$user_id = $comment->user_id;
	$comment_id = $comment->comment_ID;
	$comment_user_info = get_user_meta($user_id);
	$comment_user_id = $comment_user_info['nickname'][0];
	$comment_user_fullname = $comment_user_info['full_name'][0];
	$comment_user_firstname = $comment_user_info['first_name'][0];
	$comment_user_lastname = $comment_user_info['last_name'][0];

	//ユーザー権限
	$user_info = get_userdata($user_id);
	$user_roles = $user_info->roles;
	if ($_SERVER['REMOTE_ADDR'] == "115.179.101.53") {
		//		var_dump($comment);
	}

	//現在のユーザー
	$user = wp_get_current_user();
	$current_user = $user->ID;

	if(in_array("um_renewer", $user_roles)){
		$um_renewer = 'um_renewer';
	}else{
		$um_renewer = '';
	}
?>


<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-listCon comment_area level1 flex between">
			<?php if(in_array("um_renewer", $user_roles)): ?>
			<div class="comment-author vcard thumbs_article <?php if(in_array("um_renewer", $user_roles)){echo 'cutIcon';} ?>">
				<a href="<?php echo home_url(); ?>/user/<?php echo $comment_user_id; ?>/">
					<?php echo get_avatar( $user_id, 90 ); ?>
				</a>
			</div>
			<?php else: ?>
			<div class="comment-author vcard thumbs_article <?php if(in_array("um_renewer", $user_roles)){echo 'cutIcon';} ?>">
				<?php echo get_avatar( $user_id, 90 ); ?>
			</div>
			<?php endif; ?>


			<div class="wrap_comment <?php echo $um_renewer; ?>">
				<small class="sst_comment">
					<?php if(in_array("um_renewer", $user_roles)): ?>
					<?php if($comment_user_id): //ユーザーの有無 ?>
					<a href="<?php echo home_url(); ?>/user/<?php echo $comment_user_id; ?>/">
						<?php if(!empty($comment_user_firstname) || !empty($comment_user_lastname)): ?>
						<span class="color_black"><?php echo $comment_user_fullname; ?></span>
						<span>@<?php echo $comment_user_id; ?></span>
						<?php else: ?>
						<span>@<?php echo $comment_user_id; ?></span>
						<?php endif; ?>
					</a>
					<?php else: ?>
					<span>このユーザーは退会しました</span>
					<?php endif; ?>
					<?php else: ?>
					<?php if($comment_user_id): //ユーザーの有無 ?>
					<?php if(!empty($comment_user_firstname) || !empty($comment_user_lastname)): ?>
					<span class="color_black"><?php echo $comment_user_fullname; ?></span>
					<span>@<?php echo $comment_user_id; ?></span>
					<?php else: ?>
					<span>@<?php echo $comment_user_id; ?></span>
					<?php endif; ?>
					<?php else: ?>
					<span>このユーザーは退会しました</span>
					<?php endif; ?>
					<?php endif; ?>
					<span class="hours">
						<?php echo $human_time_diff; ?>
					</span>
				</small>

				<span class="comment-name sst_comment">

				</span>
				<?php if ($comment->comment_approved == '0') : ?>
				<em><?php _e('Your comment is awaiting moderation.') ?></em><br />
				<?php endif; ?>
				<div class="text_read commentWrap">
					<?php
	$commentText = get_comment_text();
//	$commentText = mb_strimwidth( $commentTextBase, 0, 240, "...", "UTF-8" );
					?>
					<div class="commentTextWrap grad-wrap">
						<span class="grad-trigger is-hide">続きを読む</span>
						<div class="commentText grad-item"><?php echo nl2br($commentText); ?></div>
					</div>
					<?php comment_text(); ?>
				</div>
				<div class="replyBtnWrap">
					<?php if($user_id == $current_user):
					?>

<div class="commentDeleteBtnWrap"><a href="javascript:void(0);" class="commentDeleteBtn" data-comment_id="<?php echo $comment_id; ?>" data-hide_li="li-comment-<?php echo $comment_id; ?>">削除</a></div>

					<?php endif; ?>
					<?php
	//いいね
//	if(function_exists('wp_ulike_comments')) wp_ulike('get');

	//コメント
//	var_dump(get_current_user_id());

//	if():
//	endif
					?>

					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'reply_text' => 'リプライを書く','login_text' => '') ) ); ?>
				</div>
			</div><!-- wrap_comment -->
		</div>
	</div>
	<?php
}

function move_comment_field( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;

	return $fields;
}
add_filter( 'comment_form_fields', 'move_comment_field' );




/* wp u like 数字の後のプラスマーク削除 */
add_filter('wp_ulike_format_number','wp_ulike_new_format_number',10,3);
function wp_ulike_new_format_number($value, $num, $plus){
	if ($num >= 1000 && get_option('wp_ulike_format_number') == '1'):
	$value = round($num/1000, 2) . 'K';
	else:
	$value = $num;
	endif;
	return $value;
}


//文字を丸める
function mb_strimlen($str, $start, $length, $trimmarker = '', $encoding = false) {
	$encoding = $encoding ? $encoding : mb_internal_encoding();
	$str = mb_substr($str, $start, mb_strlen($str), $encoding);
	if (mb_strlen($str, $encoding) > $length) {
		$markerlen = mb_strlen($trimmarker, $encoding);
		$str = mb_substr($str, 0, $length - $markerlen, $encoding) . $trimmarker;
	}
	return $str;
}


//関連公開済みの投稿のみ表示させる方法
add_filter( 'acf/fields/relationship/query', 'custom_acf_relationship_query', 10, 3 );
function custom_acf_relationship_query( $args, $field, $post_id ) {
	$args['post_status'] = 'publish';
	return $args;
}



function ua_smt (){
	//ユーザーエージェントを取得
	$ua = $_SERVER['HTTP_USER_AGENT'];
	//スマホと判定する文字リスト
	$ua_list = array('iPhone','iPad','iPod','Android');
	foreach ($ua_list as $ua_smt) {
		//ユーザーエージェントに文字リストの単語を含む場合はTRUE、それ以外はFALSE
		if (strpos($ua, $ua_smt) !== false) {
			return true;
		}
	} return false;
}

//管理画面 抜粋 位置変更
function custom_admin_script(){
	if( get_post_type() === 'articles' ): ?>
	<style>
		/* 抜粋を表示 */
		#postexcerpt {
			display: block;
		}
		/* 抜粋の説明文非表示 */
		#postexcerpt p {
			display: none;
		}
		/* 間隔調節 */
		#titlediv {
			margin-bottom: 10px;
		}
		#postexcerpt {
			margin-bottom: 0;
		}
	</style>
	<script>
		(function ($) {
			$(function () {
				var $excerpt = $('#postexcerpt');
				// タイトル文字を変更
				$('.hndle span', $excerpt).text('抜粋');
				// 表示位置をタイトルの下に移動
				$('#titlediv').after($excerpt);
			});
		})(jQuery);
	</script>
	<?php endif;
}
add_action("admin_head-post-new.php", "custom_admin_script");
add_action("admin_head-post.php", "custom_admin_script");

	function my_ajax_url() {
	?>
	<script>var ajaxUrl = '<?php echo admin_url('admin-ajax.php'); ?>';</script>
	<?php
	}
	add_action('wp_head', 'my_ajax_url', 1);

	//アジェンダ、シリーズフォロー-----------------
	//フォローする
	function add_user_follow(){
		// do something.
		$user_id = $_POST['uid'];
		$meta_key = $_POST['taxnomy'];
		$meta_value = $_POST['taxnomy_id'];
		add_user_meta($user_id, $meta_key, $meta_value);

		die();
	}
	add_action('wp_ajax_add_user_follow', 'add_user_follow');//ログインユーザー
	//add_action('wp_ajax_nopriv_my_ajax_php', 'my_ajax_php');//非ログインユーザー

	//フォロー外す
	function delete_user_follow(){
		// do something.
		$user_id = $_POST['uid'];
		$meta_key = $_POST['taxnomy'];
		$meta_value = $_POST['taxnomy_id'];
		delete_user_meta($user_id, $meta_key, $meta_value);
		die();
	}
	add_action('wp_ajax_delete_user_follow', 'delete_user_follow');//ログインユーザー


	//ストック記事-----------------
	//ブックマーク登録
	function add_bookmark(){
		// do something.
		$user_id = $_POST['uid'];
		$meta_key = 'article_follow';
		$meta_value = $_POST['post_id'];
		add_user_meta($user_id, $meta_key, $meta_value);
		//ストックしている人数
		$args = array(
			'meta_key'     => 'article_follow',
			'meta_value'   => $meta_value
		);
		$all_user_stockPost = get_users( $args );
		$stockNum = count($all_user_stockPost);
		echo $stockNum;
		die();
	}
	add_action('wp_ajax_add_bookmark', 'add_bookmark');//ログインユーザー

	//ブックマーク外す
	function delete_bookmark(){
		// do something.
		$user_id = $_POST['uid'];
		$meta_key = 'article_follow';
		$meta_value = $_POST['post_id'];
		delete_user_meta($user_id, $meta_key, $meta_value);
		//ストックしている人数
		$args = array(
			'meta_key'     => 'article_follow',
			'meta_value'   => $meta_value
		);
		$all_user_stockPost = get_users( $args );
		$stockNum = count($all_user_stockPost);
		echo $stockNum;
		die();
	}
	add_action('wp_ajax_delete_bookmark', 'delete_bookmark');//ログインユーザー



	//コメント削除
	function delete_my_comment(){
		// do something.
		$comment_id = $_POST['comment_id'];
		$force_delete = 'false';
		wp_delete_comment($comment_id, $force_delete);
		die();
	}
	add_action('wp_ajax_delete_my_comment', 'delete_my_comment');//ログインユーザー


	//ユーザー最終ログイン
//	function add_users_columns( $columns ) {
//		$columns['columns_lastlogin'] = '最終ログイン';
//		return $columns;
//	}
//	function add_users_custom_column( $column_name, $column, $user_id ) {
//		if ( $column == 'columns_lastlogin' ) {
//			$user_info = get_userdata($user_id);
//			$user_lastlogin_time = $user_info->last_login;
//			return date('Y/m/d',intval($user_lastlogin_time));
//		}
//	}
//	add_filter( 'manage_users_columns', 'add_users_columns' );
//	add_filter( 'manage_users_custom_column', 'add_users_custom_column', 10, 3 );



	//管理画面　記事ID表示
	function add_posts_columns_postid($columns) { $columns['postid'] = 'ID'; return $columns; } function add_posts_columns_postid_row($column_name, $post_id) { if( 'postid' == $column_name ) { echo $post_id; } } add_filter( 'manage_posts_columns', 'add_posts_columns_postid' ); add_action( 'manage_posts_custom_column', 'add_posts_columns_postid_row', 10, 2 );




	//ultimate members custom
		//リニュアーフォロー解除

		function delete_renewer_follow(){
			global $wpdb;
			$login_user_info = wp_get_current_user();
			$login_user_id = $login_user_info->ID;
			// do something.
			$user_id1 = $_POST['user_id1'];
			$user_id2 = $_POST['user_id2'];
			$wpdb->delete( 'wp_um_followers', array( 'user_id1' => $user_id1,'user_id2' => $login_user_id ) );
//			$remove_renewer = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."um_followers WHERE user_id2 = ".$login_user_id."");
			die();
		}
		add_action('wp_ajax_delete_renewer_follow', 'delete_renewer_follow');//ログインユーザー



	//プロフィール変更
//	add_action( 'um_after_user_updated', 'my_after_user_updated', 10, 3 );
//	function my_after_user_updated( $user_id, $args, $userinfo ) {
//		// your code here
//		$user_info = get_userdata($user_id);
//		$user_roles = $user_info->roles;
//		$user_name = $user_info->user_login;
//		if(in_array("um_member", $user_roles)){
////			var_dump($user_roles);
//
//			// リダイレクト先のURLへ転送する
//			$url = ''.home_url().'/notifications/';
////			$url = ''.home_url().'/user/'.$user_name.'/?um_action=edit';
//			header('Location: ' . $url, true, 301);
//
//			// すべての出力を終了
//			exit;
//		//	die();
//		}
//
//	}




//	add_action( 'um_members_just_after_name', 'my_members_just_after_name', 10, 2 );
//	function my_members_just_after_name( $user_id, $args ) {
//		// your code here
//		$user_info = get_userdata($user_id);
//		$user_login = $user_info->user_login;
//		echo '<a href="'.home_url().'/user/'.$user_login.'">aa</a>';
//	}

//	add_action( 'um_members_after_user_name', 'my_members_after_user_name', 10, 2 );
//	function my_members_after_user_name( $user_id, $args ) {
//		// your code here
//		$user_info = get_userdata($user_id);
//		$user_login = $user_info->user_login;
//		echo '<a href="'.home_url().'/user/'.$user_login.'" class="renewerIDLink"></a>';
//	}



	/**
 * サイト内検索の範囲に、カテゴリー名、タグ名、を含める
 */
	function custom_search($search, $wp_query) {
		global $wpdb;

		//サーチページ以外だったら終了
		if (!$wp_query->is_search)
			return $search;

		if (!isset($wp_query->query_vars))
			return $search;

		// ユーザー名とか、タグ名・カテゴリ名も検索対象に
		$search_words = explode(' ', isset($wp_query->query_vars['s']) ? $wp_query->query_vars['s'] : '');
		if ( count($search_words) > 0 ) {
			$search = '';
			foreach ( $search_words as $word ) {
				if ( !empty($word) ) {
					$search_word = $wpdb->escape("%{$word}%");
					$search .= " AND (
           {$wpdb->posts}.post_title LIKE '{$search_word}'
           OR {$wpdb->posts}.post_content LIKE '{$search_word}'
           OR {$wpdb->posts}.post_author IN (
             SELECT distinct ID
             FROM {$wpdb->users}
             WHERE display_name LIKE '{$search_word}'
             )
           OR {$wpdb->posts}.ID IN (
             SELECT distinct r.object_id
             FROM {$wpdb->term_relationships} AS r
             INNER JOIN {$wpdb->term_taxonomy} AS tt ON r.term_taxonomy_id = tt.term_taxonomy_id
             INNER JOIN {$wpdb->terms} AS t ON tt.term_id = t.term_id
             WHERE t.name LIKE '{$search_word}'
           OR t.slug LIKE '{$search_word}'
           OR tt.description LIKE '{$search_word}'
           )
       ) ";
				}
			}
		}

		return $search;
	}
	add_filter('posts_search','custom_search', 10, 2);



//
//	function change_posts_paging($query) {
//
//		// 管理画面やメインクエリーでない場合は除外
//		if ( is_admin() || ! $query->is_main_query() ) {
//			return;
//		}
//		// 検索結果ページ
//		if ( $query->is_search() ) {
//			// 公開されてる記事のみ検索
////			$query->set( 'post_status', publish );
//			// 投稿のみ検索
//			$query->set( 'post_type', post );
//			// 表示したくないカテゴリーID
////			$query->set( 'category__not_in', 1 );
//			//　表示したくない投稿ID。arrayで複数指定可。
////			$query->set( 'post__not_in', array( 1, 2, 3, 4, 5 ) );
//			//　検索結果の表示順
////			$query->set( 'order', DESC );
//			return;
//		}
//	}
//	add_action( 'pre_get_posts', 'change_posts_paging' );





	// UM 通知カスタマイズ
if(is_main_site()){
	include('setting/notificationCustom.php');
}


	// メール文面カスタマイズ
	include('setting/mailCustom.php');

	//UM 新規登録user_loginバリデーション
	add_action('um_submit_form_errors_hook_','um_custom_validate_username', 999, 1);
	function um_custom_validate_username( $args ) {

		if ( isset( $args['user_login'] ) && strstr( $args['user_login'], '.' ) ) {
			UM()->form()->add_error( 'user_login', '「.」は使用できません' );
		}
		if ( isset( $args['user_login'] ) && strstr( $args['user_login'], '-' ) ) {
			UM()->form()->add_error( 'user_login', '「-」は使用できません' );
		}
		if ( isset( $args['user_login'] ) && preg_match('/[A-Z]/',$args['user_login'])) {
			UM()->form()->add_error( 'user_login', '「英大文字」は使用できません' );
		}
	}

//マイページ　パスワード変更バリデート
add_action( 'um_change_password_errors_hook', 'my_change_password_errors', 10, 1 );
function my_change_password_errors( $post ) {

	//文字数が8文字未満だった場合
	$userPass = '';
	$confPass = '';
	$userPass = mb_strlen($post['user_password']);
	$confPass = mb_strlen($post['confirm_user_password']);

	if($userPass < 8){
		UM()->form()->add_error( 'user_password', '英数字で8文字以上入力してください' );
	}
	if($confPass < 8){
		UM()->form()->add_error( 'confirm_user_password', '英数字で8文字以上入力してください' );
	}

	//大文字が含まれていなかった場合
	if (!preg_match('/[A-Z]/', $post['user_password'])) {
		UM()->form()->add_error( 'user_password', '大文字を1文字以上含めてください' );
	}
	if (!preg_match('/[A-Z]/', $post['confirm_user_password'])) {
		UM()->form()->add_error( 'confirm_user_password', '大文字を1文字以上含めてください' );
	}

	//数字が含まれていなかった場合
	if (!preg_match('/[0-9]/', $post['user_password'])) {
		UM()->form()->add_error( 'user_password', '数字を1文字以上含めてください' );
	}
	if (!preg_match('/[0-9]/', $post['confirm_user_password'])) {
		UM()->form()->add_error( 'confirm_user_password', '数字を1文字以上含めてください' );
	}

}




// 	include('inc/spambotTemp.php');


	add_action( 'um_custom_field_validation_mail', 'my_custom_field_validation', 10, 3 );
	function my_custom_field_validation( $key, $field, $args ) {

		if(strpos($args['user_email'],'nobody') !== false){
			UM()->form()->add_error( $key, __( 'ご自身のメールアドレスを入力してください。', 'ultimate-member' ) );
		}

	}

// パスワード変更時のWP標準の自動返信メールを停止
add_filter( 'send_password_change_email', '__return_false' );


//マルチサイト 管理画面からユーザー登録する時のエラースキップ
add_filter('wpmu_validate_user_signup', 'mywp_username_validation');

/* ユーザ名にハイフンを含める為のフィルター */
function mywp_username_validation($result){
	# ユーザ名で小文字＋及び数字のみのエラーが発生している場合は エラーをリセット
	if (isset($result['errors']->errors['user_name']) && ($key = array_search(__('Usernames can only contain lowercase letters (a-z) and numbers.'), $result['errors']->errors['user_name'])) !== false) {
		unset($result['errors']->errors['user_name'][$key]);
		if (empty($result['errors']->errors['user_name'])) unset($result['errors']->errors['user_name']);

		# オリジナル条件でユーザ名をチェック
		# ここではアルファベット（大文字、小文字）、数字、記号（ハイフン、アンダースコア、アットマーク、ドット）を許可
		if ( $user_name != $orig_username || preg_match( '/[^a-z0-9_]/', $user_name ) ) {
			$errors->add( 'user_name', __( 'Usernames can only contain Alphabets (A-Z, a-z) and numbers, 4 special caracters (_)' ) );
			$user_name = $orig_username;
		}
	}
}


//?author=n でアクセスした際のリダイレクト
function disable_author_archive_query() {
	if( preg_match('/author=([0-9]*)/i', $_SERVER['QUERY_STRING']) ){
		wp_safe_redirect( home_url(), 301 );
		exit;
	}
}
add_action('init', 'disable_author_archive_query');



//LazyLoad機能のオフ
//add_filter( 'wp_lazy_loading_enabled', '__return_false' );


//新しい管理画面を追加//
add_action('admin_menu', 'additional_menu_page');

function additional_menu_page() {
  add_menu_page('追加メニュー', '追加メニュー', 'manage_options', 'additional_page', 'page_html');
}

function page_html() {
  //ページの表示内容を記述する
  include('edit_ver2.php');
}


// TinyMCE Advancedのフォントサイズ変更
function tinymce_custom_fonts($setting){
	$setting['fontsize_formats'] = "9px 10px 11px 12px 13px 14px 15px 16px 17px 18px 20px 22px";
	return $setting;
}
add_filter('tiny_mce_before_init','tinymce_custom_fonts',5);


// TinyMCE Advancedのオリジナルのスタイルメニュー
if( !function_exists( "initialize_tinymce_styles" ) ):
function initialize_tinymce_styles($init_array) {

	$style_formats = array(
		// 小見出し
		array(
			'title' => '見出し',/* マーカーという親メニューを作る */
			'items' => array(/* itemsの中にメニューを入れる */
				array(
					"title" => "h2小見出し",
					"block" => "h2",
					"classes" => "subtitle_small"
				),
				array(
					"title" => "h2中見出し",
					"block" => "h2",
					"classes" => "subtitle_large"
				),
				array(
					"title" => "h3小見出し",
					"block" => "h3",
					"classes" => "subtitle_small"
				),
				array(
					"title" => "シカケ見出し",
					"inline" => "span",
					"classes" => "subtitle_chart"
				),
			),
		),
		array(
			"title" => "ウェイト500",
			"inline" => "span",
			"classes" => "weight_500"
		),
		array(
			"title" => "ウェイト600",
			"inline" => "span",
			"classes" => "weight_600"
		),
		array(
			'title' => 'マーカー',/* マーカーという親メニューを作る */
			'items' => array(/* itemsの中にメニューを入れる */
				array(
					"title" => "黄色",
					"inline" => "span",
					"classes" => "mymarker-y"
				),
				array(
					"title" => "赤色",
					"inline" => "span",
					"classes" => "mymarker-r"
				),
				array(
					"title" => "青色",
					"inline" => "span",
					"classes" => "mymarker-b"
				),
				array(
					"title" => "緑色",
					"inline" => "span",
					"classes" => "mymarker-g"
				),
			),
		),
		array(
			'title' => "ボックス",/* ついでにボックスという親メニューを作ってみる */
			'items' => array(
				array(
					"title" => "グレー",
					"block" => "div",/* ボックスの時はblockと書く */
					"classes" => "rnbox_gray"
				)
			)
		)
	);

	$init_array["style_formats"] = json_encode( $style_formats );

	/* ついでにスタイルの変更がすぐ確認できるようにしておく */
	$init_array["cache_suffix"] = "v=".time();

	return $init_array;
}
endif;
add_filter( "tiny_mce_before_init", "initialize_tinymce_styles" );

?>

<?php
//SmartNewsフィード追加
add_action('init', function (){
	add_feed('smartnews', function () {
		get_template_part('smartnews');
	});
});

//SmartNewsのHTTP header for Content-type
add_filter( 'feed_content_type', function ( $content_type, $type ) {
	if ( 'smartnews' === $type ) {
		return feed_content_type( 'rss2' );
	}
	return $content_type;
}, 10, 2 );
?>
