<?php
/**
 * Block template for CB Text Image.
 *
 * @package cb-turnpower2025
 */

defined( 'ABSPATH' ) || exit;

// Get ACF fields.
$col_order = get_field( 'order' ) ? get_field( 'order' ) : 'Text Image';
$split     = get_field( 'split' ) ? get_field( 'split' ) : '50 50';
$level     = get_field( 'level' ) ? get_field( 'level' ) : 'h2';

// Get block attributes for colors.
$block_classes = array();
$block_styles  = array();
$bg_classes    = array();
$bg_styles     = array();

// Handle background color from block settings.
if ( ! empty( $block['backgroundColor'] ) ) {
	$bg_classes[] = 'has-' . $block['backgroundColor'] . '-background-color';
	$bg_classes[] = 'has-background';
} elseif ( ! empty( $block['style']['color']['background'] ) ) {
	$bg_styles[] = 'background-color: ' . $block['style']['color']['background'];
}

// Handle text color from block settings.
if ( ! empty( $block['textColor'] ) ) {
	$block_classes[] = 'has-' . $block['textColor'] . '-color';
	$block_classes[] = 'has-text-color';
} elseif ( ! empty( $block['style']['color']['text'] ) ) {
	$block_styles[] = 'color: ' . $block['style']['color']['text'];
}

$classes         = $block_classes;
$style           = ! empty( $block_styles ) ? implode( '; ', $block_styles ) : '';
$bg_class_string = ! empty( $bg_classes ) ? implode( ' ', $bg_classes ) : '';
$bg_style_string = ! empty( $bg_styles ) ? implode( '; ', $bg_styles ) : '';

// Determine column order classes.
$text_col_order  = 'order-md-1';
$image_col_order = 'order-md-2';
if ( 'Image Text' === $col_order ) {
	$text_col_order  = 'order-md-2';
	$image_col_order = 'order-md-1';
}

// Determine column width classes.
if ( '60 40' === $split ) {
	$text_col_width  = 'col-md-7';
	$image_col_width = 'col-md-5';
} elseif ( '40 60' === $split ) {
	$text_col_width  = 'col-md-5';
	$image_col_width = 'col-md-7';
} else {
	// Default to 50 50.
	$text_col_width  = 'col-md-6';
	$image_col_width = 'col-md-6';
}

// Determine heading level.
$heading_tag = ( 'h1' === $level ) ? 'h1' : 'h2';
// Generate a unique ID for this block instance.
$block_uid = 'text-image-' . uniqid();
?>
<section id="<?= esc_attr( $block_uid ); ?>" class="text-image <?= esc_attr( implode( ' ', $classes ) ); ?> py-5" <?= $style ? 'style="' . esc_attr( $style ) . '"' : ''; ?>>
  	<div class="container">
		<div class="row gy-5 gx-4 gx-lg-5 align-items-center">
			<?php
			// Always output text column first, image column second in the DOM.
			// Parameterise data-animate so that on desktop, columns always slide in from outside in.
			$text_order_class  = $text_col_order;
			$image_order_class = $image_col_order;
			$text_animate      = 'right';
			$image_animate     = 'left';
			if ( 'Image Text' === $col_order ) {
				// Visually swap columns on md+ screens, and swap data-animate so image slides in from left, text from right.
				$text_order_class  = 'order-2 order-md-2';
				$image_order_class = 'order-1 order-md-1';
				$text_animate      = 'left';
				$image_animate     = 'right';
			}
			?>
			<div class="<?= esc_attr( $text_col_width . ' ' . $text_order_class ); ?>" data-aos="fade">
				<?php
				if ( get_field( 'title' ) ) {
					$dot_field = get_field( 'dot' );
					$dot       = ( is_array( $dot_field ) && in_array( 'Yes', $dot_field, true ) ) ? 'has-dot' : '';
					?>
				<<?= esc_attr( $heading_tag ); ?> class="has-700-font-size mb-4 <?= esc_attr( $dot ); ?>"><?= wp_kses_post( get_field( 'title' ) ); ?></<?= esc_attr( $heading_tag ); ?>>
					<?php
				}
				?>
				<?php
				if ( get_field( 'sub_title' ) ) {
					?>
				<div class="has-blue-400-color has-text-color has-500-font-size fw-500 mb-4"><?= wp_kses_post( get_field( 'sub_title' ) ); ?></div>
					<?php
				}
				?>
				<div>
					<?= wp_kses_post( get_field( 'content' ) ); ?>
					<?php
					if ( get_field( 'cta' ) ) {
						$cta = get_field( 'cta' );
						?>
						<p class="mt-4"><a class="btn" href="<?= esc_url( $cta['url'] ); ?>"
							target="<?= esc_attr( $cta['target'] ? $cta['target'] : '_self' ); ?>"><?= esc_html( $cta['title'] ); ?></a>
						</p>
						<?php
					}
					?>
				</div>
			</div>
			<div class="<?= esc_attr( $image_col_width . ' ' . $image_order_class ); ?> text-center" data-aos="fade">
					<?= wp_get_attachment_image( get_field( 'image' ), 'full', false, array() ); ?>
			</div>
		</div>
	</div>
</section>