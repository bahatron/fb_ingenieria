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

$hestia_general_credits = get_theme_mod('hestia_general_credits',
    /* translators: %1$s is Theme Name, %2$s is WordPress */
    sprintf(esc_html__('%1$s | Powered by %2$s', 'hestia'),
        /* translators: %s is Theme name */
        sprintf('<a href="https://themeisle.com/themes/hestia/" target="_blank" rel="nofollow">%s</a>',
            esc_html__('Hestia', 'hestia')
            ),
        /* translators: %s is WordPress */
        sprintf('<a href="http://wordpress.org/" rel="nofollow">%s</a>',
            esc_html__('WordPress', 'hestia')
            )
        )
        ); ?>
	<?php
        global $FBIngenieria;
    ?>
		<footer id="fbi_footer" class="footer footer-big" data-app>
			<div class="row" style="width: 100%;">
				<div class="col-md-12">
					<div style="height: 100px"></div>
					<div class="office-section" align="left">
						<p class="p-office-section">Oficinas</p>
						<hr class="hr-color">
						<table>
							<tr>
								<td style=" width: auto;">
									<p>
										Corregimiento Juan Díaz,<br> N° 75, Costa Sur,<br> El Doral
										<br>Ciudad de Panamá
										<br><a target="_blank" href="https://goo.gl/maps/UUhRLZM8Qmt"><i class="fa fa-map-marker"></i>&nbsp<b>Panamá</b></a>
										<br><i class="fa fa-phone"></i>&nbsp +507 8311172
									</p>
								</td>
								<td style=" width: auto;">
									<p>
										Av. Principal de Manzanares,<br> C.C. Manzanares Plaza,<br> Piso 1, Oficina 01-04
										<br>Caracas
										<br><a target="_blank" href="https://goo.gl/maps/EZA7xeWNryH2"><i class="fa fa-map-marker"></i>&nbsp<b>Venezuela</b></a>
										<br><i class="fa fa-phone"></i>&nbsp +58 2129421048
									</p>
								</td>
							</tr>
						</table>
						<div align="left" style="margin-top: -30px;">
							<h4>
								<a target="_blank" class="footer-a" href="https://www.instagram.com/fbingenieriayproyectos/"><i class="fa fa-instagram"></i></a>
								<a target="_blank" class="footer-a" href="https://www.linkedin.com/company-beta/5901993/"><i class="fa fa-linkedin-square"></i></a>
								<a @click="showDialog($event)"><i class="fa fa-envelope-square"></i></a>
								<v-dialog v-model="dialogOpen">
									<v-card style="width:auto;padding:12px;">
										<v-card-row>
											Escríbenos a fbingenieriayproyectos@fbingenieriayproyectos.com
										</v-card-row>
										
									</v-card>

								</v-dialog>
							</h4>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div style="height: 100px"></div>
				</div>
				<div class="col-md-12 cp-footer" align="center">
					<p>2017 © Copyrights FB Ingeniería</p>
					<nav class="navbar navbar-transparent footer-nav">
						<a title="Inicio" href="#fbi_big_title"><?php echo $FBIngenieria->translate('back-to-top', $lang) ?></a>
					</nav>
					<form action="" method="GET" id="changeLanguageForm">
						<img style="max-height: 30px; cursor: pointer;" src="<?php echo FBINGENIERIA_URL.'/src/assets/img/1495683664_United-States-Flag.png' ?>"
						    onclick="changeLanguage('en')">
						<img style="max-height: 30px; cursor: pointer;" src="<?php echo FBINGENIERIA_URL.'/src/assets/img/1495683661_Spain-Flag.png' ?>"
						    onclick="changeLanguage('es')">
						<input type="hidden" name="lang" value="" style="display: none;">
					</form>
				</div>
			</div>

		</footer>
		<?php wp_footer(); ?>
		</body>

		</html>
		<script type="text/javascript">
			function mail() {
				document.getElementById('prueba').innerHTML = '<v-alert info v-bind:value="true">This is a info alert.</v-alert>';
			}

			function changeLanguage(lang) {
				var form = document.getElementById('changeLanguageForm');
				form.elements.lang.value = lang;
				form.submit();
			}
			new Vue({
				el: '#fbi_footer',
				data: {
					dialogOpen: false
				},
				methods: {
					showDialog(event) {
						event.stopPropagation();
						this.dialogOpen = !this.dialogOpen
					}
				}
			})
		</script>