<?php
/**
 * Block template for CB Contact.
 *
 * @package cb-turnpower2025
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="contact">
	<div class="container-xl py-5">
		<div class="row g-4">
			<div class="col-lg-6">
				<?= wp_kses_post( get_field( 'contact_intro', 'options' ) ); ?>

				<ul class="fa-ul no-indent">
					<li class="mb-2"><span class="fa-li"><i class="fas fa-map-marker-alt"></i></span> <?= wp_kses_post( get_field( 'contact_address', 'options' ) ); ?></li>
					<li class="mb-2"><span class="fa-li"><i class="far fa-envelope"></i></span> <?= do_shortcode( '[contact_email]' ); ?></li>
					<li class="mb-2"><span class="fa-li"><i class="fas fa-phone-alt"></i></span> <?= do_shortcode( '[contact_phone]' ); ?></li>
				</ul>
			</div>
			<div class="col-lg-6">
				<iframe src="<?= esc_url( get_field( 'map_embed_code', 'options' ) ); ?>" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
			</div>
		</div>
	</div>
</section>