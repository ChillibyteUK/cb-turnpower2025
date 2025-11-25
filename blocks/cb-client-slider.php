<?php
/**
 * Block template for CB Client Slider.
 *
 * @package cb-turnpower2025
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="client-slider has-blue-200-background-color has-background-color py-5">
	<div class="container">
		<h2 class="has-dot mb-4">Trusted by National Brands</h2>
		<?php

		// get client posts.
		$client_posts = new WP_Query(
			array(
				'post_type'      => 'clients',
				'posts_per_page' => -1,
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
			)
		);
		if ( $client_posts->have_posts() ) {
			// Output in swiper slider.
			?>
			<div class="swiper client-swiper">
				<div class="swiper-wrapper">
					<?php
					while ( $client_posts->have_posts() ) {
						$client_posts->the_post();
						?>
						<div class="swiper-slide">
							<?php
							if ( has_post_thumbnail() ) {
								echo get_the_post_thumbnail( get_the_ID(), 'medium', array( 'alt' => get_the_title() ) );
							}
							?>
						</div>
						<?php
					}
					wp_reset_postdata();
					?>
				</div>
			</div>
			<?php
		}
		?>
	</div>
</div>
<?php
add_action(
	'wp_footer',
	function () {
		?>
<script>
	document.addEventListener( 'DOMContentLoaded', function () {
		new Swiper( '.client-swiper', {
			loop: true,
			slidesPerView: 1,
			spaceBetween: 30,
			autoplay: {
				delay: 3000,
				disableOnInteraction: false,
			},
			breakpoints: {
				480: {
					slidesPerView: 2,
				},
				768: {
					slidesPerView: 3,
				},
				1200: {
					slidesPerView: 4,
				},
			},
		} );
	} );
	</script>
		<?php
	}
);