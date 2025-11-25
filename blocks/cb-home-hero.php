<?php
/**
 * Template for CB Home Hero.
 *
 * @package cb-turnpower2025
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center home-hero">
    <video class="w-100" autoplay muted loop id="myVideo">
        <source src="/wp-content/uploads/2025/10/6fad0e7757324dc89b9039e8804cd3fd-1.mp4" type="video/mp4">
    </video>
	<div class="overlay"></div>
	<div class="content">
		<div class="container h-100">
			<div class="row h-100">
				<div class="col-lg-7 my-auto">
					<h1><?= esc_html( get_field( 'title' ) ); ?></h1>
					<div class="words mb-4"><?= wp_kses_post( get_field( 'words' ) ); ?></div>
					<a href="#" class="btn btn--primary"><?= esc_html( 'button' ); ?></a>
				</div>
			</div>
		</div>
	</div>
	<div class="hero-swoop"></div>
</section>