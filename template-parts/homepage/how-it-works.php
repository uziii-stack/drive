<?php
/**
 * Template part for displaying the Homepage How It Works section placeholder
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section id="how-it-works" class="homepage-section homepage-how-it-works" aria-labelledby="how-it-works-heading">
    <div class="site-container">
        <div class="section-header">
            <h2 id="how-it-works-heading" class="section-title">
                <?php esc_html_e( 'How It Works', 'drive' ); ?>
            </h2>
            <p class="section-description">
                <?php esc_html_e( 'Three simple steps to prepare for and pass your state permit exam.', 'drive' ); ?>
            </p>
        </div>

        <div class="steps-grid">
            <div class="step-item">
                <span class="step-number">1</span>
                <h3 class="step-title"><?php esc_html_e( 'Select Your State & Vehicle', 'drive' ); ?></h3>
                <p class="step-text"><?php esc_html_e( 'Pick your state and whether you are testing for a Car, Truck, or Motorcycle permit.', 'drive' ); ?></p>
            </div>
            <div class="step-item">
                <span class="step-number">2</span>
                <h3 class="step-title"><?php esc_html_e( 'Practice & Master Topics', 'drive' ); ?></h3>
                <p class="step-text"><?php esc_html_e( 'Work through topic-specific questions with instant answer explanations.', 'drive' ); ?></p>
            </div>
            <div class="step-item">
                <span class="step-number">3</span>
                <h3 class="step-title"><?php esc_html_e( 'Take Mock Exams with Confidence', 'drive' ); ?></h3>
                <p class="step-text"><?php esc_html_e( 'Review cheat sheets and take full-length mock tests until you consistently pass.', 'drive' ); ?></p>
            </div>
        </div>
    </div>
</section>
