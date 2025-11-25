<?php
/**
 * Block template for CB FAQs.
 *
 * @package cb-turnpower2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="faq pb-5">
	<div class="container">
		<?php
		if ( get_field( 'title' ) ) {
			?>
		<h3><?= esc_html( get_field( 'title' ) ); ?></h3>
			<?php
		}

		$accordion = random_str( 5 );

		echo '<div class="faq__inner">';
		echo '<div id="accordion' . esc_attr( $accordion ) . '" class="accordion">';

		$counter   = 0;
		$show      = '';
		$collapsed = 'collapsed';

		$expanded = 'false';
		$collapse = '';
		$button   = 'collapsed';

		while ( have_rows( 'faq_items' ) ) {
			the_row();

			$question_raw = get_sub_field( 'question' );
			$answer_raw   = get_sub_field( 'answer' );
			cb_collect_faq( $question_raw, $answer_raw );

			$ac = $accordion . '_' . $counter;
			?>
				<div class="accordion-item">
					<div class="accordion-header">
						<button class="accordion-button fs-500 <?= esc_attr( $button ); ?>"
							type="button" data-bs-toggle="collapse"
							data-bs-target="#c<?= esc_attr( $ac ); ?>"
							aria-expanded="<?= esc_attr( $expanded ); ?>"
							aria-controls="c<?= esc_attr( $ac ); ?>">
							<?= wp_kses_post( $question_raw ); ?>
						</button>
					</div>
					<div id="c<?= esc_attr( $ac ); ?>"
						class="collapse <?= esc_attr( $show ); ?>"
						data-bs-parent="#accordion<?= esc_attr( $accordion ); ?>">
						<div class="accordion-body">
							<?= wp_kses_post( $answer_raw ); ?>
						</div>
					</div>
				</div>
			<?php
			++$counter;
			$show      = '';
			$collapsed = 'collapsed';
		}
		echo '</div>';
		echo '</div>';
		?>
	</div>
</section>