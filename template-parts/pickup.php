<div id="pickup">
	<div class="inner">

		<div class="pickup-items">
			<?php
				$pickup_ids = array( 24, 15, 21 );    //ピックアップする記事の投稿idを指定する
				foreach( $pickup_ids as $id ): ?>

					<a href="<?php echo esc_url( get_permalink( $id )); ?>" class="pickup-item">
						<div class="pickup-item-img">
							<?php	if( has_post_thumbnail($id)){
								echo get_the_post_thumbnail( $id, 'large');
							} else {
								echo '<img src="'.esc_url( get_template_directory_uri())/'/img/noimg.png" alt="">';
							}	?>
							<div class="pickup-item-tag"><?php my_the_post_category( false, $id ); ?></div><!-- /pickup-item-tag -->
						</div>
						<div class="pickup-item-body">
							<h2 class="pickup-item-title"><?php echo esc_html( get_the_title( $id )); ?></h2><!-- /pickup-item-title -->
						</div>
					</a>
				<?php endforeach; ?>
		</div>

	</div>
</div>
