<?php
/**
 * Block template for CB Checklist.
 *
 * @package cb-turnpower2025
 */

defined( 'ABSPATH' ) || exit;

$class_name = 'checklist-block';
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
		<?php
		if ( get_field( 'title' ) ) {
			?>
		<h2 class="mb-4"><?= esc_html( get_field( 'title' ) ); ?></h2>
			<?php
		}
		if ( get_field( 'items' ) ) {
			echo '<ul class="fa-ul checklist-block__list cols-lg-3" style="column-gap: 3rem;">';
			echo wp_kses_post( cb_list( get_field( 'items' ), 'fa-solid fa-check' ) );
			echo '</ul>';
		}
		?>
	</div>
</section>