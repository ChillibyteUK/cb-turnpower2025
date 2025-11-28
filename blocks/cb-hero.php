<?php
/**
 * Block template for CB Hero.
 *
 * @package cb-turnpower2025
 */

defined( 'ABSPATH' ) || exit;

$bg = get_field( 'background_image' );
?>
<div class="hero">
	<?= wp_get_attachment_image( $bg, 'full', false, array( 'class' => 'hero__image' ) ); ?>
	<div class="overlay"></div>
	<div class="content">
		<div class="container h-100">
			<div class="row h-100">
				<div class="col-lg-8 my-auto">
					<h1 class="has-dot"><?= esc_html( get_field( 'title' ) ); ?></h1>
					<div class="words mb-4"><?= wp_kses_post( get_field( 'intro' ) ); ?></div>
					<?php
					if ( get_field( 'button' ) ) {
						$button     = get_field( 'button' );
						$btn_url    = $button['url'];
						$btn_title  = $button['title'];
						$btn_target = $button['target'] ? $button['target'] : '_self';
						?>
					<a href="<?= esc_url( $btn_url ); ?>" target="<?= esc_attr( $btn_target ); ?>" class="btn btn--primary"><?= esc_html( $btn_title ); ?></a>
						<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="hero-swoop"></div>
</div>