<!-- footer-sns -->
<div class="footer-sns">
		<div class="inner">
			<div class="footer-sns-head">この記事をシェアする</div>

			<nav class="footer-sns-buttons">
				<ul>
					<li>
						<a  class="m_twitter" href="https://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" rel="nofollow" target="_blank">
							<img src="<?php echo get_template_directory_uri() ?>/img/icon-twitter.png" alt="">
						</a>
					</li>
					<li>
						<a class="m_facebook" href="https://www.facebook.com/share.php?u=<?php the_permalink(); ?>" rel="nofollow" target="_blank">
							<img src="<?php echo get_template_directory_uri() ?>/img/icon-facebook.png" alt="">
						</a>
					</li>
					<li>
						<a  class="m_line" href="https://social-plugins.line.me/lineit/share?url=<?php the_permalink(); ?>" rel="nofollow" target="_blank">
							<img src="<?php echo get_template_directory_uri() ?>/img/icon-line.png" alt="">
						</a>
					</li>
				</ul>
			</nav>
		</div><!-- /inner -->
	</div><!-- /footer-sns -->
