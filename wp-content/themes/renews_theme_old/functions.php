<?php
	$noImage_thumbnail = get_template_directory_uri().'/images/icon/noimg_thumbnail.png';
	$noImage_mainImg = get_template_directory_uri().'/images/icon/noimg_single.png';
	
	$archivePageNum = 12;
	
/*-------------------------------------------------------------------------------*/

// タイムゾーン9時間ずれ対策
date_default_timezone_set( 'Asia/Tokyo' );

// 自動canonical 吐き出し停止
remove_action('wp_head', 'rel_canonical');

// アイキャッチ有効化
add_theme_support('post-thumbnails');

// pタグ自動挿入無効
if(!is_single()){
	remove_filter('the_content', 'wpautop');
}

// 管理画面の投稿でカテゴリーを選択して保存すると、階層構造が崩れるのを防ぐ
function lig_wp_category_terms_checklist_no_top( $args, $post_id = null ) {
	$args['checked_ontop'] = false;
	return $args;
}
add_action( 'wp_terms_checklist_args', 'lig_wp_category_terms_checklist_no_top' );

// カスタムメニュー有効化
//add_theme_support('menus');

// 管理画面 ビジュアルエディタ領域CSS読み込み
add_editor_style('css/editorStyle.css');


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
	$human_time_diff = human_time_diff( get_comment_time('U'), current_time('timestamp') ) . '前';
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-listCon comment_area level1 flex between">
			<div class="comment-author vcard thumbs_article">
				<?php echo get_avatar( $comment->comment_author_email, 90 ); ?>
			</div>
			<div class="wrap_comment">
				<small class="sst_comment">
					<?php printf(__('%s'), get_comment_author_link()) ?>
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
						<span class="grad-trigger">続きを読む</span>
						<div class="commentText grad-item"><?php echo nl2br($commentText); ?></div>
					</div>
					<?php comment_text(); ?>
				</div>
				<div class="replyBtnWrap">
					<?php
	//いいね
//	if(function_exists('wp_ulike_comments')) wp_ulike('get');
	
	//コメント
//	var_dump(get_current_user_id());
	
//	if():
//	endif
					?>
					
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'reply_text' => '▼リプライを書く','login_text' => '') ) ); ?>
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




/* wp u like */
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



	?>