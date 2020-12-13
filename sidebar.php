<!-- secondary -->
<aside id="secondary">

	<!-- widget -->
	<div class="widget widget_text widget_custom_html">
		<?php dynamic_sidebar('sidebar');	//プロフィールのみ?>
	</div><!-- /widget -->

	<!-- widget -->
	<div class="widget widget_search">
		<div class="widget-title">検索</div>
		<!-- search-form -->
		<form method="get" class="search-form" action="<?php echo home_url('/'); ?>">
			<input type="search" class="search-field" value="" placeholder="キーワード" name="s" id="s">
			<button type="submit" class="search-submit"><i class="fas fa-search"></i></button>
		</form><!-- /search-form -->
	</div><!-- /widget -->
	<!-- <?php get_search_form(); ?> でもデフォルトの検索フォームを表示できる -->



	<!-- widget popular-->
	<div class="widget widget_popular">
		<div class="widget-title">人気記事</div>

		<div class="wpost-items m_ranking">
			<!-- 直近7日間で閲覧数トップ5記事をサムネイル付き表示 -->
			<?php //echo do_shortcode('[wpp range="last7days" thumbnail_width=120 thumbnail_height=70 limit=3 stats_views=1 order_by="views"]');?>

			<!-- 歴代アクセス数トップ5記事を表示する場合 -->
			<?php
        // get_post_viewsで適宜アクセス数を確認
        // $counter = get_post_views();
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 5,
                'meta_key' => 'view_counter',
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
            );
            $popular_posts = get_posts($args);
            foreach ($popular_posts as $post): setup_postdata($post);
        ?>

			<!-- wpost-item -->
			<a class="wpost-item" href="<?php the_permalink(); ?>">
				<div class="wpost-item-img">
					<?php
                if (has_post_thumbnail()) {
                    // アイキャッチ画像が設定されてれば中サイズで表示
                    the_post_thumbnail('medium');
                } else {
                    // なければnoimage画像をデフォルトで表示
                    echo '<img src="' . esc_url(get_template_directory_uri()) . '/img/noimg.png" alt="">';
                }
            ?>
				</div>
				<div class="wpost-item-body">
					<div class="wpost-item-title"><?php the_title(); ?></div>
				</div><!-- /wpost-item-body -->
			</a><!-- /wpost-item -->

			<?php
        endforeach; wp_reset_postdata();
        ?>

		</div><!-- /wpost-items -->
	</div><!-- /widget popular -->




	<!-- widget -->
	<div class="widget widget_recent">
		<div class="widget-title">新着記事</div>

		<div class="wpost-items">
			<!-- サムネイル付きの新着記事を５件表示できる -->
			<?php //echo do_shortcode('[rpwe limit="5" thumb="true"]');?>


			<!-- 新着記事5記事を表示する -->
			<?php
        // get_post_viewsで適宜アクセス数を確認
        // $counter = get_post_views();
            $args = array(
                // 'post_type' => 'post',   //省いても挙動は同じ
                'posts_per_page' => 5,
                // 'orderby' => 'date',     //省いても挙動は同じ
                // 'order' => 'DESC',       //省いても挙動は同じ
            );
            $popular_posts = get_posts($args);
            foreach ($popular_posts as $post): setup_postdata($post);
        ?>

			<!-- wpost-item -->
			<a class="wpost-item" href="<?php the_permalink(); ?>">
				<div class="wpost-item-img">
					<?php
                if (has_post_thumbnail()) {
                    // アイキャッチ画像が設定されてれば中サイズで表示
                    the_post_thumbnail('medium');
                } else {
                    // なければnoimage画像をデフォルトで表示
                    echo '<img src="' . esc_url(get_template_directory_uri()) . '/img/noimg.png" alt="">';
                }
            ?>
				</div>
				<div class="wpost-item-body">
					<div class="wpost-item-title"><?php the_title(); ?></div>
				</div><!-- /wpost-item-body -->
			</a><!-- /wpost-item -->

			<?php
        endforeach; wp_reset_postdata();
        ?>


		</div><!-- /wpost-items -->
	</div><!-- /widget -->


	<!-- widget_tag -->
	<div class="widget widget_archive">
		<div class="widget-title">タグ</div>
		<ul>
			<?php
        $tags = get_tags();
        if ($tags) {
            foreach ($tags as $tag) {
                echo '<li><a href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a></li>';
            }
        }
        ?>
		</ul>
	</div><!-- /widget -->

	<!-- widget_archive -->
	<div class="widget widget_archive">
		<div class="widget-title">月別</div>
		<ul>
			<?php wp_get_archives(); ?>
		</ul>
	</div><!-- /widget -->

</aside><!-- secondary -->
