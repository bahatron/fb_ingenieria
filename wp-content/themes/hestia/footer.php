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
		<footer class="footer footer-black footer-big" >
			<br>
			<div class="container" >
				<div class="content" id="footer">
					<div class="col-md-12 padding-right-left">
					<p style="font-family: Roboto,Helvetica,Arial,sans-serif; font-size: 1.825em">Oficinas</p>
						<hr>
						<table>
							<tr>
								<td style=" width: 600px">
									<p>
										N° 75, Costa Sur,<br> EL Doral
										<br>Ciudad de Panamá
										<br><a target="_blank" href="https://goo.gl/maps/UUhRLZM8Qmt"><i class="fa fa-map-marker"></i>&nbsp<b>Panamá</b></a>
										<br><i class="fa fa-phone"></i>&nbsp +507 8311172
									</p> 
								</td>
								<td style=" width: 600px">
									<p>
										C.C. Manzanares Plaza,<br>
										Piso 1, Oficina 01-04
										<br>Caracas
										<br><a  target="_blank" href="https://goo.gl/maps/EZA7xeWNryH2"><i class="fa fa-map-marker"></i>&nbsp<b>Venezuela</b></a>
										<br><i class="fa fa-phone"></i>&nbsp +58 2129421048
									</p>	
								</td>
							</tr>
						</table>
					</div>

				</div>
				<div class="padding-right-left">
					<h3>
						<a target="_blank" href="https://twitter.com/FBIngenieria"><i class="fa fa-twitter-square"></i></a>
						<a target="_blank" href="https://www.instagram.com/fbingenieriayproyectos/"><i class="fa fa-instagram"></i></a>
						<a target="_blank" href="https://www.linkedin.com/company-beta/5901993/"><i class="fa fa-linkedin-square"></i></a>
						<a data-toggle="modal" data-target="#myModal"><i class="fa fa-envelope-square"></i></a>
					</h3>
					<hr>
					<p>2017 © Copyrights FB Ingeniería</p>
					<a href="#carousel-hestia-generic">Volver a Inicio</a>
						<a href="">
							<img src="11495683679_United-States-Flag.ico" />
						</a>
						<a href="">
							<img src="1495683683_Spain-Flag.ico" />
						</a>
				</div>
			</div>
		</footer>
	</div>
</div>
<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">	
				<button type="button" class="close" data-dismiss="modal">&times;</button>

				<p>Escríbenos a <a>fbingenieriayproyectos@fbingenieria.com</a> !</p>
			</div>
		</div>
	</div>
</div>

</div>

<?php wp_footer(); ?>
</body>
</html>
<script type="text/javascript">
	function mail(){	
		document.getElementById('prueba').innerHTML ='<v-alert info v-bind:value="true">This is a info alert.</v-alert>';
		
	}

</script>
