<?php
/**
 * Template part for displaying the site footer
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="site-container footer-container">
        <div class="footer-navigation-wrap">
            <?php
            if ( has_nav_menu( 'footer' ) ) :
                wp_nav_menu(
                    array(
                        'theme_location' => 'footer',
                        'menu_id'        => 'footer-menu',
                        'menu_class'     => 'footer-menu-list',
                        'container'      => 'nav',
                        'container_class' => 'footer-navigation',
                        'depth'          => 1,
                    )
                );
            endif;
            ?>
        </div>

        <div class="footer-info">
            <p class="site-copyright">
                &copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'drive' ); ?>
            </p>
            <p class="site-disclaimer">
                <?php esc_html_e( 'This website is an independent educational prep resource and is not affiliated with, endorsed by, or sponsored by any official government or Department of Motor Vehicles agency.', 'drive' ); ?>
            </p>
        </div>
    </div>
</footer>
