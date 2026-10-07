<?php
/**
 * Template part for displaying the Site Footer
 *
 * Replicates the dark fullwidth footer matching design:
 * - Top 5-Column Grid:
 *   1. Logo (WP Custom logo / Header parity fallback), brand copy, and dark social icon buttons (YouTube, Email)
 *   2. PRACTICE navigation column
 *   3. POPULAR STATES navigation column (California, Texas, Florida, New York, View all states →)
 *   4. COMPANY navigation column (About Us, Contact, FAQ, YouTube Channel)
 *   5. LEGAL navigation column (Privacy Policy, Terms of Use, Disclaimer)
 * - Middle: Disclaimer card container
 * - Bottom Bar: Copyright notice & Privacy / Terms / Sitemap links
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$youtube_url = get_theme_mod( 'drive_youtube_url', 'https://www.youtube.com' );
?>

<footer id="colophon" class="site-footer dark-site-footer" role="contentinfo">
    <div class="site-container footer-container">
        
        <!-- Top 5-Column Grid -->
        <div class="footer-main-grid">
            
            <!-- Col 1: Brand Info & Social -->
            <div class="footer-brand-col">
                <div class="footer-logo-wrap">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand-link footer-brand-link" rel="home">
                        <?php 
                        $footer_logo_src = '';
                        if ( has_custom_logo() ) {
                            $custom_logo_id = get_theme_mod( 'custom_logo' );
                            $custom_logo_data = wp_get_attachment_image_src( $custom_logo_id, 'full' );
                            if ( ! empty( $custom_logo_data[0] ) ) {
                                $footer_logo_src = $custom_logo_data[0];
                            }
                        } elseif ( file_exists( get_template_directory() . '/assets/images/logo-icon.png' ) ) {
                            $footer_logo_src = get_template_directory_uri() . '/assets/images/logo-icon.png';
                        } elseif ( file_exists( get_template_directory() . '/assets/images/logo.png' ) ) {
                            $footer_logo_src = get_template_directory_uri() . '/assets/images/logo.png';
                        }
                        ?>

                        <?php if ( ! empty( $footer_logo_src ) ) : ?>
                            <span class="brand-logo-badge brand-custom-logo-badge" aria-hidden="true">
                                <img src="<?php echo esc_url( $footer_logo_src ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="custom-logo-img" width="36" height="36" />
                            </span>
                        <?php else : ?>
                            <span class="brand-logo-badge" aria-hidden="true">
                                <svg width="34" height="34" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="18" cy="18" r="16" fill="#1C1E2E" stroke="#ffffff" stroke-width="2.5"/>
                                    <circle cx="9.5" cy="26.5" r="2.5" fill="#FF6B00"/>
                                    <path d="M11 18.5L16 23.5L25.5 13" stroke="#00D4C3" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        <?php endif; ?>

                        <span class="brand-title-wrap">
                            <span class="brand-name-main"><?php esc_html_e( 'DMV Learners Permit', 'drive' ); ?></span>
                            <span class="brand-name-accent"><?php esc_html_e( 'Test', 'drive' ); ?></span>
                        </span>
                    </a>
                </div>

                <p class="footer-brand-blurb">
                    <?php esc_html_e( 'State-specific practice tests, timed mock exams and printable cheat sheets for car, truck and motorcycle permits.', 'drive' ); ?>
                </p>

                <!-- Social / Contact Icons -->
                <div class="footer-social-row">
                    <a href="<?php echo esc_url( $youtube_url ); ?>" 
                       class="footer-social-btn" 
                       aria-label="<?php esc_attr_e( 'YouTube Channel', 'drive' ); ?>" 
                       target="_blank" 
                       rel="noopener noreferrer">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </a>
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" 
                       class="footer-social-btn" 
                       aria-label="<?php esc_attr_e( 'Contact Us', 'drive' ); ?>">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                        </svg>
                    </a>
                </div>
            </div><!-- .footer-brand-col -->


            <!-- Col 2: PRACTICE -->
            <div class="footer-nav-col">
                <h4 class="footer-col-heading"><?php esc_html_e( 'PRACTICE', 'drive' ); ?></h4>
                <ul class="footer-links-list">
                    <li><a href="<?php echo esc_url( home_url( '/#state-selector' ) ); ?>"><?php esc_html_e( 'Practice Tests', 'drive' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/#state-selector' ) ); ?>"><?php esc_html_e( 'Mock Tests', 'drive' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/#state-selector' ) ); ?>"><?php esc_html_e( 'Cheat Sheets (PDF)', 'drive' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/#how-it-works' ) ); ?>"><?php esc_html_e( 'How It Works', 'drive' ); ?></a></li>
                </ul>
            </div>


            <!-- Col 3: POPULAR STATES -->
            <div class="footer-nav-col">
                <h4 class="footer-col-heading"><?php esc_html_e( 'POPULAR STATES', 'drive' ); ?></h4>
                <ul class="footer-links-list">
                    <li><a href="<?php echo esc_url( home_url( '/california/' ) ); ?>"><?php esc_html_e( 'California', 'drive' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/texas/' ) ); ?>"><?php esc_html_e( 'Texas', 'drive' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/florida/' ) ); ?>"><?php esc_html_e( 'Florida', 'drive' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/new-york/' ) ); ?>"><?php esc_html_e( 'New York', 'drive' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/#state-selector' ) ); ?>" class="link-view-all-states"><?php esc_html_e( 'View all states →', 'drive' ); ?></a></li>
                </ul>
            </div>


            <!-- Col 4: COMPANY -->
            <div class="footer-nav-col">
                <h4 class="footer-col-heading"><?php esc_html_e( 'COMPANY', 'drive' ); ?></h4>
                <ul class="footer-links-list">
                    <li><a href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>"><?php esc_html_e( 'About Us', 'drive' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'drive' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/#faq' ) ); ?>"><?php esc_html_e( 'FAQ', 'drive' ); ?></a></li>
                    <li><a href="<?php echo esc_url( $youtube_url ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'YouTube Channel', 'drive' ); ?></a></li>
                </ul>
            </div>


            <!-- Col 5: LEGAL -->
            <div class="footer-nav-col">
                <h4 class="footer-col-heading"><?php esc_html_e( 'LEGAL', 'drive' ); ?></h4>
                <ul class="footer-links-list">
                    <li><a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'drive' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/terms-of-use/' ) ); ?>"><?php esc_html_e( 'Terms of Use', 'drive' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/disclaimer/' ) ); ?>"><?php esc_html_e( 'Disclaimer', 'drive' ); ?></a></li>
                </ul>
            </div>

        </div><!-- .footer-main-grid -->


        <!-- Middle Disclaimer Box -->
        <div class="footer-disclaimer-wrap">
            <div class="footer-disclaimer-card">
                <p><?php esc_html_e( 'DMV Learners Permit Test is an independent study resource. It is not affiliated with, endorsed by, or connected to any state Department of Motor Vehicles or government agency. Always check your official state driver handbook.', 'drive' ); ?></p>
            </div>
        </div>


        <!-- Bottom Copyright Bar -->
        <div class="footer-bottom-bar">
            <p class="footer-copyright">
                &copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'drive' ); ?>
            </p>
            <div class="footer-bottom-links">
                <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy', 'drive' ); ?></a>
                <a href="<?php echo esc_url( home_url( '/terms-of-use/' ) ); ?>"><?php esc_html_e( 'Terms', 'drive' ); ?></a>
                <a href="<?php echo esc_url( home_url( '/sitemap.xml' ) ); ?>"><?php esc_html_e( 'Sitemap', 'drive' ); ?></a>
            </div>
        </div>

    </div><!-- .site-container -->
</footer><!-- #colophon -->
