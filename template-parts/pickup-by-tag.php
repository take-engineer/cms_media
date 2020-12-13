<div id="pickup">
	<div class="inner">

		<div class="pickup-items">

			<?php
			$pickup_posts = get_posts( array(
				'post_type' => 'post', // 投稿タイプ
				'posts_per_page' => '3', // 3件を取得
				'tag' => 'pickup',  //pickupというタグが付いたものを
				'orderby' => 'DESC', // 新しい順に
			));
			?>

			<?php foreach( $pickup_posts as $post ): setup_postdata( $post ) ;?>
				<a class="pickup-item" href="<?php echo esc_url( get_permalink() ); ?>">
				<div class="pickup-item-img">
					<?php	if (has_post_thumbnail() ) {
						// アイキャッチ画像が設定されてればミディアムサイズで表示
						the_post_thumbnail('large');
					} else {
						// なければnoimage画像をデフォルトで表示
						echo '<img src="' . esc_url(get_template_directory_uri()) . '/img/noimg.png" alt="">';
					}	?>
					<div class="pickup-item-tag"><?php my_the_post_category( false ); ?></div>
				</div>
				<div class="pickup-item-body">
						<h2 class="pickup-item-title"><?php the_title(); ?></h2>
				</div>
				</a>

			<?php endforeach; wp_reset_postdata(); ?>
		</div>
	</div>
</div>
