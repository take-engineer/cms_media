<?php get_header(); ?>

	<!-- content -->
	<div id="content">
		<div class="inner">

			<!-- primary -->
			<main id="primary">
				<?php if (function_exists('bcn_display')) : ?>
				<!-- breadcrumb -->
				<div class="breadcrumb">
					<?php bcn_display(); ?>
                </div><!-- /breadcrumb -->
            <?php endif; ?>

            <?php if (have_posts()): while (have_posts()): the_post(); ?>
							<!-- entry -->
							<article <?php post_class(array('entry')); ?>>

								<!-- entry-header -->
								<div class="entry-header">

									<!-- カテゴリー1つ目の名前を表示 -->
									<div class="entry-label"><?php my_the_post_category( true ); ?></div>
									<h1 class="entry-title"><?php the_title(); ?></h1><!-- /entry-title -->

									<!-- entry-meta -->
									<div class="entry-meta">
										<time class="entry-published" datetime="<?php the_time('c'); ?>">公開日 <?php the_time('Y/n/j'); ?></time>
										<?php if( get_the_modified_time('Y-m-d') !== get_the_time('Y-m-d')) : ?>
											<time class="entry-updated" datetime="<?php the_modified_time('c'); ?>">最終更新日 <?php the_modified_time('Y/n/j'); ?></time>
										<?php endif; ?>
									</div><!-- /entry-meta -->

									<!-- entry-img -->
									<div class="entry-img">
										<?php	if (has_post_thumbnail()){
											the_post_thumbnail('large');
										} else {
											echo '<img src="'.esc_url(get_template_directory_uri()).'/img/noimg.png" alt="">';
										}	?>
									</div><!-- /entry-img -->
								</div><!-- /entry-header -->

								<!-- entry-body -->
								<div class="entry-body">
									<?php
									//  本文の表示
									the_content(); ?>
									<br>
									<?php /*
											echo do_shortcode('[btn link="https://localhost/wordpress/sample-page/"]お問い合わせはこちら[/btn]');
									*/ ?>
									<?php	//  改ページを有効にするための記述
									wp_link_pages(
										array(
											'before' => '<nav class="entry-links">',
											'after' => '</nav>',
											'link_before' => '',
											'link_after' => '',
											'next_or_number' => 'number',
											'separator' => '',
										)
									); ?>
						</div><!-- /entry-body -->

						<!-- entry-tag-items -->
						<div class="entry-tag-items">
							<div class="entry-tag-head">タグ</div><!-- /entry-tag-head -->
							<?php my_get_post_tags(); ?>
						</div><!-- /entry-tag-items -->

						<?php get_template_part('template-parts/entry-related'); ?>

					</article> <!-- /entry -->

            <?php endwhile; endif; ?>

			</main><!-- /primary -->

			<?php get_sidebar(); ?>


		</div><!-- /inner -->
	</div><!-- /content -->

<?php get_footer(); ?>
