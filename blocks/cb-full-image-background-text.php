<?php
/**
 * Block template for CB Full Image Background Text.
 *
 * @package cb-turnpower2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="full-image-background-text">
	<div class="background-image" style="background-image: url('<?= esc_url( wp_get_attachment_image_url( get_field( 'background' ), 'full' ) ); ?>');"></div>
	<div class="overlay"></div>
	<div class="container h-100">
		<div class="row h-100">
			<div class="col-lg-6">
				<h2><?= esc_html( get_field( 'title' ) ); ?></h2>
				<div class="text has-white-color has-text-color has-subtle-font-size fw-500">
					<?= wp_kses_post( get_field( 'content' ) ); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="hero-swoop"></div>
</section>