<?php
/**
 * Block template for CB Cards.
 *
 * @package cb-turnpower2025
 */

defined( 'ABSPATH' ) || exit;

if ( have_rows( 'cards' ) ) {
	?>
<div class="container my-4">
    <div class="row g-4">
	<?php
	while ( have_rows( 'cards' ) ) {
		the_row();
		$card_title = trim( (string) get_sub_field( 'card_title' ) );
		$card_text  = trim( (string) get_sub_field( 'card_text' ) );
		$card_icon  = get_sub_field( 'card_icon' );

		$bg_choice = get_sub_field( 'card_background' );
		switch ( $bg_choice ) {
			case 'light-blue':
				$bg_class = 'has-blue-400-background-color has-background has-white-color';
				break;
			case 'black':
				$bg_class = 'has-black-background-color has-background has-white-color';
				break;
			case 'red':
				$bg_class = 'has-red-background-color has-background has-white-color';
				break;
			case 'purple':
				$bg_class = 'has-purple-background-color has-background has-white-color';
				break;
			case 'green':
				$bg_class = 'has-green-background-color has-background has-white-color';
				break;
			case 'burgundy':
				$bg_class = 'has-burgundy-background-color has-background has-white-color';
				break;
			case 'blue':
			default:
				$bg_class = 'has-blue-900-background-color has-background has-white-color';
				break;
		}
		?>
        <div class="col-12 col-md-6">
        	<div class="card card-client shadow-sm h-100">
        		<div class="card-card__header <?= esc_attr( $bg_class ); ?>">
              		<div class="mb-0 p-4 fs-500 fw-bold "><?= esc_html( $card_title ); ?><i class="float-end fa <?= esc_html( $card_icon ); ?>" aria-hidden="true"></i></div>
				</div>
				<?php
				if ( $card_text ) {
					?>
				<div class="card-body">
					<p class="m-0"><?= wp_kses_post( $card_text ); ?></p>
				</div>
					<?php
				}
				?>
          	</div>
        </div>
      	<?php
	}
	?>
    </div>
</div>
	<?php
} else {
	echo '<div class="alert alert-info my-3">No cards added yet.</div>';
}
