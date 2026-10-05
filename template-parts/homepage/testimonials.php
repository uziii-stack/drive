<?php
/**
 * Template part for displaying the Homepage Testimonials section placeholder
 *
 * NOTE: Testimonials are a Phase 2 feature. This is an architectural placeholder
 * and contains no invented reviews or fake statistics.
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section id="testimonials" class="homepage-section homepage-testimonials is-phase-2-placeholder" aria-labelledby="testimonials-heading">
    <div class="site-container">
        <div class="section-header">
            <h2 id="testimonials-heading" class="section-title">
                <?php esc_html_e( 'Student Success Stories', 'drive' ); ?>
            </h2>
            <p class="section-description">
                <?php esc_html_e( 'Real feedback and exam pass stories from students across the country.', 'drive' ); ?>
            </p>
        </div>

        <div class="testimonials-placeholder-box">
            <p class="placeholder-note">
                <?php esc_html_e( '[Testimonials component placeholder - Phase 2 rollout upon collection of verified student feedback]', 'drive' ); ?>
            </p>
        </div>
    </div>
</section>
