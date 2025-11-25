<?php
/**
 * Template for displaying single posts.
 *
 * @package cb-turnpower2025
 */

defined( 'ABSPATH' ) || exit;
get_header();
?>
<main id="main" class="blog">
	<div class="container pt-4 pb-5">
		<div class="row">
			<div class="col-md-12">
				<div class="post_hero">
				  <?php if ( has_post_thumbnail() ) : ?>
				    <?= get_the_post_thumbnail( get_the_ID(), 'full', array( 'class' => 'blog_hero__image' ) ); ?>
				  <?php else : ?>
				    <img src="/wp-content/uploads/2025/10/Rectangle_379_430e9c82-a597-4581-950f-e4f2f319ca7f_1440x.webp" 
				         alt="<?= esc_attr( get_the_title() ); ?>" 
				         class="blog_hero__image">
				  <?php endif; ?>
				</div>
		<section class="breadcrumbs fs-ui mb-4">
        <?php
        if ( function_exists( 'yoast_breadcrumb' ) ) {
            yoast_breadcrumb( '<div id="breadcrumbs" class="my-2">', '</div>' );
        }
        ?>
	    </section>
		        <h1 class="h2"><?= esc_html( get_the_title() ); ?></h1>
				<?php
				// phpcs:disable
				// no read time at the moment as the articles are very short
				// $count = estimate_reading_time_in_minutes(get_the_content(), 200, true, true) ?? null;
				// if ($count) {
				//     echo $count;
				// }
				// phpcs:enable
				?>
				<div class="post_meta mb-4">
					<span><i class="fa-regular fa-calendar"></i> <?= esc_html( get_the_date( 'jS F Y' ) ); ?></span>
					<span><i class="fa-regular fa-clock"></i> <?= esc_html( estimate_reading_time_in_minutes( get_the_content() ) ); ?> minute read</span>
				</div>
				<?php
				echo wp_kses_post( get_the_content() );

				/*
				?>
				<div class="author_box mt-5 has-secondary-300-background-color p-4">
					<div class="row">
						<div class="col-md-2">
							<?= wp_get_attachment_image( get_field( 'author_photo', 'option' ), 'medium', false, array( 'class' => 'img-fluid rounded-circle' ) ); ?>
						</div>
						<div class="col-md-10">
							<h4 class="h3">About the Author</h4>
							<?= wp_kses_post( get_field( 'author_bio', 'option' ) ); ?>
						</div>
					</div>
				</div>

				<?php

				*/

				$prev = get_previous_post();
				$next = get_next_post();

				// Determine the correct Bootstrap class for alignment.
				if ( $prev && $next ) {
					$justify_class = 'justify-content-between'; // Both buttons → space them apart.
				} elseif ( $next ) {
					$justify_class = 'justify-content-end'; // Only Next → Align right.
				} else {
					$justify_class = 'justify-content-start'; // Only Previous → Align left.
				}
				?>

				<div class="post-navigation mt-4 d-flex <?= esc_attr( $justify_class ); ?>">
					<?php
					if ( $prev ) {
						?>
					<a href="<?= esc_url( get_permalink( $prev ) ); ?>" class="btn btn--outline">← Previous</a>
						<?php
					}
					if ( $next ) {
						?>
					<a href="<?= esc_url( get_permalink( $next ) ); ?>" class="btn btn--outline">Next →</a>
						<?php
					}
					?>
				</div>
			</div>
		</div>
    </div>
</main>
<?php
get_footer();
?>