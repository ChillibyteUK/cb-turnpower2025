<?php
/**
 * Block template for CB Accreditations.
 *
 * @package cb-turnpower2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="accreditations py-5">
	<div class="container">
		<h2 class="has-dot mb-4">Accreditations</h2>
		<div class="accreditations__row">
			<?php
			foreach ( get_field( 'accreditations', 'option' ) as $accreditation ) {
				?>
				<div class="accreditations__item">
					<?= wp_get_attachment_image( $accreditation, 'full' ); ?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</section>