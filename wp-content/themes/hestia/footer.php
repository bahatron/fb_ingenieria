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
						<h4><b>Oficinas</b></h4>
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
						<a href="mailto:fbingenieriaproyectos@fbingenieria.com" onclick="mail()"><i class="fa fa-envelope-square"></i></a>


					</h3>
					<hr>
					<p>2017 © Copyrights FB Ingeniería</p>
						<a href="">
							<img style="height: 35px;width: 35px; margin:right;" alt="Embedded Image" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAABhklEQVR4Xu2av2oCYRDE5xJBjFqICF5SWFxhrT6HRfIayeP4IiGg7yIiEgIKKlooll/wgvlj2oP5YObKbfZu9rez3+1dAvErEX9+WAATIK6AW0AcAJugW8AtIK6AW+AHgFFgwBDwwkh7dv+8+L8IGIVarYJ2u4nlcovj8ZTfWLVaQZoWH1uttjgcTohKgCy7x2z2iCx7xXz+kQvQ6aRYLJ4Kj3W7b5hO3+MS4FztVquBzWaHUukGzWYD+/0B9fpd4bH1epdTFsIzpwWS5H8LXO6kXL7FYPCAyWSIXu+LhqJjl1xRCSBPgD2A4QExjcFrDxiPh+j3/3pAUbFvD4hJAHsA4xwQ0xiUJ8AeoD4FfA5gEBCTCVI8ICYB5KeAvAfIb4QYm4loVmIhBMpSlCF6vgy93ghZAHkCAK0WuP4uECyAOgHyHmAB1M8BNkF1E5QnwCaoboLyBMh7gAXwGNR+HWatpth5/acouwLs/CaAXQF2fhPArgA7vwlgV4Cd3wSwK8DOL0/AJ+1MFG7sEPpLAAAAAElFTkSuQmCC" />
						</a>
						<a href="">
							<img style="height: 35px;width: 35px;"  alt="Embedded Image" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAEVUlEQVR4Xu2aW0wcVRjHf2dm9sYu7LILtLRJLRKl1iqUFrCUCppUjTXWSxpj+qA2MUaTxkQTEx+M+ibGF180Ppo0mvQB1DapqSa1gaKlpPQiorVeAIXQdukuC7vLzpwZs9A2Gh8XO4t7ztM8zMz5zv/8vsvJdwQlPkSJrx8lgCKgxBVQLlDiAKggqFxAuUCJK6Bc4DoAA8F1TinB0D4/vrj5NwhQAigClAuoGKCCYAkpoLKASoOqDvhnIeT0U1JZQHQsFYE3KsFlFeD6X4tY0v9GgPzCNUhnBY4DwYADNhQjW8srgABpG8znDBYcg5Hpckyp0bgmSUBYBDwmhi6LSojlE0BAMuNncsZHMuUjkp1jKlGGLQRrw/PM+CqIhtOsjphEgpklIopgLI8AeeQNmJgJcuojD/a4l6wmcbwGjuGgpSQ+Q8eozbH5Bcn6WApkcbhE4QLksTdZ9HUREJw85mGkL4SssfB4bBwpyeU0jLjBhpY02x8yEdcWr2nuI1CYANeifM9nBnMZ2LvHwnIEA2d0+s77CMYFYX+ATK3OHRuzdG5aQJMZ8u/nP33iMQst/+BilihMgLztAg4N66RNwSMNkmOvx0iYDrMpi7BZSfTtN/BEguRmf6eitoqm0GscHZ7FduDJ1v+BAPmtHLH2M2PGaBdv0buvhpHGBLrXouFsHZE338EzmkCTGrK9mo5Ve/kx9yLJlE1H5XtLscDFURgBAnJpjbOjjxKf8rI6c5ifDobou7cSqdvcfzxLdXc3Tlyj/LJJtj1GaOg5EtlWnIiXbXf34g/ZK9gFAjDao3Pu4m4qtkap+e0AF74IMNhUgxACayyIqG/m4V2d+GSEwMYo+tHHmYs8wOT3We6s6qXxKQuy7iFQGAEaLKRgePwlxk44tGz9kNNHypm/4iN1xcsnW3aTcSSv+hNUN6xB2Gluq/qYc6eeJtAUZsft7xMI42pNUJgAPvhjUOPk4S6i7ato6/qUL3t8OAkdc87m28lmcpafXbF+vCETc1an/RnJLzN7+PnzJPfs/Jq6++QKJkCH5ARc8HcjYtVskvs4ctCPTOpYgDeToyyhkd0QQjqCsosm255NMnPXB/z6g0mzfJloHSy+7NIojIC80QYMTW0mOR9gx/oBDh3wY8/p2NLEcYKUpb0EymaRjhc5K+h6PsF52sguSLrqhlxd/OIxuKDjsA6TV6N0f/cgpjTY3/YNjE9xZsiHaceYr+1ET/io+rMfbeES9c1pKroqePfETgSCV1q/4tbqaVdTYWECaBCfK+f4RCu2Y9Bae5p1NZeJTxvE5RbGrFtYME3qtThVziDVdVkuJSL0jbcsFn/b1w5RG766goOgS367nNMWRsByWuLSv/4lgGqOquaoao66eDq/+YFAtcZUa0y1xtQdIXVJSt0S+1tz9OYnouKYUd0ULY59cM8KRYB72hfHzIqA4tgH96xQBLinfXHMrAgojn1wz4qSJ+AvGyf0UHpK/Z8AAAAASUVORK5CYII=" />
						</a>
				</div>
			</div>
		</footer>
	</div>
</div>

<?php wp_footer(); ?>
</body>
</html>
<script type="text/javascript">
	function mail(){	
		alert("Escríbenos a fbingenieriayproyectos@fbingenieria.com");
	}

</script>
