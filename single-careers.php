<?php
/**
 * Template for displaying single Careers posts.
 *
 * @package cb-turnpower2025
 */

defined( 'ABSPATH' ) || exit;

get_header();

$job_id = get_the_ID();

// ── ACF fields ────────────────────────────────────────────────────────────────
$role_purpose         = get_field( 'role_purpose', $job_id );
$key_responsibilities = get_field( 'key_responsibilities', $job_id );
$skills_experience    = get_field( 'skills_experience', $job_id );
$benefits             = get_field( 'benefits', $job_id );
$equality_inclusion   = get_field( 'equality_inclusion', $job_id );
$employment_type      = get_field( 'employment_type', $job_id );
$date_posted          = get_field( 'date_posted', $job_id );
if ( ! $date_posted ) {
	$date_posted = get_the_date( 'Y-m-d' );
}
$valid_through    = get_field( 'valid_through', $job_id );
$location_type    = get_field( 'location_type', $job_id );
$street_address   = get_field( 'street_address', $job_id );
$address_locality = get_field( 'address_locality', $job_id );
$address_region   = get_field( 'address_region', $job_id );
$postal_code      = get_field( 'postal_code', $job_id );
$address_country  = get_field( 'address_country', $job_id );
if ( ! $address_country ) {
	$address_country = 'GB';
}
$salary_type     = get_field( 'salary_type', $job_id );
$minimum_salary  = get_field( 'minimum_salary', $job_id );
$maximum_salary  = get_field( 'maximum_salary', $job_id );
$salary_currency = get_field( 'salary_currency', $job_id );
if ( ! $salary_currency ) {
	$salary_currency = 'GBP';
}
$salary_unit = get_field( 'salary_unit', $job_id );
if ( ! $salary_unit ) {
	$salary_unit = 'YEAR';
}
$tenure = get_field( 'tenure', $job_id );

// Application form ID from site-wide settings.
$form_id = (int) get_field( 'careers_application_form_id', 'option' );

// ── Derived display values ────────────────────────────────────────────────────
$emp_labels = array(
	'FULL_TIME'  => 'Full Time',
	'PART_TIME'  => 'Part Time',
	'CONTRACTOR' => 'Contractor',
	'TEMPORARY'  => 'Temporary',
	'INTERN'     => 'Intern',
	'VOLUNTEER'  => 'Volunteer',
	'PER_DIEM'   => 'Per Diem',
	'OTHER'      => 'Other',
);
$emp_label  = $emp_labels[ $employment_type ] ?? $employment_type;

$tenure_labels = array(
	'permanent'      => 'Permanent',
	'temporary'      => 'Temporary',
	'contract'       => 'Contract',
	'fixed_term'     => 'Fixed Term',
	'apprenticeship' => 'Apprenticeship',
	'zero_hours'     => 'Zero Hours',
);
$tenure_label  = $tenure_labels[ $tenure ] ?? $tenure;

$unit_map = array(
	'YEAR'  => 'per year',
	'MONTH' => 'per month',
	'WEEK'  => 'per week',
	'DAY'   => 'per day',
	'HOUR'  => 'per hour',
);
$unit_str = $unit_map[ $salary_unit ] ?? strtolower( (string) $salary_unit );

if ( 'range' === $salary_type && $minimum_salary && $maximum_salary ) {
	$salary_display = '£' . number_format( (int) $minimum_salary ) . ' – £' . number_format( (int) $maximum_salary ) . ' ' . $unit_str;
} elseif ( 'range' === $salary_type && $minimum_salary ) {
	$salary_display = '£' . number_format( (int) $minimum_salary ) . '+ ' . $unit_str;
} else {
	$salary_display = 'Competitive / Negotiable';
}

if ( 'remote' === $location_type ) {
	$location_display = 'Remote';
} elseif ( 'hybrid' === $location_type ) {
	$location_display = 'Hybrid' . ( $address_locality ? ' — ' . $address_locality : '' );
} else {
	$parts            = array_filter( array( $street_address, $address_locality, $postal_code ) );
	$location_display = implode( ', ', $parts );
}
?>

