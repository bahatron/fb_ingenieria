<?php
/**
 * The default template for displaying content
 *
 * Used for pages.
 *
 * @package WordPress
 * @subpackage Hestia
 * @since Hestia 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" class="section section-text">
		<div class="row">
			<?php the_content(); ?>
		</div>
	</article>