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
						<div class="client-index__card">
							<?=
							get_the_post_thumbnail(
								get_the_ID(),
								'full',
								array(
									'alt'   => get_the_title(),
									'class' => 'client-index__image',
								)
							);
							?>
							<h3 class="client-index__title fw-bold fs-500"><?= esc_html( get_the_title() ); ?></h3>
							<div class="client-index__content"><?= wp_kses_post( get_the_content() ); ?></div>
						</div>
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