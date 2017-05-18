<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "wrapper" div and all content after.
 *
 * @package WordPress
 * @subpackage Hestia
 * @since Hestia 1.0
 */

$hestia_general_credits = get_theme_mod( 'hestia_general_credits',
	/* translators: %1$s is Theme Name, %2$s is WordPress */
	sprintf( esc_html__( '%1$s | Powered by %2$s', 'hestia' ),
		/* translators: %s is Theme name */
		sprintf( '<a href="https://themeisle.com/themes/hestia/" target="_blank" rel="nofollow">%s</a>',
			esc_html__( 'Hestia', 'hestia' )
		),
		/* translators: %s is WordPress */
	    sprintf( '<a href="http://wordpress.org/" rel="nofollow">%s</a>',
			esc_html__( 'WordPress', 'hestia' )
		)
	)
); ?>
				<footer class="footer footer-black footer-big">
					<div class="container">
						<div class="content">
							<div class="row">
								<div class="col-md-12" align="center">
									<h2>
										<a href="https://twitter.com/FBIngenieria"><i class="fa fa-twitter"></i></a>
										<a href="https://www.instagram.com/fbingenieriayproyectos/"><i class="fa fa-instagram"></i></a>
									</h2>
								</div>
							</div>
						</div>
						<hr>
						<p>2017 © Copyrights FB Ingeniería</p>
					</div>
				</footer>
		</div>
	</div>
<?php wp_footer(); ?>
</body>
</html>
