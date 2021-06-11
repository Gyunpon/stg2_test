<?php get_header(); ?>

<section class="sec sec_error">
	<div class="inner_base ">

		<div class="mv_error">
			<span class="error_text">404</span>

			<h1 class="text_middle color_blue">
				ページが見つかりません
			</h1>

			<a href="<?php echo home_url(); ?>/" class="btn_base color_blue reverse">
				<span class="text_btn">
					ホームページに戻ります
				</span>
			</a>
		</div>

	</div>
</section>


<section id="article" class="sec sec_article error">
	<div class="inner_base">
		<div class="sec_title">
      <h1 class="main_title">Reccomend
        <span class="main_title_jp">おすすめの記事</span>
      </h1>
		</div>


		<div class="content_article">
			<div class="wrap_article_middle grid articleListStyle">

				<?php // while($wp_query->have_posts()): $wp_query->the_post(); //?>

        <?php
        $posts = get_field('new_articles', 'option');
        ?>


        <?php if( $posts ): ?>

        <?php foreach( $posts as $val ):

        // アイキャッチ
        $thumbnail_id = get_post_thumbnail_id($val);
        $imageUrl = '';
        if($thumbnail_id){
          $image = wp_get_attachment_image_src($thumbnail_id,'full');
          $imageUrl = $image[0];
        }else{
          $imageUrl = get_template_directory_uri().'/images/icon/noimg.jpg';
        }

        //コメント
        $comments = wp_count_comments( $val );

        // タイトル
        $title_base = get_the_title( $val );
        $title = mb_strimwidth($title_base, 0, 76, "...", "UTF-8");
        $series_terms = get_the_terms($val, 'series');
        ?>


          <div class="article_middle">
            <div class="wrap_img">
              <div class="article_middle_img imgLiquidFill">
                <a href="<?php the_permalink($val); ?>">
                  <img src="<?php echo $imageUrl; ?>" alt="<?php echo $title; ?> サムネイル" />
                </a>
              </div>
              <!-- アイコン移動 -->
              <?php
              //現在のユーザー
              $user = wp_get_current_user();
              $uid = $user->ID;
              ?>
              <div class="wrap_social color_black flex">
                <div class="socialbox likebox"><?php if(function_exists('wp_ulike_comments')) echo wp_ulike( 'put', array("id" => $val) ); ?></div>
              </div>
              <!-- // アイコン移動 ここまで // -->
            </div>

            <div class="textbox middle left_bottom small_compo">
              <?php if(!empty($title)): ?>
              <?php foreach($title as $ct):
              $series_link = get_category_link($ct->term_id);
              ?>
              <a href="<?php echo $series_link; ?>" class="search_series_name_link">
                <span class="series_name">
                  <?php echo $ct->name; ?>
                </span>
              </a>
              <?php endforeach; ?>
              <?php endif; ?>

              <a href="<?php the_permalink($val); ?>">
                <h2 class="title_middle lineClamp_2">
                  <?php echo $title; ?>
                </h2>
              </a>


              <?php
              //著者情報
              $rows = get_field('author_select' ,$val); // すべてのrow（内容・行）をいったん取得する
              $first_row = $rows[0]; // 1行目だけを$first_rowに格納しますよ～
              $first_row_item = $first_row['author']; // get the sub field value
              if(!($first_row_item)){
                $user_name = get_the_author_meta( 'display_name', $val->post_author );
                $renews_id = get_the_author_meta( 'user_login', $val->post_author );
                $user_avatar = get_avatar( get_the_author_meta( 'ID' ), 64 );
              }else{
                $user_name = $first_row_item['display_name'];
                $renews_id = $first_row_item['user_nicename'];
                $user_avatar = $first_row_item['user_avatar'];
              }
              ?>

              <div class="card-bottom">
                <a href="<?php echo home_url(); ?>/user/<?php echo $renews_id; ?>/">
                  <div class="wrap_avatar flex">
                    <div class="textbox_avatar">
                      <?php echo $user_avatar; ?>
                    </div>
                    <p class="title_avatar eng">
                      <span class="black"><?php echo $user_name; ?></span>
                      <span>@<?php echo $renews_id; ?></span>
                    </p>
                  </div>
                </a>
              </div>

            </div>
          </div>

        <?php // endwhile; //?>
        <?php endforeach;
        wp_reset_postdata();
        ?>
        <?php endif; ?>



			</div><!-- /.wrap_article_middle -->
		</div><!-- /.content_article -->


	</div>


	<?php
	$max_page = $wp_query->max_num_pages;
	if($max_page != 1):
	?>

	<div class="pagerArea inner_base">
		<?php global $wp_rewrite;
		$paginate_base = get_pagenum_link(1);
		if (strpos($paginate_base, '?') || ! $wp_rewrite->using_permalinks()) {
			$paginate_format = '';
			$paginate_base = add_query_arg('paged', '%#%');
		} else {
			$paginate_format = (substr($paginate_base, -1 ,1) == '/' ? '' : '/') . user_trailingslashit('page/%#%/', 'paged');
			$paginate_base .= '%_%';
		}
		echo paginate_links( array(
			'base' => $paginate_base,
			'format' => $paginate_format,
			'total' => $wp_query->max_num_pages,
			'end_size' => 1,
			'mid_size' => 1,
			'current' => ($paged ? $paged : 1),
		));
		?>
	</div>

	<?php endif; ?>

</section>


<?php get_footer(); ?>
