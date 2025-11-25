<?php
/**
 * Block template for CB Sectors.
 *
 * @package cb-turnpower2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="cb-sectors py-5">
	<div class="container">
		<h2 class="has-dot">Specialists Across</h2>
		<?php
		// get the sectors page ID from path.
		$sectors_page_id = get_page_by_path( 'sectors' )->ID;

		// get children of the 'sectors' page.
		$sectors = new WP_Query(
			array(
				'post_type'      => 'page',
				'posts_per_page' => -1,
				'post_parent'    => $sectors_page_id,
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
			),
		);
		if ( $sectors->have_posts() ) {
			echo '<div class="sectors-grid">';
			while ( $sectors->have_posts() ) {
				$sectors->the_post();
				?>
				<a class="sector-card" href="<?php the_permalink(); ?>">
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="sector-card__image mb-3">
							<?php the_post_thumbnail( 'large', array( 'class' => 'img-fluid' ) ); ?>
						</div>
					<?php endif; ?>
					<h3 class="fs-500 fw-600 text-uppercase"><?php the_title(); ?></h3>
				</a>
				<?php
			}
			echo '</div>';
			wp_reset_postdata();
		} else {
			echo '<p>No sectors found.</p>';
		}
		?>
	</div>
</section>