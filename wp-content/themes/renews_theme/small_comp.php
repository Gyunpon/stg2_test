

<!-- 共通の小コンポ-->

              <!-- search.php の記述 ここから -->

              <?php $postId = $post->ID;
              // アイキャッチ
              $thumbnail_id = get_post_thumbnail_id();
              $imageUrl = '';
              if ($thumbnail_id) {
                $image = wp_get_attachment_image_src($thumbnail_id, 'large');
                $imageUrl = $image[0];
              } else {
                $imageUrl = get_template_directory_uri() . '/images/icon/noimg.jpg';
              }

              //コメント
              $comments = wp_count_comments($post->ID);

              // タイトル
              $title = mb_strimwidth($post->post_title, 0, 76, "...", "UTF-8");
              $series_terms = get_the_terms($post->ID, 'series');
              ?>
              <div class="article_middle">
                <div class="wrap_img">
                  <div class="article_middle_img imgLiquidFill">
                    <a href="<?php the_permalink(); ?>">
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
                    <div class="socialbox likebox"><?php if(function_exists('wp_ulike_comments')) echo wp_ulike( 'put', array("id" => $postId) ); ?></div>
                  </div>
                  <!-- アイコン移動 ここまで -->
                </div>

                <div class="textbox middle left_bottom small_compo">
                  <?php if(!empty($series_terms)): ?>
                  <?php foreach($series_terms as $ct):
                  $series_link = get_category_link($ct->term_id);
                  ?>
                  <a href="<?php echo $series_link; ?>" class="search_series_name_link">
                    <span class="series_name">
                      <?php echo $ct->name; ?>
                    </span>
                  </a>
                  <?php endforeach; ?>
                  <?php endif; ?>

                  <a href="<?php the_permalink(); ?>">
                    <h2 class="title_middle lineClamp_2">
                      <?php echo $title; ?>
                    </h2>
                  </a>


                  <!--
                  <div class="top_tags">
                    <?php if(!empty($series_terms)): ?>
                    <?php
                    /*
                    $postId = $val;
                    $taxonomy = 'agenda';
                    $primaryTerm = get_post_meta( $postId, '_yoast_wpseo_primary_'.$taxonomy, true );

                    if($primaryTerm){
                      // Yoast SEO カテゴリー「メインにする」設定をされている場合

                      $terms = get_term($primaryTerm, $taxonomy);
                      if(!empty($terms)){
                        $primary_termName = $terms->name;
                        $primary_termSlug = $terms->slug;
                        $primary_termLink = get_category_link($terms->term_id);
                      }
                    }else{
                      // Yoast SEO カテゴリー「メインにする」設定をされていない場合
                      // 選択タームの一番上を表示

                      $terms = get_the_terms($postId, array($taxonomy));
                      if(!empty($terms)){
                        $primary_termName = $terms[0]->name;
                        $primary_termSlug = $terms[0]->slug;
                        $primary_termLink = get_category_link($terms[0]->term_id);
                      }
                    }
                    */
                    ?>

                    <a href="<?php echo $primary_termLink; ?>" class="tag_agenda border_agenda primary_tag"><?php echo $primary_termName; ?></a>
                    <?php foreach($series_terms as $t_a)://agenda
                    /*
                    $tag_a_id = $t_a->term_id;
                    $tag_link = get_category_link($t_a->term_id);
                    $tag_name = $t_a->name;
                    */
                    ?>
                    <?php if($primaryTerm != $tag_a_id): ?>
                    <a href="<?php echo $tag_link; ?>" class="tag_agenda border_agenda"><?php echo $tag_name; ?></a>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    <?php endif; ?>

                  </div>
                -->


                  <div class="card-bottom">
                    <?php
                    //著者情報
                    $rows = get_field('author_select' ); // すべてのrow（内容・行）をいったん取得する
                    $first_row = $rows[0]; // 1行目だけを$first_rowに格納しますよ～
                    $first_row_item = $first_row['author']; // get the sub field value
                    if(!($first_row_item)){
                      $user_name = get_the_author_meta( 'display_name', $post->post_author );
                      $renews_id = get_the_author_meta( 'user_login', $post->post_author );
                      $user_avatar = get_avatar( get_the_author_meta( 'ID' ), 64 );
                    }else{
                      $user_name = $first_row_item['display_name'];
                      $renews_id = $first_row_item['user_nicename'];
                      $user_avatar = $first_row_item['user_avatar'];
                    }
                    ?>
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

            <!-- search.php の記述 ここまで -->

<!-- 共通の小コンポ ここまで-->
