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
						<div class="col-md-12" align="">
						<h3><b>Oficinas</b></h3>
							<div class="col-md-6" align="left">
								<div class="col-md-6" align="left">
									<p>
										N° 75, Costa Sur,<br> EL Doral
										<br>Ciudad de Panamá
										<br><b>Panamá</b>
										<br><i class="fa fa-phone"></i>&nbsp (0507) 8311172
									</p> 									
								</div>
								<div clas="col-md-6" align="left">
									<p>
										C.C. Manzanares Plaza,<br>
										Piso 1, Oficina 01-04
										<br>Caracas
										<br><b>Venezuela</b>
										<br><i class="fa fa-phone"></i>&nbsp (0058) 2129421048
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div>
					<h2>
						<a href="https://twitter.com/FBIngenieria"><i class="fa fa-twitter"></i></a>
						<a href="https://www.instagram.com/fbingenieriayproyectos/"><i class="fa fa-instagram"></i></a>

					</h2>
					<p>
						<br><i class="fa fa-envelope"></i>&nbsp fbingenieriaproyectos@fbingenieria.com
					</p>
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
