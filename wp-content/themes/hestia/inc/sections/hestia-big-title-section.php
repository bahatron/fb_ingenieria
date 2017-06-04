<?php
/**
 * Big Title section for the homepage.
 *
 * @package WordPress
 * @subpackage Hestia
 * @since Hestia 1.0
 */

if ( ! function_exists( 'hestia_big_title' ) ) :
	/**
	 * Big title section content.
	 *
	 * @since Hestia 1.0
	 */
	function hestia_big_title() {
	?>
	<html>

	<div class="page-header " style="background-color: #0b465d;">
		<div class="container">
			<div class="col-md-8 col-md-offset-2 text-center" style="padding-top: 30vh; ">
				<div style="background-color:rgb(8, 49, 65); padding-bottom:25px; border-bottom-color: #fb6816; border-bottom-style: solid;">
					<h2 class="main-title"><b>FB</b> Ingeniería y Proyectos</h2>
					<hr style="width:50%; margin-left:25%"> VENEZUELA - PANAMÁ
				</div>
				<?php echo do_shortcode( '[slide-anything id="67"]' )?>
			</div>
		</div>
	</div>
	<script>
		export default {
			data() {
				return {
					items: [{
							src: '/static/doc-images/carousel/squirrel.jpg'
						},
						{
							src: '/static/doc-images/carousel/sky.jpg'
						},
						{
							src: '/static/doc-images/carousel/bird.jpg'
						},
						{
							src: '/static/doc-images/carousel/planet.jpg'
						}
					]
				}
			}
		}
	</script>

	</html>
	<?php
	}
endif;

if ( ! function_exists( 'hestia_slider_compatibility' ) ) :

	/**
	 * Check for previously set slider and make theme compatible.
	 */
	function hestia_slider_compatibility() {
		$hestia_big_title_background  = get_theme_mod( 'hestia_big_title_background' );
		$hestia_big_title_title       = get_theme_mod( 'hestia_big_title_title' );
		$hestia_big_title_text        = get_theme_mod( 'hestia_big_title_text' );
		$hestia_big_title_button_text = get_theme_mod( 'hestia_big_title_button_text' );
		$hestia_big_title_button_link = get_theme_mod( 'hestia_big_title_button_link' );

		$hestia_slider_content = get_theme_mod( 'hestia_slider_content' );

		if ( ! empty( $hestia_big_title_background ) || ! empty( $hestia_big_title_title ) || ! empty( $hestia_big_title_text ) || ! empty( $hestia_big_title_button_text ) || ! empty( $hestia_big_title_button_link ) ) {
			hestia_big_title();
		} else {
			if ( ! empty( $hestia_slider_content ) ) {
				hestia_slider();
			} else {
				hestia_big_title();
			}
		}
	}
endif;

add_action( 'hestia_header', 'hestia_slider_compatibility' );