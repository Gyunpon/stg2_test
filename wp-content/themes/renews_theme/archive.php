<?php get_header(); ?>
<?php
$post_type = get_query_var('post_type');
?>
<div class="archive underContents <?php echo $post_type.'_archive'; ?>">
	<div class="inner">
		<?php
		global $archivePageNum;
		$pageItemNum = $archivePageNum;

		$paged = get_query_var('paged');
		query_posts($query_string . '&posts_per_page='.$pageItemNum.'&paged=' . $paged);

		$archivePageName = '';
		if(is_tag()){
			$archivePageName = single_tag_title( '', false );
		}elseif(is_category()){
			$archivePageName = single_cat_title( '', false );
		}elseif(is_tax()){
			$archivePageName = single_term_title( '', false );
		}else{
			$archivePageName = post_type_archive_title( '', false );
		}
		
		if(empty($archivePageName)){ $archivePageName = '投稿'; }
		
		?>
		<?php if(have_posts()): ?>
		<div class="archiveTitleArea">
			<h2><?php echo $archivePageName; ?>に関する記事一覧 <span class="archiveCountNum">（<?php page_post_count_text(); ?>）</span></h2>
		</div><!--archiveTitleArea-->
		
		<div class="archiveList">
			<ul class="clearfix">
				<?php while (have_posts()): the_post(); ?>
				<?php
				$postId = $post->ID;
				
				// image
				$thumbnailId = get_post_thumbnail_id();
				$imageUrl = '';
				if($thumbnailId){
					$thumbnailInfo = wp_get_attachment_image_src( $thumbnailId , 'square-thumbnails' );
					$imageUrl = $thumbnailInfo[0];
				}else{
					global $noImage_thumbnail;
					$imageUrl = $noImage_thumbnail;
				}
				
				// 日付
				$date = get_the_time('Y.m.d');
				
				// カテゴリー
				$postTax = get_object_taxonomies($post);
				?>
				<li>
					<a href="<?php the_permalink(); ?>">
						<div class="archiveBox">
							<div class="photo"><img src="<?php echo $imageUrl; ?>" alt="<?php the_title(); ?>" /></div>
							<div class="detail">
								<div class="articleInfo">
									<div class="date">
										<p><?php echo $date; ?></p>
									</div><!-- date -->
									
									<?php if(!empty($postTax)): ?>
									<div class="category">
										<div class="categoryList">
											<?php foreach($postTax as $taxName): ?>
											<?php
											$postTerms = get_the_terms($postId, $taxName);
											if(!empty($postTerms)):
											?>
											<ul>
												<?php foreach($postTerms as $t): ?>
												<li><span class="catIcon"><?php echo $t->name; ?></span></li>
												<?php endforeach; ?>
											</ul>
											<?php endif; ?>
											<?php endforeach; ?>
										</div><!-- categoryList -->
									</div>
									<?php endif; ?>
								</div><!-- articleInfo -->
								<h4 class="title"><?php the_title(); ?></h4>
							</div>
						</div>
					</a>
				</li>
				<?php endwhile;?>
			</ul>
			
			
			<?php
				$max_page = $wp_query->max_num_pages;
				if($max_page != 1):
			?>
			<div class="pagerArea">
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
					'mid_size' => 2,
					'current' => ($paged ? $paged : 1),
				));
				?>
			</div><!--pagerArea-->
			<?php endif; ?>
		</div><!--archiveList-->
		
		
		<?php else: /* else have_posts */ ?>
		<div id="notFound" class="articleNotFound">
			<h1>お探しの<?php echo $archivePageName; ?>に関する記事は見つかりませんでした。</h1>
			<p>
				申し訳ございません。<br />
				<?php echo $archivePageName; ?>に関する記事は見つかりませんでした。
			</p>
		</div><!--notfound-->
		<?php endif;/* end have_posts */ ?>
	</div>
</div><!--archive-->
<?php get_footer(); ?>