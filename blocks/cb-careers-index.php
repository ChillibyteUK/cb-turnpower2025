<?php
/**
 * Block template for CB Careers Index.
 *
 * Queries all published careers posts and renders a card listing.
 * Falls back to a configurable message when no vacancies exist.
 *
 * @package cb-turnpower2025
 */

defined( 'ABSPATH' ) || exit;

$heading    = trim( (string) get_field( 'heading' ) ) ?: 'Current Opportunities';
$no_vac_msg = trim( (string) get_field( 'no_vacancies_message' ) ) ?: "We don't currently have any vacancies. Please check back soon.";

$class_name = 'careers-index';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}

$emp_labels = [
	'FULL_TIME'  => 'Full Time',
	'PART_TIME'  => 'Part Time',
	'CONTRACTOR' => 'Contractor',
	'TEMPORARY'  => 'Temporary',
	'INTERN'     => 'Intern',
	'VOLUNTEER'  => 'Volunteer',
	'PER_DIEM'   => 'Per Diem',
	'OTHER'      => 'Other',
];

$tenure_labels = [
	'permanent'      => 'Permanent',
	'temporary'      => 'Temporary',
	'contract'       => 'Contract',
	'fixed_term'     => 'Fixed Term',
	'apprenticeship' => 'Apprenticeship',
	'zero_hours'     => 'Zero Hours',
];

$unit_map = [
	'YEAR'  => 'per year',
	'MONTH' => 'per month',
	'WEEK'  => 'per week',
	'DAY'   => 'per day',
	'HOUR'  => 'per hour',
];

$jobs = new WP_Query(
	[
		'post_type'      => 'careers',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'orderby'        => 'date',
		'order'          => 'DESC',
		'no_found_rows'  => true,
	]
);
?>
<section class="<?= esc_attr( $class_name ); ?>">
	<div class="container">

		<?php if ( $heading ) : ?>
		<div class="row mb-4">
			<div class="col">
				<h2 class="careers-index__heading"><?= esc_html( $heading ); ?></h2>
			</div>
		</div>
		<?php endif; ?>

		<?php if ( $jobs->have_posts() ) : ?>
		<div class="row g-4">
			<?php
			while ( $jobs->have_posts() ) :
				$jobs->the_post();
				$job_id       = get_the_ID();
				$emp_type     = get_field( 'employment_type', $job_id );
				$emp_label    = $emp_labels[ $emp_type ] ?? $emp_type;
				$tenure_val   = get_field( 'tenure', $job_id );
				$tenure_label = $tenure_labels[ $tenure_val ] ?? $tenure_val;
				$loc_type     = get_field( 'location_type', $job_id );
				$salary_type  = get_field( 'salary_type', $job_id );
				$role_purpose = trim( (string) get_field( 'role_purpose', $job_id ) );
				$excerpt      = mb_strimwidth( wp_strip_all_tags( $role_purpose ), 0, 200, '…' );

				// Location label.
				if ( 'remote' === $loc_type ) {
					$location_label = 'Remote';
				} elseif ( 'hybrid' === $loc_type ) {
					$locality       = get_field( 'address_locality', $job_id );
					$location_label = 'Hybrid' . ( $locality ? ' · ' . $locality : '' );
				} else {
					$locality       = get_field( 'address_locality', $job_id );
					$location_label = $locality ?: 'On-site';
				}

				// Salary label.
				if ( 'range' === $salary_type ) {
					$min      = (int) get_field( 'minimum_salary', $job_id );
					$max      = (int) get_field( 'maximum_salary', $job_id );
					$unit     = get_field( 'salary_unit', $job_id );
					$unit_str = $unit_map[ $unit ] ?? strtolower( (string) $unit );
					if ( $min && $max ) {
						$salary_label = '£' . number_format( $min ) . ' – £' . number_format( $max ) . ' ' . $unit_str;
					} elseif ( $min ) {
						$salary_label = '£' . number_format( $min ) . '+ ' . $unit_str;
					} else {
						$salary_label = 'Competitive / Negotiable';
					}
				} else {
					$salary_label = 'Competitive / Negotiable';
				}
			?>
			<div class="col-12 col-md-6 col-xl-4">
				<article class="career-card h-100">
					<div class="career-card__body">
						<div class="career-card__meta mb-2">
							<?php if ( $emp_label ) : ?>
							<span class="career-card__badge career-card__badge--type"><?= esc_html( $emp_label ); ?></span>
							<?php endif; ?>
							<?php if ( $tenure_label ) : ?>
							<span class="career-card__badge career-card__badge--tenure"><?= esc_html( $tenure_label ); ?></span>
							<?php endif; ?>
							<?php if ( $location_label ) : ?>
							<span class="career-card__badge career-card__badge--location">
								<i class="fa fa-location-dot" aria-hidden="true"></i>
								<?= esc_html( $location_label ); ?>
							</span>
							<?php endif; ?>
						</div>

						<h3 class="career-card__title"><?= esc_html( get_the_title() ); ?></h3>

						<?php if ( $salary_label ) : ?>
						<p class="career-card__salary">
							<i class="fa fa-sterling-sign" aria-hidden="true"></i>
							<?= esc_html( $salary_label ); ?>
						</p>
						<?php endif; ?>

						<?php if ( $excerpt ) : ?>
						<p class="career-card__excerpt"><?= esc_html( $excerpt ); ?></p>
						<?php endif; ?>
					</div>
					<div class="career-card__footer">
						<a href="<?= esc_url( get_permalink() ); ?>" class="career-card__link stretched-link">
							View role <i class="fa fa-arrow-right" aria-hidden="true"></i>
						</a>
					</div>
				</article>
			</div>
			<?php endwhile; wp_reset_postdata(); ?>
		</div><!-- .row -->

		<?php else : ?>
		<div class="row">
			<div class="col">
				<p class="careers-index__no-vacancies"><?= wp_kses_post( $no_vac_msg ); ?></p>
			</div>
		</div>
		<?php endif; ?>

	</div><!-- .container -->
</section>
