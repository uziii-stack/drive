<?php
/**
 * Template part for displaying the Homepage Final CTA / Footer Callout Row
 *
 * Replicates the clean centered final action matching design:
 * - Teal envelope icon + "Have more questions? We're here to help"
 * - Rounded dark-bordered button: "Choose Your State & Start Practicing"
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section id="final-cta" class="homepage-section final-cta-section" aria-label="<?php esc_attr_e( 'Choose your state', 'drive' ); ?>">
    <div class="site-container final-cta-container">
        <div class="final-cta-inner">
            
            <!-- Help Link Row -->
            <div class="final-help-row">
                <span class="help-envelope-icon" aria-hidden="true">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                    </svg>
                </span>
                <span class="help-text">
                    <?php esc_html_e( 'Have more questions?', 'drive' ); ?> 
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="help-link">
                        <?php esc_html_e( "We're here to help", 'drive' ); ?>
                    </a>
                </span>
            </div>

            <!-- CTA Action Button -->
            <div class="final-btn-row">
                <a href="#state-selector" class="btn-outline-choose-state" id="btn-final-choose-state">
                    <?php esc_html_e( 'Choose Your State & Start Practicing', 'drive' ); ?>
                </a>
            </div>

        </div><!-- .final-cta-inner -->
    </div><!-- .site-container -->
</section><!-- #final-cta -->
