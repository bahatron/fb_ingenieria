<?php
/**
 * The template for displaying all single posts and attachments.
 *
 * @package WordPress
 * @subpackage Hestia
 * @since Hestia 1.0
 */

    get_header();
    global $FBIngenieria;
    $headerImages = $FBIngenieria->getHeaderImagesUrl();
?>
	<div class="page-header" style="background-color: #0b465d;" id="fbi_big_title">
		<div style="position: relative; height: 100vh;">
			<?php
        if (!empty($headerImages)) {
            ?>
			<v-carousel>
			<?php
        foreach ($headerImages as $img) {
            ?>
						<v-carousel-item src="<?php echo $img ?>"></v-carousel-item>
						<?php 
        } ?>
				</v-carousel>
				<?php 
        } ?>
				<div class="main-header-title">
					<h2 class="main-title"><b>FB</b> Ingeniería y Proyectos</h2>
					<hr style="width:50%; margin-left:25%">
					<p style="font-size:1em;">VENEZUELA - PANAMÁ</p>
				</div>
		</div>
	</div>
	<?php 
    fbi_landing_page_handler();
  ?>
	<script>
		new Vue({
			el: '#fbi_big_title'
		})
	</script>
	<?php get_footer(); ?>