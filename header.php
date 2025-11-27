<?php
/**
 * The header for the theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package lc-tideywebb
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="preload" href="<?= esc_url( get_stylesheet_directory_uri() . '/fonts/poppins-v20-latin-300.woff2' ); ?>" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?= esc_url( get_stylesheet_directory_uri() . '/fonts/poppins-v20-latin-300.woff' ); ?>" as="font" type="font/woff" crossorigin="anonymous">
    <link rel="preload" href="<?= esc_url( get_stylesheet_directory_uri() . '/fonts/poppins-v20-latin-600.woff2' ); ?>" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?= esc_url( get_stylesheet_directory_uri() . '/fonts/poppins-v20-latin-600.woff' ); ?>" as="font" type="font/woff" crossorigin="anonymous">
    <?php
    if ( is_front_page() ) {
        ?>
<script type="application/ld+json">
{
	"@context": "https://schema.org",
	"@type": "LocalBusiness",
	"name": "Turnpower Services Limited",
	"logo": "https://www.turnpower.co.uk/wp-content/themes/cb-turnpower2025/img/turnpower-og-1200x630.png",
	"url": "https://www.turnpower.co.uk/",
	"telephone": "+442086414141",
	"address": {
    	"@type": "PostalAddress",
    	"streetAddress": "Reactive House, Unit 3, Four Seasons Crescent",
    	"addressLocality": "Sutton",
    	"addressRegion": "Surrey",
    	"postalCode": "SM3 9QR",
    	"addressCountry": "GB"
  	},
  	"geo": {
    	"@type": "GeoCoordinates",
    	"latitude": 51.3775708,
    	"longitude": -0.2910892
  	},
  	"sameAs": [
    	"https://uk.linkedin.com/company/turnpower",
		"https://www.instagram.com/turnpower/"
  	],
  	"contactPoint": [{
    	"@type": "ContactPoint",
    	"telephone": "+442086414141",
    	"contactType": "enquiries"
  	}],
  	"openingHoursSpecification": [{
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": [
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday"
        ],
        "opens": "08:00",
        "closes": "17:30"
  	}]
}
</script>
        <?php
    }
    if ( get_field( 'ga_property', 'options' ) ) {
		// phpcs:disable WordPress.WP.EnqueuedResources.NonEnqueuedScript
        ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?= esc_attr( get_field( 'ga_property', 'options' ) ); ?>"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', '<?= esc_attr( get_field( 'ga_property', 'options' ) ); ?>');
</script>
        <?php
    }
    if ( get_field( 'gtm_property', 'options' ) ) {
        ?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','<?= esc_attr( get_field( 'gtm_property', 'options' ) ); ?>');</script>
<!-- End Google Tag Manager -->
        <?php
    }
    if ( get_field( 'google_site_verification', 'options' ) ) {
        echo '<meta name="google-site-verification" content="' . esc_attr( get_field( 'google_site_verification', 'options' ) ) . '" />';
    }
    if ( get_field( 'bing_site_verification', 'options' ) ) {
        echo '<meta name="msvalidate.01" content="' . esc_attr( get_field( 'bing_site_verification', 'options' ) ) . '" />';
    }
    ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> <?php understrap_body_attributes(); ?>>
<?php
do_action( 'wp_body_open' );
?>
<div class="site" id="page">
    <header id="wrapper-navbar" class="fixed-top">
        <nav id="navbar" class="navbar navbar-expand-lg d-block p-0 pt-2 pt-lg-0" aria-label="Primary navigation">
            <div class="container mb-2 pb-2 d-block d-lg-flex gap-5">
                <div class="d-flex w-lg-auto justify-content-between align-items-center px-2">
                    <a href="/" class="navbar-brand" rel="home" aria-label="Turnpower home"></a>
                    <button class="navbar-toggler input-button" id="navToggle" data-bs-toggle="collapse" data-bs-target=".navbars" type="button" aria-label="Navigation"><i class="fa fa-navicon"></i></button>
                </div>
                <div class="d-flex flex-column-reverse flex-lg-column w-100 gap-2">
                    <div id="topNav" class="d-none d-lg-flex w-100 justify-content-end align-items-lg-center">
                        <a href="tel:<?= esc_url( parse_phone( get_field( 'contact_phone', 'options' ) ) ); ?>" class="btn btn-yellow mt-3 mb-2">
							<span class="d-lg-none">Emergency Call Out</span>
							<span class="d-none d-lg-inline"><i class="fa fa-phone"></i> <?= esc_html( get_field( 'contact_phone', 'options' ) ); ?></span>
						</a>
                    </div>
                    <?php
					wp_nav_menu(
						array(
							'theme_location'  => 'primary_nav',
							'container_class' => 'pt-2 px-0 p-lg-0 collapse navbar-collapse navbars w-100',
							'container_id'    => 'primaryNav',
							'menu_class'      => 'navbar-nav justify-content-between w-100 align-items-lg-end mt-2 mt-lg-0',
							'fallback_cb'     => '',
							'menu_id'         => 'main-menu',
							'depth'           => 2,
							'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
						)
					);
                    ?>
                </div>
            </div>
		
        </nav>
	</header>