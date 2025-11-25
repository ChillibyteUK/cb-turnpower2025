<?php
/**
 * Block template for CB USP Block.
 *
 * @package cb-turnpower2025
 */

defined( 'ABSPATH' ) || exit;

$class_name = 'usp-block';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}

$styles = array();
if ( ! empty( $block['backgroundColor'] ) ) {
	$class_name .= ' has-' . $block['backgroundColor'] . '-background-color has-background';
} elseif ( ! empty( $block['style']['color']['background'] ) ) {
	$styles[] = 'background-color: ' . esc_attr( $block['style']['color']['background'] );
}

if ( ! empty( $block['textColor'] ) ) {
	$class_name .= ' has-' . $block['textColor'] . '-color has-text-color';
} elseif ( ! empty( $block['style']['color']['text'] ) ) {
	$styles[] = 'color: ' . esc_attr( $block['style']['color']['text'] );
}

$style_attr = ! empty( $styles ) ? ' style="' . implode( '; ', $styles ) . '"' : '';
?>
<section class="<?= esc_attr( $class_name ); ?>"<?= $style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-9 py-5 text-center fs-600">
				<?= wp_kses_post( get_field( 'usp_text' ) ); ?>
        		<?php
				$cta_link = get_field( 'cta' );
				if ( $cta_link ) {
					$cta_link_url    = $cta_link['url'];
					$cta_link_title  = $cta_link['title'];
					$cta_link_target = $cta_link['target'] ? $cta_link['target'] : '_self';
					?>
            	<div class="d-block mt-4"><a class="btn btn-primary" href="<?php echo esc_url( $cta_link_url ); ?>" target="<?php echo esc_attr( $cta_link_target ); ?>"><?php echo esc_html( $cta_link_title ); ?></a></div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
</section>