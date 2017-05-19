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
		<footer class="footer footer-black footer-big" id="footer">
		<br>
			<div class="container">
				<div class="content">
					<div class="col-md-12" align="" style="background:">
						<h3><b>Oficinas</b></h3>
						<hr>
							<table>
								<tr>
									<td style=" width: 600px">
										<p>
											N° 75, Costa Sur,<br> EL Doral
											<br>Ciudad de Panamá
											<br><a href="https://goo.gl/maps/UUhRLZM8Qmt"><i class="fa fa-map-marker"></i>&nbsp<b>Panamá</b></a>
											<br><i class="fa fa-phone"></i>&nbsp +507 8311172
										</p> 
										<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7880.706853012552!2d-79.43015752805319!3d9.031488324076491!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8facaa808ae67af9%3A0x12324cbbd6fbd4b8!2sPlaza+Costa+Sur%2C+Panama+City%2C+Panama!5e0!3m2!1sen!2sve!4v1495218344997" width="600"></iframe>		
									</td>
									<td style=" width: 600px">
										<p>
											C.C. Manzanares Plaza,<br>
											Piso 1, Oficina 01-04
											<br>Caracas
											<br><a href="https://goo.gl/maps/EZA7xeWNryH2"><i class="fa fa-map-marker"></i>&nbsp<b>Venezuela</b></a>
											<br><i class="fa fa-phone"></i>&nbsp +58 2129421048
										</p>
										<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3923.204315708614!2d-66.85643478577688!3d10.484553692519958!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8c2af614c2690efd%3A0x4a82b48117eddf38!2sCentro+Comercial+Manzanares+Plaza!5e0!3m2!1sen!2sve!4v1495218728436" width="600"></iframe>	
									</td>
								</tr>
							</table>
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
