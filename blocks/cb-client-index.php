<?php
/**
 * Block template for CB Client Index.
 *
 * @package cb-turnpower2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="client-index">
	<div class="container">
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
			?>
			<div class="row row-cols-md-2 row-cols-lg-3 g-4">
				<?php
				while ( $client_posts->have_posts() ) {
					$client_posts->the_post();
					?>
					<div class="col d-flex align-items-center justify-content-center">
						<?php
						if ( get_the_content() ) { // is full case study with content.
							?>
						<a href="<?php the_permalink(); ?>" class="client-index__card">
							<?php
						} else { // just the card.
							?>
						<div class="client-index__card">
							<?php
						}
						?>
							<div class="client-index__image-wrapper">
								<?=
								get_the_post_thumbnail(
									get_the_ID(),
									'full',
									array(
										'alt'   => get_the_title() . ' Logo',
										'class' => 'client-index__image',
									)
								);
								?>
							</div>
							<h3 class="client-index__title fw-bold fs-500"><?= esc_html( get_the_title() ); ?></h3>
							<?php
							if ( get_field( 'client_excerpt', get_the_ID() ) ) {
								?>
							<div class="client-index__content"><?= wp_kses_post( get_field( 'client_excerpt', get_the_ID() ) ); ?></div>
								<?php
							}
							if ( get_the_content() ) {
								?>
						</a>
								<?php
							} else {
								?>
						</div>
								<?php
							}
							?>
					</div>
					<?php
				}
				wp_reset_postdata();
				?>
			</div>
			<?php
		}
		?>
	</div>
</section>