<main id="main" class="single-career">

	<?php /* Hero */ ?>
	<section class="career-hero">
		<div class="container">
			<div class="row">
				<div class="col-lg-10">
					<?php
					if ( function_exists( 'yoast_breadcrumb' ) ) {
						yoast_breadcrumb( '<div id="breadcrumbs" class="breadcrumbs fs-ui mb-3">', '</div>' );
					}
					?>
					<h1 class="career-hero__title"><?= esc_html( get_the_title() ); ?></h1>
					<div class="career-hero__meta">
						<?php if ( $emp_label ) : ?>
						<span class="d-none d-lg-inline career-card__badge career-card__badge--type"><?= esc_html( $emp_label ); ?></span>
						<?php endif; ?>
						<?php if ( $tenure_label ) : ?>
						<span class="d-none d-lg-inline career-card__badge career-card__badge--tenure"><?= esc_html( $tenure_label ); ?></span>
						<?php endif; ?>
						<?php if ( $location_display ) : ?>
						<span class="d-none d-lg-inline career-card__badge career-card__badge--location">
							<i class="fa fa-location-dot" aria-hidden="true"></i>
							<?= esc_html( $location_display ); ?>
						</span>
						<?php endif; ?>
						<?php if ( $date_posted ) : ?>
						<span class="career-card__badge career-card__badge--date">
							<i class="fa fa-calendar" aria-hidden="true"></i>
							Posted <?= esc_html( date_i18n( 'jS F Y', strtotime( $date_posted ) ) ); ?>
						</span>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php /* Body */ ?>
	<section class="career-body py-5">
		<div class="container">
			<div class="row g-5">

				<?php /* Main content */ ?>
				<div class="col-lg-8 order-2 order-lg-1">

					<?php
					if ( $role_purpose ) {
						?>
					<div class="career-section career-section--purpose mb-4">
						<p class="lead"><?= nl2br( esc_html( $role_purpose ) ); ?></p>
					</div>
						<?php
					}

					if ( $key_responsibilities ) {
						?>
					<div class="career-section mb-4">
						<h2 class="career-section__title">Key Responsibilities</h2>
						<ul class="career-list">
							<?= wp_kses_post( cb_list( $key_responsibilities ) ); ?>
						</ul>
					</div>
						<?php
					}

					if ( $skills_experience ) {
						?>
					<div class="career-section mb-4">
						<h2 class="career-section__title">Skills &amp; Experience</h2>
						<ul class="career-list">
							<?= wp_kses_post( cb_list( $skills_experience ) ); ?>
						</ul>
					</div>
						<?php
					}

					if ( $benefits ) {
						?>
					<div class="career-section mb-4">
						<h2 class="career-section__title">Benefits</h2>
						<ul class="career-list">
							<?= wp_kses_post( cb_list( $benefits ) ); ?>
						</ul>
					</div>
						<?php
					}

					if ( $equality_inclusion ) {
						?>
					<div class="career-section career-section--equality mt-5">
						<h3 class="career-section__title">Equality &amp; Inclusion</h3>
						<p><?= nl2br( esc_html( $equality_inclusion ) ); ?></p>
					</div>
						<?php
					}
					?>

				</div><!-- col-lg-8 -->

				<?php /* Sidebar */ ?>
				<div class="col-lg-4 order-1 order-lg-2">
					<aside class="career-sidebar">

						<div class="career-sidebar__details mb-4">
							<h3 class="career-sidebar__heading">Job Details</h3>
							<dl class="career-details">
								<?php if ( $salary_display ) : ?>
								<dt><i class="fa fa-sterling-sign" aria-hidden="true"></i> Salary</dt>
								<dd><?= esc_html( $salary_display ); ?></dd>
								<?php endif; ?>

								<?php if ( $emp_label ) : ?>
								<dt><i class="fa fa-briefcase" aria-hidden="true"></i> Type</dt>
								<dd><?= esc_html( $emp_label ); ?></dd>
								<?php endif; ?>

								<?php if ( $tenure_label ) : ?>
								<dt><i class="fa fa-file-contract" aria-hidden="true"></i> Tenure</dt>
								<dd><?= esc_html( $tenure_label ); ?></dd>
								<?php endif; ?>

								<?php if ( $location_display ) : ?>
								<dt><i class="fa fa-location-dot" aria-hidden="true"></i> Location</dt>
								<dd><?= esc_html( $location_display ); ?></dd>
								<?php endif; ?>
							</dl>
						</div>

					<?php if ( $form_id ) : ?>
					<div class="career-sidebar__apply">
						<a href="#career-apply-modal"
							class="btn btn-primary w-100 career-sidebar__apply-btn"
							data-bs-toggle="modal"
							data-bs-target="#career-apply-modal">
							<i class="fa fa-paper-plane me-2" aria-hidden="true"></i>
							Apply for this Role
						</a>
					</div>
					<?php endif; ?>

					</aside>
				</div><!-- col-lg-4 -->

			</div><!-- .row -->
		</div><!-- .container -->
	</section>

	<?php /* Other open positions */ ?>
	<?php
	$other_jobs = new WP_Query(
		array(
			'post_type'      => 'careers',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'post__not_in'   => array( $job_id ),
			'orderby'        => 'date',
			'order'          => 'DESC',
			'no_found_rows'  => true,
		)
	);
	if ( $other_jobs->have_posts() ) {
		?>
	<section class="career-other-roles py-4">
		<div class="container">
			<div class="row">
				<div class="col">
					<h3 class="career-other-roles__heading">Other Current Opportunities</h3>
					<ul class="career-other-roles__list">
						<?php
                        while ( $other_jobs->have_posts() ) :
							$other_jobs->the_post();
							?>
						<li>
							<a href="<?= esc_url( get_permalink() ); ?>"><?= esc_html( get_the_title() ); ?></a>
						</li>
							<?php
                        endwhile;
						wp_reset_postdata();
						?>
					</ul>
				</div>
			</div>
		</div>
	</section>
		<?php
	}

	if ( $form_id ) {
		$modal_field_values = 'jobapplied=' . rawurlencode( get_the_title() );
		?>
	<div class="modal fade career-apply-modal" id="career-apply-modal" tabindex="-1"
		aria-labelledby="career-apply-modal-label" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="modal-title h4" id="career-apply-modal-label">
						Apply for: <?= esc_html( get_the_title() ); ?>
					</h2>
					<button type="button" class="btn-close" data-bs-dismiss="modal"
					        aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<?=
                    do_shortcode(
						'[gravityform id="' . $form_id . '" title="false" description="false" ajax="true" field_values="' . esc_attr( $modal_field_values ) . '"]'
					);
                    ?>
				</div>
			</div>
		</div>
	</div>
		<?php
	}
	?>

