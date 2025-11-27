<?php
/**
 * Footer template for the Turnpower 2025 theme.
 *
 * This file contains the footer section of the theme, including navigation menus,
 * office addresses, and colophon information.
 *
 * @package cb-turnpower2025
 */

defined( 'ABSPATH' ) || exit;
?>
<div id="footer-top"></div>

<footer class="footer pt-5 pb-4">
    <div class="container pt-5">
        <div class="row pb-4 g-3">
			<div class="col-12 col-md-3">
				<img src="<?= esc_url( get_stylesheet_directory_uri() . '/img/turnpower-logo--wo.svg' ); ?>" alt="Turnpower Limited" class="footer-logo">
			</div>
            <div class="col-12 col-md-3">
				<div class="footer-title">Quick Links</div>
                <?=
				wp_nav_menu(
					array(
						'theme_location' => 'footer_menu1',
						'menu_class'     => 'footer__menu',
					)
				);
				?>
            </div>
            <div class="col-12 col-md-3">
				<div class="footer-title">Contact info</div>
				<ul class="list-unstyled">
					<li>T: <?= do_shortcode( '[contact_phone]' ); ?></li>
					<li>F: <?= do_shortcode( '[contact_phone_2]' ); ?></li>
					<li>E: <?= do_shortcode( '[contact_email]' ); ?></li>
				</ul>
            </div>
            <div class="col-12 col-md-3">
				<div class="footer-title">Turnpower Services Limited</div>
				<ul class="list-unstyled">
					<li style="line-height:2"><?= do_shortcode( '[contact_address]' ); ?></li>
				</ul>
            </div>
        </div>

        <div class="colophon d-flex justify-content-between align-items-center flex-wrap">
            <div>
                &copy; <?= esc_html( gmdate( 'Y' ) ); ?> Turnpower Services Limited. Company Number 02840678
            </div>
            <div>
				<a href="/terms-of-use/">Terms of use</a> | <a href="/privacy-policy/">Privacy</a> & <a href="/cookie-policy/">Cookies</a> |
                <a href="https://www.chillibyte.co.uk/" rel="nofollow noopener" target="_blank" class="cb" aria-label="Chillibyte website"></a>
            </div>
        </div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>

</html>