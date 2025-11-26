<?php
/**
 * Block template for CB Testimonials.
 *
 * @package cb-turnpower2025
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="cb-testimonials has-blue-400-background-color has-background has-white-color">
	<div class="container">
		<h2 class="has-dot">Testimonials</h2>
		<?php

		// slider of testimonial posts.
		$testimonial_posts = new WP_Query(
			array(
				'post_type'      => 'testimonials',
				'posts_per_page' => -1,
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
			)
		);
		if ( $testimonial_posts->have_posts() ) {
			?>
			<div class="swiper testimonial-swiper">
				<div class="swiper-wrapper">
					<?php
					while ( $testimonial_posts->have_posts() ) {
						$testimonial_posts->the_post();
						$content         = wp_strip_all_tags( get_the_content() );
						$words           = explode( ' ', $content );
						$limit           = 48;
						$limited_content = count( $words ) > $limit ? implode( ' ', array_slice( $words, 0, $limit ) ) . '&hellip;' : $content;
						?>
						<div class="swiper-slide">
							<a href="<?= esc_attr( '/testimonials/#testimonial-' . get_the_ID() ); ?>" class="testimonial-card p-4">
								<div class="testimonial-card__quote">
									&ldquo;<?= esc_html( $limited_content ); ?>&rdquo;
								</div>
								<div class="testimonial-card__author">
									<?= esc_html( get_the_title() ); ?>
								</div>
							</a>
						</div>
						<?php
					}
					?>
				</div>
			</div>
			<?php
		}
		wp_reset_postdata();
		?>
	</div>
	<div class="hero-swoop"></div>
</section>
<?php
add_action(
	'wp_footer',
	function () {
		?>
<script>
	document.addEventListener( 'DOMContentLoaded', function () {
		new Swiper( '.testimonial-swiper', {
			loop: true,
			slidesPerView: 1,
			autoplay: {
				delay: 5000,
			},
		} );
	} );
</script>
		<?php
	}
);