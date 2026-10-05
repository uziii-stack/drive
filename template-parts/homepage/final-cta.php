<?php
/**
 * Template part for displaying the Homepage Final CTA section placeholder
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section id="final-cta" class="homepage-section homepage-final-cta" aria-labelledby="cta-heading">
    <div class="site-container">
        <div class="cta-inner-box">
            <h2 id="cta-heading" class="section-title">
                <?php esc_html_e( 'Ready to Start Studying for Your Permit?', 'drive' ); ?>
            </h2>
            <p class="section-description">
                <?php esc_html_e( 'Choose your state and vehicle type now to begin free practice tests or get your complete study cheat sheet.', 'drive' ); ?>
            </p>
            <div class="cta-actions">
                <a href="#state-selector" class="btn btn-accent">
                    <?php esc_html_e( 'Find Your State Test', 'drive' ); ?>
                </a>
            </div>
        </div>
    </div>
</section>
