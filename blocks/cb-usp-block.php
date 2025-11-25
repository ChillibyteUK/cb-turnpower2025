<?php
/**
 * Block template for CB USP Block.
 *
 * @package cb-turnpower2025
 */

defined( 'ABSPATH' ) || exit;

$bg_choice = get_field( 'background' );

switch ( $bg_choice ) {
	case 'light-blue':
		$bg_class = 'has-blue-200-background-color has-background has-white-color';
		break;
	case 'black':
		$bg_class = 'has-black-background-color has-background has-white-color';
		break;
	case 'red':
    	$bg_class = 'has-red-background-color has-background has-white-color';
    	break;
	case 'purple':
    	$bg_class = 'has-purple-background-color has-background has-white-color';
    	break;
	case 'green':
    	$bg_class = 'has-green-background-color has-background has-white-color';
    	break;
	case 'burgundy':
		$bg_class = 'has-burgundy-background-color has-background has-white-color';
    	break;
  	case 'blue':
	default:
    	$bg_class = 'has-blue-900-background-color has-background has-white-color';
    	break;
}
?>
<section class="usp-block <?= esc_attr( $bg_class ); ?>">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-9 has-white-color py-5 text-center fs-600">
				<?= wp_kses_post( get_field( 'usp_text' ) ); ?>
        		<?php
				$cta_link = get_field( 'cta' );
				if ( $cta_link ) {
					$cta_link_url    = $cta_link['url'];
					$cta_link_title  = $cta_link['title'];
					$cta_link_target = $cta_link['target'] ? $cta_link['target'] : '_self';
					?>
            	<div class="d-block mt-4"><a class="btn btn-primary" href="<?php echo esc_url( $cta_link_url ); ?>" target="<?php echo esc_attr( $cta_link_target ); ?>"><?php echo esc_html( $cta_link_title ); ?></a></div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
</section>