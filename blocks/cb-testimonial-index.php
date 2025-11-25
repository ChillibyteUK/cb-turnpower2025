<?php
/**
 * Block template for CB Testimonial Index.
 *
 * @package cb-turnpower2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="testimonial-index">
	<div class="container">
		<?php
		// get testimonial posts.
		$testimonial_posts = new WP_Query(
			array(
				'post_type'      => 'testimonials',
				'posts_per_page' => -1,
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
			)
		);
		if ( $testimonial_posts->have_posts() ) {
			while ( $testimonial_posts->have_posts() ) {
				$testimonial_posts->the_post();
				?>
				<a id="<?= esc_attr( 'testimonial-' . get_the_ID() ); ?>" class="anchor"></a>
				<div class="testimonial-index__card">
					<div class="testimonial-index__quote"><?= wp_kses_post( get_the_content() ); ?></div>
					<div class="testimonial-index__author"><?= esc_html( get_the_title() ); ?></div>
				</div>
				<?php
			}
			wp_reset_postdata();
		}
		?>
	</div>
</section>