<?php
/**
 * Block template for CB Services.
 *
 * @package cb-turnpower2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="cb-services py-5 has-blue-200-background-color has-background">
	<div class="container">
		<h2 class="has-dot">Our Services</h2>
		<div class="row g-4">
			<div class="col-md-6 col-lg-3">
				<div class="service-card has-blue-300-background-color has-background has-white-color">
					<h3 class="fs-600 fw-600">Reactive Maintenance</h3>
					<p class="fw-400">Our service desk is maintained 24 hours a day, 365 days a year, providing a fast, efficient response to every reactive maintenance request.</p>
					<img src="<?= esc_url( get_stylesheet_directory_uri() . '/img/icon--reactive.png' ); ?>" alt="icon">
				</div>
			</div>
			<div class="col-md-6 col-lg-3">
				<div class="service-card has-blue-400-background-color has-background has-white-color">
					<h3 class="fs-600 fw-600">PPM Compliance</h3>
					<p class="fw-400">Well maintained buildings provide a lasting return on your investment, whatever their use.</p>
					<img src="<?= esc_url( get_stylesheet_directory_uri() . '/img/icon--ppm.png' ); ?>" alt="icon">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="service-card--projects has-blue-900-background-color has-background has-white-color h-100">
					<div class="service-card">
						<h3 class="fs-600 fw-600">Projects</h3>
						<p class="fw-400">Turnpower's Mechanical &amp; Electrical division is the flagship activity of the company's extensive building services portfolio.</p>
					</div>
					<img src="/wp-content/uploads/2025/10/tossed-synecore11.jpg" alt="projects image">
				</div>
			</div>
		</div>
	</div>
</section>