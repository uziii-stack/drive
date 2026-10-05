<?php
/**
 * Template part for displaying the Homepage Features / What We Offer section placeholder
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section id="features" class="homepage-section homepage-features" aria-labelledby="features-heading">
    <div class="site-container">
        <div class="section-header">
            <h2 id="features-heading" class="section-title">
                <?php esc_html_e( 'What We Offer', 'drive' ); ?>
            </h2>
            <p class="section-description">
                <?php esc_html_e( 'Everything you need to study efficiently, build confidence, and ace your permit test.', 'drive' ); ?>
            </p>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <h3 class="feature-title"><?php esc_html_e( '3 Vehicle Categories', 'drive' ); ?></h3>
                <p class="feature-text"><?php esc_html_e( 'Dedicated study material for Car (Class D/C), Commercial Truck (CDL), and Motorcycle permits.', 'drive' ); ?></p>
            </div>
            <div class="feature-card">
                <h3 class="feature-title"><?php esc_html_e( 'State-Specific Questions', 'drive' ); ?></h3>
                <p class="feature-text"><?php esc_html_e( 'Practice questions updated for individual state driving manuals and traffic regulations.', 'drive' ); ?></p>
            </div>
            <div class="feature-card">
                <h3 class="feature-title"><?php esc_html_e( 'Concise Cheat Sheets', 'drive' ); ?></h3>
                <p class="feature-text"><?php esc_html_e( 'High-yield summaries covering essential road signs, speed limits, fines, and safety rules.', 'drive' ); ?></p>
            </div>
            <div class="feature-card">
                <h3 class="feature-title"><?php esc_html_e( 'Real Exam Simulation', 'drive' ); ?></h3>
                <p class="feature-text"><?php esc_html_e( 'Timed mock tests formatted with realistic passing thresholds to simulate the official testing center.', 'drive' ); ?></p>
            </div>
        </div>
    </div>
</section>