</main>

<?php
// ── Google JobPosting JSON-LD Schema ─────────────────────────────────────────
$schema = array(
	'@context'           => 'https://schema.org/',
	'@type'              => 'JobPosting',
	'title'              => get_the_title(),
	'description'        => wp_strip_all_tags( (string) $role_purpose ),
	'datePosted'         => $date_posted,
	'employmentType'     => $employment_type,
	'hiringOrganization' => array(
		'@type'  => 'Organization',
		'name'   => get_bloginfo( 'name' ),
		'sameAs' => home_url(),
	),
);

if ( $valid_through ) {
	$schema['validThrough'] = $valid_through . 'T00:00:00Z';
}

if ( 'remote' === $location_type ) {
	$schema['jobLocationType']               = 'TELECOMMUTE';
	$schema['applicantLocationRequirements'] = array(
		'@type' => 'Country',
		'name'  => 'United Kingdom',
	);
} else {
	$schema['jobLocation'] = array(
		'@type'   => 'Place',
		'address' => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => $street_address,
			'addressLocality' => $address_locality,
			'addressRegion'   => $address_region,
			'postalCode'      => $postal_code,
			'addressCountry'  => $address_country,
		),
	);
}

if ( 'range' === $salary_type && ( $minimum_salary || $maximum_salary ) ) {
	$schema['baseSalary'] = array(
		'@type'    => 'MonetaryAmount',
		'currency' => $salary_currency,
		'value'    => array(
			'@type'    => 'QuantitativeValue',
			'minValue' => (float) $minimum_salary,
			'maxValue' => (float) $maximum_salary,
			'unitText' => $salary_unit,
		),
	);
}

echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT ) . '</script>' . "\n";

get_footer();
?>
