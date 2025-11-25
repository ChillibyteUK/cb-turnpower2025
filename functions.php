<?php
/**
 * Understrap Child Theme functions and definitions
 *
 * @package UnderstrapChild
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

define( 'CB_THEME_DIR', WP_CONTENT_DIR . '/themes/cb-turnpower2025' );

require_once CB_THEME_DIR . '/inc/cb-theme.php';
require_once CB_THEME_DIR . '/inc/cb-faq-schema.php';

/**
 * Removes the parent themes stylesheet and scripts from inc/enqueue.php
 */
function understrap_remove_scripts() {
	wp_dequeue_style( 'understrap-styles' );
	wp_deregister_style( 'understrap-styles' );

	wp_dequeue_script( 'understrap-scripts' );
	wp_deregister_script( 'understrap-scripts' );
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );


/**
 * Enqueue our stylesheet and javascript file
 */

/**
 * Enqueue child-theme.min.css late for override, with filemtime versioning.
 */
function cb_enqueue_theme_css() {
	$rel = '/css/child-theme.min.css';
	$abs = get_stylesheet_directory() . $rel;
	wp_enqueue_style(
		'lc-theme',
		get_stylesheet_directory_uri() . $rel,
		array(),
		file_exists( $abs ) ? filemtime( $abs ) : null
	);
}
add_action( 'wp_enqueue_scripts', 'cb_enqueue_theme_css', 20 );

/**
 * Enqueue child-theme.min.js with filemtime versioning.
 */
function cb_enqueue_theme_js() {
	$rel = '/js/child-theme.min.js';
	$abs = get_stylesheet_directory() . $rel;
	if ( file_exists( $abs ) ) {
		wp_enqueue_script(
			'lc-theme-js',
			get_stylesheet_directory_uri() . $rel,
			array(),
			filemtime( $abs ),
			true
		);
	}
}
add_action( 'wp_enqueue_scripts', 'cb_enqueue_theme_js', 20 );


/**
 * Load the child theme's text domain
 */
function add_child_theme_textdomain() {
	load_child_theme_textdomain( 'cb-turnpower2025', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );


/**
 * Overrides the theme_mod to default to Bootstrap 5
 *
 * This function uses the `theme_mod_{$name}` hook and
 * can be duplicated to override other theme settings.
 *
 * @return string
 */
function understrap_default_bootstrap_version() {
	return 'bootstrap5';
}
add_filter( 'theme_mod_understrap_bootstrap_version', 'understrap_default_bootstrap_version', 20 );



/**
 * Loads javascript for showing customizer warning dialog.
 */
function understrap_child_customize_controls_js() {
	wp_enqueue_script(
		'understrap_child_customizer',
		get_stylesheet_directory_uri() . '/js/customizer-controls.js',
		array( 'customize-preview' ),
		'20130508',
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'understrap_child_customize_controls_js' );

/**
 * [careers] – list Careers CPT in Bootstrap 5 cards
 * Optional attributes:
 *   per_page  (int)  default -1 (all)
 *   columns   (int)  1–4       default 3
 *   orderby   (str)  WP orderby field, default 'date'
 *   order     (str)  ASC|DESC  default 'DESC'
 *
 * Examples:
 *   [careers]
 *   [careers per_page="6" columns="2" order="ASC"]
 */
function cb_careers_shortcode( $atts = [] ) {

	$atts = shortcode_atts(
		[
			'per_page' => -1,
			'columns'  => 3,
			'orderby'  => 'date',
			'order'    => 'DESC',
		],
		$atts,
		'careers'
	);

	// Clamp columns 1–4 and map to Bootstrap grid classes.
	$cols = max( 1, min( 4, (int) $atts['columns'] ) );
	$col_class_map = [
		1 => 'col-12',
		2 => 'col-12 col-md-6',
		3 => 'col-12 col-md-4',
		4 => 'col-12 col-md-3',
	];
	$col_class = $col_class_map[ $cols ];

	$q = new WP_Query( [
		'post_type'      => 'careers',
		'posts_per_page' => (int) $atts['per_page'],
		'orderby'        => sanitize_key( $atts['orderby'] ),
		'order'          => ( 'ASC' === strtoupper( $atts['order'] ) ) ? 'ASC' : 'DESC',
		'post_status'    => 'publish',
	] );

	ob_start();

	if ( $q->have_posts() ) : ?>
		<div class="careers-grid container my-4">
			<div class="row g-4">
				<?php while ( $q->have_posts() ) : $q->the_post(); ?>
					<div class="<?php echo esc_attr( $col_class ); ?>">
						<div class="card h-100 shadow-sm">
							<?php
							if ( has_post_thumbnail() ) {
								echo get_the_post_thumbnail( get_the_ID(), 'large', [ 'class' => 'card-img-top', 'alt' => esc_attr( get_the_title() ) ] );
							} else {
								// Fallback image (change path if needed)
								?>
								<img class="card-img-top" src="<?php echo esc_url( '/wp-content/uploads/2025/10/Rectangle_379_430e9c82-a597-4581-950f-e4f2f319ca7f_1440x.webp' ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
								<?php
							}
							?>
							<div class="card-body d-flex flex-column">
								<h5 class="card-title mb-2">
									<a class="stretched-link text-decoration-none" href="<?php echo esc_url( get_permalink() ); ?>">
										<?php echo esc_html( get_the_title() ); ?>
									</a>
								</h5>
								<p class="card-text text-muted mb-3">
									<?php echo esc_html( wp_trim_words( get_the_excerpt(), 28, '…' ) ); ?>
								</p>
								<div class="mt-auto pt-2">
									<a href="<?php echo esc_url( get_permalink() ); ?>" class="btn btn-primary w-100">View role</a>
								</div>
							</div>
						</div>
					</div>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		</div>
	<?php else : ?>
		<div class="alert alert-info my-4" role="alert">
			No careers found at the moment.
		</div>
	<?php
	endif;

	return ob_get_clean();
}
add_shortcode( 'careers', 'cb_careers_shortcode' );

// Insert the "Careers" page into breadcrumbs on single careers
add_filter('wpseo_breadcrumb_links', function ($links) {
    if ( is_singular('careers') ) {
        // change 'careers' to your page slug if different
        $page = get_page_by_path('careers');
        if ( $page ) {
            $crumb = [
                'url'  => get_permalink($page->ID),
                'text' => get_the_title($page->ID),
            ];
            // insert right after "Home"
            array_splice($links, 1, 0, [$crumb]);
        }
    }
    return $links;
});

// Enqueue Slick (CSS + JS) and our init
add_action('wp_enqueue_scripts', function () {
    // Slick from CDN
    wp_enqueue_style('slick-core', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', [], '1.8.1');
    wp_enqueue_style('slick-theme', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css', ['slick-core'], '1.8.1');
    wp_enqueue_script('slick-core', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', ['jquery'], '1.8.1', true);
});