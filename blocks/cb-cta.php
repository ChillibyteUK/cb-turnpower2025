<?php
/**
 * Block template for CB CTA.
 *
 * @package cb-turnpower2025
 */

defined( 'ABSPATH' ) || exit;

$class_name = 'cta-block';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}

if ( ! empty( $block['backgroundColor'] ) ) {
	$class_name .= ' has-' . $block['backgroundColor'] . '-background-color has-background py-5';
}

if ( ! empty( $block['textColor'] ) ) {
	$class_name .= ' has-' . $block['textColor'] . '-color has-text-color';
} else {
	$class_name .= ' has-white-color has-text-color';
}
?>
<section class="<?= esc_attr( $class_name ); ?>">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-9 text-center">
				<?php
				if ( get_field( 'title' ) ) {
					?>
				<h2 class="mb-4"><?= esc_html( get_field( 'title' ) ); ?></h2>
					<?php
				}
				if ( get_field( 'content' ) ) {
					?>
				<div class="mb-4 fs-500"><?= wp_kses_post( get_field( 'content' ) ); ?></div>
					<?php
				}
				if ( get_field( 'show_phone' ) || get_field( 'show_contact' ) ) {
					echo '<div class="d-flex flex-column flex-md-row justify-content-center gap-3 mb-4">';
					if ( get_field( 'show_phone' ) ) {
						echo do_shortcode( '[contact_phone class="btn btn--primary" icon="true"]' );
					}
					if ( get_field( 'show_contact' ) ) {
						?>
					<a href="/contact-us/" class="btn btn--primary"><i class="fas fa-paper-plane"></i> Contact Us</a>
						<?php
					}
					echo '</div>';
				}
				?>
			</div>
		</div>	
	</div>
</section>