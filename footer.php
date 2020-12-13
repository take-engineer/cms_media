	<!-- footer-menu -->
	<div id="footer-menu">
		<div class="inner">
			<div class="footer-logo"><a href="/">メディアサイト</a></div><!-- /footer-logo -->

			<nav class="footer-nav">
				<?php
				wp_nav_menu(
					array(
						'depth' => 1,
						'theme_location' => 'footer',	//フッターメニューをここに表示すると指定
						'container' => 'footer-list',
					)
				);
				?>
			</nav>

		</div><!-- /inner -->
	</div><!-- /footer-menu -->

	<!-- footer -->
	<footer id="footer">
		<div class="inner">
			<div class="copy">&copy; メディアサイト</div><!-- /copy -->

		</div><!-- /inner -->
	</footer><!-- /footer -->

	<!-- シングルページの時だけSNSシェアリンクを表示させる -->
	<?php if(is_single()) : ?>
	<?php get_template_part('template-parts/footer-sns') ?>
	<?php endif; ?>

	<div class="floating">
		<a href="#"><i class="fas fa-chevron-up"></i></a>
	</div>

	<?php wp_footer(); ?>
	</body>

	</html>
